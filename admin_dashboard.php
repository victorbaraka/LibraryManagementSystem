<?php
session_start();
if (!isset($_SESSION["admin-username"])) {
    header("Location: admin_login_form.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lms";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle book addition
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_book"])) {
    $title = $_POST["title"];
    $author = $_POST["author"];
    $genre = $_POST["genre"];
    $pub_date = $_POST["pub_date"];

    //Handling Cover image upload
    $target_dir = "D:/Xampp/htdocs/Test/";
    $target_file= $target_dir.basename($_FILES["cover_image"]["name"]);

    // Check if file is an image

    $check = getimagesize($_FILES["cover_image"]["tmp_name"]);
    if ($check !== FALSE){
    if(move_uploaded_file($_FILES["cover_image"]["tmp_name"],$target_file)){
        echo "The file is  ". htmlspecialchars(basename($_FILES["cover_image"]["name"])). "has been uploaded";
    }
    else{
        echo "sorry there is an error in the upload of your file";
        exit;
    }

    }
    else{
        echo "file is not an image.";
        exit;
    }

    $sql = "INSERT INTO books (title, author, genre, pub_date,cover_image) VALUES ('$title', '$author', '$genre', '$pub_date', '$target_file')";
    if ($conn->query($sql) === TRUE) {
        echo "New book added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Handle book deletion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_book"])) {
    $book_id = $_POST["book_id"];

    $sql = "DELETE FROM books WHERE id = $book_id";
    if ($conn->query($sql) === TRUE) {
        echo "Book deleted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
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
    <h1>Admin Dashboard</h1>
    <h2>Add a New Book</h2>
    <div>
    <form action="admin_dashboard.php" method="POST" enctype="multipart/form-data">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required><br><br>
        
        <div>
        <label for="Cover Image">Cover Image</label>
        <input type="file" name="cover_image" class="form-control" accept="image/*" required>
        </div>
        <div>
        <label for="author">Author:</label>
        <input type="text" id="author" name="author" required><br><br>
        </div>

        <div>
        <label for="genre">Genre:</label>
        <input type="text" id="genre" name="genre" required><br><br>
        </div>

        
            
        <div>
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
        <input type="number" id="book_id" name="book_id" required><br><br>
        <input type="hidden" name="delete_book" value="true">
        <input type="submit" value="Delete Book">
    </form>

    <h2>Current Books</h2>
    <?php
    if ($books_result->num_rows > 0) {
        echo"<Div class=\"displaytable\">";
        echo "<table>";
        echo "<tr><th>ID</th><th>Title</th><th>Author</th><th>Genre</th><th>Publication Date</th><th>Cover image</th></tr>";
        while ($row = $books_result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>". $row['id'] ."</td>";
            echo "<td>". $row['title'] ."</td>";
            echo "<td>". $row['author'] ."</td>";
            echo "<td>". $row['genre'] ."</td>";
            echo "<td>". $row['pub_date'] ."</td>";

            // Display the cover image 
            $cover_image_path = $row['cover_image'];
            if (file_exists($cover_image_path)){
                echo "<td><img src='". $cover_image_path. "' alt='cover image' style='width: 100px; height:auto'></td>";
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
    <a href="logout.php">Logout</a>
</body>
</html>
