<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    protected $table='inventarios';
    protected $fillable=['producto','cantidad','numero_lote','fecha_vencimiento','precio'];
    protected $guarded=['id'];
}
