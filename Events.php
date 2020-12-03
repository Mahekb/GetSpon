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

$enameErr = $cityErr = $stateErr = $detErr = $amountErr = "";


if (isset($_POST['eventname']) && $_SERVER["REQUEST_METHOD"] == "POST") {
    
if(isset($_POST['eventname'])) {

        if (empty($_POST["eventname"])) {
                $enameErr = "Event Name is required";
        } 
        else if (!preg_match("/^[a-zA-Z]*$/",$_POST['eventname'])) {
                $enameErr = "Only letters are allowed.";
        }  
        else {
                $ename = $_POST["eventname"];
        }
}   
     

if(isset($_POST['details'])) {

        if (empty($_POST["details"])) {
                $detErr = "Short detail is required";
        } 
        else if (preg_match("/[^a-zA-Z0-9, .]/",$_POST["details"])) {
                $detErr = "Special Characters are not allowed.";
        }
        else {
                $details = $_POST["details"];
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

if(isset($_POST['amount'])) {

        if (empty($_POST["amount"])) {
                $amountErr = "Enter amount value";
        } 
        else if ((int)$_POST["amount"] < 10000 or (int)$_POST["amount"] > 200000) {
                $amountErr = "Amount should be between 10,000 and 200,000.";
        }
        else {    
                $amount =  (int)$_POST["amount"];
        }
}

if($enameErr == "" && $cityErr == "" && $stateErr == "" && $detErr == "") {
        
        $conn = mysqli_connect("localhost","root","","Getspon");
        
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $uname=$_SESSION['username'];

        $stmt = $conn->prepare("SELECT Phoneno, Email FROM user_details WHERE Username=?");
        $stmt->bind_param('s', $uname);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $pno = $row['Phoneno'];
        $email = $row['Email'];
        $stmt->close();

        $query = "INSERT INTO Events VALUES (?,?,?,?,?,?,?,?)";
        $pst = mysqli_prepare($conn,$query);
        mysqli_stmt_bind_param($pst,"ssssssss",$uname,$ename,$details,$city,$state,$pno,$email,$amount);

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
        
        Event short description:<br>
        <textarea type = "textarea"  name = "details" class="input-box" rows="3" cols = "30" ></textarea>
        <span class="error">* <?php echo $detErr;?></span>
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

Enter amount:
<input type = "text"  name = "amount" class="input-box">
<span class="error">* <?php echo $amountErr;?></span>
<br><br>
       
<input class="reset-button" type="reset" value="Reset">
<input class="submit-button" type="submit" value="Register">

      </form>
</div>



</body>
</html>

