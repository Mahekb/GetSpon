<?php
session_start();
?>

<?php
  $islogin="hidden";
  $islogout="visible";

  if(isset($_SESSION['username']) && isset($_SESSION['login'])){
    $islogin=$_SESSION['login'];
    $islogout="hidden";
  }
?>

<!DOCTYPE html>
<?php
if(isset($_COOKIE['firstname'])) {
    $name = $_COOKIE['firstname'];
}
else {
    $name = "";
}

?>

<html>
<head>
<title>GetSpon</title>
<link rel="stylesheet" type="text/css" href="mystyle.css">
</head>

<ul>
        <li><a class="left"><img src="Images/Mainlogo.jpg" width="100"> </a></li>
        <li><a class="left" href="http://localhost/Getspon/Home_page.php">Home</a></li>
        <li><a class="left" href="#About">About</a></li>
        <li><a class="left" href="#Contact">Contact</a></li>
        <li style="visibility:<?php echo "$islogin"?>"><a class="right" href="http://localhost/Getspon/Events.php">Add new Event</a></li>
        <li style="visibility:<?php echo "$islogin"?>"><a class="right" href="http://localhost/Getspon/Startup.php">Add your Startup</a></li>
        <li style="visibility:<?php echo "$islogin"?>"><a class="right" href="http://localhost/Getspon/Chat.php">Chat</a></li>
        <li style="visibility:<?php echo "$islogin"?>"><a class="right" href="http://localhost/Getspon/Logout.php">Log out</a></li>
        <li style="visibility:<?php echo "$islogout"?>"><a class="right" href="http://localhost/Getspon/Signup.php">Sign up</a></li>
        <li style="visibility:<?php echo "$islogout"?>"><a class="right" href="http://localhost/Getspon/login.php">Log in</a></li>

</ul>        
<div>
    <div class="title"> 
        <h1> Welcome <?php echo "$name"?> to GetSpon, where your search ends.</h1>
    </div>
    <div class="Homemain">
       <div>
         <h1 class="Head">WHY TO CHOOSE GETSPON?</h1>
         <p class="Text">
           Here, you will get,
           <ol>
             <li>Verified and trusted Sponsors</li>
             <li>Verified and trusted Clients</li>
           </ol>
         </p>
       </div>
       <div >
            <img src="Images/home.jpg" class="Img"/>
       </div>

    </div>
    <div class="div1">
      
        <div>
        <h1 class="Head">HOW GETSPON WORKS?</h1>
        <p class="Text">
        If You are an Event Organiser,
        <ol>
             <li>Find both sponsors and great service providers for your event on Getspon!</li>
             <li>List your Event and maximise your chance of Securing Sponsorship</li>
             <li>Reach out to every potential sponsor and amazing Vendors!</li>
           </ol> 
        </p>
        </div>

        <div class="div2">
        <h1 class="Head">THE PROCESS</h1>
        <p class="Text">

        <ol>
             <li>Create an event listing</li>
             <li>Once approved, the listing goes live</li>
             <li>Brands check the listing and contact if they like you</li>
             <li>Search for brands and events yourself to reach out</li>
             <li>Find all communication in your Inbox</li>
      
        </ol> 
        </p>
        
        </div>
    </div>


</body>
</html>
