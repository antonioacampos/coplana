@extends('layouts.app')

@section('content')
<h1>Arquivo: {{ $filename }}.json</h1>
<pre>{{ json_encode($content, JSON_PRETTY_PRINT) }}</pre>
<a href="{{ route('json.index') }}">Voltar</a>
@endsection
