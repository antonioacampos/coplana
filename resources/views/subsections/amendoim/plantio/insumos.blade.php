<script>
    $(document).ready(function(){
        $("#toggleResults3").click(function(){
            $("#individualResults3").toggle();
        });
    });
</script>
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h3 class="text-center mb-4">Insumos</h3> 
        <form action="{{ route('calcularInsumos') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="number13">Digite o custo unitário de sementes de amendoim:</label>
                <input type="number" class="form-control" id="number13" name="number13" placeholder="Digite o custo unitário" step="any" value="{{ old('number13') }}">
                @if ($errors->has('number13'))
                    <span class="text-danger">{{ $errors->first('number13') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="number14">Digite o custo unitário de fertilizante - Nitrogênio:</label>
                <input type="number" class="form-control" id="number14" name="number14" placeholder="Digite o custo unitário" step="any" value="{{ old('number14') }}">
                @if ($errors->has('number14'))
                    <span class="text-danger">{{ $errors->first('number14') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="number15">Digite o custo unitário de fertilizante - Fósforo:</label>
                <input type="number" class="form-control" id="number15" name="number15" placeholder="Digite o custo unitário" step="any" value="{{ old('number15') }}">
                @if ($errors->has('number15'))
                    <span class="text-danger">{{ $errors->first('number15') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="number16">Digite o custo unitário de fertilizante - Potássio:</label>
                <input type="number" class="form-control" id="number16" name="number16" placeholder="Digite o custo unitário" step="any" value="{{ old('number16') }}">
                @if ($errors->has('number16'))
                    <span class="text-danger">{{ $errors->first('number16') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="number17">Digite o custo unitário da água:</label>
                <input type="number" class="form-control" id="number17" name="number17" placeholder="Digite o custo unitário" step="any" value="{{ old('number17') }}">
                @if ($errors->has('number17'))
                    <span class="text-danger">{{ $errors->first('number17') }}</span>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Calcular</button>
        </form>

        @if (isset($total3))
        <div class="mt-4 text-center">
            <h4>Resultado Total: <input type="text" class="form-control" value="{{ $total3 }}" readonly></h4>
            <button id="toggleResults3" class="btn btn-secondary mt-3">Mostrar/Esconder Resultados Individuais</button>
            
            <div id="individualResults3" class="mt-3" style="display:none;">
                <p>Sementes de amendoim (0,1 ton/ha): <input type="text" class="form-control" value="{{ $result13 }}" readonly></p>
                <p>Fertilizante - Nitrogênio (0,075 ton/ha): <input type="text" class="form-control" value="{{ $result14 }}" readonly></p>
                <p>Fertilizante - Fósforo (0,25 ton/ha): <input type="text" class="form-control" value="{{ $result15 }}" readonly></p>
                <p>Fertilizante - Potássio (0,20 ton/ha): <input type="text" class="form-control" value="{{ $result16 }}" readonly></p>
                <p>Água (700 m³/ha): <input type="text" class="form-control" value="{{ $result17 }}" readonly></p>
            </div>
        </div>
        @endif
    </div>
</div>
