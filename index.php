<?php

require('./config/config.php');
require('./model/summoner.php');
require('./model/summoner_dao.php');
require('./model/match.php');
require('./model/match_dao.php');


$summoner_dao = new SummonerDAO();
$summoner = $summoner_dao->getSummoner('henper');
$recent_matches = $summoner_dao->getSummonerRecentMatches($summoner->getPuuid());
$match_dao = new MatchDAO();
foreach ($recent_matches as $recent_match) {
    var_dump($match_dao->getMatch($recent_match));
}

?>