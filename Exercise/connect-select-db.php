<?php 
    require_once 'connection.inc';
    //create connection
    $conn = new mysqli($servername, $username, $password, $db, $port) or die("Connection failed: " . $conn->connect_error);
?>