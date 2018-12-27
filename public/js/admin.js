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

function open_comments_modal(button) {
    post_id = $(button).data('id');
    $.get(base_url+'/admin/post/comments/'+post_id, function (data) {
        if($('#post_comments').length){
            $('#post_comments').replaceWith(data);
        } else {
            $("body").append(data);
        }
        $('#post_comments').modal();

    });
}

function getPrivilageCreateModal() {
    $.get('/privilege_create', function (data) {
        if($('#privilege_create').length === 0){
            $("body").prepend(data);
            $('#privilege_create').modal();
        } else {
            $('#privilege_create').modal();

        }

    })
}

function getPrivilegeEditModal(btn) {
    $.get('/privilege_edit/'+$(btn).attr('data-privilege_id') , function (data) {
        if($('#privilege_edit').length === 0){
            $("body").prepend(data);
            $('#privilege_edit').modal();
        } else {
            $('#privilege_edit').replaceWith(data);
            $('#privilege_edit').modal();
        }

    })
}

function change_image(elem) {
    console.log('wighagoaw');
    if (elem.files && elem.files[0]) {
        var reader = new FileReader();
        var button = elem;
        reader.onload = function(e) {
            var attr = $(button).attr('data-target');
            console.log(attr);

            if(typeof attr !== typeof undefined && attr !== false ){
                console.log($(attr));
                $(attr).attr('src', e.target.result);
                $(attr).show();

            } else {
                $('#education_photo').attr('src', e.target.result);
                $('#education_photo').show();

            }
        }

        reader.readAsDataURL(elem.files[0]);
    }
}