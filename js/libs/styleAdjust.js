$(document).ready(function() {
    go();
});


$(window).load(function() {
    addTransitonToNavBarBtns();
});


function go() {
    addEventToLogo();
    setElementsHeight();
    dontUnderlineLastArticle();
    dontUnderlineLastComment();
    dontShowColumn3ForSomeLinks();
    addVerificationToContactFormSubmitBtn();
}
//==============================================================================
function addEventToLogo() {
    var elem = document.getElementById("logo_mixcont");
    addEvent(elem, "click", returnToHomePage);
}
/**
 * This is very important method, look at (POST) method
 * @returns {undefined}
 */
function returnToHomePage() {
    GET("index.php", "link", "home");
//    openLinkInTheSameWindow("index.php?link=column_2_products");
}
//==============================================================================


//==============================================================================
/**
 * Important!
 * Caclulates columns height
 * @returns {undefined}
 */
function setElementsHeight() {
    //Calculate & set wrappers height
    var min_height = getHeight("#autoScroll1") + 100;

    var column_2_height = 0;

    if (elementExists("column_2")) {
        column_2_height = getHeight("#column_2");
    } else if(elementExists("column_2_temp")) {
        column_2_height = getHeight("#column_2_temp"); //"column_2_temp is used when only 1 col is shown instead of 3 as usual"
    }

    if (column_2_height < min_height) {
        column_2_height = min_height;
    }

    var set_wrapper_height = column_2_height + getHeight("#header") + getHeight("#footer") + 100;
    setHeightById("wrapper", set_wrapper_height);
    //Calculate & set columns heights
    var column_height = column_2_height + 20;
    setHeightById("column_1", column_height);
    setHeightById("column_2", column_height);
    setHeightById("column_3", column_height);
    //    writeLine("column_3", "" + height);
    setCSSProperty("#column_2_temp","width","90%");
    setCSSProperty("#column_2_temp","margin-left","auto");
    setCSSProperty("#column_2_temp","margin-right","auto");
}
//==============================================================================



//==============================================================================
function addVerificationToContactFormSubmitBtn() {
    if (elementExists("contactFormSubmitBtn") === false) {
        return;
    }

    var submit_btn_elem = document.getElementById("contactFormSubmitBtn");
    addEvent(submit_btn_elem, "click", preventDefaultActionContactFormSubmitBtn);
}

function preventDefaultActionContactFormSubmitBtn(evt) {
    var verification_nr = getRandomNumber();
    var user_input = getNumericValueByDialog("Type the nr you see in brackets [ " + verification_nr + " ] to verify!");

    if (verification_nr === user_input) {
        alert("Inquiry sent!");
        return;
    } else {
        evt.preventDefault();
        alert("Wrong!Please try again!");
    }

}

//==============================================================================



//==============================================================================

function get_language(){
    
}



//==============================================================================

function dontUnderlineLastComment() {
    if (classExists("comment") === false) {
        return;
    }
    var arr = $(".comment").get();
    var last_article_elem = arr[arr.length - 1];
    setCSSProperty(last_article_elem, "border-bottom-style", "none");
}

/**
 * 
 * @returns {undefined}
 */
function dontUnderlineLastArticle() {
    var arr = $(".column_2_article").get();
    var last_article_elem = arr[arr.length - 1];
    setCSSProperty(last_article_elem, "border-bottom-style", "none");

    arr = $(".column_2_article_presentation").get();
    last_article_elem = arr[arr.length - 1];
    setCSSProperty(last_article_elem, "border-bottom-style", "none");
}

/**
 * For examle for "_visitors.php" link
 * @returns {undefined}
 */
function dontShowColumn3ForSomeLinks() {
    if (classExists("publication") === false) {
        setCSSProperty("#column_2", "border-right", "none");
    }
}




//==============================================================================
//==============================================================================
//==============================================================================
//==============================================================================
//==============================================================================

function addScrollEvent() {
    addEventToTheDocument("scroll", setColumnsHeight);
}

//=====================================UNUSED=========================================
function addEventToPubPicturesHomePage() {
    addEventToAllElementsInsideParentElementWithGivenTagName_2("column_3", "img", "mouseover", hideParagraphPublication);
    addEventToAllElementsInsideParentElementWithGivenTagName_2("column_3", "img", "mouseout", unhideParagraphPublication);
}

function hideParagraphPublication(event) {
    var eventElement = getEventTargetElement(event);
    var parentElem = getParentElement(eventElement);
    setColorOfAnElementInsideParentElement(parentElem, "p", "white");
}

function unhideParagraphPublication(event) {
    var eventElement = getEventTargetElement(event);
    var parentElem = getParentElement(eventElement);
    setColorOfAnElementInsideParentElement(parentElem, "p", "black");
}

//==============================================================================





//addEvent(window, "load", go);