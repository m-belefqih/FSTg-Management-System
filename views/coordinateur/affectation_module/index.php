<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/auth/session.php');

if (isset($_SESSION['user_data']) && $_SESSION['user_data']['id_role'] == 2) {

    // Linking the module.php model and view using this controller
    require_once($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/controllers/affecterModule_controller.php');

    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        switch ($action) {
            case 'affect':
                affectPageAction();
                break;
            case 'list':
                indexAction();
                break;
            case 'edit':
                editAction();
                break;
            case 'store':
                affectModuleAction();
                break;
            case 'update':
                updateAction();
                break;
            case 'delete':
                deleteAction();
                break;
            default:
                header("Location: /FSTg-Management-System/views/error.php");
                break;
        }
    } else {
        choixNiveau(); // Default action to display the level selection view
    }
} else {
    header("Location: /FSTg-Management-System/index.php?error=Accès non autorisé");
    exit();
}