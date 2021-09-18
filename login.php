<!DOCTYPE html>

<html lang="en">

<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
</head>

<body>


    <?php
    $invalidErr = "";
    ?>

    <?php

    if (isset($_POST["loginuser"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['loginuser'];
        $password = $_POST['loginpassword'];
        $conn = mysqli_connect("localhost", "root", "", "Getspon");
        if (!$conn) {
            die("Connection failed:" . mysqli_connect_error());
        }
        $stmt = $conn->prepare("SELECT Username, Password1 FROM user_details WHERE Username=?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        $num = mysqli_num_rows($result);
        if ($num == 1) {
            while ($row = mysqli_fetch_assoc($result)) {
                if (password_verify($password, $row['Password1'])) {
                    session_start();
                    // $login = true;
                    // $_SESSION['loggedin'] = true;
                    // $_SESSION['username'] = $username;
                    $_SESSION["login"] = "visible";
                    $_SESSION["username"] = $username;
                    header("location: Home_page.php");
                } else {
                    $invalidErr = "Invalid Credentials";
                }
            }
        } else {
            $invalidErr = "Invalid Credentials";
        }
    }
    ?>


    <ul>
        <li><a class="left"><img src="Images/Mainlogo.jpg" width="100" </a></li>
        <li><a class="right" href="Signup.php">Sign up</a></li>
    </ul><br><br>



    <div align="center" id="log" style="color:black">
        <h1>Login</h1>
        <img src="Images/login.jpg" height="150" width="150">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

            <input type="text" name="loginuser" placeholder="Enter Username" class="input-box" required><br><br>
            <input type="password" name="loginpassword" placeholder="Enter password" class="input-box" required><br><br>
            <Text class="right"><a href="Signup.php">Forgot Password?</a></Text><br><br>

            <span class="error">* <?php echo $invalidErr; ?></span><br>

            <input class="button" type="submit" value="Login">
            <!-- <input type="checkbox" name="remember"> Remember me<br><br> -->

        </form>

        <Text>Don't have an account? <a href="Signup.php">Sign Up</a></Text><br><br>



        <p class="another">-------------------------OR-------------------------</p>

        <button class="loginwithg-button">Login with Google</button>
        <button class="loginwithf-button">Login with Facebook</button>
    </div>
</body>

</html>