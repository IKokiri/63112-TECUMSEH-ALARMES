<?php
  include "nav.php"
?>
<!DOCTYPE html>
<html lang="pt-br">

<title>Relatório de Procedimentos</title>
<body>
    
<div class="text-center">
  <button id="btnExport" type="button" class="btn btn-link">
    <img src="./icons/xlsx.png" alt="Exportar">
  </button>
</div>

<table class="table col-10 offset-1 table-hover table-bordered">
        <thead>
          <tr>
            <th scope="col">Equipamento</th>
            <th scope="col">Falha</th>
            <th scope="col">Observação</th>
            <th scope="col">Ordem</th>
            <th scope="col">Procedimento</th>
          </tr>
        </thead>
        <tbody class="grid">
        </tbody>
      </table>

  <?php
      include "footer.php"
    ?>

<script src="./assets/tableToExcel.js"></script>
    <script src="./js/rel_procediments_falha.js"></script>
</body>
</html>