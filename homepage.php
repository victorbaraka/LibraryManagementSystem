<?php
session_start();
if (!isset($_SESSION["Username"])) {
    header("Location: lmslogin.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <meta name="Viewport" content="width=device-width, initial-scale=1.0">
        <title> Home</title>
        
    </head>
    <body>
        <h1>Welcome <?php htmlspecialchars($_SESSION["Username"]); ?>!</h1>
        <p>This is your homepage</p>
        <a href="logout.php">
            Logout
        </a>
    </body>
</html>