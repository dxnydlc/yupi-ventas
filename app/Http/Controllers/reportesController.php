<?php

namespace yupiventas\Http\Controllers;

use Illuminate\Http\Request;

use yupiventas\Http\Requests;


use yupiventas\Http\Requests\ventaCreateRequest;
use yupiventas\Http\Requests\ventaUpdateRequest;
use yupiventas\venta;
use yupiventas\logs;
use yupiventas\clientes;
use yupiventas\kardex;
use yupiventas\productos;
use yupiventas\config;
use yupiventas\Routing\Route;

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

    public function ventas_user()
    {

        #Resumen de las ventas del usuario actual
        #DB::enableQueryLog();
        $tipo_user      = Auth::User()->type;
        $id_user        = Auth::User()->id;
        $user           = Auth::User()->user;
        #
        $fecha  = $this->fecha_hoy();
        $data   = array();
        #
        $response = array();
        if( $tipo_user == 'Administrador' )
        {
            $data = venta::where('fecha','=',$fecha)->get();
        }
        else
        {
            $data = venta::where( [['user_creado','=',$user],['fecha','=',$fecha]] )->get();
        }
        #
        #return DB::getQueryLog();
        list($anio,$mes,$dia) = explode('-', $fecha );
        $fecha = $dia.'/'.$mes.'/'.$anio;
        #
        $response['data']   = $data;
        $response['fecha']  = $fecha;
        #
        #return $response['data'];
        return view('reportes.resumenVentaUsuario',compact('response'));
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


}
