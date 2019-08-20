<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientesMSQL extends Model{
    protected $connection = 'mysql';
    protected $table = 'clientes';
    protected $fillable = ['id'];
    protected $hidden = ['created_at','updated_at'];
}
