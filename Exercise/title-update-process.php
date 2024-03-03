<?php
    if(isset($_POST['update-process']) && isset($_POST['isbn-updateProcess'])){
        $cur_isbn = $_POST['isbn-updateProcess'];
        $isbn = $_POST["isbn-update"];
        $author = $_POST["author-update"];
        $title = $_POST["title-update"];
        $year = $_POST["year-update"];
        $type = $_POST["type-update"];
        $query = "UPDATE classics SET isbn='$isbn', author='$author', title='$title', year='$year' WHERE isbn='$cur_isbn'";
        if (!$conn->query($query))
            echo "<h3>UPDATE failed.</h3>";
        else
            echo "*Title '$cur_isbn' has been updated<br>";
    }
?>