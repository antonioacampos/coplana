<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h3 class="text-center mb-4">Operações</h3>
        <form action="{{ route('calcular') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="inputs[0][number1]">Digite o custo unitário da gradagem pesada:</label>
                <input type="number" class="form-control" id="inputs[0][number1]" name="inputs[0][number1]" placeholder="Digite o custo unitário" step="any" value="{{ old('inputs.0.number1') }}">
                @if ($errors->has('inputs.0.number1'))
                    <span class="text-danger">{{ $errors->first('inputs.0.number1') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="inputs[0][number2]">Digite o custo unitário da aração (Iveca):</label>
                <input type="number" class="form-control" id="inputs[0][number2]" name="inputs[0][number2]" placeholder="Digite o custo unitário" step="any" value="{{ old('inputs.0.number2') }}">
                @if ($errors->has('inputs.0.number2'))
                    <span class="text-danger">{{ $errors->first('inputs.0.number2') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="inputs[0][number3]">Digite o custo unitário da gradagem intermediária:</label>
                <input type="number" class="form-control" id="inputs[0][number3]" name="inputs[0][number3]" placeholder="Digite o custo unitário" step="any" value="{{ old('inputs.0.number3') }}">
                @if ($errors->has('inputs.0.number3'))
                    <span class="text-danger">{{ $errors->first('inputs.0.number3') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="inputs[0][number4]">Digite o custo unitário da gradagem niveladora:</label>
                <input type="number" class="form-control" id="inputs[0][number4]" name="inputs[0][number4]" placeholder="Digite o custo unitário" step="any" value="{{ old('inputs.0.number4') }}">
                @if ($errors->has('inputs.0.number4'))
                    <span class="text-danger">{{ $errors->first('inputs.0.number4') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="inputs[0][number5]">Digite o custo unitário da enxada rotativa (canteirização):</label>
                <input type="number" class="form-control" id="inputs[0][number5]" name="inputs[0][number5]" placeholder="Digite o custo unitário" step="any" value="{{ old('inputs.0.number5') }}">
                @if ($errors->has('inputs.0.number5'))
                    <span class="text-danger">{{ $errors->first('inputs.0.number5') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="inputs[0][number6]">Digite o custo unitário da subssolagem:</label>
                <input type="number" class="form-control" id="inputs[0][number6]" name="inputs[0][number6]" placeholder="Digite o custo unitário" step="any" value="{{ old('inputs.0.number6') }}">
                @if ($errors->has('inputs.0.number6'))
                    <span class="text-danger">{{ $errors->first('inputs.0.number6') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="inputs[0][number7]">Digite o custo unitário da pulverização de dessecação pré-plantio:</label>
                <input type="number" class="form-control" id="inputs[0][number7]" name="inputs[0][number7]" placeholder="Digite o custo unitário" step="any" value="{{ old('inputs.0.number7') }}">
                @if ($errors->has('inputs.0.number7'))
                    <span class="text-danger">{{ $errors->first('inputs.0.number7') }}</span>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Calcular</button>
        </form>

        @if (isset($results[0]))
        <div class="mt-4 text-center">
            <h4>Resultado Total: <input type="text" class="form-control" value="{{ $results[0][0] }}" readonly></h4>
            <button id="toggleResults-0" class="btn btn-secondary mt-3">Mostrar/Esconder Resultados Individuais</button>
            
            <div id="individualResults-0" class="mt-3" style="display:none;">
                @if (isset($results[0][1]['result1']))
                    <p>Gradagem pesada (2.2u/ha): <input type="text" class="form-control" value="{{ $results[0][1]['result1'] }}" readonly></p>
                @endif
                @if (isset($results[0][1]['result2']))
                    <p>Aração - Iveca (4.4u/ha): <input type="text" class="form-control" value="{{ $results[0][1]['result2'] }}" readonly></p>
                @endif
                @if (isset($results[0][1]['result0']))
                    <p>Gradagem intermediária (6.6u/ha): <input type="text" class="form-control" value="{{ $results[0][1]['result0'] }}" readonly></p>
                @endif
                @if (isset($results[0][1]['result4']))
                    <p>Gradagem niveladora (2.2u/ha): <input type="text" class="form-control" value="{{ $results[0][1]['result4'] }}" readonly></p>
                @endif
                @if (isset($results[0][1]['result5']))
                    <p>Enxada rotativa (4.4u/ha): <input type="text" class="form-control" value="{{ $results[0][1]['result5'] }}" readonly></p>
                @endif
                @if (isset($results[0][1]['result6']))
                    <p>Subssolagem (6.6u/ha): <input type="text" class="form-control" value="{{ $results[0][1]['result6'] }}" readonly></p>
                @endif
                @if (isset($results[0][1]['result7']))
                    <p>Pulverização de dessecação pré-plantio (2.2u/ha): <input type="text" class="form-control" value="{{ $results[0][1]['result7'] }}" readonly></p>
                @endif
            </div>
        </div>

        <script>
            document.getElementById("toggleResults-0").addEventListener("click", function() {
                var resultDiv = document.getElementById("individualResults-0");
                if (resultDiv.style.display === "none") {
                    resultDiv.style.display = "block";
                } else {
                    resultDiv.style.display = "none";
                }
            });
        </script>
        @endif
    </div>
</div>
