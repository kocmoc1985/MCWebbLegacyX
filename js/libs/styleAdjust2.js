$(document).ready(function() {
    go2();
});


function go2() {
    add_event_to_langauge_flag_btns();
}

//=============================================================================

function add_event_to_langauge_flag_btns() {
    if (elementExists("choose_lang")) {
        addEventToAllElementsWithGivenClassName("country_flag","click",buttonEvent_1);
    }
}

function buttonEvent_1(evt) {
    var target_elem = getEventTargetElement(evt);
    var parent = target_elem;
    
    if(getTagName(target_elem) === "IMG"){
        parent = getParentElement(target_elem);
    }

    var link_and_lang = getTextToLower(parent);
    var arr = splitString(link_and_lang, ";");
    GET_2("index.php", "link", arr[0], "lang", arr[1]);
}

