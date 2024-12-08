<?php
$servername = "";
$username = "";
$password = "";
$dbname = "";

// create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// check connection
if ($conn -> connect_error){
    die("Connection Failed: ".$conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST["username"];
    $password = password_hash($_POST["password"],PASSWORD_BCRYPT);
    $email = $_POST["Email"];

    $sql = "INSERT INTO users (username, password,email) values('$username','password','email')";
    if($conn->query($sql)===TRUE){
        echo "New record created successfully";
        header("Location: lmslogin.html");
        
    }
    else{
        echo "Error ". $sql. "<br>".$conn->error;
    }
}   
$conn->close();
?>
