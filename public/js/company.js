$(function () {
    $('#employer_search_input').autocomplete({
        source: base_url+'/autocomplete/companies',
        select: function (event, ui) {
            $('#company_placeholder').append(' <form style="display: none" action="' + base_url + '/employer/add_employer' +'" method="POST" id="company_'+ ui.item['id']+'">\n' +
                '                                '+ csrf +' \n' +
                '                               <input type="hidden" name="user_id" value="'+ auth_id +'">\n' +
                '                               <input type="hidden" name="company_id" value="'+ ui.item['id']+ '">\n' +
                '                           <div  class="row  bordered p-2 mt-2 mb-2" id = \'company-info\'>\n' +
                '                               <div class="col-sm-4">\n' +
                '                                   <div class="user-image">\n' +
                '                                       <img src="'+ ui.item['logo_url'] +'">\n' +
                '                                   </div>\n' +
                '                               </div>\n' +
                '                               <div class="col-sm-8">\n' +
                '                                   <h2> Firma: '+ ui.item['label'] +'</h2>\n' +
                '                                   <p class="mt-1 mb-0">NIP: '+ ui.item['nip'] +'</p>\n' +
                '                                   <p class="mt-1 mb-0">Miejscowość: ' + ui.item['city'] +'</p>\n' +
                '                                   <div class="form-group">\n' +
                '                                       <label for="position" class="col-form-label">Stanowisko: </label>\n' +
                '                                       <input class="form-control" type="text" name="position" required>\n' +
                '                                   </div>\n' +
                '                                   <div class="form-group">\n' +
                '                                       <label for="description" class="col-form-label">Opis: </label>\n' +
                '                                       <textarea class="form-control" type="text" name="description" required></textarea>\n' +
                '                                   </div>\n' +
                '                                   <div class="form-inline">\n' +
                '                                       <label for="sine"> Od dnia: </label>\n' +
                '                                       <input type="date" class="form-control mr-2" name="since" required>\n' +
                '                                       <label for="untill"> do dnia: </label>\n' +
                '                                       <input type="date" class="form-control" name="untill" >\n' +

                '                                   </div>\n' +
                '\n' +                                 '<button type="button" class="btn btn-primary mt-2 " onclick="store_employer($(this).parent().parent().parent(), this)"> Zatwierdź </button>  \n'+
                '\n' +                                 '<button type="button" onclick="remove($(this).parent().parent().parent())" class="btn btn-primary mt-2"> usuń </button>  \n'+
                '\n' +
                '                               </div>\n' +
                '\n' +
                '                           </div>\n' +
                '                           </form>');
                $('#company_'+ ui.item['id']).show('Fade',null, 200);
        },
    }).autocomplete( "instance" )._renderItem = function( ul, item ) {
        if(jQuery.isEmptyObject(item)) return $(null);
        return $( "<li></li>" )
            .append( "<a>" + item.value + " " + item.email + "</a>")
            .appendTo( ul );
    };

    $('#user_2').autocomplete({
        source: base_url+'/autocomplete/users',
        select: function (event, ui) {
            $('#user_2_id').val(ui.item['id']);
            $('#compare_button').show('Fade',null, 200);
        },
    }).autocomplete( "instance" )._renderItem = function( ul, item ) {
        if(jQuery.isEmptyObject(item)) return $(null);
        return $( "<li></li>" )
            .append( "<a>" + item.label +"</a>")
            .appendTo( ul );
    };

});

function remove(elem) {
    $(elem).hide('slow', function(){ $(elem).remove(); });

}

function store_employer(elem, button) {

    var my_form = new FormData($(elem)[0]);
    console.log(my_form);
    var form = elem;
    $.ajax({
        method: 'POST',
        url: $(elem).attr('action'),
        data: my_form,
        processData: false,
        contentType: false,
        error: function (jqXHR, textStatus, errorThrown) {
            $.each(jqXHR.responseJSON['errors'], function () {
                $($(elem).children()[3]).append('<p class="alert"> '+ this+'</p>');
            });

        }

    }).done(function (msg, errors) {
        $(button).prop('disabled', true);
       $($(elem).children()[3]).append('<p class="success"> '+ msg["message"]+'</p>');

    })
}

function compare(elem, event) {

    event.preventDefault();
    var my_form = new FormData($(elem)[0]);
    var form = elem;
    $.ajax({
        method: 'POST',
        url: $(elem).attr('action'),
        data: my_form,
        processData: false,
        contentType: false,
        error: function (jqXHR, textStatus, errorThrown) {
            $.each(jqXHR.responseJSON['errors'], function () {
                $($(elem).children()[3]).append('<p class="alert"> '+ this+'</p>');
            });

        }

    }).done(function (msg, errors) {
        console.log(msg);
        if($('#compare_modal').length){
            $('#compare_modal').replaceWith(msg);
        } else {
            $("body").append(msg);
        }
        $('#compare_modal').modal();

    })
}

function confirmEmployee(form, event) {
    event.preventDefault();
    var my_form = new FormData(form);

    $.ajax({
        method: 'POST',
        url: $(form).attr('action'),
        data: my_form,
        processData: false,
        contentType: false,

    }).done(function (msg) {
        $('#employee-panel').replaceWith(msg);
    })

}