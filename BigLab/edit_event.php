<?php   
$msg = "";
        if (isset($_POST['edit_event'])) {
            
            //make connection and select DB
            include 'connection.php';
            $conn = new mysqli($servername, $username, $password, $database, $port);

            $event_id = $_POST['event_id'];
            $event_name = $_POST['event_name'];
            $event_image = $_POST['event_image'];
            $event_link = $_POST['event_link'];
            $event_status = $_POST['event_status'];
            
                
            $query = "UPDATE events SET E_Name = '$event_name', E_Image = '$event_image', E_Link = '$event_link', E_Status = '$event_status' WHERE E_Id = '$event_id';";
            
            
            $q_result = mysqli_query($conn, $query) 
                or die("Couldn't add new entry: " . mysqli_error($conn));
            
        $conn->close();
        }
?>