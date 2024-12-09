<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lms";

//create connection
$conn = new mysqli($servername,$username,$password,$dbname);
if ($conn->connect_error){
    die("connection failed".$conn->connect_error);

}
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST["username"];
    $password = $_POST["password"];
    $sql = "SELECT id, password,is_admin FROM users WHERE username = '$username'";
    $result = $conn->query($sql);
    if ($result->num_rows >0){
        $row = $result->fetch_assoc();
        if ($password==$row["password"] && $row["is_admin"]){
            $_SESSION["admin-username"]=$username;
            header("Location: admin_dashboard.php");
        
        }
        else{
            echo"Incorrect password or not an admin";
        }
    }
    else{
        echo "No admin found with that username";
    }
}
$conn->close();
?>