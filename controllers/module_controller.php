<?php
// linking the model with view using this controller
require_once($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/models/module.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/models/notification.php');

// Function to get the page for listing all modules
function indexAction(): void
{
    $modules = array();
    $modules = findAll();

    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
        date('Y-m-d H:i:s') . " - List of modules : " . json_encode($modules) . "\n",
        FILE_APPEND
    );

    require_once($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/views/chef_dep/module_management/list_modules.php');
}

// Function to get the page for creating a new module
function createAction(): void
{
    $filieres = getFilieres($_SESSION['user_data']['id_dep']);
    require_once($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/views/chef_dep/module_management/create.php');
}

// Function to store a new module
function storeAction(): void
{
    $nom = htmlspecialchars($_POST['nom'], ENT_QUOTES, 'UTF-8');
    $id_filiere = htmlentities($_POST['id_filiere']);
    $semestre = htmlentities($_POST['semestre']);

    // Vérifier si le module existe déjà pour cette filière
    $test1 = isExist($nom, $id_filiere);

    if ($test1) {
        $_SESSION['error'] = "Ce module existe déjà pour cette filière";
        header('Location: index.php?action=create');
        exit();
    }

    // Insérer le nouveau module et récupérer son ID
    $id_module = create($nom, $semestre, $id_filiere);

    if ($id_module) {
        $id_coordinator = getCoordinatorOfModule($id_module);

        // Ajouter un nouveau notification pour le coordinateur concerné
        addNewNotification($id_module, $_SESSION['user_data']['id'], $id_coordinator);

        $_SESSION['success'] = "Module ajouté avec succès";
        header('Location: index.php?action=list');
    } else {
        $_SESSION['error'] = "Erreur lors de l'ajout du module";
        header('Location: index.php?action=create');
    }

    exit();
}

// Function to get the page for editing a module
function editAction(): void
{
    $module = array();
    $module = view($_GET['id']); // $module is an associative array
    $filieres = getFilieres($_SESSION['user_data']['id_dep']);
    require_once($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/views/chef_dep/module_management/edit.php');
}

// Function to update a module
function updateAction(): void
{
    $id = htmlentities($_POST['id']);
    $nom = htmlentities($_POST['nom']);
    $id_filiere = htmlentities($_POST['id_filiere']);
    $semestre = htmlentities($_POST['semestre']);

    $test = edit($id, $nom, $id_filiere, $semestre);

    if ($test) {
        $_SESSION['success'] = "Module modifié avec succès";
    } else {
        $_SESSION['error'] = "Erreur lors de la modification du module";
    }

    header('Location: index.php?action=list');
    exit();
}

// Function to delete a module
function deleteAction(): void
{
    $test = delete($_GET['id']);

    if($test){
        $_SESSION['success'] = "Module supprimé avec succès";
    } else {
        $_SESSION['error'] = "Échec de la suppression du module";
    }
    header('Location: index.php?action=list');
}