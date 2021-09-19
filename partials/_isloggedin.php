<?php
session_start();
$current_url = $_SERVER['REQUEST_URI'];
$current_page = substr($current_url, 9, strlen($current_url));
if (isset($_SESSION["username"])) {
    if ($current_page == 'Signup.php' || $current_page == 'Login.php') {
        header("Location:Home_page.php");
    }
} else {


    if ($current_page == 'Signup.php' || $current_page == 'Home_page.php' || $current_page == 'Login.php') {
    } else {
        header("Location:Signup.php");
    }
}
