var availableTags = [
    "ActionScript",
    "AppleScript",
    "Asp",
    "BASIC",
    "C",
    "C++",
    "Clojure",
    "COBOL",
    "ColdFusion",
    "Erlang",
    "Fortran",
    "Groovy",
    "Haskell",
    "Java",
    "JavaScript",
    "Lisp",
    "Perl",
    "PHP",
    "Python",
    "Ruby",
    "Scala",
    "Scheme"
];

var search_url = base_url + '/autocomplete/'+$("#searchbox_users").attr('data-type');
function loadGallery (img) {
    $('#photos').modal('show');
    var my_modal = document.getElementById('photos');
    var modal_photo = document.getElementById('modal-photo');
    modal_photo.setAttribute('src', img.getAttribute('src'));
}

function ShowOrHide( elem ) {
    if(elem.css('display') == 'none'){
        elem.show('fast', null, 200);
        if($(elem).children('#chart').length > 0) {
            loadChart($(elem).children('#chart').children('#bars').children(), 'open');
        }

    } else {
        elem.hide('fast', null, 200);
        if($(elem).children('#chart').length > 0) {
            closeChart($(elem).children('#chart').children('#bars').children(), 'close');
        }
    }
}

function change(display, button) {

    var register = document.getElementById('register');
    var login = document.getElementById('login');
    button.removeAttribute('id');
    display.setAttribute('id', 'active');
    register.style.display = 'block';
    console.log(display.textContent);
    if(display.textContent == 'Zaloguj się'){
        login.style.display = 'block';
        register.style.display = 'none';
    } else {
        login.style.display = 'none';
        register.style.display = 'block';
    }


}
function show_notifications(notifications) {
    console.log( notifications.childNodes[0].childNodes[0]);
    if(notifications.style.height == 'fit-content'){
        notifications.childNodes[2].display = 'none';
        notifications.style.height = '35px';
        notifications.style.backgroundColor = 'white';
        notifications.childNodes[1].style.color = 'white';

    } else {
        notifications.childNodes[2].style.display = 'block';
        notifications.style.height = 'fit-content';
        notifications.style.backgroundColor = '#f38f1b';

        notifications.childNodes[0].childNodes[0].style.color = 'black';
    }


}

function ExtendAutocomplete() {
    $('#searchbox_users').autocomplete({

        source: search_url,
        select: function (event, ui) {
            if(search_url == base_url+'/autocomplete/users'){
                window.location.href = base_url+'/admin_dashboard/user/'+ ui.item.value;
            }
            if(search_url == base_url+'/autocomplete/posts'){
                window.location.href = base_url+'/admin_dashboard/post/'+ ui.item.value;
            }
            if(search_url == base_url+'/autocomplete/companies'){
                window.location.href = base_url+'/admin_dashboard/company/'+ ui.item.value;
            }

        },

    }).autocomplete( "instance" )._renderItem = function( ul, item ) {
        if(jQuery.isEmptyObject(item)) return $(null);
        return $( "<li></li>" )
            .append( "<a>" + item.value + " " + item.email + "</a>")
            .appendTo( ul );
    };
}

$('#tag-input').tagsinput({
    confirmKeys: [13, 44]
});

$('#tag-input').tagsinput({
    cancelConfirmKeysOnEmpty: true,
});

$('#a-input').on('click', function () {
   console.log($('#tag-input').val());
});

function submitFormEmployee(elem, event) {
    event.preventDefault();
    var my_form = new FormData(elem);
    var form = elem;
    $.ajax({
        method: 'POST',
        url: $(elem).attr('action'),
        data: my_form,
        processData: false,
        contentType: false,

    }).done(function (msg) {
        $('#employee-panel').replaceWith(msg);
    })

}



$(function () {
    $(document).on({
        ajaxStart: function() { $(".content").append("<div class=\"loader\">\n" +
            "                        <div class=\"lds-dual-ring\"></div>\n" +
            "                    </div>");
        },

        ajaxStop: function() { $(".loader").remove();
        }
    });
    $('.employee-confirm-form').on('submit', function (event) {
        event.preventDefault();
        var my_form = new FormData(this);
        var form = this;
        $.ajax({
            method: 'POST',
            url: $(this).attr('action'),
            data: my_form,
            processData: false,
            contentType: false,

        }).done(function (msg) {
            $('#employee-panel').replaceWith(msg);
        })

    });
    $('#searchbox_users').keypress(function () {
       ExtendAutocomplete();
    });
    $('#tabs').tabs();
    setTimeout(function() {
        $(".errors").hide('Fade', null, 300)
    }, 10000);
    $("#photo_input").change(function () {
        console.log('zmien blah');
        read_url(this);
    });

    $("#settings").on('click', function (event) {

        event.preventDefault();
        ShowOrHide($('#settings_menu'));
    });






    $('#searchbox').keypress(function (e) {
        if(e.keyCode === 13){
            window.location.href = base_url+'/admin_dashboard/user/'+ $(this).val();
        }

    });

    $('#post-image-holder').on('change', function () {
        var post_image = $('#post-image');

        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                post_image.attr('src', e.target.result);
                $('.img-holder').show('Fade',null, 200);
            };

        }
            reader.readAsDataURL(this.files[0]);

    });
    $('#company_modal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        company_id = button.data('whatever');
        $.get(base_url + '/admin_dashboard/get/company/'+ company_id, function (data) {
           $('#company_name').text(data['official_name']);
           $('#official_name_input').val(data['official_name']);
           $('#email_input').val(data['email']);
           $('#city_input').val(data['city']);
           $('#country_input').val(data['country']);
           $('#postal_code_input').val(data['postal_code']);
           $('#street_input').val(data['street']);
           $('#street_number_input').val(data['street_number']);
           $('#nip_input').val(data['nip']);
           if(data['is_verify']){
               $('#is_verify_input').attr('checked', true);
           }
           if(data['image']){
               $('#company_logo_placeholder').attr('src', base_url+ '/public/users/'+ data['user_id'] + '/company/' + data['id'] + '/' + data['image']);
               $('#company_logo_placeholder').css('display', 'block');
           }
           $('#company_edit_form').attr('action', base_url+'/admin_dashboard/company/edit/'+ data['id']);
        });
        $(this).modal();
    });


    $('#user_permission').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);

         user_id = button.data('whatever');
        $('#change_permission_form').attr('action', 'user/'+ user_id + '/change_permission');
        $('#delete_user_form').attr('action', 'user/delete/' + user_id);
       console.log('otworzylem modal z uprawnieniami uzytkownika');
        $(':input[value=admin]').attr("checked", false);
        $(':input[value=moderator]').attr("checked", false);
        $(':input[value=user]').attr("checked", false);
       $.get('user/'+ user_id+'/permission', function (data) {
         $('#user_name').text(data['user']['name']);
           jQuery.each(data['roles'], function (i, val) {
               if(val['name'] == 'admin'){
                   $(':input[value=admin]').attr("checked", true);
               }
               if(val['name'] == 'moderator'){
                   $(':input[value=moderator]').attr("checked", true);
               }
               if(val['name'] == 'user'){
                   $(':input[value=user]').attr("checked", true);
               }
           })
       });

        $(this).modal();
    });

    $('#delete-post-image').on('click', function () {
        var post_image = $('#post-image');
        $('.img-holder').hide('Fade', null, 200);
        post_image.attr('src', null);
        var input =  $('#post-image-holder');
        input.replaceWith(input.val('').clone(true));

    });
    $('#edit-post-image-holder').on('change', function () {
        var post_image = $('#edit-post-image');

        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                post_image.attr('src', e.target.result);
                $('.img-holder').show('Fade',null, 200);
            };

        }
        reader.readAsDataURL(this.files[0]);

    });

    $('#edit-delete-post-image').on('click', function () {
        var post_image = $('#edit-post-image');
        $('.img-holder').hide('Fade', null, 200);
        post_image.attr('src', null);
        var input =  $('#edit-post-image-holder');
        input.replaceWith(input.val('').clone(true));

    });



    $('.add-comment-form').on('submit', function (event) {


    });



});
function showform(form) {
    if(form.css('display') == 'block'){
        form.hide(200)
    }else form.show(200);
}
function read_url(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#photo').attr('src', e.target.result);
            if($('#photo-content').length > 0){
                $('#photo-content').css('display', 'flex');
            }

        }

        reader.readAsDataURL(input.files[0]);
    }
}

function loadGallery (img) {
    $('#photos').modal('show');
    var my_modal = document.getElementById('photos');
    var modal_photo = document.getElementById('modal-photo');
    modal_photo.setAttribute('src', img.getAttribute('src'));


}

function postEdit(post) {
    console.log(post)
}

function edit_comment(elem) {

    var comment_id = $(elem).parent().parent().attr('id');
    var comment = $(elem).parent().find('.comment-description');
    console.log(token);
    comment.replaceWith('<form action="'+comment_edit_route+'/'+comment_id+'" method="POST">' +
                            '<input type="hidden" name="_token" value="'+token+'">' +
                            '<div class="form-group">' +
                                '<textarea rows= "9" name="content" class="comment-description form-control">'+comment.text()+' </textarea>' +
                                '<button type="submit" class="my-button mt- mr-2"> zapisz </button>' +
                                '<button onclick="cancel_edit(this)" type="button" class="my-button mt-2"> anuluj </button>' +
                            '</div> ' +
                        '</form> ' +
                        '');


}
function cancel_edit(elem) {
    var textarea = $(elem).siblings('.comment-description');
   $(elem).parent().parent().replaceWith('<p class="comment-description">'+textarea.text()+'</p>');
}

function add_comment(comment, object) {
    var placeholder = $(object).parent().parent().siblings('.post-content').find('.comments-section').find('.comment-content');
    $(placeholder).prepend('  <div id="'+comment.id+'" class="comment row justify-content-between">\n' +
        '                                    <div class="col-md-2">\n' +
        '                                        <img src="'+comment.user_image+'">\n' +
        '                                    </div>\n' +
        '                                    <div class="col-md-10 text-left">\n' +
        '                                        <div class="row justify-content-between m-0 mb-1">\n' +
        '                                            <h4 class="m-0">'+comment.user+'</h4>\n' +
        '                                            <span>'+comment.created+'</span>\n' +
        '                                        </div>\n' +
        '\n' +
        '                                        <p class="comment-description">'+comment.content+'</p>\n' +
        '                                       <form style="line-height: 1.4" class="float-left" action="'+comment_delete_route+'/'+comment.id+'" method="POST">\n' +
        '<input type="hidden" name="_token" value="'+token+'">' +
        '                                                <a onclick="$(this).parent().submit()" class="mr-1"><i class="fa fa-trash"></i></a>\n' +
        '                                            </form>' +
        '                                        <a onclick="edit_comment(this)" class="ml-1"><i class="fa fa-edit"></i></a>\n' +
        '                                    </div>\n' +
        '\n' +
        '\n' +
        '                                </div>');
        $(object).parent().hide(200);
        $(object).find('textarea[name=content]').val("");
        $(object).parent().parent().siblings('.post-content').find('.comments-section').show(200);

}

function add_comment_submit(form, event) {
    event.preventDefault();
    var my_form = new FormData(form);
    var form = $(form);
    $.ajax({
        method: 'POST',
        url: $(form).attr('action'),
        data: my_form,
        processData: false,
        contentType: false,

    }).done(function (msg) {
        add_comment(msg, form);
    })
}

function openReportModal(elem_type, elem_id, elem_name, user_id) {
    $('#report_form').find('#elem_id').attr('value', elem_id);
    $('#report_form').find('#user_id').attr('value', user_id);
    $('#report_form').find('#elem_type').attr('value', elem_type);
    $('#report_form').find('#typ').text(elem_type);
    $('#report_form').find('#nazwa').text(elem_name);

    $('#report_modal').modal();
}

function showOtherReports(elem) {
    $.get('other_reports/'+ $(elem).attr('data-report_id'), function (data) {
        console.log(data);
        $('#other_reports').replaceWith(data);
        $('#other_reports').modal();
    });
}