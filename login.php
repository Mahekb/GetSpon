<?php
session_start();
?>

<!DOCTYPE html>

<?php
if(isset($_GET['username'])) {
    $userna = $_GET['username'];
}
else {
    $userna = "";
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
        <li><a class="right" href="http://localhost/Getspon/Signup.php">Sign up</a></li>

</ul><br><br>

    <div align="center" id="log">
        <h1>Login</h1>
        <img src="Images/login.jpg" height = "150" width="150">
    <form method="post" enctype="multipart/form-data" autocomplete="on" >
    <form method=post >
        <input type = "text"  name = "uname" placeholder="Enter Username" class="input-box" required value= <?php echo $userna?>><br><br>
        <input type="password" name="passwordid" placeholder="Enter password" class="input-box" required><br><br>
    <Text class="right"><a href="http://localhost/Getspon/Signup.php">Forgot Password?</a></Text><br><br>
       
    <span class="error">* <?php echo $nameErr;?></span><br>

<button class="button" type="submit">Login</button><br><br>
<input type="checkbox"  name="remember"> Remember me<br><br>

</form>
   
<Text>Don't have an account? <a href="http://localhost/Getspon/Signup.php">Sign Up</a></Text><br><br>
<?php
            // $un=$userna;
            // $ps=$_GET['password'];

            if(isset($_POST["uname"]) && isset($_POST["passwordid"])){
                $une=$_POST['uname'];
                $pss=$_POST['passwordid'];
                    $conn=mysqli_connect("localhost","root","","Getspon");
                    if(!$conn){
                        die("Connection failed:".mysqli_connect_error());
                    }
                    $stmt = $conn->prepare("SELECT Username, Password1 FROM user_details WHERE Username=? AND  Password1=? LIMIT 1");
                    $stmt->bind_param('ss', $une, $pss);
                    $stmt->execute();
                    $stmt->bind_result($username, $password);
                    $stmt->store_result();
        
                    if($stmt->num_rows == 1 )
                    { 
                        $username = $_POST["uname"];
                        $_SESSION["login"] = "visible" ;
                        $_SESSION["username"] = $username ;
                        header("Location: http://localhost/Getspon/Home_page.php");
                    }
                    else{
                        echo 'The username or password are incorrect!';
                    }
                    $stmt->close();
            }
?>


<Text>-------------------------OR-------------------------</Text><br><br>

<button class="loginwithg-button">Login with Google</button>
<button class="loginwithf-button">Login with Facebook</button>
    </div>
</body>
</html>
