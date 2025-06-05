<?php
require($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/controllers/notification_controller.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .spinner-grow {
            position: absolute;
            top: 5%;
            left: 90%;
            transform: translate(-50%, 50%);
            height: 7px;
            width: 7px;
        }
        .user-img .user-text p.text-muted {
            color: #C17900 !important;
        }
        .user-menu .dropdown-menu .dropdown-item:hover {
            color: #C17900; !important;
        }
        .topnav-dropdown-header .clear-noti {
            color: #C17900; !important;
        }
        @media (min-width: 992px) {
            #toggle_btn {
                background: #C17900; !important;
            }
        }

        .menu-toggle #toggle_btn:hover {
            background-color: #975E00 !important;
            border-color: #975E00 !important;
        }

        .dropdown-menu .dropdown-item:active {
            background-color: #975E00 !important;
            border-color: #975E00 !important;
            color: white; !important;
        }
    </style>
</head>
<body>
    <div class="header">

        <!-- Logo and Menu Toggle -->
        <div class="header-left">
            <a href="#" class="logo">
                <img src="/FSTg-Management-System/assets/img/logo-FST.png" alt="Logo de FSTG" style="margin-left: 50px;transform:scale(2) ">
            </a>
            <a href="#" class="logo logo-small">
                <img src="/FSTg-Management-System/assets/img/logo-FST.png" alt="Logo de FSTG" style="transform:scale(2) ">
            </a>
        </div>
        <div class="menu-toggle">
            <a href="javascript:void(0);" id="toggle_btn">
                <i class="fas fa-bars"></i>
            </a>
        </div>

        <!-- Search Bar -->
        <div class="top-nav-search">
            <form>
                <input type="text" class="form-control" placeholder="Search here">
                <button class="btn" type="submit"><i class="fas fa-search"></i></button>
            </form>
        </div>
        <a class="mobile_btn" id="mobile_btn">
            <i class="fas fa-bars"></i>
        </a>

        <ul class="nav user-menu">

            <!-- Notification Dropdown -->
            <li class="nav-item dropdown noti-dropdown me-2">

                <?php if(isset($_SESSION['user_data']['id_role']) && $_SESSION['user_data']['id_role'] === 2): ?>
                    <?php if(isset($notifications) && !empty($notifications) && $notifications[0]['id_receiver'] == $_SESSION['user_data']['id']): ?>
                        <div class="spinner-grow text-success" role="status">
                            <span class="sr-only"></span>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

                <a href="#" class="dropdown-toggle nav-link header-nav-list" data-bs-toggle="dropdown">
                    <img src="/FSTg-Management-System/assets/img/icons/header-icon-05.svg" alt="">
                </a>

                <div class="dropdown-menu notifications">

                    <!-- Notification Header -->
                    <div class="topnav-dropdown-header">
                        <span class="notification-title" style="font-weight: bold;">Notifications</span>
                        <a href="javascript:void(0)" class="clear-noti" style="color: #dc3545"> Tout effacer </a>
                    </div>

                    <!-- Notification Content -->
                    <div class="noti-content">
                        <ul class="notification-list">
                            <?php if(isset($notifications) && !empty($notifications) && $notifications[0]['id_receiver'] == $_SESSION['user_data']['id']) : ?>
                                <?php foreach ($notifications as $notification): ?>
                                    <li class="notification-message">
                                        <a href="/FSTg-Management-System/views/coordinateur/affectation_module/index.php?action=affect&id=<?= $notification['id_filiere'] ?>">
                                            <div class="media d-flex">
                                                <div class="media-body">
                                                    <h6 class="action-title" style="color: #c17900;">Nouveau module à <?= $notification['nom_filiere'] ?></h6>
                                                    <p style="color: #4f5050">Mr. <b><?= $notification['nom_sender'] ?></b> a été ajouté un nouveau module à <b><?= $notification['nom_filiere'] ?></b>. Une affectation d'enseignant est requise.</p>
                                                    <p class="notification-time"><span><?= $notification['created_at'] ?></span></p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </div>

                    <!-- View All Notifications Footer -->
                    <div class="topnav-dropdown-footer">
                        <a href="#">Afficher toutes les notifications</a>
                    </div>

                </div>
            </li>

            <!-- Other menu items -->
            <li class="nav-item zoom-screen me-2">
                <a href="#" class="nav-link header-nav-list win-maximize">
                    <img src="/FSTg-Management-System/assets/img/icons/header-icon-04.svg" alt="">
                </a>
            </li>


            <li class="nav-item dropdown has-arrow new-user-menus">
                <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                    <span class="user-img">
                        <?php if(isset($_SESSION['user_data']['genre']) && $_SESSION['user_data']['genre'] === 'male'): ?>
                            <img class="rounded-circle" src="/FSTg-Management-System/assets/img/homme.png" alt="homme">
                        <?php elseif (isset($_SESSION['user_data']['genre']) && $_SESSION['user_data']['genre'] === 'female'): ?>
                            <img class="rounded-circle" src="/FSTg-Management-System/assets/img/femme.png" alt="femme">
                        <?php endif; ?>
                        <div class="user-text">
                            <h6><?php echo ucfirst($_SESSION['user_data']['nom']) . " " . ucfirst($_SESSION['user_data']['prenom']) ?></h6>
                            <p class="text-muted mb-0">
                                <?php
                                    if ($_SESSION['user_data']['id_role'] === 2) {
                                        echo ($_SESSION['user_data']['genre'] == 'male') ? "Coordinateur" : "Coordinatrice";
                                    } elseif ($_SESSION['user_data']['id_role'] === 3) {
                                        echo ($_SESSION['user_data']['genre'] == 'male') ? "Professeur" : "Professeure";
                                    }else {
                                        echo $_SESSION['role_name'];
                                    }
                                ?>
                            </p>
                        </div>
                    </span>
                </a>
                <div class="dropdown-menu">
                    <div class="user-header">
                        <div class="avatar avatar-sm">
                            <?php if(isset($_SESSION['user_data']['genre']) && $_SESSION['user_data']['genre'] === 'male'): ?>
                                <img class="rounded-circle" src="/FSTg-Management-System/assets/img/homme.png" alt="homme">
                            <?php elseif (isset($_SESSION['user_data']['genre']) && $_SESSION['user_data']['genre'] === 'female'): ?>
                                <img class="rounded-circle" src="/FSTg-Management-System/assets/img/femme.png" alt="femme">
                            <?php endif; ?>
                        </div>
                        <div class="user-text">
                            <h6><?php echo ucfirst($_SESSION['user_data']['nom']) . " " . ucfirst($_SESSION['user_data']['prenom']) ?></h6>
                            <p class="text-muted mb-0">
                                <?php
                                    if ($_SESSION['user_data']['id_role'] === 2) {
                                        echo ($_SESSION['user_data']['genre'] == 'male') ? "Coordinateur" : "Coordinatrice";
                                    } elseif ($_SESSION['user_data']['id_role'] === 3) {
                                        echo ($_SESSION['user_data']['genre'] == 'male') ? "Professeur" : "Professeure";
                                    }else {
                                        echo $_SESSION['role_name'];
                                    }
                                ?>
                            </p>
                        </div>
                    </div>
                    <a class="dropdown-item" href="#">Mon profil</a>
                    <a class="dropdown-item" href="#">Boîte de réception</a>
                    <a class="dropdown-item" href="/FSTg-Management-System/views/logout.php">Se déconnecter</a>
                </div>
            </li>
        </ul>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('toggle_btn');
            const logo = document.querySelector('.logo img');
            const logoSmall = document.querySelector('.logo-small img');

            toggleBtn.addEventListener('click', function() {
                // Toggle visibility of both logos
                if (logo) {
                    logo.style.display = logo.style.display === 'none' ? 'block' : 'none';
                }
                if (logoSmall) {
                    logoSmall.style.display = logoSmall.style.display === 'none' ? 'block' : 'none';
                }
            });
        });
    </script>
</body>
</html>