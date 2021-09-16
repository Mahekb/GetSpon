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

        $unameErr = $genderErr = $cityErr = $stateErr = $dobErr = "";
        $userErr = $phoneErr = $emailErr = $passErr = $conpassErr = $cpassErr = $checkboxErr = "";


        if (isset($_POST['uname']) && $_SERVER["REQUEST_METHOD"] == "POST") {

                if (isset($_POST['uname'])) {

                        if (empty($_POST["uname"])) {
                                $unameErr = "Name is required";
                        } else if (!preg_match("/^[a-zA-Z ]*$/", $_POST["uname"])) {
                                $unameErr = "Only letters are allowed.";
                        } else {
                                $uname = $_POST["uname"];
                        }
                }

                if (isset($_POST['dateofbirth'])) {

                        if (empty($_POST["dateofbirth"])) {
                                $dobErr = "DOB is required";
                        } else {

                                $dateob = new DateTime($_POST['dateofbirth']);
                                $today = new Datetime(date('y.m.d'));
                                $diff = $today->diff($dateob);
                                if ($diff->y < 18) {
                                        $dobErr = "You are not eligible.";
                                } else {
                                        $dob = $_POST['dateofbirth'];
                                }


                                $dob = $_POST["dateofbirth"];
                        }
                }

                if (isset($_POST['city'])) {

                        if ($_POST['city'] == "--select--") {
                                $cityErr = "City is required";
                        } else {
                                $city = $_POST["city"];
                        }
                }

                if (isset($_POST['state'])) {

                        if ($_POST['state'] == "--select--") {
                                $stateErr = "State is required";
                        } else {
                                $state = $_POST["state"];
                        }
                }

                if (empty($_POST["gender"])) {
                        $genderErr = "Gender is required";
                } else {
                        $gender = $_POST["gender"];
                }


                if (isset($_POST['username'])) {

                        if (empty($_POST["username"])) {
                                $userErr = "Username is required";
                        } else if (!preg_match("/^[a-zA-Z0-9]*$/", $_POST["username"])) {
                                $userErr = "Only letters and numbers are allowed.";
                        } else if (strlen($_POST["username"]) <= 6) {
                                $userErr = "Username must be longer than 6 characters";
                        } else if (strlen($_POST["username"]) > 20) {
                                $userErr = "Username must be not longer than 20 characters";
                        } else {
                                $username = $_POST["username"];
                        }
                }

                if (isset($_POST['phoneno'])) {

                        if (empty($_POST["phoneno"])) {
                                $phoneErr = "Phone number is required";
                        } else if (!preg_match("/\d{10}/", $_POST["phoneno"])) {
                                $phoneErr = "Invalid Phone number.";
                        } else {
                                $phoneno = $_POST["phoneno"];
                        }
                }


                if (isset($_POST['email'])) {

                        if (empty($_POST["email"])) {
                                $emailErr = "Email is required";
                        } else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                                $emailErr = "Invalid email format";
                        } else {
                                $email = $_POST["email"];
                        }
                }

                if (isset($_POST['password'])) {

                        if (empty($_POST["password"])) {
                                $passErr = "Password is required";
                        } else if (strlen($_POST["password"]) <= 6) {
                                $passErr = "Password must be atleast of 7 characters";
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
                                $password = $_POST["password"];
                        }
                }

                if (isset($_POST['cpassword'])) {

                        if (empty($_POST["cpassword"])) {
                                $conpassErr = "Password needs to be entered again.";
                        } else {
                                $cpassword = $_POST["cpassword"];
                        }
                }

                if ($_POST['password'] != $_POST['cpassword']) {
                        $conpassErr = "Passwords should be same.";
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
                        <input type="text" name="uname" class="input-box" placeholder="First_Name Last_Name">
                        <span class="error">* <?php echo $unameErr; ?></span>
                        <br><br>

                        Date of Birth:
                        <input type="date" name="dateofbirth" class="input-box">
                        <span class="error">* <?php echo $dobErr; ?></span>
                        <br><br>

                        City:
                        <select name="city" class="input-box" size=1>
                                <option value="--select--">--select--</option>
                                <option value="Mumbai">Mumbai</option>
                                <option value="Pune">Pune</option>
                                <option value="Bangalore">Bangalore</option>
                                <option value="Delhi">Delhi</option>
                        </select>
                        <span class="error">* <?php echo $cityErr; ?></span>
                        <br><br>

                        State:
                        <select name="state" class="input-box" size=1>
                                <option value="--select--">--select--</option>
                                <option value="Gujarat">Gujarat</option>
                                <option value="Maharashtra">Maharashtra</option>
                                <option value="Punjab">Punjab</option>
                                <option value="Rajasthan">Rajasthan</option>
                                <option value="Tamil Nadu">Tamil Nadu</option>
                        </select>
                        <span class="error">* <?php echo $stateErr; ?></span>
                        <br><br>

                        Gender:
                        <input type="radio" name="gender" value="male"> Male
                        <input type="radio" name="gender" value="female"> Female
                        <input type="radio" name="gender" value="other"> Other
                        <span class="error">* <?php echo $genderErr; ?></span>
                        <br><br>

                        Username:
                        <input type="text" name="username" class="input-box">
                        <span class="error">* <?php echo $userErr; ?></span>
                        <br><br>

                        Phone no:
                        <input type="text" name="phoneno" class="input-box">
                        <span class="error">* <?php echo $phoneErr; ?></span>
                        <br><br>

                        Email:
                        <input type="text" name="email" placeholder="username@gmail.com" class="input-box">
                        <span class="error">* <?php echo $emailErr; ?></span>
                        <br><br>

                        Password:
                        <input type="password" name="password" class="input-box" placeholder="Create a strong password">
                        <span class="error">* <?php echo $passErr; ?></span>
                        <br><br>

                        Confirm password:
                        <input type="password" name="cpassword" class="input-box" placeholder="Make sure to enter the same password">
                        <span class="error">* <?php echo $conpassErr; ?></span>
                        <br><br>

                        <Text>By creating an account you agree to our <sa href="#">Terms & Privacy</sa>.</Text><br><br>
                        <input type="checkbox" name="checkbox" value="checkbox">I agree to the terms and conditions.
                        <span class="error">* <?php echo $checkboxErr; ?></span>
                        <br><br>

                        <input class="reset-button" type="reset" value="Reset">
                        <input class="submit-button" type="submit" value="Register">

                </form>
        </div>



</body>

</html>