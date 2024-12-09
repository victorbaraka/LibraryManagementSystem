<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lms";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "";
if (isset($_GET['search'])){
    $query = $_GET['search'];
}
$sql = "SELECT * FROM books WHERE title LIKE '%$query%' OR author LIKE '%$query%' OR genre LIKE '%$query%'";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
</head>
<body>
    <h1>Search Results</h1>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div>";
            echo "<h2>" . $row['title'] . "</h2>";
            echo "<p>Author: " . $row['author'] . "</p>";
            echo "<p>Genre: " . $row['genre'] . "</p>";
            echo "<p>Publication Date: " . $row['pub_date'] . "</p>";
            echo "</div><hr>";
        }
    } else {
        echo "<p>No results found for '$query'.</p>";
    }
    $conn->close();
    ?> 
        <button>
        <a href="homepage.php" target="_top" style="color:purple;" >Home</a>
        <bu
</body>
</html>


