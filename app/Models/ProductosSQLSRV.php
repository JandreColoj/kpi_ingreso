<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductosSQLSRV extends Model{
    protected $connection = 'sqlsrv';
    protected $table = 'productos';
    protected $fillable = ['id'];
    protected $hidden = ['created_at','updated_at'];

    public function Categoria(){
        return $this->hasOne('App\Models\CategoriaProductosSQLSRV', 'id', 'categoria');
    }
}
