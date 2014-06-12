/**
 * Package for wilkomirski.org.pl
 * Paatronaty medialne
 *
 * version: 0.3
 * author: Piotr Wojciechowski :: piotr.wojciechowski@kontakt.waw.pl
 * create: 04-03-2014
 */

$.fn.PatronMedia = function(param){
    param = {
        time: 800,
        pause: 2000,
        w_start: 45
    }

    var that, list_box, list, len, box_len, max, etc,
        i = -1,
        action = 0,

        /**
         * zmiana obrazków
         */
        rotate = function(){
            i++;
            if (i == len) {
                i = 0;
                if (box_len > 1) {
                    // zmiana tekstu
                    var p = $('p.active', that).removeClass('active'),
                        nr = p.attr('data-id') * 1;

                    p.animate({
                        bottom: -30
                    }, param.time, function(){
                        nr++;
                        if (nr == box_len) {
                            nr = 0;
                        }
                        p = $('p[data-id="' + nr + '"]', that);
                        p.css({
                            bottom: 0,
                            left: 0
                        }).addClass('active').animate({
                            left: p.outerWidth(true) * -1
                        }, param.time, function(){
                            clearTimeout(etc);
                            list = p.next().children();
                            len = list.length;
                            etc = setTimeout(rotate, param.time);
                        })
                    })
                    i = -1;
                }
            }

            if (i > -1) {
                var li = list.eq(i);
                li.css({
                    opacity: 1,
                    left: 0
                }).animate({
                    left: li.outerWidth(true) * -1
                }, param.time, function(){
                    etc = setTimeout(step2, param.pause);
                });
            }
        },

        // drugi etap animacji obrazka
        step2 = function(){
            list.eq(i).animate({
                opacity: 0
            }, param.time, function(){
                etc = setTimeout(rotate, param.time);
            })
        },

        /**
         * uruchamianie/zatrzymywanie animacji
         */
        start = function(){
            var pos = that.css('position');

            if (pos == 'fixed') {
                if (action == 0) {
                    // start
                    etc = setTimeout(rotate, param.w_start);
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
            var block = that.children('.blok'),
                i = -1;

            list_box = block.children('ul');
            box_len = list_box.length;

            block.children().each(function(){
                var o = $(this);

                if (o.is('p')) {
                    i++;
                    if (i == 0) {
                        o.css('left', o.outerWidth(true) * -1).addClass('active');
                        list = o.next().children();
                        len = list.length;
                    }
                }
                o.attr('data-id', i);
            });
            max = i;

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
});
