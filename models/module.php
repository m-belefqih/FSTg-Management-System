<?php
require($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/config/DB_connection.php');

function findAll(): ?array
{
    global $conn;

    $query = "SELECT m.id, m.nom AS nom_module, f.nom AS nom_filiere, f.niveau AS niveau_filiere, m.semestre AS semestre_module, d.nom AS nom_departement 
        FROM module m 
        JOIN filiere f ON m.id_filiere = f.id 
        JOIN departement d ON f.id_dep = d.id WHERE d.id = ?";

    try {
        $stmt = $conn->prepare($query);
        $stmt->execute([$_SESSION['user_data']['id_dep']]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all results as an associative array
    } catch (PDOException $e) {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
            date('Y-m-d H:i:s') . " - Erreur lors de l'exécution de la requête : " . $e->getMessage(). "\n",
            FILE_APPEND);
        return null;
    }
}
function getFilieres($id): ?array
{
    global $conn;
    $query = "SELECT id, nom, niveau FROM filiere WHERE id_dep = ?";

    try {
        $stmt = $conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all results as an associative array
    } catch (PDOException $e) {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
            date('Y-m-d H:i:s') . " - Erreur lors de l'exécution de la requête : " . $e->getMessage() . "\n",
            FILE_APPEND);
        return null;
    }
}

<<<<<<< HEAD
function create($nom, $semestre, $id_filiere, $id_teacher): bool
{
    global $conn;
    $query = "INSERT INTO module (nom, semestre, id_filiere, id_teacher) VALUES (?, ?, ?, ?)";

    try {
        $stmt = $conn->prepare($query);
        return $stmt->execute([$nom, $semestre, $id_filiere, $id_teacher]);
    } catch (PDOException $e) {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
            date('Y-m-d H:i:s') . " - Erreur lors de l'insertion du module : " . $e->getMessage() . "\n",
            FILE_APPEND);
        return false;
    }
}

function edit($id, $nom, $semestre, $id_filiere, $id_teacher): bool
{
    global $conn;
    try {
        $query = "UPDATE module SET nom = ?, semestre = ?, id_filiere = ?, id_teacher = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        return $stmt->execute([$nom, $semestre, $id_filiere, $id_teacher, $id]);
=======
function isExist($nom, $id_filiere): bool
{
    global $conn;
    $query = "SELECT COUNT(*) as count FROM module WHERE nom = ? AND id_filiere = ?";
    try{
        $stmt = $conn->prepare($query);
        $stmt->execute([$nom, $id_filiere]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'] > 0 ? true : false;
    } catch (PDOException $e) {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
            date('Y-m-d H:i:s') . " - Erreur lors de la vérification de l'existence du module : " . $e->getMessage() . "\n",
            FILE_APPEND);
        return false;
    }
}


function create($nom, $semestre, $id_filiere): bool
{
    global $conn;
    $query = "INSERT INTO module (nom, semestre, id_filiere) VALUES (?, ?, ?)";

    try {
        $stmt = $conn->prepare($query);
        return $stmt->execute([$nom, $semestre, $id_filiere]);
    } catch (PDOException $e) {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
            date('Y-m-d H:i:s') . " - Erreur lors de l'insertion du module : " . $e->getMessage() . "\n",
            FILE_APPEND);
        return false;
    }
}

function edit($id, $nom, $id_filiere, $semestre): bool
{
    global $conn;
    try {
        $query = "UPDATE module SET nom = ?, id_filiere = ?, semestre = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        return $stmt->execute([$nom, $id_filiere, $semestre, $id]);
>>>>>>> db87a5ab0b87a555fe4f82d5cb1fd03e5de7b323
    } catch (PDOException $e) {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
            date('Y-m-d H:i:s') . " - Erreur lors de la modification du module : " . $e->getMessage() . "\n",
            FILE_APPEND);
        return false;
    }
}

function delete($id): bool
{
    global $conn;
    try {
        $query = "DELETE FROM module WHERE id = ?";
        $stmt = $conn->prepare($query);
        return $stmt->execute([$id]);
    } catch (PDOException $e) {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
            date('Y-m-d H:i:s') . " - Erreur lors de la suppression du module : " . $e->getMessage() . "\n",
            FILE_APPEND);
        return false;
    }
}

function view($id): ?array
{
    global $conn;
    try {
<<<<<<< HEAD
        $query = "SELECT m.*, f.nom as nom_filiere, f.niveau as niveau_filiere, d.nom as nom_departement 
                 FROM module m 
                 JOIN filiere f ON m.id_filiere = f.id 
                 JOIN departement d ON f.id_dep = d.id 
                 WHERE m.id = ?";
=======
        $query = "SELECT m.id as id, m.nom as nom, m.semestre as semestre, f.id as id_filiere 
              FROM module m 
              JOIN filiere f ON m.id_filiere = f.id 
              WHERE m.id = ?";
>>>>>>> db87a5ab0b87a555fe4f82d5cb1fd03e5de7b323
        $stmt = $conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
            date('Y-m-d H:i:s') . " - Erreur lors de la récupération des données du module : " . $e->getMessage() . "\n",
            FILE_APPEND);
        return null;
    }
}