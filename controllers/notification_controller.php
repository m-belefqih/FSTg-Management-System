<?php
//require_once($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/auth/session.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/models/notification.php');

// Function get notifications of coordinator
function getMyNotificationss($id_receiver): ?array
{
    global $conn;

    $query = "SELECT notification.id_receiver, user.nom as nom_sender, filiere.id AS id_filiere, filiere.nom as nom_filiere, notification.created_at
            FROM notification
            JOIN user ON notification.id_sender = user.id
            JOIN module ON notification.id_module = module.id
            JOIN filiere ON module.id_filiere = filiere.id 
            WHERE id_receiver = ?";

    try {
        $stmt = $conn->prepare($query);
        $stmt->execute([$id_receiver]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all results as an associative array
    } catch (PDOException $e) {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
            date('Y-m-d H:i:s') . " - Erreur lors de l'exécution de la requête : " . $e->getMessage(). "\n",
            FILE_APPEND);
        return null;
    }
}

if (isset($_SESSION['user_data']) && $_SESSION['user_data']['id_role'] == 2) {

    // Get all the notifications of coordinator
    $notifications = getMyNotificationss($_SESSION['user_data']['id']);

    // Log the notifications
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
        date('Y-m-d H:i:s') . " - Notifications : " . json_encode($notifications) . "\n",
        FILE_APPEND
    );

}

?>