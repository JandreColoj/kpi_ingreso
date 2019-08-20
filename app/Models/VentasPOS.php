<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VentasPOS extends Model{
    protected $connection = 'pgsql';
    protected $table = 'ventas';
    protected $fillable = ['id'];
    protected $hidden = ['created_at','updated_at'];

    public function Categoria(){
        return $this->hasOne('App\Models\CategoriaProductosPOS', 'id', 'categoria');
    }
}
