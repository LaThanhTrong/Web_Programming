<?php
    $name = trim($_POST['name']);
    $new_n = str_replace(" ", "%' OR t_name LIKE '%", $name);

    preg_match_all('/["].+?["]/i', $name, $dquote_n);

    foreach ($dquote_n[0] as $var) {
        //echo "Var: ", $var, "<br>";
        $new_var = str_replace(" ", "#*#", $var);
        $name = str_replace($var, $new_var, $name);
    } 

    $new_n = str_replace(" ", "%' OR t_name LIKE '%", $name);
    $new_n = str_replace("\"", "", $new_n);
    $new_n = str_replace("#*#", " ", $new_n);

    $query = "SELECT * FROM travellers as t" .
                " WHERE (t_name LIKE '%$new_n%')";

    $conn = mysqli_connect('localhost','root','','cotc','3307') or die('Kết nối thất bại : '.$conn->connect_error);
    $result = mysqli_query($conn, $query) or die("Query failed: " . mysqli_error($conn));

    $arr = array();
    while ($row = mysqli_fetch_assoc($result)){
        $arr[] = $row;
    }

    echo json_encode($arr);
?>