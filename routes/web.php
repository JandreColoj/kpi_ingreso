<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::get('/registrar', function () {
    return view('auth.register');
});

Route::get('/info', function () {
    return view('info');
});

Route::get('/logout',function(){
    Auth::logout();
    return redirect('/login');
});

Route::get('/', 'HomeController@index');
Route::get('', 'HomeController@index');
Route::get('home', 'HomeController@index');


Route::group(['middleware' => ['auth']], function(){

    Route::get('/clientes', function () {
        return view('clientes');
    });    

    Route::get('/productos', function () {
        return view('productos');
    });    

    Route::get('/usuarios', function () {
        return view('usuarios');
    });

    Route::get('/venta', function () {
        return view('venta');
    });

    Route::group(['prefix' => 'api/'], function(){
       Route::post('getClientes', 'KpiController@getClientes');
       Route::post('getProductos', 'KpiController@getProductos');
       Route::post('getVentasDia', 'KpiController@getVentasDia'); 
       Route::post('getVentasMes', 'KpiController@getVentasMes');  
       Route::post('getProductosModa', 'KpiController@getProductosModa');  
       Route::post('getUsuarios', 'UsuariosController@getUsuarios'); 
       
        Route::group(['prefix' => 'cliente/'], function(){
            Route::post('create', 'GeneralController@createCliente');
            Route::post('editar', 'GeneralController@editarCliente'); 
            Route::post('eliminar', 'GeneralController@eliminarCliente'); 
        });
       
        Route::group(['prefix' => 'producto/'], function(){
            Route::post('create', 'GeneralController@createProducto');
            Route::post('editar', 'GeneralController@editarProducto');
            Route::post('eliminar', 'GeneralController@eliminarProducto');
        });
       
        Route::group(['prefix' => 'venta/'], function(){
            Route::post('register', 'GeneralController@registerVenta');
        });

    });
 
 });
