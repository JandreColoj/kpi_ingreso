<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration{
 
    public function up(){
        Schema::create('clientes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tipoCliente');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('telefono');            
            $table->string('direccion');            
            $table->integer('estado')->default(1);
            $table->timestamps();
        });

        Schema::create('categoria_producto', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('descripcion')->nullable();            
            $table->integer('estado')->default(1);
            $table->timestamps();
        });

        Schema::create('productos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('descripcion');
            $table->string('precio');
            $table->string('existencia');            
            $table->string('categoria');            
            $table->integer('estado')->default(1);
            $table->timestamps();
        });
        
        Schema::create('ventas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_cliente');
            $table->dateTime('fecha_transaccion');
            $table->string('currency');
            $table->string('Total');         
            $table->integer('estado')->default(1);
            $table->timestamps();
        });
       
        Schema::create('detalle_venta', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_transaccion');
            $table->integer('cantidad');         
            $table->integer('id_producto');
            $table->integer('estado')->default(1);
            $table->timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('clientes');
        Schema::dropIfExists('categoria_producto');
        Schema::dropIfExists('productos');
        Schema::dropIfExists('ventas');
        Schema::dropIfExists('detalle_venta');
    }
}
