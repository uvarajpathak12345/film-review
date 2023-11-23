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
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm-password'];

        // Check if the username and hashed password combination already exists
        $res = "SELECT * FROM filmsignup WHERE Username='$username' AND ConfirmPassword='$confirmPassword'";
        $check = $conn->query($res);

        if ($check->num_rows > 0) {
            // Display an alert if the username and password combination exists
            echo "<script type='text/javascript'>";
            echo "alert('Username and password combination already exists. Please choose another.');";
            echo "window.location.href = 'file:///C:/xampp/htdocs/film%20login/signup.html';";
            echo "</script>";
        } else {
            // Proceed with inserting the new record if the combination doesn't exist
            if ($password == $confirmPassword) {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                $sql = "INSERT INTO filmsignup (Username, Email, Passwords, ConfirmPassword, DateAdded) VALUES ('$username', '$email', '$hashedPassword', '$confirmPassword', CURRENT_TIMESTAMP)";

                if ($conn->query($sql) == true) {
                    echo "<script type='text/javascript'>";
                    echo "alert('Account Created Successfully!');";
                    echo "window.location.href = 'file:///C:/xampp/htdocs/film%20login/login.html';";
                    echo "</script>";
                } else {
                    echo "<script type='text/javascript'>";
                    echo "alert('Error: " . $conn->error . "');";
                    echo "</script>";
                }
            } else {
                echo "<script type='text/javascript'>";
                echo "alert('Passwords do not match');";
                echo "window.location.href = 'file:///C:/xampp/htdocs/film%20login/signup.html';";
                echo "</script>";
            }
        }
    }
    $conn->close();
}
?>
