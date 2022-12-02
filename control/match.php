<?php

class MatchController {
    function view($match_id) {
        global $img;

        $match_dao = new MatchDAO();
        $match = $match_dao->getMatch($match_id);

        require_once('./view/match.php');
    }
}

?>