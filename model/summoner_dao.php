<?php

class SummonerDAO {
    function getSummoner($summoner_name) {
        $summoner = getSummonerFromDB($summoner_name);
        if ($summoner == false) {
            return getSummonerFromAPI($summoner_name);
        }
        else {
            return $summoner;
        }
    }

    function getSummonerFromDB($summoner_name) {
        return false;
    }

    function getSummonerFromAPI($summoner_name) {
        $response_body = file_get_contents('https://br1.api.riotgames.com/tft/summoner/v1/summoners/by-name/'.$summoner_name);
        var_dump($response_body);
    }
}