<link rel="stylesheet" href="../../assets/plugins/simple-calendar/simple-calendar.css">

<style>
    .normal-bg::before {
        background: #c17900; !important;
    }
</style>

<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-sub-header">
                        <h3 class="page-title">
                            Bienvenue <?php if(isset($_SESSION['user_data']['genre'])) echo ($_SESSION['user_data']['genre'] == 'male') ? "Mr. " : "Mme. ";
                            echo ucfirst($_SESSION['user_data']['nom']) ?> !
                        </h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="home.php">
                                    <?php
                                        if (isset($_SESSION['user_data']['genre'])) {
                                            echo ($_SESSION['user_data']['genre'] == 'male') ? "Coordinateur" : "Coordinatrice";
                                        }
                                    ?>
                                </a>
                            </li>
                            <li class="breadcrumb-item active">Accueil</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="card bg-comman w-100">
                    <div class="card-body">
                        <div class="db-widgets d-flex justify-content-between align-items-center">
                            <div class="db-info">
                                <h6>Total Modules</h6>
                                <h3 class="num" data-value="16">00</h3>
                            </div>
                            <div class="db-icon">
                                <img src="../../assets/img/icons/courses.svg" width="60" height="60">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="card bg-comman w-100">
                    <div class="card-body">
                        <div class="db-widgets d-flex justify-content-between align-items-center">
                            <div class="db-info">
                                <h6>Total Étudiants</h6>
                                <h3 class="num" data-value="80">000</h3>
                            </div>
                            <div class="db-icon">
                                <img src="../../assets/img/icons/student.svg" width="80" height="80">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="card bg-comman w-100">
                    <div class="card-body">
                        <div class="db-widgets d-flex justify-content-between align-items-center">
                            <div class="db-info">
                                <h6>Total Enseignants</h6>
                                <h3 class="num" data-value="10">00</h3>
                            </div>
                            <div class="db-icon">
                                <img src="../../assets/img/icons/teacher.svg" width="80" height="80">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="card bg-comman w-100">
                    <div class="card-body">
                        <div class="db-widgets d-flex justify-content-between align-items-center">
                            <div class="db-info">
                                <h6>Notes Ajoutées</h6>
                                <h3 class="num" data-value="14">0</h3>
                            </div>
                            <div class="db-icon">
                                <img src="../../assets/img/icons/grades.svg" width="80" height="80">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-12 col-xl-8">
                <div class="row">
                    <div class="col-12 col-lg-12 col-xl-12 d-flex">
                        <div class="card flex-fill comman-shadow">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <h5 class="card-title">Activité d'Enseignement</h5>
                                    </div>
                                    <div class="col-6">
                                        <ul class="chart-list-out">
                                            <li><span class="circle-green"></span>Étudiants</li>
                                            <li class="star-menus"><a href="javascript:"><i class="fas fa-ellipsis-v"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="school-area"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-12 col-xl-4 d-flex">
                <div class="card flex-fill comman-shadow">
                    <div class="card-body">
                        <div id="calendar-doctor" class="calendar-container"></div>
                        <div class="calendar-info calendar-info1">
                            <div class="up-come-header">
                                <h2>Événements à venir</h2>
                                <span><a href="javascript:"><i class="feather-plus"></i></a></span>
                            </div>
                            <div class="upcome-event-date">
                                <h3>10 Jan</h3>
                                <span><i class="fas fa-ellipsis-h"></i></span>
                            </div>
                            <div class="calendar-details">
                                <p>08:00</p>
                                <div class="calendar-box normal-bg">
                                    <div class="calandar-event-name">
                                        <h4>Leçon de Cours : Réseaux 1</h4>
                                        <h5>Filière : IRISI1 & SIT1</h5>
                                    </div>
                                    <span>08:00 - 09:00</span>
                                </div>
                            </div>
                            <div class="calendar-details">
                                <p>09:00</p>
                                <div class="calendar-box normal-bg">
                                    <div class="calandar-event-name">
                                        <h4>Leçon de TD : Réseaux 1</h4>
                                        <h5>Filière : IRISI1 & SIT1</h5>
                                    </div>
                                    <span>09:00 - 10:00</span>
                                </div>
                            </div>
                            <div class="calendar-details">
                                <p>10:00</p>
                                <div class="calendar-box normal-bg">
                                    <div class="calandar-event-name">
                                        <h4>Conférence sur le CyberSécurité</h4>
                                        <h5>Tous les filières</h5>
                                    </div>
                                    <span>10:00 - 11:00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <footer>
            <p>Copyright © 2025 BELEFIQH Mohammed.</p>
        </footer>
    </div>
</div>