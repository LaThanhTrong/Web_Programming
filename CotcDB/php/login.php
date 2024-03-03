<?php
    $email = $_POST['email'];
    $password = $_POST['password'];

    $success = '';
    $u_name = '';
    $u_email = '';
    $u_password = '';
    $u_image = '';
    $email_error = '';
    $password_error = '';

    if(empty($email)){
        $email_error = 'Email field cannot be empty.';
    }

    if(empty($password)){
        $password_error = 'Password field cannot be empty.';
    }

    if($email_error == '' && $password_error == ''){
        $conn = mysqli_connect('localhost','root','','cotc','3307') or die('Kết nối thất bại : '.$conn->connect_error);
        $sql = "SELECT * FROM users WHERE u_email='$email' AND u_password='$password'";
        $result = mysqli_query($conn, $sql) or die("Query failed: " . mysqli_error($conn));
        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $success = "success";
            $u_name = $row['u_name'];
            $u_email = $row['u_email'];
            $u_password = $row['u_password'];
            $u_image = $row['u_image'];
        }
    }

    $arr = array(
        'success' => $success,
        'u_name' => $u_name, 
        'u_email' => $u_email,
        'u_password' => $u_password,
        'u_image' => $u_image,
        'email_error' => $email_error,
        'password_error' => $password_error
    );

    echo json_encode($arr);
?>