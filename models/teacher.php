<?php
require($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/config/DB_connection.php');

function findAll(): ?array
{
    global $conn;
    $query = "SELECT user.*, departement.nom AS nom_departement
        FROM user
        INNER JOIN departement ON user.id_dep = departement.id
        WHERE (id_role = '3' OR id_role = '2') AND user.id_dep = ?";

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

function create($nom, $prenom, $genre, $dateNaissance, $email, $CIN, $role, $phone): bool
{
    global $conn;
    $query = "INSERT INTO user (nom, prenom, genre, dateNaissance, email, CIN, id_role, phone, id_dep, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    try {
        $currentDateTime = date('Y-m-d H:i:s'); // Example: 2025-04-29 15:04:10
        $sqlState = $conn->prepare($query);
        return $sqlState->execute([
            $nom,
            $prenom,
            $genre,
            $dateNaissance,
            $email,
            $CIN,
            $role,
            $phone,
            $_SESSION['user_data']['id_dep'],
            $currentDateTime
        ]);

    } catch (PDOException $e) {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt', date('Y-m-d H:i:s') . " - Erreur lors de l'insertion : " . $e->getMessage() . "\n", FILE_APPEND);
        return false;
    }
}

function edit($id, $nom, $prenom, $genre, $dateNaissance, $email, $CIN, $role, $phone): bool
{
    global $conn;
    try {
        $query = "UPDATE user SET nom = ?, prenom = ?, genre = ?, dateNaissance = ?, email = ?, CIN = ?, id_role = ?, phone = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        return $stmt->execute([$nom, $prenom, $genre, $dateNaissance, $email, $CIN, $role, $phone, $id]);
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