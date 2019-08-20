<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;

class UsuariosController extends Controller{
    
   public function getUsuarios(Request $request){

      $usuarios = User::all();

       return response()->json(['usuarios' => $usuarios],200);
   }

}
