<?php

class Summoner {
    private $account_id;
    private $profile_icon_id;
    private $revision_date;
    private $name;
    private $id;
    private $puuid;
    private $summoner_level;

    function __construct($account_id, $profile_icon_id, $revision_date, $name, $id, $puuid, $summoner_level) {
        $this->account_id = $account_id;
        $this->profile_icon_id = $profile_icon_id;
        $this->revision_date = $revision_date;
        $this->name = $name;
        $this->id = $id;
        $this->puuid = $puuid;
        $this->summoner_level = $summoner_level;
    }
}

?>