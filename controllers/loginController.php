<?php
session_start();

require($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/config/DB_connection.php');
require($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/auth/session.php');

// Function to validate login credentials
function validateLoginCredentials($email, $password, $conn) {
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);
    
    $query = "SELECT * FROM users WHERE email = '$email' AND password = '" . md5($password) . "'";
    return mysqli_query($conn, $query);
}

// Function to set user session
function setUserSession($userData, $roleData): void
{
    $_SESSION['user_data'] = $userData;
    $_SESSION['dep_id'] = $userData['id_dep'];
    $_SESSION['fil_nom'] = $userData['nom_filiere'];
    $_SESSION['user_id'] = $userData['id'];
    $_SESSION['niveau'] = $userData['niveau'];
    $_SESSION['cne'] = $userData['CNE'];
    $_SESSION['role_name'] = $roleData['role']; // roleData is an associative array
}

// Function to handle remember me functionality
function handleRememberMe($userId, $conn) {
    $selector = bin2hex(random_bytes(12));
    $validator = random_bytes(32);
    $hashedValidator = hash('sha256', $validator);
    $expiry = date('Y-m-d H:i:s', strtotime('+30 days'));

    $stmt = $conn->prepare("INSERT INTO user_tokens (selector, hashed_validator, user_id, expiry) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $selector, $hashedValidator, $userId, $expiry);
    $stmt->execute();
    $stmt->close();

    setcookie('remember', $selector.':'.bin2hex($validator), time() + (86400 * 30), "/", "", false, true);
}

// Function to redirect based on role
function redirectUser($role) {
    $baseUrl = "/FSTg-Management-System/views/";
    $redirectPaths = [
        1 => "chef_dep/home.php",
        2 => "coordinateur/home.php",
        3 => "professeur/home.php",
        4 => "student/home.php"
    ];

    if (isset($redirectPaths[$role])) {
        header("Location: " . $baseUrl . $redirectPaths[$role]);
        exit();
    }
}

// Main login 
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); // Récupérer et filtrer l'email 

    $password = $_POST['password']; // Récupérer le mot de passe
    
    $loginResult = validateLoginCredentials($email, $password, $conn);

    if (mysqli_num_rows($loginResult) > 0) {
        $userData = mysqli_fetch_assoc($loginResult); // userData is an associative array
        
        // Get role information
        $roleQuery = mysqli_query($conn, "SELECT role FROM roles WHERE id = '{$userData['role']}'");
        $roleData = mysqli_fetch_assoc($roleQuery); // roleData is an associative array
        
        // Set session data
        setUserSession($userData, $roleData);

        // Handle remember me functionality
        if (isset($_POST['remember']) && $_POST['remember'] === 'checked') {
            handleRememberMe($userData['id'], $conn);
        }

        // Redirect user based on role
        redirectUser($userData['role']);
    } else {
        $_SESSION['error'][] = "Invalid login details";
        header("Location: /FSTg-Management-System/index.php");
        exit();
    }
}
?>