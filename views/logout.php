<?php

require($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/config/DB_connection.php');

session_start(); // Start the session or resume the current one
session_destroy(); // Delete all the session variables and destroy the session

if(isset($_COOKIE['remember'])) {
    global $conn;
    $query = "DELETE FROM user_tokens WHERE id_user = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$_SESSION['user_data']['id']]); // Delete the token from the database
    setcookie('remember', '', time() - 3600, "/"); // Delete the cookie
    unset($_COOKIE['remember']); // Unset the cookie in the PHP script
}

header("Location: /FSTg-Management-System/index.php"); // Redirect to the login page
exit(); // Ensure no further code is executed after the redirect

