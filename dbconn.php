<?php
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
?>