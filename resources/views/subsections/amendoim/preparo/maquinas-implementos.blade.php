<script>
    $(document).ready(function(){
        $("#toggleResults").click(function(){
            $("#individualResults").toggle();
        });
    });
</script>
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h3 class="text-center mb-4">Maquinas e implementos (a cada 15 dias)</h3> 
        <form action="{{ route('calcular') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="number1">Digite o custo unitário de 1 trator agrícola:</label>
                <input type="number" class="form-control" id="number1" name="number1" placeholder="Digite o custo unitário" step="any" value="{{ old('number1') }}">
                @if ($errors->has('number1'))
                    <span class="text-danger">{{ $errors->first('number1') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="number2">Digite o custo unitário de 1 grade aradora:</label>
                <input type="number" class="form-control" id="number2" name="number2" placeholder="Digite o custo unitário" step="any" value="{{ old('number2') }}">
                @if ($errors->has('number2'))
                    <span class="text-danger">{{ $errors->first('number2') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="number3">Digite o custo unitário de 1 adubadora:</label>
                <input type="number" class="form-control" id="number3" name="number3" placeholder="Digite o custo unitário" step="any" value="{{ old('number3') }}">
                @if ($errors->has('number3'))
                    <span class="text-danger">{{ $errors->first('number3') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="number4">Digite o custo unitário de 1 caminhão:</label>
                <input type="number" class="form-control" id="number4" name="number4" placeholder="Digite o custo unitário" step="any" value="{{ old('number4') }}">
                @if ($errors->has('number4'))
                    <span class="text-danger">{{ $errors->first('number4') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="number5">Digite o custo unitário do combustível:</label>
                <input type="number" class="form-control" id="number5" name="number5" placeholder="Digite o custo unitário" step="any" value="{{ old('number5') }}">
                @if ($errors->has('number5'))
                    <span class="text-danger">{{ $errors->first('number5') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="number6">Digite o custo unitário da manutenção preventiva:</label>
                <input type="number" class="form-control" id="number6" name="number6" placeholder="Digite o custo unitário" step="any" value="{{ old('number6') }}">
                @if ($errors->has('number6'))
                    <span class="text-danger">{{ $errors->first('number6') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="number7">Digite o custo unitário da manutenção corretiva:</label>
                <input type="number" class="form-control" id="number7" name="number7" placeholder="Digite o custo unitário" step="any" value="{{ old('number7') }}">
                @if ($errors->has('number7'))
                    <span class="text-danger">{{ $errors->first('number7') }}</span>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Calcular</button>
        </form>

        @if (isset($total))
        <div class="mt-4 text-center">
            <h4>Resultado Total: <input type="text" class="form-control" value="{{ $total }}" readonly></h4>
            <button id="toggleResults" class="btn btn-secondary mt-3">Mostrar/Esconder Resultados Individuais</button>
            
            <div id="individualResults" class="mt-3" style="display:none;">
                <p>Trator agrícola (4.2-10%/ano): <input type="text" class="form-control" value="{{ $result1 }}" readonly></p>
                <p>Grade aradora (4.2-7%/ano): <input type="text" class="form-control" value="{{ $result2 }}" readonly></p>
                <p>Adubadora (4.2-7%/ano): <input type="text" class="form-control" value="{{ $result3 }}" readonly></p>
                <p>Caminhão (4.2-10%/ano): <input type="text" class="form-control" value="{{ $result4 }}" readonly></p>
                <p>Combustível (L/ha): <input type="text" class="form-control" value="{{ $result5 }}" readonly></p>
                <p>Manutenção preventiva (6.6u/ha): <input type="text" class="form-control" value="{{ $result6 }}" readonly></p>
                <p>Manutenção corretiva (2.2u/ha): <input type="text" class="form-control" value="{{ $result7 }}" readonly></p>
            </div>
        </div>
        @endif
    </div>
</div>