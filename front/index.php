<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrar</title>
    <link rel="stylesheet" href="./css/bootstrap.css">
</head>
<style> 
body{
    background-color:#ddd;
    padding-top:5%;
}
</style>
<body class="text-center">

<div id="base_alert" class="col-10 offset-1 ">
 
 </div>

<div class="form-signin col-md-2 offset-5">
      <img class="mb-4" src="icons/k.png" alt="" width="72" height="72">
      <label for="inputEmail" class="sr-only">Usuário</label>
      <input type="text" id="email" autocomplete="off" class="form-control" placeholder="Usuário" required="" autofocus="" value="">
      <label for="inputPassword" class="sr-only">Senha</label>
      <input type="password" id="senha" class="form-control" placeholder="Senha" required="" value="">
      <div class="checkbox mb-3">
      </div>
      <button class="btn btn-lg btn-primary btn-block" id="entrar">Entrar</button>
    </div>
<?php
      include "footer.php"
    ?>
<script src="./js/login.js"></script>
</body>
</html>