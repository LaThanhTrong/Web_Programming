<?php
    if (isset($_POST['update']) && isset($_POST['isbn'])) {
        $isbn = $_POST['isbn'];
        $title = $_POST['title'];
        $author = $_POST['author'];
        $year = $_POST['year'];
        $type = $_POST['type'];
        header("Location: http://localhost/Exercise/updateForm.php?isbn=$isbn&title=$title");
    }
?>