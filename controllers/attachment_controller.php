<?php
// linking the model with view using this controller
require_once($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/models/attachment.php');

// Function to get the page of modules selection
function choixNiveau(): void
{
    $modules = array();
    $modules = getMyModules($_SESSION['user_data']['id']);

    require_once($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/views/professeur/attachment_management/level_selection.php');
}

// Function to get the page for listing all attachmnets
function indexAction(): void
{
    $id_module = $_GET['id'];

    $attachments = array();
    $attachments = findAll($id_module);

    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
        date('Y-m-d H:i:s') . " - List of attachments : " . json_encode($attachments) . "\n",
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
        $test = create($title, $type, $filename, $filepath, $id_module);

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

// Function to get the page of semestre selection
function choixSemestre(): void
{
    $modules = array();
    $modules = getMyModules($_SESSION['user_data']['id']);

    require_once($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/views/student/attachment_management/semestre_selection.php');
}



// Function to get the page for editing a teacher
//function editAction(): void
//{
//    $id = $_GET['id'];
//    $user = view($id); // $user is an associative array
//    require_once($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/views/chef_dep/teacher_management/edit.php');
//}

// Function to update a teacher
//function updateAction(): void
//{
//    $id = htmlentities($_POST['id']);
//    $nom = htmlentities($_POST['nom']);
//    $prenom  = htmlentities($_POST['prenom']);
//    $genre  = htmlentities($_POST['genre']);
//    $dateNaissance = date('Y-m-d', strtotime(htmlentities($_POST['dateNaissance']))); // Format the date to Y-m-d
//    $email  = htmlentities($_POST['email']);
//    $CIN  = htmlentities($_POST['CIN']);
//    $role  = htmlentities($_POST['role']);
//    $phone  = htmlentities($_POST['phone']);
//
//    $test = edit($id, $nom, $prenom, $genre, $dateNaissance, $email, $CIN, $role, $phone);
//
//    if($test){
//        $_SESSION['success'] = "Modification réussie";
//    } else {
//        $_SESSION['error'] = "Échec de la modification";
//    }
//
//    header('location:index.php?action=list');
//}

// Function to delete a teacher
//function deleteAction(): void
//{
//    $test = delete($_GET['id']);
//
//    if($test){
//        $_SESSION['success'] = "Suppression réussie";
//    } else {
//        $_SESSION['error'] = "Échec de la suppression";
//    }
//    header('location:index.php?action=list');
//}