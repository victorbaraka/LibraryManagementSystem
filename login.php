<?php
$servername = "";
$username = "";
$password = "";
$dbname = "";

//create connection
if ($conn->connect_error){
    die("connection failed". $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"]=="POST"){
    $username = $_POST["Usrname"];
    $password = $_POST["Password"];

    $sql = "SELECT id,password FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows >0){
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])){
            $_SESSION["Username"] = $username;
            header("Location: homepage.php");

        }
        else{
            echo "incorrect password";
        }
    
    }
    else{
        echo "No user found with that username";
    }

}
$conn->close();

?>