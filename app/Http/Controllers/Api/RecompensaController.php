<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRecompensaRequest;
use App\Http\Resources\RecompensaResource;
use App\Models\Categoria;
use App\Models\Recompensa;
use Illuminate\Http\Request;

class RecompensaController extends Controller
{
    public function index(){
        $orderColumn = 'created_at';
        $orderDirection = 'desc';
        $this->authorize('recompensa-list');
        
        $recompensas = Recompensa::with('categorias')->with('media')->get();
        // ->orderBy($orderColumn, $orderDirection)
        // ->paginate(50)
        // ;
        return RecompensaResource::collection($recompensas);
    }

    public function store(StoreRecompensaRequest $request){
   
        $this->authorize('recompensa-create');
        
        $validatedData = $request->validated();       
        $recompensa = Recompensa::create($validatedData);

        $categorias = explode(",", $request->categorias);
        $categoria = Categoria::findMany($categorias);
        $recompensa->categorias()->attach($categoria);

        //Comprobar si tiene imagen y almacenarla
        if ($request->hasFile('imagen')) {
            $recompensa->addMediaFromRequest('imagen')->preservingOriginal()->toMediaCollection('images-recompensas');
        }
        return new RecompensaResource($recompensa);

    }

    public function update($id, Request $request){

        $this->authorize('recompensa-edit');
        $recompensa = Recompensa::find($id);

        $request->validate([
            'nombre' => 'required|max:15',
            'descripcion' => 'required|max:150',
            'precio' => 'required',
            'imagen' => 'nullable',
            'nivel_desbloqueo' => 'required',
            'categorias' => 'required'
        ]);

        $dataToUpdate = $request->all();

        $recompensa->update($dataToUpdate);

        $categorias = Categoria::findMany($request->categorias);

        $recompensa->categorias()->sync($categorias);

        return response()->json(['success' => true, 'data' => $recompensa]);

    }

    public function destroy($id){
        
        $this->authorize('recompensa-delete');
        $recompensa = Recompensa::find($id);

        $recompensa->delete();

        return response()->json(['success' => true, 'data' => 'Recompensa eliminada correctamente']);

    }

    public function edit($id){
        $recompensa = Recompensa::find($id);

        $recompensa->categorias;

        return response()->json(['success' => true, 'data' => $recompensa]);

    }
}
