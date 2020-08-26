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

$fnameErr = "";
$mnameErr = "";
$lnameErr = "";
$genderErr = "";
$cityErr = "";
$stateErr = "";
$dobErr = "";
$addErr = "";

if(isset($_POST['firstname'])) {

        if (empty($_POST["firstname"])) {
                $fnameErr = "Name is required";
        } 
        else {
                $fname = $_POST["firstname"];
        }   
}     

if(isset($_POST['middlename'])) {

        if (empty($_POST["middlename"])) {
                $mnameErr = "Name is required";
        } 
        else {
                $mname = $_POST["firstname"];
        }   
} 

if(isset($_POST['lastname'])) {

        if (empty($_POST["lastname"])) {
                $lnameErr = "Name is required";
        } 
        else {
                $lname = $_POST["firstname"];
        }   
} 

if(isset($_POST['gender'])) {

        if (empty($_POST["gender"])) {
                $genderErr = "Gender is required";
        } 
      else {
                $gender = $_POST["gender"];
        }
}

if(isset($_POST['city'])) {

        if (empty($_POST["city"])) {
                $cityErr = "City is required";
        } 
      else {
                $city = $_POST["city"];
        }
}

if(isset($_POST['state'])) {

        if (empty($_POST["state"])) {
                $stateErr = "State is required";
        } 
      else {
                $state = $_POST["state"];
        }
}

if(isset($_POST['dateofbirth'])) {

        if (empty($_POST["dateofbirth"])) {
                $dobErr = "DOB is required";
        } 
      else {
                $dob = $_POST["dateofbirth"];
        }
}

if(isset($_POST['address'])) {

        if (empty($_POST["address"])) {
                $addErr = "Address is required";
        } 
      else {
                $address = $_POST["address"];
        }
}

?>


<ul>
        <li><a class="left"><img src="Images/Mainlogo.jpg" width="100" </a></li>
        <li><a class="left" href="http://localhost/getspon/Home_page.php">Home</a></li>
        <li><a class="left" href="#About">About</a></li>
        <li><a class="left" href="#Contact">Contact</a></li>
        <li><a class="right" href="Log out">Log out</a></li>
        <li><a class="right" href="http://localhost/getspon/Signup.php">Sign up</a></li>
        <li><a class="right" href="http://localhost/getspon/login.php">Log in</a></li>

</ul><br><br>
       <div align="center" id="reg">
                  <h1>Register Here</h1><br>
       
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
        First Name:
        <input type = "text"  name = "firstname" class="input-box" >
        <span class="error">* <?php echo $fnameErr;?></span>
        <br><br>
        Middle Name:
        <input type = "text"  name = "middlename" class="input-box" >
        <span class="error">* <?php echo $mnameErr;?></span>
        <br><br>
        Last Name:
        <input type = "text"  name = "lastname" class="input-box">
        <span class="error">* <?php echo $lnameErr;?></span>
        <br><br>
        Date of Birth:
        <input type = "date"  name = "dateofbirth" class="input-box" >
        <span class="error">* <?php echo $dobErr;?></span>
        <br><br>
        Address:<br>
        <textarea type = "textarea"  name = "address" class="input-box" rows="3" cols = "30" ></textarea>
        <span class="error">* <?php echo $addErr;?></span>
        <br><br>
City:
<select name="city" class="input-box" size=1 >
<option value="--select--">--select--</option>
<option value="Mumbai">Mumbai</option>
<option value="Pune">Pune</option>
<option value="Bangalore">Bangalore</option>
<option value="Delhi">Delhi</option>
</select>
<span class="error">* <?php echo $cityErr;?></span>
<br><br>


State:
<select name="state" class="input-box" size=1>
<option value="--select--">--select--</option>
<option value="Maharashtra">Maharashtra</option>
<option value="Gujarat">Gujarat</option>
<option value="Punjab">Punjab</option>
<option value="Rajasthan">Rajasthan</option>
</select>
<span class="error">* <?php echo $stateErr;?></span>
<br><br>

Gender:
        <input type="radio" name="gender" value="male"> Male
        <input type="radio" name="gender" value="female"> Female
        <input type="radio" name="gender" value="other"> Other
        <span class="error">* <?php echo $genderErr;?></span>
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
<input type="password" name="password" class="input-box" ><br><br>
<Text>By creating an account you agree to our <sa href="#">Terms & Privacy</sa>.</Text><br><br>
<input type="checkbox" name="checkbox" value="">I agree to the terms and conditions.<br><br>
       
<input class="reset-button" type="reset" value="Reset">
<input class="submit-button" type="submit" value="Register">

      </form>
</div>


</body>
</html>

