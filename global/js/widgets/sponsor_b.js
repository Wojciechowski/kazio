/*******************************************************
 *  serwis Towarzystwa Muzycznego im. K. Wiłkomirskiego
 *  www.wilkomirski.org.pl
 *
 *  autor: Piotr Wojciechowski
 *         piotr.wojciechowski@kontakt.waw.pl
 *                                                                 
 *  wykonana: 23.06.2013
 ******************************************************/

steal(
    'jquery.min.js',
function(jQuery){
    $(document).ready(function(){
        if ($(window).width() > 500 && $('#sponsors').is('div')) {
            var i = -1,
                time = 500,
                block = $('#sponsors .blok'),
                list = $('h2', block),
                len = list.length,
                aList = [];

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

            function sponsorBottom(){
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
            };
            sponsorBottom();

        }
    })

})
