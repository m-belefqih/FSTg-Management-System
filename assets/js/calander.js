$(document).ready(function(){$("#calendar-doctor").simpleCalendar({
    months: [
        'janvier', 'février', 'mars', 'avril', 'mai', 'juin',
        'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'
    ],
    days: [
        'dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'
    ],
    fixedStartDay: 0,
    disableEmptyDetails: true,
    events: [
        // your events here
    ], fixedStartDay:0,disableEmptyDetails:true,events:[{startDate:new Date(new Date().setHours(new Date().getHours()+24)).toDateString(),endDate:new Date(new Date().setHours(new Date().getHours()+25)).toISOString(),summary:'Conférence sur le CyberSécurité'},{startDate:new Date(new Date().setHours(new Date().getHours()-new Date().getHours()-12,0)).toISOString(),endDate:new Date(new Date().setHours(new Date().getHours()-new Date().getHours()-11)).getTime(),summary:'Réunion du conseil de département'},{startDate:new Date(new Date().setHours(new Date().getHours()-48)).toISOString(),endDate:new Date(new Date().setHours(new Date().getHours()-24)).getTime(),summary:'Soutenance de thèse'}],
    });
});