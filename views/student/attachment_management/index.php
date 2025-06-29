<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/auth/session.php');

if (isset($_SESSION['user_data']) && $_SESSION['user_data']['id_role'] == 4) {

    require_once($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/controllers/attachment_controller.php');

    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        switch ($action) {
            case 'list':
                listAttachmentsForStudent();
                break;
            default:
                header("Location: /FSTg-Management-System/views/error.php");
                break;
        }
    } else {
        displayModuleForStudent(); // Default action to display the module selection view
    }
} else {
    header("Location: /FSTg-Management-System/index.php?error=Accès non autorisé");
    exit();
}