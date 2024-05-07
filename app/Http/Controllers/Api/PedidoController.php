<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePedidoRequest;
use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index(){
        
        $pedidos = Pedido::with('recompensas.categorias')->get();
        return $pedidos;
    }

    public function store(StorePedidoRequest $request){
            
        $validatedData = $request->validated();       
        $validatedData['usuario_id'] = auth()->id();
        $pedido = Pedido::create($validatedData);

        return response()->json(['success' => true, 'data' => $pedido]);

    }

    public function update($id, Request $request){
        $pedido = Pedido::find($id);

        $request->validate([
            'usuario_id' => 'required',
            'recompensa_id' => 'required',
        ]);

        $dataToUpdate = $request->all();

        $pedido->update($dataToUpdate);

        return response()->json(['success' => true, 'data' => $pedido]);

    }

    public function destroy($id){
        $pedido = Pedido::find($id);

        $pedido->delete();

        return response()->json(['success' => true, 'data' => 'Pedido eliminada correctamente']);

    }
    public function getPedidosUser($id){
                
        $pedidos = Pedido::with('recompensa.media')->where('usuario_id', $id)->get();
        
        return $pedidos;
    }
}
