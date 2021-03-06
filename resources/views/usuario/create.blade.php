@extends('layouts.principal')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Usuarios</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">

    <ol class="breadcrumb">
        <li><a href="/home">Inicio</a></li>
        <li><a href="/usuario">Usuarios</a></li>
        <li class="active">Editar Usuario</li>
    </ol>

    @include('alertas.userRequest')

    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Crear un nuevo usuario
            </div>
            <div class="panel-body">

                <div class="row">
                    
                    <div class="col-lg-6 col-lg-offset-3 ">

	                    {!!Form::open(['route'=>'usuario.store','method'=>'POST','autocomplete'=>'off'])!!}

	                    	@include('usuario.forms.form')

	                    	<button type="submit" class="btn btn-success">Guardar</button>
                            <a href="/usuario" class="btn btn-default">Regresar</a>

	                    {!!Form::close()!!}

                    </div>
                    <!-- /.col-lg-6 (nested) -->
                    
                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
@stop