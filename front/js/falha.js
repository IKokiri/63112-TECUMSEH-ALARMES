const controller = "FalhaController"

$(document).ready(function(){

inicio();

function inicio(){
    grid_principal();
    limpar_campos()
    $('#modal_principal').modal('hide')
}

function carregar_campos(){

    formData = new FormData();
    let tag = document.querySelector("#tag").value;
    let falha = document.querySelector("#falha").value;
    let id = document.querySelector("#id").value;

    formData.append('tag', tag);
    formData.append('falha', falha);
    formData.append('id', id);

    return formData;
}

function limpar_campos(){

    let tag = document.querySelector("#tag").value = "";
    let falha = document.querySelector("#falha").value = "";
    let id = document.querySelector("#id").value = "";

}

function preencher_form(data){

    let tag = data.tag;
    let falha = data.falha;
    let id = data.id;
    
    $('#modal_principal').modal('show')
    document.querySelector("#tag").value = tag
    document.querySelector("#falha").value = falha
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
    formData.append('method', 'read');

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
                    <td>${dados[linha].tag}</td>
                    <td>${dados[linha].falha}</td>
                    <td class="text-center" data-id="${dados[linha].id}" id="edit"><img src="./icons/001-pencil.png"  alt=""></td>
                    <td class="text-center" data-id="${dados[linha].id}" id="remover"><img src="./icons/002-delete.png"  alt=""></td>
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
            if(data.MSN){
                base_erro(data.MSN.errorInfo[0]);
            }   
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
