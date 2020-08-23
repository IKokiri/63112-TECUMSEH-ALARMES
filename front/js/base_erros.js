function base_erro(erro){
    err = ""
    if(erro == 23000){
        
        err = `<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Atenção!</strong> O registro já existe.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
        </div>`;

        
    }

    document.querySelector("#base_alert").innerHTML = err;
}