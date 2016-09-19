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
        border-style: none !important;
    }

    .uploadFormList th,.uploadFormList tr,.uploadFormList td{
        border-width: 0px !important;
        text-align: left !important;
    }

    .uploadFormList{
        padding-bottom: 50px;
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

    #drag_drop_desktop{
        font-size: 11pt;
    }

    #trashcan{
        display: inline-block;
        float: right;
        margin-top: 10px;
        margin-right: 10px;
        /*Transition*/
        /*        -o-transition:0.5s;
                -ms-transition:0.5s;
                -moz-transition:0.5s;
                -webkit-transition:0.5s;
                transition:0.5s;*/
    }

    #trashcan:hover{
        /*        border-bottom-width: 5px;
                border-bottom-color: red;
                border-bottom-style: solid;*/
    }

    #loading_notification{
        text-align: center;
        padding-bottom: auto;
        padding-top: auto;
        display: none;
    }

    #loading_notification_text{
        margin-top:10px;
    }

    #progress_bar_container{
        margin-left: auto;
        margin-right: auto;
        width: 80%;
        border-style: solid;
        border-width: 1px;
    }

    #progress_bar{
        height: 5px;
        background: -moz-linear-gradient(left, #2F2727, #1a82f7, #2F2727, #1a82f7, #2F2727);
        background: -webkit-gradient(linear, left top, right top, from(#2F2727), color-stop(0.25, #1a82f7), color-stop(0.5, #2F2727), color-stop(0.75, #1a82f7), to(#2F2727));
        background: -webkit-linear-gradient(left, #2F2727, #1a82f7, #2F2727, #1a82f7, #2F2727);
        background: -o-linear-gradient(left, #2F2727, #1a82f7, #2F2727, #1a82f7, #2F2727);
        margin-right: 10px;
    }

</style>

<?php
// OBS! OBS! OBS! OBS! OBS! OBS!
// ->EXAMPLE OF ADDING OF THE "FILE_BROWSER_COMPONENT"<-
//
//function add_file_browser($link) {
//
//    $home_folder_map_arr = homeFolderMap();
//    if (!array_key_exists("_" . $link, $home_folder_map_arr)) {
//        return;
//    }
//
//    echo "<div style='width:50%;margin-left:10px;margin-top:30px;'>";
//
//    $_SESSION['link_session'] = "_" . $link;
//    $_SESSION['FOLDER_MAIN_DEFINED'] = true;
//    include "content/column2_admin/_upload_main_ajax.php";
//    //
//    echo "</div>";
//}
?>


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
?>

<!--======================-->

<form id="upload_for_a" class="uploadForm" action="submit.php" method="post" enctype="multipart/form-data">
    <img src="images/upload_file_1.png" alt="upload_file_1">
    <h2>Upload file</h2>
    <label style="font-size: 10pt;">Click browse to choose file</label>
    <input type="file" name="file" id="file" style="width:90%">
    <label style="font-size: 10pt;">Click submit to upload file</label>
    <input class="btns_upload" type="submit" name="submit" value="Submit" id="submitUpload">
    <hr style="margin-right: 50%">
    <label style="font-size: 10pt;">Add folder to current dir</label>
    <button class="btns_upload" type="button" id="create_folder_btn">Add folder</button>
</form>

<script language = "javascript" >
    $(document).ready(function() {
        upload_file_from_form_by_ajax();
        //
        var submit_upload_btn = document.getElementById("submitUpload");
        //
        addEvent(submit_upload_btn, "click", submit_upload_btn_pressed);
    });
    //
    var file_name__upload;
    var bin__upload;
    //
    function upload_file_from_form_by_ajax() {
        //
        var input = document.getElementById("file");
        //
        if (window.FileReader === false) {
            return;
        }
        //
        input.addEventListener("change", function(evt) {
            var i = 0, len = this.files.length;
            //
            for (; i < len; i++) {
                // Available file attributes: size, type, slice, mozSlice, 
                // name, path, lastModifiedDate, mozFullPath
                var file = this.files[i];
                //
                var reader = new FileReader();
                //
                //Adding event to the FileReader
                addEventHandler(reader, 'loadend', function(e, file) {
                    var bin = this.result;
                    //
                    file_name__upload = file.name;
                    //
                    bin__upload = bin;
                    //
                }.bindToEventHandler(file));
                //
                reader.readAsDataURL(file);
            }
        }, false);
    }
    //==========================================================================
    //==========================================================================

    /**
     * As the sending function is handled by ajax,
     * this function prevents the default action and
     * calls the "upload_file_ajax(...)"
     * @param {Event} evt
     * @returns {undefined}
     */
    function submit_upload_btn_pressed(evt) {
        //
        preventDefaultAction_2(evt);
        //
        upload_file_ajax(file_name__upload, bin__upload);
    }
</script>

<!--======================-->
<!--//-->
<div id="loading_notification" class="uploadForm" >
    <div id="loading_notification_text" style="margin-bottom: 7px">
        Working, please wait 
    </div>
    <!--<p id="progress_percentage" style="display: inline"></p>-->
    <div id="progress_bar_container">
        <div id="progress_bar"> </div>
    </div>
</div>

<script language = "javascript" >
    //
    function blinker() {
        if (isVisible("loading_notification")) {
            $('#loading_notification_text').fadeOut(1000);
            $('#loading_notification_text').fadeIn(1000);
        }
    }
    var intervalID;

    function show_loading_notification() {
        intervalID = setInterval(blinker, 1000);
        $("#loading_notification").show();
    }

    function hide_loading_notification() {
        window.clearInterval(intervalID);
        $("#loading_notification").hide();
        //reset progress when hidden
        document.getElementById('progress_bar').style.width = 0 + '%';
    }
</script>

<!--//$drag_and_drop_from_desktop$-->
<!--//OBS!OBS! Look at "ajax_request_ready(response)" function-->
<div class="uploadFormList" id="drag_drop_desktop"></div>
<!--//-->

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
        //
        var php_to_js_3 = document.getElementById("initial_upload_folder");
        var folder = php_to_js_3.getAttribute("value");
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
            //
            // OBS! You should not call it from here, otherwise "addEventHandler(window, 'load', function() {"
            // is called each time when this (ajax_request_list_files_in_given_folder(upload_path)) function
            // is called, which leads into multiple "ajax responces"
//            add_events_drop_from_desktop();
            //====

        });
    }

    /**
     * This is OBLIGATORY!
     * Here is "CURRENT_UPLOAD_FOLDER" defined
     * @returns {undefined}
     */
    function update_upload_dir() {
        //%php_to_js%
        arr = getElementsArrByClass("current_upload_folder");
        //=======
        if (arrayGetLength(arr) === 1) {
            var php_to_js = arr[0];
            CURRENT_UPLOAD_FOLDER = php_to_js.getAttribute("value");
        }
    }


    /**
     * 
     * @param {type} response
     * @returns {undefined}
     */
    function ajax_request_ready(response) {
        removeAllElementsForParentX("drag_drop_desktop");
        appendOneElementToAnother("drag_drop_desktop", response);
    }

    function add_event_to_folder_links() {
        addEventToAllElementsWithGivenClassName("folder_link", "click", folder_link_pressed_aa0099);
    }

    function folder_link_pressed_aa0099(evt) {
        var elem = getEventTargetElement(evt);
        var upload_path = elem.getAttribute("href");
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
        if (folder_name !== null) {
            if (folder_name.length !== 0) {
                ajax_request_add_folder(CURRENT_UPLOAD_FOLDER, folder_name);
            }
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
            // ajaxAddResponseAppendAsIs("upload_table_body", response);
        });
    }

</script>

<script language = "javascript" >
    /**
     * Is called by the Element which is beeing dragged (source Element)
     * @param {type} ev
     * @returns {undefined}
     */
    function drag(ev) {
        // OBS! You should write this one up, and namely when you call
        // the getAttributeValue with "path" as key you get the absoute path
        // of the element
        // getAttributeValue(ev.target, "path");
        //
        var path_of_dragged_elem = getAttributeValue(ev.target, "href");
        ev.dataTransfer.setData("Text", path_of_dragged_elem);
    }

    /**
     * Is called by the Element to which the Element is to be dropped (target Element)
     * @param {type} ev
     * @returns {undefined}
     */
    function allowDrop(ev) {
        ev.preventDefault();
    }

    /**
     * Is called by the Element to which the Element is to be dropped
     * Element is to be dropped (target Element)
     * @param {type} ev
     * @returns {undefined}
     */
    function drop(ev) {
        ev.preventDefault();
        var path_src = ev.dataTransfer.getData("Text");
        var path_target = getAttributeValue(ev.target, "href");

        if (path_target === "trashcan") {
            ajax_request_drag_and_drop_delete(path_src);
        } else {
            //This means "common" "move file" operation
            ajax_request_drag_and_drop_file(path_src, path_target);
        }
    }


    /**
     * 
     * @param {String} path_src
     * @param {String} path_target
     * @returns {undefined}
     */
    function ajax_request_drag_and_drop_file(path_src, path_target) {
        $.ajax({
            async: "true", //is true by default
            type: "GET",
            url: "ajax.php",
            data: {path_src: path_src, path_target: path_target}
        })
                .done(function(response) {
//            ajaxAddResponse("upload_for_a", response);
            ajax_request_list_files_in_given_folder(CURRENT_UPLOAD_FOLDER);
        });
    }

    function ajax_request_drag_and_drop_delete(path_of_element_to_delete) {
        $.ajax({
            async: "true", //is true by default
            type: "GET",
            url: "ajax.php",
            data: {path_of_element_to_delete: path_of_element_to_delete}
        })
                .done(function(response) {
//            ajaxAddResponse("upload_for_a", response);
            ajax_request_list_files_in_given_folder(CURRENT_UPLOAD_FOLDER);
        });
    }

</script>

<script language = "javascript" >
    //This section is all about uploading a file by "drag & drop from desktop"
    //$drag_and_drop_from_desktop$
    //
    // OBS! This function must only be called once, from here! Otherwise
    // it leads into multiple "ajax responces"
    add_events_drop_from_desktop();
    //
    function add_events_drop_from_desktop() {
        var DROP = document.getElementById('drag_drop_desktop');

        if (window.FileReader) {
            console.log("window_load");
            addEventHandler(window, 'load', function() {

                function cancel(e) {
                    if (e.preventDefault) {
                        e.preventDefault();
                    }
                    return false;
                }

                // Tells the browser that we *can* drop on this target
                addEventHandler(DROP, 'dragover', cancel);
                addEventHandler(DROP, 'dragenter', cancel);
            });
        } else {
            document.getElementById('status').innerHTML = 'Your browser does not support the HTML5 FileReader.';
        }

        //===

        addEventHandler(DROP, 'drop', function(e) {
            e = e || window.event; // get window.event if e argument missing (in IE)   
            if (e.preventDefault) {
                e.preventDefault();
            } // stops the browser from redirecting off to the image.

            var dt = e.dataTransfer;
            var files = dt.files;
            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                //
                var reader = new FileReader();
                //
                //attach event handlers here...
                addEventHandler(reader, 'loadend', function(e, file) {
                    //
                    var bin = this.result;
                    //
                    upload_file_ajax(file.name, bin);
                    //
                }.bindToEventHandler(file));
                //
                //
                reader.readAsDataURL(file);
            }
            return false;
        });
    }

    /**
     * OBS! This one is obligatory!
     * @returns {unresolved}
     */
    Function.prototype.bindToEventHandler = function bindToEventHandler() {
        var handler = this;
        var boundParameters = Array.prototype.slice.call(arguments);
        //create closure
        return function(e) {
            e = e || window.event; // get window.event if e argument missing (in IE)   
            boundParameters.unshift(e);
            handler.apply(this, boundParameters);
        };
    };


    function addEventHandler(obj, evt, handler) {
        if (obj.addEventListener) {
            // W3C method
            obj.addEventListener(evt, handler, false);
        } else if (obj.attachEvent) {
            // IE method.
            obj.attcahEvent('on' + evt, handler);
        } else {
            // Old school method.
            obj['on' + evt] = handler;
        }
    }

    function upload_file_ajax(file_name_and_extension, bin_data) {
        //
        show_loading_notification();
        //
        //==========================
        //In section the progress listener is added to jQuery ajax request
        var xhr, provider;
        //
        xhr = jQuery.ajaxSettings.xhr();
        if (xhr.upload) {
            xhr.upload.addEventListener('progress', function(e) {
                uploadProgress(e);
            }, false);
        }
        provider = function() {
            return xhr;
        };
        //=============================
        $.ajax({
            async: "true", //is true by default
            type: "POST",
            url: "ajax.php",
            xhr: provider,
            data: {file_name_and_extension: file_name_and_extension, bin_data: bin_data}
        })
                .done(function(response) {
            //==
            //
            // By using this function the table is not updated each time
            // a new file is added but is appended to the end of the table
            ajaxAddResponseAppendAsIs("upload_table_body", response);
            //
            // This function can also be used, but the previous one should 
            // be disabled in this case
//            ajax_request_list_files_in_given_folder(CURRENT_UPLOAD_FOLDER);
            //
            hide_loading_notification();
        });
    }
    //
    //
    var uploaded = 0, prevUpload = 0, speed = 0, total = 0, remainingBytes = 0, timeRemaining = 0;
    //
    /**
     * 
     * @param {type} e
     * @returns {undefined}
     */
    function uploadProgress(e)
    {
        if (e.lengthComputable)
        {
            uploaded = e.loaded;
            total = e.total;
            //percentage
            var percentage = Math.round((e.loaded / e.total) * 100);
//            document.getElementById('progress_percentage').innerHTML = percentage + '%';
            document.getElementById('progress_bar').style.width = percentage + '%';
//
//            document.getElementById("remainingbyte").innerHTML = j.BytesToStructuredString(e.total - e.loaded);//remaining bytes
//            document.getElementById('uploadedbyte').innerHTML = j.BytesToStructuredString(e.loaded);//uploaded bytes
//            document.getElementById('totalbyte').innerHTML = j.BytesToStructuredString(e.total);//total bytes
        }

    }

    function UploadSpeed() {
        //speed
        speed = uploaded - prevUpload;
        prevUpload = uploaded;
//        document.getElementById("speed").innerHTML = j.SpeedToStructuredString(speed);

        //Calculating ETR
        remainingBytes = total - uploaded;
        timeRemaining = remainingBytes / speed;
//        document.getElementById("ETR").innerHTML = i.SecondsToStructuredString(timeRemaining);
    }

    //==========================================================================
    //==========================================================================
    //==========================================================================
    /**
     * So far i didn't manage to send the files in "full" size,
     * files are sent but all content which leads into that the files
     * cannot be opened properly
     * @param {type} file_name_and_extension
     * @param {type} bin_data
     * @returns {undefined}
     * @deprecated text
     */
    function ajax_request_drop_file_from_desktop_deprecated(file_name_and_extension, bin_data) {
        show_loading_notification();
        //
        xmlhttp = ajaxRequest_2(
                "POST",
                "ajax.php",
                "file_name_and_extension", file_name_and_extension,
                "bin_data", bin_data,
                "progress", uploadProgress);
        //
        //
        ajaxRequestReady(xmlhttp, ajax_request_ready_drop_file_from_desktop);
        //
        //
    }


    function ajax_request_ready_drop_file_from_desktop(response) {
        hide_loading_notification();
        //==
        //
        // By using this function the table is not updated each time
        // a new file is added but is appended to the end of the table
        ajaxAddResponseAppendAsIs("upload_table_body", response);
        //
        // This function can also be used, but the previous one should 
        // be disabled in this case
//            ajax_request_list_files_in_given_folder(CURRENT_UPLOAD_FOLDER);
    }

</script>