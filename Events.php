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

<html lang="en">
<head>
    <title>Event</title>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
    <style>
     .error {color: #FF0000;}
</style>
</head>
<body>

<ul>
        <li><a class="left"><img src="Images/Mainlogo.jpg" width="100"> </a></li>
        <li><a class="left" href="http://localhost/Getspon/Home_page.php">Home</a></li>
        <li><a class="left" href="#About">About</a></li>
        <li><a class="left" href="#Contact">Contact</a></li>
        
        <li style="visibility:<?php echo "$islogin"?>"><a class="right" href="http://localhost/Getspon/profilepage.php">Profile</a></li>
        <li style="visibility:<?php echo "$islogin"?>"><a class="right" href="http://localhost/Getspon/Logout.php">Log out</a></li>
        <li style="visibility:<?php echo "$islogin"?>"><a class="right" href="http://localhost/Getspon/Chat.php">Chat</a></li>
        <li style="visibility:<?php echo "$islogin"?>"><a class="right" href="http://localhost/Getspon/Startup.php">Add your Startup</a></li>
        <li style="visibility:<?php echo "$islogin"?>"><a class="right" href="http://localhost/Getspon/Events.php">Add new Event</a></li>
        <li style="visibility:<?php echo "$islogout"?>"><a class="right" href="http://localhost/Getspon/Signup.php">Sign up</a></li>
        <li style="visibility:<?php echo "$islogout"?>"><a class="right" href="http://localhost/Getspon/Login.php">Log in</a></li>

</ul> <br />


<?php 

$enameErr = $cityErr = $eveErr = $stateErr = $detErr = $amountErr = $fileErr = "";


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
        else if (preg_match("/[^a-zA-Z0-9, .-]/",$_POST["details"])) {
                $detErr = "Special Characters are not allowed.";
        }
        else {
                $details = $_POST["details"];
        }
}

if(isset($_POST['eventdate'])) {

        if (empty($_POST["eventdate"])) {
                $eveErr = "Date of event needs to be specified.";
        } 
      else {
                $edate = $_POST["eventdate"];
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

    $FileType = strtolower(pathinfo($_FILES["fileUpload"]["name"],PATHINFO_EXTENSION));
    if (empty($_FILES["fileUpload"])) {
            $fileErr = "File is required";
    } else if($FileType != 'png' && $FileType != 'jpg' && $FileType != 'jpeg'){
            $fileErr = "File should be of jpg,jpeg or png format only";
    }

if($enameErr == "" && $cityErr == "" && $stateErr == "" && $detErr == "" && $fileErr == "") {
        
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


        $filedir="uploads/".$_FILES["fileUpload"]["name"];

        if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"],$filedir)) {
                echo "The file ".$_FILES["fileUpload"]["name"]." has been uploaded.";
                $url=$filedir;
                $filess=file_get_contents($_FILES['fileUpload']['tmp_name']);
                if(isset($_POST['links'])){
                        $links=$_POST['links'];
                }    
                $query = "INSERT INTO Events(Username,Event_name,Details,Date1,city,state1,Phoneno,Email,Amount,Logo) VALUES (?,?,?,?,?,?,?,?,?,?)";
                $pst = mysqli_prepare($conn,$query);
                mysqli_stmt_bind_param($pst,"ssssssssss",$uname,$ename,$details,$edate,$city,$state,$pno,$email,$amount,$url);

                mysqli_stmt_execute($pst);	
                $getResult = mysqli_stmt_get_result($pst);	
                mysqli_stmt_close($pst);
                mysqli_close($conn);

                header("Location: http://localhost/Getspon/Home_page.php");
                }
                else {
                $fileErr="Sorry, there was an error uploading your file.";
                }

exit();
}
}

?>

       <div align="center" id="reg">
                  <h1>Event Details</h1><br>
       
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
        Event Name:
        <input type = "text"  name = "eventname" class="input-box">
        <span class="error">* <?php echo $enameErr;?></span>
        <br><br>
        
        Event short description:<br>
        <textarea type = "textarea"  name = "details" class="input-box" rows="3" cols = "30" ></textarea>
        <span class="error">* <?php echo $detErr;?></span>
        <br><br>

        Event Date:
        <input type = "date"  name = "eventdate" class="input-box" >
        <span class="error">* <?php echo $eveErr;?></span>
        <br><br>
City:
<select name="city" class="input-box" size=1 >
<option value="--select--">--select--</option>
<option value="Mumbai">Mumbai</option>
<option value="Pune">Pune</option>
<option value="Ahmedabad">Ahmedabad</option>
<option value="Surat">Surat</option>
<option value="Jaipur">Jaipur</option>
<option value="Kota">Kota</option>
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
<option value="Karnataka">Karnataka</option>
<option value="Rajasthan">Rajasthan</option>
</select>
<span class="error">* <?php echo $stateErr;?></span>
<br><br>

Enter amount:
<input type = "text"  name = "amount" class="input-box">
<span class="error">* <?php echo $amountErr;?></span>
<br><br>

Upload Event Logo:
<input type="file" name="fileUpload" id="fileUpload">
  <span class="error">* <?php echo $fileErr;?></span>
  <br><br>    


<input class="reset-button" type="reset" value="Reset">
<input class="submit-button" type="submit" value="Register">

      </form>
</div>



</body>
</html>

