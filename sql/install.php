<?php

require_once('../config/mysql.php');

$files = scandir('./');

foreach ($files as $file) {
    if (strpos($file, '.sql') > 0) {

        $sql = file_get_contents($file);
        
        if ($con->query($sql) === TRUE) {
          echo "Script ($file) executado com sucesso! <br>";
        } else {
          echo "Erro ao executar script ($file): " . $con->error;
        }

    }
           
}

$con->close();

?>