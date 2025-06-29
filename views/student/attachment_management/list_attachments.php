<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

    <title>FSTG - Liste des pièces jointes</title>

    <!-- Icon of FSTg -->
    <link rel="shortcut icon" href="https://ecampus-fst.uca.ma/pluginfile.php/1/theme_moove/favicon/1739555045/logo-universite-cadi-ayyad-marrakech-uca%20%281%29.ico">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&display=swap" rel="stylesheet">

    <!-- Icons and Fonts -->
    <link rel="stylesheet" href="../../../assets/plugins/feather/feather.css">
    <link rel="stylesheet" href="../../../assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../../../assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../../../assets/plugins/icons/flags/flags.css">

    <!-- Plugin CSS -->
    <link rel="stylesheet" href="../../../assets/plugins/datatables/datatables.min.css">

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

        .student-group-form .btn-primary:hover{
            background-color: #975E00 !important;
            border-color: #975E00 !important;
        }

        .download-grp .btn-outline-primary {
            background-color: #C17900; !important;
            border-color: #C17900; !important;
        }

        .download-grp .btn-outline-primary:hover, .download-grp .btn-primary:hover {
            background-color: #975E00 !important;
            border-color: #975E00 !important;
        }

        .actions {
            justify-content: start; !important;
        }

        .actions .btn-sm:hover {
            background-color: #C17900 !important;
            color: #FFFFFF !important;
        }
    </style>
</head>
<body>
<div class="main-wrapper">
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">Liste des pièces jointes</h3>
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
            </div>

            <div class="student-group-form">
                <div class="row">
                    <div class="col-lg-5 col-md-5">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Chercher par titre ...">
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-5">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Chercher par type ...">
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2">
                        <div class="search-student-btn">
                            <button type="btn" class="btn btn-primary">Chercher</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table comman-shadow">
                        <div class="card-body">

                            <div class="page-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h3 class="page-title">Pièces jointes du module : <?php if(!empty($module)) { echo $module['nom'];} ?></h3>
                                    </div>

                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                    <thead class="student-thread">
                                    <tr>
                                        <th>
                                            <div class="form-check check-tables">
                                                <input class="form-check-input" type="checkbox">
                                            </div>
                                        </th>
                                        <th>Titre</th>
                                        <th>Type</th>
                                        <th>Nom de fichier</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if (isset($attachments)): ?>
                                        <?php foreach($attachments as $attachment): ?>
                                            <tr>
                                                <td>
                                                    <div class="form-check check-tables">
                                                        <input class="form-check-input" type="checkbox" value="something">
                                                    </div>
                                                </td>
                                                <td><?php echo $attachment['title'] ?></td>
                                                <td><?php echo $attachment['type'] ?></td>
                                                <td><?php echo $attachment['filename'] ?></td>
                                                <td><?php echo $attachment['upload_date'] ?></td>
                                                <td>
                                                    <div class="actions">
                                                        <a href="/FSTg-Management-System/controllers/download_controller.php?action=attachment&id=<?php echo $attachment['id']; ?>" class="btn btn-sm bg-danger-light">
                                                            <i class="fa fa-download"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
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
include($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/views/student/sidebar.php');
?>

<!-- jQuery script -->
<script src="../../../assets/js/jquery-3.6.0.min.js"></script>

<!-- Other plugins -->
<script src="../../../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../../assets/plugins/datatables/datatables.min.js"></script>
<script src="../../../assets/plugins/moment/moment.min.js"></script>
<script src="../../../assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="../../../assets/js/feather.min.js"></script>
<script src="../../../assets/js/script.js"></script>

<!-- Toastr JS for Notification (depends on jQuery) -->
<script src="../../../assets/plugins/toastr/toastr.min.js"></script>

<!-- Custom scripts -->
<script src="../../../assets/plugins/script.js"></script>

</body>
</html>