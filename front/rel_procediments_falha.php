<?php
  include "nav.php"
?>
<!DOCTYPE html>
<html lang="pt-br">

<body>
    
<button id="btnExport">
<img src="./icons/xlsx.png" alt="">
</button>

    <table class="table table-hover">
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