<script>
    $(document).ready(function(){
        $("#toggleResults6").click(function(){
            $("#individualResults6").toggle();
        });
    });
</script>
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h3 class="text-center mb-4">Operações</h3> 
        <form action="{{ route('calcularOperacoes') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="number29">Digite o custo unitário para pulverização com autopropelido:</label>
                <input type="number" class="form-control" id="number29" name="number29" placeholder="Digite o custo unitário" step="any" value="{{ old('number29') }}">
                @if ($errors->has('number29'))
                    <span class="text-danger">{{ $errors->first('number29') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="number30">Digite o custo unitário para pulverização com pulverizador de arrasto/hidráulico:</label>
                <input type="number" class="form-control" id="number30" name="number30" placeholder="Digite o custo unitário" step="any" value="{{ old('number30') }}">
                @if ($errors->has('number30'))
                    <span class="text-danger">{{ $errors->first('number30') }}</span>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Calcular</button>
        </form>

        @if (isset($total6))
        <div class="mt-4 text-center">
            <h4>Resultado Total: <input type="text" class="form-control" value="{{ $total6 }}" readonly></h4>
            <button id="toggleResults6" class="btn btn-secondary mt-3">Mostrar/Esconder Resultados Individuais</button>
            
            <div id="individualResults6" class="mt-3" style="display:none;">
                <p>Pulverização com autopropelido (1 aplicação, 250 litros de calda): <input type="text" class="form-control" value="{{ $result29 }}" readonly></p>
                <p>Pulverização com pulverizador de arrasto/hidráulico (1 aplicação, 250 litros de calda): <input type="text" class="form-control" value="{{ $result30 }}" readonly></p>
            </div>
        </div>
        @endif
    </div>
</div>