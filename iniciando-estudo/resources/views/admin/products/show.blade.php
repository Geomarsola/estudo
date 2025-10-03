@extends('layouts.app')

@section('title', 'Detalhes do Produto')

@section('content')
<h1>Produto: {{ $product->name }}</h1>

<ul>
    <li><strong>Descrição:</strong> {{ $product->description }}</li>
    <li><strong>Preço:</strong> R$ {{ number_format($product->price, 2, ',', '.') }}</li>
    <li><strong>Estoque:</strong> {{ $product->stock }}</li>
</ul>

<a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Voltar</a>
<a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning">Editar</a>
@endsection
