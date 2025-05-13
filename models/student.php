<?php
require($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/config/DB_connection.php');

function findAll($id): ?array
{
    global $conn;
    $query = "SELECT user.*, filiere.nom as nom_filiere
              FROM user
              JOIN filiere ON user.id_filiere = filiere.id
              WHERE user.id_filiere = ? AND user.id_dep = ?";

    try {
        $stmt = $conn->prepare($query);
        $stmt->execute([$id, $_SESSION['user_data']['id_dep']]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all results as an associative array
    } catch (PDOException $e) {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
            date('Y-m-d H:i:s') . " - Erreur lors de l'exécution de la requête : " . $e->getMessage(). "\n",
            FILE_APPEND);
        return null;
    }
}

// Function to get filieres of coordinator
function getMyFilieres($id_coordinateur, $id_departement): ?array
{
    global $conn;
    $query = "SELECT id, nom, niveau
        FROM filiere
        WHERE id_coordinator = ? AND id_dep = ?";

    try {
        $stmt = $conn->prepare($query);
        $stmt->execute([$id_coordinateur, $id_departement]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all results as an associative array
    } catch (PDOException $e) {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
            date('Y-m-d H:i:s') . " - Erreur lors de l'exécution de la requête : " . $e->getMessage(). "\n",
            FILE_APPEND);
        return null;
    }
}

function checkEmail($email): bool
{
    global $conn;
    try {
        $query = "SELECT COUNT(*) as count FROM user WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->execute([$email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'] > 0 ? true : false ;
    } catch (PDOException $e) {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
            date('Y-m-d H:i:s') . " - Erreur lors de la vérification de l'email : " . $e->getMessage() . "\n",
            FILE_APPEND);
        return false;
    }
}

function checkCNE($CNE): bool
{
    global $conn;
    try {
        $query = "SELECT COUNT(*) as count FROM user WHERE CNE = ?";
        $stmt = $conn->prepare($query);
        $stmt->execute([$CNE]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'] > 0 ? true : false ;
    } catch (PDOException $e) {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
            date('Y-m-d H:i:s') . " - Erreur lors de la vérification de CNE : " . $e->getMessage() . "\n",
            FILE_APPEND);
        return false;
    }
}

function checkCIN($CIN): bool
{
    global $conn;
    try {
        $query = "SELECT COUNT(*) as count FROM user WHERE CIN = ?";
        $stmt = $conn->prepare($query);
        $stmt->execute([$CIN]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'] > 0 ? true : false ;
    } catch (PDOException $e) {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
            date('Y-m-d H:i:s') . " - Erreur lors de la vérification de CIN : " . $e->getMessage() . "\n",
            FILE_APPEND);
        return false;
    }
}

function create($nom, $prenom, $genre, $dateNaissance, $email, $CNE, $CIN, $phone, $id_filiere): bool
{
    global $conn;
    $query = "INSERT INTO user (nom, prenom, genre, dateNaissance, email, CNE, CIN, phone, id_role, id_dep, id_filiere, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $currentDateTime = date('Y-m-d H:i:s'); // Example: 2025-04-29 15:04:10

    try {
        $sqlState = $conn->prepare($query);
        return $sqlState->execute([
            $nom,
            $prenom,
            $genre,
            $dateNaissance,
            $email,
            $CNE,
            $CIN,
            $phone,
            4, // Assuming 4 is the role ID for students
            $_SESSION['user_data']['id_dep'],
            $id_filiere,
            $currentDateTime
        ]);

    } catch (PDOException $e) {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt', date('Y-m-d H:i:s') . " - Erreur lors de l'insertion : " . $e->getMessage() . "\n", FILE_APPEND);
        return false;
    }
}

function edit($id, $nom, $prenom, $genre, $dateNaissance, $CNE, $CIN, $email, $phone): bool
{
    global $conn;
    try {
        $query = "UPDATE user SET nom = ?, prenom = ?, genre = ?, dateNaissance = ?, CNE = ?, CIN = ?, email = ?, phone = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        return $stmt->execute([$nom, $prenom, $genre, $dateNaissance, $CNE, $CIN, $email, $phone, $id]);
    } catch (PDOException $e) {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
            date('Y-m-d H:i:s') . " - Erreur lors de la modification : " . $e->getMessage() . "\n",
            FILE_APPEND);
        return false;
    }
}

function delete($id): bool
{
    global $conn;
    try {
        $query = "DELETE FROM user WHERE id = ?";
        $stmt = $conn->prepare($query);
        return $stmt->execute([$id]);
    } catch (PDOException $e) {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
            date('Y-m-d H:i:s') . " - Erreur lors de la suppression : " . $e->getMessage() . "\n",
            FILE_APPEND);
        return false;
    }
}

function view($id): ?array
{
    global $conn;
    try {
        $query = "SELECT * FROM user WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
            date('Y-m-d H:i:s') . " - Erreur lors de la récupération des données : " . $e->getMessage() . "\n",
            FILE_APPEND);
        return null;
    }
}