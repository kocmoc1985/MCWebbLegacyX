<style type="text/css">
    .table_style_1{
        padding-right: 10px;
        margin-top: 10px;
        width: 100%;
    }

    .table_style_1 td{
        border-style: inset;
        border-width: 1px;
        /*width: 20%;*/
        padding-left: 10px;
    }

    .table_style_1 th{
        padding-top: 10px;
        padding-bottom: 5px;
        font-size: 10pt;
    }

    .paint_opc{
        font-size: 9pt;
        width: 30%;
    }

    .delimiter_opc_td{
        border-style: none !important;
        font-weight: bold;
        font-size:10pt;
        padding-top: 15px;
        padding-bottom: 15px;
    }

    /*========================================================================*/

    .table_style_2{
        float: left;
        margin-right: 5px;
    }

    .table_style_2 td{
        border-style: solid;
        border-width: 1px;
        width: 20%;
        padding-left: 10px;
    }

    .table_style_2 th{
        padding-top: 10px;
        padding-bottom: 5px;
    }

    .table_style_2 label{
        font-size: 10pt;
    }

    /*========================================================================*/

    .opc_signals_link{
        clear: left;
        margin-left: 20px;
    }

    .show_hide_btn{
        margin-top: 10px;
        float: right;
        margin-right: 10px;
    }

</style>

<?php
//
$TABLE_HEADERS_1 = array("OPC tag", "Signal type", "Input/Output", "Range");
$TABLE_HEADERS_2 = array("Signal name", "OPC tag", "Signal type", "Input/Output", "Range", "Comment");
$ADD_PARAMS_TO_DISPLAY = array("type", "I/O");
//
//
$HIDDEN_INPUT_NAME = "opc_signals_string";
//
//
if (isset($_SESSION['company_name_opc']) == false) {
    $_SESSION['company_name_opc'] = "default";
}
//
if (isset($_GET['company_short_name_opc'])) {
    $_SESSION['company_name_opc'] = $_GET['company_short_name_opc'];
}
//
?>

<h2 style="text-align: center">OPC Signals Interface</h2>

<div class="fill_in_opc" id="add_form" style="width: 100%">
    <!--<img src="images/xxx.png" alt="contact_envelope_1">-->
    <button class="show_hide_btn"  type="button">show/hide</button>
    <h3>OPC Signals table (Create new)</h3>

    <form action="submit.php" method="post" id="add_opc_signals">
        <?php
        $arr = file_to_array_with_json_entries($_SESSION['company_name_opc']);
        create_table_to_be_filled($arr, $TABLE_HEADERS_1);
        $SIGNALS_STR = build_signal_names_string($arr);
        $SIGNALS_ARR = build_signal_names_array($arr);
        ?>
        <input class="cfinset" type="hidden" value ="<?php echo $SIGNALS_STR ?>" name="<?php echo $HIDDEN_INPUT_NAME ?>" >
        <input id="add_formSubmitBtn" type="submit" value="Submit">
    </form>
</div>

<?php
$FILE_TO_EDIT = "";
//
if (isset($_GET['file_to_edit'])) {
    $FILE_TO_EDIT = $_GET['file_to_edit'];
    display_or_edit_filled_signals_files($FILE_TO_EDIT, $TABLE_HEADERS_2, $ADD_PARAMS_TO_DISPLAY, 2, $SIGNALS_STR, $HIDDEN_INPUT_NAME, $SIGNALS_ARR);
} else {
    display_or_edit_filled_signals_files($_SESSION['company_name_opc'], $TABLE_HEADERS_2, $ADD_PARAMS_TO_DISPLAY, 1, "", "", $SIGNALS_ARR);
}

//
//
add_file_browser_opc_signals_component($_SESSION['company_name_opc']);
//
?>

<script language = "javascript">
    $(document).ready(function() {
        paint_row("paint_opc");
        switch_position();
        addEventToAllElementsWithGivenClassName("show_hide_btn", "click", slide_up_down);
        hide_create_new_if_filled_files_exists();
    });


    function hide_create_new_if_filled_files_exists() {
        if (classExists("opc_signals_link")) {
            //
            var elem_to_slide;
            //
            var elements = getElementsArrByClass("fill_in_opc");
            var parent = elements[0];
            //
            var arr = getAllChildrenOfAnElement(parent);
            //
            for (i = 0; i < arr.length; i++) {
                var curr_elem = arr[i];
                if (getTagName(curr_elem) === "FORM") {
                    //
                    var arr_2 = getAllChildrenOfAnElement(curr_elem);
                    //
                    for (i = 0; i < arr_2.length; i++) {
                        var curr_elem_2 = arr_2[i];
                        if (getTagName(curr_elem_2) === "TABLE") {
                            elem_to_slide = curr_elem_2;
                        }
                    }
                }
            }
            //
            if ($(elem_to_slide).is(':visible')) {
                $(elem_to_slide).slideUp();
            } else {
                $(elem_to_slide).slideDown();
            }
        }
    }


    function paint_row(elements_class) {
        var arr = getElementsArrByClass(elements_class);
        for (i = 0; i < arr.length; i++) {
            var curr_elem = arr[i];
            var curr_elem_text = getText(curr_elem);
            //
            var curr_elem_text_2 = getAttributeValue(curr_elem, "value");

            //This section is for the edditing mode
            if (curr_elem_text_2 !== null && curr_elem_text_2.length > 0) {
                curr_elem_text = curr_elem_text_2;
            }
            //
            //
            var parent = getParentElement(curr_elem);
            //
            if (curr_elem_text.indexOf("$") > -1) {
                setCSSProperty(parent, "background-color", "lightgreen");
            } else if (curr_elem_text.indexOf("#") > -1) {
                setCSSProperty(parent, "background-color", "#F97A6C");
            } else if (curr_elem_text.indexOf("&") > -1) {
                setCSSProperty(parent, "background-color", "yellow");
            }
        }
    }

    function switch_position() {
        if (classExists("show_opc_interface") === false) {
            return;
        }
        //
        var arr = getElementsArrByClass("show_opc_interface");
        //
        var arr_ = getElementsArrByClass("fill_in_opc");
        var elem_before_which_to_insert = arr_[0];
        //
        for (i = 0; i < arr.length; i++) {
            var curr_elem = arr[i];
            insertAfter(elem_before_which_to_insert, curr_elem);
        }
    }

    function slide_up_down(evt) {
        var target = getEventTargetElement(evt);
        var elem_to_slide;

        var parent = getParentElement(target);
        var elemntArray = getAllChildrenOfAnElement(parent);
        //

        //
        for (i = 0; i < elemntArray.length; i++) {
            var curr_elem = elemntArray[i];
            if (getTagName(curr_elem) === "TABLE") {
                elem_to_slide = curr_elem;
            } else if (getTagName(curr_elem) === "FORM") {
                //
                var arr = getAllChildrenOfAnElement(curr_elem);
                //
                for (i = 0; i < arr.length; i++) {
                    var curr_elem_2 = arr[i];
//                    alert("!" + getTagName(curr_elem_2));
                    if (getTagName(curr_elem_2) === "TABLE") {
                        elem_to_slide = curr_elem_2;
                    }
                }
            }
        }
        //
        if ($(elem_to_slide).is(':visible')) {
            $(elem_to_slide).slideUp();
        } else {
            $(elem_to_slide).slideDown();
        }
    }

</script>



<?php

/**
 * Reads from file and creates an array containing json formatted strings
 * @param type $company_short_name
 * @return array
 */
function file_to_array_with_json_entries($company_short_name) {
    //
    $file_path = opc_signals_get_path_1() . $company_short_name . ".txt";
    //
    if (file_exists($file_path) == false) {
        $file_path = opc_signals_get_path_1() . "default" . ".txt";
//        echo "<h4>File missing: $company_short_name.txt -> using default.txt file</h4>";
    }
    //
    //
    $file = fopen($file_path, "r");
    //
    //
    $json_entries_arr = array();
    //
    //
    while (!feof($file)) {
        //
        $json_entry = fgets($file);
        //
        if (strlen($json_entry) != 0) {
            array_push($json_entries_arr, $json_entry);
        }
        //
    }
    fclose($file);
    //
    return $json_entries_arr;
}

/**
 * Creates the table which should be filled in
 * @param type $array_with_json_entries - array containing json formatted strings
 */
function create_table_to_be_filled($array_with_json_entries, $table_headers) {
    echo "<table id='table_to_fill' class='table_style_2'>";
    //
    //
    echo "<tr>";
    echo "<td style='border-style:none'>";
    echo "<label style='font-weight:normal; font-size:11pt'>Customer</label>";
    $t1 = "Specify the company name, can be leaved empty";
    echo "<input class='cfinset' title='$t1' type='text' name='for_which_company' size='30'>";
    echo "</td>";
    echo "</tr>";
    //
    //
    echo "<tr>";
    echo "<td style='border-style:none'>";
    echo "<label style='font-weight:normal; font-size:11pt'>Line</label>";
    $t2 = "Specify mixing line, can be leaved empty";
    echo "<input class='cfinset' title='$t2' type='text' name='for_which_line' size='30'>";
    echo "</td>";
    echo "</tr>";
    //
    //
    echo "<tr>";
    foreach ($table_headers as $header) {
        echo "<th>$header</th>";
    }
    //
    echo "</tr>";
    //
    //
    foreach ($array_with_json_entries as $json_string) {
        //
        $json_arr = (array) json_decode($json_string);
        //
        echo "<tr>";
        //
        $signal_value = "";
        //
        foreach ($json_arr as $key => $value) {
            //
            if ($key == "signal") {
                echo "<td>";
                echo "<label style='font-weight:normal; font-size:11pt'>$value</label>";
                $description = $json_arr['description'];
                echo "<input title='$description' class='cfinset' type='text' name=$value size='30' >";
                echo "</td>";
                //
                $signal_value = $value;
                //
            } else if ($key == "description") {
                //do nothing
            } else if ($key == "range") {
                echo "<td>";
                $name = $signal_value . "_" . $key; //ex: BATCH_MC_MODE_range
                echo "<input class='cfinset' title='example: 0..100' type='text' name=$name value='$value' size='10' >";
                echo "</td>";
            } else {
                echo "<td >$value</td>";
            }
        }
        //
        echo "</tr>";
        //
        display_category_delimiters($signal_value);
        //
    }
    //
    //
    echo "</table>";
}

function build_signal_names_string($array_with_json_entries) {
    //
    $string_to_return = "";
    //
    foreach ($array_with_json_entries as $json_string) {
        //
        $json_arr = (array) json_decode($json_string);
        //
        $string_to_return .= $json_arr["signal"] . ";";
        //
    }
    return $string_to_return;
}

function build_signal_names_array($array_with_json_entries) {
    //
    $signal_names_arr = array();
    //
    foreach ($array_with_json_entries as $json_string) {
        //
        $json_arr = (array) json_decode($json_string);
        //
        array_push($signal_names_arr, $json_arr["signal"]);
        //
    }
    return $signal_names_arr;
}

/**
 * Read "filled in" files and diplay in table
 * @param type $company_short_name_or_file_name
 * @param type $table_headers
 * @param type $additional_parameters_to_display
 * @param type $mode - mode = 1 -> display mode, mode = 2 -> edit moder
 * @param form_param_1
 * @param form_param_2
 * @param signals_arr
 */
function display_or_edit_filled_signals_files($company_short_name_or_file_name, $table_headers, $additional_parameters_to_display, $mode, $form_param_1, $form_param_2, $signals_arr) {
    //
    $path = opc_signals_get_path_2();
    //
    if (file_exists($path) == false) {
        echo "<h4>Directory missing: $path </h4>";
        exit();
    }
    //
    if ($handle = opendir($path)) {

        while (false !== ($file = readdir($handle))) {

//            echo "$_file_or_dir <br>";
            //
            $pass = false;
            if ($mode == 1) {
                $pass = strstr($file, $company_short_name_or_file_name . "_");
            } else if ($mode == 2) {
                $pass = strstr($file, $company_short_name_or_file_name);
            }
            //
            //
            if ($pass) {
                //
                $last_modified_date = date("F d Y H:i:s", filemtime("$path./$file"));
                //
                echo "<div class='show_opc_interface' id='add_form' style='width: 100%'>";
                //
                echo " <button class='show_hide_btn' type=¨'button'>show/hide</button>";
                //
                $file_no_ext = str_replace(".txt", "", $file);
                echo "<h3> $file_no_ext ($last_modified_date) </h3>";
                //
                echo "<a class='opc_signals_link' href='$path./$file' target='blank_'>Get file</a>";
                echo "<a class='opc_signals_link' href='index.php?link=_opc_signals&amp;file_to_edit=$file'>Edit</a>";
                //
                echo "<table id='table_filled' class='table_style_1'>";
                //
                //
                echo "<tr>";
                foreach ($table_headers as $header) {
                    echo "<th>$header</th>";
                }
                echo "</tr>";
                //
                //
                //
                if ($mode == 1) {
                    display_filled_signals_files_continue($file, $additional_parameters_to_display, $mode, $signals_arr);
                } else if ($mode == 2) {
                    echo "<form action='submit.php' method='post'>";
                    display_filled_signals_files_continue($file, $additional_parameters_to_display, $mode, $signals_arr);
                    echo "<input type='hidden' value='$form_param_1' name='$form_param_2'>";
                    echo "<input type='hidden' value='$file' name='save_path_opc_signals'>";
                    echo "<input type='submit' value='Submit' margin-left:10px;'>";
                    echo "</form>";
                }
                //
                echo "</table>";
                //
                //
                echo "</div>";
                //
            //
            }
        }
        closedir($handle);
    }
}

/**
 * 
 * @param type $file_name
 * @param type $additional_parameters_to_display
 * @param $mode - mode = 1 -> display mode, mode = 2 -> edit mode
 */
function display_filled_signals_files_continue($file_name, $additional_parameters_to_display, $mode, $signals_arr) {
    $file_path = opc_signals_get_path_2() . $file_name;
    $file = fopen($file_path, "r");
    //
    //
    //
    while (!feof($file)) {
        //
        $json_entry = fgets($file);
        //
        $json_arr = (array) json_decode($json_entry);
        //
        //
        echo "<tr>";
        //
        $prev_key = "";
        //
        foreach ($json_arr as $key => $value) {
            //
//            echo "key = $key<br>";
            //
            //Removing the empty entry
            if ($key == "_empty_") {
                break;
            }
            //
            //
            // Display comments
            if ($key == "comment" && $mode == 1) {
                echo "<td class='paint_opc'>$value</td>";
                //
                display_category_delimiters($prev_key);
                //
                echo "</tr>";
                //
                break;
            } else if ($key == "comment" && $mode == 2) {
                $input_name = $prev_key . "_comment";
                echo "<td class='paint_opc' value='$value'>";
                echo "<input title='Comment' class='cfinset' type='text' name='$input_name' value='$value' size='30' >";
                echo "</td>";
                //
                display_category_delimiters($prev_key);
                //
                echo "</tr>";
                //
                break;
            }
            //
            //
            $json_string_arr = file_to_array_with_json_entries($_SESSION['company_name_opc']);
            //
            //
            // The $key must of type "BATCH_MC_MODE or CONTROL_START or ..." to be able to pass this condition
            if (in_array($key, $signals_arr)) {
                //
                $prev_key = $key;
                //
                $description = get_parameter_by_opc_tag($json_string_arr, $key, "description");
                //
                // This shows "Signal name"
                echo "<td title='$description'>$key</td>";
                //
                //
            if ($mode == 1) {
                    echo "<td>$value</td>";
                } else if ($mode == 2) {
                    echo "<td>";
                    echo "<input title='$description' class='cfinset' type='text' name=$key value='$value' size='30' >";
                    echo "</td>";
                }
                //
                //
                // Filling the additional params which are taken from "default.txt"
                foreach ($additional_parameters_to_display as $parameter) {
                    echo "<td class='aditional_parameter_$parameter'>" . get_parameter_by_opc_tag($json_string_arr, $key, $parameter) . "</td>";
                }
                //
            }
            //
            //
            if ($key == "range" && $mode == 1) {
                echo "<td class='range_parameter'>$value</td>";
            } else if ($key == "range" && $mode == 2) {
                echo "<td>";
                $name = $prev_key . "_range";
                echo "<input title='range' class='cfinset' type='text' name='$name' value='$value' size='10' >";
                echo "</td>";
            }
        }
        //
        //
        echo "</tr>";
        //
    }
    //
}

function display_category_delimiters($act_key) {
    //
    $CATEGORY_DELIMITERS = array(
        'TOTAL_ADDING' => "Mixer Signals",
        'TIME_BATCH_END' => "Current batch info",
        'BATCH_NR' => "Alarm signals",
        'ALARM_ID_BCS' => "Trendlogging signals",
    );
    //
    //
    foreach ($CATEGORY_DELIMITERS as $key => $value) {
        if ($act_key == $key) {
            echo "<tr style='text-decoration:underline;'>";
            echo "<td class='delimiter_opc_td'>" . $value . "</td>";
            echo "</tr>";
        }
    }
}

/**
 * 
 * @param type $json_string_arr - json strings read from for example "default.txt"
 * @param type $opc_tag - MC_READY..MC_CONTROL....
 * @param type $parameter - type, range, description
 * @return string
 */
function get_parameter_by_opc_tag($json_string_arr, $opc_tag, $parameter) {
    foreach ($json_string_arr as $json_string) {
        $json_arr = (array) json_decode($json_string);
        if (in_array($opc_tag, $json_arr)) {
            return $json_arr[$parameter];
        }
    }
//    echo "tag = $opc_tag<br>";
    return "missing<br>";
}

function add_file_browser_opc_signals_component($link) {
    //
    $home_folder_map_arr = homeFolderMap();
    if (!array_key_exists("_" . $link, $home_folder_map_arr)) {
        return;
    }
    //
    echo "<div style='width:95%;margin-left:10px;margin-top:30px;'>";
    //
    //OBS! OBS! OBS!
    $_SESSION['link_session'] = "_" . $link;
    $_SESSION['FOLDER_MAIN_DEFINED'] = true;
    include "content/column2_admin/_upload_main_ajax.php";
    //
    echo "</div>";
}
?>
