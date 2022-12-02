<?php

class SummonerController {
    function search($summoner_name) {

        $summoner_dao = new SummonerDAO();
        $summoner = $summoner_dao->getSummoner($summoner_name);

        $match_dao = new MatchDAO();
        $match_history = array();
        $recent_matches = $summoner_dao->getSummonerRecentMatches($summoner->puuid);
        
        foreach ($recent_matches as $recent_match) {
            $match_history[] = $match_dao->getMatch($recent_match);
        }

        require_once('./view/summoner.php');
    }
}

?>