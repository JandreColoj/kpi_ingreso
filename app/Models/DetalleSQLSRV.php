<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleSQLSRV extends Model{
    protected $connection = 'sqlsrv';
    protected $table = 'detalle_venta';
    protected $fillable = ['id'];
    protected $hidden = ['created_at','updated_at'];

}
