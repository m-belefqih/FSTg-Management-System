<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/auth/session.php');

if (isset($_SESSION['user_data']) && $_SESSION['user_data']['id_role'] == 3) {

    // Linking the module.php model and view using this controller
    require_once($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/controllers/timeTable_controller.php');

    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        switch ($action) {
            case 'list':
                getMyTimeTable();
                break;
            default:
                header("Location: /FSTg-Management-System/views/error.php");
                break;
        }
    } else {
        header("Location: /FSTg-Management-System/views/error.php");
    }
} else {
    header("Location: /FSTg-Management-System/index.php?error=Accès non autorisé");
    exit();
}