<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Relatório TECUMSEH</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<style>
   th,td{
      
      vertical-align: middle!important;
   }
   th{
      color:#FFF;
      background-color:#009ee2;
      
   }
   
   th {
   position: -webkit-sticky;
   position: sticky;
   top: 0;
   z-index: 2;
   }


   .tfoot{
      color:#FFF;
      background-color:#009ee2;
      font-weight:bold;
   }
   html{
      font-size:0.8em;
   }
   form{
      padding:1%
   }
</style>
</head>
<body class="container-fluid">
<nav class="navbar navbar-light bg-light text-center">
  <a class="navbar-brand" href="#">
    <img src="../icons/kuttner.svg" width="200" class="d-inline-block align-top" alt="" loading="lazy">
  </a>
  <h2>
     HISTÓRICO TECUMSEH
</h2>
</nav>
<form>

   <div class="row">
      <div class="col">
         <input type="date" id="data_inicio" class="form-control" placeholder="Data Início">
      </div>

      <div class="col">
         <input type="time" id="hora_inicio" class="form-control" placeholder="Hora Início">
      </div>

      <div class="col">
         <input type="date" id="data_fim" class="form-control" placeholder="Data Fim">
      </div>

      <div class="col">
         <input type="time" id="hora_fim" class="form-control" placeholder="Hora Fim">
      </div>

      <div class="col">
         <select class="form-control" id="fundicao">
            <option value="0">Todas as Fundições</option>
            <option value="1">Fundição 1</option>
            <option value="2">Fundição 2</option>
         </select>
      </div>

      <div class="col-1">
         <button type="button" id="buscar" class="btn btn-primary btn-block">Buscar</button>
      </div>

      <div class="col-1">
         <div class="text-center">
            <button id="btnExport" type="button" class="btn btn-link">
            <img src="../icons/xlsx.png" alt="Exportar">
         </button>
      </div>
   </div>
</form>
<table class="table table-bordered table-striped text-center">
  <thead>
    <tr class="teste">
      <th scope="col">Fundição</th>
      <th scope="col">Cod. Batelada</th>
      <th scope="col">Data Hora</th>
      <th scope="col">Água Desejada Lt.</th>
      <th scope="col">Água Dosada Lt.</th>
      <th scope="col">Areia Nova Des.</th>
      <th scope="col">Areia Nova Dos.</th>
      <th scope="col">Areia Usada Des.</th>
      <th scope="col">Areia Usada Dos.</th>
      <th scope="col">Betonita Imp. Des.</th>
      <th scope="col">Betonita Imp. Dos.</th>
      <th scope="col">Betonita Nac. Des.</th>
      <th scope="col">Betonita Nac. Dos.</th>
      <th scope="col">Contador Misturas</th>
      <th scope="col">Desejado Carvao</th>
      <th scope="col">Dosado Carvão</th>
      <th scope="col">RTC Comp. Areia</th>
      <th scope="col">RTC Res. Verde</th>
      <th scope="col">RTC Temperatura</th>
      <th scope="col">Tempo Mistura Atual</th>
    </tr>
    
      
    <tr class="tfooth tfoot">
   </tr>
  </thead>
  
  
  <tbody>

  
  </tbody>
  <tfoot>
      <tr class="tfootf tfoot">
      </tr>
  </tfoot>
</table>
   <script src="../assets/bootstrap/jquery.js"></script>
<script src="../assets/bootstrap/popper.js"></script>
<script src="../assets/bootstrap/bootstrap.js"></script>
<script src="../assets/tableToExcel.js"></script>
<script src="./js/server.js"></script>
</body>
</html>