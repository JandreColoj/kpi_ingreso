<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaProductosPOS extends Model{
    protected $connection = 'pgsql';
    protected $table = 'categoria_producto';
    protected $fillable = ['id'];
    protected $hidden = ['created_at','updated_at'];
}
