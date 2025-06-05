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


function create($nom, $semestre, $id_filiere): ?int
{
    global $conn;
    $query = "INSERT INTO module (nom, semestre, id_filiere) VALUES (?, ?, ?)";

    try {
        $stmt = $conn->prepare($query);
        $stmt->execute([$nom, $semestre, $id_filiere]);
        return $conn->lastInsertId(); // Return the ID of the module created
    } catch (PDOException $e) {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
            date('Y-m-d H:i:s') . " - Erreur lors de l'insertion du module : " . $e->getMessage() . "\n",
            FILE_APPEND);
        return null;
    }
}

function edit($id, $nom, $id_filiere, $semestre): bool
{
    global $conn;
    try {
        $query = "UPDATE module SET nom = ?, id_filiere = ?, semestre = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        return $stmt->execute([$nom, $id_filiere, $semestre, $id]);
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
        $query = "SELECT m.id as id, m.nom as nom, m.semestre as semestre, f.id as id_filiere 
              FROM module m 
              JOIN filiere f ON m.id_filiere = f.id 
              WHERE m.id = ?";
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


// Function to download modules in CSV format
function downloadModulesCSV()
{
    try {
        global $conn;

        // Création de la requête préparée avec PDO
        $query = "SELECT m.nom AS nom_module, f.nom AS nom_filiere, f.niveau AS niveau_filiere, m.semestre AS semestre_module
                  FROM module m 
                  JOIN filiere f ON m.id_filiere = f.id 
                  JOIN departement d ON f.id_dep = d.id WHERE d.id = ?";

        $stmt = $conn->prepare($query);
        $stmt->execute([$_SESSION['user_data']['id_dep']]);

        if($stmt->rowCount() > 0) {
            $delimiter = ",";

            // Créer un pointeur de fichier
            $f = fopen('php://memory', 'w');

            // Définir les en-têtes des colonnes
            $fields = array('Nom du module', 'Filière', 'Niveau', 'Semestre');
            fputcsv($f, $fields, $delimiter);

            // Récupérer et écrire les données ligne par ligne
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $lineData = array(
                    $row['nom_module'],
                    $row['nom_filiere'],
                    $row['niveau_filiere'],
                    $row['semestre_module']
                );
                fputcsv($f, $lineData, $delimiter);
            }

            // Retourner au début du fichier
            fseek($f, 0);

            // Headers pour le téléchargement
            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename="modules-list_' . date('Y-m-d') . '.csv"');

            // Ajout de BOM UTF-8 (obligatoire pour Excel)
            echo "\xEF\xBB\xBF"; // <-- Cette ligne est très importante

            // Envoyer le contenu du fichier
            fpassthru($f);
            fclose($f);
            exit();
        } else {
            $_SESSION['error'] = "Aucun module trouvé.";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    } catch (PDOException $e) {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
            date('Y-m-d H:i:s') . " - Erreur de database : " . $e->getMessage() . "\n",
            FILE_APPEND
        );
    }
}

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

function findAllModulesAffected($id_filiere): ?array
{
    global $conn;
    $query = "SELECT module.id AS id_module, module.nom AS nom_module, module.id_filiere, module.id_teacher, user.nom AS nom_teacher, user.prenom AS prenom_teacher, filiere.nom as nom_filiere 
        FROM module 
        JOIN user ON module.id_teacher = user.id 
        JOIN filiere ON module.id_filiere = filiere.id 
        WHERE module.id_filiere = ?";

    try {
        $stmt = $conn->prepare($query);
        $stmt->execute([$id_filiere]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all results as an associative array
    } catch (PDOException $e) {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
            date('Y-m-d H:i:s') . " - Erreur lors de l'exécution de la requête : " . $e->getMessage(). "\n",
            FILE_APPEND);
        return null;
    }
}

function findAllModulesNotAffected($id_filiere): ?array
{
    global $conn;
    $query = "SELECT * FROM module WHERE id_filiere = ? AND id_teacher IS NULL";;

    try {
        $stmt = $conn->prepare($query);
        $stmt->execute([$id_filiere]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all results as an associative array
    } catch (PDOException $e) {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
            date('Y-m-d H:i:s') . " - Erreur lors de l'exécution de la requête : " . $e->getMessage(). "\n",
            FILE_APPEND);
        return null;
    }
}

function findAllTeachers($id_dep): ?array
{
    global $conn;
    $query = "SELECT * FROM user WHERE (id_role = 2 OR id_role = 3) AND id_dep = ?";

    try {
        $stmt = $conn->prepare($query);
        $stmt->execute([$id_dep]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all results as an associative array
    } catch (PDOException $e) {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
            date('Y-m-d H:i:s') . " - Erreur lors de l'exécution de la requête : " . $e->getMessage(). "\n",
            FILE_APPEND);
        return null;
    }
}


function affectModule($id_module, $id_enseignant): bool
{
    global $conn;
    $query = "UPDATE module SET id_teacher = ? WHERE id = ?";

    try {
        $stmt = $conn->prepare($query);
        $stmt->execute([$id_enseignant, $id_module]);
        return $stmt->rowCount() > 0 ? true : false;
    } catch (PDOException $e) {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
            date('Y-m-d H:i:s') . " - Erreur lors de l'exécution de la requête : " . $e->getMessage(). "\n",
            FILE_APPEND);
        return false;
    }
}

function deleteModuleAssignment($id): bool
{
    global $conn;
    try {
        $query = "UPDATE module SET id_teacher = NULL WHERE id = ?";;
        $stmt = $conn->prepare($query);
        return $stmt->execute([$id]);
    } catch (PDOException $e) {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
            date('Y-m-d H:i:s') . " - Erreur lors de la suppression de l'affectation du module : " . $e->getMessage() . "\n",
            FILE_APPEND);
        return false;
    }
}

function viewAffectation($id): ?array
{
    global $conn;
    try {
        $query = "SELECT module.id AS id_module, module.nom AS nom_module, module.id_teacher, user.nom AS nom_teacher, user.prenom AS prenom_teacher
            FROM module
            JOIN user ON module.id_teacher = user.id
            WHERE module.id = ?";
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

function editAffectation($id_module, $id_enseignant): bool
{
    global $conn;
    try {
        $query = "UPDATE module SET id_teacher = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        return $stmt->execute([$id_enseignant, $id_module]);
    } catch (PDOException $e) {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
            date('Y-m-d H:i:s') . " - Erreur lors de la modification : " . $e->getMessage() . "\n",
            FILE_APPEND);
        return false;
    }
}

function getNameFiliere($id): ?string
{
    global $conn;
    try {
        $query = "SELECT nom FROM filiere WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['nom'] : null;
    } catch (PDOException $e) {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
            date('Y-m-d H:i:s') . " - Erreur lors de la récupération du nom de la filière : " . $e->getMessage() . "\n",
            FILE_APPEND);
        return null;
    }
}

function getCoordinatorOfModule($id_module): ?int
{
    global $conn;
    try {
        $query = "SELECT filiere.id_coordinator AS coordinator_of_module
            FROM module
            JOIN filiere ON module.id_filiere = filiere.id
            WHERE module.id = ?";
        $stmt = $conn->prepare($query);
        $stmt->execute([$id_module]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['coordinator_of_module'] : null;
    } catch (PDOException $e) {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
            date('Y-m-d H:i:s') . " - Erreur lors de la récupération de ID du coordinateur de module concerné : " . $e->getMessage() . "\n",
            FILE_APPEND);
        return null;
    }
}

function findModules($id_filiere, $semestre): ?array
{
    global $conn;
    try {
        $query = "SELECT id, nom FROM module WHERE id_filiere = ? AND semestre = ?";

        $stmt = $conn->prepare($query);
        $stmt->execute([$id_filiere, $semestre]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
            date('Y-m-d H:i:s') . " - Erreur lors de l'exécution de la requête : " . $e->getMessage() . "\n",
            FILE_APPEND);
        return null;
    }
}