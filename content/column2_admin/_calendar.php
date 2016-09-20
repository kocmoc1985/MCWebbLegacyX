<style type="text/css">
    #calendar_container_main{
        margin-left: auto;
        margin-right: auto;
        margin-top: 20px;
        width: 400px;
        height: auto;
        overflow: auto;
        padding: 15px 15px 15px 15px;
        background: bisque;

        -moz-border-radius: 0px 10px 10px 10px;
        -webkit-border-radius: 0px 10px 10px 10px;
        -khtml-border-radius: 0px 10px 10px 10px; 
        border-radius: 0px 10px 10px 10px; 
    }

    #calendar_container_dates{
        width: 100%;
        height: auto;
        overflow: auto;
        background: #F1FDC4;
        margin-top: 5px;
        padding-left: 10px;
        padding-bottom: 10px;
        padding-top: 5px;
    }
    /*******************************************************************************/
    .calendar_day{
        width: 40px;
        height: 40px;
        background: lightblue;
        float: left;
        margin-right: 2px;
        margin-top: 2px;
        font-weight: bold;

        -webkit-box-shadow: 0px 5px 5px 0px #444;
        -moz-box-shadow: 0px 5px 5px 0px #444;
        box-shadow: 0px 5px 5px 0px #444;

        /*Transition*/
        -o-transition:0.5s;
        -ms-transition:0.5s;
        -moz-transition:0.5s;
        -webkit-transition:0.5s;
        transition: 0.5s;
    }

    .calendar_day:hover{
        /*Drop shadow*/
        -webkit-box-shadow: 0px 0px 15px 0px #444;
        -moz-box-shadow: 0px 0px 15px 0px #2662DF;
        box-shadow: 0px 0px 15px 0px #2662DF;
        cursor: pointer;
        color: white;

        background: #7f858c; /* Old browsers */
        background: -moz-linear-gradient(top, #7f858c 0%, #828c95 5%, #28343b 100%); /* FF3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#7f858c), color-stop(5%,#828c95), color-stop(100%,#28343b)); /* Chrome,Safari4+ */
        background: -webkit-linear-gradient(top, #7f858c 0%,#828c95 5%,#28343b 100%); /* Chrome10+,Safari5.1+ */
        background: -o-linear-gradient(top, #7f858c 0%,#828c95 5%,#28343b 100%); /* Opera11.10+ */
        background: -ms-linear-gradient(top, #7f858c 0%,#828c95 5%,#28343b 100%); /* IE10+ */
    }

    .calendar_day_today,.calendar_day_reserved,.calendar_day_ocupied{
        width: 40px;
        height: 40px;
        float: left;
        margin-right: 2px;
        margin-top: 2px;
    }

    .calendar_day_today{
        background: white;
    }

    .calendar_day_reserved{
        background: orange;
    }

    .calendar_day_ocupied{
        background: red;
    }

    /***************************************************************************/
    #calendar_choose_month_year_container{
        display: block;
        /*width: 80%;*/
    }
    /***************************************************************************/

    #calendar_choose_year,#calendar_choose_month{
        display: inline-block;
        width: 80px;
        margin-right: 10px;

        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
        -khtml-border-radius: 5px; 
        border-radius: 5px; 
    }

    /***************************************************************************/

    #date_string{
        text-align: center;
        margin-top: 10px;
        margin-left: auto;
        margin-right: auto;
    }
    /***************************************************************************/

    #legend_container{
        display: inline-block;
        margin-top: 10px;
        margin-left: 2px;
    }

    #legend_ocupied, #legend_reserved, #legend_free{
        display: inline-block;
        /*width: 40px;*/
        height: 20px;
        margin-top: 5px;
        margin-right:10px;
        margin-left:2px;
        margin-top:2px;
        padding-left: 10px;
        padding-right: 10px;
        padding-bottom: 25px;
        color: white;
    }

    #legend_free{
        background: lightblue;
    }

    #legend_reserved{
        background: orange;
    }

    #legend_ocupied{
        background: red;
    }

</style>

<script language = "javascript">
    function date_get_current_year() {
        return new Date().getFullYear();
    }

    function date_get_months_names_arr() {
        var months = new Array(12);
        months[0] = "Jan";
        months[1] = "Feb";
        months[2] = "Mar";
        months[3] = "Apr";
        months[4] = "May";
        months[5] = "Jun";
        months[6] = "Jul";
        months[7] = "Aug";
        months[8] = "Sept";
        months[9] = "Okt";
        months[10] = "Nov";
        months[11] = "Dec";
        return months;
    }

    function date_get_current_month() {
        var month = new Date().getMonth();
        month++;
        return month;
    }

    function date_find_month_name_by_nr(month_nr) {
        var array = date_get_months_names_arr();
        return array[month_nr - 1];
    }

    function date_get_current_date() {
        return new Date().getDate();
    }

    function date_get_nr_days_in_month(month, year) {
        return new Date(year, month, 0).getDate();
    }
</script>

<script language = "javascript">
    var CURR_YEAR = date_get_current_year();
    var CURR_MONTH = date_get_current_month();
    var CURR_DAY = date_get_current_date();
    var CURR_DATE_CAL_1 = CURR_YEAR + "-" + CURR_MONTH + "-" + CURR_DAY;
    var RESERVED_DAYS_ARR = new Array();
    var OCUPIED_DAYS_ARR = new Array();


</script>

<script language = "javascript">
    //==========================================================================
    function build_calendar_ajax() {
        rebuild_date();
        //====
        RESERVED_DAYS_ARR = new Array();
        OCUPIED_DAYS_ARR = new Array();
        //====
        //Check "ocupied" days, ocupied means booked
        $.ajax({
            async: "true", //is true by default
            type: "GET",
            url: "ajax.php",
            data: {check_ocupied_days: "" + CURR_DATE_CAL_1, apartment: "example_1"}
        })
                .done(function(response) {
            handle_ajax_ocupied_days_response(response);
        });
        //===============================================
        //Check "reserved" days, reserved = not finally booked
        $.ajax({
            async: "true", //is true by default
            type: "GET",
            url: "ajax.php",
            data: {check_reserved_days: "" + CURR_DATE_CAL_1, apartment: "example_1"}
        })
                .done(function(response) {
            handle_ajax_reserved_days_response(response);
        });
        //====
    }

    /**
     * By "ocupied" i mean booked - the customer have prepayed for the order
     * @param {type} response
     * @returns {undefined}
     */
    function handle_ajax_ocupied_days_response(response) {
//        alert(response);
        OCUPIED_DAYS_ARR = splitString(response, ",");
    }

    /**
     * By "reserved" i mean the customer have placed an order but
     * haven't prepayed yet
     * @param {type} response
     * @returns {undefined}
     */
    function handle_ajax_reserved_days_response(response) {
//        alert(response);
        RESERVED_DAYS_ARR = splitString(response, ",");
        build_calendar();
    }

    //==========================================================================

</script>



<script language = "javascript">

    function build_calendar() {
        if (elementExists("calendar_container_dates")) {
            removeElementById("calendar_container_dates");
        }
        //==
        var days = date_get_nr_days_in_month(CURR_MONTH, CURR_YEAR);
        //==
        var calendar_container_dates = createElement("div");
        setAttribute(calendar_container_dates, "id", "calendar_container_dates");
        //==
        for (i = 1; i <= days; i++) {
            if (i === date_get_current_date() && CURR_MONTH === date_get_current_month()) { //Mark current day
                add_calendar_day_x("calendar_day_today", calendar_container_dates);
            } else if (check_if_day_reserved_or_ocupied(OCUPIED_DAYS_ARR, i)) {
                add_calendar_day_x("calendar_day_ocupied", calendar_container_dates);
            } else if (check_if_day_reserved_or_ocupied(RESERVED_DAYS_ARR, i)) {
                add_calendar_day_x("calendar_day_reserved", calendar_container_dates);
            } else {
                add_calendar_day_x("calendar_day", calendar_container_dates);
            }
        }
        //==
        var calendar_container_main = getElement("calendar_container_main");
        calendar_container_main.appendChild(calendar_container_dates);
        //==
        add_event_to_all_calendar_date_buttons();
        //==
//        show_date_string();
        //==
//        add_legend_under_calendar();
    }

    /**
     * 
     * @param {String} class_name
     * @param {Element} calendar_container_dates
     * @returns {undefined}
     */
    function add_calendar_day_x(class_name, calendar_container_dates) {
        var cal_day_elem = createElement("div");
        setAttribute(cal_day_elem, "class", class_name);
        //==
        var text = document.createTextNode("" + i);
        cal_day_elem.appendChild(text);
        //==
        calendar_container_dates.appendChild(cal_day_elem);
    }

    function add_event_to_all_calendar_date_buttons() {
        addEventToAllElementsWithGivenClassName("calendar_day", "click", calendar_date_btn_pressed);
    }

    function calendar_date_btn_pressed(evt) {
        umark_previous_marked_calendar_btns();
        mark_calendar_btn(evt);
        save_day(evt);
        show_date_string();
    }

    function check_if_day_reserved_or_ocupied(arr, day) {
        for (y = 0; y < arr.length; y++) {
            if (arr[y] === "" + day) {
                return true;
            }
        }
        return false;
    }

    //=========================================================================

    function add_calendar_components() {
        document.write("<div id='calendar_choose_month_year_container'>");
        //====
        document.write("<select id='calendar_choose_month'>");
        var array = date_get_months_names_arr();

        document.write("<option value='" + CURR_MONTH + "'>" + date_find_month_name_by_nr(CURR_MONTH) + "</option>");
        for (i = 0; i < array.length; i++) {
            if (CURR_MONTH !== (i + 1)) { // to skip having 2 names of current month
                document.write("<option value='" + (i + 1) + "'>" + array[i] + "</option>");
            }
        }
        document.write("</select>");
        //==
        var next = CURR_YEAR + 1;
        var next_next = CURR_YEAR + 2;
        //==
        document.write("<select id='calendar_choose_year'>");
        document.write("<option value='" + CURR_YEAR + "'>" + CURR_YEAR + "</option>");
        document.write("<option value='" + next + "'>" + next + "</option>");
        document.write("<option value='" + next_next + "'>" + next_next + "</option>");
        document.write("</select>");
        //==
        document.write("</div>");//calendar_choose_month_year_container

        //======================================================================
    }

    //=========================================================================

    function add_legend_under_calendar() {
        if (elementExists("legend_container")) {
            removeElementById("legend_container");
        }
        //==
        var legend_contaier = createElement("div");
        setAttribute(legend_contaier, "id", "legend_container");
        //==
        var legend_free = createElement("div");
        setAttribute(legend_free, "id", "legend_free");

        var legend_reserved = createElement("div");
        setAttribute(legend_reserved, "id", "legend_reserved");

        var legend_ocupied = createElement("div");
        setAttribute(legend_ocupied, "id", "legend_ocupied");

        //==
        legend_contaier.appendChild(legend_free);
        legend_contaier.appendChild(legend_reserved);
        legend_contaier.appendChild(legend_ocupied);
        //=====

        var container_dates = getElement("calendar_container_dates");

        insertAfter(legend_contaier, container_dates);

        //==
        setText("legend_free", "free");
        setText("legend_reserved", "pre-booked");
        setText("legend_ocupied", "booked");
    }

    function show_date_string() {
        rebuild_date();
        removeElementById("date_string");
        //===
        var date_str_elem = createElement("div");
        setAttribute(date_str_elem, "id", "date_string");
        //===
        var text = document.createTextNode("" + CURR_DATE_CAL_1 + " (" + date_get_month_name_eng(CURR_MONTH) + ")");
        date_str_elem.appendChild(text);
        //===
        var calendar_container_main = getElement("calendar_container_main");
        calendar_container_main.appendChild(date_str_elem);
    }

    //=========================================================================

    function rebuild_date() {
        CURR_DATE_CAL_1 = CURR_YEAR + "-" + date_get_month_corrected(CURR_MONTH) + "-" + date_get_day_corrected(CURR_DAY);
    }

</script>

<div id="calendar_container_main">

    <script language = "javascript">
        add_calendar_components();
//        build_calendar_ajax();
        build_calendar();
    </script>

</div>


<script language = "javascript">

    $(document).ready(function() {
        add_event_to_choose_month_combobox();
        add_event_to_choose_year_combobox();
    });
    //==========================================================================



    //==========================================================================
    /**
     * 
     * @returns {undefined}
     */
    function add_event_to_choose_year_combobox() {
        var combo_box_elem = getElement("calendar_choose_year");
        addEvent(combo_box_elem, "click", year_chosen);
    }

    function year_chosen(evt) {
        var year = getTextFromAtextElement("calendar_choose_year");
        if (year === "" + CURR_YEAR) {
            return;
        } else {
            CURR_YEAR = year;
            build_calendar_ajax();
        }
    }

    //================

    function add_event_to_choose_month_combobox() {
        var combo_box_elem = getElement("calendar_choose_month");
        addEvent(combo_box_elem, "click", month_chosen);
    }

    function month_chosen(evt) {
        var month = $(getEventTargetElement(evt)).val();
        if (month === "" + CURR_MONTH) {
            return;
        } else {
            CURR_MONTH = month;
            build_calendar_ajax();
        }
    }

    //==========================================================================
    function save_day(evt) {
        var Element = getEventTargetElement(evt);
        var day = getText(Element);
        CURR_DAY = day;
    }

    function mark_calendar_btn(evt) {
        var Element = getEventTargetElement(evt);
        setCSSProperty(Element, "background-color", "white");
    }

    function umark_previous_marked_calendar_btns() {
        var elem_arr = getElementsArrByClass("calendar_day");
        //==
        for (i = 0; i < elem_arr.length; i++) {
            var elem = elem_arr[i];
            setCSSProperty(elem, "background-color", "lightblue");
        }
    }

    //==========================================================================

</script>
