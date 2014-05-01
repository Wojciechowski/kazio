/*******************************************************
 *  serwis Towarzystwa Muzycznego im. K. Wiłkomirskiego
 *  www.wilkomirski.org.pl
 *
 *  autor: Piotr Wojciechowski
 *         piotr.wojciechowski@kontakt.waw.pl
 *                                                                 
 *  wykonana: 23.06.2013
 ******************************************************/

$.fn.Patrons = function(param){
    param = {
        time: 500,
        pause: 2000,
        w_start: 45
    }

    var that, etc,
        i = -1,
        j = 0,
        action = 0,
        tList = [],
        tListL = 0,
        aList = {},
        aListL = [],

        rotate = function(){
            var o = $('a.active', that);

            console.log('t ', o.is('a'));
            if (o.is('a')){
                o.removeClass('active');
            }
            j++;
            if (j >= aListL[i]) {
                j = -1;
                if (tListL > 1) {
                    var activ = tList[i],
                        height = activ.height();

                    i++;
                    if (i == tListL) {
                        i = 0;
                    }
                    activ.animate({
                        bottom: height * -1
                    },300, function(){
                        activ.removeClass('active');
                        tList[i].addClass('active');
                        rotate();
                    });
                } else {
                    rotate();
                }
            } else {
                var activ = aList[i][j];

                activ.addClass('active').css('right', (activ.width() + 30) * -1).animate({
                    right: 0
                }, 1500, function(){
                    activ.css('opacity', 1).animate({
                        opacity: 0
                    }, 700, function(){
                        etc = setTimeout(rotate, param.time);
                    })
                });
            }
        },

        start = function(){
            var pos = that.css('position');

            console.log('start ', action, pos);
            if (pos == 'fixed') {
                if (action == 0) {
                    rotate();
                    action++;
                }
            } else {
                $('a.active', this).stop(true, true);
                etc = undefined;
                action = 0;
            }
        },

        init = function(){
            var block = $('.blok', that);

            block.children().each(function(){
                var o = $(this);

                if (o.is('h2')) {
                    i++;
                    tList[i] = o;
                    aList[i] = [];
                    aListL[i] = 0;
                } else if (o.is('a')) {
//                    o.css('right', (o.width() + 10) * -1);
                    aList[i].push(o);
                    aListL[i]++;
                }
            })
            tListL = tList.length;
            i = 0;
            tList[i].addClass('active');

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
    /*var spons = $('#sponsors'),
        i = -1,
        time = 500,
        block = $('#sponsors .blok'),
        list = $('h2', block),
        len = list.length,
        aList = [],
        action = 0,
        etc,

        sponsorBottom = function(){
            if (j == aLen) {
                j = 0;
                if (len > 1) {
                    list.eq(i).animate({
                        opacity: 0
                    },700,function(){
                        i++;
                        if (i == len) i = 0;
                        w = list.eq(i).outerWidth() * -1;
                        list.eq(i).css({left:0, opacity:1}).animate({
                            left: w
                        },1500,function(){
                            etc = setTimeout(sponsorBottom, time);
                        })
                    });
                    return;
                }
            }
            var o = aList[i][j],
                w = o.width() * -1 - 10;

            o.css({opacity: 1}).animate({
                left: w - 25
            },1000,'linear').animate({
                left: w - 25
            },2000,'linear').animate({
                opacity: 0
            },1000,'linear',function(){
                o.css({left: 0});
                etc = setTimeout(sponsorBottom, time);
            });
            j++;
        },

        start = function(){
            var pos = spons.css('position');

            console.log('t ', pos);
            if (pos == 'fixed') {
                if (action == 0) {
//                    console.log('start');
                    sponsorBottom();
                    action++;
                }
            } else {
                console.log('stop');
                list.each(function(){
                    $(this).stop(true, true);
                });
                etc = undefined;
                action = 0;
            }
        };

    if (len > 1) {
        block.children().each(function(){
            var o = $(this);
            if (o.is('a')) {
                aList[i].push(o.css({
                    opacity: 0,
                    left: 0,
                    bottom: 25
                }));
            } else if (o.is('h2')) {
                i++;
                aList[i] = Array();
            }
        });
    } else {
        aList[0] = Array();
        $('a', block).each(function(){
            aList[0].push($(this).css({
                opacity: 0,
                left: 0,
                bottom: 25
            }));
        })
        list.eq(0).css({left: list.eq(i).outerWidth() * -1, opacity: 1});
        i = 0;
    }
    var aLen = aList[0].length,
        j = aLen;


    start();*/
    $('#sponsors').Patrons();
})
