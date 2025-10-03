@extends('layouts.app')

@section('content')
<h1>Novo Produto</h1>

@if ($errors->any())
<div style="color:red;">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('products.store') }}" method="POST">
    @csrf
    <label>Nome:</label>
    <input type="text" name="name" value="{{ old('name') }}" required><br>

    <label>Descrição:</label>
    <textarea name="description">{{ old('description') }}</textarea><br>

    <label>Preço:</label>
    <input type="number" step="0.01" name="price" value="{{ old('price') }}" required><br>

    <label>Estoque:</label>
    <input type="number" name="stock" value="{{ old('stock') ?? 0 }}" required><br>

    <label>Ativo:</label>
    <select name="active">
        <option value="1" selected>Sim</option>
        <option value="0">Não</option>
    </select><br>

    <button type="submit">Salvar</button>
</form>
@endsection
