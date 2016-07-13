@extends('layouts.principal')


@section('titulo')
    Farmacia | Usuarios
@stop

@section('losCSS')
    {!!Html::style('js/sweet-alert/dist/sweetalert.css')!!}
    {!!Html::style('js/alertify/css/themes/bootstrap.css')!!}
@endsection


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
        <li class="active">Usuarios</li>
    </ol>
    
    @if( Auth::User()->id == 1 )
    <div class="panel">
        <a href="/usuario/create" class="btn btn-primary" >Nuevo Usuario</a>
    </div>
    @endif
    
    @include('alertas.success')
    @include('alertas.errors')

    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Usuarios registrado
            </div>
            <div class="panel-body">
                <div class="row">
                    
                    <div class="col-lg-10 col-lg-offset-1 ">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Usuario</th>
                                    <th>Email</th>
                                    <th>DNI</th>
                                    <th>Tipo</th>
                                    <th></th>
                                </tr>
                            </thead>
                            @foreach($users as $user)
                            <tbody>
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name.' '.$user->last_name}}</td>
                                    <td>{{$user->user}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->dni}}</td>
                                    <td>{{$user->type}}</td>
                                    <td>
                                        @if( Auth::User()->tipo == 'admin' )
                                        {!!link_to_route('usuario.edit', $title  = 'editar', $parameters =$user->id, $attributes = ['class'=>'btn btn-link'] )!!}
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                        {!!$users->render()!!}
                    </div>
                    <!-- /.col-lg-10 (nested) -->
                    
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


    <!-- footer content -->
    @include('layouts.footer')
    <!-- /footer content -->


@section('scripts')

    <!-- sweet Alert -->
    {!!Html::script('js/sweet-alert/dist/sweetalert.js')!!}

    <!-- icheck -->
    {!!Html::script('js/icheck/icheck.min.js')!!}

    <!-- bootstrap progress js -->
    {!!Html::script('js/progressbar/bootstrap-progressbar.min.js')!!}
    {!!Html::script('js/nicescroll/jquery.nicescroll.min.js')!!}

    {!!Html::script('js/custom.js')!!}



@endsection


@stop