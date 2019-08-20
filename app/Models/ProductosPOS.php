<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductosPOS extends Model{
    protected $connection = 'pgsql';
    protected $table = 'productos';
    protected $fillable = ['id'];
    protected $hidden = ['created_at','updated_at'];

    public function Categoria(){
        return $this->hasOne('App\Models\CategoriaProductosPOS', 'id', 'categoria');
    }
}
