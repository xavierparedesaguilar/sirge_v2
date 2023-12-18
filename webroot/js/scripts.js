// if ($('.select2')[0]) {
//     $('.select2').select2();
// }
if($('.tarea-autosize')[0]){
    $('.tarea-autosize').autosize({append: "\n"});
}

// if ($('.date-picker')[0]) {
//     $('.date-picker').datepicker({
//         locale: "es",
//         format: 'dd-mm-yyyy',

//     });
// }

// $(function () {
//     moment.locale('es');
//     var items = $("ul#message_push li a .message .message-time-moment");

//     updateHourNotification(items);
//     setInterval(function () {
//         updateHourNotification(items);
//     }, 3000);
// });

function updateHourNotification(items) {
    $(items).each(function (index, node) {
        // console.log("time_data_["+index+"]_:",node);
        // console.log("time_data_["+index+"]_data_:",node.getAttribute('data-date-fecha'));
        // console.log("time_data_["+index+"]_text_:",$(this).text());
        var time = node.getAttribute('data-date-fecha');
        var date = moment(time).format();
        var date_ago = moment(new Date(date), 'YYYYMMDD').fromNow();
        $(this).text(date_ago);
    });
}

$(document).on('keypress', '.onlynumbers', function (e) {
    return validarNumero(e);
});

$(document).on('keypress', '.onlyletters', function (e) {
    return validarLetras(e);
});