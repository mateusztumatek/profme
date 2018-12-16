var reports = new Array();
var csrf_token;
$(function () {
    csrf_token = $("meta[name='csrf-token']").attr("content");
    $('.open_education_modal').click(function (event) {

        education_id = $(this).data('id');
        $.get(base_url+'/admin/education/'+education_id, function (data) {
            if($('#edit_education_modal').length){
                $('#edit_education_modal').replaceWith(data);
            } else {
                $("body").append(data);
            }
            $('#edit_education_modal').modal();

        });
    });

});
function sendRequest(form, e) {
    e.preventDefault();
    $.ajax({
        method: 'POST',
        url: $(form).attr('action'),
        data: {reports:reports, _token: csrf_token},


    }).done(function (msg) {
        $('#reports').replaceWith(msg);
        $('#reports-delete').hide();
        $('#reports-mark-seen').hide();
        $('#reports-mark-unseen').hide();
        $('#reports-accept').hide();
        $('#reports-unaccept').hide();
        reports = [];
    });
}
function reports_click(input) {


    var ischecked= $(input).is(':checked');
    if(ischecked){
        reports.push($(input).val());
        if(reports.length > 0){
            $('#reports-delete').show();
            $('#reports-mark-seen').show();
            $('#reports-mark-unseen').show();
            $('#reports-accept').show();
            $('#reports-unaccept').show();

        }
    } else {
        index = reports.indexOf($(input).val());
        reports.splice(index,1);
        if(reports.length == 0){

            $('#reports-delete').hide();
            $('#reports-mark-seen').hide();
            $('#reports-mark-unseen').hide();
            $('#reports-accept').hide();
            $('#reports-unaccept').hide();
        }
    }
}