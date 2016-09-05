<div class="form-group">
	{!!Form::label('nombre','Nombre (*):' , ['class' => 'control-label col-md-3 col-sm-3 col-xs-12' ] )!!}
    <div class="col-md-6 col-sm-6 col-xs-12">
    	{!!Form::text('nombre',null,['class'=>'form-control col-md-7 col-xs-12' , 'readonly'=>'readonly' ])!!}
    </div>
</div>

<div class="form-group">
	{!!Form::label('precio','Precio Venta (*):' , ['class' => 'control-label col-md-3 col-sm-3 col-xs-12' ] )!!}
    <div class="col-md-6 col-sm-6 col-xs-12">
    	{!!Form::text('precio',null,[ 'id' => 'precio', 'class'=>'form-control col-md-7 col-xs-12' ])!!}
    </div>
</div>

<div class="form-group">
	{!!Form::label('compra','Precio Compra (*):' , ['class' => 'control-label col-md-3 col-sm-3 col-xs-12' ] )!!}
    <div class="col-md-6 col-sm-6 col-xs-12">
    	{!!Form::text('compra',null,[ 'id' => 'compra', 'class'=>'form-control col-md-7 col-xs-12' ])!!}
    </div>
</div>

<div class="form-group">
	{!!Form::label('utilidad','Utilidad (*):' , ['class' => 'control-label col-md-3 col-sm-3 col-xs-12' ] )!!}
    <div class="col-md-6 col-sm-6 col-xs-12">
    	{!!Form::text('utilidad',null,[ 'id' => 'utilidad', 'class'=>'form-control col-md-7 col-xs-12' , 'readonly'=>'readonly' ])!!}
    </div>
</div>

<div class="form-group">
    {!!Form::label('stock','Stock (*):' , ['class' => 'control-label col-md-3 col-sm-3 col-xs-12' ] )!!}
    <div class="col-md-6 col-sm-6 col-xs-12">
        {!!Form::text('stock',null,[ 'id' => 'stock', 'class'=>'form-control col-md-7 col-xs-12'  ])!!}
    </div>
</div>

