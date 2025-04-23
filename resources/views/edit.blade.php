@extends('layouts.app')

@section('content')
<h1>Editar {{ $filename }}.json</h1>
<form action="{{ route('json.update', [$folder, $filename]) }}" method="POST">
    @csrf @method('PUT')
    <label>Conteúdo JSON:</label>
    <textarea name="content" required>{{ $content }}</textarea>
    <button type="submit">Salvar</button>
</form>
@endsection
