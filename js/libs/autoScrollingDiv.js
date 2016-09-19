$(document).ready(function() {
    if (elementExists("column_1") && elementExists("column_3")) {
        calc_auto_scroll();
    }
});


function defineMax(elem_id) {
    var max = (getHeight("#column_2") - getHeight("#" + elem_id)) - 45;
//    console.log("MAX = " + max);
    return max;
}

function calc_auto_scroll() {
    $(function() {

        var SCROLL_DIV = "#autoScroll1";
        var OFFSET = $(SCROLL_DIV).offset();
        var MAX = 0;
        var COEFF_1 = 250;// Beggin scroll with delay

        $(window).scroll(function() {
            if (OFFSET === undefined) {
                return;
            }

            MAX = defineMax("autoScroll1");

            var key_val = ($(window).scrollTop() - OFFSET.top);

            if ($(window).scrollTop() > (OFFSET.top + COEFF_1) && key_val < MAX) {
                $(SCROLL_DIV).stop().animate({
                    marginTop: key_val
                });

            } else if (key_val > MAX) {
                $(SCROLL_DIV).stop().animate({
                    marginTop: MAX

                });
            }
            else {
                $(SCROLL_DIV).stop().animate({
                    marginTop: 0

                });

            }

        });

    });


    $(function() {

        var SCROLL_DIV = "#autoScroll2";
        var OFFSET = $(SCROLL_DIV).offset();
        var MAX = 0;
        var COEFF_1 = 250;// Beggin scroll with delay

        $(window).scroll(function() {
            if (OFFSET === undefined) {
                return;
            }

            MAX = defineMax("autoScroll2");

            var key_val = ($(window).scrollTop() - OFFSET.top);

            if ($(window).scrollTop() > (OFFSET.top + COEFF_1) && key_val < MAX) {
                $(SCROLL_DIV).stop().animate({
                    marginTop: key_val
                });

            } else if (key_val > MAX) {
                $(SCROLL_DIV).stop().animate({
                    marginTop: MAX
                });
            }
            else {
                $(SCROLL_DIV).stop().animate({
                    marginTop: 0
                });

            }

        });

    });
}




//IZNAHALNAJA VERSIJA
//$(function() {
//
//    var offset = $("#autoScroll2").offset();
//    var topPadding = -180;
//
//    $(window).scroll(function() {
//
//        if ($(window).scrollTop() > offset.top) {
//
//            $("#autoScroll2").stop().animate({
//                marginTop: $(window).scrollTop() - offset.top + topPadding
//
//            });
//
//        } else {
//
//            $("#autoScroll2").stop().animate({
//                marginTop: 0
//
//            });
//
//        }
//
//    });
//
//});