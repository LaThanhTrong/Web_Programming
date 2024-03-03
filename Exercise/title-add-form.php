<?php
    echo <<<_ADD_TITLE_FORM
    <form action="title-management.php" method="POST">
    <pre>
    <table>
        <tr><td>ISBN</td><td><input type="text" name="isbn"/></td></tr>
        <tr><td>Title</td><td><input type="text" name="title"/></td></tr>
        <tr><td>Author</td><td><input type="text" name="author"/></td></tr>
        <tr><td>Year</td><td><input type="text" name="year"/></td></tr>
        <tr><td>Category</td><td><input type="text" name="type"/></td></tr>
        <tr><td></td><td><input type="submit" value="Add Record"></td></tr>
    </table>
    </pre>
    <input type="hidden" name="add" value="yes">
    </form>
    _ADD_TITLE_FORM;
?>