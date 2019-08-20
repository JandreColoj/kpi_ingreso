<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientesSQLSRV extends Model{
    protected $connection = 'sqlsrv';
    protected $table = 'clientes';
    protected $fillable = ['id'];
    protected $hidden = ['created_at','updated_at'];
}
