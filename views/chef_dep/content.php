<link rel="stylesheet" href="../../assets/plugins/simple-calendar/simple-calendar.css">

<style>
    .lesson .lesson-confirm a {
        color: #c17900; !important;
    }

    a {
        color: #c17900; !important;
    }

    a:hover {
        color: #975E00 !important;
    }

    .normal-bg::before {
        background: #c17900; !important;
    }

    .activity-btns .btn-info {
        background: #c17900; !important;
        border: 1px solid #c17900; !important;
        border-color: #c17900; !important;
        color: #fff !important;
    }

    .activity-btns .btn-info:hover {
        background-color: #975E00 !important;
        border-color: #975E00 !important;
        border: 1px solid #c17900; !important;
    }

    .lesson .btn-info {
        background: #c17900; !important;
        border: 1px solid #c17900; !important;
        border-color: #c17900; !important;
    }

    .lesson .btn-info:hover {
        background-color: #975E00 !important;
        border-color: #975E00 !important;
        border: 1px solid #c17900; !important;
    }

    .calendar .day.today {
        background: #c17900; !important;
        color: #fff;
    }

    .steps-history li {
        color: #c17900; !important;
    }

    .activity-feed .feed-item::before {
        background-color: #c17900; !important;
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
                            <li class="breadcrumb-item"><a href="home.php">Chef de département</a></li>
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
                                <h3 class="num" data-value="52">00</h3>
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
                                <h3 class="num" data-value="132">000</h3>
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
                                <h3 class="num" data-value="52">00</h3>
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
                    <div class="col-12 col-lg-8 col-xl-8 d-flex">
                        <div class="card flex-fill comman-shadow">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <h5 class="card-title">Cours à venir</h5>
                                    </div>
                                    <div class="col-6">
                                        <span class="float-end view-link"><a href="#">Voir tous les cours</a></span>
                                    </div>
                                </div>
                            </div>
                            <div class="pt-3 pb-3">
                                <div class="table-responsive lesson">
                                    <table class="table table-center">
                                        <tbody>
                                        <tr>
                                            <td>
                                                <div class="date">
                                                    <b>Programmation Orienté Objet Java</b>
                                                    <p>Chapitre 3</p>
                                                    <ul class="teacher-date-list">
                                                        <li><i class="fas fa-calendar-alt me-2"></i>5 Juin, 2024</li>
                                                        <li>|</li>
                                                        <li><i class="fas fa-clock me-2"></i>08:30 - 10:30</li>
                                                    </ul>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="lesson-confirm">
                                                    <a href="#">Confirmé</a>
                                                </div>
                                                <button type="submit" class="btn btn-info">Reprogrammer</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="date">
                                                    <b>Machine Learning</b>
                                                    <p>Chapitre 4</p>
                                                    <ul class="teacher-date-list">
                                                        <li><i class="fas fa-calendar-alt me-2"></i>6 Juin, 2024</li>
                                                        <li>|</li>
                                                        <li><i class="fas fa-clock me-2"></i>10:30 - 12:30</li>
                                                    </ul>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="lesson-confirm">
                                                    <a href="#">Confirmé</a>
                                                </div>
                                                <button type="submit" class="btn btn-info">Reprogrammer</button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 col-xl-4 d-flex">
                        <div class="card flex-fill comman-shadow">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col-12">
                                        <h5 class="card-title">Progression du Semestre</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="dash-widget">
                                <div class="circle-bar circle-bar1">
                                    <div class="circle-graph1" data-percent="55">
                                        <div class="progress-less">
                                            <b>55/60</b>
                                            <p>Leçons réalisées</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                    <div class="col-12 col-lg-12 col-xl-12 d-flex">
                        <div class="card flex-fill comman-shadow">
                            <div class="card-header d-flex align-items-center">
                                <h5 class="card-title">Historique d'Enseignement</h5>
                                <ul class="chart-list-out student-ellips">
                                    <li class="star-menus"><a href="javascript:"><i class="fas fa-ellipsis-v"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="teaching-card">
                                    <ul class="steps-history">
                                        <li>5 Juin</li>
                                        <li>4 Juin</li>
                                        <li>4 Juin</li>
                                    </ul>
                                    <ul class="activity-feed">
                                        <li class="feed-item d-flex align-items-center">
                                            <div class="dolor-activity">
                                                <span class="feed-text1"><a>Administration Système et Réseaux</a></span>
                                                <ul class="teacher-date-list">
                                                    <li><i class="fas fa-calendar-alt me-2"></i>6 Juin, 2025</li>
                                                    <li>|</li>
                                                    <li><i class="fas fa-clock me-2"></i>09:00 - 12:00 (180 Minutes)</li>
                                                </ul>
                                            </div>
                                            <div class="activity-btns ms-auto">
                                                <button type="submit" class="btn btn-info">En cours</button>
                                            </div>
                                        </li>
                                        <li class="feed-item d-flex align-items-center">
                                            <div class="dolor-activity">
                                                <span class="feed-text1"><a>Génie Logiciel et UML</a></span>
                                                <ul class="teacher-date-list">
                                                    <li><i class="fas fa-calendar-alt me-2"></i>5 Juin, 2025</li>
                                                    <li>|</li>
                                                    <li><i class="fas fa-clock me-2"></i>08:00 - 10:00 (120 Minutes)</li>
                                                </ul>
                                            </div>
                                            <div class="activity-btns ms-auto">
                                                <button type="submit" class="btn btn-info">Terminé</button>
                                            </div>
                                        </li>
                                        <li class="feed-item d-flex align-items-center">
                                            <div class="dolor-activity">
                                                <span class="feed-text1"><a>Développement Web Backend</a></span>
                                                <ul class="teacher-date-list">
                                                    <li><i class="fas fa-calendar-alt me-2"></i>4 Juin, 2025</li>
                                                    <li>|</li>
                                                    <li><i class="fas fa-clock me-2"></i>09:00 - 10:00 (60 Minutes)</li>
                                                </ul>
                                            </div>
                                            <div class="activity-btns ms-auto">
                                                <button type="submit" class="btn btn-info">Terminé</button>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
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
                                        <h4>Botanique</h4>
                                        <h5>Lorem ipsum sit amet</h5>
                                    </div>
                                    <span>08:00 - 09:00</span>
                                </div>
                            </div>
                            <div class="calendar-details">
                                <p>08:00</p>
                                <div class="calendar-box normal-bg">
                                    <div class="calandar-event-name">
                                        <h4>Botanique</h4>
                                        <h5>Lorem ipsum sit amet</h5>
                                    </div>
                                    <span>08:00 - 09:00</span>
                                </div>
                            </div>
                            <div class="calendar-details">
                                <p>08:00</p>
                                <div class="calendar-box normal-bg">
                                    <div class="calandar-event-name">
                                        <h4>Botanique</h4>
                                        <h5>Lorem ipsum sit amet</h5>
                                    </div>
                                    <span>08:00 - 09:00</span>
                                </div>
                            </div>
                            <div class="upcome-event-date">
                                <h3>10 Jan</h3>
                                <span><i class="fas fa-ellipsis-h"></i></span>
                            </div>
                            <div class="calendar-details">
                                <p>08:00</p>
                                <div class="calendar-box normal-bg">
                                    <div class="calandar-event-name">
                                        <h4>Botanique</h4>
                                        <h5>Lorem ipsum sit amet</h5>
                                    </div>
                                    <span>08:00 - 09:00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <footer>
                        <p>Copyright © 2025 BELEFQIH Mohammed.</p>
                    </footer>
                </div>
            </div>
        </div>
    </div>
</div>