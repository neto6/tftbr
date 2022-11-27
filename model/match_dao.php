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
        return false;
    }

    function getMatchFromAPI($match_id) {
        global $api_key;
        $response_body = file_get_contents('https://americas.api.riotgames.com/tft/match/v1/matches/'.$match_id.'?api_key='.$api_key);
        $parse = json_decode($response_body);
        
        $traits = array();
        $units = array();
        $participants = array();

        foreach($parse->info->participants as $p) {
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
                    $u->item_names,
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
            $parse->metadata->dataversion
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
        $match = new Match(
            $match_metadata,
            $match_info            
        );
        return $match;
    }
}

?>