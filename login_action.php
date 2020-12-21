<?php
// Start the session
session_start();
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
<?php   

    if($_SERVER["REQUEST_METHOD"] == "POST") {

        if ( isset($_POST['EmailLogin'], $_POST['PasswordLogin'] ) ){       
            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
           
            if (filter_var($_POST["EmailLogin"], FILTER_VALIDATE_EMAIL)) {
                $email = test_input($_POST["EmailLogin"]);
            }
            else {
                echo "<script>alert('Please Enter Valid Email ID'); window.location.href='reg_form.php';</script> ";
                exit();
            }
            $password = $_POST["PasswordLogin"];

            
                                   
            $sql = "SELECT * FROM registration_form WHERE Email='".$email."' AND Password='".$password."';";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    $_SESSION["userEmail"] = $row['Email'];
                    echo "<script> window.location.href='dashboard.php';</script> ";
                    exit();
                }
            } else {
                echo "<script>alert('No User Found Please Enter Valid Credentials'); window.location.href='reg_form.php';</script> ";
                exit();
            }
            
            $conn->close();

        }
    }else {
        echo "<script>alert('No User Found Please Enter Valid Credentials'); window.location.href='reg_form.php';</script> ";
        exit();
    }
?>