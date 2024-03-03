<?php
    $email = $_POST['email'];
    $message = $_POST['message'];
    $timestamp = $_POST['timestamp'];
    $error = "";

    $conn = mysqli_connect('localhost','root','','cotc','3307') or die('Kết nối thất bại : '.$conn->connect_error);
    $stmt = $conn->prepare("insert into feedback(f_email,f_message,f_timestamp) values (?,?,?)");
    $stmt->bind_param("sss",$email,$message,$timestamp);
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