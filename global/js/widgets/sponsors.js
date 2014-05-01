/**
 * Package for wilkomirski.org.pl
 *
 * version: 1.0
 * author: Piotr Wojciechowski :: piotr.wojciechowski@kontakt.waw.pl
 * create: 27-04-2014
 */

/**
 * Top banner Sponsors
 */
$.fn.Sponsors = function(param) {
    param = {
        padd: 10,
        timer: 800,
        pause: 2000,
        w_start: 45
    }

    var that, header_box, headers, list_box, go, tim,
        action = 0,

        /**
         * uruchamianie/zatrzymywanie animacji
         */
        start = function(){
            var height = list_box.innerHeight();

            if (height > 0 && height < param.w_start) {
                console.log('start ', height);
                if (action == 0) {
                    tim = setTimeout(rotor, param.pause);
                    action++;
                }
            } else {
                clearTimeout(tim);
                action = 0;
                console.log('stop ', height, param.w_start+'px');
            }
        },

        /**
         * rotowanie napisów
         */
        rotor = function(){
            $('.end', list_box).removeClass('start end');

            var activ = $('.start', list_box),
                next = activ.next();

            activ.addClass('end');
            if (next.is('li')) {
                // kolejna pozycja w grupie
                next.addClass('start');
            } else {
                // zmiana grupy
                var header_e = headers.filter('.end').removeClass('start'),
                    header_s = headers.filter('.start'),
                    header_n = header_s.next(),
                    nr = header_s.attr('data-id') * 1 + 1,
                    px = 0,
                    pos;

                header_s.addClass('end');
                if (!header_n.is('span')) {
                    // i od początku
                    nr = 0;
                    header_n = header_s.siblings('span[data-id="'+nr+'"]');
                }
                var ul = $('ul[data-id="'+nr+'"]', list_box);

                header_n.addClass('start');
                ul.children(':first').addClass('start');
                header_e.removeClass('end');
            }
            tim = setTimeout(rotor, param.pause);
        },

        /**
         * Inicjowanie banera
         */
        init = function(){
            var div = that.children();
            header_box = div.filter('.sponsors-h'); // leawa kolumna (tytuły)
            list_box = div.filter('.sponsors-li'); // prawa kolumna (treść)

            var data = list_box.children(), // wsystkie p i ul
                header = header_box.children('.spons-h'),
                i = -1,
                header_n = $('');

            data.each(function(){
                var o = $(this);

                if (o.is('p')) {
                    // dodanie nowego pojemnika
                    if (header_n.is('span')) {
                        header.after(header_n);
                        header = header_n;
                    }

                    // inicjowanie tytułu
                    i++;
                    header.html(o.text()).attr('data-id', i);
                    header_n = header.clone();

                    // jeśli pierwszy
                    if (!go) {
                        header.addClass('start');
                    }
                } else { // ul
                    o.children().each(function(){
                        var img = $('.foto_0', this).detach(),
                            html = $(this).html();

                        $(this).html($('<span/>').html(html)).prepend(img);
                    });
                    if (!go) {
                        o.children().first().addClass('start');
                        go = 1;
                    }
                }
                o.attr('data-id', i);
            });
            headers = header_box.children('.spons-h');

            start();

            $(window).resize(function(){
                start();
            });
        };


    return this.each(function(){
        that = $(this);
        init();
    });
};

$(document).ready(function() {
    $('.sponsors').Sponsors();
});
