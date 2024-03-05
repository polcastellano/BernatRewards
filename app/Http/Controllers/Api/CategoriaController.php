<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoriaResource;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Psy\Readline\Hoa\Console;

class CategoriaController extends Controller
{
    public function index(){
        
        $categorias = Categoria::with('recompensas')->get();
        return $categorias;
    }

    public function store(Request $request){
        $request->validate([
            'nombre' => 'required|max:15',
        ]);

        $categoria = $request->all();

        $data = Categoria::create($categoria);

        return response()->json(['success' => true, 'data' => $data]);

    }

    public function update($id, Request $request){
        $categoria = Categoria::find($id);

        $request->validate([
            'nombre' => 'required|max:15',
        ]);

        $dataToUpdate = $request->all();

        $categoria->update($dataToUpdate);

        return response()->json(['success' => true, 'data' => $categoria]);

    }

    public function destroy($id){
        $categoria = Categoria::find($id);

        $categoria->delete();

        return response()->json(['success' => true, 'data' => 'Categoria eliminada correctamente']);

    }

    public function getCategorias(){
        return Categoria::all();
        
    }
}
