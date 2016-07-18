<?php

namespace yupiventas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class inventario_Detalle extends Model
{
    use SoftDeletes;
    protected $table = 'inventario_detalle';
    protected $primaryKey = 'id';

    protected $fillable = ['id_inventario','producto','id_producto','lote','laboratorio','vencimiento','compra','venta','stock'];
    protected $dates = ['deleted_at'];
}
