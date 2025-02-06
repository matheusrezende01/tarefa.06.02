<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    public function store(Request $request)
    {
        $clientes = Clientes::create([

            'nome' => $request->nome,
            'email' => $request->email,
            'telefone' => $request->telefone,
            'endereco' => $request->endereco
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Cadastrado',
            'data' => $clientes
        ]);
    }
    public function ListarNomes()
    {
        $clientes = Clientes::all();

        return response()->json([
            'status' => true,
            'message' => 'Esses foram os clientes encontrados',
            'data' => $clientes
        ]);
    }
    public function show($id)
    {
        $clientes = clientes::find($id);


        if ($clientes == null) {
            return response()->json([
                'status' => false,
                'message' => 'cliente nao encontrada'
            ]);
        }

        return response()->json([
            'status' => true,
            'data' => $clientes
        ]);
    }
    public function update(Request $request) {
        $clientes = Clientes::find($request->id);

        if($clientes == null) {
            return response()->json([
                'status' => false,
                'message' => 'cliente nao encontrada'
            ]);
        }
        if(isset($request->nome)){
            $clientes->nome = $request->nome;
        }
        if(isset($request->email)){
            $clientes->email = $request->email;
        }
        if(isset($request->telefone)){
            $clientes->telefone = $request->telefone;
        }
        if(isset($request->endereco)){
            $clientes->endereco = $request->endereco;
    }
    $clientes->update();

    return response()->json([
        'status' => true,
        'message' => 'Atualizado'
    ]);
}
public function deletar($id) {
    $clientes = Clientes::find($id);

    if($clientes == null) {
        return response()->json([
            'status' => false,
            'message' => 'Tarefa nao encontrada'
        ]);
    }

    $clientes->delete();

    return response()->json([
        'status' => true,
        'message' => 'Deletado',
        'data'
    ]);
}  
   
}