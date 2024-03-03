<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="eventlist.css">
    <title>EventList</title>
</head>
<body>
    <div class="mainbox">
      <nav>
            <a href="index.php"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d0/Blue_Archive_EN_logo.svg/langfr-260px-Blue_Archive_EN_logo.svg.png"></a>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="https://bluearchive.nexon.com/home" target="_blank">Publisher</a></li>
                <li>
                    <div class="activehover">
                    <a href="index.html" class="categories">Categories</a>
                        <ul>
                            <li><a href="index.php">Student</a></li>
                            <li><a href="index.php">School</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>
        <div class="centerbox">
            <div class="box2">
                <div class="boxnews">
                    <div class="listbox">
                        <h1>Event List:</h1>
                        <hr>
                        <button class="editlistbutton" id="editlistbutton">Edit Event Info</button>
                        <?php
                            include 'connection.php';
                            $conn = new mysqli($servername, $username, $password, $database, $port);
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }
                            $query = "Select * from events";
                            $result = $conn->query($query);
                            
                            
                            // echo "<div class='eventlist'";
                            echo "<table>";
                            echo "<tr>";
                            echo "<th>Id</th>";
                            echo "<th>Image</th>";
                            echo "<th>Name</th>";
                            echo "<th>Status</th>";
                            echo "</tr>";
                            
                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) 
                                {    
                                    echo "<tr>";                               
                                    echo "<td class='idCol'>".$row['E_Id']."</td>";
                                    echo "<td><img src=".$row['E_Image']."></td>";
                                    echo "<td>".$row['E_Name']."</td>"; 
                                    echo "<td class='statusCol'>".$row['E_Status']."</td>";    
                                    echo "</tr>";                                                                                                                                                                           
                                }
                            } else {
                                echo "0 results";
                            }
                            
                            echo "</table>";
                            $conn->close();
                        ?>                        
                        
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="popupboxlist">
        <div class="popup-contentlist">
            <?php
                include 'edit_event.php';
            ?>
            <form name="e_list" action="eventlist.php" onsubmit="return validateForm()" method="post">
                <table class="addformlist">
                    <tr>
                        <td class="left">
                            <label for="eventid">ID:</label>
                        </td>
                        <td class="right">
                            
                            <textarea class="textinput" name="event_id" id="event_id" rows="2" cols="3" onkeyup="GetDetail(this.value)"></textarea>
                                                      
                        </td>
                    </tr>
                    <tr>
                        <td class="left">
                            <label for="eventname">Event name:</label>
                        </td>
                        <td class="right">
                            <textarea class="textinput" name="event_name" id="event_name" rows="2" cols="50"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class="left">
                            <label for="eventimage">Event Image:</label>
                        </td>
                        <td class="right">
                            <textarea class="textinput" name="event_image" id="event_image" rows="2" cols="50"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="notice">* For now, please use direct link to publisher's image</td>
                    </tr>
                    <tr>
                        <td class="left">
                            <label for="eventlink">Event Link:</label>
                        </td>
                        <td class="right">
                            <textarea class="textinput" name="event_link" id="event_link" rows="2" cols="50"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="notice">* Link to main Wiki Page for more information.</td>
                    </tr>
                    <tr>
                        <td class="left">
                            <label for="eventstatus">Status:</label>
                        </td>
                        <td class="right">
                            <textarea class="textinput" name="event_status" id="event_status" rows="2" cols="2"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="notice">
                            <ul>
                                <li>* 0 = Upcoming</li>
                                <li>* 1 = Ongoing</li>
                                <li>* 2 = Past</li>
                            </ul>
                        </td>
                    </tr>
                </table> 
                <div class="addbox">
                    <input class="addbuttonform" type="submit" name="edit_event" id="edit_event" value="Update">
                    <button class="cancelbutton" id="cancelbutton">Cancel</button>
                </div>
            </form>
            
        </div>
    </div>
</body>
</html>
<script>
    document.getElementById("editlistbutton").addEventListener("click", function(){
        document.querySelector(".popupboxlist").style.display = "flex";
    })

    document.getElementById("cancelbutton").addEventListener("click", function(){
        document.querySelector(".popupboxlist").style.display = "none";
    })
    
</script>

<script>
  
        // onkeyup event will occur when the user 
        // release the key and calls the function
        // assigned to this event
        function GetDetail(str) {
            if (str.length == 0) {
                
                document.getElementById("event_name").value = "";
                document.getElementById("event_image").value = "";
                document.getElementById("event_link").value = "";
                document.getElementById("event_status").value = "";
                return;
            }
            else {
  
                
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
  
                    
                    if (this.readyState == 4 && 
                            this.status == 200) {
                          
                        
                        var myObj = JSON.parse(this.responseText);
  
                        document.getElementById("event_name").value = myObj[0];
                        document.getElementById("event_image").value = myObj[1];
                        document.getElementById("event_link").value = myObj[2];
                        document.getElementById("event_status").value = myObj[3];
                        
  
                    }
                };
  
                // xhttp.open("GET", "filename", true);
                xmlhttp.open("GET", "event_info.php?event_id=" + str, true);
                  
                // Sends the request to the server
                xmlhttp.send();
                
                

            }
        }
    </script>
<script>
    function validateForm() {
  let x = document.forms["e_add"]["event_status"].value;
  if (x != "1" && x != "2" & x != "3") {
    alert("invalid status");
    return false;
  }
  window.location.reload();
}
</script>