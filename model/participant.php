<?php

class Participant {
    public $augments;
    public $companion;
    public $gold_left;
    public $last_round;
    public $level;
    public $players_eliminated;
    public $puuid;
    public $time_eliminated;
    public $total_damage_to_players;
    public $traits;
    public $units;

    function __construct($augments, $companion, $gold_left, $last_round, $level, $placement, $players_eliminated,
        $puuid, $time_eliminated, $total_damage_to_players, $traits, $units
    ) {
        $this->augments = $augments;
        $this->companion = $companion;
        $this->gold_left = $gold_left;
        $this->last_round = $last_round;
        $this->level = $level;
        $this->placement = $placement;
        $this->players_eliminated = $players_eliminated;
        $this->puuid = $puuid;
        $this->time_eliminated = $time_eliminated;
        $this->total_damage_to_players = $total_damage_to_players;
        $this->traits = $traits;
        $this->units = $units;
    }
}

?>