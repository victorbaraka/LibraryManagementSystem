<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lms";

// create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// check connection
if ($conn -> connect_error){
    die("Connection Failed: ".$conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    $sql = "INSERT INTO users (username, password,email) VALUES('$username','$password','$email')";
    if($conn->query($sql)===TRUE){
        echo "New record created successfully";
        header("Location: lmslogin.php");
        
    }
    else{
        echo "Error ". $sql. "<br>".$conn->error;
    }
}   
$conn->close();
?>
