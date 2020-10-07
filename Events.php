<?php
session_start();
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <title>Event</title>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
    <style>
     .error {color: #FF0000;}
</style>
</head>
<body>

<?php 

$enameErr = $cityErr = $stateErr = $addErr =  $phoneErr = $phone2Err = $emailErr =  "";


if (isset($_POST['eventname']) && $_SERVER["REQUEST_METHOD"] == "POST") {
    
if(isset($_POST['eventname'])) {

        if (empty($_POST["eventname"])) {
                $enameErr = "Event Name is required";
        } 
        else if (!preg_match("/^[a-zA-Z]*$/",$fname)) {
                $enameErr = "Only letters are allowed.";
        } 
        else {
                $ename = $_POST["eventname"];
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

if(isset($_POST['phoneno'])) {

        if (empty($_POST["phoneno"])) {
                $phoneErr = "Phone number is required";
        } 
      else {
                $phoneno = $_POST["phoneno"];
        }
}

if(isset($_POST['phoneno2'])) {

    if (empty($_POST["phoneno2"])) {
            $phone2Err = "Alternate Phone number is required";
    } 
  else {
            $phoneno = $_POST["phoneno2"];
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

      


if($enameErr == "" && $cityErr == "" && $stateErr == "" && $addErr == "" && $ $phoneErr == "" && $phone2Err == "" && $emailErr == "") {

        $conn = mysqli_connect("localhost","root","","Getspon");
        
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $uname=$_SESSION['username'];
        
        $query = "INSERT INTO Events VALUES (?,?,?,?,?,?,?,?)";

        $pst = mysqli_prepare($conn,$query);

        mysqli_stmt_bind_param($pst,"sssssiis",$uname,$ename,$address,$city,$state,$phoneno,$phoneno2,$email);

        mysqli_stmt_execute($pst);	

        $getResult = mysqli_stmt_get_result($pst);	

        mysqli_stmt_close($pst);

        $conn->close();


        header("Location: http://localhost/Getspon/Home_page.php");
exit();
}

}

?>

       <div align="center" id="reg">
                  <h1>Event Details</h1><br>
       
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
        Event Name:
        <input type = "text"  name = "eventname" class="input-box">
        <span class="error">* <?php echo $enameErr;?></span>
        <br><br>
        
        Event Address:<br>
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


        Phone no:
        <input type = "text"  name = "phoneno" class="input-box" >
        <span class="error">* <?php echo $phoneErr;?></span>
        <br><br>

        Alternate Phone no:
        <input type = "text"  name = "phoneno2" class="input-box" >
        <span class="error">* <?php echo $phone2Err;?></span>
        <br><br>
Email:
<input type="text" name="email" placeholder="username@gmail.com" class="input-box"> 
<span class="error">* <?php echo $emailErr;?></span>
<br><br>

       
<input class="reset-button" type="reset" value="Reset">
<input class="submit-button" type="submit" value="Register">

      </form>
</div>



</body>
</html>


