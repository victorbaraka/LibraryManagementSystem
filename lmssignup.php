<!DOCTYPE>
<html lang="en">
    <head>
        <meta charset = "UTF-8">
        <meta name = "viewport" content="width=device-width, initial-scale=1.0">
        <title>lms sign up</title>

    </head>
    <body>
        <h1>Sign Up</h1>
        <form action="signup.php" method="POST">
        <label for="username"> Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br> <br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        <input type="submit" value="Sign Up">
        </form>
    </body>

</html>