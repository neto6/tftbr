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
        global $con;

        $sql = "SELECT account_id, profile_icon_id, revision_date, name, id, puuid, summoner_level
                FROM t_summoner
                WHERE LOWER(REPLACE(name,' ','')) = '$summoner_name'";

        $result = $con->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            $summoner = new Summoner($row['account_id'], $row['profile_icon_id'], $row['revision_date'],
                                        $row['name'], $row['id'], $row['puuid'], $row['summoner_level']);

            return $summoner;
        }
        else {
            return false;
        }
    }

    function createSummonerInDB($summoner) {
        global $con;
        $sql = "INSERT INTO t_summoner (account_id, profile_icon_id, revision_date, name, id, puuid, summoner_level)
                VALUES ('$summoner->account_id', '$summoner->profile_icon_id', '$summoner->revision_date',
                        '$summoner->name', '$summoner->id', '$summoner->puuid', '$summoner->summoner_level')";
        if (!$con->query($sql)) {
            echo "Erro ao salvar dados ($sql) no banco: ".$con->error;
        }
    }

    function getSummonerFromAPI($summoner_name) {
        global $end_point;
        global $api_key;
        $response_body = file_get_contents(
            $end_point.'/tft/summoner/v1/summoners/by-name/'.$summoner_name.'?api_key='.$api_key
        );
        $parsed = json_decode($response_body);
        $summoner = new Summoner(
            $parsed->accountId,
            $parsed->profileIconId,
            $parsed->revisionDate,
            $parsed->name,
            $parsed->id,
            $parsed->puuid,
            $parsed->summonerLevel
        );
        $this->createSummonerInDB($summoner);
        return $summoner;
    }

    function getSummonerRecentMatches($summoner_puuid) {
        $recent_matches = $this->getSummonerRecentMatchesFromDB($summoner_puuid);
        if ($recent_matches == false) {
            return $this->getSummonerRecentMatchesFromAPI($summoner_puuid);
        }
        else {
            return $recent_matches;
        }
    }

    function getSummonerRecentMatchesFromDB($summoner_puuid) {
        global $con;
        $recent_matches = array();

        $sql = "SELECT match_id
                FROM t_summoner_recent_matches
                WHERE puuid = '$summoner_puuid'";

        $result = $con->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $recent_matches[] = $row['match_id'];
            }

            return $recent_matches;
        }
        else {
            return false;
        }
    }

    function createSummonerRecentMatchesInDB($summoner_puuid, $recent_matches) {
        global $con;

        foreach ($recent_matches as $recent_match) {
            $sql = "INSERT INTO t_summoner_recent_matches (puuid, match_id)
                    VALUES ('$summoner_puuid', '$recent_match')";
            if (!$con->query($sql)) {
                echo "Erro ao salvar dados ($sql) no banco: ".$con->error;
            }
        }
    }

    function getSummonerRecentMatchesFromAPI($summoner_puuid) {
        global $api_key;
        $response_body = file_get_contents(
            'https://americas.api.riotgames.com/tft/match/v1/matches/by-puuid/'.$summoner_puuid.'/ids?start=0&count=2&api_key='.$api_key
        );
        $recent_matches = json_decode($response_body);
        $this->createSummonerRecentMatchesInDB($summoner_puuid, $recent_matches);
        return $recent_matches;
    }
}