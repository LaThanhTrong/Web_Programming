<?php
    $conn = mysqli_connect('localhost','root','','cotc','3307') or die('Kết nối thất bại : '.$conn->connect_error);
    $results = mysqli_query($conn, "SELECT * FROM travellers");
    $data = array();
    while ($row = mysqli_fetch_assoc($results)){
        $data[] = $row;
    }
    $conn->close();
    echo json_encode($data);
?>