<?php
session_start();
?>

<!DOCTYPE html>

<?php
if(isset($_COOKIE['email'])) {
    $email = $_COOKIE['email'];
}
else {
    $email = "";
}

?>

<?php
    if (isset($_POST['emailid']) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $emaill = $_POST["emailid"];
    $_SESSION["login"] = "visible" ;
    $_SESSION["email"] = $emaill ;
    }


    ?>

<html lang="en">
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
</head>
<body>
    <?php
            $nameErr="";
        ?>  
    
<ul>
        <li><a class="left"><img src="Images/Mainlogo.jpg" width="100" </a></li>
        <li><a class="left" href="http://localhost/Getspon/Home_page.php">Home</a></li>
        <li><a class="left" href="#About">About</a></li>
        <li><a class="left" href="#Contact">Contact</a></li>
        <li><a class="right" href="Log out">Log out</a></li>
        <li><a class="right" href="http://localhost/Getspon/Signup.php">Sign up</a></li>
        <li><a class="right" href="http://localhost/Getspon/Login.php">Log in</a></li>

</ul><br><br>

    <div align="center" id="log">
        <h1>Login</h1>
        <img src="Images/login.jpg" height = "150" width="150">
    <form method="post" enctype="multipart/form-data" autocomplete="on" >
    <form method=post >
        <input type = "text"  name = "emailid" placeholder="Enter email-id" class="input-box" required value= <?php echo $email?>><br><br>
        <input type="password" name="passwordid" placeholder="Enter password" class="input-box" required><br><br>
    <Text class="right"><a href="http://localhost/Getspon/Signup.php">Forgot Password?</a></Text><br><br>
       
    <span class="error">* <?php echo $nameErr;?></span><br>

<button class="button" type="submit">Login</button><br><br>
<input type="checkbox"  name="remember"> Remember me<br><br>

</form>
   
<Text>Don't have an account? <a href="http://localhost/Getspon/Signup.php">Sign Up</a></Text><br><br>
<?php
            $un=$email;
            $ps=$_GET['password'];
            if(isset($_POST["emailid"]) && isset($_POST["passwordid"])){
                if($un==$_POST["emailid"] && $ps==$_POST["passwordid"]){
                    header("Location: http://localhost/Getspon/Home_page2s.php");
                }else{
                   $nameErr="Invalid credentials";
               }
            }
?>


<Text>-------------------------OR-------------------------</Text><br><br>

<button class="loginwithg-button">Login with Google</button>
<button class="loginwithf-button">Login with Facebook</button>
    </div>
</body>
</html>
