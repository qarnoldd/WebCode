<?php
    // Edit these values to match your MySQL setup
    $db_host = 'localhost';
    $db_user = 'root';
    $db_pass = '1900490Freak!';
    $db_name = 'petrescue357';

    $dbConn = new mysqli($db_host, $db_user, $db_pass, $db_name);
    if($dbConn->connect_error) {
        die("Failed to connect to database " . $dbConn->connect_error);
    }
?>