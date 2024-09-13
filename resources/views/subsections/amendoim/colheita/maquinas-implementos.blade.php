<script>
    $(document).ready(function(){
        $("#toggleResults11").click(function(){
            $("#individualResults11").toggle();
        });
    });
</script>
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h3 class="text-center mb-4">Máquinas e Implementos (5 dias)</h3> 
        <form action="{{ route('calcular') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="number53">Digite o custo unitário da depreciação das máquinas colhedoras:</label>
                <input type="number" class="form-control" id="number53" name="number53" placeholder="Digite o custo unitário" step="any" value="{{ old('number53') }}">
                @if ($errors->has('number53'))
                    <span class="text-danger">{{ $errors->first('number53') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="number54">Digite o custo unitário da depreciação dos caminhões:</label>
                <input type="number" class="form-control" id="number54" name="number54" placeholder="Digite o custo unitário" step="any" value="{{ old('number54') }}">
                @if ($errors->has('number54'))
                    <span class="text-danger">{{ $errors->first('number54') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="number55">Digite o custo do diesel para máquinas e implementos (litros):</label>
                <input type="number" class="form-control" id="number55" name="number55" placeholder="Digite o custo do diesel" step="any" value="{{ old('number55') }}">
                @if ($errors->has('number55'))
                    <span class="text-danger">{{ $errors->first('number55') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="number56">Digite o custo do diesel para caminhões (litros):</label>
                <input type="number" class="form-control" id="number56" name="number56" placeholder="Digite o custo do diesel" step="any" value="{{ old('number56') }}">
                @if ($errors->has('number56'))
                    <span class="text-danger">{{ $errors->first('number56') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="number57">Digite o custo da manutenção preventiva:</label>
                <input type="number" class="form-control" id="number57" name="number57" placeholder="Digite o custo da manutenção preventiva" step="any" value="{{ old('number57') }}">
                @if ($errors->has('number57'))
                    <span class="text-danger">{{ $errors->first('number57') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="number58">Digite o custo da manutenção corretiva:</label>
                <input type="number" class="form-control" id="number58" name="number58" placeholder="Digite o custo da manutenção corretiva" step="any" value="{{ old('number58') }}">
                @if ($errors->has('number58'))
                    <span class="text-danger">{{ $errors->first('number58') }}</span>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Calcular</button>
        </form>

        @if (isset($total11))
        <div class="mt-4 text-center">
            <h4>Resultado Total: <input type="text" class="form-control" value="{{ $total11 }}" readonly></h4>
            <button id="toggleResults11" class="btn btn-secondary mt-3">Mostrar/Esconder Resultados Individuais</button>
            
            <div id="individualResults11" class="mt-3" style="display:none;">
                <p>Máquinas colhedoras (1,39% de 10% ao ano do CU): <input type="text" class="form-control" value="{{ $result53 }}" readonly></p>
                <p>Caminhões (1,38% de 10% ao ano do CU): <input type="text" class="form-control" value="{{ $result54 }}" readonly></p>
                <p>Combustíveis (máquinas e implementos) (18 litros de diesel): <input type="text" class="form-control" value="{{ $result55 }}" readonly></p>
                <p>Combustíveis (caminhões) (12 litros de diesel): <input type="text" class="form-control" value="{{ $result56 }}" readonly></p>
                <p>Manutenção preventiva (1 manut): <input type="text" class="form-control" value="{{ $result57 }}" readonly></p>
                <p>Manutenção corretiva (1 manut): <input type="text" class="form-control" value="{{ $result58 }}" readonly></p>
            </div>
        </div>
        @endif
    </div>
</div>
