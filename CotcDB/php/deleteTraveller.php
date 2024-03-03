<?php
    $tId = $_POST['tId'];

    $error = "";

    $conn = mysqli_connect('localhost','root','','cotc','3307') or die('Kết nối thất bại : '.$conn->connect_error);

    $sql = "delete from travellers where t_id='$tId'";

    $stmt = $conn->prepare($sql);
    if(!$stmt->execute()){
        $error = "Error";
    }
    $stmt->close();
    $conn->close();

    $arr = array(
        'error' => $error
    );
    echo json_encode($arr)
?>