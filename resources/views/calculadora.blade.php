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
        </div>
    </div>
</body>
</html>
