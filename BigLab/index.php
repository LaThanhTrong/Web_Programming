<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>BlueArchiveForFun</title>
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
                    <a href="index.php" class="categories">Categories</a>
                        <ul>
                            <li><a href="index.php">Student</a></li>
                            <li><a href="index.php">School</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>
        <div class="SearchBar">
            <div class="searchform">
                <form name="searchevent" id="searchevent" action="index.php" method="get">
                    
                        <input class="SearchInput" type="text" name="eventsearch" id="eventsearch" placeholder="Find event.">
                    
                    
                        <input class="searchbutton" type="submit" name="search" value="Search">
                    
                </form>
            </div>
        </div>
        <div class="centerbox">
            <div class="box2">
                <div class="boxnews">
                    <div class="ongoing">
                        
                        <!-- <?php   
                            include "search.php";
                        ?> -->

                        <?php
                            if (isset($_GET['eventsearch'])) {
                                include 'connection.php';
                                $conn = new mysqli($servername, $username, $password, $database, $port);
                                if ($conn->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                }    
                                
                                
                                $keyword = trim($_GET['eventsearch']);
                                $query = "SELECT * FROM events  WHERE  (E_Name LIKE '%$new_kw%')";
                                $result = $conn->query($query);
                                $row_count = mysqli_num_rows($q_result);
                                echo "<h2>Result: " . $row_count . " Event(s)</h2>";
                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    while($row = $result->fetch_assoc()) 
                                    {
                                        echo "
                                            <table>
                                                <tr>
                                                    <td><img src=".$row['E_Image']."></td>
                                                </tr>
                                                <tr>
                                                    <td><a href=".$row['E_Link'].">".$row['E_Name']."</a></td>
                                                </tr>
                                            </table>
                                        ";
                                    }
                                } 
                            }
                        ?>
                        
                        <h1>Ongoing Event</h1>
                        <hr>
                        
                        <?php
                            include 'connection.php';
                            $conn = new mysqli($servername, $username, $password, $database, $port);
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }
                            $query = "Select * from events where E_Status=1";
                            $result = $conn->query($query);
                            
                                // output data of each row
                                while($row = $result->fetch_assoc()) 
                                {
                                    echo "
                                        <table>
                                            <tr>
                                                <td><img src=".$row['E_Image']."></td>
                                            </tr>
                                            <tr>
                                                <td><a href=".$row['E_Link'].">".$row['E_Name']."</a></td>
                                            </tr>
                                        </table>
                                    ";
                                }
                            
                            $conn->close();
                        ?>
                        <hr>
                    </div>

                    <div class="upcoming">
                    <h1>Upcoming Events</h1>
                    
                    <?php
                        include 'connection.php';
                        $conn = new mysqli($servername, $username, $password, $database, $port);
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        // $page_limit = 1;
                        // $current_page = !empty($_GET['page'])?$_GET['page']:1;
                        // $from = ($current_page - 1) * $page_limit;
                        // $query = "Select * from events where E_Status=0 order by E_Id asc limit $from, $page_limit";
                        $query = "Select * from events where E_Status=0 order by E_Id asc";
                        $result = $conn->query($query);

                        // $query3 = "Select * from events where E_Status = 0";
                        // $total_record1 = $conn->query($query3);
                        // $total_record1 = $total_record1->num_rows;
                        // $total_page1= ceil($total_record1/$page_limit);


                            // output data of each row
                            while($row = $result->fetch_assoc()) 
                            {
                                echo "
                                    <table>
                                        <tr>
                                            <td><img src=".$row['E_Image']."></td>
                                        </tr>
                                        <tr>
                                            <td><a href=".$row['E_Link'].">".$row['E_Name']."</a></td>
                                        </tr>
                                    </table>
                                ";
                            }
                          
                          $conn->close();
                    ?>
                        <!-- <div class="pagebox">
                            <?php
                                include "upcomingpagination.php";
                            ?>
                        </div> -->
                    <hr>
                    </div>
                    <div class="pastevent">
                    <h1>Past Events</h1>
                    
                    <?php
                        settype ($page, "int");
                        include 'connection.php';
                        $conn = new mysqli($servername, $username, $password, $database, $port);
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        $page_limit = 3;
                        $current_page = !empty($_GET['page'])?$_GET['page']:1;
                        $from = ($current_page - 1) * $page_limit;
                        $query = "Select * from events where E_Status=2 order by E_Id desc limit $from, $page_limit";
                        $result = $conn->query($query);
                        
                        $query2 = "Select * from events where E_Status = 2";
                        $total_record = $conn->query($query2);
                        $total_record = $total_record->num_rows;
                        $total_page = ceil($total_record/$page_limit);

                        
                            // output data of each row
                            while($row = $result->fetch_assoc()) 
                            {
                                echo "
                                    <table>
                                        <tr>
                                            <td><img src=".$row['E_Image']."></td>
                                        </tr>
                                        <tr>
                                            <td><a href=".$row['E_Link'].">".$row['E_Name']."</a></td>
                                        </tr>
                                    </table>
                                ";
                            }
                         
                          $conn->close();
                    ?>
                        <div class="pagebox">
                            <?php
                                include "pagination.php";
                            ?>
                        </div>
                    </div>
                </div>
                <div class="boxother">
                    <div class="editbox">
                        <a href="eventlist.php"><button class="editbutton">Edit</button></a>
                    </div>
                    <div class="editbox">
                        <button class="addbutton" id="addbutton">Add</button>
                    </div>
                    <div class="othersources">
                        <a href="https://www.facebook.com/EN.BlueArchive" target="_blank"><img src="facebook.png" alt=""></a>
                        <a href="https://www.reddit.com/r/BlueArchive/" target="_blank"><img src="reddit.png" alt=""></a>
                        <a href="https://twitter.com/EN_BlueArchive" target="_blank"><img src="twitter.jpg" alt=""></a>
                    </div>
                    <div>
                        <P>
                            Disclaimer: I dont' own any copyright!
                        </P>
                        <br>
                        <p>
                            © 2021 NEXON Korea Corp. & NEXON GAMES Co., Ltd. All Rights Reserved
                        </p>
                    </div>
                </div>
                
            </div>
           
        </div>
       
    </div>
    <div class="popupbox">
        <div class="popup-content">
            <?php
                include 'add_event.php';
            ?>
            <form name="e_add" action="index.php" onsubmit="return validateForm()" method="post">
                <table class="addform">
                    <tr>
                        <td class="left">
                            <label for="eventid">ID:</label>
                        </td>
                        <td class="right">
                            <textarea class="textinput" name="event_id" id="event_id" rows="2" cols="3" required>
                                <?php
                                    include 'get_event_id.php';
                                    echo get_event_id();
                                ?>
                            </textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class="left">
                            <label for="eventname">Event name:</label>
                        </td>
                        <td class="right">
                            <textarea class="textinput" name="event_name" id="event_name" rows="2" cols="50" required></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class="left">
                            <label for="eventimage">Event Image:</label>
                        </td>
                        <td class="right">
                            <textarea class="textinput" name="event_image" id="event_image" rows="2" cols="50" required></textarea>
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
                            <textarea class="textinput" name="event_link" id="event_link" rows="2" cols="50" required></textarea>
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
                            <textarea class="textinput" name="event_status" id="event_status" rows="1" cols="2" required></textarea>
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
                    <input class="addbuttonform" type="submit" name="add_event" id="add_event" value="Add Event!!!">
                    <button class="cancelbutton" id="cancelbutton">Cancel</button>
                </div>
            </form>
            
        </div>
    </div>
</body>
</html>

<script>
    document.getElementById("addbutton").addEventListener("click", function(){
        document.querySelector(".popupbox").style.display = "flex";
    })

    document.getElementById("cancelbutton").addEventListener("click", function(){
        document.querySelector(".popupbox").style.display = "none";
    })
    
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


