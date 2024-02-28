<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use App\Models\Recompensa;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index(){
        
        // $recompensas = Recompensa::with('categorias')->get(); duda

        $pedidos = Pedido::with('recompensas.categorias')->get();
        return $pedidos;
    }

    public function store(Request $request){
        $request->validate([
            'cantidad' => 'required',
            'precio_total' => 'required',
            'usuario_id' => 'required',
            'fecha' => 'required',
        ]);

        $pedido = $request->all();

        $data = Pedido::create($pedido);

        return response()->json(['success' => true, 'data' => $data]);

    }

    public function update($id, Request $request){
        $pedido = Pedido::find($id);

        $request->validate([
            'cantidad' => 'required',
            'precio_total' => 'required',
            'usuario_id' => 'required',
            'fecha' => 'required',
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
}
