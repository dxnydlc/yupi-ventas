<?php

namespace yupiventas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class inventario extends Model
{
    use SoftDeletes;
    protected $table = 'inventario';
    protected $primaryKey = 'id';

    protected $fillable = ['nombre','fecha','estado','id_user','usuario'];
    protected $dates = ['deleted_at'];

    public function setFechaAttribute($valor)
    {
        if( $valor != '' )
        {
            list($dia,$mes,$anio) = explode('/', $valor );
            $fecha = $anio.'-'.$mes.'-'.$dia;
            $this->attributes['fecha'] = $fecha;
        }
    }


    public function getFechaAttribute($valor)
    {
        if( $valor != '' )
        {
            list($anio,$mes,$dia) = explode('-', $valor );
            $fecha = $dia.'/'.$mes.'/'.$anio;
            return $fecha;
        }
    }

    public function getEstadoAttribute($valor)
    {
        switch ($valor) {
            case 'ACT':
                return 'Activo';
                break;
            case 'CER':
                return 'Cerrado';
                break;
            case 'DEL':
                return 'Anulado';
                break;
        }
    }

}
