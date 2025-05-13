<?php
// linking the student.php models with view using this controller
require_once($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/models/student.php');

function choixNiveau(): void
{
    $filieres = array();
    $filieres = getMyFilieres($_SESSION['user_data']['id'], $_SESSION['user_data']['id_dep']);

    require_once($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/views/coordinateur/student_management/level_selection.php');
}

// Function to get the page for listing students of a filiere
function indexAction(): void
{
    $id_filiere = $_GET['id'];

    $students = array();
    $students = findAll($id_filiere);

    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
        date('Y-m-d H:i:s') . " - List of students : " . json_encode($students) . "\n",
        FILE_APPEND
    );

    require_once($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/views/coordinateur/student_management/list_students.php');
}

// Function to get the page for creating a new student on a filiere
function createAction(): void
{
    $id_filiere = $_GET['id'];

    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
        date('Y-m-d H:i:s') . " - Id filiere is : " . $id_filiere . "\n",
        FILE_APPEND
    );

    require_once($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/views/coordinateur/student_management/create.php');
}

// Function to store a new student
function storeAction(): void
{
    $id_filiere = htmlentities($_POST['id_filiere']);
    $nom = htmlentities($_POST['nom']);
    $prenom  = htmlentities($_POST['prenom']);
    $genre  = htmlentities($_POST['genre']);
    $dateNaissance = date('Y-m-d', strtotime(htmlentities($_POST['dateNaissance']))); // Format the date to Y-m-d
    $email  = htmlentities($_POST['email']);
    $CNE  = htmlentities($_POST['CNE']);
    $CIN  = htmlentities($_POST['CIN']);
    $phone  = htmlentities($_POST['phone']);

    // Verify if the email already exists
    if (checkEmail($email)) {
        $_SESSION['error'] = "Cette email existe déjà";
        $_SESSION['message'] = $email;
        header('Location: index.php?action=create&id=' . $id_filiere);
        exit();
    }

    // Verify if the CNE already exists
    if (checkCNE($CNE)) {
        $_SESSION['error'] = "Cette CNE existe déjà";
        $_SESSION['message'] = $CNE;
        header('Location: index.php?action=create&id=' . $id_filiere);
        exit();
    }

    // Verify if the CIN already exists
    if (checkCIN($CIN)) {
        $_SESSION['error'] = "Cette CIN existe déjà";
        $_SESSION['message'] = $CIN;
        header('Location: index.php?action=create&id=' . $id_filiere);
        exit();
    }

    $test = create($nom, $prenom, $genre, $dateNaissance, $email, $CNE, $CIN, $phone, $id_filiere);

    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
        date('Y-m-d H:i:s') . " - Etat de l'insertion de user : " . $test . "\n",
        FILE_APPEND
    );

    if($test){
        $_SESSION['success'] = "Etudiant a été ajouté avec succès";
    }else {
        $_SESSION['error'] = "Échec de la suppression";
    }

    header('Location: index.php?action=list&id=' . $id_filiere);
}

// Function to get the page for editing a student
function editAction(): void
{
    $id_filiere = $_GET['idFiliere'];
    $id_student = $_GET['id'];

    $user = view($id_student); // $user is an associative array
    require_once($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/views/coordinateur/student_management/edit.php');
}

// Function to update a student
function updateAction(): void
{
    $id = htmlentities($_POST['id']);
    $nom = htmlentities($_POST['nom']);
    $prenom  = htmlentities($_POST['prenom']);
    $genre  = htmlentities($_POST['genre']);
    $dateNaissance = date('Y-m-d', strtotime(htmlentities($_POST['dateNaissance']))); // Format the date to Y-m-d
    $CNE  = htmlentities($_POST['CNE']);
    $CIN  = htmlentities($_POST['CIN']);
    $email  = htmlentities($_POST['email']);
    $phone  = htmlentities($_POST['phone']);

    $test = edit($id, $nom, $prenom, $genre, $dateNaissance, $CNE, $CIN, $email, $phone);

    if($test){
        $_SESSION['success'] = "Modification réussie";
    } else {
        $_SESSION['error'] = "Échec de la modification";
    }

    $id_filiere = htmlentities($_POST['id_filiere']);

    header('Location: index.php?action=list&id=' . $id_filiere);
}

// Function to delete a student
function deleteAction(): void
{
    $test = delete($_GET['id']);

    if($test){
        $_SESSION['success'] = "Suppression réussie";
    } else {
        $_SESSION['error'] = "Échec de la suppression";
    }

    $id_filiere = $_GET['idFiliere'];

    // Redirect to the list of students
    header('Location: index.php?action=list&id=' . $id_filiere);
}