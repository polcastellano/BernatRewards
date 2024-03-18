<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Nivel;
use Illuminate\Http\Request;

class NivelController extends Controller
{
    public function index(){
        
        $nivel = Nivel::all()->toArray();
        return $nivel;
    }

    public function store(Request $request){
        $request->validate([
            'numero' => 'required|max:3',
            'experiencia' => 'required',
        ]);

        $nivel = $request->all();

        $data = Nivel::create($nivel);

        return response()->json(['success' => true, 'data' => $data]);

    }

    public function update($id, Request $request){
        $nivel = Nivel::find($id);

        $request->validate([
            'numero' => 'required|max:3',
            'experiencia' => 'required',
        ]);

        $dataToUpdate = $request->all();

        $nivel->update($dataToUpdate);

        return response()->json(['success' => true, 'data' => $nivel]);

    }

    public function destroy($id){
        $nivel = Nivel::find($id);

        $nivel->delete();

        return response()->json(['success' => true, 'data' => 'Nivel eliminado correctamente']);

    }

    public function allniveles(){
        
        $nivel = Nivel::all()->toArray();
        return $this->successResponse($nivel, 'Levels found');
    }

    public function nivel($id){
        
        $nivel = Nivel::find($id)->toArray();
        $nivelSuperior = Nivel::find($id + 1)->toArray();

        return $this->successResponse($nivelSuperior);
    }
}
