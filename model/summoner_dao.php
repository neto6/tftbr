<?php

class SummonerDAO {
    function getSummoner($summoner_name) {
        $summoner = $this->getSummonerFromDB($summoner_name);
        if ($summoner == false) {
            return $this->getSummonerFromAPI($summoner_name);
        }
        else {
            return $summoner;
        }
    }

    function getSummonerFromDB($summoner_name) {
        return false;
    }

    function getSummonerFromAPI($summoner_name) {
        global $end_point;
        global $api_key;
        $response_body = file_get_contents(
            $end_point.'/tft/summoner/v1/summoners/by-name/'.$summoner_name.'?api_key='.$api_key
        );
        $parsed = json_decode($response_body);
        var_dump($parsed);
        return new Summoner(
            $parsed->accountId,
            $parsed->profileIconId,
            $parsed->revisionDate,
            $parsed->name,
            $parsed->id,
            $parsed->puuid,
            $parsed->summonerLevel
        );
    }
}