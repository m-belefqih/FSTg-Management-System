<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/auth/session.php');

if (isset($_SESSION['user_data']) && $_SESSION['user_data']['id_role'] == 1) { ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

    <title>Tableau de bord</title>

    <!-- Icon of FSTg -->
    <link rel="shortcut icon" href="https://ecampus-fst.uca.ma/pluginfile.php/1/theme_moove/favicon/1739555045/logo-universite-cadi-ayyad-marrakech-uca%20%281%29.ico">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&display=swap" rel="stylesheet">

    <!-- CSS Styles -->
    <link rel="stylesheet" href="../../assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/plugins/feather/feather.css">
    <link rel="stylesheet" href="../../assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../../assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/style-override.css">
</head>

<body>

    <div class="main-wrapper">
        <?php
            include($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/views/header.php');
            include($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/views/chef_dep/content.php');
            include($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/views/chef_dep/sidebar.php');
        ?>
    </div>

    <!-- script files -->
    <script src="../../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../../assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="../../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/feather.min.js"></script>
    <script src="../../assets/js/circle-progress.min.js"></script>
    <script src="../../assets/plugins/apexchart/student-chart.js"></script>
    <script src="../../assets/plugins/apexchart/apexcharts.min.js"></script>
    <script src="../../assets/plugins/simple-calendar/jquery.simple-calendar.js"></script>
    <script src="../../assets/js/calander.js"></script>
    <script src="../../assets/js/script.js"></script>
    <script src="../../assets/plugins/script.js"></script>

    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>

</body>

<?php
} else {
    header("Location: /FSTg-Management-System/index.php?error=Accès non autorisé");
    exit();
}
?>