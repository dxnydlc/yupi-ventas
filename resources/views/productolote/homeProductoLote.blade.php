@extends('layouts.principal')

@section('titulo')
    Farmacia | Producto Lote
@stop

@section('losCSS')
    {!!Html::style('js/alertify/css/alertify.css')!!}
    {!!Html::style('js/alertify/css/themes/bootstrap.css')!!}
    {!!Html::style('js/jchosen/chosen.min.css')!!}

    {!!Html::style('js/datepicker/css/bootstrap-datepicker.css')!!}
@endsection

@section('content')

<input type="hidden" id="token" value="{{ csrf_token() }}" >
    <div class="">

        <div class="page-title">
            <div class="title_left">
                <h3>
			        Producto
			        <small>
			            Producto que contienen un lote asignado
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

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                    <ul class="list-inline">
                        <li>
                            <a href="/ex_prodlote" class="btn btn-success "><span class="glyphicon glyphicon-floppy-save" ></span> Exportar</a>
                        </li>
                        <li>
                            <a href="#" data-toggle="modal" class="btn btn-primary " data-target="#frmNuevoProd" ><span class="glyphicon glyphicon-plus" ></span> Agregar nuevo Producto Lote</a>
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
                        <h2>Producto Lote <small>mostrando todos los registros activos</small></h2>
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
	                                <th>Nombre</th>
	                                <th>Lote</th>
	                                <th>Lab.</th>
	                                <th>Vencimiento</th>
	                                <th>Precio</th>
	                                <th>Stock</th>
	                                <th>Tipo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['data'] as $producto)
	                            <?php
	                            list($anio,$mes,$dia) = explode('-', $producto->vencimiento );
	                            $fecha = $dia.'/'.$mes.'/'.$anio;
	                            ?>
	                            <tr tdnombre="{{$producto->nombre}}" tdid="{{$producto->id_producto}}" tdlab="{{$producto->laboratorio}}" tdfecha="{{$fecha}}" tdprecio="{{$producto->precio}}" tdlote="{{$producto->lote}}" class=" deaPrecio " >
	                                <th scope="row">{{$producto->id_producto}}</th>
	                                <td class="CRUD"  >
	                                    {{$producto->nombre}}
	                                </td>
	                                <td>{{$producto->lote}}</td>
	                                <td>{{$producto->laboratorio}}</td>
	                                <td>{{$fecha}}</td>
	                                <td class="text-right" >{{$producto->precio}}</td>
	                                <td class="text-right" >{{$producto->stock}}</td>
	                                <td>{{$producto->clase}}</td>
	                            </tr>
	                            @endforeach
                            </tbody>
                        </table>
                        {{$data['data']->render()}}

                    </div>
                </div>
            </div>
        </div>
        <!-- row -->

    </div>

    <!-- footer content -->
    @include('layouts.footer')
    <!-- /footer content -->



<!-- Modal para agregar producto -->
<div class="modal fade" id="frmNuevoProd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Unir un producto con un lote</h4>
      </div>

      {!!Form::open(['route'=>'productolote.store','method'=>'post','id'=>'frmProductoLote' ])!!}
      <div class="modal-body">
            <input type="hidden" name="tokenPL" id="tokenPL" />
            <div class="col-md-8 col-sm-3 col-xs-12 form-group has-feedback">
                {!!Form::label('lt_producto','Producto:' , ['class' => 'control-label ' ] )!!}
                {!!Form::select('lt_producto', $data['prds'] ,null,[ 'id' => 'lt_producto', 'rel' => 'producto', 'placeholder'=>'Seleccione','class'=>'form-control combito'])!!}
            </div><!-- /form-group -->
            <div class="col-md-4 col-sm-3 col-xs-12 form-group has-feedback">
                {!!Form::label('lt_laboratorio','Laboratorio:' , ['class' => 'control-label ' ] )!!}
                {!!Form::text('lt_laboratorio','',['class'=>'form-control ','id'=>'lt_laboratorio'])!!}
            </div><!-- /form-group -->
            <div class="col-md-4 col-sm-3 col-xs-12 form-group has-feedback">
                {!!Form::label('lt_lote','Lote:' , ['class' => 'control-label ' ] )!!}
                {!!Form::text('lt_lote','',['class'=>'form-control ','id'=>'lt_lote'])!!}
            </div><!-- /form-group -->
            <div class="col-md-4 col-sm-3 col-xs-12 form-group has-feedback">
                {!!Form::label('lt_vencimiento','Vencimiento:' , ['class' => 'control-label ' ] )!!}
                {!!Form::text('lt_vencimiento','',['class'=>'form-control ','id'=>'lt_vencimiento'])!!}
            </div><!-- /form-group -->
            <div class="col-md-4 col-sm-3 col-xs-12 form-group has-feedback">
                {!!Form::label('lt_precio','Precio:' , ['class' => 'control-label ' ] )!!}
                {!!Form::text('lt_precio','',['class'=>'form-control ','id'=>'lt_precio'])!!}
            </div><!-- /form-group -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button id="addProdLote" type="submit" class="btn btn-primary">Guardar cambios</button>
      </div>
      {!!Form::close()!!}
    </div>
  </div>
</div>





@section('scripts')

    <!-- Aletify -->
    {!!Html::script('js/alertify/alertify.js')!!}

	<!-- icheck -->
    {!!Html::script('js/icheck/icheck.min.js')!!}

    <!-- bootstrap progress js -->
    {!!Html::script('js/progressbar/bootstrap-progressbar.min.js')!!}
    {!!Html::script('js/nicescroll/jquery.nicescroll.min.js')!!}

    {!!Html::script('js/custom.js')!!}

    {!!Html::script('js/datepicker/js/bootstrap-datepicker.js')!!}
    {!!Html::script('js/datepicker/locales/bootstrap-datepicker.es.min.js')!!}

    <!-- jChosen -->
    {!!Html::script('js/jchosen/chosen.jquery.min.js')!!}

    {!!Html::script('js/custom/productoLote.js')!!}

@endsection

@stop
