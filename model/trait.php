<?php

class PTrait {
    public $name;
    public $num_units;
    public $style;
    public $tier_current;
    public $tier_total;

    function __construct($name, $num_units, $style, $tier_current, $tier_total) {
        $this->name = $name;
        $this->num_units = $num_units;
        $this->style = $style;
        $this->tier_current = $tier_current;
        $this->tier_total = $tier_total;
    }
}

?>