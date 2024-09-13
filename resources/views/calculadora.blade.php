<!DOCTYPE html>
<html>
<head>
    <title>Calculadora</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    
</head>
<body>
    <div class="d-flex justify-content-center align-items-center">
        <div class="w-100" style="max-width: 600px;">
            <h1>Calculadora do amendoim</h1>
    
            <h2>Preparo do solo</h2>
            @include('subsections.amendoim.preparo.operacoes')
            @include('subsections.amendoim.preparo.insumos')
            @include('subsections.amendoim.preparo.maquinas-implementos')
            @include('subsections.amendoim.preparo.mao-de-obra')
    
            <h2>Aplicação de corretivos</h2>
            @include('subsections.amendoim.aplicacao.insumos')
            @include('subsections.amendoim.aplicacao.mao-de-obra')
            @include('subsections.amendoim.aplicacao.maquinas-implementos')
    
            <h2>Plantio</h2>
            @include('subsections.amendoim.plantio.insumos')
            @include('subsections.amendoim.plantio.mao-de-obra')
            @include('subsections.amendoim.plantio.maquinas-implementos')
            @include('subsections.amendoim.plantio.operacoes')
    
            <h2>Manejo fitossanitário e adubação</h2>
            @include('subsections.amendoim.manejo.insumos')
            @include('subsections.amendoim.manejo.mao-de-obra')
            @include('subsections.amendoim.manejo.maquinas-implementos')
            @include('subsections.amendoim.manejo.operacoes')
    
            <h2>Colheita</h2>
            @include('subsections.amendoim.colheita.insumos')
            @include('subsections.amendoim.colheita.mao-de-obra')
            @include('subsections.amendoim.colheita.maquinas-implementos')
        </div>
    </div>
    
</body>
</html>
