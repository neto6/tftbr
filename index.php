<!DOCTYPE html>
<html lang="en">
<head>
  <title>TFTBR - Invocador</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <style>body {background-color:black;}</style>
</head>
<body>

<div class="container-fluid p-5 bg-secondary text-white text-center">
  <h1>TFT BR</h1>
  <p>Site BR para consulta de histórico de partidas de Teamfight Tatics!</p> 
</div>
  
<div class="container mt-5">
  <div class="row">
    <div class="col-sm-12 text-white">
      <form method="get" action="summoner_search.php">
        <div class="input-group mb-3">
            <input name="name" type="text" class="form-control form-control-lg" placeholder="Digite aqui o nome de invocador...">
            <button class="btn btn-success" type="submit">Pesquisar</button>
        </div>
      </form>
    </div>
  </div>
</div>

</body>
</html>