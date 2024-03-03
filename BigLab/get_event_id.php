<?php


    function get_event_id() {
        require 'connection.php';
        
        $conn = new mysqli($servername, $username, $password, $database, $port);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $q_result = mysqli_query($conn, "SELECT MAX(E_Id) as maxid FROM events")
            or die("Query failed: " . mysqli_error($conn));

            while($row=mysqli_fetch_assoc($q_result))
            {
               $id=$row['maxid'];
            }
            return $id +1;
    }

    
  
?>