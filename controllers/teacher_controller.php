<?php
// linking the model with view using this controller
require_once($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/models/teacher.php');

// Function to get the page for listing all teachers
function indexAction(): void
{
    $teachers = array();
    $teachers = findAll();

    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
        date('Y-m-d H:i:s') . " - List of teachers : " . json_encode($teachers) . "\n",
        FILE_APPEND
    );

    require_once($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/views/chef_dep/teacher_management/list_teachers.php');
}

// Function to get the page for creating a new teacher
function createAction(): void
{
    require_once($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/views/chef_dep/teacher_management/create.php');
}

// Function to store a new teacher
function storeAction(): void
{
    $nom = htmlentities($_POST['nom']);
    $prenom  = htmlentities($_POST['prenom']);
    $genre  = htmlentities($_POST['genre']);
    $dateNaissance = date('Y-m-d', strtotime(htmlentities($_POST['dateNaissance']))); // Format the date to Y-m-d
    $email  = htmlentities($_POST['email']);
    $CIN  = htmlentities($_POST['CIN']);
    $role  = htmlentities($_POST['role']);
    $phone  = htmlentities($_POST['phone']);

    // Verify if the email already exists
    if (checkEmail($email)) {
        $_SESSION['error'] = "Cette email existe déjà";
        $_SESSION['messageEmail'] = $email;
        header('Location: index.php?action=create');
        exit();
    }

    $test = create($nom, $prenom, $genre, $dateNaissance, $email, $CIN, $role, $phone);

    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
        date('Y-m-d H:i:s') . " - Etat de l'insertion de user : " . $test . "\n",
        FILE_APPEND
    );

    if($test){
        $_SESSION['success'] = "Enseignant a été ajouté avec succès";
    }else {
        $_SESSION['error'] = "Échec de la suppression";
    }

    header('Location: index.php?action=list');
}

// Function to get the page for editing a teacher
function editAction(): void
{
    $id = $_GET['id'];
    $user = view($id); // $user is an associative array
    require_once($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/views/chef_dep/teacher_management/edit.php');
}

// Function to update a teacher
function updateAction(): void
{
    $id = htmlentities($_POST['id']);
    $nom = htmlentities($_POST['nom']);
    $prenom  = htmlentities($_POST['prenom']);
    $genre  = htmlentities($_POST['genre']);
    $dateNaissance = date('Y-m-d', strtotime(htmlentities($_POST['dateNaissance']))); // Format the date to Y-m-d
    $email  = htmlentities($_POST['email']);
    $CIN  = htmlentities($_POST['CIN']);
    $role  = htmlentities($_POST['role']);
    $phone  = htmlentities($_POST['phone']);

    $test = edit($id, $nom, $prenom, $genre, $dateNaissance, $email, $CIN, $role, $phone);

    if($test){
        $_SESSION['success'] = "Modification réussie";
    } else {
        $_SESSION['error'] = "Échec de la modification";
    }

    header('location:index.php?action=list');
}

// Function to delete a teacher
function deleteAction(): void
{
    $test = delete($_GET['id']);

    if($test){
        $_SESSION['success'] = "Suppression réussie";
    } else {
        $_SESSION['error'] = "Échec de la suppression";
    }
    header('location:index.php?action=list');
}