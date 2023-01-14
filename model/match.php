<?php

class TMatch {
    public $match_id;
    public $metadata;
    public $info;

    function __construct($match_id, $metadata, $info) {
        $this->match_id = $match_id;
        $this->metadata = $metadata;
        $this->info = $info;
    }
}

?>
