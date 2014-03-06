$(document).ready(function() {

    /* Top banner Sponsors */
    var sponsor;

    $('.sponsors').children().each(function(){
        if (!$(this).is('ul')) {
            sponsor = $(this).text();
            console.log(sponsor);
        } else {
            $(this).attr('data-sponsor', sponsor);
            if ($('.active', this).is('li')) {
                $('.spons-h').html(sponsor + ':');
            }
        }
    })
//    $('.navbar-header').collapse();
});
