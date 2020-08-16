const controller = "FalhaProcedimentoController"

$(document).ready(function(){

inicio();

function inicio(){
    grid_principal();
}

function grid_principal(){

    formData = new FormData();
    formData.append('class', controller);
    formData.append('method', 'procedimentosFalhas');

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
                    <td>${dados[linha].tag_equipamento} - ${dados[linha].tag_equipamento}</td>
                    <td>${dados[linha].tag_falha} - ${dados[linha].falha}</td>
                    <td>${dados[linha].observacao}</td>
                    <td>${dados[linha].ordem}</td>
                    <td>${dados[linha].procedimento}</td>
                </tr>
            `
        }
        document.querySelector(".grid").innerHTML = grid
    })
    .catch(console.error);
}

$("#btnExport").click(function() {
    let table = document.getElementsByTagName("table");
    TableToExcel.convert(table[0], { 
       name: `falProc.xlsx`,
       sheet: {
          name: 'Sheet 1'
       }
    });
});

})
