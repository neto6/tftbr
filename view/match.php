<!DOCTYPE html>
<html lang="en">
<head>
  <title>TFTBR - Partida</title>
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
      <p>Data: <?php echo date('d/m/Y', $match->info->game_datetime/1000); ?></p>
      <h3>Vencedor</h3>
      <?php foreach($match->info->participants as $p) {if ($p->placement == '1') break;} ?>
          <?php
            $summoner_dao = new SummonerDAO();
            $summoner = $summoner_dao->getSummonerByPuuid($p->puuid);
          ?>
          <img src="http://ddragon.leagueoflegends.com/cdn/12.22.1/img/profileicon/<?php echo $summoner->profile_icon_id; ?>.png" class="rounded-circle"/>
          <h5><?php echo $summoner->name; ?></h5>
    </div>
    <div class="col-sm-8 text-white">
      <h3>Jogadores</h3>
      <?php foreach($match->info->participants as $p) { ?>
        <div class="mt-3 p-3 bg-secondary text-white rounded">
          <?php
            $summoner_dao = new SummonerDAO();
            $summoner = $summoner_dao->getSummonerByPuuid($p->puuid);
          ?>
          <h5><a class="text-white" href="summoner_search.php?name=<?php echo $summoner->name; ?>"><?php echo $summoner->name; ?></a></h5>
          <p>Terminou em <?php echo $p->placement; ?>º</p>
          <p>Composição:</p>
          <p>
            <?php foreach($p->units as $unit) { ?>
              <img height="48px" class="rounded-circle" src="<?php echo $img[$unit->character_id]; ?>"/>
            <?php } ?>
          </p>
        </div>
      <?php } ?>
    </div>
  </div>
</div>

</body>
</html>