@extends('layouts.principal')

@section('titulo')
    Farmacia | invoice Ventas
@stop

@section('losCSS')
    
    {!!Html::style('js/data_table/datatables.min.css')!!}
    {!!Html::style('js/alertify/css/themes/bootstrap.css')!!}

    {!!Html::style('js/sweet-alert/dist/sweetalert.css')!!}

    {!!Html::style('js/datepicker/css/bootstrap-datepicker.css')!!}

@endsection

@section('content')



    <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Resumen de ventas</h3>
                </div>

                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search for...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">Go!</button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Reporte de ventas <small>Ventas del usuario actual</small></h2>
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

                            <section class="content invoice">
                                <!-- title row -->
                                <div class="row" id="filtroBusqueda" >
                                    <div class="col-xs-4 invoice-header">
                                        <div class="input-daterange input-group" id="datepicker">
                                            <input type="text" class="input-sm form-control" name="inicio" id="inicio" value="<?php echo $response['inicio']; ?>" />
                                            <span class="input-group-addon">Hasta</span>
                                            <input type="text" class="input-sm form-control" name="fin" id="fin" value="<?php echo $response['fin']; ?>" />
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="input-group">
                                            <input type="text" class="form-control hidden ">
                                                {!!Form::select('cbousuario', $response['users'] ,null,[ 'id' => 'cbousuario', 'placeholder'=>'Todos', 'class'=>'form-control '])!!}
                                            <span class="input-group-btn">
                                                <button id="btnBuscarFiltro" class="btn btn-primary" type="button">Buscar</button> 
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-xs-4 invoice-header hidden ">
                                        <h1>
                                            <!--<i class="fa fa-globe"></i> -->
                                            <small class="pull-right">Fecha: </small>
                                        </h1>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- info row -->
                                
                                <!-- /.row -->

                                <!-- Table row -->
                                <div class="row">
                                    <div class="col-xs-12 table">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
				                                    <th>Documento</th>
				                                    <th>Cliente</th>
				                                    <th class="text-right" >Total</th>
				                                    <th>Fecha</th>
				                                    <th>Estado</th>
				                                    <th>Usuario</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php $o = 1; $totalDoc = 0; ?>
                                            @foreach($response['data'] as $ve)
			                                <?php
			                                $tipo_doc = $ve->tipo_doc;
			                                ?>
			                                <tr id="fila_{{$ve->id}}" >
			                                    <th scope="row">{{$ve->id}}</th>
			                                    <td>
			                                        <?php if( $ve->estado == 'Cerrado' ){ 
			                                            echo '<a href="/invoice_venta/'.$ve->id.'" >'.$tipo_doc.' '.$ve->serie.' - '.$ve->correlativo.'</a>';
			                                        }else{
			                                            echo $tipo_doc.' '.$ve->serie.' - '.$ve->correlativo;
			                                        } ?>
			                                    </td>
			                                    <td>{{$ve->cliente}}</td>
			                                    <td class="text-right" >{{$ve->total}}</td>
			                                    <td>{{$ve->fecha}}</td>
			                                    <td>{{$ve->estado}}</td>
			                                    <td>{{$ve->user_creado}}</td>
			                                </tr>
			                                <?php $totalDoc = $totalDoc + $ve->total; ?>
			                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->


                                <div class="row">
                                    <!-- accepted payments column -->
                                    <div class="col-xs-6">
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-xs-6">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <th>Total:</th>
                                                        <td class="text-right" >{{$totalDoc}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->



                                <!-- this row will not appear when printing -->
                                <div class="row no-print">
                                    <div class="col-xs-12">
                                        <!--<button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>-->
                                        <!--<button class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment</button>-->

                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>




<div class="row">
    <div class="col-lg-2 col-lg-offset-1 " >
        <a href="/ventas" class="btn btn-default btn-lg btn-block" >Regresar</a>
    </div>
</div>

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

    {!!Html::script('js/custom/funciones.js')!!}

    {!!Html::script('js/custom/reportes_usuario.js')!!}

@endsection

@stop
