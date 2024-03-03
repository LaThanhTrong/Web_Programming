<?php
    function del_form_gen($row) {
        echo <<<_DEL_TITLE_FORM
        <form action="title-management.php" method="POST">
        <pre>
        <table>
            <tr><td>ISBN</td><td>$row[isbn]</td></tr>
            <tr><td>Title</td><td>$row[title]</td></tr>
            <tr><td>Author</td><td>$row[author]</td></tr>
            <tr><td>Year</td><td>$row[year]</td></tr>
            <tr><td>Category</td><td>$row[type]</td></tr>
            <tr><td><input type="submit" name="update" value="UPDATE"></td><td><input type="submit" name="delete" value="DELETE"></td></tr>
        </table>
        </pre>
        <input type="hidden" name="isbn" value="$row[isbn]">
        <input type="hidden" name="title" value="$row[title]">
        <input type="hidden" name="author" value="$row[author]">
        <input type="hidden" name="year" value="$row[year]">
        <input type="hidden" name="type" value="$row[type]">
        </form>
        
        _DEL_TITLE_FORM;
    } //add_form_gen()
?>