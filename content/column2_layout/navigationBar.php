<?php

adjustNavBarAfterLink();
?>

<script language = "javascript" >
    $(document).ready(function() {
        go_navigation_bar_php();
    });


    $(window).load(function() {
        addTransitonToNavBarBtns();
    });

    function go_navigation_bar_php() {
        activateNavBar();
        markPressedNavBarBtn();
    }

    /**
     * This activates the buttons if the "navigationBar"
     * @returns {undefined}
     */
    function activateNavBar() {
        if (elementExists("navigationBar") === false) {
            return;
        }

        defineButtonsWidth("navBarButton");
        //add events to buttons
        addEventToClassesInsideParentElement("navigationBar", "navBarButton", "click", buttonEvent);
    }

    /**
     * Does that the buttons become like links with help of "POST or GET" method
     * @param {type} evt
     * @returns {undefined}
     */
    function buttonEvent(evt) {
        var link = "";
        var target_elem = getEventTargetElement(evt);

        if (getClassName(target_elem) === "navBarButton") {
            link = getTextToLower(target_elem);
            GET("index.php", "link", link);
        }
    }
    /**
     * calculates and sets the width of the buttons
     * @param {String} className
     * @returns {undefined}
     */
    function defineButtonsWidth(className) {
        var elemntArray = document.getElementsByClassName(className);
        var btn_width_in_procent = (100 / elemntArray.length);
        for (i = 0; i < elemntArray.length; i++) {
            var elem = elemntArray[i];
            setWidthByElementInProcent(elem, btn_width_in_procent);
        }
    }


    /**
     * 
     * @returns {undefined}
     */
    function markPressedNavBarBtn() {

        var last_pressed_nav_bar = getTextToLower(getElement("link"));
        var last_pressed_nav_bar_untranslated = getTextToLower(getElement("link_untranslated"));
        last_pressed_nav_bar_untranslated = stringReplaceAll(last_pressed_nav_bar_untranslated, /_/g, " ");

        var elemntArray = document.getElementsByClassName("navBarButton");
        for (i = 0; i < elemntArray.length; i++) {
            var curr_elem = elemntArray[i];
            var cur_elem_text = getTextToLower(curr_elem);
            if ((cur_elem_text === last_pressed_nav_bar) || (cur_elem_text === last_pressed_nav_bar_untranslated)) {
                setCSSProperty(curr_elem, "color", "#80EB14");
            }
        }
    }

    /**
     * The transitions must be added with js and on "$(document).ready" event
     * after all other js operations are done
     * @returns {undefined}
     */
    function addTransitonToNavBarBtns() {
        var btn_arr = document.getElementsByClassName("navBarButton");
        for (i = 0; i < btn_arr.length; i++) {
            var curr_elem = btn_arr[i];
            setCSSProperty(curr_elem, "-o-transition", "1s");
            setCSSProperty(curr_elem, "-ms-transition", "1s");
            setCSSProperty(curr_elem, "-moz-transition", "1s");
            setCSSProperty(curr_elem, "-webkit-transition", "1s");
            setCSSProperty(curr_elem, "transition", "1s");
        }
    }

</script>

<?php

function adjustNavBarAfterLink() {

    if (isset($_SESSION['link_session'])) {

        $link = str_replace("_", " ", $_SESSION['link_session']);

//        $link_to_low_case = strtolower($link);

        $lang = GET_LANG();
        if ($lang == lang_rus()) {
            basicSet_rus();
        } else {
            basicSet();
        }
    }
}

function basicSet() {
    $btn_name_arr = array(
        ucwords(home()),
        ucwords(products()),
        ucwords(faq()),
        ucwords(contacts()),
        ucwords(customers())
    );

    buildSet($btn_name_arr);
}

function basicSet_rus() {
    $btn_name_arr = array(
        ucwords(home_rus()),
        ucwords(products_rus()),
        ucwords(faq_rus()),
        ucwords(contacts_rus())
    );

    buildSet($btn_name_arr);
}

function buildSet($btn_name_arr) {
    for ($i = 0; $i < count($btn_name_arr); $i++) {
        echo "<div class='navBarButton'>";
        echo $btn_name_arr[$i];
        echo "</div>";
    }
}

//==========================================================================

function productsSet() {

    $btn_name_arr = array(
        ucwords(home()),
        ucwords(products()),
        ucwords(complete_solution()),
        ucwords(mixing_control()),
        ucwords(analysing_tools()),
        ucwords(laboratory()),
        ucwords(process_monitoring())
    );
    buildSet($btn_name_arr);
}

function analysingToolsSet() {
    $btn_name_arr = array(
        ucwords(home()),
        ucwords(products()),
        ucwords(analysing_tools()),
        ucwords(mcdetector()),
        ucwords(mctracker())
    );
    buildSet($btn_name_arr);
}

function processMonitoringSet() {
    $btn_name_arr = array(
        ucwords(home()),
        ucwords(products()),
        ucwords(process_monitoring()),
        ucwords(mcbrowser()),
//        ucwords(mcprocessmonitor()),
        ucwords(mcmillsbrowser())
    );
    buildSet($btn_name_arr);
}
?>

