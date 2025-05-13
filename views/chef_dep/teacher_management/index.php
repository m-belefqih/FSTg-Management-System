<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/auth/session.php');

if (isset($_SESSION['user_data']) && $_SESSION['user_data']['id_role'] == 1) {

    // Linking the teacher.php model and view using this controller
    require_once($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/controllers/teacher_controller.php');

    // Creation of a route for teacher management
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        switch ($action) {
            case 'create':
                createAction();
                break;
            case 'list':
                indexAction();
                break;
            case 'edit':
                editAction();
                break;
            case 'store':
                storeAction();
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
        // Default action when no action parameter is provided
        indexAction(); // Typically shows the list view as default
    }
} else {
    header("Location: /FSTg-Management-System/index.php?error=Accès non autorisé");
    exit();
}