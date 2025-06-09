<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/auth/session.php');

if (isset($_SESSION['user_data']) && $_SESSION['user_data']['id_role'] == 3) {

    require_once($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/controllers/attachment_controller.php');

    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        switch ($action) {
            case 'create':
                createPageAction();
                break;
            case 'list':
                indexAction();
                break;
            case 'store':
                storeAttachmentAction();
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