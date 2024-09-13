<script>
    $(document).ready(function(){
        $("#toggleResults4").click(function(){
            $("#individualResults4").toggle();
        });
    });
</script>
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h3 class="text-center mb-4">Máquinas e Implementos (2 dias)</h3> 
        <form action="{{ route('calcular') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="number18">Digite o custo unitário de depreciação do trator agrícola:</label>
                <input type="number" class="form-control" id="number18" name="number18" placeholder="Digite o custo unitário" step="any" value="{{ old('number18') }}">
                @if ($errors->has('number18'))
                    <span class="text-danger">{{ $errors->first('number18') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="number19">Digite o custo unitário de depreciação da plantadeira de precisão:</label>
                <input type="number" class="form-control" id="number19" name="number19" placeholder="Digite o custo unitário" step="any" value="{{ old('number19') }}">
                @if ($errors->has('number19'))
                    <span class="text-danger">{{ $errors->first('number19') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="number20">Digite o custo unitário de depreciação dos caminhões:</label>
                <input type="number" class="form-control" id="number20" name="number20" placeholder="Digite o custo unitário" step="any" value="{{ old('number20') }}">
                @if ($errors->has('number20'))
                    <span class="text-danger">{{ $errors->first('number20') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="number21">Digite o custo do diesel para máquinas e implementos (litros):</label>
                <input type="number" class="form-control" id="number21" name="number21" placeholder="Digite o custo do diesel" step="any" value="{{ old('number21') }}">
                @if ($errors->has('number21'))
                    <span class="text-danger">{{ $errors->first('number21') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="number22">Digite o custo do diesel para caminhões (litros):</label>
                <input type="number" class="form-control" id="number22" name="number22" placeholder="Digite o custo do diesel" step="any" value="{{ old('number22') }}">
                @if ($errors->has('number22'))
                    <span class="text-danger">{{ $errors->first('number22') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="number23">Digite o custo de manutenção preventiva:</label>
                <input type="number" class="form-control" id="number23" name="number23" placeholder="Digite o custo da manutenção preventiva" step="any" value="{{ old('number23') }}">
                @if ($errors->has('number23'))
                    <span class="text-danger">{{ $errors->first('number23') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="number24">Digite o custo de manutenção corretiva:</label>
                <input type="number" class="form-control" id="number24" name="number24" placeholder="Digite o custo da manutenção corretiva" step="any" value="{{ old('number24') }}">
                @if ($errors->has('number24'))
                    <span class="text-danger">{{ $errors->first('number24') }}</span>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Calcular</button>
        </form>

        @if (isset($total4))
        <div class="mt-4 text-center">
            <h4>Resultado Total: <input type="text" class="form-control" value="{{ $total4 }}" readonly></h4>
            <button id="toggleResults4" class="btn btn-secondary mt-3">Mostrar/Esconder Resultados Individuais</button>
            
            <div id="individualResults4" class="mt-3" style="display:none;">
                <p>Depreciação do trator agrícola (0,55% de 10% ao ano do CU): <input type="text" class="form-control" value="{{ $result18 }}" readonly></p>
                <p>Depreciação da plantadeira de precisão (0,55% de 7% ao ano do CU): <input type="text" class="form-control" value="{{ $result19 }}" readonly></p>
                <p>Depreciação dos caminhões (0,55% de 10% ao ano do CU): <input type="text" class="form-control" value="{{ $result20 }}" readonly></p>
                <p>Combustível (máquinas e implementos) (10 litros de diesel): <input type="text" class="form-control" value="{{ $result21 }}" readonly></p>
                <p>Combustível (caminhões) (8 litros de diesel): <input type="text" class="form-control" value="{{ $result22 }}" readonly></p>
                <p>Manutenção preventiva (1 manut): <input type="text" class="form-control" value="{{ $result23 }}" readonly></p>
                <p>Manutenção corretiva (1 manut): <input type="text" class="form-control" value="{{ $result24 }}" readonly></p>
            </div>
        </div>
        @endif
    </div>
</div>
