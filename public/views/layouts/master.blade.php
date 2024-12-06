<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>@section('title'){{ env('APP_NAME') }}@show</title>

        <base href="{{  env('APP_URL') }}/">

        @include('partials.partials_loader')

        @yield('styles_default')

        @yield('styles')
    </head>

    <body>
        {{-- <div id="menu" class="{{ $container }}">
            @yield('menu')
        </div> --}}

        <div >
            <div class="row">
                <div id="content" class="col-md-12">
                @section('content')
                    {{-- Conteúdo principal vai aqui. O include de exemplo deve ser
                substituído pelo conteúdo da aplicação não usando o @parent --}}
                    @include('partials.content_sample')
                @show
            </div>
        </div>
    </div>

    {{-- <div id="skin_footer" class="{{ $container }}"> {{-- Cria a barra do rodapé 
        @yield('skin_footer')
    </div> --}}

    <!-- Bibliotecas js do tema e das bibliotecas internas -->
    @yield('javascripts_default')

    <!-- Bibliotecas js da aplicação -->
    @yield('javascripts_bottom')

</body>

</html>