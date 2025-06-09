<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

    <title>FSTG - Emploi du temps </title>

    <!-- Icon of FSTg -->
    <link rel="shortcut icon" href="https://ecampus-fst.uca.ma/pluginfile.php/1/theme_moove/favicon/1739555045/logo-universite-cadi-ayyad-marrakech-uca%20%281%29.ico">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&display=swap" rel="stylesheet">

    <!-- Icons and Fonts -->
    <link rel="stylesheet" href="../../../assets/plugins/feather/feather.css">
    <link rel="stylesheet" href="../../../assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../../../assets/plugins/fontawesome/css/all.min.css">

    <!-- Core CSS -->
    <link rel="stylesheet" href="../../../assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../assets/css/style.css">
    <link rel="stylesheet" href="../../../assets/css/style-override.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <link rel="stylesheet" href="../../../assets/plugins/fullcalendar/fullcalendar.min.css">
    <link rel="stylesheet" href="../../../assets/plugins/toastr/toastr.min.css">

    <!-- Custom style CSS -->
    <style>

        .event-time {
            font-weight: 500;
            margin-bottom: 2px;
            color: rgba(255, 255, 255, 0.95);
        }

        .event-title {
            font-weight: bold;
            margin-bottom: 2px;
        }

        .event-semestre {
            font-weight: bold;
        }
        .event-details {
            font-size: 0.85em;
            color: rgba(255, 255, 255, 0.9);
        }

        .event-filiere {
            margin-bottom: 1px;
            font-weight: bold;
        }

        .fc-time-grid-event .fc-content {
            padding: 2px 4px;
        }

        .page-header {
            margin-bottom: 1.5rem;
        }

        .page-header .btn-primary {
            background-color: #c17900;
            border-color: #c17900;
        }

        .page-header .btn-primary:hover {
            background-color: #a66800;
            border-color: #a66800;
        }

        a {
            color: #C17900; !important;
        }

        a:hover{
            color: #C17900; !important;
        }

        .fc-time-grid .fc-day.fc-sat, .fc-day-grid .fc-day {
            background-color: white !important;
        }

        .fc-day-header .fc-widget-header .fc-sat .fc-today {
            background-color: grey !important;
        }

        .fc-day.fc-sun {
            background-color: #f5f5f5;
            pointer-events: none;
            opacity: 0.5;
        }

        .fc-button-primary {
            background-color: #c17900 !important;
            border-color: #c17900 !important;
        }

        .fc-button-primary:hover {
            background-color: #a66800 !important;
            border-color: #a66800 !important;
        }

        .fc-today {
            background-color: rgba(193, 121, 0, 0.1) !important;
        }

        /* Style uniquement pour le bouton actif/sélectionné */
        .fc-state-active {
            background: #c17900 !important;
            background-color: #c17900 !important;
            border-color: #c17900 !important;
            color: white !important;
            text-shadow: none !important;
        }

        /* Style pour le bouton aujourd'hui quand il est actif */
        .fc-today-button.fc-state-active {
            background: #c17900 !important;
            background-color: #c17900 !important;
            border-color: #c17900 !important;
        }

        .fc-button {
            background-color: #f5f5f5 !important;
            background-image: none !important;
            border-color: #ddd !important;
            color: #333 !important;
        }

        /* Style pour le clic (état down) */
        .fc-state-down,
        .fc-state-active,
        .fc-state-disabled {
            background-color: #c17900 !important;
            border-color: #c17900 !important;
            color: white !important;
            text-shadow: none !important;
        }

        /* Style pour le survol */
        .fc-button:hover {
            background-color: #e6e6e6 !important;
            border-color: #adadad !important;
        }

        /* Style pour le focus */
        .fc-button:focus {
            background-color: #c17900 !important;
            border-color: #c17900 !important;
            color: white !important;
            outline: 0 !important;
        }

        /* Style pour le clic actif */
        .fc-button:active {
            background-color: #c17900 !important;
            border-color: #c17900 !important;
            color: white !important;
        }

        /* Style pour le bouton aujourd'hui */
        .fc-today-button:not(.fc-state-disabled) {
            background-color: #f5f5f5 !important;
            border-color: #ddd !important;
            color: #333 !important;
        }

        .fc-today-button:not(.fc-state-disabled):active,
        .fc-today-button:not(.fc-state-disabled).fc-state-active {
            background-color: #c17900 !important;
            border-color: #c17900 !important;
            color: white !important;
        }

    </style>

</head>
<body>
<div class="main-wrapper">
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row">
                    <div class="col">
                        <h3 class="page-title">Emploi du temps </h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="../home.php">
                                    <?php
                                    if (isset($_SESSION['user_data']['genre'])) {
                                        echo ($_SESSION['user_data']['genre'] == 'male') ? "Professeur" : "Professeure";
                                    }
                                    ?>
                                </a>
                            </li>
                            <li class="breadcrumb-item active">Emploi du temps</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/views/header.php');
include($_SERVER['DOCUMENT_ROOT'] . '/FSTg-Management-System/views/professeur/sidebar.php');
?>

<script src="../../../assets/js/jquery-3.6.0.min.js"></script>
<script src="../../../assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="../../../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../../assets/js/feather.min.js"></script>
<script src="../../../assets/plugins/apexchart/apexcharts.min.js"></script>
<script src="../../../assets/plugins/apexchart/chart-dat.js"></script>
<script src="../../../assets/js/moment.min.js"></script>
<script src="../../../assets/js/jquery-ui.min.js"></script>
<script src="../../../assets/js/script.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
<script src="../../../assets/plugins/toastr/toastr.min.js"></script>


<script>
    moment.locale('fr', {
        months : 'janvier_février_mars_avril_mai_juin_juillet_août_septembre_octobre_novembre_décembre'.split('_'),
        monthsShort : 'janv._févr._mars_avr._mai_juin_juil._août_sept._oct._nov._déc.'.split('_'),
        weekdays : 'dimanche_lundi_mardi_mercredi_jeudi_vendredi_samedi'.split('_'),
        weekdaysShort : 'dim._lun._mar._mer._jeu._ven._sam.'.split('_'),
        weekdaysMin : 'Di_Lu_Ma_Me_Je_Ve_Sa'.split('_')
    });
</script>


<?php
// Formattage des données pour FullCalendar
$calendarEvents = [];
if (isset($timestable) && is_array($timestable)) {
    foreach ($timestable as $event) {
        $calendarEvents[] = [
            'id' => $event['id'],
            'title' => $event['nom_module'],
            'filiere' => $event['nom_filiere'],
            'semestre' => $event['semestre'],
            'start' => date('Y-m-d', strtotime($event['date'])) . 'T' . $event['start_time'],
            'end' => date('Y-m-d', strtotime($event['date'])) . 'T' . $event['end_time'],
            'color' => '#c17900'
        ];
    }
}

?>

<script>
    $(document).ready(function() {

        $('#calendar').fullCalendar({
            locale: 'fr',
            header: {
                left: 'prev,next aujourd\'hui',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            buttonText: {
                today: "Aujourd'hui",
                month: 'Mois',
                week: 'Semaine',
                day: 'Jour'
            },
            defaultView: 'agendaWeek',
            events: <?php echo json_encode($calendarEvents); ?>,
            editable: true,
            minTime: '08:00:00',
            maxTime: '19:00:00',
            allDaySlot: false,
            droppable: true,
            height: 'auto',
            contentHeight: 'auto',
            scrollTime: '08:00:00',
            timeFormat: 'H:mm',
            slotLabelFormat: 'H:mm',
            monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet',
                'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
            monthNamesShort: ['Janv.', 'Févr.', 'Mars', 'Avr.', 'Mai', 'Juin',
                'Juil.', 'Août', 'Sept.', 'Oct.', 'Nov.', 'Déc.'],
            dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi',
                'Jeudi', 'Vendredi', 'Samedi'],
            dayNamesShort: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],

            eventRender: function(event, element) {
                element.css('background-color', '#c17900');
                element.css('border-color', '#c17900');

                // Formater les heures de début et fin
                var startTime = moment(event.start).format('HH:mm');
                var endTime = moment(event.end).format('HH:mm');

                // Créer la structure HTML personnalisée pour l'événement
                var content = '<div class="event-title">' + event.title + '</div>' +
                    '<div class="event-details">' +
                    '<div class="event-time">' + startTime + ' - ' + endTime + '</div>' +
                    '<div class="event-filiere">' + event.filiere + '</div>' +
                    '<div class="event-semestre">S' + event.semestre + '</div>' +
                    '</div>';

                element.find('.fc-content').html(content);

                // Ajuster la hauteur minimale pour accommoder le contenu
                element.css('min-height', '70px');
            },

            // Permettre plus d'espace pour les événements
            slotEventOverlap: false,
            slotDuration: '00:30:00',

            eventClick: function(event) {
                console.log('Clicked event:', event);
                $('#eventId').val(event.id);
                $('#eventModal').modal('show');
            }
        });
    });
</script>

</body>
</html>