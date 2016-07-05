<?php

namespace yupiventas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class detalle_pre_venta extends Model
{
    use SoftDeletes;
    protected $table = 'detalle_pre_venta';
    protected $primaryKey = 'id';

    protected $fillable = ['producto','id_producto','cantidad','precio','total','descuento','id_user','usuario','token'];
    protected $dates = ['deleted_at'];

    public function getVencimientoAttribute($valor)
    {
    	if( $valor != '' )
    	{
    		list($anio,$mes,$dia) = explode('-', $valor );
    		$fecha = $dia.'/'.$mes.'/'.$anio;
    		return $fecha;
    	}
    }
}
