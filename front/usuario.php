<?php
  include "nav.php"
?>
<!DOCTYPE html>
<html lang="pt-br">
<title>Usuários</title>
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
            <th scope="col">Usuário</th>
            <th scope="col">Permissão</th>
            <th  class="text-center" scope="col">Alterar</th>
            <th  class="text-center" scope="col">Remover</th>
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
          <h5 class="modal-title" id="exampleModalLabel">Usuários</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- FORM -->
          <form>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputEmail4">Usuário</label>
                <input type="text" class="form-control" id="email" maxlength="10">
              </div>

              <div class="form-group col-md-6">
                <label for="inputEmail4">Senha</label>
                <input type="password" class="form-control" id="senha" maxlength="15">
              </div>

              <div class="form-group col-md-6">
                <label for="inputEmail4">Permissão</label>
                <select  class="form-control" name="permissao" id="permissao">
                  <option value="0">Padrão</option>
                  <option value="1">Adminsitrador</option>
                </select>
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
    <script src="./js/usuario.js"></script>
</body>
</html>