<?php

class Unit {
    public $items;
    public $character_id;
    public $item_names;
    public $name;
    public $rarity;
    public $tier;

    function __construct($character_id, $item_names, $items, $name, $rarity, $tier) {
        $this->character_id = $character_id;
        $this->item_names = $item_names;
        $this->items = $items;
        $this->name = $name;
        $this->rarity = $rarity;
        $this->tier = $tier;
    }
}

?>