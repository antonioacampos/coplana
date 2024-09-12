{{-- carrega styles e javascripts das bibliotecas JS do tema --}}
@include('partials.assets_default')

@section('styles_default')
@parent
<link rel="stylesheet" href="{{ asset('/resources/css/style.css') }}">
@endsection

@section('javascripts_default')
@parent
<script type="text/javascript" src="{{ asset('resources/js/app.js') }}"></script>
@endsection