<?php
$server = "localhost";
$user = "root";
$pass = "";
$db = "data";

$conn = new mysqli($server, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection error: " . $conn->connect_error);
} else {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Check if the username and hashed password combination already exists
        $sql = "SELECT * FROM filmsignup WHERE Username = '$username' AND ConfirmPassword = '$password'";
        $res = $conn->query($sql);

        if ($res->num_rows > 0) {
            // Display an alert if the username and password combination exists
            echo "<script type='text/javascript'>";
            echo "alert('Login Sucess');";
            echo "window.location.href = 'file:///C:/xampp/htdocs/film%20review%20website/codes/film%20login/login.html';";
            echo "</script>";
        }
    }
}
?>
