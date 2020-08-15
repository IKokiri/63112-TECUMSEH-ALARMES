<?php
  include "nav.php"
?>
<!DOCTYPE html>
<html lang="pt-br">

<body>
    
    <button id="abrir_modal">
        +
    </button>

    <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">Falha</th>
            <th scope="col">Ordem</th>
            <th scope="col">Procedimento</th>
            <th scope="col">Alterar</th>
            <th scope="col">Remover</th>
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
          <h5 class="modal-title" id="exampleModalLabel">Falha</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- FORM -->
          <form>
            <div class="form-row">

              <div class="form-group col-md-6">
                <label for="inputEmail4">Falha</label>
                <select class="form-control" name="id_falha" id="id_falha"></select>
              </div>

              <div class="form-group col-md-6">
                <label for="inputEmail4">Ordem</label>
                <input type="text" class="form-control" id="ordem">
              </div>

              <div class="form-group col-md-12">
                <label for="inputEmail4">Procedimento</label>
                <textarea class="form-control" name="procedimento" id="procedimento"></textarea>
              </div>
              
            </div>
            <input type="hidden" id="id">
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
    <script src="./js/falha_procedimento.js"></script>
</body>
</html>