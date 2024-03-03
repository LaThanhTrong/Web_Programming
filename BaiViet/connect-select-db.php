<?php
    require_once "connection.php";
    $conn = new mysqli("localhost", "root", "", "bv", "3307") or die("Connection failed: " . $conn->connect_error);
?>