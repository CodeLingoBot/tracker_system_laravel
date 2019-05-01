<?php

class DB{

    public static function insert($table, $data){
        $connection = new mysqli(getenv('DB_HOST'), getenv('DB_USERNAME'), getenv('DB_PASSWORD'), getenv('DB_DATABASE'));
        if ($connection->connect_error) {
            log_info("app_crx1", "Connection failed: " . $connection->connect_error);
            return;
        }
        $valuesArr = [];
        $keyArr = [];
        foreach($data as $key => $value){
            $keyArr[] = $key;
            if ($value === NULL){
                $valuesArr[] =  "NULL";
            }else if (is_string($value)){
                $valuesArr[] =  "'".$value."'";
            } elseif (is_bool($value)){
                $valuesArr[] =  $value ? "true" : "false";
            } else {
                $valuesArr[] =  $value;
            }
        }
        $query = "INSERT INTO terminal_information (".implode(',', $keyArr).") VALUES (".implode(',', $valuesArr) .")";
        log_info("database", $query);
        if ($connection->query($query) !== TRUE) {
            log_info("app_crx1", "Error: " . $query . "<br>" . $connection->error);
        }
        $connection->close();
    }
}