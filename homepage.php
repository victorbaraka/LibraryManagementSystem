<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <meta name="Viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="homepage.css">

        <title> Home</title>
        
        
    </head>
    <body>
    <div class = "topnav">
        <a class="active" href="homepage.php">
            Home
        </a>
        <a href="homepage.php">Request</a>
        <a href="add_book.php">Add Book</a>
        <div class="search">
        <form action="Search.php" method="GET">    
        <Input type="text" id="search" name="search" placeholder="Search..">
        <button type="Submit"  value="search"  class="Search-button">
            <img src="search-icon.png" alt="Search">
        </button>
    </form>
        </div>
            

    </div>
       <header>
        <h1>Welcome <?php echo htmlspecialchars($_SESSION["username"]); ?>!</h1>
       </header>

        <p>This is your homepage</p>

        

    </body>
</html>