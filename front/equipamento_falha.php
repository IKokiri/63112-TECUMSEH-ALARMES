<?php
  include "nav.php"
?>
<!DOCTYPE html>
<html lang="pt-br">

<title>Falhas do Equipamento</title>
<body>
    
<div class="text-center">
      <button id="abrir_modal" type="button" class="btn btn-link">
        <img src="./icons/plus.png" alt="Adicionar Novo">
      </button>
    </div>  
    
    <div id="base_alert" class="col-10 offset-1 ">
 
 </div>

    <table class="table col-10 offset-1 table-hover table-bordered">
        <thead>
          <tr>
            <th scope="col">Equipamento</th>
            <th scope="col">Falha</th>
            <th scope="col">Observação</th>
            <th class="text-center" scope="col">Alterar</th>
            <th class="text-center" scope="col">Remover</th>
          </tr>
        </thead>
        <tbody class="grid">
        </tbody>
      </table>

<!-- Modal -->
<div class="modal fade" id="modal_principal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Falha do Equipamento</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- FORM -->
          <form>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputEmail4">Equipamento</label>
                <select class="form-control" name="id_equipamento" id="id_equipamento"></select>
              </div>

              <div class="form-group col-md-6">
                <label for="inputEmail4">Falha</label>
                <select class="form-control" name="id_falha" id="id_falha"></select>
              </div>

              <div class="form-group col-md-12">
                <label for="inputEmail4">Observação</label>
                <textarea class="form-control" name="observacao" id="observacao"></textarea>
              </div>

            </div>
            <input type="hidden" id="id_equipamento_o">
            <input type="hidden" id="id_falha_o">
          </form>
          <!-- FORM -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button type="button" id="salvar" class="btn btn-primary">Salvar</button>
        </div>
      </div>
    </div>
  </div>
  <?php
      include "footer.php"
    ?>
    <script src="./js/equipamento_falha.js"></script>
</body>
</html>