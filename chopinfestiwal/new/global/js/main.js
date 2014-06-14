/**
 * Package for wilkomirski.org.pl
 *
 * version: 0.1
 * author: Piotr Wojciechowski :: piotr.wojciechowski@kontakt.waw.pl
 * create: 04-03-2014
 */

$.fn.carousel = function(){
    var that, // #banner
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
                action = 0,

                onOff = function(){
                    if (that.css('display') != 'none') {
                        if (action == 0) {
                            list.css({'right': '-85px', 'opacity': 0});
                            i = -1;
                            tm = setTimeout(swap, 10);
                            action = 1;
                        }
                    } else if (action == 1) {
                        clearTimeout(tm);
                        $('img', list).css({'width': '100%', 'height': '100%'})
                        list.eq(i).stop(true, true);
                        action = 0
                    }
                },

                swap = function(){
                    list.eq(i).animate({
                        opacity: 0
                    }, option.swap);

                    i++;
                    if (i == len) {
                        i = 0;
                    }

                    list.eq(i).children('img').css({'width': '88%', 'height': '88%'})
                    list.eq(i).animate({
                        opacity: 1
                    }, option.swap, function(){
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

            $(window).resize(function(){
                onOff();
            });

            onOff();
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
    var main = $(".main"),

        menuHeight = function(){
            if (main.outerWidth() > 750) {
                var m_height = main.outerHeight(),
                    l_height = $('.col-left > section', main).outerHeight() - 150;

                if (m_height < l_height) {
                    main.css('min-height', l_height);
                }
            }

        },

        st = setTimeout(menuHeight, 50);

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
        menuHeight();
        return false;
    })

    $('#banner').carousel();
});
