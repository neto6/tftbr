<?php

class Match {
    private $metadata;
    private $info;

    function __construct($metadata, $info) {
        $this->metadata = $metadata;
        $this->info = $info;
    }
}

?>