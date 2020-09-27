<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="./assets/bootstrap/bootstrap.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <style>
      #edit{
        cursor:pointer;
      }
      #remover{
        cursor:pointer;
      }
      #abrir_modal{
        margin:1%
      }
      #btnExport{
        margin:1%
      }
      .footer {
          position: absolute;
          bottom: 0;
          width: 100%;
          height: 60px;
          line-height: 60px;
          background-color: #CCC;
      }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="http://localhost/63112-TECUMSEH-ALARMES/front/procedimento.php">Alarmes</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto menus">            
          </ul>
        </div>
        <div class="pull-right">
          <span id="usuario_ativo"></span>
        </div>
      </nav>
</body>
</html>