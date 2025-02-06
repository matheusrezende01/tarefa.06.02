<?php

namespace App\Http\Controllers;

use App\Models\ItemVenda;
use App\Models\produto;
use App\Models\Venda;
use Illuminate\Http\Request;

class VendaController extends Controller
{
    public function store(Request $request)
    {
        $venda = Venda::create([
            'cliente_id' => $request->cliente_id,
            'data_venda' => date('Y-m-d H:i:s'),
            'desconto' => $request->desconto,
            'subtotal' => 0,
            'total' => 0
        ]);

        $subtotal = 0;
        //add os itens da venda percorrendo o for
        foreach ($request->itens as $item) {
            $subtotal += $item['quantidade'] * $item['preco'];

            $produto = produto::find($item['produto_id']);
            $produto->quantidade_estoque =  $produto->quantidade_estoque - $item['quantidade'];

            $item_venda = ItemVenda::create([
                'venda_id' => $venda->id,
                'produto_id' => $item['produto_id'],
                'quantidade' => $item['quantidade'],
                'preco_unitario' => $item['preco'],
                'subtotal_item' => $subtotal
            ]);

            $produto->update();
        }

        // atualizar subtotal da venda e total da venda
        $venda->subtotal = $subtotal;
        $venda->total = $subtotal - $request->desconto;
        $venda->update();

        return response()->json([
            'status' => true,
            'data' => $venda
        ]);
    }




    public function index()
    {
        $vendas = Venda::all();

        return response()->json([
            'status' => true,
            'message' => 'Cadastrado',
            'data' => $vendas
        ]);
    }
    public function show($id)
    {
        $venda = Venda::find($id);


        if ($venda == null) {
            return response()->json([
                'status' => false,
                'message' => 'venda nao encontrada'
            ]);
        }
        return response()->json([
            'status' => true,
            'data' => $venda
        ]);
    }
    public function update(Request $request)
    {
        $vendas = Venda::find($request->id);

        if ($vendas == null) {
            return response()->json([
                'status' => false,
                'message' => 'cliente nao encontrada'
            ]);
        }
        if (isset($request->cliente_id)) {
            $vendas->cliente_id = $request->cliente_id;
        }
        if (isset($request->data_venda)) {
            $vendas->data_venda = $request->data_venda;
        }
        if (isset($request->subtotal)) {
            $vendas->subtotal = $request->subtotal;
        }
        if (isset($request->desconto)) {
            $vendas->desconto = $request->desconto;
        }
        if (isset($request->total)) {
            $vendas->total = $request->total;
        }

        $vendas->update();

        return response()->json([
            'status' => true,
            'message' => 'Atualizado'
        ]);
    }
    public function deletar($id) {
        $vendas = Venda::find($id);
    
        if($vendas == null) {
            return response()->json([
                'status' => false,
                'message' => 'Tarefa nao encontrada'
            ]);
        }
    
        $vendas->delete();
    
        return response()->json([
            'status' => true,
            'message' => 'Deletado',
            'data'
        ]);
    }  
}
