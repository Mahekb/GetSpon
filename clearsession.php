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

header("Location: http://localhost:8080/Getspon/Signup.php");
exit();


?>
    
</body>
</html>