<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/auth/session.php');
?>

<!DOCTYPE html>
<html lang="en">

<script type="text/javascript">
    window.history.forward();
</script>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

    <title>FSTG - Connexion</title>

    <!-- Icon of FSTg -->
    <link rel="shortcut icon" href="https://ecampus-fst.uca.ma/pluginfile.php/1/theme_moove/favicon/1739555045/logo-universite-cadi-ayyad-marrakech-uca%20%281%29.ico">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&display=swap" rel="stylesheet">

    <!-- CSS Styles -->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/plugins/feather/feather.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/style-override.css">

    <!-- Custom style CSS -->
    <style>
        .form-group .btn-primary:hover{
            background-color: #975E00 !important;
            border-color: #975E00 !important;
        }
    </style>
</head>

<body>

    <div class="main-wrapper login-body">

        <div class="login-wrapper">

            <!-- Container that have the main page -->
            <div class="container">

                <div class="loginbox" style="height: 550px;">
                    <div class="login-left">
                        <img class="img-fluid" style="height: 550px;" src="assets/img/login.jpg" alt="image of login">
                    </div>
                    <div class="login-right">
                        <div class="login-right-wrap">
                            <img src="assets/img/logo-FST.png" style="height: 150px; display: block; margin: 0 auto;" alt="logo of FSTG">
                            <h1>Bienvenue sur FSTG Notes</h1>
                            <p class="account-subtitle">Besoin d'un compte ? <a href="views/error.php">Inscrivez-vous</a></p>
                            <h2>Connectez-vous</h2>

                            <!-- Form to submit -->
                            <form action="controllers/login_controller.php" method="POST">

                                <?php if (isset($_SESSION['error'])) { ?>
                                    <div class="form-group">
                                        <span class="alert alert-danger" style="display: block; width: 100%; padding: .375rem .75rem; font-size: 1rem; line-height: 1.5; color: #495057; background-color: #f8d7da; border: 1px solid #f5c6cb; border-radius: .25rem;" role="alert">
                                            <i class="fas fa-exclamation-triangle"></i>
                                            <?php foreach ($_SESSION['error'] as $error) {
                                                echo $error;
                                            }
                                            unset($_SESSION['error']);  ?>
                                        </span>
                                    </div>
                                <?php } ?>


                                <?php if (isset($_GET['error'])) { ?>
                                    <div class="form-group">
                                        <span class="alert alert-danger" style="display: block; width: 100%; padding: .375rem .75rem; font-size: 1rem; line-height: 1.5; color: #495057; background-color: #f8d7da; border: 1px solid #f5c6cb; border-radius: .25rem;" role="alert">
                                            <i class="fas fa-exclamation-triangle"></i>
                                            <?php echo $_GET['error']; ?>
                                        </span>
                                    </div>
                                <?php } ?>

                                <!-- input of email -->
                                <div class="form-group">
                                    <label for="email-form">Email Académique <span class="login-danger">*</span></label>
                                    <input class="form-control" id="email-form" type="email" name="email" required>
                                    <span class="profile-views"><i class="fas fa-user-circle"></i></span>
                                </div>
                                <!-- input of password (password of all users is : fstg) -->
                                <div class="form-group">
                                    <label for="password-form">Mot de passe <span class="login-danger">*</span></label>
                                    <input class="form-control pass-input" id="password-form" type="password" name="password" required>
                                    <span class="profile-views feather-eye toggle-password"></span>
                                </div>
                                <div class="forgotpass">
                                    <div class="remember-me">
                                        <label class="custom_check mr-2 mb-0 d-inline-flex remember-me">
                                            Rester connecté
                                            <input type="checkbox" name="remember" value="checked">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <a href="views/error.php">Mot de passe oublié ?</a>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-block" type="submit">Se connecter</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script files -->
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/feather.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>