<?php
// linking the model with view using this controller
require_once($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/models/module.php');

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
    require_once($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/views/chef_dep/module_management/create.php');
}

// Function to store a new module
function storeAction(): void
{
    if (!isset($_POST['nom']) || !isset($_POST['semestre']) || !isset($_POST['id_filiere']) || !isset($_POST['id_teacher'])) {
        $_SESSION['error'] = "Tous les champs sont requis";
        header('Location: index.php?action=create');
        exit();
    }

    $nom = htmlentities($_POST['nom']);
    $semestre = htmlentities($_POST['semestre']);
    $id_filiere = htmlentities($_POST['id_filiere']);
    $id_teacher = htmlentities($_POST['id_teacher']);

    // Vérifier si le module existe déjà pour cette filière
    global $conn;
    $query = "SELECT COUNT(*) as count FROM module WHERE nom = ? AND id_filiere = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$nom, $id_filiere]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result['count'] > 0) {
        $_SESSION['error'] = "Ce module existe déjà pour cette filière";
        header('Location: index.php?action=create');
        exit();
    }

    // Insérer le nouveau module
    $query = "INSERT INTO module (nom, semestre, id_filiere, id_teacher) VALUES (?, ?, ?, ?)";
    try {
        $stmt = $conn->prepare($query);
        $success = $stmt->execute([$nom, $semestre, $id_filiere, $id_teacher]);

        if ($success) {
            $_SESSION['success'] = "Module ajouté avec succès";
            header('Location: index.php?action=list');
        } else {
            $_SESSION['error'] = "Erreur lors de l'ajout du module";
            header('Location: index.php?action=create');
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = "Erreur lors de l'ajout du module";
        header('Location: index.php?action=create');
    }
    exit();
}

// Function to get the page for editing a teacher
function editAction(): void
{
    if (!isset($_GET['id'])) {
        header('Location: index.php?action=list');
        exit();
    }

    $id = $_GET['id'];
    
    global $conn;
    $query = "SELECT m.*, f.nom as nom_filiere, f.niveau as niveau_filiere 
              FROM module m 
              JOIN filiere f ON m.id_filiere = f.id 
              WHERE m.id = ?";
    
    try {
        $stmt = $conn->prepare($query);
        $stmt->execute([$id]);
        $module = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$module) {
            $_SESSION['error'] = "Module non trouvé";
            header('Location: index.php?action=list');
            exit();
        }

        require_once($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/views/chef_dep/module_management/edit.php');
    } catch (PDOException $e) {
        $_SESSION['error'] = "Erreur lors de la récupération du module";
        header('Location: index.php?action=list');
        exit();
    }
}

// Function to update a module
function updateAction(): void
{
    if (!isset($_POST['id']) || !isset($_POST['nom']) || !isset($_POST['semestre']) || 
        !isset($_POST['id_filiere']) || !isset($_POST['id_teacher'])) {
        $_SESSION['error'] = "Tous les champs sont requis";
        header('Location: index.php?action=list');
        exit();
    }

    $id = htmlentities($_POST['id']);
    $nom = htmlentities($_POST['nom']);
    $semestre = htmlentities($_POST['semestre']);
    $id_filiere = htmlentities($_POST['id_filiere']);
    $id_teacher = htmlentities($_POST['id_teacher']);

    global $conn;
    $query = "UPDATE module SET nom = ?, semestre = ?, id_filiere = ?, id_teacher = ? WHERE id = ?";
    
    try {
        $stmt = $conn->prepare($query);
        $success = $stmt->execute([$nom, $semestre, $id_filiere, $id_teacher, $id]);

        if ($success) {
            $_SESSION['success'] = "Module modifié avec succès";
        } else {
            $_SESSION['error'] = "Erreur lors de la modification du module";
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = "Erreur lors de la modification du module";
    }
    
    header('Location: index.php?action=list');
    exit();
}

// Function to delete a teacher
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