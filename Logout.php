<?php
session_start();
?>

<?php
  $islogin="hidden";
  $islogout="visible";

  if(isset($_SESSION['email']) && isset($_SESSION['login'])){
    $islogin=$_SESSION['login'];
    $islogout="hidden";
  }
?>

<!DOCTYPE html>

<?php
if(isset($_COOKIE['firstname'])) {
    $fname = $_COOKIE['firstname'];
}
else {
    $fname = "";
}

if(isset($_COOKIE['lastname'])) {
    $lname = $_COOKIE['lastname'];
}
else {
    $lname = "";
}
?>

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
        <li><a class="left" href="http://localhost/Getspon/Home_page.php">Home</a></li>
        <li><a class="left" href="#About">About</a></li>
        <li><a class="left" href="#Contact">Contact</a></li>
        <li style="visibility:<?php echo "$islogin"?>"><a class="right" href="http://localhost/Getspon/Chat.php">Chat</a></li>
        <li style="visibility:<?php echo "$islogin"?>"><a class="right" href="http://localhost/Getspon/Logout.php">Log out</a></li>
        <li style="visibility:<?php echo "$islogout"?>"><a class="right" href="http://localhost/Getspon/Signup.php">Sign up</a></li>
        <li style="visibility:<?php echo "$islogout"?>"><a class="right" href="http://localhost/Getspon/Login.php">Log in</a></li>

</ul><br><br>

    <div align="center" id="log">
        <h1>Logout</h1>
        <img src="Images/login.jpg" height = "150" width="150"></br>
        <h1 class="uppercase"><?php echo $fname . " " . $lname?></h1></br></br>
        <form method="post" action="clearsession.php" >
    <button class="button" type="submit" name="logout">Logout</button><br><br>
</form>
    </div>

    
</body>
</html>
