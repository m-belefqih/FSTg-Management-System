<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/auth/session.php');

if (isset($_SESSION['user_data'])) {
    require_once($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/models/user.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/models/module.php');

    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        switch ($action) {
            case 'teachers':
                downloadTeacherCSV();
                break;
            case 'modules':
                downloadModulesCSV();
                break;
            case 'filieres':
                //downloadFilieresCSV();
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