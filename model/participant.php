<?php

class Participant {
    private $augments;
    private $companion;
    private $gold_left;
    private $last_round;
    private $level;
    private $players_eliminated;
    private $puuid;
    private $time_eliminated;
    private $total_damage_to_players;
    private $traits;
    private $units;

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