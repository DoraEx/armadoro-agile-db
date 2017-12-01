<?php
    function db_connect() {
        ini_set('display_errors', 'On');
        static $connection;

        if(!isset($connection)) {
            $root = $_SERVER['DOCUMENT_ROOT'];
            $config = parse_ini_file($root . '/../config.ini');
            $connection = mysqli_connect($config['DB_SERVER'], $config['DB_USERNAME'], $config['DB_PASSWORD'], $config['DB_DATABASE']);
        }
              
        if($connection === false) {
            //error
            return mysqli_connect_error();
        }
        return $connection;
    }

    function db_query($query) {
        $connection = db_connect();
        $result = mysqli_query($connection, $query);
        if(!$result) {
            echo "Error: " . mysqli_error($connection);
        }
        return $result;
    }