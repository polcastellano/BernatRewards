<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Recompensa;
use Illuminate\Http\Request;

class RecompensaController extends Controller
{
    public function index(){
        
        $recompensas = Recompensa::all()->toArray();
        return $recompensas;
    }

    public function store(Request $request){
        $request->validate([
            'nombre' => 'required|max:15',
            'descripcion' => 'required|max:150',
            'precio' => 'required',
            'imagen' => 'nullable',
        ]);

        $recompensa = $request->all();

        $accion = Recompensa::create($recompensa);

        return response()->json(['success' => true, 'data' => $accion]);

    }
}
