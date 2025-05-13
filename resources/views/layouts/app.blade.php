@extends('layouts.master')

@section('title')
  @parent
@endsection

@section('styles')
  @parent
  <style>
    .navbar {
      background-color: rgba(10, 55, 23, 0.9) !important;
    }

    .navbar-brand {
      color: white !important;
    }

    .nav-link {
      color: white !important;
    }

    .nav-link:hover {
      color: #28a745 !important;
    }
  </style>
@endsection

@section('menu')
  <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
      <a class="navbar-brand" href="{{ route('home') }}">Coplana</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('json.index') }}">Gerenciar JSONs</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
@endsection

@section('menu')
  @can('user')
    @parent
  @endcan
@endsection

@section('skin_login_bar')
  @if (Gate::allows('user'))
    @parent
  @else
    @if (config('skin_login_bar'))
      @parent
    @else
      <div class="py-2"></div>
    @endif
  @endif

@endsection

@section('javascripts_bottom')
  @parent
  <script>
    // Add any additional JavaScript here
  </script>
@endsection
