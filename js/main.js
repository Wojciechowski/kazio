/**
 * Package for wilkomirski.org.pl
 *
 * version: 0.1
 * author: Piotr Wojciechowski :: piotr.wojciechowski@kontakt.waw.pl
 * create: 04-03-2014
 */

(function($) {
    /**
     * Top banner Sponsors
     */
    $.fn.Sponsors = function(param) {
        param = {
            timer: 800,
            pause: 2000
        }

        var that, ul, tim, height,

            move2 = function(o){
                o.css({'margin-top': height * -1});
                o.animate({
                    'margin-top': 0
                }, param.timer, function(){
                    tim = setTimeout(rotor, param.pause);
                });
            },

            rotor = function(){
                console.log('a');
                var ul = $('ul', that),
                    activ = $('.active', ul),
                    next = activ.next(),
                    parent = activ.parent();

                height = ul.height();
                parent.animate({
                    'margin-top': height
                }, param.timer, function(){
                    console.log('a1');
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
                var sponsor,
                    padd = 10,
                    i = 0;

                ul = $('ul', that);
                $('.sponsors-li', that).children().each(function(){
                    if (!$(this).is('ul')) {
                        sponsor = $(this).text();
                    } else {
                        $(this).attr('data-sponsor', sponsor);
                        if ($('.active', this).is('li')) {
                            $('.spons-h').html(sponsor + ':');
                        }
                    }
                })
                $('.imagemask', ul).each(function(){ // zamienić na 'img'
                    $(this).parent().css('padding-left', ($(this).outerWidth() + padd) + 'px');
                    $(this).wrap('<span class="brand"/>');
                })
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
}(jQuery));

