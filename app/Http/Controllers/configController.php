<?php

namespace yupiventas\Http\Controllers;

use Illuminate\Http\Request;

use yupiventas\Http\Requests;


use yupiventas\config;
use DB;
use Auth;
use Session;
use Redirect;

use yupiventas\Http\Requests\addConfigRequest;
use yupiventas\Http\Requests\updateConfigRequest;


class configController extends Controller
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
    public function store(addConfigRequest $request)
    {
        $config = $this->get_config();
        if( $config == '' )
        {
            $data = config::create( $request->all() );
        }
        else
        {
            $marca = config::find( 1 );
            $marca->fill( $request->all() );
            $marca->save();
        }
        return redirect('/home')->with('estado', 'Configuración agregada');
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


    public function get_config()
    {
        $data      = DB::table('config')->first();
        return $data;
    }


}
