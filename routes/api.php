<?php

use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ItemVendaController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\VendaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('cliente', [ClientesController::class, 'store']);
Route::get('clientes', [ClientesController::class, 'ListarNomes']);
Route::get('cliente/{id}', [ClientesController::class, 'show']);
Route::put('cliente/{id}', [ClientesController::class, 'update']);
Route::delete('cliente/{id}', [ClientesController::class, 'deletar']);


Route::post('produto', [ProdutoController::class, 'store']);
Route::get('produto', [ProdutoController::class, 'listarNomes']);
Route::get('produto/{id}', [ProdutoController::class, 'show']);
Route::put('produto/{id}', [ProdutoController::class, 'update']);
Route::delete('produto/{id}', [ProdutoController::class, 'deletar']);


Route::post('venda', [VendaController::class, 'store']);
Route::get('venda', [VendaController::class, 'index']);
Route::get('venda/{id}', [VendaController::class, 'show']);
Route::put('venda/{id}', [VendaController::class, 'update']);
Route::delete('venda/{id}', [VendaController::class, 'deletar']);


Route::post('item/venda', [ItemVendaController::class, 'cadastrar']);
Route::get('item/venda', [ItemVendaController::class, 'Listar']);
Route::get('item/venda/{id}', [ItemVendaController::class, 'show']);
Route::put('venda/item/{id}', [ItemVendaController::class, 'update']);
Route::delete('venda/item/{id}', [ItemVendaController::class, 'deletar']);