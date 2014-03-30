/**
 * Package for wilkomirski.org.pl
 *
 * version: 0.1
 * author: Piotr Wojciechowski :: piotr.wojciechowski@kontakt.waw.pl
 * create: 04-03-2014
 */

steal(
    'jquery.min.js',
    'widgets/sponsors.js',
    'widgets/sponsor_b.js',
function(jQuery){
    steal(
        'bootstrap/collapse.js'
    )
    /**
     * Top banner xx
     */
    $.fn.xx = function(param) {

        return this.each(function(){
            that = $(this);
            init();
        });
    };

    $(document).ready(function() {
        $('#mail a').click(function(){
            $('#mail .more').addClass('hide');
            $('#mail .text').removeClass('hide');
            return false;
        })
//        $('.sponsors').Sponsors();

        var im = $('#slideshow img');
        l = im.length,
            i = 0;
        //im.css({'position':'absolute'});
        im.eq(0).css({'top':0});
        function rotor(){
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
            xx=setTimeout(rotor,3000);
        }
        rotor();
    });

})

