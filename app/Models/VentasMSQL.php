<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VentasMSQL extends Model{
    protected $connection = 'mysql';
    protected $table = 'ventas';
    protected $fillable = ['id'];
    protected $hidden = ['created_at','updated_at'];

    public function Categoria(){
        return $this->hasOne('App\Models\CategoriaProductosMSQL', 'id', 'categoria');
    }
}
