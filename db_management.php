<?php
    // Create connection    
    function db_connect() {
        $config = parse_ini_file('config.ini');
        // Define connection as a static variable, to avoid connecting more than once 
        $connection;

        // Try and connect to the database, if a connection has not been established yet
        if(!isset($connection)) {
            $connection = mysqli_connect($config['DB_HOST'], $config['DB_USERNAME'], $config['DB_PASSWORD'], $config['DB_DATABASE']) or die('Could not connect to database!');
        }

        // If connection was not successful, handle the error
        if($connection === false) {
            return false;
        }
        
        // Set charset 
        mysqli_set_charset($connection,"utf8");

        return $connection;
    }

    // Create query
    function db_query($query, $connection) {

        // Query the database
        $result = mysqli_query($connection,$query);

        return $result;
    }

    // Get data
    function db_select($connection, $query, $return_row = false) {

        $rows = [];

        $result = db_query($query, $connection);
        // If query failed, return false
        if($result->num_rows == 0) {
            return false;
        }
        // If query was successful, retrieve all the rows into an array
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        if($return_row && !empty($rows)){
            return $rows[0];
        }
        
        return $rows;
    }

    function quote($value, $connection) {
        $val = stripslashes($value);
        $result = "'". mysqli_real_escape_string($connection, $val) ."'";
        return $result;
    }

    function db_update($connection, $query) {
        return $result = db_query($query, $connection);
    }

    function db_insert($conn, $sql) {
        if ($conn->query($sql) === TRUE) {
            return $conn->insert_id;
        } else {
            return false;
        }
    }
?>