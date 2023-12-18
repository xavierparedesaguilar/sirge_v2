// $(document).on('ready', function () {
//     var url = window.location;
//     console.log("url_: ", url);
//     var rutaMain = $('#sidebar ul.main-menu li a[href="' + url + '"]');
//     console.log("rutaMain_: ", rutaMain);
//     rutaMain.parent().addClass('active');
//     $('#sidebar ul.main-menu li a').filter(function () {
//         return this.href === url;
//     }).parent().addClass('active');
// });

$(function () {
    $("#sexo").on('change', function () {
        var sexo_ = $(this).val();
        console.log("valor_: ", sexo_);
        (sexo_==="hembra") ? select_change('a') : select_change('o') ;
    });

    function select_change(val_)
    {
        var selcapaci = "";
        selcapaci += '<option value="perr'+val_+'">Perr'+val_+'</option>';
        selcapaci += '<option value="gat'+val_+'">Gat'+val_+'</option>';
        $("#tipo").html(selcapaci);
    }
});