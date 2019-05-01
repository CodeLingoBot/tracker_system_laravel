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

    public static function insertTerminalInfo($data){
        $connection = new mysqli(getenv('DB_HOST'), getenv('DB_USERNAME'), getenv('DB_PASSWORD'), getenv('DB_DATABASE'));
        if ($connection->connect_error) {
            log_info("app_crx1", "Connection failed: " . $connection->connect_error);
            return;
        }
        $keys = implode(',', array_keys($data));
        $valuesArr = [];
        foreach($data as $key => $value){
            $valuesArr[] = is_string($value) ? "'".$value."'" : $value;
        }
        $values = implode(',', array_keys($valuesArr));
        $query = "INSERT INTO terminal_information (".$keys.") VALUES (".$values .")";
        log_info("database", $query);
        if ($connection->query($query) !== TRUE) {
            log_info("app_crx1", "Error: " . $query . "<br>" . $connection->error);
        }
        $connection->close();
    }
}