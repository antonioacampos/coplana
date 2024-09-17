@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center">
    <div class="w-100 card mt-2" style="max-width: 600px;">
        <div class="card-body p-0">
            <div  class="card-header">
                <h1>Calculadora do Amendoim</h1>
                <h2>Selecione as seções para calcular</h2>
            </div>
        <form id="sectionForm">
            <div class="form-group p-3">
                <input type="checkbox" id="preparo" name="sections[]" value="preparo">
                <label for="preparo">Preparo do solo</label><br>
                <input type="checkbox" id="aplicacao" name="sections[]" value="aplicacao">
                <label for="aplicacao">Aplicação de corretivos</label><br>
                <input type="checkbox" id="plantio" name="sections[]" value="plantio">
                <label for="plantio">Plantio</label><br>
                <input type="checkbox" id="manejo" name="sections[]" value="manejo">
                <label for="manejo">Manejo</label><br>
                <input type="checkbox" id="colheita" name="sections[]" value="colheita">
                <label for="colheita">Colheita</label><br>
            </div>
            <button type="button" class="btn btn-primary m-2" onclick="loadInputs()">Carregar Inputs</button>
            <button type="button" class="btn btn-success m-2" onclick="submitData()">Enviar Dados</button>
        </form>
        <div id="inputFields" class="m-2"></div>
        </div>
    </div>
</div>

<script>
function loadInputs() {
    let selectedSections = [];
    document.querySelectorAll('input[name="sections[]"]:checked').forEach((checkbox) => {
        selectedSections.push(checkbox.value);
    });

    // Enviar os dados via AJAX para o controlador
    fetch('{{ route("get-inputs") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ sections: selectedSections })
    })
    .then(response => response.json())
    .then(data => {
        // Limpar o campo de inputs
        const inputFields = document.getElementById('inputFields');
        inputFields.innerHTML = '';

        // Adicionar os inputs ao DOM
        data.inputs.forEach(input => {
            const inputElement = document.createElement('div');
            inputElement.classList.add('form-group');
            inputElement.innerHTML = `<label for="${input.name}">${input.label}</label>
                                      <input type="number" class="form-control" id="${input.name}" name="${input.name}" placeholder="${input.placeholder}">`;
            inputFields.appendChild(inputElement);
        });
    })
    .catch(error => console.error('Error:', error));
}

function submitData() {
    let selectedSections = [];
    let inputData = {};

    // Coletar seções selecionadas
    document.querySelectorAll('input[name="sections[]"]:checked').forEach((checkbox) => {
        selectedSections.push(checkbox.value);
    });

    // Coletar valores dos inputs
    document.querySelectorAll('#inputFields input').forEach((input) => {
        inputData[input.name] = input.value;
    });

    // Criar formulário dinamicamente
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '{{ route("calcular") }}';  // Certifique-se de que a rota está correta

    // Adicionar CSRF token
    const csrfInput = document.createElement('input');
    csrfInput.type = 'hidden';
    csrfInput.name = '_token';
    csrfInput.value = '{{ csrf_token() }}';
    form.appendChild(csrfInput);

    // Adicionar seções selecionadas
    selectedSections.forEach(section => {
        const sectionInput = document.createElement('input');
        sectionInput.type = 'hidden';
        sectionInput.name = 'sections[]';
        sectionInput.value = section;
        form.appendChild(sectionInput);
    });

    // Adicionar inputs
    for (const key in inputData) {
        const inputElement = document.createElement('input');
        inputElement.type = 'hidden';
        inputElement.name = `inputs[${key}]`;
        inputElement.value = inputData[key];
        form.appendChild(inputElement);
    }

    document.body.appendChild(form);  // Adicionar o formulário ao body
    form.submit();  // Enviar o formulário
}

</script>
@endsection
