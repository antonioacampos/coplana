<script>
    $(document).ready(function(){
        $("#toggleResults12").click(function(){
            $("#individualResults12").toggle();
        });
    });
</script>
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h3 class="text-center mb-4">Mão de Obra</h3> 
        <form action="{{ route('calcularMaoDeObraColhedoras') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="number59">Digite o custo unitário da hora de 1 operador de máquinas colhedoras:</label>
                <input type="number" class="form-control" id="number59" name="number59" placeholder="Digite o custo unitário" step="any" value="{{ old('number59') }}">
                @if ($errors->has('number59'))
                    <span class="text-danger">{{ $errors->first('number59') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="number60">Digite o custo unitário da hora de 2 auxiliares de operadores de máquinas colhedoras:</label>
                <input type="number" class="form-control" id="number60" name="number60" placeholder="Digite o custo unitário" step="any" value="{{ old('number60') }}">
                @if ($errors->has('number60'))
                    <span class="text-danger">{{ $errors->first('number60') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="number61">Digite o custo unitário da hora de 1 técnico agrícola:</label>
                <input type="number" class="form-control" id="number61" name="number61" placeholder="Digite o custo unitário" step="any" value="{{ old('number61') }}">
                @if ($errors->has('number61'))
                    <span class="text-danger">{{ $errors->first('number61') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="number62">Digite o custo unitário da hora de 4 manuseadores e carregadores de produtos:</label>
                <input type="number" class="form-control" id="number62" name="number62" placeholder="Digite o custo unitário" step="any" value="{{ old('number62') }}">
                @if ($errors->has('number62'))
                    <span class="text-danger">{{ $errors->first('number62') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="number63">Digite o custo unitário da hora de 1 motorista de caminhão:</label>
                <input type="number" class="form-control" id="number63" name="number63" placeholder="Digite o custo unitário" step="any" value="{{ old('number63') }}">
                @if ($errors->has('number63'))
                    <span class="text-danger">{{ $errors->first('number63') }}</span>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Calcular</button>
        </form>

        @if (isset($total12))
        <div class="mt-4 text-center">
            <h4>Resultado Total: <input type="text" class="form-control" value="{{ $total12 }}" readonly></h4>
            <button id="toggleResults12" class="btn btn-secondary mt-3">Mostrar/Esconder Resultados Individuais</button>
            
            <div id="individualResults12" class="mt-3" style="display:none;">
                <p>1 operador de máquinas colhedoras (6h/ha): <input type="text" class="form-control" value="{{ $result59 }}" readonly></p>
                <p>2 auxiliares de operadores de máquinas colhedoras (12h/ha): <input type="text" class="form-control" value="{{ $result60 }}" readonly></p>
                <p>1 técnico agrícola (2h/ha): <input type="text" class="form-control" value="{{ $result61 }}" readonly></p>
                <p>4 manuseadores e carregadores de produtos (24h/ha): <input type="text" class="form-control" value="{{ $result62 }}" readonly></p>
                <p>1 motorista de caminhão (2h/ha): <input type="text" class="form-control" value="{{ $result63 }}" readonly></p>
            </div>
        </div>
        @endif
    </div>
</div>
