$(document).ready(function() {

    /* Top banner Sponsors */
    var sponsors = $('.sponsors'),
        sponsor,
        padd = 10,
        i = 0;

    sponsors.children().each(function(){
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
    $('.imagemask', sponsors).each(function(){ // zamienić na 'img'
        $(this).parent().css('padding-left', ($(this).outerWidth() + padd) + 'px');
        $(this).wrap('<span class="brand"/>');
    })
    if (!$('.active', sponsors).is('li')) {
        sponsor = $('li:first-of-type').addClass('active').parent().attr('data-sponsor');
        $('.spons-h').html(sponsor + ':');
    }

//    $('.navbar-header').collapse();
});
