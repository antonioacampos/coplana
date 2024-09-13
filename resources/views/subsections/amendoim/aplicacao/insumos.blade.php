<script>
    $(document).ready(function(){
        $("#toggleResults").click(function(){
            $("#individualResults").toggle();
        });
    });
</script>

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h3 class="text-center mb-4">Custo de aplicação de insumos</h3>
        <form action="{{ route('calcular') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="calcario">Digite o custo unitário da tonelada do calcário:</label>
                <input type="number" class="form-control" id="calcario" name="calcario" placeholder="Digite o custo do calcário" step="any" value="{{ old('calcario') }}">
                @if ($errors->has('calcario'))
                    <span class="text-danger">{{ $errors->first('calcario') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="gesso">Digite o custo unitário da tonelada do gesso agrícola:</label>
                <input type="number" class="form-control" id="gesso" name="gesso" placeholder="Digite o custo do gesso agrícola" step="any" value="{{ old('gesso') }}">
                @if ($errors->has('gesso'))
                    <span class="text-danger">{{ $errors->first('gesso') }}</span>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Calcular</button>
        </form>

        @if (isset($total))
        <div class="mt-4 text-center">
            <h4>Resultado Total: <input type="text" class="form-control" value="{{ $total }}" readonly></h4>
            <button id="toggleResults" class="btn btn-secondary mt-3">Mostrar/Esconder Resultados Individuais</button>
            
            <div id="individualResults" class="mt-3" style="display:none;">
                <p>Calcário (2,5 ton/ha): <input type="text" class="form-control" value="{{ $result1 }}" readonly></p>
                <p>Gesso Agrícola (1,5 ton/ha): <input type="text" class="form-control" value="{{ $result2 }}" readonly></p>
            </div>
        </div>
        @endif
    </div>
</div>
