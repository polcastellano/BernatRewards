<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index(){
        
        $usuario = Usuario::all()->toArray();
        return $usuario;
    }

    public function store(Request $request){
        $request->validate([
            'nombre' => 'required',
            'telefono' => 'required',
            'edad' => 'required',
            'correo' => 'required',
            'password' => 'required',
        ]);

        $usuario = $request->all();

        $data = Usuario::create($usuario);

        return response()->json(['success' => true, 'data' => $data]);

    }

    public function update($id, Request $request){
        $usuario = Usuario::find($id);

        $request->validate([
            'nombre' => 'required',
            'telefono' => 'required',
            'edad' => 'required',
            'correo' => 'required',
            'password' => 'required',
        ]);

        $dataToUpdate = $request->all();

        $usuario->update($dataToUpdate);

        return response()->json(['success' => true, 'data' => $usuario]);

    }

    public function destroy($id){
        $usuario = Usuario::find($id);

        $usuario->delete();

        return response()->json(['success' => true, 'data' => 'Usuario eliminado correctamente']);

    }

}
