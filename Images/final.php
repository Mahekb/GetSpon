<?php
session_start();
?>

<!DOCTYPE html>
<html>
<body> 

<?php 
    $password123 = $_SESSION["pass"];
    echo $password123;
    print_r($_SESSION);
    ?>
   
    <div align="center" id="log">
        <h1>Login</h1>
    <form method=post  >

    <?php 
    // $password123 = $_SESSION["pass"];
    // echo $password123;
    // print_r($_SESSION);
    ?>

    <input class="submit-button" type="submit" value="Next">
    </form>
    </div>

</body>
</html>