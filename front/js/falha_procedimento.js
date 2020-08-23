const controller = "FalhaProcedimentoController"
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
function carregar_campos(){

    formData = new FormData();
    let id_falha = document.querySelector("#id_falha").value;
    let ordem = document.querySelector("#ordem").value;
    let procedimento = document.querySelector("#procedimento").value;
    let id_falha_o = document.querySelector("#id_falha_o").value;
    let ordem_o = document.querySelector("#ordem_o").value;
    

    formData.append('id_falha', id_falha);
    formData.append('ordem', ordem);
    formData.append('procedimento', procedimento);
    formData.append('id_falha_o', id_falha_o);
    formData.append('ordem_o', ordem_o);

    return formData;
}

function limpar_campos(){

    let id_falha = document.querySelector("#id_falha").value = "";
    let ordem = document.querySelector("#ordem").value = "";
    let procedimento = document.querySelector("#procedimento").value = "";
    let ordem_o = document.querySelector("#ordem_o").value = "";
    let id_falha_o = document.querySelector("#id_falha_o").value = "";

}

function preencher_form(data){

    let id_falha = data.id_falha;
    let ordem = data.ordem;
    let procedimento = data.procedimento;
    
    
    $('#modal_principal').modal('show')
    document.querySelector("#id_falha").value = id_falha
    document.querySelector("#ordem").value = ordem
    document.querySelector("#procedimento").value = procedimento
    document.querySelector("#id_falha_o").value = id_falha
    document.querySelector("#ordem_o").value = ordem
    
}

$(document).on('click','#abrir_modal',function(){
    $('#modal_principal').modal('show')
})

$('#modal_principal').on('hidden.bs.modal', function () {
    document.querySelector("#id_falha_o").value = ""
    document.querySelector("#ordem_o").value = ""
  })

$(document).on('click','#salvar',function(){
    formData = carregar_campos()
    id_falha_o = formData.get("id_falha_o");
    ordem_o = formData.get("ordem_o");
    
    if(id_falha_o && ordem_o){
        update(formData)
    }else{
        criar(formData)
    }

})

$(document).on('click','#remover',function(){
    
    id_falha = $(this).attr("data-id_falha_o");
    id_ordem = $(this).attr("data-ordem_o");
    
    var res = confirm("Deseja remover o registro?");
    if (res == true) {
        remover(id_falha,id_ordem);
    } else {
    
    }
    
})

$(document).on('click','#edit',function(){

    $('#modal_principal').modal('show')
    id_falha = $(this).attr("data-id_falha_o");
    ordem = $(this).attr("data-ordem_o");
    edit(id_falha,ordem);
    
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
                    <td>${dados[linha].tag} - ${dados[linha].falha}</td>
                    <td>${dados[linha].ordem}</td>
                    <td>${dados[linha].procedimento}</td>
                    <td class="text-center" data-ordem_o="${dados[linha].ordem}" data-id_falha_o="${dados[linha].id_falha}" id="edit"><img src="./icons/001-pencil.png"  alt=""></td>
                    <td class="text-center" data-ordem_o="${dados[linha].ordem}" data-id_falha_o="${dados[linha].id_falha}" id="remover"><img src="./icons/002-delete.png"  alt=""></td>
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
                base_erro(data.MSN.errorInfo[0]);
            }   
            inicio()
        })
        .catch(console.error);
}

function remover(id_falha,ordem){
    
    formData = new FormData();
    formData.append('class', controller);
    formData.append('method', 'delete');
    formData.append('id_falha', id_falha);
    formData.append('ordem', ordem);
    
        fetch(base_request,{
            method:'post',
            body: formData
        })
        .then(response => response.json())
        .then(data => {     
            if(data.MSN){
                base_erro(data.MSN.errorInfo[0]);
            }   
            inicio()
        })
        .catch(console.error);
}

function edit(id_falha,ordem){

    formData = new FormData();
    formData.append('class', controller);
    formData.append('method', 'getId');
    formData.append('id_falha', id_falha);
    formData.append('ordem', ordem);
    
        fetch(base_request,{
            method:'post',
            body: formData
        })
        .then(response => response.json())
        .then(data => {        
            if(data.MSN){
                base_erro(data.MSN.errorInfo[0]);
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
                base_erro(data.MSN.errorInfo[0]);
            } 
            inicio()
        })
        .catch(console.error);
}


})
