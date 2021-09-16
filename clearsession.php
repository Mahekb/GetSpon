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

header("Location: http://localhost/Getspon/Signup.php");
exit();


?>
    
</body>
</html>