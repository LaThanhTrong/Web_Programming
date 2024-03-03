<?php   //search
        if (isset($_GET['eventsearch'])) {    //if search keywords are submitted
            require "connection.php";   //connected to DB after this step
            $conn = new mysqli($servername, $username, $password, $database, $port);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            
            
            //process the search ketwords 
            $keyword = trim($_GET['eventsearch']);
            $new_kw = str_replace(" ", "%' OR E_Name LIKE '%", $keyword);
            //$query = "SELECT * FROM baiviet as bv, theloai as tl, tacgia as tg" .
            //    " WHERE bv.ma_tloai=tl.ma_tloai AND bv.ma_tgia=tg.ma_tgia AND" .
            //    " (tieude LIKE '%$new_kw%')";
            
            
            //debug
            //echo ("Keyword: " . $keyword . "<br>");
            
            preg_match_all('/["].+?["]/i', $keyword, $dquote_kw);
            
            
            //$dquote_kw: mang cac cum tu duoc bao boi dau "
            //giai thuat: aa "cc dd" ee "ff gg"
            //1. thay the " " thanh 1 ky tu dac biet, sau do ap dung cach replace o tren
            //  vd: aa% OR tieude LIKE %"cc+dd"% or tieude LIKE %eeE OR tieude LIKE %"ff+gg"
            //2. bo dau " va thay ky tu dac biet thanh " "
            
            //debug
            /*
            echo "Split array: ";
            print_r($dquote_kw);
            echo "<br>";
            */
            
            foreach ($dquote_kw[0] as $var) {
                //echo "Var: ", $var, "<br>";
                $new_var = str_replace(" ", "#*#", $var);
                $keyword = str_replace($var, $new_var, $keyword);
            }   
            
            $new_kw = str_replace(" ", "%' OR E_Name LIKE '%", $keyword);
            $new_kw = str_replace("\"", "", $new_kw);
            $new_kw = str_replace("#*#", " ", $new_kw);
            
            
            $query = "SELECT * FROM events " .
                " WHERE " .
                " (E_Name LIKE '%$new_kw%')";
            
            //debug
            //die ("<br>Query: ". $query);
            
            
            //query
            $q_result = mysqli_query($conn, $query) 
                or die("Query failed: " . mysqli_error($conn));
            
            $row_count = mysqli_num_rows($q_result);
            echo "<h2>Result: " . $row_count . " Event(s)</h2>";
            
            //display the search result
            while ($row = mysqli_fetch_array($q_result)) {
                echo "
                <table>
                    <tr>
                        <td><img src=".$row['E_Image']."></td>
                    </tr>
                    <tr>
                        <td><a href=".$row['E_Link'].">".$row['E_Name']."</a></td>
                    </tr>
                </table>
            ";
            }
        }
    ?>