<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientesMSQL; 
use App\Models\ProductosMSQL; 
use App\Models\VentasMSQL; 
use App\Models\DetalleMSQL; 
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GeneralController extends Controller{
    
   public function createCliente(Request $request){
      
      $cliente = new ClientesMSQL;
      $cliente->tipoCliente = $request->tipoCliente;
      $cliente->nombre      = $request->nombre;
      $cliente->apellido    = $request->apellido;
      $cliente->direccion   = $request->direccion;
      $cliente->telefono    = $request->telefono;
      $cliente->save();

      return response()->json(['clientes' => $cliente ],200);
   }
   
   public function createProducto(Request $request){

      $producto = new ProductosMSQL;
      $producto->categoria   = $request->categoria;
      $producto->nombre      = $request->nombre;
      $producto->descripcion = $request->descripcion;
      $producto->precio      = $request->precio;
      $producto->existencia  = $request->existencia;
      $producto->save();

      return response()->json(['producto' => $producto ],200);
   }

   public function registerVenta(Request $request){

      $producto = ProductosMSQL::find($request->producto);

      $fecha =new \DateTime($request->fecha);

      $ventas = new VentasMSQL;
      $ventas->id_cliente        = $request->cliente;
      $ventas->fecha_transaccion = $fecha;
      $ventas->currency          = $request->moneda;
      $ventas->Total             = $producto->precio*$request->cantidad;
      $ventas->estado            = 1; 
      $ventas->save();

      $detalle = new DetalleMSQL;
      $detalle->id_transaccion = $ventas->id;
      $detalle->cantidad       = $request->cantidad;
      $detalle->id_producto    = $request->producto;
      $detalle->estado         = 1;
      $detalle->save();

      return response()->json(['venta' => $ventas ],200);
   }

   public function editarCliente(Request $request){

      // return $request->all();

      $cliente = ClientesMSQL::find($request->id); //->update

      $cliente->fill(['nombre'=> $request->nombre, 'telefono'=>$request->telefono]);
      $cliente->save();

      return response()->json(['clientes' => $cliente ],200);
   }  
   
   public function eliminarCliente(Request $request){

      $cliente = ClientesMSQL::find($request->id)->delete(); //->update

      return response()->json(['clientes' => $cliente ],200);
   }  

   public function editarProducto(Request $request){

      $producto = ProductosMSQL::find($request->id); //->update

      $producto->fill([
         'nombre'      => $request->nombre, 
         'descripcion' => $request->descripcion,
         'precio'      => $request->precio,
         'existencia'  => $request->existencia
      ]);
      $producto->save();

      return response()->json(['producto' => $producto ],200);
   }  

   public function eliminarProducto(Request $request){

      $producto = ProductosMSQL::find($request->id)->delete();

      return response()->json(['productos' => $producto ],200);
   }  

}
