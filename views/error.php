<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

    <title>FSTG - Connexion</title>

    <!-- Icon of FSTg -->
    <link rel="shortcut icon" href="https://ecampus-fst.uca.ma/pluginfile.php/1/theme_moove/favicon/1739555045/logo-universite-cadi-ayyad-marrakech-uca%20%281%29.ico">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&display=swap" rel="stylesheet">

    <!-- CSS Styles -->
    <link rel="stylesheet" href="../assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style-override.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="error-page">
    <div class="main-wrapper">
        <div class="error-box">
            <img src="../assets/img/error404.svg" style="height: 450px;" alt="logo of 404 page">
            <h3 class="h2 mb-3"><i class="fas fa-exclamation-triangle"></i> Oops! Page not found!</h3>
            <p class="h4 font-weight-normal">The page you requested was not found.</p>

            <a href="<?php
            if (isset($_SESSION['user_data'])) {
                switch ($_SESSION['user_data']['id_role']) {
                    case 1: // chef_dep
                        echo "/FSTg-Management-System/views/chef_dep/home.php";
                        break;
                    case 2: // coordinateur
                        echo "/FSTg-Management-System/views/coordinateur/home.php";
                        break;
                    case 3: // professeur
                        echo "/FSTg-Management-System/views/professeur/home.php";
                        break;
                    case 4: // étudiant
                        echo "/FSTg-Management-System/views/etudiant/home.php";
                        break;
                }
            }
            ?>" class="btn btn-primary">Back to Home</a>
        </div>
    </div>
    <!-- Script file -->
    <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>