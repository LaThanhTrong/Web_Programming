<?php
    $isbn = $_GET['isbn'];
    echo $isbn;
    /*echo <<<_UPDATE_TITLE_FORM
    
    <form action="title-management.php" method="POST">
    <pre>
    <table>
        <tr><td>ISBN</td><td><input type="text" name="isbn-update" value="$isbn"/></td></tr>
        <tr><td>Title</td><td><input type="text" name="title-update" value="$title"/></td></tr>
        <tr><td>Author</td><td><input type="text" name="author-update" value="$author"/></td></tr>
        <tr><td>Year</td><td><input type="text" name="year-update" value="$year"/></td></tr>
        <tr><td>Category</td><td><input type="text" name="type-update" value="$type"/></td></tr>
        <tr><td></td><td><input type="submit" value="Update Record"></td></tr>
    </table>
    </pre>
    <input type="hidden" name="update-process" value="yes">
    <input type="hidden" name="isbn-updateProcess" value="$isbn">
    </form>
    _UPDATE_TITLE_FORM;
    */
?>