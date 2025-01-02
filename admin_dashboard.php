<?php
session_start();
if (!isset($_SESSION["admin-username"])) {
    header("Location: admin_login_form.php");
    exit();
}

//Adding the environmental variables

$env=file(__DIR__.'/.env', FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES);
foreach($env as $line){
    // skip comments
    if(strpos(trim($line),'#')===0){
        continue;
    }
    // parse and set environmental variables
    list($key,$value) = explode('=' ,$line,2);
    putenv(trim($key).'='.trim($value));

}
//Access the environment variables
$serverName = getenv('DB_SERVERNAME');
$userName = getenv('DB_USERNAME');
$password = getenv('DB_PASSWORD');
$dbName = getenv('DB_NAME');



// Create connection
$conn = new mysqli($serverName, $userName, $password, $dbName);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle book addition
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_book"])) {
    $title = $_POST["title"];
    $author = $_POST["author"];
    $genre = $_POST["Genre"];
    $pub_date = $_POST["pub_date"];
    $isbn = $_POST["isbn"];


    //Handling Cover image upload
    $target_dir = "uploads/";
    $target_file= $target_dir.basename($_FILES["cover_image"]["name"]);

    // Check if file is an image

    $check = getimagesize($_FILES["cover_image"]["tmp_name"]);
    if ($check !== FALSE){
    if(move_uploaded_file($_FILES["cover_image"]["tmp_name"],$target_file)){
        $uploadMsg= "The file  ". htmlspecialchars(basename($_FILES["cover_image"]["name"])). "has been uploaded";
    }
    else{
        $imageErrMsg= "sorry there is an error in the upload of your file";
        
       

        exit;
    }

    }
    else{
        echo "file is not an image.";
        exit;
    }

    $sql = "INSERT INTO books (title, author, genre, pub_date,cover_image,isbn) VALUES ('$title', '$author', '$genre', '$pub_date', '$target_file','$isbn')";
    if ($conn->query($sql) === TRUE) {
        $bookAddMsg= "New book added successfully";
    } else {
        $bookAddError= "Error: " . $sql . "<br>" . $conn->error;
    }
}


// Handle book deletion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_book"])) {
    $book_id = $_POST["book_id"];

    $sql = "DELETE FROM books WHERE id = $book_id";
    if ($conn->query($sql) === TRUE) {
        $delSuccessMsg= "Book deleted successfully";
    } else {
        $delErrMsg= "Error: " . $sql . "<br>" . $conn->error;
    }
}

$books_result = $conn->query("SELECT * FROM books");

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <Style>
        body {
            background-color: antiquewhite;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            font-size: medium;

        }
        </Style>
</head>
<body>

    <h1>Welcome back <?php echo htmlspecialchars($_SESSION["admin-username"]); ?>! </h1>
    
    <div>
    <h2>Add a New Book</h2>
    <form action="admin_dashboard.php" method="POST" enctype="multipart/form-data">

    <div>
    <label for="search">Search</label>
    <input type="text" name="search" id="search" class="search" placeholder="Search...">
     <button type="submit" value="search" class="searchButton">
        <img src="search-icon.png" alt="search">
     </button>
    </div>

        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required><br><br>
        
        <div class="coverImage">
        <label for="Cover Image">Cover Image</label>
        <input type="file" name="cover_image" class="form-control" accept="image/*" required>
        </div>
        <div class="author">
        <label for="author">Author:</label>
        <input type="text" id="author" name="author" required><br><br>
        </div>

        <div class="isbn">
            <label for="isbn"> ISBN: </label>
            <input type="text"  name="isbn" id="isbn" class="isbn" title="123-12-123-123345-1" placeholder="123-12-123-12345-1" required>
            <span id="isbnValid" class="valid"></span><span id="isbnError" class="err"></span>
        </div>

        <div class="genre">
        <label for="genre">Genre:</label>
        <select name="Genre" id="Genre">
            <option value="Fiction">Fiction</option>
            <option value="SciFi">Scifi</option>
            <option value="Education">Education</option>
            <option value="Adventure">Adventure</option>
            <option value="Self help">Self help</option>
        </select>
        </div>

        
            
        <div class="pubDate">
        <label for="pub_date">Publication Date:</label>
        <input type="date" id="pub_date" name="pub_date" required><br><br>
        </div>
        <input type="hidden" name="add_book" value="true">
        <input type="submit" value="Add Book">
    </form>
    </div>
    

    <h2>Delete a Book</h2>
    <form action="admin_dashboard.php" method="POST">
        <label for="book_id">Book ID:</label>
        <input type="number" id="book_id" name="book_id" required min="0"><br><br>
        <input type="hidden" name="delete_book" value="true">
        <input type="submit" value="Delete Book">

        <script>
            function validateInput(){
                if (input.value < 0){
                    input.value=0
                }

            }
        </script>
    </form>
    <script>
        const isbnRegex = /^\d{3}-\d{2}-\d{3}-\d{5}-\d{1}$/;
        function validateIsbn(){
            const isbnInput = document.getElementById('isbn');

            document.getElementById('isbnValid').textContent=" ";
            document.getElementById('isbnError').textContent=" ";

            if (isbnRegex.test(isbnInput)){
                document.getElementById('isbnValid').textContent="✔";
                return true;

            }
            else{
                document.getElementById('isbnError').textContent="❌";
                return false;
            }
        }
        
    </script>

    <h2>Current Books</h2>
    <?php
    if ($books_result->num_rows > 0) {
        echo"<Div class=\"displaytable\">";
        echo "<table>";
        echo "<tr><th>ID</th><th>ISBN</th><th>Title</th><th>Author</th><th>Genre</th><th>Publication Date</th><th>Cover image</th></tr>";
        while ($row = $books_result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>". $row['id'] ."</td>";
            echo "<td>". $row['isbn'] ."</td>";
            echo "<td>". $row['title'] ."</td>";
            echo "<td>". $row['author'] ."</td>";
            echo "<td>". $row['genre'] ."</td>";
            echo "<td>". $row['pub_date'] ."</td>";
            


            // Display the cover image 
            $cover_image_path = basename($row['cover_image']);
            if (file_exists($cover_image_path)){
                echo "<td><img src='uploads/". $cover_image_path. "' alt='cover image' style='width: 100px; height:auto'></td>";
            }
            else{
                echo"<td> No image available </td>";
            }
            echo"</tr>";
            
            
        }
        echo "</table>";
        echo"</div>";
    } else {
        echo "<p>No books available.</p>";
    }
    ?>
    <button>
    <a href="logout.php">Logout</a>
</button>
</body>
</html>
