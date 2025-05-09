<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<<<<<<< HEAD
    <title>FSTG - Modifier un module</title>
    
    <!-- Icon of FSTg -->
    <link rel="shortcut icon" href="https://ecampus-fst.uca.ma/pluginfile.php/1/theme_moove/favicon/1739555045/logo-universite-cadi-ayyad-marrakech-uca%20%281%29.ico">

    <!-- CSS Files -->
    <link rel="stylesheet" href="../../../assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../assets/plugins/feather/feather.css">
    <link rel="stylesheet" href="../../../assets/plugins/icons/flags/flags.css">
    <link rel="stylesheet" href="../../../assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../../../assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../../../assets/css/style.css">
    <link rel="stylesheet" href="../../../assets/plugins/toastr/toastr.min.css">
=======

    <title>FSTG - Modification d'un module</title>

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
    </style>
>>>>>>> db87a5ab0b87a555fe4f82d5cb1fd03e5de7b323
</head>
<body>
<div class="main-wrapper">
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
<<<<<<< HEAD
                <div class="row">
=======
                <div class="row align-items-center">
>>>>>>> db87a5ab0b87a555fe4f82d5cb1fd03e5de7b323
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">Modifier un module</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="../home.php">Chef de département</a></li>
<<<<<<< HEAD
                                <li class="breadcrumb-item"><a href="index.php?action=list">Modules</a></li>
                                <li class="breadcrumb-item active">Modifier</li>
=======
                                <li class="breadcrumb-item active">Modules</li>
>>>>>>> db87a5ab0b87a555fe4f82d5cb1fd03e5de7b323
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
<<<<<<< HEAD
                    <div class="card">
                        <div class="card-body">
                            <form action="index.php?action=update" method="POST">
                                <input type="hidden" name="id" value="<?php echo $module['id']; ?>">
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title"><span>Informations du module</span></h5>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label>Nom du module</label>
                                            <input type="text" class="form-control" name="nom" value="<?php echo htmlspecialchars($module['nom']); ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label>Semestre</label>
                                            <select class="form-control" name="semestre" required>
                                                <option value="1" <?php echo $module['semestre'] == '1' ? 'selected' : ''; ?>>1er semestre</option>
                                                <option value="2" <?php echo $module['semestre'] == '2' ? 'selected' : ''; ?>>2ème semestre</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label>Filière</label>
                                            <select class="form-control" name="id_filiere" required>
                                                <?php
                                                global $conn;
                                                $query = "SELECT id, nom, niveau FROM filiere WHERE id_dep = ?";
                                                $stmt = $conn->prepare($query);
                                                $stmt->execute([$_SESSION['user_data']['id_dep']]);
                                                $filieres = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                
                                                foreach($filieres as $filiere) {
                                                    $selected = ($filiere['id'] == $module['id_filiere']) ? 'selected' : '';
                                                    echo "<option value='{$filiere['id']}' {$selected}>{$filiere['nom']} - {$filiere['niveau']}ème année</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label>Professeur</label>
                                            <select class="form-control" name="id_teacher" required>
                                                <?php
                                                $query = "SELECT id, nom, prenom FROM user WHERE id_dep = ? AND id_role = 3";
                                                $stmt = $conn->prepare($query);
                                                $stmt->execute([$_SESSION['user_data']['id_dep']]);
                                                $teachers = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                
                                                foreach($teachers as $teacher) {
                                                    $selected = ($teacher['id'] == $module['id_teacher']) ? 'selected' : '';
                                                    echo "<option value='{$teacher['id']}' {$selected}>{$teacher['nom']} {$teacher['prenom']}</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Modifier</button>
                                        <a href="index.php?action=list" class="btn btn-secondary">Annuler</a>
                                    </div>
=======
                    <div class="card comman-shadow">
                        <div class="card-body">

                            <!-- form to add module -->
                            <form action="index.php?action=update" method="POST">
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title student-info">Informations du module <span><a href="#"><i class="feather-more-vertical"></i></a></span></h5>
                                    </div>
                                    <?php if(isset($module)) : ?>
                                        <input type="hidden" name="id" value="<?= $module['id'] ?>">
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>Nom <span class="login-danger">*</span></label>
                                                <input class="form-control" type="text" name="nom" value="<?= $module['nom'] ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>Filière <span class="login-danger">*</span></label>
                                                <select class="form-control" name="id_filiere" required>
                                                    <option value="">Sélectionnez une filière</option>
                                                    <?php
                                                    if (isset($filieres)):
                                                        $niveaux = [
                                                            1 => "1er année",
                                                            2 => "2ème année",
                                                            3 => "3ème année"
                                                        ];

                                                        foreach($filieres as $filiere): ?>
                                                            <option value="<?php echo $filiere['id'] ?>" <?= ($module['id_filiere'] == $filiere['id']) ? 'selected' : '' ?>>
                                                                <?php echo $filiere['nom'] . ' - ' . $niveaux[$filiere['niveau']] ?>
                                                            </option>
                                                        <?php endforeach;
                                                    endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>Semestre <span class="login-danger">*</span></label>
                                                <select class="form-control select" name="semestre" required>
                                                    <option value="1" <?= ($module['semestre'] == '1') ? 'selected' : '' ?>>Semestre 1</option>
                                                    <option value="2" <?= ($module['semestre'] == '2') ? 'selected' : '' ?>>Semestre 2</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="student-submit">
                                                <button type="submit" class="btn btn-primary">Modifier</button>
                                            </div>
                                        </div>
                                    <?php endif; ?>
>>>>>>> db87a5ab0b87a555fe4f82d5cb1fd03e5de7b323
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<<<<<<< HEAD

<!-- Includes the header and sidebar views -->
=======
<!-- Includes the header and sidebar views for the page layout -->
>>>>>>> db87a5ab0b87a555fe4f82d5cb1fd03e5de7b323
<?php
include($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/views/header.php');
include($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/views/chef_dep/sidebar.php');
?>

<<<<<<< HEAD
<!-- JS Files -->
<script src="../../../assets/js/jquery-3.6.0.min.js"></script>
<script src="../../../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../../assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="../../../assets/js/script.js"></script>
<script src="../../../assets/plugins/toastr/toastr.min.js"></script>

<script>
$(document).ready(function() {
    <?php if(isset($_SESSION['error'])): ?>
    toastr.error("<?php echo $_SESSION['error']; ?>", 'Erreur !');
    <?php unset($_SESSION['error']); ?>
    <?php endif; ?>
});
</script>

=======
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
        <?php endif; ?>
    });
</script>
>>>>>>> db87a5ab0b87a555fe4f82d5cb1fd03e5de7b323
</body>
</html>
