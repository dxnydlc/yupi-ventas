<div id="frmBuscarProds" class="col-md-12 col-sm-12 col-xs-12"  >
    <div class="panel panel-primary">
        <div class="panel-heading">Buscar productos</div>
        <div class="panel-body">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Productos <small>buscar poductos con lote asignado</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="#" data-toggle="modal" data-target="#frmNuevoProd" ><span class="glyphicon glyphicon-plus" ></span> Agregar nuevo producto</a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">


                    {!!Form::open(['route'=>'detventa.store','method'=>'post','id'=>'frmBuscarProdLte' , 'class' => 'form-horizontal form-label-left' ])!!}
                        <div class="divider-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Buscar producto</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="textoProd" name="textoProd" >
                                    <span class="input-group-btn">
                                        <button id="btnBuscarProdLte" class="btn btn-primary" type="button">Buscar</button> 
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="divider-dashed"></div>
                    {!!Form::close()!!}



                    <table class=" table table-bordered " id="tblProductosWWQ">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Lote</th>
                                <th>Lab.</th>
                                <th>Vencimiento</th>
                                <th>Precio</th>
                                <th>Stock</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data['productos'] as $producto)
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
                                <td>
                                    <a href="#" class=" btn btn-success addProdItem deaPrecio " tdnombre="{{$producto->nombre}}" tdid="{{$producto->id_producto}}" tdlab="{{$producto->laboratorio}}" tdfecha="{{$fecha}}" tdprecio="{{$producto->precio}}" tdlote="{{$producto->lote}}" ><span class="fa fa-check" ></span></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>