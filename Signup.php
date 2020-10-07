<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sign up</title>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
    <style>
     .error {color: #FF0000;}
</style>
</head>
<body>

<?php 

$fnameErr = $mnameErr = $lnameErr = $genderErr = $cityErr = $stateErr = $dobErr = "";
$addErr = $userErr = $phoneErr = $emailErr = $passErr = $conpassErr = $cpassErr = $checkboxErr = "";


if (isset($_POST['firstname']) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST["firstname"];
    $mname = $_POST["middlename"];
    $lname = $_POST["lastname"];
    $dob = $_POST["dateofbirth"];
    $address = $_POST["address"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $gender = $_POST["gender"];
    $username = $_POST["username"];
    $phoneno = $_POST["phoneno"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

if(isset($_POST['firstname'])) {

        if (empty($_POST["firstname"])) {
                $fnameErr = "First Name is required";
        } 
        else if (!preg_match("/^[a-zA-Z]*$/",$fname)) {
                $fnameErr = "Only letters are allowed.";
        }
        else {
                $fname = $_POST["firstname"];
        }   
}   
     


if(isset($_POST['middlename'])) {

        if (empty($_POST["middlename"])) {
                $mnameErr = "Middle Name is required";
        } 
        else if (!preg_match("/^[a-zA-Z]*$/",$mname)) {
                $mnameErr = "Only letters are allowed.";
        }
        else {
                $mname = $_POST["middlename"];
        }   
} 



if(isset($_POST['lastname'])) {

        if (empty($_POST["lastname"])) {
                $lnameErr = "Last Name is required";
        } 
        else if (!preg_match("/^[a-zA-Z]*$/",$lname)) {
                $lnameErr = "Only letters are allowed.";
        }
        else {
                $lname = $_POST["lastname"];
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
        else if (preg_match("/[^a-zA-Z0-9, .()-]/",$address)) {
                $addErr = "Special Characters are not allowed.";
        }
        else {
                $address = $_POST["address"];
        }
}

if(isset($_POST['city'])) {

        if ($_POST['city'] == "--select--") {
                $cityErr = "City is required";
        } 
      else {
                $city = $_POST["city"];
        }
}

if(isset($_POST['state'])) {

        if ($_POST['state'] == "--select--") {
                $stateErr = "State is required";
        } 
      else {
                $state = $_POST["state"];
        }
}

if (empty($_POST["gender"])) {
        $genderErr = "Gender is required";
} 
else {
        $gender = $_POST["gender"];
}


if(isset($_POST['username'])) {

        if (empty($_POST["username"])) {
                $userErr = "Username is required";
        } 
      else {
                $username = $_POST["username"];
        }
}

if(isset($_POST['phoneno'])) {

        if (empty($_POST["phoneno"])) {
                $phoneErr = "Phone number is required";
        } 
      else {
                $phoneno = $_POST["phoneno"];
        }
}

if(isset($_POST['email'])) {

        if (empty($_POST["email"])) {
                $emailErr = "Email is required";
        } 
      else {
                $email = $_POST["email"];
        }
}

if(isset($_POST['password'])) {

        if (empty($_POST["password"])) {
                $passErr = "Password is required";
        } 
      else {
                $password = $_POST["password"];
        }
}

if(isset($_POST['cpassword'])) {

        if (empty($_POST["cpassword"])) {
                $conpassErr = "Password needs to be entered again.";
        } 
      else {
                $cpassword = $_POST["cpassword"];
        }
}

if($password != $cpassword) {
        $cpassErr = "Password should be same." ;
}



if (empty($_POST["checkbox"])) {
        $checkboxErr = "Terms and conditions needs to be agreed.";
} 
      


if($fnameErr == "" && $mnameErr == "" && $lnameErr == "" && $genderErr == "" && $cityErr == "" && $stateErr == "" && $dobErr == "" && $addErr == "" && $userErr == "" && $phoneErr == "" && $emailErr == "" && $passErr == "" && $conpassErr == "" && $checkboxErr == "" && $cpassErr == "") {
        
        $servername = "localhost";
        $username = "root";
        $passworddb = "";
        $dbname = "Getspon";
        
        $conn = mysqli_connect($servername, $username, $passworddb, $dbname);
        
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $username1 = $_POST["username"];
        $password1 = $_POST["password"];

        $query = "INSERT INTO user_details VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";

        $pst = mysqli_prepare($conn,$query);

        mysqli_stmt_bind_param($pst,"sssssssssiss",$fname,$mname,$lname,$dob,$address,$city,$state,$gender,$username1,$phoneno,$email,$password1);

        mysqli_stmt_execute($pst);	

        $getResult = mysqli_stmt_get_result($pst);	

        mysqli_stmt_close($pst);

        $conn->close();
    
        header("Location: http://localhost/Getspon/Login.php?username=".$username1."&password=".$password1."");

exit;
}
}

?>


<ul>
        <li><a class="left"><img src="Images/Mainlogo.jpg" width="100" </a></li>
        <li><a class="left" href="http://localhost/Getspon/Home_page.php">Home</a></li>
        <li><a class="left" href="#About">About</a></li>
        <li><a class="left" href="#Contact">Contact</a></li>
        <li><a class="right" href="http://localhost/Getspon/Login.php">Log in</a></li>

</ul><br><br>
       <div align="center" id="reg">
                  <h1>Register Here</h1><br>
       
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
        First Name:
        <input type = "text"  name = "firstname" class="input-box">
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
        <input type = "text"  name = "username" class="input-box" >
        <span class="error">* <?php echo $userErr;?></span>
        <br><br>
        Phone no:
        <input type = "text"  name = "phoneno" class="input-box" >
        <span class="error">* <?php echo $phoneErr;?></span>
        <br><br>
Email:
<input type="text" name="email" placeholder="username@gmail.com" class="input-box"> 
<span class="error">* <?php echo $emailErr;?></span>
<br><br>

Create a new password:
<input type="password" name="password" class="input-box" placeholder="must be atleast 7 letters" >
<span class="error">* <?php echo $passErr;?></span>
<br><br>

Confirm password:
<input type="password" name="cpassword" class="input-box" >
<span class="error">* <?php echo $conpassErr;?></span>
<br><br>

<Text>By creating an account you agree to our <sa href="#">Terms & Privacy</sa>.</Text><br><br>
<input type="checkbox" name="checkbox" value="checkbox">I agree to the terms and conditions.
<span class="error">* <?php echo $checkboxErr;?></span>
<br><br>
       
<input class="reset-button" type="reset" value="Reset">
<input class="submit-button" type="submit" value="Register">

      </form>
</div>



</body>
</html>

