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

        $data = Recompensa::create($recompensa);

        return response()->json(['success' => true, 'data' => $data]);

    }

    public function update($id, Request $request){
        $recompensa = Recompensa::find($id);

        $request->validate([
            'nombre' => 'required|max:15',
            'descripcion' => 'required|max:150',
            'precio' => 'required',
            'imagen' => 'nullable',
        ]);

        $dataToUpdate = $request->all();

        $recompensa->update($dataToUpdate);

        return response()->json(['success' => true, 'data' => $recompensa]);

    }

    public function destroy($id){
        $recompensa = Recompensa::find($id);

        $recompensa->delete();

        return response()->json(['success' => true, 'data' => 'Recompensa eliminada correctamente']);

    }
}
