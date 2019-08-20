<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaProductosSQLSRV extends Model{
    protected $connection = 'sqlsrv';
    protected $table = 'categoria_producto';
    protected $fillable = ['id'];
    protected $hidden = ['created_at','updated_at'];
}
