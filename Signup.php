<!DOCTYPE html>
<html lang="en">

<head>
        <title>Sign up</title>
        <link rel="stylesheet" type="text/css" href="mystyle.css">
        <style>
                .error {
                        color: #FF0000;
                }
        </style>
</head>

<body>

        <?php

        $uname = $dob = $gender = $username = $phoneno = $email = $password = $cpassword = "";
        $checkbox = "";
        $city = $state = '--select--';

        $unameErr = $genderErr = $cityErr = $stateErr = $dobErr = "";
        $userErr = $phoneErr = $emailErr = $passErr = $conpassErr = $cpassErr = $checkboxErr = "";


        if (isset($_POST['uname']) && $_SERVER["REQUEST_METHOD"] == "POST") {

                if (isset($_POST['uname'])) {
                        $uname = $_POST["uname"];
                        if (empty($_POST["uname"])) {
                                $unameErr = "Name is required";
                        } else if (!preg_match("/^[a-zA-Z ]*$/", $_POST["uname"])) {
                                $unameErr = "Only letters are allowed.";
                        }
                }

                if (isset($_POST['dateofbirth'])) {
                        $dob = $_POST["dateofbirth"];
                        if (empty($_POST["dateofbirth"])) {
                                $dobErr = "DOB is required";
                        } else {

                                $dateob = new DateTime($_POST['dateofbirth']);
                                $today = new Datetime(date('y.m.d'));
                                $diff = $today->diff($dateob);
                                if ($diff->y < 18) {
                                        $dobErr = "You are not eligible.";
                                }
                        }
                }

                if (isset($_POST['city'])) {
                        $city = $_POST["city"];
                        if ($_POST['city'] == "--select--") {
                                $cityErr = "City is required";
                        }
                }

                if (isset($_POST['state'])) {
                        $state = $_POST["state"];
                        if ($_POST['state'] == "--select--") {
                                $stateErr = "State is required";
                        }
                }

                if (empty($_POST["gender"])) {
                        $genderErr = "Gender is required";
                } else {
                        $gender = $_POST["gender"];
                }


                if (isset($_POST['username'])) {
                        $username = $_POST["username"];

                        if (empty($_POST["username"])) {
                                $userErr = "Username is required";
                        } else if (!preg_match("/^[a-zA-Z0-9]*$/", $_POST["username"])) {
                                $userErr = "Only letters and numbers are allowed.";
                        } else {

                                $conn = mysqli_connect("localhost", "root", "", "Getspon");
                                if (!$conn) {
                                        die("Connection failed:" . mysqli_connect_error());
                                }
                                $stmt = $conn->prepare("SELECT Username FROM user_details WHERE Username=?");
                                $stmt->bind_param('s', $username);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                if (mysqli_num_rows($result) > 0) {
                                        $userErr = "Username is already taken.";
                                }


                                mysqli_close($conn);
                        }
                }

                if (isset($_POST['phoneno'])) {
                        $phoneno = $_POST["phoneno"];
                        if (empty($_POST["phoneno"])) {
                                $phoneErr = "Phone number is required";
                        } else if (!preg_match("/\d{10}/", $_POST["phoneno"])) {
                                $phoneErr = "Invalid Phone number.";
                        } else {

                                $conn = mysqli_connect("localhost", "root", "", "Getspon");
                                if (!$conn) {
                                        die("Connection failed:" . mysqli_connect_error());
                                }
                                $stmt = $conn->prepare("SELECT Username FROM user_details WHERE Phoneno=?");
                                $stmt->bind_param('i', $phoneno);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                if (mysqli_num_rows($result) > 0) {
                                        $phoneErr = "Phone number is already in use.";
                                }


                                mysqli_close($conn);
                        }
                }


                if (isset($_POST['email'])) {
                        $email = $_POST["email"];
                        if (empty($_POST["email"])) {
                                $emailErr = "Email is required";
                        } else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                                $emailErr = "Invalid email format";
                        } else {

                                $conn = mysqli_connect("localhost", "root", "", "Getspon");
                                if (!$conn) {
                                        die("Connection failed:" . mysqli_connect_error());
                                }
                                $stmt = $conn->prepare("SELECT Username FROM user_details WHERE Email=?");
                                $stmt->bind_param('s', $email);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                if (mysqli_num_rows($result) > 0) {
                                        $emailErr = "Email address is already in use.";
                                }
                                mysqli_close($conn);
                        }
                }

                if (isset($_POST['password'])) {
                        $password = $_POST["password"];
                        if (empty($_POST["password"])) {
                                $passErr = "Password is required";
                        } else if (!preg_match("/[A-Z]{1,}/", $_POST["password"])) {
                                $passErr = "Atleast one uppercase letter is required in password.";
                        } else if (!preg_match("/[a-z]{1,}/", $_POST["password"])) {
                                $passErr = "Atleast one lowercase letter is required in password.";
                        } else if (!preg_match("/[0-9]{1,}/", $_POST["password"])) {
                                $passErr = "Atleast one numeric value is required in password.";
                        } else if (!preg_match("/(\W{1,}|[_]{1,})/", $_POST["password"])) {
                                $passErr = "Atleast one special character is required in password.";
                        } else if (preg_match("/[ ]{1,}/", $_POST["password"])) {
                                $passErr = "Spaces are not allowed in password.";
                        } else {
                        }
                }

                if (isset($_POST['cpassword'])) {

                        $cpassword = $_POST["cpassword"];
                        if (empty($_POST["cpassword"])) {
                                $conpassErr = "Password needs to be entered again.";
                        } else if ($_POST['password'] != $_POST['cpassword']) {
                                $conpassErr = "Passwords should be same.";
                        }
                }


                if (!empty($_POST["checkbox"])) {
                        $checkbox = $_POST['checkbox'];
                }

                if (empty($_POST["checkbox"])) {
                        $checkboxErr = "Terms and conditions needs to be agreed.";
                }

                if ($unameErr == "" && $genderErr == "" && $cityErr == "" && $stateErr == "" && $dobErr == "" && $userErr == "" && $phoneErr == "" && $emailErr == "" && $passErr == "" && $conpassErr == "" && $checkboxErr == "" && $cpassErr == "") {

                        $conn = mysqli_connect("localhost", "root", "", "Getspon");

                        if (!$conn) {
                                die("Connection failed: " . mysqli_connect_error());
                        }

                        $query = "INSERT INTO user_details VALUES (?,?,?,?,?,?,?,?,?)";

                        $pst = mysqli_prepare($conn, $query);

                        $password1 = password_hash($password, PASSWORD_DEFAULT);

                        mysqli_stmt_bind_param($pst, "ssssssiss", $uname, $dob, $city, $state, $gender, $username, $phoneno, $email, $password1);

                        mysqli_stmt_execute($pst);

                        $getResult = mysqli_stmt_get_result($pst);

                        mysqli_stmt_close($pst);

                        $conn->close();

                        header("Location: http://localhost/Getspon/Login.php?username=" . $username . "&password=" . $password . "");

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

                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        Name:
                        <input type="text" name="uname" class="input-box" value="<?php echo $uname ?>" placeholder="First_Name Last_Name" maxlength="40">
                        <?php
                        if ($unameErr != "") {
                                echo '<br/> <span class="error">*' . $unameErr . '</span>';
                        }
                        ?>

                        <br><br>

                        Date of Birth:
                        <input type="date" name="dateofbirth" class="input-box" value="<?php echo $dob ?>">
                        <?php
                        if ($dobErr != "") {
                                echo '<br/> <span class="error">*' . $dobErr . '</span>';
                        }
                        ?>
                        <br><br>

                        City:
                        <select name="city" class="input-box" size=1 value="<?php echo $city ?>">
                                <option value="<?php echo $city ?>"><?php echo $city ?></option>
                                <option value="Mumbai">Mumbai</option>
                                <option value="Pune">Pune</option>
                                <option value="Bangalore">Bangalore</option>
                                <option value="Delhi">Delhi</option>
                        </select>
                        <?php
                        if ($cityErr != "") {
                                echo '<br/> <span class="error">*' . $cityErr . '</span>';
                        }
                        ?>
                        <br><br>

                        State:
                        <select name="state" class="input-box" size=1 value="<?php echo $state ?>">
                                <option value="<?php echo $state ?>"><?php echo $state ?></option>
                                <option value="Gujarat">Gujarat</option>
                                <option value="Maharashtra">Maharashtra</option>
                                <option value="Punjab">Punjab</option>
                                <option value="Rajasthan">Rajasthan</option>
                                <option value="Tamil Nadu">Tamil Nadu</option>
                        </select>
                        <?php
                        if ($stateErr != "") {
                                echo '<br/> <span class="error">*' . $stateErr . '</span>';
                        }
                        ?>
                        <br><br>

                        Gender:
                        <input type="radio" name="gender" value="male" <?php if ($gender == 'male') echo 'checked' ?>> Male
                        <input type="radio" name="gender" value="female" <?php if ($gender == 'female') echo 'checked' ?>> Female
                        <input type="radio" name="gender" value="other" <?php if ($gender == 'other') echo 'checked' ?>> Other
                        <?php
                        if ($genderErr != "") {
                                echo '<br/> <span class="error">*' . $genderErr . '</span>';
                        }
                        ?>
                        <br><br>

                        Username:
                        <input type="text" name="username" class="input-box" value="<?php echo $username ?>" minlength="6" maxlength="20">
                        <?php
                        if ($userErr != "") {
                                echo '<br/> <span class="error">*' . $userErr . '</span>';
                        }
                        ?>
                        <br><br>

                        Phone no:
                        <input type="text" name="phoneno" class="input-box" value="<?php echo $phoneno ?>">
                        <?php
                        if ($phoneErr != "") {
                                echo '<br/> <span class="error">*' . $phoneErr . '</span>';
                        }
                        ?>
                        <br><br>

                        Email:
                        <input type="text" name="email" placeholder="username@gmail.com" class="input-box" value="<?php echo $email ?>" maxlength="30">
                        <?php
                        if ($emailErr != "") {
                                echo '<br/> <span class="error">*' . $emailErr . '</span>';
                        }
                        ?>
                        <br><br>

                        Password:
                        <input type="password" name="password" class="input-box" placeholder="Create a strong password" value="<?php echo $password ?>" minlength="7" maxlength="30">
                        <?php
                        if ($passErr != "") {
                                echo '<br/> <span class="error">*' . $passErr . '</span>';
                        }
                        ?>
                        <br><br>

                        Confirm password:
                        <input type="password" name="cpassword" class="input-box" placeholder="Make sure to enter the same password" value="<?php echo $cpassword ?>">
                        <?php
                        if ($conpassErr != "") {
                                echo '<br/> <span class="error">*' . $conpassErr . '</span>';
                        }
                        ?>
                        <br><br>

                        <Text>By creating an account you agree to our <sa href="#">Terms & Privacy</sa>.</Text><br><br>
                        <input type="checkbox" name="checkbox" value="checkbox" <?php if ($checkbox == 'checkbox') echo 'checked' ?>>
                        I agree to the terms and conditions.
                        <?php
                        if ($checkboxErr != "") {
                                echo '<br/> <span class="error">*' . $checkboxErr . '</span>';
                        }
                        ?>
                        <br><br>

                        <input class="reset-button" type="reset" value="Reset">
                        <input class="submit-button" type="submit" value="Register">

                </form>
        </div>



</body>

</html>