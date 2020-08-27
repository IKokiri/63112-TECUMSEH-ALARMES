<?php
  include "nav.php"
?>
<!DOCTYPE html>
<html lang="pt-br">
<br>

<title>Procedimentos</title>
<body>
    <div class="col-10 offset-1">
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

      </div>
    </form>

    <table class="table table-hover table-bordered">
        <thead>
          <tr>
            <th scope="col" class="text-center" id="titulo_procedimento"></th>
          </tr>
        </thead>
        <tbody class="grid">
        </tbody>
      </table>
    </div>
    

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
    <script src="./js/procedimento.js"></script>
</body>
</html>