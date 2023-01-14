<?php

class MatchDAO {
    function getMatch($match_id) {
        $match = $this->getMatchFromDB($match_id);
        if ($match == false) {
            return $this->getMatchFromAPI($match_id);
        }
        else {
            return $match;
        }
    }

    function getMatchFromDB($match_id) {
        global $con;

        $sql = "SELECT match_id, data_version, game_datetime, game_length, game_version, queue_id,
                    tft_game_type, tft_set_core_name, tft_set_number
                FROM t_match
                WHERE match_id = '$match_id'";

        $result = $con->query($sql);

        if ($result->num_rows == 0) {
            return false;
        }

        $row = $result->fetch_assoc();   

        $metadata = new MatchMetadata($row['data_version']);
        $participants = $this->getMatchParticipantsFromDB($match_id);
        $info = new MatchInfo(
            $row['game_datetime'],
            $row['game_length'],
            $row['game_version'],
            $participants,
            $row['queue_id'],
            $row['tft_game_type'],
            $row['tft_set_core_name'],
            $row['tft_set_number']
        );
        $match = new TMatch($match_id, $metadata, $info);

        return $match;
    }

    function getMatchParticipantsFromDB($match_id) {
        global $con;
        $participants = array();

        $sql = "SELECT gold_left, last_round, level, placement, players_eliminated, 
                    puuid, time_eliminated, total_damage_to_players
                FROM t_match_participant
                WHERE match_id = '$match_id'";

        $result = $con->query($sql);

        while ($row = $result->fetch_assoc()) {

            $puuid = $row['puuid'];
            $augments = $this->getMatchParticipantAugmentsFromDB($match_id, $puuid);
            //$companion = $this->getMatchParticipantCompanionFromDB($match_id, $puuid);
            $companion = 1;
            $traits = $this->getMatchParticipantTraitsFromDB($match_id, $puuid);
            $units = $this->getMatchParticipantUnitsFromDB($match_id, $puuid);

            $participants[] = new Participant(
                $augments,
                $companion,
                $row['gold_left'],
                $row['last_round'],
                $row['level'],
                $row['placement'],
                $row['players_eliminated'],
                $row['puuid'],
                $row['time_eliminated'],
                $row['total_damage_to_players'],
                $traits,
                $units
            );
        }  

        return $participants;
    }

    function getMatchParticipantAugmentsFromDB($match_id, $puuid) {
        global $con;
        $augments = array();

        $sql = "SELECT augment
                FROM t_match_participant_augments
                WHERE match_id = '$match_id' AND puuid = '$puuid'";

        $result = $con->query($sql);

        while ($row = $result->fetch_assoc()) {
            $augments[] = $row['augment'];
        }     

        return $augments;
    }

    function getMatchParticipantTraitsFromDB($match_id, $puuid) {
        global $con;
        $traits = array();

        $sql = "SELECT name, num_units, style, tier_current, tier_total
                FROM t_match_participant_traits
                WHERE match_id = '$match_id' AND puuid = '$puuid'";

        $result = $con->query($sql);

        while ($row = $result->fetch_assoc()) {
            $traits[] = new PTrait(
                $row['name'],
                $row['num_units'],
                $row['style'],
                $row['tier_current'],
                $row['tier_total']
            );
        }     

        return $traits;        
    }

    function getMatchParticipantUnitsFromDB($match_id, $puuid) {
        global $con;
        $units = array();

        $sql = "SELECT character_id, name, rarity, tier
                FROM t_match_participant_units
                WHERE match_id = '$match_id' AND puuid = '$puuid'";

        $result = $con->query($sql);

        while ($row = $result->fetch_assoc()) {
            $units[] = new Unit(
                $row['character_id'],
                NULL,
                NULL,
                $row['name'],
                $row['rarity'],
                $row['tier']
            );
        }     
        return $units;        
    }

    function createMatchInDB($match) {
        global $con;

        $metadata = $match->metadata;
        $info = $match->info;

        $sql = "INSERT INTO t_match (match_id, data_version, game_datetime, game_length, game_version, queue_id,
                                        tft_game_type, tft_set_core_name, tft_set_number)
                VALUES (
                     '$match->match_id'
                    ,'$metadata->data_version'
                    ,'$info->game_datetime'
                    ,'$info->game_length'
                    ,'$info->game_version'
                    ,'$info->queue_id'
                    ,'$info->tft_game_type'
                    ,'$info->tft_set_core_name'
                    ,'$info->tft_set_number'
                )";

        if (!$con->query($sql)) {
            echo "Erro ao salvar dados ($sql) no banco: ".$con->error;
        }

        $participants = $info->participants;

        foreach($participants as $participant) {

            $sql = "INSERT INTO t_match_participant (match_id, gold_left, last_round, level, placement,
                                                        players_eliminated, puuid, time_eliminated, total_damage_to_players)
                    VALUES (
                        '$match->match_id'
                        ,'$participant->gold_left'
                        ,'$participant->last_round'
                        ,'$participant->level'
                        ,'$participant->placement'
                        ,'$participant->players_eliminated'
                        ,'$participant->puuid'
                        ,'$participant->time_eliminated'
                        ,'$participant->total_damage_to_players'
                    )";

            if (!$con->query($sql)) {
                echo "Erro ao salvar dados ($sql) no banco: ".$con->error;
            }

            foreach ($participant->augments as $augment) {
                
                $sql = "INSERT INTO t_match_participant_augments (match_id, puuid, augment)
                        VALUES (
                            '$match->match_id'
                            ,'$participant->puuid'
                            ,'$augment'
                        )";

                if (!$con->query($sql)) {
                    echo "Erro ao salvar dados ($sql) no banco: ".$con->error;
                }

            }

            foreach ($participant->traits as $trait) {
                
                $sql = "INSERT INTO t_match_participant_traits (match_id, puuid, name, num_units, 
                                                                style, tier_current, tier_total)
                        VALUES (
                            '$match->match_id'
                            ,'$participant->puuid'
                            ,'$trait->name'
                            ,'$trait->num_units'
                            ,'$trait->style'
                            ,'$trait->tier_current'
                            ,'$trait->tier_total'
                        )";

                if (!$con->query($sql)) {
                    echo "Erro ao salvar dados ($sql) no banco: ".$con->error;
                }

            }

            foreach ($participant->units as $unit) {
                
                $sql = "INSERT INTO t_match_participant_units (match_id, puuid, character_id, name, 
                                                                rarity, tier)
                        VALUES (
                            '$match->match_id'
                            ,'$participant->puuid'
                            ,'$unit->character_id'
                            ,'$unit->name'
                            ,'$unit->rarity'
                            ,'$unit->tier'
                        )";

                if (!$con->query($sql)) {
                    echo "Erro ao salvar dados ($sql) no banco: ".$con->error;
                }

            }

        }


    }

    function getMatchFromAPI($match_id) {
        global $api_key;
        $response_body = file_get_contents('https://americas.api.riotgames.com/tft/match/v1/matches/'.$match_id.'?api_key='.$api_key);
        $parse = json_decode($response_body);
        
        $participants = array();

        foreach($parse->info->participants as $p) {

            $traits = array();
            $units = array();

            foreach($p->traits as $t) {

                $traits[] = new PTrait(
                    $t->name,
                    $t->num_units,
                    $t->style,
                    $t->tier_current,
                    $t->tier_total
                );
            }

            foreach($p->units as $u) {
                $units[] = new Unit(
                    $u->character_id,
                    $u->itemNames,
                    $u->items,
                    $u->name,
                    $u->rarity,
                    $u->tier
                );
            }

            $participants[] = new Participant(
                $p->augments,
                $p->companion,
                $p->gold_left,
                $p->last_round,
                $p->level,
                $p->placement,
                $p->players_eliminated,
                $p->puuid,
                $p->time_eliminated,
                $p->total_damage_to_players,
                $traits,
                $units
            );
        }

        $match_metadata = new MatchMetadata(
            $parse->metadata->data_version
        );
        $match_info = new MatchInfo(
            $parse->info->game_datetime,
            $parse->info->game_length,
            $parse->info->game_version,
            $participants,
            $parse->info->queue_id,
            $parse->info->tft_game_type,
            $parse->info->tft_set_core_name,
            $parse->info->tft_set_number
        );
        $match = new TMatch(
            $match_id,
            $match_metadata,
            $match_info            
        );
        $this->createMatchInDB($match);
        return $match;
    }
}

?>
