<?php

class PTrait {
    private $name;
    private $num_units;
    private $style;
    private $tier_current;
    private $tier_total;

    function __construct($name, $num_units, $style, $tier_current, $tier_total) {
        $this->name = $name;
        $this->num_units = $num_units;
        $this->style = $style;
        $this->tier_current = $tier_current;
        $this->tier_total = $tier_total;
    }
}

?>