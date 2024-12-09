<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lms";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    // Check if the username or email already exists
    $check_sql = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        echo "Username or email already exists.";
    } else {
        // Insert the new admin user into the database
        $sql = "INSERT INTO users (username, password, email, is_admin) VALUES ('$username', '$password', '$email', TRUE)";
        if ($conn->query($sql) === TRUE) {
            echo "Admin user registered successfully";
            header("Location: admin_login_form.php"); // Redirect to admin login page
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
