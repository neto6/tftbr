<?php

require('./config/config.php');
require('./model/summoner.php');
require('./model/summoner_dao.php');


$summoner_dao = new SummonerDAO();
$summoner = $summoner_dao->getSummoner('henper');
$summoner_dao->getSummonerRecentMatches($summoner->puuid);

?>