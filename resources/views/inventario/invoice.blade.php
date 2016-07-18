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
                    <h3>Invoice <small>Resultado de inventario</small></h3>
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
                            <h2>Invoice Design <small>Sample user invoice design</small></h2>
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
                                <div class="row">
                                    <div class="col-xs-12 invoice-header">
                                        <h1>
                                <i class="fa fa-globe"></i>
                                <small class="pull-right">Fecha: {{ $data['inventario']->fecha }}</small>
                            </h1>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- info row -->
                                <div class="row invoice-info">
                                    <div class="col-sm-4 invoice-col">
                                        De
                                        <address>
                                <strong>{{ $data['empresa']->empresa }}</strong>
                                <br>{{ $data['empresa']->direccion }}
                                <br>Teléfono: {{ $data['empresa']->telefono }}
                                <br>Email: {{ $data['empresa']->email }}
                            </address>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 invoice-col">
                                        Cliente
                                        <address>
                                <strong>.</strong>
                                <br>
                            </address>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 invoice-col">
                                        <b>Invoice #{{ $data['inventario']->id }}</b>
                                        <br>
                                        <b>Fecha de Pago:</b> {{ $data['inventario']->fecha }}
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <!-- Table row -->
                                <div class="row">
                                    <div class="col-xs-12 table">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Producto</th>
                                                    <th>Lote #</th>
                                                    <th>Vencimiento</th>
                                                    <th class="fuente-r " >Compra</th>
                                                    <th class="fuente-r " >Venta</th>
                                                    <th class="fuente-r " >Stock</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php $o = 1; $totalDoc = 0; ?>
                                            @foreach($data['items'] as $items)
                                                <?php
                                                list($anio,$mes,$dia) = explode('-', $items->vencimiento );
                                                $fecha = $dia.'/'.$mes.'/'.$anio;
                                                ?>
                                                <tr>
                                                    
                                                    <td class="fuente-l tdTabla" >{{$items->producto}}<br/><small>{{$items->laboratorio}}</small></td>
                                                    <td class="fuente-l tdTabla" >{{$items->lote}}</td>
                                                    <td class="fuente-r tdTabla" >{{$fecha}}</td>
                                                    <td class="fuente-r tdTabla" >{{$items->compra}}</td>
                                                    <td class="fuente-r tdTabla" >{{$items->venta}}</td>
                                                    <td class="fuente-r tdTabla" >{{$items->stock}}</td>
                                                </tr>
                                                <?php $o++; ?>
                                            @endforeach
                                            <?php 
                                            #Calculando montos
                                            $totalDoc = number_format($totalDoc,2); $igv = ($totalDoc * 18) / 100;
                                            $subtotal = $totalDoc - $igv; 
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->


                                <!-- this row will not appear when printing -->
                                <div class="row no-print">
                                    <div class="col-xs-12">
                                        <!--<button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>-->
                                        <!--<button class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment</button>-->
                                        <!--<a href="/invoice_venta_pdf/{{ $data['inventario']->id }}" class="btn btn-success pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</a>-->
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
        <a href="/inventario" class="btn btn-default btn-lg btn-block" >Regresar</a>
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

    {!!Html::script('js/custom/addInventario.js')!!}

    {!!Html::script('js/custom/funciones.js')!!}

    

@endsection

@stop
