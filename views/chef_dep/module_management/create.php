<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>FSTG - Ajouter un module</title>
    
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
</head>
<body>
<div class="main-wrapper">
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">Ajouter un module</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="../home.php">Chef de département</a></li>
                                <li class="breadcrumb-item"><a href="index.php?action=list">Modules</a></li>
                                <li class="breadcrumb-item active">Ajouter</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="index.php?action=store" method="POST">
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title"><span>Informations du module</span></h5>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label>Nom du module</label>
                                            <input type="text" class="form-control" name="nom" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label>Semestre</label>
                                            <select class="form-control" name="semestre" required>
                                                <option value="">Sélectionnez un semestre</option>
                                                <option value="1">1er semestre</option>
                                                <option value="2">2ème semestre</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label>Filière</label>
                                            <select class="form-control" name="id_filiere" required>
                                                <option value="">Sélectionnez une filière</option>
                                                <?php
                                                global $conn;
                                                $query = "SELECT id, nom, niveau FROM filiere WHERE id_dep = ?";
                                                $stmt = $conn->prepare($query);
                                                $stmt->execute([$_SESSION['user_data']['id_dep']]);
                                                $filieres = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                
                                                foreach($filieres as $filiere) {
                                                    echo "<option value='{$filiere['id']}'>{$filiere['nom']} - {$filiere['niveau']}ème année</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label>Professeur</label>
                                            <select class="form-control" name="id_teacher" required>
                                                <option value="">Sélectionnez un professeur</option>
                                                <?php
                                                $query = "SELECT id, nom, prenom FROM user WHERE id_dep = ? AND id_role = 3";
                                                $stmt = $conn->prepare($query);
                                                $stmt->execute([$_SESSION['user_data']['id_dep']]);
                                                $teachers = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                
                                                foreach($teachers as $teacher) {
                                                    echo "<option value='{$teacher['id']}'>{$teacher['nom']} {$teacher['prenom']}</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Ajouter</button>
                                        <a href="index.php?action=list" class="btn btn-secondary">Annuler</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Includes the header and sidebar views -->
<?php
include($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/views/header.php');
include($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/views/chef_dep/sidebar.php');
?>

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

</body>
</html>
