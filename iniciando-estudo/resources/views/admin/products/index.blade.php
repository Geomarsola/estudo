@extends('layouts.app')

@section('content')
<h1>Lista de Produtos</h1>

<a href="{{ route('products.create') }}">Novo Produto</a>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Descrição</th>
        <th>Preço</th>
        <th>Estoque</th>
        <th>Ativo</th>
        <th>Ações</th>
    </tr>
    @foreach($products as $product)
    <tr>
        <td>{{ $product->id }}</td>
        <td>{{ $product->name }}</td>
        <td>{{ $product->description }}</td>
        <td>{{ number_format($product->price, 2, ',', '.') }}</td>
        <td>{{ $product->stock }}</td>
        <td>{{ $product->active ? 'Sim' : 'Não' }}</td>
        <td>
            <a href="{{ route('products.show', $product) }}">Ver</a>
            <a href="{{ route('products.edit', $product) }}">Editar</a>
            <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Deseja realmente deletar?')">Deletar</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
