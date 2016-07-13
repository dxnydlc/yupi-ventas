<?php

namespace yupiventas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class kardex extends Model
{
    use SoftDeletes;
    protected $table = 'kardex';
    protected $primaryKey = 'id';

    protected $fillable = ['id_link','movimiento','fecha','id_producto','producto','id_persona','persona','documento','numero_doc','cantidad_e','precio_e','valor_e','cantidad_s','precio_s','valor_s','cantidad_f','precio_f','valor_f','id_user','usuario'];
    protected $dates = ['deleted_at'];

    public function getFechaAttribute($valor)
    {
    	if( $valor != '' )
    	{
    		list($anio,$mes,$dia) = explode('-', $valor );
    		$fecha = $dia.'/'.$mes.'/'.$anio;
    		return $fecha;
    	}
    }

    

    public function getDocumentoAttribute($valor)
    {
        if( $valor != '' )
        {
            switch ($valor) {
                case 'PE':
                    return 'Part.Ent';
                break;
                case 'VE':
                    return 'Ventas';
                break;
            }
        }
    }




    public function setFechaAttribute($valor)
    {
        if( $valor != '' )
        {
            /*list($dia,$mes,$anio) = explode('/', $valor );
            $fecha = $anio.'-'.$mes.'-'.$dia;
            $this->attributes['fecha'] = $fecha;*/
        }
    }



    public function getMovimientoAttribute($valor)
    {
        if( $valor != '' )
        {
            switch ($valor) {
                case 'E':
                    return 'Entrada';
                break;
                case 'S':
                    return 'Salida';
                break;
            }
        }
    }




}

