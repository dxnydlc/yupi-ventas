<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('logout','logController@logout');

Route::group(['middleware' => ['web']], function () {
    
    Route::resource('home','homeController');
    Route::resource('/','homeController');
    Route::resource('login','logController');

    #Categoria
    Route::resource('categoria','categoriaController');

    #Marca
    Route::resource('marca','marcaController');

    #Clase
    Route::resource('clase','claseController');

    #Proveedor
    Route::resource('proveedor','proveedorController');
    
    #Producto
    Route::resource('producto','productoController');

    #Buscar producto
    Route::get('buscarprod/{q}','productoController@buscar');

    #detalle parte de entrada
    Route::resource('detpe','detallePEController');

    #parte de entrada
    Route::resource('pe','peController');

    #Kardex
    Route::resource('kardex','kardexController');
    
    #ventas
    Route::resource('ventas','ventasController');

    Route::resource('allventas','allVentas');
    Route::resource('mb','ventasController@make_boleta');
    Route::resource('cliente','clientesController');
    Route::resource('detventa','detalle_ventaController');
    Route::resource('prodlote','prodlte');
    
    #Producto lote
    Route::resource('productolote','productoLoteController');
    Route::get('productolote_filtro/{q}','productoLoteController@buscador');

    Route::resource('delventa','delVenta');
    Route::resource('usuario','UsuarioController');
    Route::resource('config','configController');

    #Inventario
    Route::resource('inventario','inventarioController');
    Route::get('nuevo_inventario','inventarioController@make_inventario');
    Route::resource('detalleInv','detalleInvetarioController');

    #Exportar
    Route::resource('ex_ventas','exportDocs@all_ventas');
    Route::resource('ex_kardex','exportDocs@all_kardex');
    Route::resource('ex_prodlote','exportDocs@all_prodlote');

    #Invoices
    Route::get('invoice_venta/{id}','ventasController@invoice');
    Route::get('invoice_venta_pdf/{id}','ventasController@invoice_pdf');
    Route::get('invoice_inv/{id}','inventarioController@invoice_inventario');

    Route::get('invoice_pe/{id}','peController@invoice');
    Route::get('ventas_fecha/{fecha}','ventasController@venta_fecha');

    #Reportes venta x usuario
    Route::get('rep_venta_user','reportesController@ventas_user');

    #Reporte de ventas filtrado por fecha de inico y fecha de fin
    Route::get('rep_venta_user_fil/{inicio}/{fin}/{userf}','reportesController@ventas_user_filtro');

    #Reporte producto x usuario
    Route::get('rep_prod_user','reportesController@producto_usuario');

    #Reporte producto x usuario filtro fecha
    Route::get('rep_prod_user_fil/{inicio}/{fin}/{userf}','reportesController@producto_usuario_filtro');

    #Reporte producto margen de ventas
    Route::get('rep_prod_margen','reportesController@producto_margen');

    #Reporte producto margen de ventas filtro
    Route::get('rep_prod_margen_filtro/{inicio}/{fin}','reportesController@producto_margen_filtro');
    
});

