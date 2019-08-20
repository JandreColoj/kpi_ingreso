<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetallePOS extends Model{
    protected $connection = 'pgsql';
    protected $table = 'detalle_venta';
    protected $fillable = ['id'];
    protected $hidden = ['created_at','updated_at'];

}
