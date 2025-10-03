@extends('layouts.app')

@section('content')
<h1>Detalhes do Produto</h1>

<p><strong>ID:</strong> {{ $product->id }}</p>
<p><strong>Nome:</strong> {{ $product->name }}</p>
<p><strong>Descrição:</strong> {{ $product->description }}</p>
<p><strong>Preço:</strong> {{ number_format($product->price, 2, ',', '.') }}</p>
<p><strong>Estoque:</strong> {{ $product->stock }}</p>
<p><strong>Ativo:</strong> {{ $product->active ? 'Sim' : 'Não' }}</p>

<a href="{{ route('products.index') }}">Voltar</a>
<a href="{{ route('products.edit', $product) }}">Editar</a>
@endsection
