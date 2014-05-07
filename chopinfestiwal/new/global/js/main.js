/**
 * Package for wilkomirski.org.pl
 *
 * version: 0.1
 * author: Piotr Wojciechowski :: piotr.wojciechowski@kontakt.waw.pl
 * create: 04-03-2014
 */

$(document).ready(function() {
    /**
     * Kontrola wysokości strony
     */
    var main = $(".main");

    if ($(".main").outerWidth() > 750) {
        var m_height = main.outerHeight(),
            l_height = $('.col-left > section', main).outerHeight() - 150;

        if (m_height < l_height) {
            main.css('min-height', l_height);
        }
    }

    /**
     * Menu
     */
    var activ = $('.mainmenu .active');

    activ.parent().parent().addClass('activegroup').parent().parent().addClass('activegroup');

    /**
     * Mailing
     */
    $('#mail a').click(function(){
        $('#mail .more').addClass('hide');
        $('#mail .text').removeClass('hide');
        return false;
    })

    /**
     * Slideshow
     */
    var box = $('#slideshow'),
        im = box.children('img'),
        l = im.length,
        pause = 3000,
        i = 0,
        action = 0,
        etc,

        start = function(){
            var pos = box.parent().css('display');

            if (pos == 'block') {
                if (action == 0) {
                    // start
                    etc = setTimeout(rotor, pause);
                    action++;
                }
            } else {
                // stop
                clearTimeout(etc);
                action = 0;
            }
        },

        rotor = function(){
            var j = i + 1;
            if (j == l) j = 0;
            im.eq(j).css({'top':133});
            im.eq(i).animate({
                'top': -133
            },500);
            im.eq(j).animate({
                'top': 0
            },500);
            i++;
            if (i == l) i = 0;
            etc=setTimeout(rotor, pause);
        };

    im.eq(0).css({'top':0});
    start();

    $(window).resize(function(){
        start();
    })
});
