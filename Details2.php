<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>
.details {
  background-color: rgb(0, 81, 255);
  color: rgb(255, 255, 255);
  padding: 13px 30px;
  text-align: center;
  font-size: 15px;
  border-radius:30px;   
}

body {
  background-color: rgb(138, 236, 243);

}

.doc {
  font-size: 24px;
}
    </style>
</head>
<body>
    
<?php

$id = $_GET['s_id'];
$conn = mysqli_connect("localhost","root","","Getspon");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// $uname=$_SESSION['username'];

// $stmt2 = $conn->prepare("SELECT Firstname,Lastname,City FROM user_details WHERE Username=?");
//   $stmt2->bind_param('s', $uname);
//   $stmt2->execute();
//   $result2 = $stmt2->get_result();
//   while ($row = $result2->fetch_assoc()) { 
//     $fn = $row['Firstname'];
//     $ln = $row['Lastname'];
//     $city = $row['City'];
//   }
//   $stmt2->close();

$stmt1 = $conn->prepare("SELECT Username FROM startups WHERE Startup_id=?");
$stmt1->bind_param('s', $id);
$stmt1->execute();
$result4 = $stmt1->get_result();
while ($row = $result4->fetch_assoc()) { 
      $uname = $row['Username'];
    }
$stmt1->close();

// echo($uname);

$stmt2 = $conn->prepare("SELECT Firstname,Lastname,City FROM user_details WHERE Username=?");
$stmt2->bind_param('s', $uname);
$stmt2->execute();
$result5 = $stmt2->get_result();
while ($row = $result5->fetch_assoc()) { 
      $fname = $row['Firstname'];
      $lname = $row['Lastname'];
      $city = $row['City'];
    }
$stmt2->close();



$stmt = $conn->prepare("SELECT Startup_Name,Description1,emp_Status,phone_no,email,Amount,links,Ifile FROM startups WHERE Startup_id=?");
$stmt->bind_param('s', $id);
$stmt->execute();
$result = $stmt->get_result();


echo '<div align="center">';
while ($row = $result->fetch_assoc()) {

  echo "<h1><u>" . $row['Startup_Name'] . "</u></h1>";
  echo "<h3>Name: " . $fname . " " . $lname . "</h3>";
  echo "<h3>Description: " . $row['Description1'] . "</h3>";
  echo "<h3>Employement Status: " . $row['emp_Status'] . "</h3>";
  echo "<h3>City: " . $city . "</h3>";
  echo "<h3>Amount: " . $row['Amount'] . "</h3>";
  echo "<h3>Phone no: " . $row['phone_no'] . "</h3>";
  echo "<h3>Email: " . $row['email'] . "</h3>";
  if ($row['links'] != "") {
  echo "<h3>Links: <a href='" . $row['links'] . "'>" . $row['links'] . "</a></h3>";
  }
  echo "<a href='" . $row['Ifile'] . "'>";
  echo '<div class="doc">Click here to download Startup Details</div></a>';
  echo "<br /><br/>";
  
  
}

$stmt->close();
$conn->close();

echo '<button name="back" class="details" onclick="myFunction()">Go back</button>&emsp;&emsp;&emsp;';
echo '<button name="chat" class="details" onclick="myFunction2()">Start Chat</button>';

echo '</div>';
?>

<script>
function myFunction() {
  location.replace("http://localhost/Getspon/Home_page.php")
} 

function myFunction2() {
  location.replace("http://localhost/Getspon/Chat.php")
} 
</script>


</body>
</html>