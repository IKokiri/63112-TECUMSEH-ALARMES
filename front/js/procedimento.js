const controller = "FalhaProcedimentoController"
const FalhaController = "FalhaController"
const EquipamentoController = "EquipamentoController"
const EquipamentoFalhaController = "EquipamentoFalhaController"

$(document).ready(function(){

inicio();

function inicio(){
    carregar_selects();
    $('#modal_principal').modal('hide')
}

function carregar_selects(){
    load_equipamentos();
}

function load_equipamentos(){

    formData = new FormData();
    formData.append('class', EquipamentoController);
    formData.append('method', 'read');

    fetch(base_request,{
        method:'post',
        body: formData
    })
    .then(response => response.json())
    .then(data => {        
        options = "<option value='0'>SELECIONE</option>"
        dados = data.result_array
        for(linha in dados){
            options += `
            <option value="${dados[linha].id}">
            ${dados[linha].tag} - ${dados[linha].equipamento}
            </option>
            `
        }
        document.querySelector("#id_equipamento").innerHTML = options
    })
    .catch(console.error);
}

function load_falhas_equipamento(id_equipamento){

    formData = new FormData();
    formData.append('class', EquipamentoFalhaController);
    formData.append('id_equipamento', id_equipamento);
    formData.append('method', 'readFalhasEquipamento');

    fetch(base_request,{
        method:'post',
        body: formData
    })
    .then(response => response.json())
    .then(data => {        
        options = "<option value='0'>SELECIONE</option>"
        dados = data.result_array
        for(linha in dados){
            options += `
            <option value="${dados[linha].id}">
            ${dados[linha].tag} - ${dados[linha].falha}
            </option>
            `
        }
        document.querySelector("#id_falha").innerHTML = options
    })
    .catch(console.error);
}

function grid_principal(id_falha,id_equipamento){

    formData = new FormData();
    formData.append('class', controller);
    formData.append('method', 'procedimentoFalhaEquipamento');
    formData.append('id_falha', id_falha);
    formData.append('id_equipamento', id_equipamento);

    fetch(base_request,{
        method:'post',
        body: formData
    })
    .then(response => response.json())
    .then(data => {        
        grid = ""
        titulo = ""

        document.querySelector(".grid").innerHTML = grid
        dados = data.result_array
        for(linha in dados){
            titulo = `SOLUÇÃO FALHA: ${dados[linha].tag_equipamento} - ${dados[linha].equipamento}/${dados[linha].tag_falha} - ${dados[linha].falha}`
            obs = `<p class='text-danger'>${dados[linha].observacao}</p>`
            grid += 
            `
                <tr>
                    <td>${dados[linha].ordem}º - ${dados[linha].procedimento}</td>
                </tr>
            `
        
        }
        document.querySelector("#titulo_procedimento").innerHTML = titulo+obs
        document.querySelector(".grid").innerHTML = grid
    })
    .catch(console.error);
}
$(document).on("change","#id_equipamento",function(){
    id_equipamento = document.querySelector("#id_equipamento").value
    load_falhas_equipamento(id_equipamento);
})

$(document).on("change","#id_falha",function(){
    id_equipamento = document.querySelector("#id_equipamento").value
    id_falha = document.querySelector("#id_falha").value
    grid_principal(id_falha,id_equipamento)
})
})
