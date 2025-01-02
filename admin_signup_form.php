<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Signup</title>
</head>
<body>
    <h1>Admin Signup</h1>
    <form action="admin_signup.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        <span class="message<?php echo isset($_GET['valid']) &&$_GET['valid']== '1' ?'valid':'';?><?php echo isset($_GET['msg'])? htmlspecialchars($_GET['msg']): ''; ?>">
        <span id="userNameErr" class = "err"></span><span id="userNameValid" class="valid"></span>
        </span>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        <input type="submit" value="Sign Up">
    </form>
    <script>
        const userNameRegex = /^[a-z](?:[a-z0-9_.]{5-14}[a-z0-9])?$/

        function validateUname(){
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;

            //clearing prev err msg
            document.getElementById('userNameErr').textContent="";
            document.getElementById('userNameValid').textContent="";

            //checking if username matches the regex pattern
            if(userNameRegex.test(username)){
                document.getElementById('userNameValid').textContent="✔";
                return true;//allow for form submission
            }
            else{
                document.getElementById('userNameErr').textContent="❌";
                return false;//deny form submission
            }
        }
    </script>
</body>
</html>
