<?php
// linking the models with view using this controller
require_once($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/models/module.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/models/timetable.php');


// Function to get the page of level selection
function choixNiveau(): void
{
    $filieres = array();
    $filieres = getMyFilieres($_SESSION['user_data']['id'], $_SESSION['user_data']['id_dep']);

    require_once($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/views/coordinateur/timetable_management/level_selection.php');
}

// Function to get the timetable of a specific level
function indexAction(): void
{
    $id_filiere = $_GET['idFiliere'];
    $semestre = $_GET['semestre'];

    $timestable = array();
    $timestable = findTimesTable($id_filiere, $semestre);

    $nom_filiere = getNameFiliere($id_filiere);

    // Débogage
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
        date('Y-m-d H:i:s') . " - Données timestable : " . print_r($timestable, true) . "\n",
        FILE_APPEND
    );

    require_once($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/views/coordinateur/timetable_management/timetable.php');
}

// Function to get the page for adding a new lesson to the timetable
function addPageAction(): void
{
    $id_filiere = $_GET['idFiliere'];
    $semestre = $_GET['semestre'];

    $modules = array();
    $modules = findModules($id_filiere, $semestre);

    $nom_filiere = getNameFiliere($id_filiere);

    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
        date('Y-m-d H:i:s') . " - All teachers of filiere " . $nom_filiere . " : " . json_encode($modules) . "\n",
        FILE_APPEND
    );

    require_once($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/views/coordinateur/timetable_management/create.php');
}

// Function to add a new timetable
function addTimeTableAction(): void
{
    $id_filiere = htmlentities($_POST['id_filiere']);
    $semestre = htmlentities($_POST['semestre']);

    $id_module = htmlentities($_POST['id_module']);

    $date = date('Y-m-d', strtotime(htmlentities($_POST['date']))); // Format the date to Y-m-d
    $startTime = htmlentities($_POST['startTime']);
    $endTime = htmlentities($_POST['endTime']);

    $test = addNewTimeTable($date, $startTime, $endTime, $id_module);

    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
        date('Y-m-d H:i:s') . " - Etat de l'ajout de timetable est : " . $test . "\n",
        FILE_APPEND
    );

    header('Location: index.php?action=list&idFiliere=' . $id_filiere . '&semestre=' . $semestre);
}

// Function to update timetable event
function updateTimeTableAction(): void
{
    if (isset($_POST['title']) && isset($_POST['start']) && isset($_POST['end']) && isset($_POST['id'])) {
        $id = htmlentities($_POST['id']);
        $start_datetime = new DateTime($_POST['start']);
        $end_datetime = new DateTime($_POST['end']);

        $date = $start_datetime->format('Y-m-d');
        $start_time = $start_datetime->format('H:i:s');
        $end_time = $end_datetime->format('H:i:s');

        $result = updateTimeTable($id, $date, $start_time, $end_time);

        header('Content-Type: application/json');
        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Mise à jour réussie']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Erreur lors de la mise à jour']);
        }
    } else {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => 'Paramètres manquants']);
    }
    exit;
}


// Function to get all timetables of a professor
function getMyTimeTable(): void
{
    $timestable = array();
    $timestable = findAllMyTimeTable($_SESSION['user_data']['id']);

    // Débogage
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/logs/error_log.txt',
        date('Y-m-d H:i:s') . " - Données emploi du temps : " . print_r($timestable, true) . "\n",
        FILE_APPEND
    );

    require_once($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/views/professeur/timetable_management/timetable.php');
}