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

    <!-- Custom style CSS -->
    <style>
        a {
            color: #C17900; !important;
        }

        a:hover{
            color: #C17900; !important;
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
                        <h3 class="page-title">Accédez à un module pour ajouter une pièce jointe</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="../home.php">
                                    <?php
                                    if (isset($_SESSION['user_data']['genre'])) {
                                        echo ($_SESSION['user_data']['genre'] == 'male') ? "Professeur" : "Professeure";
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
                <div class="col-sm-12" style="display:flex;justify-content:center;flex-direction:row;">
                    <?php if(isset($modules)): ?>
                        <?php foreach ($modules as $module): ?>
                            <div class="card flex-fill bg-white" style="width:fit-content;margin-left:10px">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Module : <?php echo $module['nom'] ?></h5>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">
                                        Filière : <?php echo $module['nom_filiere'] ?> <br>
                                        Semestre <?php echo $module['semestre'] ?>
                                    </p>
                                    <a class="btn btn-primary" href="/FSTg-Management-System/views/professeur/attachment_management/index.php?action=list&id=<?php echo $module['id']; ?>">Accéder</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/views/header.php');
include($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/views/professeur/sidebar.php');
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






