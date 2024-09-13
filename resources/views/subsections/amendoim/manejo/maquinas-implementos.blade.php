<script>
    $(document).ready(function(){
        $("#toggleResults8").click(function(){
            $("#individualResults8").toggle();
        });
    });
</script>
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h3 class="text-center mb-4">Máquinas e Implementos (2 dias)</h3> 
        <form action="{{ route('calcular') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="number38">Digite o custo unitário da depreciação do trator agrícola:</label>
                <input type="number" class="form-control" id="number38" name="number38" placeholder="Digite o custo unitário" step="any" value="{{ old('number38') }}">
                @if ($errors->has('number38'))
                    <span class="text-danger">{{ $errors->first('number38') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="number39">Digite o custo unitário da depreciação dos pulverizadores:</label>
                <input type="number" class="form-control" id="number39" name="number39" placeholder="Digite o custo unitário" step="any" value="{{ old('number39') }}">
                @if ($errors->has('number39'))
                    <span class="text-danger">{{ $errors->first('number39') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="number40">Digite o custo unitário da depreciação da distribuidora de fertilizantes:</label>
                <input type="number" class="form-control" id="number40" name="number40" placeholder="Digite o custo unitário" step="any" value="{{ old('number40') }}">
                @if ($errors->has('number40'))
                    <span class="text-danger">{{ $errors->first('number40') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="number41">Digite o custo unitário da depreciação da distribuidora de corretivos:</label>
                <input type="number" class="form-control" id="number41" name="number41" placeholder="Digite o custo unitário" step="any" value="{{ old('number41') }}">
                @if ($errors->has('number41'))
                    <span class="text-danger">{{ $errors->first('number41') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="number42">Digite o custo unitário da depreciação dos caminhões:</label>
                <input type="number" class="form-control" id="number42" name="number42" placeholder="Digite o custo unitário" step="any" value="{{ old('number42') }}">
                @if ($errors->has('number42'))
                    <span class="text-danger">{{ $errors->first('number42') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="number43">Digite o custo do diesel para máquinas e implementos (litros):</label>
                <input type="number" class="form-control" id="number43" name="number43" placeholder="Digite o custo do diesel" step="any" value="{{ old('number43') }}">
                @if ($errors->has('number43'))
                    <span class="text-danger">{{ $errors->first('number43') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="number44">Digite o custo do diesel para caminhões (litros):</label>
                <input type="number" class="form-control" id="number44" name="number44" placeholder="Digite o custo do diesel" step="any" value="{{ old('number44') }}">
                @if ($errors->has('number44'))
                    <span class="text-danger">{{ $errors->first('number44') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="number45">Digite o custo da manutenção preventiva:</label>
                <input type="number" class="form-control" id="number45" name="number45" placeholder="Digite o custo da manutenção preventiva" step="any" value="{{ old('number45') }}">
                @if ($errors->has('number45'))
                    <span class="text-danger">{{ $errors->first('number45') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="number46">Digite o custo da manutenção corretiva:</label>
                <input type="number" class="form-control" id="number46" name="number46" placeholder="Digite o custo da manutenção corretiva" step="any" value="{{ old('number46') }}">
                @if ($errors->has('number46'))
                    <span class="text-danger">{{ $errors->first('number46') }}</span>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Calcular</button>
        </form>

        @if (isset($total8))
        <div class="mt-4 text-center">
            <h4>Resultado Total: <input type="text" class="form-control" value="{{ $total8 }}" readonly></h4>
            <button id="toggleResults8" class="btn btn-secondary mt-3">Mostrar/Esconder Resultados Individuais</button>
            
            <div id="individualResults8" class="mt-3" style="display:none;">
                <p>Depreciação do trator agrícola (0,55% de 10% ao ano do CU): <input type="text" class="form-control" value="{{ $result38 }}" readonly></p>
                <p>Depreciação dos pulverizadores (0,55% de 15% ao ano do CU): <input type="text" class="form-control" value="{{ $result39 }}" readonly></p>
                <p>Depreciação da distribuidora de fertilizantes (0,55% de 10% ao ano do CU): <input type="text" class="form-control" value="{{ $result40 }}" readonly></p>
                <p>Depreciação da distribuidora de corretivos (0,55% de 10% ao ano do CU): <input type="text" class="form-control" value="{{ $result41 }}" readonly></p>
                <p>Depreciação dos caminhões (0,55% de 10% ao ano do CU): <input type="text" class="form-control" value="{{ $result42 }}" readonly></p>
                <p>Combustíveis (máquinas e implementos) (8 litros de diesel): <input type="text" class="form-control" value="{{ $result43 }}" readonly></p>
                <p>Combustíveis (caminhões) (8 litros de diesel): <input type="text" class="form-control" value="{{ $result44 }}" readonly></p>
                <p>Manutenção preventiva (1 manut): <input type="text" class="form-control" value="{{ $result45 }}" readonly></p>
                <p>Manutenção corretiva (1 manut): <input type="text" class="form-control" value="{{ $result46 }}" readonly></p>
            </div>
        </div>
        @endif
    </div>
</div>
