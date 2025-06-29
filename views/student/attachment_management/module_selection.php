<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

    <title>FSTG - Choix de module </title>

    <!-- Icon of FSTg -->
    <link rel="shortcut icon" href="https://ecampus-fst.uca.ma/pluginfile.php/1/theme_moove/favicon/1739555045/logo-universite-cadi-ayyad-marrakech-uca%20%281%29.ico">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&display=swap" rel="stylesheet">

    <!-- Icons and Fonts -->
    <link rel="stylesheet" href="../../../assets/plugins/feather/feather.css">
    <link rel="stylesheet" href="../../../assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../../../assets/plugins/fontawesome/css/all.min.css">

    <!-- Core CSS -->
    <link rel="stylesheet" href="../../../assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../assets/css/style.css">
    <link rel="stylesheet" href="../../../assets/css/style-override.css">
    <link rel="stylesheet" href="../../../assets/css/cards.css">

    <!-- Custom style CSS -->
    <style>
        a {
            color: #C17900; !important;
        }

        a:hover{
            color: #C17900; !important;
        }

        .card {
            transition: transform 0.3s ease-in-out;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }


        .card a {
            color: white !important;
        }

        .card a:hover {
            color: rgba(255, 255, 255, 0.8) !important;
        }

        body {
            background-color: #f7f7fa !important;
        }

        .main-wrapper {
            background-color: #f7f7fa !important;
        }

        .page-wrapper {
            background-color: #f7f7fa !important;
        }

        .content.container-fluid {
            background-color: #f7f7fa !important;
        }

        .card-body {
            padding: 1.5rem;
        }

        .page-header {
            background-color: #f7f7fa !important;
        }

        .breadcrumb {
            background-color: transparent !important;
        }

    </style>

</head>
<body>
<div class="main-wrapper">
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row">
                    <div class="col">
                        <h3 class="page-title">Vue l’ensemble des Cours, TD et TP de la filière <?php if(isset($modules)){ echo $modules[0]['nom_filiere'] ;} ?></h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="../home.php">
                                    <?php
                                    if (isset($_SESSION['user_data']['genre'])) {
                                        echo ($_SESSION['user_data']['genre'] == 'male') ? "Étudiant" : "Étudiante";
                                    }
                                    ?>
                                </a>
                            </li>
                            <li class="breadcrumb-item active">Cours</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="row justify-content-start">
                        <?php if(isset($modules)) : ?>
                            <?php foreach($modules as $module) : ?>
                                <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
                                    <div class="card" style="border-radius: 15px; overflow: hidden;">
                                        <div class="card-body" style="background: linear-gradient(45deg, #C17900, #975E00);">
                                            <a href="index.php?action=list&id=<?php echo htmlspecialchars($module['id']); ?>"
                                               class="text-decoration-none">
                                                <h5 class="card-title text-white mb-3">
                                                    <?php echo htmlspecialchars($module['nom']); ?>
                                                </h5>
                                                <p class="card-text text-white-50">
                                                    Semestre <?php echo htmlspecialchars($module['semestre']); ?>
                                                </p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/views/header.php');
include($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/views/student/sidebar.php');
?>

<script src="../../../assets/js/jquery-3.6.0.min.js"></script>
<script src="../../../assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="../../../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../../assets/js/feather.min.js"></script>
<script src="../../../assets/plugins/apexchart/apexcharts.min.js"></script>
<script src="../../../assets/plugins/apexchart/chart-dat.js"></script>
<script src="../../../assets/js/moment.min.js"></script>
<script src="../../../assets/js/jquery-ui.min.js"></script>
<script src="../../../assets/js/script.js"></script>

</body>
</html>






