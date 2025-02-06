<?php

namespace App\Http\Controllers;

use App\Models\produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function store(Request $request)
    {
        $produtos = Produto::create([

            'nome' => $request->nome,
            'codigo' => $request->codigo,
            'preco' => $request->preco,
            'quantidade_estoque' => $request->quantidade_estoque
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Cadastrado',
            'data' => $produtos
        ]);
}
public function ListarNomes()
    {
        $produtos = Produto::all();

        return response()->json([
            'status' => true,
            'message' => 'Esses foram os clientes encontrados',
            'data' => $produtos
        ]);
}
public function show($id)
{
    $produtos = Produto::find($id);


    if ($produtos == null) {
        return response()->json([
            'status' => false,
            'message' => 'cliente nao encontrada'
        ]);
    }

    return response()->json([
        'status' => true,
        'data' => $produtos
    ]);
}
public function update(Request $request) {
    $produtos = Produto::find($request->id);

    if($produtos == null) {
        return response()->json([
            'status' => false,
            'message' => 'cliente nao encontrada'
        ]);
    }
    if(isset($request->nome)){
        $produtos->nome = $request->nome;
    }
    if(isset($request->codigo)){
        $produtos->codigo = $request->codigo;
    }
    if(isset($request->preco)){
        $produtos->preco = $request->preco;
    }
    if(isset($request->quantidade_estoque)){
        $produtos->quantidade_estoque = $request->quantidade_estoque;
}
$produtos->update();

return response()->json([
    'status' => true,
    'message' => 'Atualizado'
]);
}
public function deletar($id) {
    $produtos = Produto::find($id);

    if($produtos == null) {
        return response()->json([
            'status' => false,
            'message' => 'Tarefa nao encontrada'
        ]);
    }

    $produtos->delete();

    return response()->json([
        'status' => true,
        'message' => 'Deletado',
        'data'
    ]);
}  
}