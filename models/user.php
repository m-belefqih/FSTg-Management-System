<?php
require($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/config/DB_connection.php');

// Function to validate login credentials
function validateLoginCredentials($email, $password)
{
    global $conn;
    // First, get the user by email only
    $query = "SELECT * FROM user WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Then verify the password
    if ($user && password_verify($password, $user['password'])) {
        return $user;
    }
    return false;
}

// Function to fetch role information
function getRoleById($roleId)
{
    global $conn; // Use the global connection variable of DB_connection.php
    $query = "SELECT nom FROM role WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$roleId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);}

// Function to handle remember me functionality
function handleRememberMe($userId):void
{
    global $conn; // Use the global connection variable of DB_connection.php
    $selector = bin2hex(random_bytes(12));
    $validator = random_bytes(32);
    $hashedValidator = hash('sha256', $validator);
    $expiry = date('Y-m-d H:i:s', strtotime('+30 days'));

    $query = "INSERT INTO user_tokens (selector, hashed_validator, user_id, expiry) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->execute([$selector, $hashedValidator, $userId, $expiry]);

    setcookie('remember', $selector.':'.bin2hex($validator), time() + (86400 * 30), "/", "", false, true);
}

?>

