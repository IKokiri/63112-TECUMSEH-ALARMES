$(document).ready(function(){

    formData = new FormData();
    formData.append('class', "EquipamentoController");
    formData.append('method', "read");

    fetch(base_request,{
        method:'post',
        body: formData
    })
    .then(response => response.json())
    .then(data => {        

        permissaoLogado = data.permissaoLogado;
        
        menus = "";
        per = data.permissoes;

        for(p in per){
            telas = per[p].tela
            for(t in telas){
                if(permissaoLogado < telas[t].permissao){
                    continue;
                }
                menus += `<li class="nav-item">
                <a class="nav-link" href="${telas[t].caminho}">${telas[t].nome}
                </a>
              </li>`
            }
        }
        menus += `<li class="nav-item">
                    <a class="nav-link text-danger" href="/front/">Sair</a>
                </li> `
      document.querySelector(".menus").innerHTML = menus

    })
    .catch(console.error);

})
