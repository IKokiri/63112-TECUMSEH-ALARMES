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
    let id = document.querySelector("#id").value;

    formData.append('id_falha', id_falha);
    formData.append('ordem', ordem);
    formData.append('procedimento', procedimento);
    formData.append('id', id);

    return formData;
}

function limpar_campos(){

    
    let id_falha = document.querySelector("#id_falha").value = "";
    let ordem = document.querySelector("#ordem").value = "";
    let procedimento = document.querySelector("#procedimento").value = "";
    let id = document.querySelector("#id").value = "";

}

function preencher_form(data){

    let id_falha = data.id_falha;
    let ordem = data.ordem;
    let procedimento = data.procedimento;
    let id = data.id;
    
    $('#modal_principal').modal('show')
    document.querySelector("#id_falha").value = id_falha
    document.querySelector("#ordem").value = ordem
    document.querySelector("#procedimento").value = procedimento
    document.querySelector("#id").value = id
    
}

$(document).on('click','#abrir_modal',function(){
    $('#modal_principal').modal('show')
})

$('#modal_principal').on('hidden.bs.modal', function () {
    document.querySelector("#id").value = ""
  })

$(document).on('click','#salvar',function(){
    formData = carregar_campos()
    id = formData.get("id");

    if(id){
        update(formData)
    }else{
        criar(formData)
    }

})

$(document).on('click','#remover',function(){
    
    id = $(this).attr("data-id");
    
    var res = confirm("Deseja remover o registro?");
    if (res == true) {
        remover(id);
    } else {
    
    }
    
})

$(document).on('click','#edit',function(){

    $('#modal_principal').modal('show')
    id = $(this).attr("data-id");
    edit(id);
    
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
                    <td data-id="${dados[linha].id}" id="edit"><img src="./icons/001-pencil.png"  alt=""></td>
                    <td data-id="${dados[linha].id}" id="remover"><img src="./icons/002-delete.png"  alt=""></td>
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
            inicio()
        })
        .catch(console.error);
}

function remover(id){
    
    formData = new FormData();
    formData.append('class', controller);
    formData.append('method', 'delete');
    formData.append('id', id);
    
        fetch(base_request,{
            method:'post',
            body: formData
        })
        .then(response => response.json())
        .then(data => {     
            inicio()
        })
        .catch(console.error);
}

function edit(id){

    formData = new FormData();
    formData.append('class', controller);
    formData.append('method', 'getId');
    formData.append('id', id);
    
        fetch(base_request,{
            method:'post',
            body: formData
        })
        .then(response => response.json())
        .then(data => {        
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
            inicio()
        })
        .catch(console.error);
}


})
