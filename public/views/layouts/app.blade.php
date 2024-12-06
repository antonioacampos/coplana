@extends('layouts.master')

@section('title')
  @parent
@endsection

@section('styles')
  @parent
  <style>
  </style>
@endsection

@section('menu')
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

  </script>
@endsection
