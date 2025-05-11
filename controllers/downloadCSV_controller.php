<?php
session_start();
require($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/config/DB_connection.php');

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
//        $filename = "teachers-list_" . date('Y-m-d') . ".csv";

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
//        header('Content-Disposition: attachment; filename="' . $filename . '";');
        header('Content-Disposition: attachment; filename="teachers-list_' . date('Y-m-d') . '.csv"');

        // Ajouter le BOM UTF-8 (obligatoire pour Excel)
        echo "\xEF\xBB\xBF"; // <-- Cette ligne est très importante

        // Envoyer le contenu du fichier
        fpassthru($f);
        fclose($f);
        exit();

    } else {
        $_SESSION['error'] = "Aucun enseignant trouvé.";
        // $_SERVER['HTTP_REFERER'] contains the URL of the page that the user came from.
        // It's the address of the previous page that linked to the current page.
        // Note: This value can be empty or unreliable as it depends on the browser sending this information
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }

} catch(PDOException $e) {

    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
        date('Y-m-d H:i:s') . " - Erreur de database : " . $e->getMessage() . "\n",
        FILE_APPEND
    );
}
?>