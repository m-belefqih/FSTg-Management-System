<?php
session_start();
require($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/auth/session.php');

if(!isset($_SESSION['user_data'])) {
    header("Location: /FSTg-Management-System/index.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Je suis un étudiant</h1>

    <p>Mon id : <?php echo $_SESSION['user_data']['id'] ?> </p>
    <p>Mon nom : <?php echo $_SESSION['user_data']['nom'] ?> </p>
    <p>Mon prenom : <?php echo $_SESSION['user_data']['prenom'] ?> </p>
    <p>Mon CIN : <?php echo $_SESSION['user_data']['CIN'] ?> </p>
    <p>Mon role : <?php echo $_SESSION['user_data']['id_role'] ?> </p>
    <p>Mon département : <?php echo $_SESSION['user_data']['id_dep'] ?> </p>
    <p>Mon filiere : <?php echo $_SESSION['user_data']['id_filiere'] ?> </p>
    <p>Le nom de rôle : <?php echo $_SESSION['role_name'] ?></p>
    <a href="../../logout.php">Se déconnecter</a>
</body>
</html>