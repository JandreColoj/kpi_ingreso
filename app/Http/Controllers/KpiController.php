<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
#modelos mysql
use App\Models\ClientesMSQL;
use App\Models\ProductosMSQL;
use App\Models\VentasMSQL; 
use App\Models\DetalleMSQL; 
#modelos postgres
use App\Models\ClientesPOS;
use App\Models\ProductosPOS;
use App\Models\VentasPOS; 
use App\Models\DetallePOS; 
#modelos sql server
use App\Models\ClientesSQLSRV;
use App\Models\ProductosSQLSRV;
use App\Models\VentasSQLSRV;
use App\Models\DetalleSQLSRV;


use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KpiController extends Controller{
    
   public function getClientes(Request $request){
      $clientes = [];
      $cantidad_clientes = [];

      if ($request['db']=='Mysql') {

         $cantidad_clientes = ClientesMSQL::where('estado',1)->select('tipoCliente',\DB::raw('COUNT(id) as cantidad'))->groupBy('tipoCliente')->get();
         $clientes = ClientesMSQL::where('estado',1)->select('tipoCliente','nombre','apellido','telefono','id')->get();
      
      }else if($request['db']=='Postgres'){
         
         $cantidad_clientes = ClientesPOS::where('estado',1)->select('tipoCliente',\DB::raw('COUNT(id) as cantidad'))->groupBy('tipoCliente')->get();
         $clientes = ClientesPOS::where('estado',1)->select('tipoCliente','nombre','apellido','telefono','id')->get();

      }else if($request['db']=='SQLServer'){

      }else if($request['db']=='Oracle'){

      }

        return response()->json(['clientes' => $clientes, 'cantidad' => $cantidad_clientes],200);
   }

   public function getProductos(Request $request){

      $categorias = [];
      $productos = [];

      if ($request['db']=='Mysql') {

         $categorias = ProductosMSQL::join('categoria_producto','categoria_producto.id','=','productos.categoria')
                                    ->select('categoria_producto.nombre as categoria',
                                             \DB::raw('COUNT(productos.stock) as cantidad'))
                                    ->where('productos.estado',1)->groupBy('categoria')->get();
     
         $productos = ProductosMSQL::where('estado',1)->get();

      }else if($request['db']=='Postgres'){

         $categorias = ProductosPOS::join('categoria_producto','categoria_producto.id','=','productos.categoria')
                                    ->select('categoria_producto.nombre as categoria',
                                             \DB::raw('COUNT(productos.stock) as cantidad'))
                                    ->where('productos.estado',1)->groupBy('categoria')->get();

         $productos = ProductosPOS::where('estado',1)->get();

      }else if($request['db']=='SQLServer'){

      }else if($request['db']=='Oracle'){
      }

      return response()->json(['categorias' => $categorias, 'productos' => $productos],200);
   }

   public function getVentasDia(Request $request){

      $f_inicial = new \DateTime($request['finicio']);
      $f_final = new \DateTime($request['ffin']);
      $carbon0 = Carbon::instance($f_inicial);
      $carbon1 = Carbon::instance($f_final);
      $Ventas = [];

      $fini = Carbon::create($carbon0->year, $carbon0->month, $carbon0->day, 0,0,0);
      $ffin = Carbon::create($carbon1->year, $carbon1->month, $carbon1->day, 23,59,59);

      if ($request['db']=='Mysql') {

         $Ventas = VentasMSQL::whereBetween('fecha_transaccion', [$fini, $ffin])
                              ->select(
                                 \DB::raw('DATE_FORMAT(fecha_transaccion, "%d/%m") as dia'),
                                 \DB::raw('SUM(IF(currency = "GTQ",Total,0)) as gtq'),
                                 \DB::raw('SUM(IF(currency = "USD",Total,0)) as usd')
                              )
                              ->groupBy(\DB::raw('fecha_transaccion'))
                              ->orderBy('fecha_transaccion','asc')
                              ->get();
                              
      }else if($request['db']=='Postgres'){

         $Ventas = VentasPOS::whereBetween('fecha_transaccion', [$fini, $ffin])
                              ->select(
                                 \DB::raw('DATE_FORMAT(fecha_transaccion, "%d/%m") as dia'),
                                 \DB::raw('SUM(IF(currency = "GTQ",Total,0)) as gtq'),
                                 \DB::raw('SUM(IF(currency = "USD",Total,0)) as usd')
                              )
                              ->groupBy(\DB::raw('fecha_transaccion'))
                              ->orderBy('fecha_transaccion','asc')
                              ->get();

      }else if($request['db']=='SQLServer'){

      }else if($request['db']=='Oracle'){
      }


      $result = array();
      foreach($Ventas as $t) {
         $repeat=false;
         for($i=0;$i<count($result);$i++){

            if($result[$i]['dia']==$t['dia'])
            {
               $result[$i]['gtq']+=$t['gtq'];
               $result[$i]['usd']+=$t['usd'];
               $repeat=true;
               break;
            }
         }
         if($repeat==false)
            $result[] = array('dia' => $t['dia'], 'gtq' => $t['gtq'],'usd' => $t['usd']);
      }

      return response()->json(['ventas' => $result],200);
   }

   public function getVentasMes(Request $request){

      $f_inicial = new \DateTime($request['finicio']);
      $f_final = new \DateTime($request['ffin']);
      $carbon0 = Carbon::instance($f_inicial);
      $carbon1 = Carbon::instance($f_final);
      $Ventas = [];

      $fini=Carbon::create($carbon0->year, $carbon0->month, $carbon0->day, 0,0,0);
      $ffin=Carbon::create($carbon1->year, $carbon1->month, $carbon1->day, 23,59,59);

      if ($request['db']=='Mysql') {

         $Ventas = VentasMSQL::whereBetween('fecha_transaccion', [$fini, $ffin])
                              ->select(
                                 \DB::raw('DATE_FORMAT(fecha_transaccion, "%m/%y") as mes'),
                                 \DB::raw('SUM(IF(currency = "GTQ",Total,0)) as gtq'),
                                 \DB::raw('SUM(IF(currency = "USD",Total,0)) as usd')
                              )
                              ->groupBy(\DB::raw('fecha_transaccion'))
                              ->orderBy('fecha_transaccion','asc')
                              ->get();

      }else if($request['db']=='Postgres'){
         $Ventas = VentasPOS::whereBetween('fecha_transaccion', [$fini, $ffin])
                              ->select(
                                 \DB::raw('DATE_FORMAT(fecha_transaccion, "%m/%y") as mes'),
                                 \DB::raw('SUM(IF(currency = "GTQ",Total,0)) as gtq'),
                                 \DB::raw('SUM(IF(currency = "USD",Total,0)) as usd')
                              )
                              ->groupBy(\DB::raw('fecha_transaccion'))
                              ->orderBy('fecha_transaccion','asc')
                              ->get();
      }else if($request['db']=='SQLServer'){

      }else if($request['db']=='Oracle'){
      }

      $result = array();
      foreach($Ventas as $t) {
         $repeat=false;
         for($i=0;$i<count($result);$i++){

            if($result[$i]['mes']==$t['mes'])
            {
               $result[$i]['gtq']+=$t['gtq'];
               $result[$i]['usd']+=$t['usd'];
               $repeat=true;
               break;
            }
         }
         if($repeat==false)
            $result[] = array('mes' => $t['mes'], 'gtq' => $t['gtq'],'usd' => $t['usd']);
      }

      return response()->json(['ventas' => $result],200);
   }
    
   public function getProductosModa(Request $request){
     
      $f_inicial = new \DateTime($request['finicio']);
      $f_final = new \DateTime($request['ffin']);
      $inicial = Carbon::instance($f_inicial);
      $final   = Carbon::instance($f_final);
      $fecha_inicial = Carbon::create($inicial->year, $inicial->month, $inicial->day, 0,0,0);
      $fecha_final   = Carbon::create($final->year, $final->month, $final->day, 23,59,59);
      $productos = [];

      // return $fecha_inicial;
      if ($request['db']=='Mysql') {

         $productos = DetalleMSQL::join('productos', 'productos.id', '=', 'detalle_venta.id_producto')
                                 ->join('ventas', 'ventas.id', '=', 'detalle_venta.id_transaccion')
                                 ->select(
                                    'productos.nombre',
                                    \DB::raw("SUM(detalle_venta.cantidad) as cantidad")
                                    )
                                    ->whereBetween('ventas.fecha_transaccion', [$fecha_inicial, $fecha_final])
                                    ->groupBy('detalle_venta.id_producto')
                                    ->orderBy('cantidad', 'DESC')
                                    ->limit(10)->get();      

         }else if($request['db']=='Postgres'){

            $productos = DetallePOS::join('productos', 'productos.id', '=', 'detalle_venta.id_producto')
                                 ->join('ventas', 'ventas.id', '=', 'detalle_venta.id_transaccion')
                                 ->select(
                                    'productos.nombre',
                                    \DB::raw("SUM(detalle_venta.cantidad) as cantidad")
                                    )
                                    ->whereBetween('ventas.fecha_transaccion', [$fecha_inicial, $fecha_final])
                                    ->groupBy('detalle_venta.id_producto')
                                    ->orderBy('cantidad', 'DESC')
                                    ->limit(10)->get();  

         }else if($request['db']=='SQLServer'){
   
         }else if($request['db']=='Oracle'){
         }

      return response()->json(['productos'=> $productos],200);
   }
}
