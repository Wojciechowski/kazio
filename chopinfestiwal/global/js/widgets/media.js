/**
 * Package for wilkomirski.org.pl
 * Paatronaty medialne
 *
 * version: 0.2
 * author: Piotr Wojciechowski :: piotr.wojciechowski@kontakt.waw.pl
 * create: 04-03-2014
 */

$.fn.PatronMedia = function(param){
    param = {
        time: 800,
        pause: 2000/*,
        w_start: 45*/
    }

    var that, list_box, max, etc,
        i = -1,
        action = 0,

        /**
         * zmiana obrazków
         */
        rotate = function(){
            var end = $('li.end', list_box).removeClass('start'),
                activ = $('li.start', list_box).addClass('end'),
                next = activ.next();

            if (!next.is('li')){
                if (max) {
                    i++;
                    // do zrobienia - jak będzie więcej grup
                }
                next = list_box.filter('[data-id="'+i+'"]').children(':first');
            }
            end.removeClass('end');

            if (action) {
                setTimeout(function(){
                    next.addClass('start');
                    etc = setTimeout(rotate, param.pause);
                }, param.time);
            }
        },

        /**
         * uruchamianie/zatrzymywanie animacji
         */
        start = function(){
            var pos = that.css('position');

            if (pos == 'fixed') {
                if (action == 0) {
                    // start
                    etc = setTimeout(rotate, param.pause);
                    action++;
                }
            } else {
                // stop
                clearTimeout(etc);
                action = 0;
            }
        },

        /**
         * Inicjowanie banera
         */
        init = function(){
            var block = that.children('.blok');

            list_box = block.children('ul');

            block.children().each(function(){
                var o = $(this);

                if (o.is('p')) {
                    i++;
                    if (i == 0) {
                        o.addClass('active');
                    }
                } else {
                    o.children().each(function(){
                        $(this).css('margin-right', $(this).outerWidth() * -1);
                    })
                }
                o.attr('data-id', i);
            });
            max = i;
            i = 0;
            list_box.filter('[data-id="0"]').children(':first').addClass('start');

            start();
        };

    $(window).resize(function(){
        start();
    });

    return this.each(function(){
        that = $(this);
        init();
    });
};

$(document).ready(function(){
    $('#pMedia').PatronMedia();
})
