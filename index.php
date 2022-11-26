<?php

require('../config/config.php');
require('../model/summoner.php');
require('../model/summoner_dao.php');


$summoner_dao = new SummonerDAO();
var_dump($summoner_dao->get_summoner($_GET['name']));

?>