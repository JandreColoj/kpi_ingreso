<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleMSQL extends Model{
    protected $connection = 'mysql';
    protected $table = 'detalle_venta';
    protected $fillable = ['id'];
    protected $hidden = ['created_at','updated_at'];

}
