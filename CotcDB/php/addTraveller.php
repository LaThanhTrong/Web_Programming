<?php
    $name = $_POST['name'];
    $rarity = $_POST['rarity'];
    $job = $_POST['job'];
    $element = $_POST['element'];
    $role = $_POST['role'];
    $total = $_POST['total'];
    $image = $_POST['image'];

    $error = "";

    $conn = mysqli_connect('localhost','root','','cotc','3307') or die('Kết nối thất bại : '.$conn->connect_error);

    $sql = "insert into travellers(t_name,t_rarity,t_job,t_element,t_role,t_total,t_image) values ('$name','$rarity','$job','$element','$role','$total','$image')";

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