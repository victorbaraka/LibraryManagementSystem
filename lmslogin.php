<!DOCTYPE html>
<html lang = "en-US">
    <head>
        <meta charset="UTF-8">
        <meta name ="viewport" content="width=device-width, initiial-scale=1.0">
        <title>Login</title> 
        <link rel="stylesheet" href="adminLogin.css">
    </head>
    <body>
        <div class="loginComponents"> 
        <h1 class="Header">Login</h1>
        <div class="loginForm">
        <form action="login.php" method ="POST">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required><br><br>
            
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required><br><br>

           <input type="submit" value="Login">
            
        </form>
        </div>
        <p class="signUp">Don't have an account? &nbsp <a class="signUpLink" href="lmssignup.php">Signup</a>
    </p>
    <div class="separator">

    <span> or </span>

    </div>

    <div class="loginButtons">
    <button class="alt-login google-btn" id="googleLogin"><img src="google-logo.png"> &nbsp Continue with Google</button>
    <button class="alt-login ms-btn"> <img src="ms-logo.png"> &nbsp Continue with Microsoft</button>
    <button class="alt-login apple-btn"><img src="apple-logo.png"> &nbsp Continue with Apple</button>

    </div>
</div>
    </body>
</html>