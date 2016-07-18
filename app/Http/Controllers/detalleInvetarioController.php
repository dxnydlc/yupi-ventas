<?php

namespace yupiventas\Http\Controllers;

use Illuminate\Http\Request;

use yupiventas\Http\Requests;

use yupiventas\inventario_Detalle;
use yupiventas\logs;
use yupiventas\config;
use yupiventas\Routing\Route;

use Session;
use Redirect;
use Carbon;
use DB;
use Auth;

use Excel;
use PDF;

class detalleInvetarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        #return $request->all();
        DB::enableQueryLog();
        #User data
        $id_user    = Auth::User()->id;
        $user       = Auth::User()->user;
        #
        $response       = array();
        $id_return      = 0;
        $token          = $request->token;
        $data_insert = [
            'id_inventario'     => $request['id_inventario'],
            'id_producto'       => $request['id_producto'],
            'producto'          => $request['producto'],
            'lote'              => $request['lote'],
            'laboratorio'       => $request['laboratorio'],
            'vencimiento'       => $request['vencimiento'],
            'compra'            => $request['compra'],
            'venta'             => $request['venta'],
            'stock'             => $request['stock']
        ];
        $id_return = inventario_Detalle::create( $data_insert );
        $response['id']     = $id_return->id;
        $response['token']  = $token;
        $response['data_insert']  = $data_insert;
        #$response['query'] = DB::getQueryLog();
        $response['items'] = DB::table('detalle_venta')->where( "token" , $token )->get();

        #logs
        $this->set_logs(['tipo'=>'Docs','tipo_doc'=>'IN','key'=>$token,'evento'=>'add.item','content'=>$request['producto'],'res'=>'Agregado']);
        return $response;
        #/inventario/1/edit
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






}
