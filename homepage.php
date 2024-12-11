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
        <a href="homepage.php">Home</a>
        <a href="add_book.php">Genre</a>
        <a href="">Categories</a>
        <a href="">Popular</a>
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
    <div class="welcome message">
        <h1>Welcome <?php echo htmlspecialchars($_SESSION["username"]); ?>!</h1>
       </header>
    </div>
    <div class="recents" >
        <p>Recently Read📖</p>

    </div>
    <div>
        <p>More by same Author</p>
    </div>
    <div>
        <p>More of the same Genre</p>
    </div>
    <div class="recommended">
        <p> More you may like❤</p>

    </div>
    

        

    </body>
</html>