const controller = "EquipamentoFalhaController"
const EquipamentoController = "EquipamentoController"
const FalhaController = "FalhaController"

$(document).ready(function(){

inicio();

function inicio(){
    grid_principal();
    carregar_selects();
    limpar_campos()
    $('#modal_principal').modal('hide')
}

function carregar_selects(){
    load_falhas();
    load_equipamentos();
}

function load_falhas(){

    formData = new FormData();
    formData.append('class', FalhaController);
    formData.append('method', 'read');

    fetch(base_request,{
        method:'post',
        body: formData
    })
    .then(response => response.json())
    .then(data => {        
        options = ""
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
        options = ""
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


function carregar_campos(){

    formData = new FormData();
    let id_equipamento = document.querySelector("#id_equipamento").value;
    let id_falha = document.querySelector("#id_falha").value;
    let observacao = document.querySelector("#observacao").value;
    let id_equipamento_o = document.querySelector("#id_equipamento_o").value;
    let id_falha_o = document.querySelector("#id_falha_o").value;

    formData.append('id_equipamento', id_equipamento);
    formData.append('id_falha', id_falha);
    formData.append('observacao', observacao);
    formData.append('id_equipamento_o', id_equipamento_o);
    formData.append('id_falha_o', id_falha_o);

    return formData;
}

function limpar_campos(){

    let id_equipamento = document.querySelector("#id_equipamento").value = "";
    let id_falha = document.querySelector("#id_falha").value = "";
    let observacao = document.querySelector("#observacao").value = "";
    let id_equipamento_o = document.querySelector("#id_equipamento_o").value = "";
    let id_falha_o = document.querySelector("#id_falha_o").value = "";

}

function preencher_form(data){

    let id_equipamento = data.id_equipamento;
    let id_falha = data.id_falha;
    let observacao = data.observacao;
    let id = data.id;
    
    $('#modal_principal').modal('show')
    document.querySelector("#id_equipamento").value = id_equipamento
    document.querySelector("#id_falha").value = id_falha
    document.querySelector("#observacao").value = observacao
    document.querySelector("#id_equipamento_o").value = id_equipamento_o
    document.querySelector("#id_falha_o").value = id_falha_o
    
}

$(document).on('click','#abrir_modal',function(){
    $('#modal_principal').modal('show')
})

$('#modal_principal').on('hidden.bs.modal', function () {
    document.querySelector("#id").value = ""
  })

$(document).on('click','#salvar',function(){
    formData = carregar_campos()
    id_equipamento_o = formData.get("id_equipamento_o");
    id_falha_o = formData.get("id_falha_o");

    if(id_equipamento_o && id_falha_o){
        update(formData)
    }else{
        criar(formData)
    }

})

$(document).on('click','#remover',function(){
    
    id_equipamento_o = $(this).attr("data-id_equipamento_o");
    id_falha_o = $(this).attr("data-id_falha_o");
    
    var res = confirm("Deseja remover o registro?");
    if (res == true) {
        remover(id_equipamento_o,id_falha_o);
    } else {
    
    }
    
})

$(document).on('click','#edit',function(){

    $('#modal_principal').modal('show')
    id_equipamento_o = $(this).attr("data-id_equipamento_o");
    id_falha_o = $(this).attr("data-id_falha_o");
    edit(id_equipamento_o,id_falha_o);
    
})


function grid_principal(){

    formData = new FormData();
    formData.append('class', controller);
    formData.append('method', 'readLazy');

    fetch(base_request,{
        method:'post',
        body: formData
    })
    .then(response => response.json())
    .then(data => {        
        grid = ""
        dados = data.result_array
        for(linha in dados){
            grid += 
            `
                <tr>
                    <td>${dados[linha].tag_equipamento} - ${dados[linha].equipamento}</td>
                    <td>${dados[linha].tag_falha} - ${dados[linha].falha}</td>
                    <td>${dados[linha].observacao}</td>
                    <td class="text-center" data-id_equipamento_o="${dados[linha].id_equipamento}" data-id_falha_o="${dados[linha].id_falha}" id="edit"><img src="./icons/001-pencil.png"  alt=""></td>
                    <td class="text-center" data-id_equipamento_o="${dados[linha].id_equipamento}" data-id_falha_o="${dados[linha].id_falha}" id="remover"><img src="./icons/002-delete.png"  alt=""></td>
                </tr>
            `
        }
        document.querySelector(".grid").innerHTML = grid
    })
    .catch(console.error);
}

// CRIAR
function criar(formData){
    

    formData = carregar_campos();
    formData.append('class', controller);
    formData.append('method', 'create');
    
        fetch(base_request,{
            method:'post',
            body: formData
        })
        .then(response => response.json())
        .then(data => {         
            if(data.MSN){
                base_erro(data.MSN.errorInfo[1]);
            }  
            inicio()
        })
        .catch(console.error);
}

function remover(id_equipamento_o,id_falha_o){
    
    formData = new FormData();
    formData.append('class', controller);
    formData.append('method', 'delete');
    formData.append('id_equipamento_o', id_equipamento_o);
    formData.append('id_falha_o', id_falha_o);
    
        fetch(base_request,{
            method:'post',
            body: formData
        })
        .then(response => response.json())
        .then(data => {      
            if(data.MSN){
                base_erro(data.MSN.errorInfo[1]);
            }  
            inicio()
        })
        .catch(console.error);
}

function edit(id_equipamento_o,id_falha_o){

    formData = new FormData();
    formData.append('class', controller);
    formData.append('method', 'getId');
    formData.append('id_equipamento_o', id_equipamento_o);
    formData.append('id_falha_o', id_falha_o);
    
        fetch(base_request,{
            method:'post',
            body: formData
        })
        .then(response => response.json())
        .then(data => {         
            if(data.MSN){
                base_erro(data.MSN.errorInfo[1]);
            }  
            $linha = data.result_array[0];
            preencher_form($linha);

        })
        .catch(console.error);
}

function update(formData){

    formData.append('class', controller);
    formData.append('method', 'update');
    
        fetch(base_request,{
            method:'post',
            body: formData
        })
        .then(response => response.json())
        .then(data => {       
            if(data.MSN){
                base_erro(data.MSN.errorInfo[1]);
            } 
            inicio()
        })
        .catch(console.error);
}


})
