<!DOCTYPE html>
<html lang = "en-US">
    <head>
        <meta charset="UTF-8">
        <meta name ="viewport" content="width=device-width, initiial-scale=1.0">
        <title>Login</title> 
    </head>
    <body>
        <h1>Login</h1>
        <form action="login.php" method ="POST">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required><br><br>
            
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required><br><br>

           <input type="submit" value="Login">
            
        </form>
    </body>
</html>