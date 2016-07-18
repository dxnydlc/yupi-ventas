@extends('layouts.principal')

@section('titulo')
    Farmacia | update Inventario
@stop

@section('losCSS')
    
    {!!Html::style('js/data_table/datatables.min.css')!!}
    {!!Html::style('js/alertify/css/themes/bootstrap.css')!!}

    {!!Html::style('js/sweet-alert/dist/sweetalert.css')!!}

    {!!Html::style('js/datepicker/css/bootstrap-datepicker.css')!!}

@endsection


@section('jsHeader')
<script>
    var _totalDoc = 0;
</script>
@endsection


@section('content')

	<div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Ventas <small>Agregando un nuevo documento</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                        	<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                                <li><a href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <br />
                    @include('alertas.userRequest')
                    
                    {!!Form::model($data['inventario'],['route'=>['inventario.update',$data['inventario']->id],'method'=>'PUT','autocomplete'=>'off', 'class' => 'form-horizontal form-label-left' ,'data-parsley-validate', 'id' => 'frmHeader' ])!!}
                        <input type="hidden" name="estado" id="estado" value="CER" >
                    	@include('inventario.forms.frmHeader')

                    	<div class="ln_solid"></div>

                        <div class="form-group">
                            <div class="col-lg-12">
                                <a id="addProds" class="btn btn-default "><i class="fa fa-plus"></i> Agregar Productos</a>
                            </div>
                        </div>
                        <!-- /form-group -->

                        <!-- Buscar producto -->
                        @include('inventario.forms.frmGrid')
                        <!-- /Buscar producto -->

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Productos <small id="todoTren">Actualmente en el documento</small></h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="#">Settings 1</a>
                                                </li>
                                                <li><a href="#">Settings 2</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">

                                    <table class="table table-condensed" id="tblItems" >
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Producto</th>
                                                <th>Lote</th>
                                                <th>Laboratorio</th>
                                                <th>Vence</th>
                                                <th class="fuente-r" >Compra</th>
                                                <th class="fuente-r" >Venta</th>
                                                <th class="fuente-r" >Stock</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $o = 1; $totalDoc = 0; ?>
                                        @foreach($data['items'] as $items)
                                        <?php
                                        list($anio,$mes,$dia) = explode('-', $items->vencimiento );
                                        $fecha = $dia.'/'.$mes.'/'.$anio;
                                        ?>
                                            <tr id="TR{{$items->id}}" >
                                                <th scope="row">{{$o}}</th>
                                                <th class="fuente-l tdTabla" id="TD{{$o}}" tdnombre="{{$items->producto}}" tdidProd="{{$items->id}}" >{{$items->producto}}<br><small>Lote:{{$items->lote}}, Vence: {{$fecha}}</small></th>
                                                <td class="fuente-r tdTabla" >{{$items->lote}}</td>
                                                <td class="fuente-r tdTabla" >{{$items->laboratorio}}</td>
                                                <td class="fuente-r tdTabla" >{{$fecha}}</td>
                                                <td class="fuente-r tdTabla" >{{$items->compra}}</td>
                                                <td class="fuente-r tdTabla" >{{$items->venta}}</td>
                                                <td class="fuente-r tdTabla" >{{$items->stock}}</td>
                                                <td callback="del" tdnombre="{{$items->producto}}" tdidProd="{{$items->id}}" >
                                                    <a id="delProd" tdnombre="{{$items->producto}}" tdidProd="{{$items->id}}" href="#" class="btn btn-danger"  ><span class="glyphicon glyphicon-minus" ></span></a>
                                                </td>
                                            </tr>
                                            <?php $o++;?>
                                        @endforeach
                                       
                                            <tr id="newRow" >
                                                <th scope="row">#</th>
                                                <td callback="prod" id="TD{{$o}}" class="" >- Producto -</td>
                                                <td id="nwLote" callback="lte" >- Lote -</td>
                                                <td id="nwlaboratorio" callback="lab" >- Laboratorio -</td>
                                                <td id="nwVcto" callback="vcto" >- Vence -</td>
                                                <td id="nwCompra" callback="comp" >- Compra -</td>
                                                <td id="nwVenta" callback="vta" >- Venta -</td>
                                                <td id="nwStock" callback="stock" >- Stock -</td>
                                                <td callback="ok">
                                                    <a href="#" class="btn btn-success" ><span class="glyphicon glyphicon-ok" ></span></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    



                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 ">
                                <a href="/ventas" class="btn btn-default">Cancelar</a>
                                <?php if( count($data['items']) > 0 ){ ?>
                                <button id="btnCerrarDoc" type="submit" class="btn btn-success btn-lg ">Cerrar Documento</button>
                                <?php } ?>
                            </div>
                        </div>

                    {!!Form::close()!!}

                </div>
            </div>
        </div>
        
    </div>

<div class="">
{!!Form::open(['route'=>'detalleInv.store','method'=>'post','id'=>'frmDetalle' ])!!}
    <input type="text" name="id_inventario" id="id_inventario" value="<?php echo $data["inventario"]->id; ?>" placeholder="id_venta" />
    <input type="text" name="producto" id="producto" value="" placeholder="producto" />
    <input type="text" name="id_producto" id="id_producto" value="" placeholder="id_producto" />
    
    <input type="text" name="token" id="token" value="" placeholder="token" />
    
    <input type="text" name="lote" id="lote" value="" placeholder="lote" />
    <input type="text" name="laboratorio" id="laboratorio" value="" placeholder="laboratorio" />
    <input type="text" name="vencimiento" id="vencimiento" value="" placeholder="vencimiento" />
    <input type="text" name="compra" id="compra" value="" placeholder="compra" />
    <input type="text" name="venta" id="venta" value="" placeholder="venta" />
    
    <input type="text" name="stock" id="stock" value="" placeholder="stock" />

{!!Form::close()!!}
</div>

<!-- Datepicker -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Seleccione Fecha</h4>
      </div>
      <div class="modal-body">
        <div id="datePicker" ></div>
        <input type="hidden" id="vencimientoFecha" >
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button id="addFecha" type="button" class="btn btn-primary">Agregar</button>
      </div>
    </div>
  </div>
</div>



<!-- Modal para agregar producto -->
<div class="modal fade" id="frmNuevoProd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Agregar producto no existente</h4>
      </div>
      <div class="modal-body">
        {!!Form::open(['route'=>'detventa.store','method'=>'post','id'=>'frmProductoLote' ])!!}
            <input type="hidden" name="tokenPL" id="tokenPL" />
            <div class="col-md-4 col-sm-3 col-xs-12 form-group has-feedback">
                {!!Form::label('lt_producto','Producto:' , ['class' => 'control-label ' ] )!!}
                {!!Form::text('lt_producto','',['class'=>'form-control ','id'=>'lt_producto'])!!}
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
        {!!Form::close()!!}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button id="addProdLote" type="button" class="btn btn-primary">Guardar cambios</button>
      </div>
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

    {!!Html::script('js/data_table/datatables.js')!!}
    {!!Html::script('js/sweet-alert/dist/sweetalert.js')!!}

    {!!Html::script('js/keynaigator/keynavigator.js')!!}
    <!--{!!Html::script('js/keynaigator/require.min.js')!!}-->

    {!!Html::script('js/datepicker/js/bootstrap-datepicker.js')!!}
    {!!Html::script('js/datepicker/locales/bootstrap-datepicker.es.min.js')!!}

    {!!Html::script('js/custom.js')!!}

    {!!Html::script('js/custom/addInventario.js')!!}



    

@endsection

@stop
