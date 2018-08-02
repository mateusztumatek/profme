
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
$('#tag-input').tagsinput({
    confirmKeys: [13, 44]
});

$('#tag-input').tagsinput({
    cancelConfirmKeysOnEmpty: true,
});







$('#a-input').on('click', function () {
   console.log($('#tag-input').val());
});
$(function () {
    $('#tabs').tabs();
    setTimeout(function() {
        $(".errors").hide('Fade', null, 300)
    }, 10000);
    $("#photo_input").change(function () {
        console.log('zmien blah');
        read_url(this);
    })

    $("#settings").on('click', function (event) {
        console.log('cos tam');
        event.preventDefault();
        ShowOrHide($('.dropdown-menu'));
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
            add_comment(msg, form );
        })
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
            $('#photo-content').css('display', 'flex');
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
    console.log(comment);
    var placeholder = $('.comment-content').prepend('  <div id="'+comment.id+'" class="comment row justify-content-between">\n' +
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

