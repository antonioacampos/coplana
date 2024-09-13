<script>
    $(document).ready(function(){
        $("#toggleResults7").click(function(){
            $("#individualResults7").toggle();
        });
    });
</script>
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h3 class="text-center mb-4">Insumos</h3> 
        <form action="{{ route('calcularInsumosPosPlantio') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="number31">Digite o custo unitário do fertilizante Nitrogênio (pós plantio):</label>
                <input type="number" class="form-control" id="number31" name="number31" placeholder="Digite o custo unitário" step="any" value="{{ old('number31') }}">
                @if ($errors->has('number31'))
                    <span class="text-danger">{{ $errors->first('number31') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="number32">Digite o custo unitário do fertilizante Fósforo (pós plantio):</label>
                <input type="number" class="form-control" id="number32" name="number32" placeholder="Digite o custo unitário" step="any" value="{{ old('number32') }}">
                @if ($errors->has('number32'))
                    <span class="text-danger">{{ $errors->first('number32') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="number33">Digite o custo unitário do fertilizante Potássio (pós plantio):</label>
                <input type="number" class="form-control" id="number33" name="number33" placeholder="Digite o custo unitário" step="any" value="{{ old('number33') }}">
                @if ($errors->has('number33'))
                    <span class="text-danger">{{ $errors->first('number33') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="number34">Digite o custo unitário dos micronutrientes (pós plantio):</label>
                <input type="number" class="form-control" id="number34" name="number34" placeholder="Digite o custo unitário" step="any" value="{{ old('number34') }}">
                @if ($errors->has('number34'))
                    <span class="text-danger">{{ $errors->first('number34') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="number35">Digite o custo unitário dos inseticidas (manejo sanitário):</label>
                <input type="number" class="form-control" id="number35" name="number35" placeholder="Digite o custo unitário" step="any" value="{{ old('number35') }}">
                @if ($errors->has('number35'))
                    <span class="text-danger">{{ $errors->first('number35') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="number36">Digite o custo unitário dos fungicidas (manejo sanitário):</label>
                <input type="number" class="form-control" id="number36" name="number36" placeholder="Digite o custo unitário" step="any" value="{{ old('number36') }}">
                @if ($errors->has('number36'))
                    <span class="text-danger">{{ $errors->first('number36') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="number37">Digite o custo unitário dos herbicidas (manejo sanitário):</label>
                <input type="number" class="form-control" id="number37" name="number37" placeholder="Digite o custo unitário" step="any" value="{{ old('number37') }}">
                @if ($errors->has('number37'))
                    <span class="text-danger">{{ $errors->first('number37') }}</span>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Calcular</button>
        </form>

        @if (isset($total7))
        <div class="mt-4 text-center">
            <h4>Resultado Total: <input type="text" class="form-control" value="{{ $total7 }}" readonly></h4>
            <button id="toggleResults7" class="btn btn-secondary mt-3">Mostrar/Esconder Resultados Individuais</button>
            
            <div id="individualResults7" class="mt-3" style="display:none;">
                <p>Fertilizante Nitrogênio (50 kg/ha): <input type="text" class="form-control" value="{{ $result31 }}" readonly></p>
                <p>Fertilizante Fósforo (25 kg/ha): <input type="text" class="form-control" value="{{ $result32 }}" readonly></p>
                <p>Fertilizante Potássio (40 kg/ha): <input type="text" class="form-control" value="{{ $result33 }}" readonly></p>
                <p>Micronutrientes (1,5 kg/ha): <input type="text" class="form-control" value="{{ $result34 }}" readonly></p>
                <p>Inseticidas (1 aplicação/ha): <input type="text" class="form-control" value="{{ $result35 }}" readonly></p>
                <p>Fungicidas (1 aplicação/ha): <input type="text" class="form-control" value="{{ $result36 }}" readonly></p>
                <p>Herbicidas (1 aplicação/ha): <input type="text" class="form-control" value="{{ $result37 }}" readonly></p>
            </div>
        </div>
        @endif
    </div>
</div>
