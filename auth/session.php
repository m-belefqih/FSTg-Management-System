<?php
// Description : if the user is not logged in, but he clicked on "remember me" checkbox of the login page
// This file is responsible for handling the session and remember me functionality

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/config/DB_connection.php');

if (!isset($_SESSION['user_data']) && isset($_COOKIE['remember'])) {
    try {
        global $conn;
        // Split cookie value
        list($selector, $validator) = explode(':', $_COOKIE['remember']);

        // Hash the validator for comparison
        $hashedValidator = hash('sha256', hex2bin($validator));

        // Get token data
        $query = "SELECT id_user, hashed_validator, expiry 
                 FROM user_tokens 
                 WHERE selector = ? AND expiry > NOW()";
        $stmt = $conn->prepare($query);
        $stmt->execute([$selector]);
        $tokenData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($tokenData && hash_equals($tokenData['hashed_validator'], $hashedValidator)) {
            // Get user data
            $userQuery = "SELECT u.*, r.nom as role_name FROM user u 
                         JOIN role r ON u.id_role = r.id 
                         WHERE u.id = ?";
            $userStmt = $conn->prepare($userQuery);
            $userStmt->execute([$tokenData['id_user']]);
            $userData = $userStmt->fetch(PDO::FETCH_ASSOC);

            if ($userData) {
                // Set session data
                $_SESSION['user_data'] = $userData;
                $_SESSION['role_name'] = $userData['role_name'];

                // Generate new token (token rotation)
                $newValidator = random_bytes(32);
                $newHashedValidator = hash('sha256', $newValidator);
                $newExpiry = date('Y-m-d H:i:s', strtotime('+30 days'));

                // Update token
                $updateQuery = "UPDATE user_tokens SET hashed_validator = ?, expiry = ? WHERE selector = ?";
                $updateStmt = $conn->prepare($updateQuery);
                $updateStmt->execute([$newHashedValidator, $newExpiry, $selector]);

                // Set new cookie
                setcookie('remember', $selector . ':' . bin2hex($newValidator), time() + (86400 * 30), "/", "", false, true);
            }
        }
    } catch (PDOException $e) {
        error_log("Remember me error: " . $e->getMessage());
    }

    if (!isset($_SESSION['user_data'])) {
        setcookie('remember', '', time() - 3600, "/");
    }
}