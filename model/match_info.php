<?php

class MatchInfo {
    private $game_datetime;
    private $game_length;
    private $game_version;
    private $participants;
    private $queue_id;
    private $tft_game_type;
    private $tft_set_core_name;
    private $tft_set_number;

    function __construct() {
        $this->game_datetime = $game_datetime;
        $this->game_length = $game_length;
        $this->game_version = $game_version;
        $this->participants = $participants;
        $this->queue_id = $queue_id;
        $this->tft_game_type = $tft_game_type;
        $this->tft_set_core_name = $tft_set_core_name;
        $this->tft_set_number = $tft_set_number;
    }
}

?>