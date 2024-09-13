<script>
    $(document).ready(function(){
        $("#toggleResults10").click(function(){
            $("#individualResults10").toggle();
        });
    });
</script>
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h3 class="text-center mb-4">Insumos</h3> 
        <form action="{{ route('calcular') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="number52">Digite o custo unitário do diesel (por litro):</label>
                <input type="number" class="form-control" id="number52" name="number52" placeholder="Digite o custo unitário" step="any" value="{{ old('number52') }}">
                @if ($errors->has('number52'))
                    <span class="text-danger">{{ $errors->first('number52') }}</span>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Calcular</button>
        </form>

        @if (isset($total10))
        <div class="mt-4 text-center">
            <h4>Resultado Total: <input type="text" class="form-control" value="{{ $total10 }}" readonly></h4>
            <button id="toggleResults10" class="btn btn-secondary mt-3">Mostrar/Esconder Resultados Individuais</button>
            
            <div id="individualResults10" class="mt-3" style="display:none;">
                <p>Diesel (13 litros/ha): <input type="text" class="form-control" value="{{ $result52 }}" readonly></p>
            </div>
        </div>
        @endif
    </div>
</div>
