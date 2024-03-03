<?php
    $name = $_POST['name'];
    $rarity = $_POST['rarity'];
    $job = $_POST['job'];
    $element = $_POST['element'];
    $role = $_POST['role'];
    $total = $_POST['total'];
    $image = $_POST['image'];

    $oldName = $_POST['oldName'];
    $oldRarity = $_POST['oldRarity'];
    $oldJob = $_POST['oldJob'];
    $oldElement = $_POST['oldElement'];
    $oldRole = $_POST['oldRole'];
    $oldTotal = $_POST['oldTotal'];

    $error = "";

    if(empty($name)){
        $name = 'NULL';
    }
    if(empty($rarity)){
        $rarity = 'NULL';
    }
    if(empty($job)){
        $job = 'NULL';
    }
    if(empty($role)){
        $role = 'NULL';
    }
    if(empty($total)){
        $total = 'NULL';
    }
    if(empty($image)){
        $image = 'NULL';
    }

    $conn = mysqli_connect('localhost','root','','cotc','3307') or die('Kết nối thất bại : '.$conn->connect_error);
    $sql = "update travellers set
    t_name = coalesce('$name',t_name),
    t_rarity = coalesce('$rarity',t_rarity),
    t_job = coalesce('$job',t_job),
    t_element = coalesce('$element',t_element),
    t_role = coalesce('$role',t_role),
    t_total = coalesce('$total',t_total),
    t_image = coalesce('$image',t_image)
    where t_name='$oldName' and t_rarity='$oldRarity' and t_job='$oldJob' and t_element='$oldElement' and t_role='$oldRole' and t_total='$oldTotal'";
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