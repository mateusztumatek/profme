$(function () {
    $('#search_friends_input').keypress(function (event) {
        if(event.keyCode === 13){
            search_friends();
        }
    });

   /* $('.page-link').on('click',function (event) {
        event.preventDefault();
        $.ajax({
            url: $(this).attr('href'),
        }).done(function (msg) {
            $('.friends-list').replaceWith(msg);
        });
        console.log(this);
    })*/
});

function search_friends() {
    var term = $('#search_friends_input').val();
    if(term == ''){
        return;
    }

    $.ajax({
        url: base_url+'/friends/'+term,
    }).done(function (msg) {
        $('#friend_search_result').replaceWith(msg);
    });
}

function add_friend(form, event){
    event.preventDefault();
    var my_form = new FormData(form);
    var form = form;
    $.ajax({
        method: 'POST',
        url: $(form).attr('action'),
        data: my_form,
        processData: false,
        contentType: false,

    }).done(function (msg) {
        $('.friends-list').replaceWith(msg);
    })
}

function delete_friend(form, event) {
    event.preventDefault();
    var my_form = new FormData(form);
    var form = form;
    $.ajax({
        method: 'POST',
        url: $(form).attr('action'),
        data: my_form,
        processData: false,
        contentType: false,

    }).done(function (msg) {
        $('.friends-list').replaceWith(msg);
    })
}

function accept_friend(form, event) {
    event.preventDefault();
    var my_form = new FormData(form);
    var form = form;
    $.ajax({
        method: 'POST',
        url: $(form).attr('action'),
        data: my_form,
        processData: false,
        contentType: false,

    }).done(function (msg) {

        $('#unaccept_friends').replaceWith(msg['unaccept_friends_view']);
        $('.friends-list').replaceWith(msg['friends_list_view']);

    })
}