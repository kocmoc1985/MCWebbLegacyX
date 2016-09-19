<style type="text/css">
    .uploadForm, .uploadFormList{
        margin-top: 20px;
        margin-left:10px;
        padding-left:10px;
        padding-bottom:15px;
        width:90%;
        display: block;
        overflow: auto;

        color: black;

        /* drop shadow */
        -webkit-box-shadow: 0px 0px 5px 0px #444;
        -moz-box-shadow: 0px 0px 5px 0px #444;
        box-shadow: 0px 0px 5px 0px #444;

        /*round corners*/
        -moz-border-radius: 10px;
        -webkit-border-radius: 10px;
        border-radius: 10px; /* future proofing */
        -khtml-border-radius: 10px; /* for old Konqueror browsers */

        /* Firefox 3.6+ */ 
        background: -moz-linear-gradient(left, #D8E7FC, #F9FCFF); 
        /* Safari 4-5, Chrome 1-9 */ 
        background: -webkit-gradient(linear, left top, right top, from(#D8E7FC), to(#F9FCFF)); 
        /* Safari 5.1+, Chrome 10+ */ 
        background: -webkit-linear-gradient(left, #D8E7FC, #F9FCFF);
        /* Opera 11.10+ */ 
        background: -o-linear-gradient(left, #D8E7FC, #F9FCFF);
    }

    .uploadForm img{
        display: inline-block;
        float: right;
        margin-right: 40px;
        margin-top: 20px;
    }

    .uploadFormList table{
        width: 95%;
    }

    .colW_1{
        /*File name*/
        width: 70%;
        word-wrap:break-word;
    }

    .colW_2{
        /*Size in kb*/
        width: 20%;
        font-size: small;
    }

    .colW_3{
        /*File icon*/
        width: 10%;

    }

    .uploadForm input,button{
        margin-bottom: 10px;
        display: block;
        margin-top: 5px;
        margin-left: 1px;
    }

    .uploadForm label{
        font-weight: bold;
        padding-bottom: 5px;
    }

    ::-webkit-file-upload-button {
        width: 57px;
        height: 23px;
    }

    .btns_upload{
        width: 30%;
    }

</style>

<?php
//Pay attention at this if!!
//AS I USE AJAX, THIS WILL BE EXECUTED ONLY ONCE!
//Note: $_SESSION['FOLDER_MAIN_DEFINED'] -> is set from index.php
if (isset($_SESSION['FOLDER_MAIN_DEFINED'])) {
    unset($_SESSION['FOLDER_MAIN_DEFINED']);
    $_SESSION['FOLDER_MAIN'] = getHomeFolder($_SESSION['link_session']); //------------->>>!!!!!!!!
    $_SESSION['INITIAL_UPLOAD_FOLDER'] = "_files/" . $_SESSION['FOLDER_MAIN'];
    $folder = $_SESSION['INITIAL_UPLOAD_FOLDER'];
    echo "<div id='initial_upload_folder' value='$folder' ></div>"; //%php_to_js%
}
//
//$_SESSION['file_upload'] is set from "submit.php"
//This section sets some very important "php_to_js" variables
if (isset($_SESSION['file_upload'])) {
    if ($_SESSION['file_upload']) {
        $a = TRUE;
        echo "<div id='file_upload_done' value='$a' ></div>"; //%php_to_js%
        $b = $_SESSION['upload_folder'];
        echo "<div id='dir_to_show_after_upload' value='$b' ></div>"; //%php_to_js%
    }
}
?>

<form id="upload_for_a" class="uploadForm" action="submit.php" method="post" enctype="multipart/form-data">
    <img src="images/upload_file_1.png" alt="upload_file_1">
    <h2>Upload file</h2>
    <label style="font-size: 10pt;">Click browse to choose file</label>
    <input type="file" name="file" id="file" style="width:50%">
    <label style="font-size: 10pt;">Click submit to upload file</label>
    <input class="btns_upload" type="submit" name="submit" value="Submit" id="submitUpload">
    <input id ="input_upload_dir" type="hidden" name="upload_dir" value="<?php echo $_SESSION['upload_folder'] ?>" >
    <hr style="margin-right: 50%">
    <label style="font-size: 10pt;">Add folder to current dir</label>
    <button class="btns_upload" type="button" id="create_folder_btn">Add folder</button>
</form>

<?php
if (isset($_SESSION['file_upload'])) {
    $upload_failed = false;
    if ($_SESSION['file_upload']) {

        if (file_exists($_SESSION['upload_folder'] . "/" . $_SESSION['file_name'])) {
            echo"<div class='uploadForm'>";
            echo "<img src='images/upload_file_ok.png' alt='upload_file_ok'>";
            echo "<h2>OK!</h2>";
            echo "<table>";
            basicParameters();

            echo "</table>";
            echo"</div>";
        } else {
            $upload_failed = true;
        }
    } else {
        $upload_failed = true;
    }

    if ($upload_failed) {
        echo "<div class='uploadForm'>";
        echo "<img src='images/upload_file_failed.png' alt='upload_file_failed'>";
        echo "<h2>Fail!</h2>";
        echo "<table>";
        echo "<tr>";
        echo "<td>Return Code:</td>";
        echo "<td>" . $_FILES["file"]["error"] . "</td>";
        echo"</tr>";
        basicParameters();
        echo "</table>";
        echo "</div>";
    }
    unset($_SESSION['file_upload']); //!!!!!
}

function basicParameters() {
    echo "<tr>";
    echo "<td class='colW_2'>Upload:</td>";
    echo "<td class='colW_1'>" . $_SESSION['file_name'] . "</td>";
    echo"</tr>";
    echo "<tr>";
    echo "<td class='colW_2'>Type:</td>";
    echo "<td class='colW_1'>" . $_SESSION['file_type'] . "</td>";
    echo"</tr>";
    echo "<tr>";
    echo "<td class='colW_2'>Size:</td>";
    echo "<td class='colW_1'>" . ($_SESSION['file_size'] / 1024) . "</td>";
    echo"</tr>";
    echo "<tr>";
//    echo "<td class='colW_2'>Upload dir:</td>";
//    echo "<td class='colW_1'>" . $_SESSION['upload_folder'] . "</td>";
    echo "<td class='colW_2'>Upload dir:</td>";
    echo "<td class='colW_1'>" . file_get_dir_name_only_by_link($_SESSION['upload_folder']) . "</td>";
    echo"</tr>";
}

function file_get_dir_name_only_by_link($link) {
    $arr = explode("/", $link);
    $file_name = $arr[sizeof($arr) - 1];
    return $file_name;
}
?>




<script language = "javascript" >
    var CURRENT_UPLOAD_FOLDER;

    $(document).ready(function() {
        initial_list_files();
    });

    /**
     * As some variables are passed from php to js by creating a "div" with
     * given classname and setting the attribute of the div = the value which we need to pass to js.
     * This method deletes the previous instance of the "div" so only the actual one is present.
     * @param {String} class_name
     * @param {String} parent_id - id of parent Element in which the class is placed
     * @returns {undefined}
     */
    function removeDuplicateClass(class_name, parent_id) {
        var arr;
        if (classExists(class_name)) {
            arr = getElementsArrByClass(class_name);
            if (arrayGetLength(arr) > 1) {
                var child_to_remove = arr[0];
                removeElement(parent_id, child_to_remove);
            }
        }
    }

    function initial_list_files() {
        var file_upload_done = false;
        if (elementExists("file_upload_done")) {
            var php_to_js_1 = document.getElementById("file_upload_done");
            file_upload_done = php_to_js_1.getAttribute("value");
        }
        //
        var folder;
        //
        if (file_upload_done) {
            var php_to_js_2 = document.getElementById("dir_to_show_after_upload");
            folder = php_to_js_2.getAttribute("value");
        } else {
            var php_to_js_3 = document.getElementById("initial_upload_folder");
            folder = php_to_js_3.getAttribute("value");
        }
        //
        ajax_request_list_files_in_given_folder(folder);
    }

    function ajax_request_list_files_in_given_folder(upload_path) {
        $.ajax({
            async: "true", //is true by default
            type: "GET",
            url: "ajax.php",
            data: {list_files: "a", upload_path: upload_path}
        })
                .done(function(response) {
            ajax_request_ready(response);
            // Note adding the events should happen after the response is recieved
            add_event_to_folder_links();
            add_event_to_download_links();
            removeDuplicateClass("current_upload_folder", "column_2");//!!!!!
            update_upload_dir();
        });
    }

    /**
     * Updating of <input> tag with id="input_upload_dir", in the uploadForm with id='upload_for_a'.
     * The value/upload_path is set to <div> with class="current_upload_folder" in ajax.php
     *  @returns {undefined}
     */
    function update_upload_dir() {
        arr = getElementsArrByClass("current_upload_folder");
        //=======
        if (arrayGetLength(arr) === 1) {
            var php_to_js = arr[0];
            CURRENT_UPLOAD_FOLDER = php_to_js.getAttribute("value");
//            alert("" + cuurent_upload_path);
        }
        //=======
        var input_elem = document.getElementById("input_upload_dir");
        setAttribute(input_elem, "value", CURRENT_UPLOAD_FOLDER);
    }

    /**
     * 
     * @param {type} response
     * @returns {undefined}
     */
    function ajax_request_ready(response) {
        if (classExists("uploadFormList")) {
            removeClass("uploadFormList");
        }
        appendOneElementToAnother("column_2", response);
    }

    function add_event_to_folder_links() {
        addEventToAllElementsWithGivenClassName("folder_link", "click", folder_link_pressed_aa0099);
    }

    function folder_link_pressed_aa0099(evt) {
        var elem = getEventTargetElement(evt);
        var upload_path = elem.getAttribute("path");
        ajax_request_list_files_in_given_folder(upload_path);
        preventDefaultAction_2(evt);
    }

    //=======================================================
    //
    //
    //=======================================================
    //This Section is about adding information about a "download"
    function add_event_to_download_links() {
        addEventToAllElementsWithGivenClassName("download_link", "click", download_link_pressed_aa0099);
    }

    /**
     * The idea is to log the files downloaded from the server
     * @param {type} evt
     * @returns {undefined}
     */
    function download_link_pressed_aa0099(evt) {
        var elem = getEventTargetElement(evt);
        var downloaded_file_name_and_path = elem.getAttribute("href");
        ajax_request_logg_download_info(downloaded_file_name_and_path);
    }

    function ajax_request_logg_download_info(file_name_and_path) {
        $.ajax({
            async: "true", //is true by default
            type: "GET",
            url: "ajax.php",
            data: {log_download: "a", file_name_and_path: file_name_and_path}
        })
                .done(function(response) {
        });
    }

</script>

<script language = "javascript" >
    $(document).ready(function() {
        add_event_to_add_folder_btn();
    });

    function add_event_to_add_folder_btn() {
        var add_folder_btn_element = getElement("create_folder_btn");
        addEvent(add_folder_btn_element, "click", add_folder_btn_clicked);
    }

    function add_folder_btn_clicked(evt) {
        var folder_name = getStringByDialog("Folder name");
        if (folder_name.length !== 0) {
            ajax_request_add_folder(CURRENT_UPLOAD_FOLDER, folder_name);
        }
    }

    function ajax_request_add_folder(path, folder_name) {
        $.ajax({
            async: "true", //is true by default
            type: "GET",
            url: "ajax.php",
            data: {add_folder_path: path, folder_name: folder_name}
        })
                .done(function(response) {
            ajax_request_list_files_in_given_folder(CURRENT_UPLOAD_FOLDER);
        });
    }

</script>