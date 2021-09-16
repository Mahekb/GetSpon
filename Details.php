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
    </style>
</head>
<body>
    
<?php

$id = $_GET['event_id'];
$conn = mysqli_connect("localhost","root","","Getspon");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$stmt = $conn->prepare("SELECT Event_id,Event_name,Details,city,state1,Phoneno,Email,Amount,Date1,Logo FROM events WHERE Event_id=?");
$stmt->bind_param('s', $id);
$stmt->execute();
$result = $stmt->get_result();


echo '<div align="center">';
while ($row = $result->fetch_assoc()) {
  echo '<img src="' . $row['Logo'] . '"width="150">' . '<br/>';
  echo "<h1>" . $row['Event_name'] . "</h1  >";
  echo "<h3>Location: " . $row['city'] . "</h3>";
  echo "<h3>State: " . $row['state1'] . "</h3>";
  echo "<h3>Date: " . $row['Date1'] . "</h3>";
  echo "<h3>Amount: " . $row['Amount'] . "</h3>";
  echo "<h3>Phone no: " . $row['Phoneno'] . "</h3>";
  echo "<h3>Email: " . $row['Email'] . "</h3>";
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