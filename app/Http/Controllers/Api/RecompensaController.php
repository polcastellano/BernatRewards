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
        
        // $this->authorize('recompensa-list');
        
        $recompensas = Recompensa::with('categorias')->with('media')->get();

        return RecompensaResource::collection($recompensas);
    }

    public function store(StoreRecompensaRequest $request){
   
        $this->authorize('recompensa-create');
        
        $validatedData = $request->validated();       
        $validatedData['usuario_id'] = auth()->id();
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

    public function update($id, StoreRecompensaRequest $request){

        $this->authorize('recompensa-edit');
        
        $recompensa = Recompensa::find($id);

        if ($recompensa->usuario_id !== auth()->id() && !auth()->user()->hasPermissionTo('recompensa-all')) {
            return response()->json(['status' => 405, 'success' => false, 'message' => 'Solo puedes editar tus propias recompensas']);
        } else {
            $recompensa->update($request->validated());
            $categoria = Categoria::findMany($request->categorias);
            $recompensa->categorias()->sync($categoria);
    
            if($request->hasFile('imagen')) {
                $recompensa->media()->delete();
                $recompensa->addMediaFromRequest('imagen')->preservingOriginal()->toMediaCollection('images-recompensas');
            }

            return new RecompensaResource($recompensa);
        }
    }

    public function destroy(Recompensa $recompensa){
        
        $this->authorize('recompensa-delete');
        
        if ($recompensa->usuario_id !== auth()->id() || !auth()->user()->hasPermissionTo('recompensa-all')) {
            return response()->json(['status' => 405, 'success' => false, 'message' => 'Solo puedes eliminar tus propias recompensas']);
        } else {
            $recompensa->delete();
            return response()->noContent();
        }
    }
 
    public function show(Recompensa $recompensa){

        $this->authorize('recompensa-edit');
        
        if ($recompensa->usuario_id !== auth()->id() || !auth()->user()->hasPermissionTo('recompensa-all')) {
            return response()->json(['status' => 405, 'success' => false, 'message' => 'Solo puedes editar tus propias recompensas']);
        } else {
            return new RecompensaResource($recompensa);
        }
        
    }

    public function getRecompensaByCategory($id)
    {
        $recompensas = Recompensa::whereRelation('categorias', 'id', '=', $id)->paginate();

         return RecompensaResource::collection($recompensas);
    }


    public function getRecompensa(Recompensa $recompensa){

            return new RecompensaResource($recompensa);
        
    }
    
}
