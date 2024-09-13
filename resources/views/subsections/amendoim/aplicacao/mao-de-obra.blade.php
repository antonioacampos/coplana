<script>
    $(document).ready(function(){
        $("#toggleResults2").click(function(){
            $("#individualResults2").toggle();
        });
    });
</script>
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h3 class="text-center mb-4">Mão de obra - Tabela 2</h3> 
        <form action="{{ route('calcular') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="number8">Digite o custo unitário da hora de 1 técnico agrícola:</label>
                <input type="number" class="form-control" id="number8" name="number8" placeholder="Digite o custo unitário" step="any" value="{{ old('number8') }}">
                @if ($errors->has('number8'))
                    <span class="text-danger">{{ $errors->first('number8') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="number9">Digite o custo unitário da hora de 1 operador de trator agrícola:</label>
                <input type="number" class="form-control" id="number9" name="number9" placeholder="Digite o custo unitário" step="any" value="{{ old('number9') }}">
                @if ($errors->has('number9'))
                    <span class="text-danger">{{ $errors->first('number9') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="number10">Digite o custo unitário da hora de 2 auxiliares de operação (de tratoristas):</label>
                <input type="number" class="form-control" id="number10" name="number10" placeholder="Digite o custo unitário" step="any" value="{{ old('number10') }}">
                @if ($errors->has('number10'))
                    <span class="text-danger">{{ $errors->first('number10') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="number11">Digite o custo unitário da hora de 1 motorista de caminhão:</label>
                <input type="number" class="form-control" id="number11" name="number11" placeholder="Digite o custo unitário" step="any" value="{{ old('number11') }}">
                @if ($errors->has('number11'))
                    <span class="text-danger">{{ $errors->first('number11') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="number12">Digite o custo unitário da hora de 3 mão de obra para manuseio e aplicação manual:</label>
                <input type="number" class="form-control" id="number12" name="number12" placeholder="Digite o custo unitário" step="any" value="{{ old('number12') }}">
                @if ($errors->has('number12'))
                    <span class="text-danger">{{ $errors->first('number12') }}</span>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Calcular</button>
        </form>

        @if (isset($total2))
        <div class="mt-4 text-center">
            <h4>Resultado Total: <input type="text" class="form-control" value="{{ $total2 }}" readonly></h4>
            <button id="toggleResults2" class="btn btn-secondary mt-3">Mostrar/Esconder Resultados Individuais</button>
            
            <div id="individualResults2" class="mt-3" style="display:none;">
                <p>1 técnico agrícola (2h/ha): <input type="text" class="form-control" value="{{ $result8 }}" readonly></p>
                <p>1 operador de trator agrícola (2h/ha): <input type="text" class="form-control" value="{{ $result9 }}" readonly></p>
                <p>2 auxiliares de operação (4h/ha): <input type="text" class="form-control" value="{{ $result10 }}" readonly></p>
                <p>1 motorista de caminhão (1h/ha): <input type="text" class="form-control" value="{{ $result11 }}" readonly></p>
                <p>3 mãos de obra para manuseio e aplicação manual (12h/ha): <input type="text" class="form-control" value="{{ $result12 }}" readonly></p>
            </div>
        </div>
        @endif
    </div>
</div>
