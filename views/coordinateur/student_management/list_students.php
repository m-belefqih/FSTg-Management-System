<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

    <title>FSTG - Liste des étudiants</title>

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

    <!-- sweetalert2 CSS -->
    <link rel="stylesheet" href="../../../assets/plugins/sweetalert2/sweetalert2.min.css">

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
                            <h3 class="page-title">Liste des étudiants</h3>
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

            <div class="student-group-form">
                <div class="row">
                    <div class="col-lg-5 col-md-5">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Chercher par Nom ...">
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-5">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Chercher par filière ...">
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
                                        <h3 class="page-title"> Étudiants de la filière <?php if(!empty($students)) { echo $students[0]['nom_filiere'];} ?></h3>
                                    </div>
                                    <div class="col-auto text-end float-end ms-auto download-grp">
                                        <a href="#" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i> Télécharger</a>
                                        <a href="index.php?action=create&id=<?php if(!empty($students)) { echo $students[0]['id_filiere'];} ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Ajouter un étudiant</a>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                    <thead class="student-thread">
                                    <tr>
                                        <th>
                                            <div class="form-check check-tables">
                                                <input class="form-check-input" type="checkbox" value="something">
                                            </div>
                                        </th>
                                        <th>Nom complet</th>
                                        <th>Genre</th>
                                        <th>Date de naissance</th>
                                        <th>CIN</th>
                                        <th>CNE</th>
                                        <th>Email académique</th>
                                        <th>Téléphone</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if (isset($students)): ?>
                                        <?php foreach($students as $student): ?>
                                            <tr>
                                                <td>
                                                    <div class="form-check check-tables">
                                                        <input class="form-check-input" type="checkbox" value="something">
                                                    </div>
                                                </td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="#" class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="/FSTg-Management-System/assets/img/femme.png" alt="User Image"></a>

                                                        <a href="#"><?php echo ucfirst($student['nom'])." ".ucfirst($student['prenom']) ?></a>
                                                    </h2>
                                                </td>
                                                <td>
                                                    <?php echo ($student['genre'] == 'male') ? 'Masuclin' : 'Féminin'; ?>
                                                </td>
                                                <td><?php echo $student['dateNaissance'] ?></td>
                                                <td><?php echo $student['CIN'] ?></td>
                                                <td><?php echo $student['CNE'] ?></td>
                                                <td><?php echo $student['email'] ?></td>
                                                <td><?php echo $student['phone'] ?></td>
                                                <td class="text-end">
                                                    <div class="actions ">
                                                        <a href="index.php?action=edit&idFiliere=<?php if(!empty($students)) { echo $students[0]['id_filiere'];} ?>&id=<?php echo $student['id']; ?>" class="btn btn-sm bg-danger-light">
                                                            <i class="fa fa-edit"></i>
                                                        </a>

                                                        <a href="javascript:void(0);" onclick="confirmDelete(<?php echo $students[0]['id_filiere'] ?>, <?php echo $student['id']; ?>, '<?php echo addslashes($student['nom']); ?>')" class="btn btn-sm bg-danger-light">
                                                            <i class="fa fa-trash"></i>
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
include($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/views/coordinateur/sidebar.php');
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

<!-- sweetalert2 JS -->
<script src="../../../assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>

<!-- Custom scripts -->
<script src="../../../assets/plugins/script.js"></script>

<!-- sweetalert2 and Toastr configuration for notifications -->
<script>
    function confirmDelete(idFiliere, id, moduleName) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-danger m-2',
                cancelButton: 'btn btn-secondary m-2'
            },
            buttonsStyling: false
        });

        swalWithBootstrapButtons.fire({
            title: 'Êtes-vous sûr ?',
            text: `Vous êtes sur le point de supprimer le module ${moduleName}. Cette action est irréversible !`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Supprimer',
            cancelButtonText: 'Annuler',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `index.php?action=delete&idFiliere=${idFiliere}&id=${id}`;
            }
        });
    }

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


        <?php if(isset($_SESSION['success'])): ?>
        toastr.success("<?php echo $_SESSION['success']; ?>", 'Succès !');
        <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <?php if(isset($_SESSION['error'])): ?>
        toastr.error("<?php echo $_SESSION['error']; ?>", 'Réssayer !');
        <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

    });

</script>
</body>
</html>