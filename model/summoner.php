<?php

class Summoner {
    public $account_id;
    public $profile_icon_id;
    public $revision_date;
    public $name;
    public $id;
    public $puuid;
    public $summoner_level;

    function __construct($account_id, $profile_icon_id, $revision_date, $name, $id, $puuid, $summoner_level) {
        $this->account_id = $account_id;
        $this->profile_icon_id = $profile_icon_id;
        $this->revision_date = $revision_date;
        $this->name = $name;
        $this->id = $id;
        $this->puuid = $puuid;
        $this->summoner_level = $summoner_level;
    }

    function getPuuid() {
        return $this->puuid;
    }
}

?>