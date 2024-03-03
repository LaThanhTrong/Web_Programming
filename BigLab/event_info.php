<?php
  
// Get the user id 
$event_id = $_REQUEST['event_id'];
  
// Database connection
include 'connection.php';
$conn = new mysqli($servername, $username, $password, $database, $port);
  
if ($event_id !== "") {
      
    // Get corresponding first name and 
    // last name for that user id    
    $query = mysqli_query($conn, "SELECT E_Name, E_Image, E_Link, E_Status
     FROM events WHERE E_Id='$event_id'");
   
    $row = mysqli_fetch_array($query);
  
    
    $event_name = $row["E_Name"];
  
    
    $event_image = $row["E_Image"];
    $event_link = $row["E_Link"];
    $event_status = $row["E_Status"];
}
  
// Store it in a array
$result = array("$event_name", "$event_image", "$event_link", "$event_status");
  
// Send in JSON encoded form
echo json_encode($result);
?>