<?php

namespace yupiventas\Http\Controllers;

use Illuminate\Http\Request;

use yupiventas\Http\Requests;


use yupiventas\Http\Requests\ventaCreateRequest;
use yupiventas\Http\Requests\ventaUpdateRequest;
use yupiventas\venta;
use yupiventas\detalle_venta;
use yupiventas\logs;
use yupiventas\clientes;
use yupiventas\kardex;
use yupiventas\productos;
use yupiventas\config;
use yupiventas\Routing\Route;
use yupiventas\producto_lote;

use yupiventas\User;

use Session;
use Redirect;
use Carbon;
use DB;
use Auth;

use Excel;
use PDF;


class reportesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth' );
        #$this->middleware('ventas' , ['only' => ['create','edit','show'] ] );
    }

    public function index()
    {
        //
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
        //
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

    public function ventas_user()
    {

        #Resumen de las ventas del usuario actual
        #DB::enableQueryLog();
        $tipo_user      = Auth::User()->type;
        $id_user        = Auth::User()->id;
        $user           = Auth::User()->user;
        $usuarios       = array();
        #
        $fecha  = $this->fecha_hoy();
        $data   = array();
        #
        $response = array();
        if( $tipo_user == 'Administrador' )
        {
            $usuarios = $users = User::lists('user','id');
            $data = venta::where('fecha','=',$fecha)->get();
        }
        else
        {
            $usuarios = $users = User::where('id','=',$id_user)->lists('user','id');
            $data = venta::where( [['user_creado','=',$user],['fecha','=',$fecha]] )->get();
        }
        #
        #return DB::getQueryLog();
        list($anio,$mes,$dia) = explode('-', $fecha );
        $fecha = $dia.'/'.$mes.'/'.$anio;
        #
        $response['data']   = $data;
        $response['inicio'] = $fecha;
        $response['fin']    = $fecha;
        $response['users'] = $usuarios;
        #
        #return $usuarios;
        return view('reportes.resumenVentaUsuario',compact('response'));
    }


    public function ventas_user_filtro( $inicio , $fin , $userf )
    {

        #Resumen de las ventas del usuario actual
        #DB::enableQueryLog();
        $tipo_user      = Auth::User()->type;
        $id_user        = Auth::User()->id;
        $user           = Auth::User()->user;
        $usuarios       = array();
        #
        $fecha  = $this->fecha_hoy();
        $data   = array();
        #
        $response = array();
        if( $tipo_user == 'Administrador' )
        {
            $usuarios = $users = User::lists('user','id');
            #to do
            if( $userf == 'all' )
            {
                $data = venta::where('fecha','>=',$inicio)->where('fecha','<=',$fin)->get();
            }
            else
            {
                $data = venta::where('fecha','>=',$inicio)->where([['fecha','<=',$fin],['id_user_creado','=',$userf]])->get();
            }
        }
        else
        {
            $usuarios = $users = User::where('id','=',$id_user)->lists('user','id');
            $data = venta::where( [['user_creado','=',$user],['fecha','>=',$inicio],['fecha','<=',$fin]] )->get();
        }
        #
        #return DB::getQueryLog();
        #Fecha de inicio, latina
        list($anio,$mes,$dia) = explode('-', $inicio );
        $inicio = $dia.'/'.$mes.'/'.$anio;
        #Fecjha de fin latina
        list($anio,$mes,$dia) = explode('-', $fin );
        $fin = $dia.'/'.$mes.'/'.$anio;
        #
        $response['data']   = $data;
        $response['inicio'] = $inicio;
        $response['fin']    = $fin;
        #
        $response['users'] = $usuarios;
        #return $usuarios;
        return view('reportes.resumenVentaUsuario',compact('response'));
    }


    public function producto_usuario()
    {
        #Resumen de las ventas del usuario actual
        DB::enableQueryLog();
        $tipo_user      = Auth::User()->type;
        $id_user        = Auth::User()->id;
        $user           = Auth::User()->user;
        $usuarios       = array();
        #
        $fecha  = $this->fecha_hoy();
        $data   = array();
        #
        $response = array();
        if( $tipo_user == 'Administrador' )
        {
            $usuarios = $users = User::lists('user','id');
            $data = detalle_venta::whereDate('created_at','=',$fecha )->whereNull('deleted_at')->get();
        }
        else
        {
            $usuarios = $users = User::where('id','=',$id_user)->lists('user','id');
            $data = detalle_venta::whereDate('created_at','=',$fecha )->whereNull('deleted_at')->where('id_user','=',$id_user)->get();
        }
        #
        #return DB::getQueryLog();
        list($anio,$mes,$dia) = explode('-', $fecha );
        $fecha = $dia.'/'.$mes.'/'.$anio;
        #
        $response['data']   = $data;
        $response['inicio'] = $fecha;
        $response['fin']    = $fecha;
        $response['users'] = $usuarios;
        #
        #return $data;
        return view('reportes.productosUsuario',compact('response'));
    }


    public function producto_usuario_filtro( $inicio , $fin , $userf )
    {
        #Resumen de las ventas del usuario actual
        DB::enableQueryLog();
        $tipo_user      = Auth::User()->type;
        $id_user        = Auth::User()->id;
        $user           = Auth::User()->user;
        $usuarios       = array();
        #
        $fecha  = $this->fecha_hoy();
        $data   = array();
        #
        $response = array();
        if( $tipo_user == 'Administrador' )
        {
            $usuarios = $users = User::lists('user','id');
            if( $userf == 'all' )
            {
                $data = detalle_venta::whereDate('created_at','>=',$inicio)->whereDate('created_at','<=',$fin)->whereNull('deleted_at')->get();
            }
            else
            {
                $data = detalle_venta::whereDate('created_at','>=',$inicio)->whereDate('created_at','<=',$fin)->whereNull('deleted_at')->where('id_user','=',$userf)->get();
            }
        }
        else
        {
            $usuarios = $users = User::where('id','=',$id_user)->lists('user','id');
            $data = detalle_venta::whereDate('created_at','=',$fecha )->whereNull('deleted_at')->where('id_user','=',$id_user)->get();
        }
        #
        #return DB::getQueryLog();
        list($anio,$mes,$dia) = explode('-', $inicio );
        $inicio = $dia.'/'.$mes.'/'.$anio;
        list($anio,$mes,$dia) = explode('-', $fin );
        $fin = $dia.'/'.$mes.'/'.$anio;
        #
        $response['data']   = $data;
        $response['inicio'] = $inicio;
        $response['fin']    = $fin;
        $response['users'] = $usuarios;
        #
        #return $data;
        return view('reportes.productosUsuario',compact('response'));
    }


    public function producto_margen()
    {
        #Resumen de las ventas del usuario actual
        DB::enableQueryLog();
        $tipo_user      = Auth::User()->type;
        $id_user        = Auth::User()->id;
        $user           = Auth::User()->user;
        $usuarios       = array();
        #
        $fecha  = $this->fecha_hoy();
        $data   = array();
        #
        $response = array();
        if( $tipo_user == 'Administrador' )
        {
            $usuarios = $users = User::lists('user','id');
            $data = producto_lote::join('detalle_venta','detalle_venta.id_producto','=','producto_lote.id_producto')->whereDate('detalle_venta.created_at','=',$fecha )->whereNull('detalle_venta.deleted_at')->get();
        }
        else
        {
            $usuarios = $users = User::where('id','=',$id_user)->lists('user','id');
            $data = null;
        }
        #
        #return DB::getQueryLog();
        list($anio,$mes,$dia) = explode('-', $fecha );
        $fecha = $dia.'/'.$mes.'/'.$anio;
        #
        $response['data']   = $data;
        $response['inicio'] = $fecha;
        $response['fin']    = $fecha;
        $response['users'] = $usuarios;
        #
        #return $data;
        return view('reportes.productoMargen',compact('response'));
    }



    public function producto_margen_filtro( $inicio , $fin )
    {
        #Resumen de las ventas del usuario actual
        DB::enableQueryLog();
        $tipo_user      = Auth::User()->type;
        $id_user        = Auth::User()->id;
        $user           = Auth::User()->user;
        $usuarios       = array();
        #
        $fecha  = $this->fecha_hoy();
        $data   = array();
        #
        $response = array();
        if( $tipo_user == 'Administrador' )
        {
            $usuarios = $users = User::lists('user','id');
            $data = producto_lote::join('detalle_venta','detalle_venta.id_producto','=','producto_lote.id_producto')->whereDate('detalle_venta.created_at','>=',$inicio )->whereDate('detalle_venta.created_at','<=',$fin )->whereNull('detalle_venta.deleted_at')->orderBy('detalle_venta.created_at')->get();
        }
        else
        {
            $usuarios = $users = User::where('id','=',$id_user)->lists('user','id');
            $data = null;
        }
        #
        #return DB::getQueryLog();
        list($anio,$mes,$dia) = explode('-', $inicio );
        $inicio = $dia.'/'.$mes.'/'.$anio;
        list($anio,$mes,$dia) = explode('-', $fin );
        $fin = $dia.'/'.$mes.'/'.$anio;
        #
        $response['data']   = $data;
        $response['inicio'] = $inicio;
        $response['fin']    = $fin;
        $response['users'] = $usuarios;
        #
        #return $data;
        return view('reportes.productoMargen',compact('response'));
    }
    


}
