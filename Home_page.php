<?php
session_start();
?>

<?php
  $islogin="hidden";
  $islogin2= "none";
  $islogout="visible";

  if(isset($_SESSION['username']) && isset($_SESSION['login'])){
    $islogin=$_SESSION['login'];
    $islogin2="content";
    $islogout="hidden";
  }
?>

<!DOCTYPE html>

<html>

<head>
    <title>GetSpon</title>
    <style>
    .flex-container {
        display: flex;
        flex-wrap: wrap;
        flex-direction: row;
        margin-left: 100px;
        margin-right: 100px;
    }

    .details {
        background-color: rgb(0, 81, 255);
        color: rgb(255, 255, 255);
        padding: 13px 30px;
        text-align: center;
        font-size: 15px;
        border-radius: 30px;
    }


    .flex-container>div {
        width: 29%;
        margin: 15px;
        text-align: center;
        height: max-content;
        border: 3px solid #142850;
        border-radius: 15px;
        padding: 10px;
        background-color: rgb(250, 186, 236);
    }


    .go-button {
        background-color: rgb(0, 81, 255);
        color: rgb(255, 255, 255);
        padding: 10px 20px;
        text-align: center;
        font-size: 15px;
        border-radius: 40px;

    }

    .message {
        color: rgb(209, 13, 7);
        /* display: block; */
        text-align: center;
        font-size: 50px;
        font-weight: bold;
    }
    </style>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
</head>

<body>

    <ul>
        <li><a class="left"><img src="Images/Mainlogo.jpg" width="100"> </a></li>
        <li><a class="left" href="http://localhost:8080/Getspon/Home_page.php">Home</a></li>
        <li><a class="left" href="#About">About</a></li>
        <li><a class="left" href="#Contact">Contact</a></li>

        <li style="visibility:<?php echo "$islogin"?>"><a class="right"
                href="http://localhost:8080/Getspon/profilepage.php">Profile</a></li>
        <li style="visibility:<?php echo "$islogin"?>"><a class="right"
                href="http://localhost:8080/Getspon/Logout.php">Log out</a></li>
        <li style="visibility:<?php echo "$islogin"?>"><a class="right"
                href="http://localhost:8080/Getspon/Chat.php">Chat</a></li>
        <li style="visibility:<?php echo "$islogin"?>"><a class="right"
                href="http://localhost:8080/Getspon/Startup.php">Add your Startup</a></li>
        <li style="visibility:<?php echo "$islogin"?>"><a class="right"
                href="http://localhost:8080/Getspon/Events.php">Add new Event</a></li>
        <li style="visibility:<?php echo "$islogout"?>"><a class="right"
                href="http://localhost:8080/Getspon/Signup.php">Sign up</a></li>
        <li style="visibility:<?php echo "$islogout"?>"><a class="right"
                href="http://localhost:8080/Getspon/Login.php">Log in</a></li>

    </ul>
    <!-- <div> -->
    <div class="title">
        <h1> Welcome to GetSpon, where your search ends.</h1>
    </div>
    <div class="Homemain">
        <div>
            <h1 class="Head">WHY TO CHOOSE GETSPON?</h1>
            <p>
                Here, you will get,
            <ol>
                <li>Verified and trusted Sponsors</li>
                <li>Verified and trusted Clients</li>
            </ol>
            </p>
        </div>
        <div>
            <img src="Images/home.jpg" class="Img" />
        </div>

    </div>
    <div class="div1">

        <div>
            <h1 class="Head">HOW GETSPON WORKS?</h1>
            <p>
                If You are an Event Organiser,
            <ol>
                <li>Find sponsors for your event on Getspon!</li>
                <li>List your Event and maximise your chance of Securing Sponsorship</li>
                <li>Reach out to every potential sponsor and amazing Vendors!</li>
            </ol>
            </p>
        </div>

        <div class="div2">
            <h1 class="Head">THE PROCESS</h1>
            <p>

            <ol>
                <li>Create an event listing</li>
                <li>Once approved, the listing goes live</li>
                <li>Brands check the listing and contact if they like you</li>
                <li>Find all communication in your Inbox</li>

            </ol>
            </p>

        </div>
    </div>
    <!-- </div> -->

    <div>
        <?php
    if ($islogin == "hidden") {
      echo "<div class='message'>";
      echo "Login to view events and startups";
      echo "</div>";
    }
    ?>
    </div>

    <div style="display:<?php echo "$islogin2"?>">
        <!-- <div style="display: None"> -->

        <div class="title">
            <h1> Our Upcoming Events</h1>
        </div>

        <?php 
                $opt = "--select--";
                $opt2 = "--select--";
            ?>
        <div class="right">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

                Sort By:
                <select name="opt" class="input-box" size=1>
                    <option value="--select--">--select--</option>
                    <option value="Date">Date</option>
                    <option value="Eventname">Event name</option>
                    <option value="Amount">Amount</option>
                    <option value="City">City</option>
                </select>

                <input class="go-button" type="submit" value="Go">

            </form>
        </div><br />
        <?php 
                if(isset($_POST['opt'])) {
                $opt = $_POST["opt"];
                }
            ?>

        <br><br>
        <div class="flex-container">

            <?php
        $conn = mysqli_connect("localhost","root","","Getspon");
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        if ($opt=="--select--") {
          $stmt = $conn->prepare("SELECT Event_id,Event_name,city,Amount,Date1,Logo FROM events ORDER BY Event_id");
        }
        else if ($opt=="Date") {
          $stmt = $conn->prepare("SELECT Event_id,Event_name,city,Amount,Date1,Logo FROM events ORDER BY Date1");
        }
        else if ($opt=="Eventname") {
          $stmt = $conn->prepare("SELECT Event_id,Event_name,city,Amount,Date1,Logo FROM events ORDER BY Event_name");
        }
        else if ($opt=="Amount") {
          $stmt = $conn->prepare("SELECT Event_id,Event_name,city,Amount,Date1,Logo FROM events ORDER BY Amount");
        }
        else if ($opt=="City") {
          $stmt = $conn->prepare("SELECT Event_id,Event_name,city,Amount,Date1,Logo FROM events ORDER BY city");
        }

        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
          $eventid = $row['Event_id'];

          echo '<div> <img src="' . $row['Logo'] . '"width="150">' . '<br/>';
          echo "<h1>" . $row['Event_name'] . "</h1  >";
          echo "<h3>Location: " . $row['city'] . "</h3>";

          echo "<h3>Date: " . $row['Date1'] . "</h3>";
          echo "<h3>Amount: " . $row['Amount'] . "</h3>";
          echo '<form action="http://localhost:8080/Getspon/Details.php?event_id='.$eventid.'" method="POST">';
          echo '<button type="submit" name="submit" class="details">View More</button></form>';
          echo '</div>';
        }
        $stmt->close();
        $conn->close();
       ?>

        </div>

        <div class="title">
            <h1> Startups</h1>
        </div>

        <div class="right">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

                Sort By:
                <select name="opt2" class="input-box" size=1>
                    <option value="--select--">--select--</option>
                    <option value="Stname">Startup name</option>
                    <option value="Amount">Amount</option>
                </select>

                <input class="go-button" type="submit" value="Go">

            </form>
        </div><br />


        <?php 
       if(isset($_POST['opt2'])) {
          $opt2 = $_POST["opt2"];
        }
        ?>
        <br><br>

        <div class="flex-container">
            <?php

        $conn = mysqli_connect("localhost","root","","Getspon");
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        if ($opt2=="--select--") {
          $stmt = $conn->prepare("SELECT Startup_id,Startup_Name,Description1,Amount,links FROM startups ORDER BY Startup_id");
        }
        else if ($opt2=="Amount") {
          $stmt = $conn->prepare("SELECT Startup_id,Startup_Name,Description1,Amount,links FROM startups ORDER BY Amount");
        }
        else if ($opt2=="Stname") {
          $stmt = $conn->prepare("SELECT Startup_id,Startup_Name,Description1,Amount,links FROM startups ORDER BY Startup_Name");
        }
        

        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
          $sid = $row['Startup_id'];
          echo '<div>';
          echo "<h1>" . $row['Startup_Name'] . "</h1  >";
          echo "<h3>Field: " . $row['Description1'] . "</h3>";
          echo "<h3>Amount: " . $row['Amount'] . "</h3>";
          echo '<form action="http://localhost:8080/Getspon/Details2.php?s_id='.$sid.'" method="POST">';
          echo '<button type="submit" name="submit" class="details">View More</button></form>';
          echo '</div>';
        }
        $stmt->close();
        $conn->close();
    ?>

        </div>
    </div>


</body>

</html>