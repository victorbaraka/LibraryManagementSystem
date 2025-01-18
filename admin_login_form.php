<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="adminLogin.css">
    
</head>
<body>
    
        
<div class="loginComponents">
        
<h1 class= "Header"> Login</h1>
    
    <div class="loginForm">
    <form action="admin_login.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" class="username"  required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" class="password" required><br><br>
        <input  type="submit" value="Continue">
    </form>
    </div>

    <p class="signUp"> Don't have an account? &nbsp <a class="signUpLink" href="admin_signup_form.php">SignUp</a></p>

    <div class="separator">
    
    <span> or </span>
    
  
    </div>
    <div class="loginButtons">
    <button class="alt-login google-btn" id="googleLogin"><img src="google-logo.png"> &nbsp Continue with Google</button>
    <button class="alt-login ms-btn"> <img src="ms-logo.png"> &nbsp Continue with Microsoft</button>
    <button class="alt-login apple-btn"><img src="apple-logo.png"> &nbsp Continue with Apple</button>
    </div>
</div>
    
</div>

<script>
    document.getElementById("googleLogin").addEventListener("click", function(){ 
        window.location.href="https://accounts.google.com/o/oauth2/auth?client_id=GOOGLE_ID&redirect_uri=YOUR_REDIRECT&response_type=code&scope=profile email";
    });
</script>

</body>

</html>
