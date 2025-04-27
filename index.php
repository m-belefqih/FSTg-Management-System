<?php
// include($_SERVER['DOCUMENT_ROOT'] . '/ENSAHify/views/auth/session.php');
?>

<!DOCTYPE html>
<html lang="en">

<script type="text/javascript"> window.history.forward();</script>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

    <title>FSTG - Login</title>
    <!-- CSS Styles -->
    <link rel="shortcut icon" href="assets/img/favicon.png">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/plugins/feather/feather.css">
    <link rel="stylesheet" href="assets/plugins/icons/flags/flags.css">
    <link rel="stylesheet" href="plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style-override.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- scripts files -->
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/feather.min.js"></script>
    <script src="assets/js/script.js"></script>
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
                            <p class="account-subtitle">Besoin d'un compte ? <a href="registration.php">Inscrivez-vous</a></p>
                            <h2>Connectez-vous</h2>
                            
                            <!-- Form to submit -->
                            <form action="views/auth/login.php" method="post">
                                <?php if(isset($_SESSION['error'])) { ?>
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
                                <div class="form-group">
                                    <label>Email académique <span class="login-danger">*</span></label>
                                    <input class="form-control" type="email" name="email" required>
                                    <span class="profile-views"><i class="fas fa-user-circle"></i></span>
                                </div>
                                <div class="form-group">
                                    <label>Mot de passe <span class="login-danger">*</span></label>
                                    <input class="form-control pass-input" type="password" name="password" required>
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
                                    <a href="forgot-password.html">Mot de passe oublié ?</a>
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


    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/feather.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>