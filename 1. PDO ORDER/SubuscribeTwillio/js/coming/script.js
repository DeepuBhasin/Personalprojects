/*
:: Project Name : BiBOG
:: Project URI: https://bion.nhatgroup.com/bibog
:: Description: BiBog - Blog HTML5 Template
:: Project Date: 05-03-2017
:: Version: 1.0
:: Author: BionThemes
:: Author Website : https://bion.nhatgroup.com/
*/
$(document).ready(function() {
    $(window).on("load", function() {
        $("#loading").fadeOut(500);
    });
    var comingPage = $("#coming-soon");
    comingPage.css({
        'height': window.innerHeight
    });
    $(window).on('resize', function() {
        comingPage.css({
            'height': window.innerHeight
        });
    });
    var countDown = $('#countdown');
    countDown.countdown('2018/01/01', function(event) {
        $(this).html(event.strftime('<div class="days count-down"><div class="inner"><span class="number">%-D</span><span class="string">%!D:Day,Days;</span></div></div> <div class="hours count-down"><div class="inner"><span class="number">%H</span><span class="string">%!H:Hour,Hours;</span></div> </div><div class="minutes count-down"><div class="inner"><span class="number">%M</span><span class="string">%!M:Minute,Minutes;</span></div> </div><div class="seconds count-down"><div class="inner"><span class="number">%S</span><span class="string">%!S:Second,Seconds;</span></div> </div>'));
    });
});