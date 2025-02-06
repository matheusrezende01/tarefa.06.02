<?php

namespace App\Http\Controllers;

use App\Models\ItemVenda;
use Illuminate\Http\Request;

class ItemVendaController extends Controller
{
    public function Listar()
    {
        $itemVenda = ItemVenda::all();

        return response()->json([
            'status' => true,
            'message' => 'Esses foram os clientes encontrados',
            'data' => $itemVenda
        ]);
}
public function show($id)
{
    $itemVenda = ItemVenda::find($id);


    if ($itemVenda == null) {
        return response()->json([
            'status' => false,
            'message' => 'cliente nao encontrada'
        ]);
    }

    return response()->json([
        'status' => true,
        'data' => $itemVenda
    ]);
}
public function update(Request $request) {
    $itemVenda = ItemVenda::find($request->id);

    if($itemVenda == null) {
        return response()->json([
            'status' => false,
            'message' => 'cliente nao encontrada'
        ]);
    }
    if(isset($request->venda_id)){
        $itemVenda->venda_id = $request->venda_id;
    }
    if(isset($request->produto_id)){
        $itemVenda->produto_id = $request->produto_id;
    }
    if(isset($request->quantidade)){
        $itemVenda->quantidade = $request->quantidade;
    }
    if(isset($request->preco_unitario)){
        $itemVenda->preco_unitario = $request->preco_unitario;
}
if(isset($request->subtotal_item)){
    $itemVenda->subtotal_item = $request->subtotal_item;
}
$itemVenda->update();

return response()->json([
    'status' => true,
    'message' => 'Atualizado'
]);
}
public function deletar($id) {
    $itemVenda = ItemVenda::find($id);

    if($itemVenda == null) {
        return response()->json([
            'status' => false,
            'message' => 'Tarefa nao encontrada'
        ]);
    }

    $itemVenda->delete();

    return response()->json([
        'status' => true,
        'message' => 'Deletado',
        'data'
    ]);
}  
}

