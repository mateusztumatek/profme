
function loadChart(bars, action) {
    console.log(bars.offset().top);
    $('html,body').animate({
        scrollTop: bars.offset().top-20
    }, 200);
    setTimeout(function () {
        $(bars).each( function( key, bar ) {
            var div = $(this).children()[0];
            var percentage = $(div).data('percentage');
            $(div).animate({
                'height' : percentage + '%'
            }, 1000);

        });
    }, 300);


}
function closeChart(bars, action) {

    setTimeout(function () {
        $(bars).each( function( key, bar ) {
            var div = $(this).children()[0];
            var percentage = $(div).data('percentage');
            $(div).height(0);
        });
    }, 300);
}

function showPostRate(postID, rate) {
    var modal = $('#PostRateModal');
    var formdata = new FormData();
    formdata.append('rate', rate);
    formdata.append('post_id', postID);
    $.ajax({
        url: users_rate_route+'/'+postID+'/'+rate,
    }).done(function (msg) {
        update_modal(msg);
    });
    modal.find('.modal-title').text('użytkownicy którzy ocenili ten post na: ' + rate);
    $(modal).modal('show');

}

function update_modal(arr) {
    $('#PostRateModal').find('.modal-body').html("");
    var counter = 1;



    jQuery.each(arr, function (i,val) {
        $('#PostRateModal').find('.modal-body').append('<div class="row justify-content-between">\n' +
            '                        <div class="col-sm-2">\n' +
            '                            <img src="'+ val.imageURL +'">\n' +
            '                        </div>\n' +
            '                        <div class="col-sm-10">\n' +
            '                                <p >'+ val.name +'<span class="float-right text-muted">'+ val.rate_created_at +'</span></p>\n' +
            '\n' +
            '                        </div>\n' +
            '                    </div>' +
            '                   ');
        if(counter != Object.keys(arr).length){
            $('#PostRateModal').find('.modal-body').append('<hr>');
        }
        counter = counter + 1;

    })

}