/**
 * Package for wilkomirski.org.pl
 *
 * version: 0.1
 * author: Piotr Wojciechowski :: piotr.wojciechowski@kontakt.waw.pl
 * create: 04-03-2014
 */

$.fn.carousel = function(){
    var that,
        tm,
        option = {
            start: 100,
            swap: 1000,
            move: 6000
        },

        init = function(){
            var list = that.children(),
                len = list.length,
                i = -1,

                swap = function(){
                    var n = i + 1;

                    if (n == len) {
                        n = 0;
                    }
                    list.eq(i).animate({
                        opacity: 0
                    }, option.swap);
                    list.eq(n).animate({
                        opacity: 1
                    }, option.swap, function(){
                        list.eq(i).children('img').css({'width': '88%', 'height': '88%'})
                        i = n;
                        tm = setTimeout(move, option.swap);
                    });
                },

                move = function(){
                    list.eq(i).children('img').animate({
                        width: '100%',
                        height: '100%'
                    }, option.move, function(){
                        tm = setTimeout(swap, option.swap);
                    })

                };

            $('img', list).css({'width': '88%', 'height': '88%'})
            list.css({'right': '-85px'});
            list.css('opacity', 0);
            tm = setTimeout(swap, 10);
        };

    return this.each(function(){
        that = $(this);
        init();
    });
}

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
    $('#banner').carousel();
});
