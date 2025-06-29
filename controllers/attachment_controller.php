<?php
// linking the model with view using this controller
require_once($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/models/attachment.php');

// Function to get the page of module selection for professor
function choixModule(): void
{
    $modules = array();
    $modules = getMyModules($_SESSION['user_data']['id']);

    require_once($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/views/professeur/attachment_management/module_selection.php');
}

// Function to get the page for listing all attachments
function indexAction(): void
{
    $id_module = $_GET['id'];

    $attachments = array();
    $attachments = findAllAttachments($id_module);

    $module = getModule($id_module);

    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
        date('Y-m-d H:i:s') . " - List of attachments : " . json_encode($attachments) . "\n",
        FILE_APPEND
    );

    // Debougging information about the module
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
        date('Y-m-d H:i:s') . " - Info about module : " . json_encode($module) . "\n",
        FILE_APPEND
    );

    require_once($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/views/professeur/attachment_management/list_attachments.php');
}

// Function to get the page for creating a new teacher
function createPageAction(): void
{
    $id_module = $_GET['id'];
    require_once($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/views/professeur/attachment_management/create.php');
}

// Function to store a new attachment
function storeAttachmentAction(): void
{
    $title = htmlentities($_POST['title']);
    $type = htmlentities($_POST['type']);
    $id_module = htmlentities($_POST['id_module']);

    // Gestion de l'upload du fichier
    $file = $_FILES['file'];
    $filename = $file['name'];
    $upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/uploads/';

    // Créer le dossier uploads s'il n'existe pas
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $filepath = '/uploads/' . $filename;
    $full_path = $upload_dir . $filename;

    if (move_uploaded_file($file['tmp_name'], $full_path)) {
        // Le fichier a été uploadé avec succès
        $test = createAttachment($title, $type, $filename, $filepath, $id_module);

        if($test){
            $_SESSION['success'] = "La pièce jointe a été ajoutée avec succès";
        } else {
            $_SESSION['error'] = "Échec de l'ajout de la pièce jointe";
            // Supprimer le fichier en cas d'échec
            if (file_exists($full_path)) {
                unlink($full_path);
            }
        }
    } else {
        $_SESSION['error'] = "Échec de l'upload du fichier";
    }

    header('Location: index.php?action=list&id=' . $id_module);
}

// Function to delete a teacher
function deleteAction(): void
{
    $test = deleteAttachment($_GET['id']);

    if($test){
        $_SESSION['success'] = "Suppression réussie";
    } else {
        $_SESSION['error'] = "Échec de la suppression";
    }

    $id = $_GET['idModule'];

    header('location:index.php?action=list&id=' . $id);
}

// Function to get the page of module selection for a student
function displayModuleForStudent(): void
{
    $modules = array();
    $modules = getModulesForStudent($_SESSION['user_data']['id']);

    require_once($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/views/student/attachment_management/module_selection.php');
}

// Function to get the page for listing all attachments for a student
function listAttachmentsForStudent(): void
{
    $id_module = $_GET['id'];

    $attachments = array();
    $attachments = findAllAttachments($id_module);

    $module = getModule($id_module);

    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
        date('Y-m-d H:i:s') . " - List of attachments : " . json_encode($attachments) . "\n",
        FILE_APPEND
    );

    // Debougging information about the module
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
        date('Y-m-d H:i:s') . " - Info about module : " . json_encode($module) . "\n",
        FILE_APPEND
    );

    require_once($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/views/student/attachment_management/list_attachments.php');
}