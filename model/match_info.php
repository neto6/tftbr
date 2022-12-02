<?php

class MatchInfo {
    public $game_datetime;
    public $game_length;
    public $game_version;
    public $participants;
    public $queue_id;
    public $tft_game_type;
    public $tft_set_core_name;
    public $tft_set_number;

    function __construct(
            $game_datetime, $game_length, $game_version, $participants, $queue_id, 
            $tft_game_type, $tft_set_core_name, $tft_set_number
    ) {
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