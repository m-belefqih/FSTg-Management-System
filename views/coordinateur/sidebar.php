<!-- Custom style CSS -->
<style>
    .sidebar-menu > ul > li > a:hover {
        color: #C17900; !important;
    }
</style>
<div class="sidebar" id="sidebar">
    <div>
        <div class="sidebar-inner slimscroll">
            <div id="sidebar-menu" class="sidebar-menu">
                <ul>
                    <li class="menu-title">
                        <span>Main Menu</span>
                    </li>
                    <li>
                        <a href="/FSTg-Management-System/views/coordinateur/home.php"><i class="fas fa-home"></i><span> Accueil</span></a>
                    </li>
                    <li>
                        <a href="/FSTg-Management-System/views/coordinateur/student_management/index.php"><i class="fas fa-graduation-cap"></i><span> Étudiants</span></a>
                    </li>
<!--                    <li>-->
<!--                        <a href="#"><i class="fas fa-chalkboard-teacher"></i><span> Enseignants</span></a>-->
<!--                    </li>-->
                    <li>
                        <a href="/FSTg-Management-System/views/coordinateur/affectation_module/index.php"><i class="fas fa-tasks"></i><span> Affectation des modules</span></a>
                    </li>

                    <li class="submenu">
                        <a href="#"><i class="fas fa-clipboard"></i> <span> Notes</span> <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="#"><i class="fa fa-list"></i><span> Liste des notes</span></a></li>
                            <li><a href="#"><i class="fa fa-archive"></i><span> Archive des notes</span></a></li>
                            <li><a href="#"><i class="fa fa-file-export"></i><span> Exporter les notes</span></a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fas fa-calendar-day"></i><span> Emploi du temps</span></a>
                    </li>
                    <?php if ($_SESSION['user_data']['id_role'] == 2) { ?>
                        <li class="menu-title">
                            <span>Profesor Menu</span>
                        </li>
                        <li class="submenu">
                            <a href="#"><i class="fas fa-book-reader"></i> <span> Modules</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="#">Liste des modules</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fas fa-clipboard"></i>
                                <span> Notes</span></a>
                        </li>
                        <li>
                            <a href="#"><i class="fas fa-calendar-day"></i>
                                <span> Emploi du temps</span>
                            </a>
                        </li>
                        <li>
                            <a href="#"><i class="fas fa-address-card"></i><span> Profil</span></a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>

