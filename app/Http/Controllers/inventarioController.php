<?php

namespace yupiventas\Http\Controllers;

use Illuminate\Http\Request;

use yupiventas\Http\Requests;



use yupiventas\Http\Requests\inventarioCreateRequest;
use yupiventas\Http\Requests\inventarioUpdateRequest;

use yupiventas\logs;
use yupiventas\inventario;
use yupiventas\config;
use yupiventas\Routing\Route;
use yupiventas\kardex;
use yupiventas\producto_lote;

use Session;
use Redirect;
use Carbon;
use DB;
use Auth;

use Excel;
use PDF;


class inventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth' );
        $this->middleware('isAdmin');
    }

    public function index()
    {
        $data = inventario::paginate(10);
        return view('inventario.homeInventario',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        #DB::enableQueryLog();
        $id_inventario = $id;
        $response = array();
        $data = array();
        $mytime = Carbon\Carbon::now('America/Lima');
        $mytime->toDateString();
        #
        #Productos con lote
        $data['productos']      = DB::table('productos')->get();
        $data['inventario']     = inventario::find( $id_inventario );
        #Ya cerrado?
        if( $data['inventario']->estado == 'Cerrado' )
        {
            return redirect::to('/invoice_inv/'.$data['inventario']->id);
        }
        #
        list($dia,$mes,$anio) = explode('/', $data['inventario']->fecha );
        $fecha = $anio.'-'.$mes.'-'.$dia;
        #
        $data['fecha']      = $data['inventario']->fecha;
        $data['nombre']     = $data['inventario']->nombre;
        $data['items']      = DB::table('inventario_detalle')->where( "id_inventario" , $id_inventario )->get();
        #
        return view('inventario.updateInventario', ['data' => $data] );
        #
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id_user    = Auth::User()->id;
        $user       = Auth::User()->user;
        #
        $mytime = Carbon\Carbon::now('America/Lima');
        $mytime->toDateString();
        $fecha_mysql = $mytime->format('d/m/Y');
        #Actualizar estado de Inventario
        $inventario = inventario::find( $id );
        $inventario->fill( $request->all() );
        $inventario->save();
        #Mascara doc
        $mask_doc   = $inventario->nombre;
        #Movimiento de Kadex en almacen
        $productos  = DB::table('inventario_detalle')->where( "id_inventario" , $id )->whereNull('deleted_at')->get();
        $inventario = inventario::find( $id );
        #
        if( count($productos) > 0 )
        {
            foreach ($productos as $key => $rs) {
                $data_last = array();
                $data_last  = $this->get_lastkardex( $rs->id_producto );
                if( $data_last != 'no' ){
                    $saldo_cant       = 0;
                    $saldo_precio     = $data_last['precio'];
                    $saldo_valor_f    = $data_last['valor'];
                }else{
                    $saldo_cant       = 0;
                    $saldo_precio     = $rs->venta;
                    $saldo_valor_f    = $rs->venta;
                }
                #return $data_last;
                $cant       = $rs->stock;
                $precio     = $rs->venta;
                $valor_f    = $rs->venta;
                #Valores Kardex anterior
                $data_insert = [
                    'id_link'       => $inventario->id,
                    'movimiento'    => 'IN',
                    'fecha'         => $fecha_mysql,
                    'id_producto'   => $rs->id_producto,
                    'producto'      => $rs->producto,
                    'id_persona'    => 1,
                    'persona'       => 'Clinte',
                    'documento'     => 'VE',
                    'numero_doc'    => $mask_doc,
                    'cantidad_e'    => $cant,
                    'precio_e'      => $precio,
                    'valor_e'       => $valor_f,
                    'cantidad_s'    => 0,
                    'precio_s'      => 0,
                    'valor_s'       => 0,
                    'cantidad_f'    => $saldo_cant,
                    'precio_f'      => $saldo_precio,
                    'valor_f'       => $saldo_valor_f,
                    'id_user'       => $id_user,
                    'usuario'       => $user
                ];
                $Kardex = kardex::create($data_insert);
                #Crear producto lote
                list($anio,$mes,$dia) = explode('-', $rs->vencimiento );
                $fecha_vence = $dia.'/'.$mes.'/'.$anio;
                #calcular utilidad
                $diferecia = (int)$rs->compra - (int)$rs->venta;
                $utilidad = ($diferecia*100)/$rs->venta;
                $data_lote = [
                    'id_producto'   => $rs->id_producto,
                    'producto'      => $rs->producto,
                    'lote'          => $rs->lote,
                    'laboratorio'   => $rs->laboratorio,
                    'vencimiento'   => $fecha_vence,
                    'precio'        => $rs->venta,
                    'compra'        => $rs->compra,
                    'utilidad'      => $utilidad,
                    'precio_old'    => 0,
                    'id_proveedor'  => 1,
                    'proveedor'     => 'Ninguno',
                    'stock'         => $rs->stock
                ];
                $this->make_lote( $data_lote );
            }
            unset($rs);
        }
        #/Movimiento de Kadex en almacen
        #logs
        $this->set_logs(['tipo'=>'PL','tipo_doc'=>'IN','key'=>$id_user,'evento'=>'close.IN','content'=>'Cerrar Inventario '.$inventario->nombre,'res'=>'Cerrado', 'link_to' => $id ]);
        return redirect::to('/invoice_inv/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function make_inventario()
    {
        #User data
        $id_user    = Auth::User()->id;
        $user       = Auth::User()->user;
        #
        $response   = array();
        $data       = array();
        #fecha
        $mytime = Carbon\Carbon::now('America/Lima');
        $mytime->toDateString();
        $fecha = $mytime->format('d/m/Y');
        #
        $inventario = inventario::create([
            'nombre'    => 'Inventario '.$fecha,
            'fecha'     => $fecha,
            'estado'    => 'ACT',
            'id_user'   => $id_user,
            'usuario'   => $user,
            
        ]);
        $id_inventario = $inventario->id;
        #Personal Log
        $this->set_logs(['tipo'=>'PL','tipo_doc'=>'IN','key'=>$id_user,'evento'=>'make.IN','content'=>'Crear Inventario ','res'=>'Creado', 'link_to' => $id_inventario ]);
        #
        return redirect('inventario/'.$id_inventario.'/edit')->with('estado', 'Inventario creado correctamente');
    }


    public function fecha_hoy($tipo='fecha')
    {
        #
        $mytime = Carbon\Carbon::now('America/Lima');
        $mytime->toDateString();
        if( $tipo == 'fecha' )
        {
            $fecha_mysql = $mytime->format('Y-m-d');
        }
        else
        {
            $fecha_mysql = $mytime->format('Y-m-d H:m:s');
        }
        #
        return $fecha_mysql;
    }



    public function set_logs($param)
    {
        $id_user    = Auth::User()->id;
        $user       = Auth::User()->user;
        #
        $mytime = Carbon\Carbon::now('America/Lima');
        $mytime->toDateString();
        $fecha_mysql = $mytime->format('d/m/Y H:m:s');
        $link_to = '';
        #
        if( $param['tipo'] == 'PL' )
        {
            $link_to = $param['link_to'];
        }
        #
        $data_insert = [
            'tipo'          => $param['tipo'],
            'tipo_doc'      => $param['tipo_doc'],
            'key'           => $param['key'],
            'evento'        => $param['evento'],
            'contenido'     => $param['content'],
            'resultado'     => $param['res'],
            'fecha'         => $fecha_mysql,
            'id_user'       => $id_user,
            'usuario'       => $user,
            'link_to'       => $link_to
        ];
        logs::create($data_insert);
    }



    public function get_lastkardex($id_prod)
    {
        $response = array();
        $data = DB::table('kardex')->where('id_producto','=',$id_prod)->orderBy('id', 'desc')->first();
        if( count($data) > 0 ){
            #foreach ($data as $key => $rs) {
                $response['cant']   = $data->cantidad_f;
                $response['precio'] = $data->precio_f;
                $response['valor']  = $data->valor_f;
            #}
            #unset($rs);
            return $response;
        }else{
            return 'no';
        }
    }



    public function make_lote( $data )
    {
        producto_lote::create($data);
    }


    public function invoice_inventario($id)
    {
        #DB::enableQueryLog();
        $data = array();
        $data['inventario'] = inventario::find( $id );
        $data['items']      = DB::table('inventario_detalle')->where( "id_inventario" , $id )->whereNull('deleted_at')->get();
        $data['logs']       = null;#$this->get_logs( $data['venta']->token );
        $data['empresa']    = config::find( 1 );
        #
        #return DB::getQueryLog();
        #
        #return $data;
        return view('inventario.invoice', ['data' => $data] );
    }



}
