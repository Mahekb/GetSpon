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
<html>
    <head>
        <title>Startup details</title>
        <link rel="stylesheet" type="text/css" href="mystyle.css">
        <style>
        .error {color: #FF0000;}
        </style>
    </head>
    <body>

    <ul>
        <li><a class="left"><img src="Images/Mainlogo.jpg" width="100"> </a></li>
        <li><a class="left" href="http://localhost:8080/Getspon/Home_page.php">Home</a></li>
        <li><a class="left" href="#About">About</a></li>
        <li><a class="left" href="#Contact">Contact</a></li>
        
        <li style="visibility:<?php echo "$islogin"?>"><a class="right" href="http://localhos:8080/Getspon/profilepage.php">Profile</a></li>
        <li style="visibility:<?php echo "$islogin"?>"><a class="right" href="http://localhost:8080/Getspon/Logout.php">Log out</a></li>
        <li style="visibility:<?php echo "$islogin"?>"><a class="right" href="http://localhost:8080/Getspon/Chat.php">Chat</a></li>
        <li style="visibility:<?php echo "$islogin"?>"><a class="right" href="http://localhost:8080/Getspon/Startup.php">Add your Startup</a></li>
        <li style="visibility:<?php echo "$islogin"?>"><a class="right" href="http://localhost:8080/Getspon/Events.php">Add new Event</a></li>
        <li style="visibility:<?php echo "$islogout"?>"><a class="right" href="http://localhost:8080/Getspon/Signup.php">Sign up</a></li>
        <li style="visibility:<?php echo "$islogout"?>"><a class="right" href="http://localhost:8080/Getspon/Login.php">Log in</a></li>

</ul> <br />



    <?php 

$stnameErr = $needErr = $statusErr = $fileErr = $amountErr = "";


if (isset($_POST['stupname']) && $_SERVER["REQUEST_METHOD"] == "POST") {
    
if(isset($_POST['stupname'])) {

        if (empty($_POST["stupname"])) {
                $stnameErr = "Startup Name is required";
        }else{
                $stname=$_POST["stupname"];
        }
}   
     

if(isset($_POST['stupneed'])) {

        if (empty($_POST["stupneed"])) {
                $needErr = "Is required";
        } 
        else if (preg_match("/[^a-zA-Z0-9, .()-]/",$_POST["stupneed"])) {
                $needErr = "Special Characters are not allowed.";
        }
        else {
                $stneed = $_POST["stupneed"];
        }
}

if(isset($_POST['status'])) {

        if ($_POST['status'] == "--select--") {
                $statusErr = "Please select your status";
        } 
      else {
                $status = $_POST["status"];
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
    } else if($FileType != 'doc' && $FileType != 'docx' && $FileType != 'pdf'){
            $fileErr = "File should be of doc,docx or pdf format only";
    }


if($stnameErr == "" && $statusErr == "" && $fileErr == "" && $needErr == "" && $amountErr == "" ) {
    $conn=mysqli_connect("localhost","root","","Getspon");
    if(!$conn){
        die("Connection failed:".mysqli_connect_error());
    }
    if(isset($_POST['submit'])){
        $links="-";
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
                $query="INSERT INTO Startups (Username,Startup_Name,Description1,emp_Status,phone_no,email,Amount,links,Ifile) VALUES (?,?,?,?,?,?,?,?,?)";
                $stmt=mysqli_prepare($conn,$query);
                mysqli_stmt_bind_param($stmt,"sssssssss",$uname,$stname,$stneed,$status,$pno,$email,$amount,$links,$url);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
                header("Location: http://localhost:8080/Getspon/Home_page.php");
        } else {
                $fileErr="Sorry, there was an error uploading your file.";
        }

    }
        
}

}

?>
        <div align="center" id="reg">
            <h1>Startup Details</h1><br>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data" >
                Startup Name:
                <input type = "text"  name = "stupname" class="input-box">
                <span class="error">* <?php echo $stnameErr;?></span>
                <br><br>
                Short Description:<br>
                <textarea type = "textarea"  name = "stupneed" class="input-box" rows="3" cols = "30" ></textarea>
                <span class="error">* <?php echo $needErr;?></span>
                <br><br>
                Employment Status:
                <select name="status" class="input-box" size=1 >
                    <option value="--select--">--select--</option>
                    <option value="Student">Student</option>
                    <option value="Teacher">Teacher</option>
                    <option value="Emplyoed">Emplyoyed</option>
                    <option value="UnEmplyoed">UnEmplyoed</option>
                </select>
                <span class="error">* <?php echo $statusErr;?></span>
                <br><br>

                Enter amount:
                <input type = "text"  name = "amount" class="input-box">
                <span class="error">* <?php echo $amountErr;?></span>
                <br><br>
                
                Any other links(optional):
                <input type="text" name="links" placeholder="Only Startup related" class="input-box">
                <br><br>
                Upload Your Startup Full Detail here(doc,docx,pdf file format only allowed)<br>
                <input type="file" name="fileUpload" id="fileUpload">
                <span class="error">* <?php echo $fileErr;?></span>
                <br><br>
                <input class="reset-button" type="reset" value="Reset">
                <input class="submit-button" type="submit" name="submit" value="Register">
            </form>
        </div>
    </body>
</html>