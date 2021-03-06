@extends('layouts.principal')

@section('titulo')
    Farmacia | Ventas
@stop

@section('losCSS')
    {!!Html::style('js/sweet-alert/dist/sweetalert.css')!!}
    {!!Html::style('js/alertify/css/themes/bootstrap.css')!!}
@endsection

@section('content')

<input type="hidden" id="token" value="{{ csrf_token() }}" >
    <div class="">

        <div class="page-title">
            <div class="title_left">
                <h3>
			        Ventas
			        <small>
			            Ventas del usuario {{Auth::User()->user}} el día de hoy
			        </small>
			    </h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Buscar por...">
                        <span class="input-group-btn">
                <button class="btn btn-default" type="button">Buscar</button>
            </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
	   
       @include('alertas.success')
        @include('alertas.errors')
        @include('alertas.mensaje')
		
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
	                <div class="x_content">
                    <ul class="list-inline">
                        <li>
                            <a href="ventas/create" class="btn btn-default">Nueva Venta</a>
                        </li>
                        <li>
                            <a href="/mb" class="btn btn-default">Nueva Boleta</a>
                        </li>
                        <li>
                            <a href="/ex_ventas" class="btn btn-success "><span class="glyphicon glyphicon-floppy-save" ></span> Exportar</a>
                        </li>
                    </ul>
	                	
	                </div>
	            </div>
			</div>
		</div>
		<!-- row -->

		<div class="clearfix"></div>

        <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Ventas <small>mostrando todos los registros activos</small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Opción 1</a>
                                    </li>
                                    <li><a href="#">Opción 2</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Documento</th>
                                    <th>Cliente</th>
                                    <th>Total</th>
                                    <th>Fecha</th>
                                    <th>Estado</th>
                                    <th>Usuario</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($venta as $ve)
                                <?php

                                $tipo_doc = $ve->tipo_doc;
                                
                                ?>
                                <tr id="fila_{{$ve->id}}" >
                                    <th scope="row">{{$ve->id}}</th>
                                    <td>
                                        <?php if( $ve->estado == 'Cerrado' ){ 
                                            echo '<a href="invoice_venta/'.$ve->id.'" >'.$tipo_doc.' '.$ve->serie.' - '.$ve->correlativo.'</a>';
                                        }else{ ?>
                                        {!!link_to_route('ventas.edit', $title  = $tipo_doc.' '.$ve->serie.' - '.$ve->correlativo, $parameters = $ve->id, $attributes = ['class'=>'btn-link '] )!!}
                                        <?php } ?>
                                    </td>
                                    <td>{{$ve->cliente}}</td>
                                    <td>{{$ve->total}}</td>
                                    <td>{{$ve->fecha}}</td>
                                    <td>{{$ve->estado}}</td>
                                    <td>{{$ve->user_creado}}</td>
                                    <td>
                                        {!!link_to_route('ventas.edit', $title  = 'Anular', $parameters = $ve->id, $attributes = ['class'=>'btn-link delItem ','id'=>$ve->id] )!!}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!!$venta->render()!!}

                    </div>
                </div>
            </div>
        </div>
        <!-- row -->

    </div>

<div class="hidden">
{!!Form::open(['route'=>'delventa.store','method'=>'POST','id'=>'frmDel' ])!!}
    {!!Form::text('id',null,['class'=>'form-control ','id'=>'id'])!!}
    {!!Form::text('motivo_anular',null,['class'=>'form-control ','id'=>'motivo_anular'])!!}
    {!!Form::text('id_user_anula','1',['class'=>'form-control ','id'=>'id_user_anula'])!!}
    {!!Form::text('user_anula',Auth::User()->user,['class'=>'form-control ','id'=>'user_anula'])!!}
{!!Form::close()!!}
</div>

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

    {!!Html::script('js/custom/ventas.js')!!}

@endsection

@stop