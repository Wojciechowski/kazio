/**
 * User: Piotr Wojciechowski
 * Date: 24.05.14
 * Version: 1.0
 */

$(document).ready(function(){
    var cname = 'ie8',
        statement = '<h3>Używasz przestarzałej przeglądarki !</h3>' +
            'Jeśli w Twoim systemie nie da się upgradować IE do wersji 9, 10 lub 11,<br>' +
            'to uruchom naszą stronę na przeglądarce Google Chrome, Firefox lub Opera.<br>' +
            'Zyskasz lepszą jakość !',
        btn = $('<button>x</button>').click(function(){
            $('#ie8').animate({top: '-150px'});
            $('#veilIe8').animate({opacity: 0}, 300, function(){
                $(this).css('display','none');
            });
            document.cookie = cname + "=close";
        }),

        getCookie = function(){
            var name = cname + "=",
                ca = document.cookie.split(';');

            for(var i=0; i<ca.length; i++)
            {
                var c = ca[i];//.trim();
                if (c.indexOf(name)==0) return;
            }
            $('body').append($('<div id="veilIe8"/>').css('opacity',.3), $('<div id="ie8"/>').append(statement, btn));
        };

    getCookie();
})