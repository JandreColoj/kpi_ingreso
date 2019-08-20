<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientesPOS extends Model{
    protected $connection = 'pgsql';
    protected $table = 'clientes';
    protected $fillable = ['id'];
    protected $hidden = ['created_at','updated_at'];
}
