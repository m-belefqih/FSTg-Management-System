<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

    <title>FSTG - Modification d'un étudiant</title>

    <!-- Icon of FSTg -->
    <link rel="shortcut icon" href="https://ecampus-fst.uca.ma/pluginfile.php/1/theme_moove/favicon/1739555045/logo-universite-cadi-ayyad-marrakech-uca%20%281%29.ico">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&display=swap" rel="stylesheet">

    <!-- Icons and Fonts -->
    <link rel="stylesheet" href="../../../assets/plugins/feather/feather.css">
    <link rel="stylesheet" href="../../../assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../../../assets/plugins/fontawesome/css/all.min.css">

    <!-- Plugin CSS -->
    <link rel="stylesheet" href="../../../assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="../../../assets/plugins/select2/css/select2.min.css">

    <!-- Core CSS -->
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
                            <h3 class="page-title">Modifier l'étudiant</h3>
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
                                <li class="breadcrumb-item active">Étudiants</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card comman-shadow">
                        <div class="card-body">

                            <!-- Form to edit student information -->
                            <form action="index.php?action=update" method="POST">
                                <input type="hidden" name="id_filiere" value="<?php if (isset($id_filiere)) { echo $id_filiere; } ?>">
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title student-info">Informations sur l'étudiant <span><a href="#"><i class="feather-more-vertical"></i></a></span></h5>
                                    </div>
                                    <?php if(isset($user)) : ?>
                                        <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>Prénom <span class="login-danger">*</span></label>
                                                <input class="form-control" type="text" name="prenom" value="<?= $user['prenom'] ?>" required >
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>Nom <span class="login-danger">*</span></label>
                                                <input class="form-control" type="text" name="nom" value="<?= $user['nom'] ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>Genre <span class="login-danger">*</span></label>
                                                <select class="form-control select" name="genre" required>
                                                    <option value="male" <?= ($user['genre'] == 'male') ? 'selected' : '' ?>>Masculin</option>
                                                    <option value="female" <?= ($user['genre'] == 'female') ? 'selected' : '' ?>>Féminin</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms calendar-icon">
                                                <label>Date de naissance <span class="login-danger">*</span></label>
                                                <input class="form-control datetimepicker" type="text" name="dateNaissance" value="<?= isset($user['dateNaissance']) ? (new DateTime($user['dateNaissance']))->format('d-m-Y') : '' ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>CNE <span class="login-danger">*</span></label>
                                                <input class="form-control" type="text" name="CNE" value="<?= $user['CNE'] ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>CIN <span class="login-danger">*</span></label>
                                                <input class="form-control" type="text" name="CIN" value="<?= $user['CIN'] ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>Email Académique <span class="login-danger">*</span></label>
                                                <input class="form-control" type="email" name="email" value="<?= $user['email'] ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>Numéro de téléphone <span class="login-danger">*</span></label>
                                                <input class="form-control" type="text" name="phone" value="<?= $user['phone'] ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="student-submit">
                                                <button type="submit" class="btn btn-primary">Modifier</button>
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

<!-- Toastr JS for Notification (depends on jQuery) -->
<script src="../../../assets/plugins/toastr/toastr.min.js"></script>

<!-- Standalone utilities -->
<script src="../../../assets/js/feather.min.js"></script>

<!-- Custom scripts -->
<script src="../../../assets/js/script.js"></script>
<script src="../../../assets/js/calander.js"></script>
<script src="../../../assets/plugins/script.js"></script>

<!-- Toastr JS configuration and notifications -->
<script>
    $(document).ready(function() {
        // Configuration de Toastr (optionnel)
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        <?php if(isset($_SESSION['error']) && isset($_SESSION['messageEmail'])): ?>
        toastr.error("<?php echo $_SESSION['error']; ?>", "<?php echo $_SESSION['messageEmail']; ?>");
        <?php unset($_SESSION['error']); ?>
        <?php unset($_SESSION['messageEmail']); ?>
        <?php endif; ?>
    });
</script>
</body>
</html>

