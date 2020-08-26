<!DOCTYPE html>
<html lang="en">
<head>
    <title>sign up</title>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
    <style>
     .error {color: #FF0000;}
</style>
</head>
<body>
        <?php
            $nameErr="";
        ?>

<ul>
        <li><a class="left"><img src="Images/Mainlogo.jpg" width="100"> </a></li>
        <li><a class="left" href="http://localhost/getspon/Home_page.php">Home</a></li>
        <li><a class="left" href="#About">About</a></li>
        <li><a class="left" href="#Contact">Contact</a></li>
        <li><a class="right" href="Log out">Log out</a></li>
        <li><a class="right" href="http://localhost/Getspon/Signup.php">Sign up</a></li>
        <li><a class="right" href="http://localhost/Getspon/login.php">Log in</a></li>

</ul><br><br>
       <div align="center" id="reg">
                  <h1>Register Here</h1><br>
       
        <form method=post>
        First Name:
        <input type = "text"  name = "firstname" class="input-box"> <br>
        Middle Name:
        <input type = "text"  name = "middlename" class="input-box" >
        
        <br><br>
        Last Name:
        <input type = "text"  name = "lastname" class="input-box">
        <br><br>
        Date of Birth:
        <input type = "date"  name = "dateofbirth" class="input-box" >
        <br><br>
        Address:<br>
        <textarea type = "textarea"  name = "address" class="input-box" rows="3" cols = "30" ></textarea>
        <br><br>
City:
<select name="city" class="input-box" size=1 >
<option value="--select--">--select--</option>
<option value="Mumbai">Mumbai</option>
<option value="Pune">Pune</option>
<option value="Bangalore">Bangalore</option>
<option value="Delhi">Delhi</option>
</select>
<br><br>


State:
<select name="state" class="input-box" size=1>
<option value="--select--">--select--</option>
<option value="Maharashtra">Maharashtra</option>
<option value="Gujarat">Gujarat</option>
<option value="Punjab">Punjab</option>
<option value="Rajasthan">Rajasthan</option>
</select>
<br><br>

Gender:
        <input type="radio" name="gender" value="male"> Male
        <input type="radio" name="gender" value="female"> Female
        <input type="radio" name="gender" value="other"> Other
<br><br>
        Username:
        <input type = "text"  name = "username" class="input-box" ><br><br>
        Phone no:
        <input type = "text"  name = "phoneno" class="input-box" ><br><br>
Email:
<input type="text" name="email" placeholder="username@gmail.com" class="input-box"> <br><br>
Create a new password:
<input type="password" name="password" class="input-box" placeholder="must be atleast 7 letters" ><br><br>
Confirm password:
<input type="password" name="rpassword" class="input-box" ><br><br>
<Text>By creating an account you agree to our <sa href="#">Terms & Privacy</sa>.</Text><br><br>
<input type="checkbox" name="checkbox" value="">I agree to the terms and conditions.<br><br>
       <span class="error">* <?php echo $nameErr;?></span>
<input class="reset-button" type="reset" value="Reset">
<input class="submit-button" type="submit" value="Register">
        
      </form>
      <?php
            if(isset($_POST["username"]) && isset($_POST["password"])){
                $uname=$_POST["username"];
                $pass=$_POST["password"];
                header("Location: http://localhost/Getspon/Loginn.php?uname=".$uname."&pass=".$pass."");
            }else{
                $nameErr="Invalid Credentials";
            }
        ?>
</div>


</body>
</html>

