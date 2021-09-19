<?php
include 'partials/_isloggedin.php';
?>

<?php
$islogin = "hidden";
$islogout = "visible";

if (isset($_SESSION['username']) && isset($_SESSION['login'])) {
    $islogin = $_SESSION['login'];
    $islogout = "hidden";
}
?>

<?php

$conn = mysqli_connect("localhost", "root", "", "Getspon");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$uname = $_SESSION['username'];

$stmt = $conn->prepare("SELECT Fullname FROM user_details WHERE Username=?");
$stmt->bind_param('s', $uname);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $fullname = $row['Fullname'];
}
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>


<html lang="en">

<head>
    <title>Logout</title>
    <style>
        .uppercase {
            text-transform: uppercase;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
</head>

<body>

    <ul>
        <li><a class="left"><img src="Images/Mainlogo.jpg" width="100"> </a></li>
        <li><a class="left" href="Home_page.php">Home</a></li>
        <li><a class="left" href="#About">About</a></li>
        <li><a class="left" href="#Contact">Contact</a></li>

        <li style="visibility:<?php echo "$islogin" ?>"><a class="right" href="profilepage.php">Profile</a></li>
        <li style="visibility:<?php echo "$islogin" ?>"><a class="right" href="Logout.php">Log out</a></li>
        <li style="visibility:<?php echo "$islogin" ?>"><a class="right" href="Chat.php">Chat</a></li>
        <li style="visibility:<?php echo "$islogin" ?>"><a class="right" href="Startup.php">Add your Startup</a></li>
        <li style="visibility:<?php echo "$islogin" ?>"><a class="right" href="Events.php">Add new Event</a></li>
        <li style="visibility:<?php echo "$islogout" ?>"><a class="right" href="Signup.php">Sign up</a></li>
        <li style="visibility:<?php echo "$islogout" ?>"><a class="right" href="Login.php">Log in</a></li>

    </ul><br />

    <div align="center" id="log">
        <h1>Logout</h1>
        <img src="Images/login.jpg" height="150" width="150"></br>
        <h1 class="uppercase"><?php echo $fullname ?></h1></br></br>
        <form method="post" action="clearsession.php">
            <button class="button" type="submit" name="logout">Logout</button><br><br>
        </form>
    </div>


</body>

</html>