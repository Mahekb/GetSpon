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
    <?php 

$stnameErr = $fileErr = $statusErr = $addErr =  $phoneErr = $emailErr =  "";


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
                $addErr = "Is required";
        } 
        else if (preg_match("/[^a-zA-Z0-9, .()-]/",$_POST["stupneed"])) {
                $addErr = "Special Characters are not allowed.";
        }
        else {
                $stneed = $_POST["stupneed"];
        }
}

if(isset($_POST['status'])) {

        if ($_POST['status'] == "--select--") {
                $cityErr = "Please select your status";
        } 
      else {
                $status = $_POST["status"];
        }
}
if(isset($_POST['phoneno'])) {

        if (empty($_POST["phoneno"])) {
                $phoneErr = "Phone number is required";
        } 
      else {
                $phoneno = $_POST["phoneno"]+0;
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

   
    $FileType = strtolower(pathinfo($_FILES["fileUpload"]["name"],PATHINFO_EXTENSION));
    if (empty($_FILES["fileUpload"])) {
            $fileErr = "File is required";
    } else if($FileType != 'png' && $FileType != 'docx' && $FileType != 'pdf'){
            $fileErr = "File should be of doc,docx or pdf format only";
    }


if($stnameErr == "" && $statusErr == "" && $fileErr == "" && $addErr == "" && $ $phoneErr == "" && $emailErr == "") {
    $conn=mysqli_connect("localhost","root","","Getspon");
    if(!$conn){
        die("Connection failed:".mysqli_connect_error());
    }
    if(isset($_POST['submit'])){
        $links="-";
        $uname=$_SESSION['username'];
        $filess=file_get_contents($_FILES['fileUpload']['tmp_name']);
        if(isset($_POST['links'])){
                $links=$_POST['links'];
        }    
        $query="INSERT INTO Startups (Username,Startup_Name,Reason,emp_Status,phone_no,email,links,Ifile) VALUES (?,?,?,?,?,?,?,?)";
        $stmt=mysqli_prepare($conn,$query);
        mysqli_stmt_bind_param($stmt,"ssssissb",$uname,$stname,$stneed,$status,$phoneno,$email,$links,$filess);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
        header("Location: http://localhost/Getspon/Home_page.php");

        exit();
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
                Reason of Bringing Up this Idea:<br>
                <textarea type = "textarea"  name = "stupneed" class="input-box" rows="3" cols = "30" ></textarea>
                <span class="error">* <?php echo $addErr;?></span>
                <br><br>
                Employment Status:
                <select name="status" class="input-box" size=1 >
                    <option value="--select--">--select--</option>
                    <option value="Student">Student</option>
                    <option value="Emplyoed">Emplyoyed</option>
                    <option value="UnEmplyoed">UnEmplyoed</option>
                </select>
                <span class="error">* <?php echo $statusErr;?></span>
                <br><br>
                Phone no:
                <input type = "text"  name = "phoneno" class="input-box" >
                <span class="error">* <?php echo $phoneErr;?></span>
                <br><br>
                Email:
                <input type="text" name="email" placeholder="username@gmail.com" class="input-box"> 
                <span class="error">* <?php echo $emailErr;?></span>
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
