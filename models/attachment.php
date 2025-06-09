<?php
require($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/config/DB_connection.php');

function getMyModules($id_teacher): ?array
{
    global $conn;
    $query = "SELECT m.id, m.nom, m.semestre, f.nom AS nom_filiere
        FROM module AS m
        JOIN filiere AS f 
        ON m.id_filiere = f.id
        WHERE id_teacher = ?";

    try {
        $stmt = $conn->prepare($query);
        $stmt->execute([$id_teacher]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all results as an associative array
    } catch (PDOException $e) {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
            date('Y-m-d H:i:s') . " - Erreur lors de l'exécution de la requête : " . $e->getMessage(). "\n",
            FILE_APPEND);
        return null;
    }
}

function findAll($id_module): ?array
{
    global $conn;
    $query = "SELECT attachment.*, module.nom AS nom_module
        FROM attachment
        JOIN module ON attachment.id_module = module.id
        WHERE id_module = ?";

    try {
        $stmt = $conn->prepare($query);
        $stmt->execute([$id_module]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all results as an associative array
    } catch (PDOException $e) {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
            date('Y-m-d H:i:s') . " - Erreur lors de l'exécution de la requête : " . $e->getMessage(). "\n",
            FILE_APPEND);
        return null;
    }
}

function create($title, $type, $filename, $filepath, $id_module): bool
{
    global $conn;
    $query = "INSERT INTO attachment (title, type, filename, filepath, upload_date, id_module) VALUES (?, ?, ?, ?, ?, ?)";

    try {
        $upload_date = date('Y-m-d H:i:s'); // Example: 2025-04-29 15:04:10
        $sqlState = $conn->prepare($query);
        return $sqlState->execute([
            $title,
            $type,
            $filename,
            $filepath,
            $upload_date,
            $id_module,
        ]);

    } catch (PDOException $e) {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
            date('Y-m-d H:i:s') . " - Erreur d'ajout d'attachment : " . $e->getMessage() . "\n",
            FILE_APPEND);
        return false;
    }
}

//function edit($id, $nom, $prenom, $genre, $dateNaissance, $email, $CIN, $role, $phone): bool
//{
//    global $conn;
//    try {
//        $query = "UPDATE user SET nom = ?, prenom = ?, genre = ?, dateNaissance = ?, email = ?, CIN = ?, id_role = ?, phone = ? WHERE id = ?";
//        $stmt = $conn->prepare($query);
//        return $stmt->execute([$nom, $prenom, $genre, $dateNaissance, $email, $CIN, $role, $phone, $id]);
//    } catch (PDOException $e) {
//        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
//            date('Y-m-d H:i:s') . " - Erreur lors de la modification : " . $e->getMessage() . "\n",
//            FILE_APPEND);
//        return false;
//    }
//}
//function delete($id): bool
//{
//    global $conn;
//    try {
//        $query = "DELETE FROM user WHERE id = ?";
//        $stmt = $conn->prepare($query);
//        return $stmt->execute([$id]);
//    } catch (PDOException $e) {
//        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
//            date('Y-m-d H:i:s') . " - Erreur lors de la suppression : " . $e->getMessage() . "\n",
//            FILE_APPEND);
//        return false;
//    }
//}
//function view($id): ?array
//{
//    global $conn;
//    try {
//        $query = "SELECT * FROM user WHERE id = ?";
//        $stmt = $conn->prepare($query);
//        $stmt->execute([$id]);
//        return $stmt->fetch(PDO::FETCH_ASSOC);
//    } catch (PDOException $e) {
//        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
//            date('Y-m-d H:i:s') . " - Erreur lors de la récupération des données : " . $e->getMessage() . "\n",
//            FILE_APPEND);
//        return null;
//    }
//}