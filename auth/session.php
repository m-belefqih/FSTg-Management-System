<?php
// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/config/DB_connection.php');

// Check if user is not logged in but has a remember-me cookie
if (!isset($_SESSION['user_data']) && isset($_COOKIE['remember'])) {
    // Split the remember-me cookie value into selector and validator
    list($selector, $validator) = explode(':', $_COOKIE['remember']);
    $selector = mysqli_real_escape_string($conn, $selector);
    // Hash the validator for comparison with stored hash
    $hashed_validator = hash('sha256', hex2bin($validator));

    // Prepare query to get token data that hasn't expired
    $stmt = $conn->prepare("SELECT user_id, hashed_validator, expiry FROM user_tokens WHERE selector = ? AND expiry > NOW()");
    $stmt->bind_param("s", $selector);
    $stmt->execute();
    $stmt->bind_result($user_id, $db_hashed_validator, $expiry);
    
    // Verify the token hash matches and is valid
    if ($stmt->fetch() && hash_equals($db_hashed_validator, $hashed_validator)) {
        $stmt->close();

        // Get user data
        $qr = mysqli_query($conn, "SELECT * FROM users WHERE id = '$user_id'");
        $data = mysqli_fetch_assoc($qr);
        $role_id = $data['role'];
        
        // Get user role information
        $role_query = mysqli_query($conn, "SELECT role FROM roles WHERE id = '$role_id'");
        $role_data = mysqli_fetch_assoc($role_query);
        $data['role_name'] = $role_data['role'];
        
        // Set session variables
        $_SESSION['user_data'] = $data;
        $_SESSION['user_id'] = $data['id'];
        $_SESSION['role_name'] = $data['role_name'];

        // Generate new token for security (token rotation)
        $new_validator = random_bytes(32);
        $new_hashed_validator = hash('sha256', $new_validator);
        $new_expiry = date('Y-m-d H:i:s', strtotime('+30 days'));

        // Update the token in database
        $update_stmt = $conn->prepare("UPDATE user_tokens SET hashed_validator = ?, expiry = ? WHERE selector = ?");
        $update_stmt->bind_param("sss", $new_hashed_validator, $new_expiry, $selector);
        $update_stmt->execute();
        $update_stmt->close();

        // Set new remember-me cookie
        setcookie('remember', $selector.':'.bin2hex($new_validator), time() + (86400 * 30), "/", "", false, true);
    } else {
        // If token is invalid or expired, close statement and remove cookie
        $stmt->close();
        setcookie('remember', '', time() - 3600, "/");
    }
}
?>