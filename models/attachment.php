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

function getModule($id_module): ?array
{
    global $conn;
    $query = "SELECT * FROM module WHERE id = ?";

    try {
        $stmt = $conn->prepare($query);
        $stmt->execute([$id_module]);
        return $stmt->fetch(PDO::FETCH_ASSOC); // Fetch all results as an associative array
    } catch (PDOException $e) {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
            date('Y-m-d H:i:s') . " - Erreur lors de l'exécution de la requête : " . $e->getMessage(). "\n",
            FILE_APPEND);
        return null;
    }
}

function findAllAttachments($id_module): ?array
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

function createAttachment($title, $type, $filename, $filepath, $id_module): bool
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

function deleteAttachment($id): bool
{
    global $conn;
    try {
        $query = "DELETE FROM attachment WHERE id = ?";
        $stmt = $conn->prepare($query);
        return $stmt->execute([$id]);
    } catch (PDOException $e) {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
            date('Y-m-d H:i:s') . " - Erreur lors de la suppression : " . $e->getMessage() . "\n",
            FILE_APPEND);
        return false;
    }
}

// Function to download an attachment
function downloadAttachment()
{
    try {
        global $conn;

        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);

            $query = "SELECT * FROM attachment WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->execute([$id]);
            $attachment = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($attachment) {
                $filepath = $_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/' . ltrim($attachment['filepath'], '/');
                $filename = $attachment['filename'];

                if (file_exists($filepath)) {
                    // Get MIME type
                    $finfo = finfo_open(FILEINFO_MIME_TYPE);
                    $mime_type = finfo_file($finfo, $filepath);
                    finfo_close($finfo);

                    header('Content-Description: File Transfer');
                    header('Content-Type: ' . $mime_type);
                    header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
                    header('Expires: 0');
                    header('Cache-Control: must-revalidate');
                    header('Pragma: public');
                    header('Content-Length: ' . filesize($filepath));
                    readfile($filepath);
                    exit();
                } else {
                    $_SESSION['error'] = "Fichier introuvable sur le serveur";
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    exit();
                }
            } else {
                $_SESSION['error'] = "Pièce jointe introuvable";
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            }
        }
    } catch (PDOException $e) {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
            date('Y-m-d H:i:s') . " - Erreur de Base de données : " . $e->getMessage() . "\n",
            FILE_APPEND
        );
    }
}

function getModulesForStudent($id_student): ?array
{
    global $conn;
    $query = "SELECT m.id, m.nom, m.semestre, f.nom AS nom_filiere
        FROM module AS m
        JOIN filiere AS f
        ON m.id_filiere = f.id
        JOIN user AS u
        ON u.id_filiere = f.id
        WHERE u.id = ?";

    try {
        $stmt = $conn->prepare($query);
        $stmt->execute([$id_student]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all results as an associative array
    } catch (PDOException $e) {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
            date('Y-m-d H:i:s') . " - Erreur lors de l'exécution de la requête : " . $e->getMessage(). "\n",
            FILE_APPEND);
        return null;
    }
}