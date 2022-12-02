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
    <div class="col-sm-4 text-white">
      <img src="http://ddragon.leagueoflegends.com/cdn/12.22.1/img/profileicon/<?php echo $summoner->profile_icon_id; ?>.png" class="rounded-circle"/>
      <h3><?php echo $summoner->name; ?></h3>
      <p>Nível: <?php echo $summoner->summoner_level; ?></p>
    </div>
    <div class="col-sm-8 text-white">
      <h3>Histórico de Partidas</h3>
      <?php foreach ($match_history as $match) { ?>
        <?php foreach($match->info->participants as $p) {if ($p->puuid == $summoner->puuid) break;} ?>
        <div class="mt-3 p-3 bg-secondary text-white rounded">
          <p><?php echo date('d/m/Y', $match->info->game_datetime/1000); ?>
            - Terminou em <?php echo $p->placement; ?>º
          </p>
          <p>Composição:</p>
          <p>
            <?php foreach($p->units as $unit) { ?>
              <img height="48px" class="rounded-circle" src="<?php echo $img[$unit->character_id]; ?>"/>
            <?php } ?>
          </p>
          <p><a class="text-white" href="match_view.php?match_id=<?php echo $match->match_id; ?>">Ver detalhes da partida</a></p>
        </div>
      <?php } ?>
    </div>
  </div>
</div>

</body>
</html>