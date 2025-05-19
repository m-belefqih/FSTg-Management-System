<?php
// This controller is linking user.php model & index.php view

session_start();

require($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/auth/session.php');
require($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/models/user.php');

// Function to set user session
function setUserSession($userData, $roleData): void
{
    $_SESSION['user_data'] = $userData; // userData is an associative array
    $_SESSION['role_name'] = $roleData['nom']; // roleData is an associative array
}

// Function to redirect based on a role
function redirectUser($role): void
{
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

    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); // Get email and filter it

    $password = $_POST['password']; // get password
    
    $userData = validateLoginCredentials($email, $password); // userData is an associative array

    // Log user information
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
        date('Y-m-d H:i:s') . " - Information of user : " . json_encode($userData) . "\n",
        FILE_APPEND
    );

    // Check if user data is valid
    if ($userData) {
        // Get role information
        $roleData = getRoleById($userData['id_role']); // roleData is an associative array
        
        // Set session data
        setUserSession($userData, $roleData);

        // Handle remember me functionality
        if (isset($_POST['remember']) && $_POST['remember'] === 'checked') {
            handleRememberMe($userData['id']);
        }

        // Redirect user based on role
        redirectUser($userData['id_role']);

    } else {
        $_SESSION['error'][] = "Email ou mot de passe incorrect";
        header("Location: /FSTg-Management-System/index.php");
        exit();
    }
}