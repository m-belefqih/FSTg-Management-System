<?php
require($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/config/DB_connection.php');

// Function to validate login credentials
function validateLoginCredentials($email, $password)
{
    global $conn;
    // First, get the user by email only
    $query = "SELECT * FROM user WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Then verify the password
    if ($user && password_verify($password, $user['password'])) {
        return $user;
    }
    return false;
}

// Function to fetch role information
function getRoleById($roleId)
{
    global $conn; // Use the global connection variable of DB_connection.php
    $query = "SELECT nom FROM role WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$roleId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);}

// Function to handle remember me functionality
function handleRememberMe($userId):void
{
    global $conn; // Use the global connection variable of DB_connection.php
    $selector = bin2hex(random_bytes(12));
    $validator = random_bytes(32);
    $hashedValidator = hash('sha256', $validator);
    $expiry = date('Y-m-d H:i:s', strtotime('+30 days'));

    $query = "INSERT INTO user_tokens (selector, hashed_validator, id_user, expiry) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->execute([$selector, $hashedValidator, $userId, $expiry]);

    // Set the cookie to use it in session.php
    // cookie is will expire in 30 days
    setcookie('remember', $selector.':'.bin2hex($validator), time() + (86400 * 30), "/", "", false, true);
}

// Function to download teacher in CSV format
function downloadTeacherCSV()
{
    try {
        global $conn;

        // Création de la requête préparée avec PDO
        $query = "SELECT u.prenom, u.nom, u.CIN, u.genre, u.phone, u.email, r.nom as role
              FROM user u
              JOIN role r ON u.id_role = r.id
              WHERE u.id_dep = ? AND (u.id_role = 2 OR u.id_role = 3)";

        $stmt = $conn->prepare($query);
        $stmt->execute([$_SESSION['user_data']['id_dep']]);

        if($stmt->rowCount() > 0) {
            $delimiter = ",";

            // Créer un pointeur de fichier
            $f = fopen('php://memory', 'w');

            // Définir les en-têtes des colonnes
            $fields = array('Prénom', 'Nom', 'CIN', 'Genre', 'Téléphone', 'Email Académique', 'Rôle');
            fputcsv($f, $fields, $delimiter);

            // Récupérer et écrire les données ligne par ligne
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $lineData = array(
                    $row['prenom'],
                    $row['nom'],
                    $row['CIN'],
                    $row['genre'],
                    $row['phone'],
                    $row['email'],
                    $row['role']
                );
                fputcsv($f, $lineData, $delimiter);
            }

            // Retourner au début du fichier
            fseek($f, 0);

            // Headers pour le téléchargement
            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename="teachers-list_' . date('Y-m-d') . '.csv"');

            // Ajouter le BOM UTF-8 (obligatoire pour Excel)
            echo "\xEF\xBB\xBF"; // <-- Cette ligne est très importante

            // Envoyer le contenu du fichier
            fpassthru($f);
            fclose($f);
            exit();
        } else {
            $_SESSION['error'] = "Aucun enseignant trouvé.";
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

?>