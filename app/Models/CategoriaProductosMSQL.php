<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaProductosMSQL extends Model{
    protected $connection = 'mysql';
    protected $table = 'categoria_producto';
    protected $fillable = ['id'];
    protected $hidden = ['created_at','updated_at'];
}
