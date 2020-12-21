<?php
// Start the session
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "GitAssignmentDatabase";
$userEmail = $_SESSION["userEmail"];
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}$sql = "SELECT * FROM registration_form where Email = '$userEmail';";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

  // output data of each row 
  while($row = $result->fetch_assoc()) {
      echo   "<center>"."<img src='".$row["Pimage"]."' style='width:150px; border-radius:50%; height:150px;' >"."</center>"; 
      echo "<br>";
      echo "<center>"."Hello, "."<strong>".$row["Fname"]." ".$row["Lname"]."</strong>"."</center>";
  }
} else {
  echo "0 results";
  echo "<br>";
}

?>
<br>
<br>
<hr>
<br>


<html>
<head>

<link rel="stylesheet" type="text/css" href="style.css" media="screen"/>



</head>
<body>
<div>
            <center><u><h3>List of users in our database</h3></u></center>
</div> 

<table style="width:100%">
  <tr>
    <th>Name</th> 
    <th>Email</th>
    <th>Contact</th>
    <th>Age</th>
    <th>Profile Image</th>
  </tr>

<?php


$sql = "SELECT * FROM registration_form";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

  // output data of each row 
  while($row = $result->fetch_assoc()) {

  ?>
  <tr>
    <td>  <?php echo $row["Fname"].' '.$row["Lname"];?></td>
    <td>  <?php echo $row["Email"]; ?>  </td>
    <td>  <?php echo $row["Contact"]; ?>  </td>
    <td>  <?php echo $row["Age"]; ?>  </td>
    <td>  <?php echo "<center>"."<img src='".$row["Pimage"]."' style='width:150px; border-radius:50%; height:150px;' >"."</center>"; ?>  </td>
  </tr>

  <?php
  }
} else {
  echo "0 results";
  echo "<br>";
}
$conn->close();
?>

