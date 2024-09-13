<script>
    $(document).ready(function(){
        $("#toggleResults9").click(function(){
            $("#individualResults9").toggle();
        });
    });
</script>
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h3 class="text-center mb-4">Mão de Obra</h3> 
        <form action="{{ route('calcularMaoDeObraDetalhada') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="number47">Digite o custo unitário da hora de 1 técnico agrícola:</label>
                <input type="number" class="form-control" id="number47" name="number47" placeholder="Digite o custo unitário" step="any" value="{{ old('number47') }}">
                @if ($errors->has('number47'))
                    <span class="text-danger">{{ $errors->first('number47') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="number48">Digite o custo unitário da hora de 1 operador de trator agrícola:</label>
                <input type="number" class="form-control" id="number48" name="number48" placeholder="Digite o custo unitário" step="any" value="{{ old('number48') }}">
                @if ($errors->has('number48'))
                    <span class="text-danger">{{ $errors->first('number48') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="number49">Digite o custo unitário da hora de 2 auxiliares de operação (tratoristas):</label>
                <input type="number" class="form-control" id="number49" name="number49" placeholder="Digite o custo unitário" step="any" value="{{ old('number49') }}">
                @if ($errors->has('number49'))
                    <span class="text-danger">{{ $errors->first('number49') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="number50">Digite o custo unitário da hora de 1 motorista de caminhão (transporte de insumos):</label>
                <input type="number" class="form-control" id="number50" name="number50" placeholder="Digite o custo unitário" step="any" value="{{ old('number50') }}">
                @if ($errors->has('number50'))
                    <span class="text-danger">{{ $errors->first('number50') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="number51">Digite o custo unitário da hora de 4 mão de obra para manuseio e aplicação manual:</label>
                <input type="number" class="form-control" id="number51" name="number51" placeholder="Digite o custo unitário" step="any" value="{{ old('number51') }}">
                @if ($errors->has('number51'))
                    <span class="text-danger">{{ $errors->first('number51') }}</span>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Calcular</button>
        </form>

        @if (isset($total9))
        <div class="mt-4 text-center">
            <h4>Resultado Total: <input type="text" class="form-control" value="{{ $total9 }}" readonly></h4>
            <button id="toggleResults9" class="btn btn-secondary mt-3">Mostrar/Esconder Resultados Individuais</button>
            
            <div id="individualResults9" class="mt-3" style="display:none;">
                <p>1 técnico agrícola (4h/ha): <input type="text" class="form-control" value="{{ $result47 }}" readonly></p>
                <p>1 operador de trator agrícola (4h/ha): <input type="text" class="form-control" value="{{ $result48 }}" readonly></p>
                <p>2 auxiliares de operação (8h/ha): <input type="text" class="form-control" value="{{ $result49 }}" readonly></p>
                <p>1 motorista de caminhão (transporte de insumos) (2h/ha): <input type="text" class="form-control" value="{{ $result50 }}" readonly></p>
                <p>4 mão de obra para manuseio e aplicação manual (24h/ha): <input type="text" class="form-control" value="{{ $result51 }}" readonly></p>
            </div>
        </div>
        @endif
    </div>
</div>
