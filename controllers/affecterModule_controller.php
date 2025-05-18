<?php
// linking the module.php models with view using this controller
require_once($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/models/module.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/models/notification.php');


// Function to get the page of level selection
function choixNiveau(): void
{
    $filieres = array();
    $filieres = getMyFilieres($_SESSION['user_data']['id'], $_SESSION['user_data']['id_dep']);

    require_once($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/views/coordinateur/affectation_module/level_selection.php');
}

// Function to get the list of modules that affected to teachers
function indexAction(): void
{
    $id_filiere = $_GET['id'];

    $modulesAffected = array();
    $modulesAffected = findAllModulesAffected($id_filiere);

    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
        date('Y-m-d H:i:s') . " - List of modules and there teachers : " . json_encode($modulesAffected) . "\n",
        FILE_APPEND
    );

    require_once($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/views/coordinateur/affectation_module/list_modules_teachers.php');
}

// Function to get the page for affecting a module to a teacher
function affectPageAction(): void
{
    $id_filiere = $_GET['id'];

    $name_filiere = getNameFiliere($id_filiere);

    $enseignants = array();
    $enseignants = findAllTeachers($_SESSION['user_data']['id_dep']);

    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
        date('Y-m-d H:i:s') . " - All teachers of departement " . $_SESSION['user_data']['id_dep'] . " : " . json_encode($enseignants) . "\n",
        FILE_APPEND
    );

    $modules = array();
    $modules = findAllModulesNotAffected($id_filiere);

    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
        date('Y-m-d H:i:s') . " - All modules not affected : " . json_encode($modules) . "\n",
        FILE_APPEND
    );

    require_once($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/views/coordinateur/affectation_module/affect.php');
}

// Function to affect a module to a teacher
function affectModuleAction(): void
{
    $id_filiere = htmlentities($_POST['id_filiere']);
    $id_module = htmlentities($_POST['module']);
    $id_enseignant = htmlentities($_POST['enseignant']);

    $test1 = affectModule($id_module, $id_enseignant);

    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
        date('Y-m-d H:i:s') . " - Etat de l'affectation de module : " . $test1 . "\n",
        FILE_APPEND
    );

    if($test1){
        $_SESSION['success'] = "Module a été affecté avec succès";
    }else {
        $_SESSION['error'] = "Échec de l'affectation";
    }

    // Delete notification of the module that should be affected
    deleteNotification($id_module);

    header('Location: index.php?action=list&id=' . $id_filiere);
}

// Function to delete assignment of a module to a teacher
function deleteAction(): void
{
    $test = deleteModuleAssignment($_GET['id']); // the id is for module

    if($test){
        $_SESSION['success'] = "Suppression réussie";
    } else {
        $_SESSION['error'] = "Échec de la suppression";
    }

    $id_filiere = $_GET['idFiliere'];

    // Redirect to the list of modules assignment
    header('Location: index.php?action=list&id=' . $id_filiere);
}

// Function to get the page for editing a module assignment
function editAction(): void
{
    $id_filiere = $_GET['idFiliere'];

    $id_module = $_GET['id'];

    $module = array();
    $module = viewAffectation($id_module);

    $enseignants = array();
    $enseignants = findAllTeachers($_SESSION['user_data']['id_dep']);

    require_once($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/views/coordinateur/affectation_module/edit.php');
}

// Function to update assignement of a module to a teacher
function updateAction(): void
{
    $id_module = htmlentities($_POST['module']);
    $id_enseignant  = htmlentities($_POST['enseignant']);

    $test = editAffectation($id_module, $id_enseignant);

    if($test){
        $_SESSION['success'] = "Modification réussie";
    } else {
        $_SESSION['error'] = "Échec de la modification";
    }

    $id_filiere = htmlentities($_POST['id_filiere']);

    header('Location: index.php?action=list&id=' . $id_filiere);
}