<?php
session_start();


$Fname = $Lname = $Email = $Contact = $Age = $Password = $ConfirmPassword = $Pimage = '';
  $FnameErr = $LnameErr = $EmailErr = $ContactErr = $AgeErr = $PasswordErr = $ConfirmPasswordErr = $PimageErr = '';
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["Fname"])) {
      $first = $_POST["Fname"];
      $Fname = filter_var($first, FILTER_SANITIZE_STRING);
    } else{
       $FnameErr = "Please fill this field";
    }
    if (!empty($_POST["Lname"])) {
        $last = $_POST["Lname"];
        $Lname = filter_var($last, FILTER_SANITIZE_STRING);
    } else{
       $LnameErr = 'Please fill this field';
    }
    if (!empty($_POST["Email"])) {
      $Email = test_input($_POST["Email"]);
    } else{
       $EmailErr = 'Please fill this field';
    }
    if (!empty($_POST["Contact"])) {
      $Contact = $_POST["Contact"];
    } else{
       $ContactErr = 'Please fill this field';
    }
    if (!empty($_POST["Age"])) {
        $Age = $_POST["Age"];
    } else{
         $AgeErr = 'Please fill this field';
    }
    if (!empty($_POST["Password"])) {
        $Password = $_POST["Password"];
    } else{
         $PasswordErr = 'Please fill this field';
    }
    if (!empty($_POST["ConfirmPassword"])) {
        $ConfirmPassword = $_POST["ConfirmPassword"];
    } else{
         $ConfirmPasswordErr = 'Please fill this field';
    }
    


    $target_dir = "user_images/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    // Check if image file is a actual image or fake image
    if(isset($_POST["Submit"])) {
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if($check !== false) {
        echo "File is an image - " . $check["mime"] . "."."<br>";
        $uploadOk = 1;
      } else {
        echo "File is not an image."."<br>";
        $uploadOk = 0;
      }
    }
    
    // Check if file already exists
    if (file_exists($target_file)) {
      echo "Sorry, file already exists."."<br>";
      $uploadOk = 0;
    }
    
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
      echo "Sorry, your file is too large."."<br>";
      $uploadOk = 0;
    }
    
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed."."<br>";
      $uploadOk = 0;
    }
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded."."<br>";
    // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( $_FILES["fileToUpload"]["name"]). " has been uploaded."."<br>";
      } else {
        echo "Sorry, there was an error uploading your file."."<br>";
      }
    }
    $Pimage = $target_file ;



    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "GitAssignmentDatabase";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }    
    if($Password===$ConfirmPassword){
    $sql = "INSERT INTO registration_form (Fname, Lname, Email, Contact, Age, Password, ConfirmPassword, Pimage)
    VALUES ('$Fname', '$Lname', '$Email', '$Contact', '$Age', '$Password', '$ConfirmPassword', '$Pimage');";
    


    if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
      echo "<br>";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
      echo "<br>";
    }
    $conn->close();
}
  }

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>


<html>
<head>

<link rel="stylesheet" type="text/css" href="style.css" media="screen"/>



</head>
<body>


<table style="width:100%">
  <tr>
    <th>Name</th> 
    <th>Email</th>
    <th>Contact</th>
    <th>Age</th>
    <th>Profile Image</th>
  </tr>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "GitAssignmentDatabase";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

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

<br>
<hr>
<br>

<center><h2>Registration Form</h2></center>
    <br>
    <center>
    <div class="form">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
            First Name: <input type="text" name="Fname" value=""> &nbsp; *<span><?php echo $FnameErr; ?></span><br><br>
            Last Name: <input type="text" name="Lname" value=""> &nbsp; *<span><?php echo $LnameErr; ?></span><br><br>
            Email:  &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   <input type="email" name="Email" value=""> &nbsp; *<span><?php echo $EmailErr; ?></span><br><br>
            Contact: &nbsp;&nbsp;&nbsp;&nbsp; <input type="text" maxlength="10" pattern="\d{10}" name="Contact"> &nbsp; *<span><?php echo $ContactErr; ?></span><br><br>
            Age:  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="number" min="18" max="90" name="Age" value=""> &nbsp; *<span><?php echo $AgeErr; ?></span><br><br>
            Password:  &nbsp; <input type="password" name="Password" value=""> &nbsp; *<span><?php echo $PasswordErr; ?></span><br><br>
            Confirm: &nbsp;&nbsp;&nbsp;  <input type="password" name="ConfirmPassword" value=""> &nbsp; *<span><?php echo $ConfirmPasswordErr; ?></span><br><br>
            <!-- <p class="success"></p>
            <p class="failure"></p> -->
            <?php
            $success = "Password Matched !!";
            $failure = "Please check your password";
            if($Password===$ConfirmPassword){
                echo $success."<br>";
            } else {
                echo $failure."<br>";
            }
            ?>
            Profile Image:  &nbsp;&nbsp;&nbsp; <input type="file" name="fileToUpload" id="fileToUpload"><br><br>
            <input type="submit" class="submit" name="Submit">
        </form>
        <br>
        <br>
        <div>
            <center>Already a user? <a href="#login">(Login)</a></center>
        </div>
        
</div>
    </center>
    <br>
    <br>
    <div>
            <center><u><h3>List of users in our database</h3></u></center>
    </div> 
<br>
<br>

</table>
</body>
</html>
<br>
<br>
<hr>






<br>
<br>
<br>
<?php
$EmailLogin = $PasswordLogin = "";
$EmailLoginErr = $PasswordLoginErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["EmailLogin"])) {
        $EmailLogin = test_input($_POST["EmailLogin"]);
    } else{
         $EmailLoginErr = 'Please fill this field';
    }
    if (!empty($_POST["PasswordLogin"])) {
        $PasswordLogin = $_POST["PasswordLogin"];
    } else{
         $PasswordLoginErr = 'Please fill this field';
    }
}


$servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "GitAssignmentDatabase";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
}

?>

<center>
<div class="form">
<link rel="stylesheet" type="text/css" href="style.css" media="screen"/>



<form id="login" action="login_action.php" enctype="multipart/form-data" method="post">
<h4>Please Login Here</h4><br>
Email:  &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   <input type="email" name="EmailLogin" value=""> &nbsp; *<span><?php echo $EmailLoginErr; ?></span><br><br><br>
Password:  &nbsp; <input type="password" name="PasswordLogin" value=""> &nbsp; *<span><?php echo $PasswordLoginErr; ?></span><br><br><br><br>
<input type="submit" class="submit" name="Submit">
</form>
</div>
</center>
<br>
<br>

