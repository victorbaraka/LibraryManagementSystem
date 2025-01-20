<?php
session_start();
require 'dbconn.php';

// Init books array
$books=[];
$query= "SELECT title, cover_image FROM books";
$result= $conn->query($query);
if ($result->num_rows>0){
    while($row = $result->fetch_assoc()){
        $books[]=$row;
    }
}

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
        
        <a href="add_book.php">Genre</a>
        <a href="">Categories</a>
        <a href="">Popular</a>
        <div class="search">
        <form action="Search.php" method="GET">    
        <Input type="text" id="search" name="search" placeholder="Search..">
        <button type="Submit"  value="search"  class="searchButton">
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
        <h3>Recently Read📖</h3>
        <div class="gridContainer">
            <?php foreach($books as $book): ?>
            <div class="gridItem">
            <img src="<?php echo htmlspecialchars($book['cover_image']);   ?>"alt="<?php echo htmlspecialchars($book['$title']); ?>"
            <p><?php echo htmlspecialchars($book['title']); ?></p>
            </div>
            <?php endforeach; ?>

        </div>

    </div>
    <div>
        <h3>More by same Author</h3>
    </div>
    <div>
        <h3>More of the same Genre</h3>
    </div>
    <div class="recommended">
        <h4> More you may like</h4>

    </div>
    

        

    </body>
</html>