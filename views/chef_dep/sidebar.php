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
                        <span>Menu Principal</span>
                    </li>
                    <li>
                        <a href="/FSTg-Management-System/views/chef_dep/home.php"><i class="fas fa-home"></i><span> Accueil</span></a>
                    </li>
                    <li>
                        <a href="/FSTg-Management-System/views/chef_dep/teacher_management/index.php"><i class="fas fa-chalkboard-teacher"></i><span> Enseignants</span></a>
                    </li>
                    <li>
                        <a href="/FSTg-Management-System/views/chef_dep/module_management/index.php"><i class="fas fa-book-reader"></i><span> Modules</span></a>
                    </li>
                    <?php if ($_SESSION['user_data']['id_role'] == 1) { ?>
                        <li class="menu-title">
                            <span>Menu Professeur</span>
                        </li>
                        <li>
                            <a href="#"><i class="fas fa-book"></i> <span> Cours</span></a>
                        </li>
                        <li>
                            <a href="#"><i class="fas fa-graduation-cap"></i><span> Étudiants</span></a>
                        </li>
                        <li>
                            <a href="#"><i class="fas fa-clipboard"></i> <span> Notes</span></a>
                        </li>
                        <li>
                            <a href="#"><i class="fas fa-calendar-day"></i> <span> Emploi du Temps</span></a>
                        </li>
                    <?php }?>
                </ul>
            </div>
        </div>
    </div>

