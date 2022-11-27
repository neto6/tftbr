<?php

class Unit {
    private $items;
    private $character_id;
    private $item_names;
    private $name;
    private $rarity;
    private $tier;

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