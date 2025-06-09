<?php
require($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/config/DB_connection.php');

function findTimesTable($id_filiere, $semestre): ?array
{
    global $conn;
    $query = "SELECT t.id, t.date, t.start_time, t.end_time, m.nom
        FROM timetable AS t
        JOIN module AS m
        ON m.id = t.id_module
        WHERE m.id_filiere = ? AND m.semestre = ?";

    try {
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


function addNewTimeTable($date, $startTime, $endTime, $id_module): bool
{
    global $conn;
    $query = "INSERT INTO timetable (date, start_time, end_time, created_at, id_module) VALUES (?, ?, ?, ?, ?)";

    try {
        $currentDateTime = date('Y-m-d H:i');
        $stmt = $conn->prepare($query);
        $result = $stmt->execute([$date, $startTime, $endTime, $currentDateTime, $id_module]);
        return $result;
    } catch (PDOException $e) {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
            date('Y-m-d H:i:s') . " - Erreur lors de l'exécution de la requête : " . $e->getMessage(). "\n",
            FILE_APPEND);
        return false;
    }
}

function updateTimeTable($id, $date, $start_time, $end_time): bool
{
    global $conn;
    $query = "UPDATE timetable SET date = ?, start_time = ?, end_time = ? WHERE id = ?";

    try {
        $stmt = $conn->prepare($query);
        return $stmt->execute([$date, $start_time, $end_time, $id]);
    } catch (PDOException $e) {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
            date('Y-m-d H:i:s') . " - Erreur lors de la mise à jour : " . $e->getMessage(). "\n",
            FILE_APPEND);
        return false;
    }
}

function findAllMyTimeTable($id_teacher): ?array
{
    global $conn;
    $query = "SELECT t.*, m.nom AS nom_module, m.semestre, f.nom AS nom_filiere
        FROM timetable AS t
        JOIN module AS m
        ON m.id = t.id_module
        JOIN filiere AS f
        ON f.id = m.id_filiere
        WHERE m.id_teacher = ?";

    try {
        $stmt = $conn->prepare($query);
        $stmt->execute([$id_teacher]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
            date('Y-m-d H:i:s') . " - Erreur lors de l'exécution de la requête : " . $e->getMessage() . "\n",
            FILE_APPEND);
        return null;
    }
}