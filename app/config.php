<?php

namespace yupiventas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class config extends Model
{
    use SoftDeletes;
    protected $table = 'config';
    protected $primaryKey = 'id';

    protected $fillable = ['empresa','ruc','direccion','telefono','email','serie_boleta','correlativo_boleta','serie_factura','correlativo_factura'];
    protected $dates = ['deleted_at'];
}
