<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

    <title>FSTG - Affectation d'un module</title>

    <!-- Icon of FSTg -->
    <link rel="shortcut icon" href="https://ecampus-fst.uca.ma/pluginfile.php/1/theme_moove/favicon/1739555045/logo-universite-cadi-ayyad-marrakech-uca%20%281%29.ico">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&display=swap"rel="stylesheet">

    <!-- Icons and Fonts -->
    <link rel="stylesheet" href="../../../assets/plugins/feather/feather.css">
    <link rel="stylesheet" href="../../../assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../../../assets/plugins/fontawesome/css/all.min.css">

    <!-- Plugin CSS -->
    <link rel="stylesheet" href="../../../assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="../../../assets/plugins/select2/css/select2.min.css">

    <!-- Core CSS -->
    <link rel="stylesheet" href="../../../assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../assets/css/style.css">
    <link rel="stylesheet" href="../../../assets/css/style-override.css">

    <!-- Toastr CSS for Notification -->
    <link rel="stylesheet" href="../../../assets/plugins/toastr/toastr.min.css">

    <!-- Custom style CSS -->
    <style>
        @keyframes fadeOut {
            0% { opacity: 1; }
            100% { opacity: 0; }
        }

        .student-submit .btn-primary:hover{
            background-color: #975E00 !important;
            border-color: #975E00 !important;
        }

        .text-center .btn-primary:hover{
            background-color: #975E00 !important;
            border-color: #975E00 !important;
        }
    </style>
</head>
<body>
<div class="main-wrapper">
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">Affecter un module à un professeur</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="../home.php">
                                        <?php
                                        if (isset($_SESSION['user_data']['genre'])) {
                                            echo ($_SESSION['user_data']['genre'] == 'male') ? "Coordinateur" : "Coordinatrice";
                                        }
                                        ?>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Affectation des modules</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card comman-shadow">
                        <div class="card-body">

                            <!-- form to affect a module to a professor -->
                            <form action="index.php?action=store" method="POST">
                                <input type="hidden" name="id_filiere" value="<?php if (isset($id_filiere)) { echo $id_filiere; } ?>">
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title student-info">Informations sur l'affectation <span><a href="#"><i class="feather-more-vertical"></i></a></span></h5>
                                    </div>
                                    <?php if (isset($modules) && !empty($modules)): ?>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>Nom du module <span class="login-danger">*</span></label>
                                                <select class="form-control select" name="module" required>
                                                        <?php foreach ($modules as $module): ?>
                                                            <option value="<?php echo $module['id']; ?>"><?php echo $module['nom']; ?></option>
                                                        <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>Enseignant <span class="login-danger">*</span></label>
                                                <select class="form-control select" name="enseignant" required>
                                                    <?php if (isset($enseignants)): ?>
                                                        <?php foreach ($enseignants as $enseignant): ?>
                                                            <option value="<?php echo $enseignant['id']; ?>"><?php echo $enseignant['nom'] . ' ' . $enseignant['prenom']; ?></option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="student-submit">
                                                <button type="submit" class="btn btn-primary">Affecter</button>
                                            </div>
                                        </div>
                                    <?php else : ?>
                                        <div class="col-12">
                                            <div class="alert alert-info d-flex align-items-center" role="alert">
                                                <i class="fas fa-info-circle me-2"></i>
                                                <div>
                                                    <strong>Tous les modules de la filière <?php if (isset($name_filiere)) { echo $name_filiere; } ?> sont déjà affectés.</strong> Il n'y a aucun module disponible à affecter à un professeur.
                                                </div>
                                            </div>
                                            <div class="text-center mt-3">
                                                <a href="index.php?action=list&id=<?php if (isset($id_filiere)) { echo $id_filiere; } ?>" class="btn btn-primary">
                                                    <i class="fas fa-arrow-left me-2"></i>Retour à la liste des affectations
                                                </a>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Includes the header and sidebar views for the page layout -->
<?php
include($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/views/header.php');
include($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/views/coordinateur/sidebar.php');
?>

<!-- jQuery script -->
<script src="../../../assets/js/jquery-3.6.0.min.js"></script>

<!-- Other plugins  -->
<script src="../../../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../../assets/plugins/select2/js/select2.min.js"></script>
<script src="../../../assets/plugins/moment/moment.min.js"></script>
<script src="../../../assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="../../../assets/js/calander.js"></script>

<!-- Toastr JS for Notification (depends on jQuery) -->
<script src="../../../assets/plugins/toastr/toastr.min.js"></script>

<!-- Standalone utilities -->
<script src="../../../assets/js/feather.min.js"></script>

<!-- Custom scripts -->
<script src="../../../assets/js/script.js"></script>
<script src="../../../assets/plugins/script.js"></script>

</body>
</html>
