<?php

    function get_ma_bviet() {
        require "connect-select-db.php";

        $q_result = mysqli_query($conn, "SELECT MAX(ma_bviet) as maxm FROM baiviet")
            or die("Query failed: " . mysqli_error($conn));
        
        while($row = mysqli_fetch_assoc($q_result)) {
            $id = $row['maxm'];
        }
        return $id+1;
    }

    function dropdown_options($tb_name, $value_col, $text_col, $none=false, $default='') {     
        require "connection.php";   
        require "connect-select-db.php";
        if ($none)
            echo "<option value=''></option>\n";
        
        $query = "SELECT " . $value_col . ", " . $text_col .
            " FROM " .  $tb_name;
        
        $q_result = mysqli_query($conn,$query) 
            or die("Query failed: " . mysqli_error($conn));
        
        //generate list of options
        while ($row = mysqli_fetch_array($q_result)) {
            echo "<option value='", $row[0], "' ";
            
            if ($row[0] == $default)
                echo "selected";
            
            echo ">", $row[1], "</option>\n";
        }      
    }

?>