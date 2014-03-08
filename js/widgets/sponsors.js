/**
 * Package for wilkomirski.org.pl
 *
 * version: 0.1
 * author: Piotr Wojciechowski :: piotr.wojciechowski@kontakt.waw.pl
 * create: 04-03-2014
 */

steal('js/jquery.min.js', function(jQuery){
    /**
     * Top banner Sponsors
     */
    $.fn.Sponsors = function(param) {
        param = {
            padd: 10,
            timer: 800,
            pause: 2000
        }

        var that, ul, tim, height,

            move2 = function(o){
                o.css({'margin-top': height * -1});
                if ($('.active', o).css('padding-left') == param.padd + 'px') {
                    $('.active', o).css('padding-left', $('.active img', o).width() + param.padd);
                }
                o.animate({
                    'margin-top': 0
                }, param.timer, function(){
                    tim = setTimeout(rotor, param.pause);
                });
            },

            rotor = function(){
                var ul = $('ul', that),
                    activ = $('.active', ul),
                    next = activ.next(),
                    parent = activ.parent();

                height = ul.height();
                parent.animate({
                    'margin-top': height
                }, param.timer, function(){
                    activ.removeClass('active');
                    if (next.is('li')) {
                        next.addClass('active');
                        move2(parent);
                    } else {
                        var span = $('.spons-h');

                        parent = ul.eq(ul.index(parent) + 1);
                        if (!parent.is('ul')) {
                            parent = ul.eq(0);
                        }
                        next = $('li:first-child', parent);
                        parent.css({'margin-top': height * -1});
                        next.addClass('active');
                        span.animate({
                            'margin-top': height
                        }, param.timer, function(){
                            span.css({'margin-top': height * -1}).html(parent.attr('data-sponsor') + ':').animate({
                                'margin-top': 0
                            }, param.timer, function(){
                                move2(parent);
                            });
                        });

                    }
                });
            },

            init = function(){
                ul = $('ul', that);

                var sponsor,
                    img = $('img', ul),
                    i = 0,

                    brand = function(){
                        img.each(function(){
                            if (img.index($(this)) == 0 && $(this).outerWidth() == 0) {
                                setTimeout(brand, 50);
                                return;
                            }
                            $(this).parent().css('padding-left', ($(this).outerWidth() + param.padd) + 'px');
                            $(this).wrap('<span class="brand"/>');
                        })
                    };

                $('.sponsors-li', that).children().each(function(){
                    if (!$(this).is('ul')) {
                        sponsor = $(this).text();
                    } else {
                        $(this).attr('data-sponsor', sponsor);
                        if ($('.active', this).is('li')) {
                            $('.spons-h').html(sponsor + ':');
                        }
                    }
                });
                brand();
                if (!$('.active', ul).is('li')) {
                    sponsor = $('ul:first-of-type li:first').addClass('active').parent().attr('data-sponsor');
                    $('.spons-h').html(sponsor + ':');
                }

                tim = setTimeout(rotor, 1000);
            };



        return this.each(function(){
            that = $(this);
            init();
        });
    };

    $(document).ready(function() {
        $('.sponsors').Sponsors();
    });

})

