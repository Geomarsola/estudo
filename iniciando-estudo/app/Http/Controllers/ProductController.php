<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    // Mostra a lista de produtos
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    // Mostra o formulário para criar novo produto
    public function create()
    {
        return view('admin.products.create');
    }

    // Salva novo produto
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer|min:0',
            'active' => 'required|boolean',
        ]);

        Product::create($request->all());
        return redirect()->route('products.index')->with('success', 'Produto criado com sucesso!');
    }

    // Mostra detalhes de um produto
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    // Mostra formulário de edição
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    // Atualiza produto
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer|min:0',
            'active' => 'required|boolean',
        ]);

        $product->update($request->all());
        return redirect()->route('products.index')->with('success', 'Produto atualizado com sucesso!');
    }

    // Deleta produto (opcional: aqui você pode registrar no log de produtos deletados)
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produto deletado com sucesso!');
    }
}
