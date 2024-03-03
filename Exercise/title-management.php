<?php 
    require "connect-select-db.php"; //connect to mySQL and provide $conn
    require "title-delete-process.php"; //delete a title
    require "title-add-process.php"; //add new title
    require "title-add-form.php"; //create add-title form 
    require "title-list-delete-form.php"; //function del_form_gen()
    require "title-update-form.php";
    require "title-update-process.php";
    //retrieve all records (to create [delete title] forms)
    $query = "SELECT * FROM classics";
    $result = $conn->query($query) or die("DB Access error");
    //generate [delete title] form
    while ($row = $result->fetch_assoc()) {
        del_form_gen($row);
    } 
    $conn->close();
?>
