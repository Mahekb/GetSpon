<?php
session_start();
?>

<?php
$islogin = "hidden";
$islogout = "visible";

if (isset($_SESSION['username']) && isset($_SESSION['login'])) {
    $islogin = $_SESSION['login'];
    $islogout = "hidden";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Chats</title>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
    <link rel="stylesheet" type="text/css" href="Chat.css">
    <style>
        .error {
            color: #FF0000;
        }
    </style>
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

    </ul> <br />
    <div id="log">
        <center>
            <h1>Your Messages</h1>
        </center>
        <div id="log2">
            <div class="tab">
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_01.jpg" alt="avatar" />
                <div class="diss">
                    <div class="name"><b>Mahek Baru</b></div>
                    <div class="message">Any Messages</div>
                </div>
            </div>
            <div class="tab">
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_03.jpg" alt="avatar" />
                <div class="diss">
                    <div class="name"><b>Jainam Mehta</b></div>
                    <div class="message">Any Messages</div>
                </div>
            </div>
            <div class="tab">
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_07.jpg" alt="avatar" />
                <div class="diss">
                    <div class="name"><b>Sourabh Bujawade</b></div>
                    <div class="message">Any Messages</div>
                </div>
            </div>
            <div class="tab">
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_02.jpg" alt="avatar" />
                <div class="diss">
                    <div class="name"><b>Mayuresh Kadam</b></div>
                    <div class="message">Any Messages</div>
                </div>
            </div>
        </div>
        <div id="log1">
            <div class="tab1">
                <button id="back" onclick="back()">
                    <-< /button>
                        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_01.jpg" alt="avatar" />
                        <div class="diss">
                            <div class="name"><b>Mahek Baru</b></div>
                        </div>
            </div>
            <div class="messagetab">
                <div class="bottomarea">
                    <textarea id="message" name="message" rows="2" cols="70"></textarea>
                    <button id="back">--></button>
                </div>
            </div>
        </div>
    </div>
    <script src="Chats.js"></script>
</body>
</head>