<?php
require($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/config/DB_connection.php');

function addNewNotification($id_module, $id_sender, $id_receiver): void
{
    global $conn;
    $query = "INSERT INTO notification (id_module, id_sender, id_receiver, created_at) VALUES (?, ?, ?, ?)";

    try {
        $currentDateTime = date('Y-m-d H:i'); // Example: 2025-04-29 15:04
        $stmt = $conn->prepare($query);
        $stmt->execute([$id_module, $id_sender, $id_receiver, $currentDateTime]);
    } catch (PDOException $e) {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt', date('Y-m-d H:i:s') . " - Erreur lors de l'insertion : " . $e->getMessage() . "\n", FILE_APPEND);
    }
}