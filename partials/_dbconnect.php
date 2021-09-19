<?php
$server = "localhost";
$username1 = "root";
$password1 = "";
$database = "Getspon";

$conn = mysqli_connect($server, $username1, $password1, $database);
if (!$conn){
    die("Connection failed due to this Error". mysqli_connect_error());
}
