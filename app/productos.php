<?php

namespace yupiventas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use DB;

class productos extends Model
{
	use SoftDeletes;
    protected $table = 'productos';
    protected $primaryKey = 'id_producto';

    protected $fillable = ['nombre','descripcion','id_categoria','categoria','id_marca','marca','id_clase','clase','laboratorio','id_proveedor','proveedor','destacado'];
    protected $dates = ['deleted_at'];

    public function scopeNombre( $query , $nombre )
    {
    	if( trim( $nombre ) != '' )
    	{
	    	$query->where( "nombre" , "LIKE" ,"%".$nombre."%" );
    	}
    }
}
