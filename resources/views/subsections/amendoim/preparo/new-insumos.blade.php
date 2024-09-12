<div class="card shadow-sm mb-4">   
    <div class="card-body">
         <h3 class="text-center mb-4">Insumos</h3>
         <form action="{{ route('calcular') }}" method="POST">
             @csrf
             <div class="form-group">
                 <label for="inputs[1][number1]">Digite o custo unitário do calcário (/100kg):</label>
                 <input type="number" class="form-control" id="inputs[1][number1]" name="inputs[1][number1]" placeholder="Digite o custo unitário" step="any" value="{{ old('inputs.1.number1') }}">
                 @if ($errors->has('inputs.1.number1'))
                     <span class="text-danger">{{ $errors->first('inputs.1.number1') }}</span>
                 @endif
             </div>
 
             <div class="form-group">
                 <label for="inputs[1][number2]">Digite o custo unitário do fertilizante fosfatado (/100kg):</label>
                 <input type="number" class="form-control" id="inputs[1][number2]" name="inputs[1][number2]" placeholder="Digite o custo unitário" step="any" value="{{ old('inputs.1.number2') }}">
                 @if ($errors->has('inputs.1.number2'))
                     <span class="text-danger">{{ $errors->first('inputs.1.number2') }}</span>
                 @endif
             </div>
 
             <div class="form-group">
                 <label for="inputs[1][number3]">Digite o custo unitário do fertilizante potássico (/100kg):</label>
                 <input type="number" class="form-control" id="inputs[1][number3]" name="inputs[1][number3]" placeholder="Digite o custo unitário" step="any" value="{{ old('inputs.1.number3') }}">
                 @if ($errors->has('inputs.1.number3'))
                     <span class="text-danger">{{ $errors->first('inputs.1.number3') }}</span>
                 @endif
             </div>
 
             <div class="form-group">
                 <label for="inputs[1][number4]">Digite o custo unitário do fertilizante nitrogenado (/100kg):</label>
                 <input type="number" class="form-control" id="inputs[1][number4]" name="inputs[1][number4]" placeholder="Digite o custo unitário" step="any" value="{{ old('inputs.1.number4') }}">
                 @if ($errors->has('inputs.1.number4'))
                     <span class="text-danger">{{ $errors->first('inputs.1.number4') }}</span>
                 @endif
             </div>
 
             <div class="form-group">
                 <label for="inputs[1][number5]">Digite o custo unitário dos micronutrientes:</label>
                 <input type="number" class="form-control" id="inputs[1][number5]" name="inputs[1][number5]" placeholder="Digite o custo unitário" step="any" value="{{ old('inputs.1.number5') }}">
                 @if ($errors->has('inputs.1.number5'))
                     <span class="text-danger">{{ $errors->first('inputs.1.number5') }}</span>
                 @endif
             </div>
             <button type="submit" class="btn btn-primary">Calcular</button>
         </form>
         {{-- {{dd($results[1][0])}} --}}
         @if (isset($results[1]))
         <div class="mt-4 text-center">
             <h4>Resultado Total: <input type="text" class="form-control" value="{{ $results[1][0] }}" readonly></h4>
             <button id="toggleResults-1" class="btn btn-secondary mt-3">Mostrar/Esconder Resultados Individuais</button>
             
             <div id="individualResults-1" class="mt-3" style="display:none;">
                 @if (isset($results[1][1]['result1']))
                     <p>Calcário (1.5 ton/ha): <input type="text" class="form-control" value="{{ $results[1][1]['result1'] }}" readonly></p>
                 @endif
                 @if (isset($results[1][1]['result2']))
                     <p>Fertilizante fosfatado (200 kg/ha): <input type="text" class="form-control" value="{{ $results[1][1]['result2'] }}" readonly></p>
                 @endif
                 @if (isset($results[1][1]['result3']))
                     <p>Fertilizante potássico (100 kg/ha): <input type="text" class="form-control" value="{{ $results[1][1]['result3'] }}" readonly></p>
                 @endif
                 @if (isset($results[1][1]['result4']))
                     <p>Fertilizante nitrogenado (75 kg/ha): <input type="text" class="form-control" value="{{ $results[1][1]['result4'] }}" readonly></p>
                 @endif
                 @if (isset($results[1][1]['result5']))
                     <p>Micronutrientes (4.4u/ha): <input type="text" class="form-control" value="{{ $results[1][1]['result5'] }}" readonly></p>
                 @endif
             </div>
         </div>
         <script>
             document.getElementById("toggleResults-1").addEventListener("click", function() {
                 var resultDiv = document.getElementById("individualResults-1");
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
 