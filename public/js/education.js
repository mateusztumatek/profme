$(function () {

   $('#education_create_form').on('submit', function (event) {
       event.preventDefault();
       var error_placeholder = $(this).parent().children()[1];
       var my_form = new FormData(this);
       $.ajax({
           method: 'POST',
           url: $(this).attr('action'),
           data: my_form,
           processData: false,
           contentType: false,
           error: function (jqXHR, textStatus, errorThrown) {

               $.each(jqXHR.responseJSON['errors'], function () {
                   console.log(error_placeholder);
                   $(error_placeholder).append('<p class="alert"> '+ this+'</p>');
                   $(error_placeholder).show();
               });

           },

           complete: function (jqXHR, textStatus) {
               $('#education_create').modal('toggle');
           }

       }).done(function (msg, errors) {

           $('#education_content').replaceWith(msg);

       });

   });




    $( "input[name='image']" ).change(function () {

        if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                console.log($('#education_photo'));
                $('#education_photo').attr('src', e.target.result);
                $('#education_photo').show();
            }

            reader.readAsDataURL(this.files[0]);
        }
    });


    $( "input[name='image']" ).change(function () {

        if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                console.log($('#education_photo'));
                $('#education_photo').attr('src', e.target.result);
                $('#education_photo').show();
            }

            reader.readAsDataURL(this.files[0]);
        }
    })

});

function delete_education(form, event) {
    event.preventDefault();
    var my_form = new FormData(form);
    console.log(my_form);
    $.ajax({
        method: 'POST',
        url: $(form).attr('action'),
        data: my_form,
        processData: false,
        contentType: false,

    }).done(function (msg, errors) {

        $('#education_content').replaceWith(msg);

    });
}

function education_edit(form, event) {
    event.preventDefault();
    var my_form = new FormData(form);
    console.log(my_form);
    $.ajax({
        method: 'GET',
        url: $(form).attr('action'),

    }).done(function (msg, errors) {

            $('#edit_education_modal').replaceWith(msg);
            $('#edit_education_modal').modal();

    });
}

function submitForm(form, event) {
    event.preventDefault();
       var error_placeholder = $(form).parent().children()[1];
        var my_form = new FormData(form);
        $.ajax({
            method: 'POST',
            url: $(form).attr('action'),
            data: my_form,
            processData: false,
            contentType: false,
            error: function (jqXHR, textStatus, errorThrown) {

                $.each(jqXHR.responseJSON['errors'], function () {
                    console.log(error_placeholder);
                    $(error_placeholder).append('<p class="alert"> '+ this+'</p>');
                    $(error_placeholder).show();
                });

            },

            complete: function (jqXHR, textStatus) {
                $('#edit_education_modal').modal('toggle');
            }

        }).done(function (msg, errors) {

            $('#education_content').replaceWith(msg);

        });
}

