/**
 * Package for wilkomirski.org.pl
 *
 * version: 0.1
 * author: Piotr Wojciechowski :: piotr.wojciechowski@kontakt.waw.pl
 * create: 04-03-2014
 */

steal(
    'js/jquery.min.js',
    'js/widgets/sponsors.js',
function(jQuery){
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
//        $('.sponsors').Sponsors();
    });

})

