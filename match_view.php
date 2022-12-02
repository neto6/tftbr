<?php

require('./config/config.php');
require('./config/mysql.php');
require('./config/img_assets.php');
require('./model/summoner.php');
require('./model/summoner_dao.php');
require('./model/trait.php');
require('./model/unit.php');
require('./model/participant.php');
require('./model/match_metadata.php');
require('./model/match_info.php');
require('./model/match.php');
require('./model/match_dao.php');
require('./control/summoner.php');
require('./control/match.php');

$match_controller = new MatchController();

$match_controller->view($_GET['match_id']);

?>