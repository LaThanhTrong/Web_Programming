<?php
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $image = $_POST['image'];
    $oldEmail = $_POST['oldEmail'];
    $error = "";

    if(empty($name)){
        $name = 'NULL';
    }
    if(empty($email)){
        $email = 'NULL';
    }
    if(empty($password)){
        $password = 'NULL';
    }
    if(empty($image)){
        $image = 'NULL';
    }

    $conn = mysqli_connect('localhost','root','','cotc','3307') or die('Kết nối thất bại : '.$conn->connect_error);

    $sql = "update users set
    u_name = coalesce('$name',u_name),
    u_email = coalesce('$email',u_email),
    u_password = coalesce('$password',u_password),
    u_image = coalesce('$image',u_image)
    where u_email='$oldEmail'";
    $sql = str_replace("'NULL'", "NULL", $sql);

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