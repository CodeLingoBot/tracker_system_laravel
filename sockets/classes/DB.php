<?php

class DB{

    public static function insert($script, $hexString){
        $connection = new mysqli(getenv('DB_HOST'), getenv('DB_USERNAME'), getenv('DB_PASSWORD'), getenv('DB_DATABASE'));
        if ($connection->connect_error) {
            log_info("app_crx1", "Connection failed: " . $connection->connect_error);
            return;
        }
        $query = "INSERT INTO received (script, hexa) VALUES ('".$script."', '".$hexString."')";
        if ($connection->query($query) !== TRUE) {
            log_info("app_crx1", "Error: " . $query . "<br>" . $connection->error);
        }
        $connection->close();
    }
}