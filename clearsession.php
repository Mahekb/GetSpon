<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head></head>
<body>

<?php 

session_unset();
session_destroy();
$_COOKIE['firstname']="";
header("Location: http://localhost/Getspon/Login.php");
exit();


?>
    
</body>
</html>
