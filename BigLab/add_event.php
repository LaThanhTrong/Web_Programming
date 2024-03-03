<?php   /* xu ly them bai viet */
        $msg = "";
        /* process add entry if any */
        if (isset($_POST['add_event'])) {
            
            //make connection and select DB
            include 'connection.php';
            $conn = new mysqli($servername, $username, $password, $database, $port);

            $event_id = $_POST['event_id'];
            $event_name = $_POST['event_name'];
            $event_image = $_POST['event_image'];
            $event_link = $_POST['event_link'];
            $event_status = $_POST['event_status'];
            
                
            $query = "INSERT INTO events (E_Id, E_Image, E_Name, E_Link, E_Status) VALUES ($event_id, '$event_image', '$event_name', '$event_link', '$event_status')";
            
            
            $q_result = mysqli_query($conn, $query) 
                or die("Couldn't add new entry: " . mysqli_error($conn));
            
        $conn->close();
        }
?>