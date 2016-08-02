<?php

namespace yupiventas\Http\Controllers;

use Illuminate\Http\Request;

use yupiventas\Http\Requests;



use yupiventas\productos;
use yupiventas\logs;
use yupiventas\producto_lote;

use Session;
use Redirect;
use Carbon;
use DB;




class productoLoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth' );
        $this->middleware('isAdmin' , ['only' => ['create','edit','show'] ] );
    }


    public function index()
    {
        $dataProductos  = productos::lists('nombre','id_producto');
        $data['data']   = productos::join('producto_lote', 'productos.id_producto', '=', 'producto_lote.id_producto')->orderBy('id','DESC')->paginate(20);
        $data['prds']   = $dataProductos;
        return view('productolote.homeProductoLote',compact('data'));
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
        #Primero creamos el producto y luego el Lote
        $token = $request['tokenPL'];
        $producto = productos::find( $request['lt_producto'] );
        #Ahora creamos el lote
        $utilidad = 20;
        $data_lote = [
            'id_producto'   => $request['lt_producto'],
            'producto'      => $producto->nombre,
            'lote'          => $request['lt_lote'],
            'laboratorio'   => $request['lt_laboratorio'],
            'vencimiento'   => $request['lt_vencimiento'],
            'precio'        => $request['lt_venta'],
            'compra'        => $request['lt_compra'],
            'utilidad'      => $utilidad,
            'precio_old'    => 0,
            'id_proveedor'  => 1,
            'proveedor'     => 'Ninguno'
        ];
        #Log de prodcuto
        $this->set_logs(['tipo'=>'Docs','tipo_doc'=>'VE','key'=>$token,'evento'=>'add.ProdLote','content'=>'Nuevo Producto: '.$request['lt_producto'],'res'=>'Agregado']);
        $this->make_lote( $data_lote );
        #return $request->all();
        #productolote
        return redirect('/productolote')->with('message', 'Producto asignado a un Lote');
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
        $data = array();
        $data['data']   = productos::join('producto_lote', 'productos.id_producto', '=', 'producto_lote.id_producto')->where('productos.id_producto','=',$id)->get();
        return $data;
        return view('productolote.editarProductoLote',["data" => $data ]);
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
        //
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


    public function set_logs($param)
    {
        $mytime = Carbon\Carbon::now('America/Lima');
        $mytime->toDateString();
        $fecha_mysql = $mytime->format('d/m/Y H:m:s');
        #
        $data_insert = [
            'tipo'          => $param['tipo'],
            'tipo_doc'      => $param['tipo_doc'],
            'key'           => $param['key'],
            'evento'        => $param['evento'],
            'contenido'     => $param['content'],
            'resultado'     => $param['res'],
            'fecha'         => $fecha_mysql,
            'id_user'       => 1,
            'usuario'       => 'DDELACRUZ'
        ];
        logs::create($data_insert);
    }

    public function get_logs( $key )
    {
        $data      = DB::table('logs')->where( "key" , $key )->get();
        return $data;
    }

    public function make_lote( $data )
    {
        producto_lote::create($data);
    }

}


