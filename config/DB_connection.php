<?php

$servername = "localhost"; // Server name (usually localhost for local server)
$port = "3306"; // MySQL default port
$username = "root"; // Database username
$password = ""; // Database password (empty by default for XAMPP or WAMP)
$dbname = "fstg_db"; // Name of the database to connect to

try {
    // Creating a database connection using PDO (PHP Data Objects)
    $conn = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);

    // Configure the connection to display errors
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Encode data in UTF-8 to avoid display issues
    $conn->exec("SET NAMES utf8");

    // If successful, create an error_log.txt file and write the date and time of successful connection
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt', date('Y-m-d H:i:s') . " - Successfully connected to database!\n", FILE_APPEND);

} catch (PDOException $e) {
    // In case of error, create an error_log.txt file and write the date and time of the error
    // User won't see technical error details, which is more secure
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt', date('Y-m-d H:i:s') . " - PDO Error: " . $e->getMessage(). "\n", FILE_APPEND);

    // Stop the script and display an error message on the page
    die("An error has occurred. Please contact the administrator!");
}
?>
