<?php
session_start();

$islogin = "hidden";
$islogout = "visible";

if (isset($_SESSION['username']) && isset($_SESSION['login'])) {
    $islogin = $_SESSION['login'];
    $islogout = "hidden";
}

$conn = mysqli_connect("localhost", "root", "", "Getspon");
if (!$conn) {
    die("Connection failed:" . mysqli_connect_error());
}
$username = $_SESSION['username'];
?>
<?php
if (isset($_POST['unamee']) && !empty($_POST['unamee']) && isset($_POST['unameedittick'])) {
    $update = $_POST['unamee'];
    $stmt = $conn->prepare("UPDATE user_details SET Username=? WHERE Username=?");
    $stmt->bind_param('ss', $update, $username);
    $stmt->execute();
    $_POST['unamee'] = "";
    $_SESSION['username'] = $username = $update;
}
if (isset($_POST['genedit']) && !empty($_POST['genedit']) && isset($_POST['genderedittick'])) {
    $update = $_POST['genedit'];
    $stmt = $conn->prepare("UPDATE user_details SET Gender=? WHERE Username=?");
    $stmt->bind_param('ss', $update, $username);
    $stmt->execute();
    $_POST['genedit'] = "";
}

if (isset($_POST['phoneedit']) && !empty($_POST['phoneedit']) && isset($_POST['phonenoedittick'])) {
    $update = $_POST['phoneedit'];
    $stmt = $conn->prepare("UPDATE user_details SET Phoneno=? WHERE Username=?");
    $stmt->bind_param('ss', $update, $username);
    $stmt->execute();
    $_POST['phoneedit'] = "";
}
if (isset($_POST['emedit']) && !empty($_POST['emedit']) && isset($_POST['emailedittick'])) {
    $update = $_POST['emedit'];
    $stmt = $conn->prepare("UPDATE user_details SET Email=? WHERE Username=?");
    $stmt->bind_param('ss', $update, $username);
    $stmt->execute();
    $_POST['emedit'] = "";
}
if (isset($_POST['ciedit']) && !empty($_POST['ciedit']) && isset($_POST['cityedittick'])) {
    $update = $_POST['ciedit'];
    $stmt = $conn->prepare("UPDATE user_details SET City=? WHERE Username=?");
    $stmt->bind_param('ss', $update, $username);
    $stmt->execute();
    $_POST['ciedit'] = "";
}
if (isset($_POST['stedit']) && !empty($_POST['stedit']) && isset($_POST['stateedittick'])) {
    $update = $_POST['stedit'];
    $stmt = $conn->prepare("UPDATE user_details SET State1=? WHERE Username=?");
    $stmt->bind_param('ss', $update, $username);
    $stmt->execute();
    $_POST['stedit'] = "";
}
$unameedit = $genderedit = $emailedit = $phonenoedit = $addressedit = $cityedit = $stateedit = "none";
if (isset($_POST['uedit'])) {
    $unameedit = "";
}
if (isset($_POST['gedit'])) {
    $genderedit = "";
}
if (isset($_POST['eedit'])) {
    $emailedit = "";
}
if (isset($_POST['pedit'])) {
    $phonenoedit = "";
}
if (isset($_POST['cedit'])) {
    $cityedit = "";
}
if (isset($_POST['sedit'])) {
    $stateedit = "";
}
if (isset($_POST['aedit'])) {
    $addressedit = "";
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Profile</title>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
    <style>
        .error {
            color: #FF0000;
        }

        .btn {
            background-color: red;
        }

        .btnt {
            background-color: green;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <ul>
        <li><a class="left"><img src="Images/Mainlogo.jpg" width="100"> </a></li>
        <li><a class="left" href="Home_page.php">Home</a></li>
        <li><a class="left" href="#About">About</a></li>
        <li><a class="left" href="#Contact">Contact</a></li>

        <li style="visibility:<?php echo "$islogin" ?>"><a class="right" href="profilepage.php">Profile</a></li>
        <li style="visibility:<?php echo "$islogin" ?>"><a class="right" href="Logout.php">Log out</a></li>
        <li style="visibility:<?php echo "$islogin" ?>"><a class="right" href="Chat.php">Chat</a></li>
        <li style="visibility:<?php echo "$islogin" ?>"><a class="right" href="Startup.php">Add your Startup</a></li>
        <li style="visibility:<?php echo "$islogin" ?>"><a class="right" href="Events.php">Add new Event</a></li>
        <li style="visibility:<?php echo "$islogout" ?>"><a class="right" href="Signup.php">Sign up</a></li>
        <li style="visibility:<?php echo "$islogout" ?>"><a class="right" href="Login.php">Log in</a></li>

    </ul> <br />
    <?php

    $phoneno = $address = $gender = $emailid = $city = $state = "";

    $stmt = $conn->prepare("SELECT * FROM user_details WHERE Username=?");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $phoneno = $row['Phoneno'];
        $emailid = $row['Email'];
        $city = $row['City'];
        $state = $row['State'];
        $gender = $row['Gender'];
    }
    $stmt->close();
    ?>
    <div align="center" id="reg">
        <h1>Your Profile</h1><br>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
            <img src="Images/login.jpg" height="150" width="150"></br>
            User Name:
            <input type="text" class="input-box" value=<?php echo $_SESSION['username']; ?> disabled>
            <button type="submit" style="font-size:24px" name="uedit" class="btn"><i class="fa fa-edit" style="color:white"></i></button>
            <input type="text" style="display:<?php echo "$unameedit" ?>" name="unamee" class="input-box">
            <button type="submit" style="display:<?php echo "$unameedit" ?>" class="btn"><i class="fa fa-close" style="color:white"></i></button>
            <button type="submit" style="display:<?php echo "$unameedit" ?>" name="unameedittick" class="btnt"><i class="fa fa-check" style="color:white"></i></button>
            <br><br>
            Gender:
            <input type="text" class="input-box" value=<?php echo $gender; ?> disabled>
            <button type="submit" style="font-size:24px" name="gedit" class="btn"><i class="fa fa-edit" style="color:white"></i></button>
            <input type="radio" style="display:<?php echo "$genderedit" ?>" name="genedit" value="male"><label style="display:<?php echo "$genderedit" ?>">Male</label>
            <input type="radio" style="display:<?php echo "$genderedit" ?>" name="genedit" value="female"> <label style="display:<?php echo "$genderedit" ?>">Female</label>
            <input type="radio" style="display:<?php echo "$genderedit" ?>" name="genedit" value="other"> <label style="display:<?php echo "$genderedit" ?>">Other</label>
            <button type="submit" style="display:<?php echo "$genderedit" ?>" class="btn"><i class="fa fa-close" style="color:white"></i></button>
            <button type="submit" style="display:<?php echo "$genderedit" ?>" name="genderedittick" class="btnt"><i class="fa fa-check" style="color:white"></i></button>
            <br><br>
            Email id:
            <input type="text" class="input-box" value=<?php echo $emailid; ?> disabled>
            <button type="submit" style="font-size:24px" name="eedit" class="btn"><i class="fa fa-edit" style="color:white"></i></button>
            <input type="text" style="display:<?php echo "$emailedit" ?>" name="emaedit" class="input-box">
            <button type="submit" style="display:<?php echo "$emailedit" ?>" class="btn"><i class="fa fa-close" style="color:white"></i></button>
            <button type="submit" style="display:<?php echo "$emailedit" ?>" name="emailedittick" class="btnt"><i class="fa fa-check" style="color:white"></i></button>
            <br><br>
            Phone No:
            <input type="text" class="input-box" value=<?php echo $phoneno; ?> disabled>
            <button type="submit" style="font-size:24px" name="pedit" class="btn"><i class="fa fa-edit" style="color:white"></i></button>
            <input type="text" style="display:<?php echo "$phonenoedit" ?>" name="phoneedit" class="input-box">
            <button type="submit" style="display:<?php echo "$phonenoedit" ?>" class="btn"><i class="fa fa-close" style="color:white"></i></button>
            <button type="submit" style="display:<?php echo "$phonenoedit" ?>" name="phonenoedittick" class="btnt"><i class="fa fa-check" style="color:white"></i></button>
            <br><br>
            City:
            <input type="text" class="input-box" value=<?php echo $city; ?> disabled>
            <button type="submit" style="font-size:24px" name="cedit" class="btn"><i class="fa fa-edit" style="color:white"></i></button>
            <select style="display:<?php echo "$cityedit" ?>" name="ciedit" class="input-box" size=1>
                <option value="Mumbai">Mumbai</option>
                <option value="Pune">Pune</option>
                <option value="Bangalore">Bangalore</option>
                <option value="Delhi">Delhi</option>
            </select>
            <button type="submit" style="display:<?php echo "$cityedit" ?>" class="btn"><i class="fa fa-close" style="color:white"></i></button>
            <button type="submit" style="display:<?php echo "$cityedit" ?>" name="cityedittick" class="btnt"><i class="fa fa-check" style="color:white"></i></button>
            <br><br>
            State:
            <input type="text" class="input-box" value=<?php echo $state ?> disabled>
            <button type="submit" style="font-size:24px" name="sedit" class="btn"><i class="fa fa-edit" style="color:white"></i></button>
            <select style="display:<?php echo "$stateedit" ?>" name="stedit" class="input-box" size=1>
                <option value="Gujarat">Gujarat</option>
                <option value="Maharashtra">Maharashtra</option>
                <option value="Punjab">Punjab</option>
                <option value="Rajasthan">Rajasthan</option>
                <option value="Tamil Nadu">Tamil Nadu</option>
            </select>
            <button type="submit" style="display:<?php echo "$stateedit" ?>" class="btn"><i class="fa fa-close" style="color:white"></i></button>
            <button type="submit" style="display:<?php echo "$stateedit" ?>" name="stateedittick" class="btnt"><i class="fa fa-check" style="color:white"></i></button>
            <br><br>
        </form>
    </div>
</body>

</html>