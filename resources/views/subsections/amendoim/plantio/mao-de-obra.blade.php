<script>
    $(document).ready(function(){
        $("#toggleResults5").click(function(){
            $("#individualResults5").toggle();
        });
    });
</script>
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h3 class="text-center mb-4">Mão de Obra</h3> 
        <form action="{{ route('calcular') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="number25">Digite o custo unitário da hora de 1 técnico agrícola:</label>
                <input type="number" class="form-control" id="number25" name="number25" placeholder="Digite o custo unitário" step="any" value="{{ old('number25') }}">
                @if ($errors->has('number25'))
                    <span class="text-danger">{{ $errors->first('number25') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="number26">Digite o custo unitário da hora de 1 operador de trator agrícola:</label>
                <input type="number" class="form-control" id="number26" name="number26" placeholder="Digite o custo unitário" step="any" value="{{ old('number26') }}">
                @if ($errors->has('number26'))
                    <span class="text-danger">{{ $errors->first('number26') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="number27">Digite o custo unitário da hora de 2 auxiliares de operação (tratorista):</label>
                <input type="number" class="form-control" id="number27" name="number27" placeholder="Digite o custo unitário" step="any" value="{{ old('number27') }}">
                @if ($errors->has('number27'))
                    <span class="text-danger">{{ $errors->first('number27') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="number28">Digite o custo unitário da hora de 1 motorista de caminhão:</label>
                <input type="number" class="form-control" id="number28" name="number28" placeholder="Digite o custo unitário" step="any" value="{{ old('number28') }}">
                @if ($errors->has('number28'))
                    <span class="text-danger">{{ $errors->first('number28') }}</span>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Calcular</button>
        </form>

        @if (isset($total5))
        <div class="mt-4 text-center">
            <h4>Resultado Total: <input type="text" class="form-control" value="{{ $total5 }}" readonly></h4>
            <button id="toggleResults5" class="btn btn-secondary mt-3">Mostrar/Esconder Resultados Individuais</button>
            
            <div id="individualResults5" class="mt-3" style="display:none;">
                <p>1 técnico agrícola (2h/ha): <input type="text" class="form-control" value="{{ $result25 }}" readonly></p>
                <p>1 operador de trator agrícola (4h/ha): <input type="text" class="form-control" value="{{ $result26 }}" readonly></p>
                <p>2 auxiliares de operação (8h/ha): <input type="text" class="form-control" value="{{ $result27 }}" readonly></p>
                <p>1 motorista de caminhão (1h/ha): <input type="text" class="form-control" value="{{ $result28 }}" readonly></p>
            </div>
        </div>
        @endif
    </div>
</div>
