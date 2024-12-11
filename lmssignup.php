<!DOCTYPE>
<html lang="en">
    <head>
        <meta charset = "UTF-8">
        <meta name = "viewport" content="width=device-width, initial-scale=1.0">
        <title>lms sign up</title>

    </head>
    <body>
        <h1>Sign Up</h1>
        <form action="signup.php" method="POST" onsubmit="return validateForm()">
        <label for="username"> Username:</label>
        <input type="text" id="username" name="username" required>
        <span id="usernameError" class="error"></span><span id="usernameValid" class= "valid"></span><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br> <br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        <input type="submit" value="Sign Up">
        </form>
        <script>
            const usernameregex = /^[a-zA-Z0-9._]{5,14}$/;
            function validateForm(){
                
                const username = document.getElementById('username').value;
                const password= document.getElementById('password').value;

                // clears the previous error message
                document.getElementById('usernameError').textContent= "";
                document.getElementById('usernameValid').textContent= "";

                //Checking if username matches the regex pattern
                if(usernameregex.test(username)){
                    document.getElementById('usernameValid').textContent="✔";
                    return true;// allow for form submission

                }
                else{
                    document.getElementById('usernameError').textContent="Invalid Username"
                    return false;//Deny form submission
                }

            }
            
            
        </script>
    </body>

</html>