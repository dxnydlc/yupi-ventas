
<div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
    {!!Form::label('nombre','Nombre (*):' , ['class' => 'control-label ' ] )!!}
	{!!Form::text('nombre',$data["nombre"],['class'=>'form-control '])!!}
	<i class="glyphicon glyphicon-edit form-control-feedback"></i>
</div>

<div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
    {!!Form::label('fecha','Fecha (*):' , ['class' => 'control-label ' ] )!!}
    {!!Form::text('fecha',$data["fecha"],['class'=>'form-control '])!!}
    <i class="glyphicon glyphicon-calendar form-control-feedback"></i>
</div>
