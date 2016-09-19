<?php

include_once ("php/lib.php");
include_once ("php/GlobalProperties.php");
//OBS you must start session here, otherwise the $_SESSION variables won't be available
if (session_id() == '') {
    session_start();
}

list_files();
create_new_folder();
move_file_by_drag_and_drop();
delete_file_by_drag_and_drop();
drag_and_drop_from_desktop();
log_download_info();

//==============================================================================

function list_files() {
    if (isset($_GET['list_files']) == false || $_GET['upload_path'] == false) {
        return;
    }

    //===============SUPER_IMPORTANT============================================
    $_SESSION['UPLOAD_FOLDER'] = $_GET['upload_path'];
    $absolute_dir = realpath($_GET['upload_path']);
    //This session var is only used in this file
    $_SESSION['act_browser_dir'] = file_get_dir_name_only_by_link($absolute_dir);
    //==========================================================================
    //==========================================================================
    //
    // THIS IS SUPER IMPORTANT! This is a kind of cleaning of the 
    // path/link. Without it problems occurs.
    // Example problem: We have folder1 & folder2 in root/home dir,
    // we move first folder1 -> folder2; then we move folder1 back to root/home dir;
    // then we try to move folder2 -> folder1 and Error occurs if we dont have this code!
    if (check_if_home_dir()) {
        $_GET['upload_path'] = $_SESSION['INITIAL_UPLOAD_FOLDER'];
        $_SESSION['UPLOAD_FOLDER'] = $_SESSION['INITIAL_UPLOAD_FOLDER'];
    }
    //Passing variable to JavaScript
    $folder = $_GET['upload_path'];
    echo "<div class='current_upload_folder' value='$folder' ></div>"; //%php_to_js%
    //
    //==========================================================================
    //==========================================================================
    //
    // This section resets the path in case of a failure occured.
    // in fact all the failures which lead to a wrong path, should be fixed.
    if (file_exists($_GET['upload_path']) == false) {
        $_GET['upload_path'] = $_SESSION['INITIAL_UPLOAD_FOLDER'];
    }
    //
    //
    $files = scandir($_GET['upload_path']);
    sort($files);
    //
    //
//    echo "<div class='uploadFormList' id ='drag_drop_desktop'>"; //$drag_and_drop_from_desktop$
    //
    //
    echo"<table>";
    echo "<tbody id='upload_table_body'>";
    //
    define_and_display_table_title("h3");
    //
    echo "<img id='trashcan' href='trashcan' ondrop='drop(event)' ondragover='allowDrop(event)' src='images/trashcan.png'alt='trashcan'>"; // $drag_&_drop$

    foreach ($files as $FILE_ACT) {
        create_rows_for_upload_table($_GET['upload_path'], $FILE_ACT); //--------------->>>!!!!!
    }
    echo "</tbody>";
    echo"</table>";
    //
//    echo "</div>";
    //
    //    debug("list_files()->ajax.php");
//
}

/**
 * SUPER IMPORTANT
 * @param type $path
 * @param type $file_name
 * @return type
 */
function create_rows_for_upload_table($path, $file_name) {
    echo "<tr>";
    //
    $FILE_ACT = $file_name;
    //
    $PATH = $path . "/" . $FILE_ACT;
    //
    $file_extension = pathinfo($FILE_ACT, PATHINFO_EXTENSION);
    //
    $image_icon_name = get_image_icon_name($file_extension);
    $image_icon_path = "images/file_browser_images/" . $image_icon_name;
    //
    //Making so the files without extension are not displayed as a folder
    if (strlen($file_extension) == 0 && is_dir($PATH) == false) {
        $image_icon_path = "images/file_browser_images/page_white_text.png";
    }
    //
    // This one (".") is no need to show, because i don't handle it yet.
    if ($FILE_ACT == ".") {
//        continue; //continue was used when this method was built-in in the "for loop"
        return;
    }
    //
    if (is_dir($PATH)) {

        //Directory
        if (check_if_path_dots_shall_be_shown($FILE_ACT)) {
            echo "<td class='colW_3'><img src='$image_icon_path'alt='$FILE_ACT'></td>";
            echo "<td><a class='folder_link' class='colW_1' 
                    ondrop='drop(event)' 
                    ondragover='allowDrop(event)'
                    draggable='true' 
                    ondragstart='drag(event)'
                    href='$PATH'>$FILE_ACT</a></td>"; //%php_to_js% (path attribute); // $drag_&_drop$
        }
    } else {
        //File
        echo "<td class='colW_3'><img src='$image_icon_path'alt='$FILE_ACT'></td>";
        echo "<td class='colW_1' 
                draggable='true' 
                ondragstart='drag(event)'>
                <a href='$PATH' target='_blank' class='download_link'>$FILE_ACT</a></td>"; // $drag_&_drop$
        echo "<td class='colW_2'>" . round((filesize($PATH) / 1024)) . " kb" . "</td>";
    }

    echo"</tr>";
}

/**
 * // $drag_&_drop$
 */
function move_file_by_drag_and_drop() {
    if (isset($_GET['path_src']) == false || isset($_GET['path_target']) == false) {
        return;
    }

    $path_src = $_GET['path_src'];
    $path_target = $_GET['path_target'];
    //
    $file_name_only_src = file_get_current_file_name_without_path($path_src);
    $ready_path_with_file_name = $path_target . "/" . $file_name_only_src;
    //
    //"rename" function moves the file!
    rename($path_src, $ready_path_with_file_name);
}

/**
 * 
 * @return type
 */
function delete_file_by_drag_and_drop() {
    if (isset($_GET['path_of_element_to_delete']) == false) {
        return;
    }

    $path_of_element_to_delete = $_GET['path_of_element_to_delete'];
    if (is_dir($path_of_element_to_delete)) {
        file_delete_dir($path_of_element_to_delete);
    } else {
        file_delete_file($path_of_element_to_delete);
    }
}

/**
 * 
 * @return type
 */
function create_new_folder() {
    if (isset($_GET['add_folder_path']) == false) {
        return;
    }
    //
    //
    $fodler_where_to_create = $_GET['add_folder_path'];
    $folder_name = $_GET['folder_name'];
    $path = $fodler_where_to_create . "/" . $folder_name;
    mkdir($path, 0777);
    //
    // This is not so good idea to use the function as follows below, because
    // everything seems to be ok the folder is created and added but it's not
    // possible to open it after the upload, why i haven't defined yet.
    // 
    // 
    // echo create_rows_for_upload_table($fodler_where_to_create, $folder_name);
}

/**
 * $drag_and_drop_from_desktop$
 * @return type
 */
function drag_and_drop_from_desktop() {
    if (isset($_POST['bin_data']) == false) {
        return;
    }
    //
    $file_name = $_POST['file_name_and_extension'];
    $bin_data = $_POST['bin_data'];
    //
//    echo "file_name = " . $file_name . "<br>";
//    echo "bin_data_length = " . strlen($bin_data) . "<br>";
//    echo "UPLOAD_FOLDER = " . $_SESSION['UPLOAD_FOLDER'] . "<br>";
    //
    // Check if it is folder, folder upload is not
    // supported yet
    if (strlen($bin_data) == 0) {
        return;
    }
    //
    //OBS! OBS! PAY ATTENTION AT THIS FUNCTION!
    $data = file_get_contents($bin_data); //------------------------------>>>>>>OBS!
    //
    file_put_contents($_SESSION['UPLOAD_FOLDER'] . "/" . $file_name, $data);
    //
    echo create_rows_for_upload_table($_SESSION['UPLOAD_FOLDER'], $file_name);
}

/**
 * 
 * @return type
 */
function log_download_info() {
    if (isset($_GET['log_download']) == false) {
        return;
    }

    $file_name_path = $_GET['file_name_and_path'];
    $country_code = "";
    if (isset($_SESSION['visitor_country_code'])) {
        $country_code = $_SESSION['visitor_country_code'];
    }
    //===============

    $json_arr = array(
        'date_time' => date_get_date_default(),
        'ip' => getIP(),
        'country_code' => $country_code,
        'file_and_path' => $file_name_path
    );

    $json_string = json_encode($json_arr);
    //===============
    //===============
    file_create_dir_if_not_exist("LOG");
    file_create_file_if_not_exist(download_log_path());
    //
    $file = download_log_path();
    // Open the file to get existing content
    $current = file_get_contents($file);
    // Append a new person to the file
    $current .= "$json_string\n";
    // Write the contents back to the file
    file_put_contents($file, $current);
}

//=========================================================================
function define_and_display_table_title($h1_h5) {
    $style = " style='float:left; width:80%'";
    if (check_if_home_dir()) {
        echo "<$h1_h5 $style>Home</$h1_h5>";
    } else {
        echo "<$h1_h5 $style>" . $_SESSION['act_browser_dir'] . "</$h1_h5>";
    }
}

function debug($caller_function_name) {
    $log_file_path = "LOG/debug_upload.txt";
    if (file_exists("LOG") == false) {
        mkdir($log_file_path, 0777);
    }
    write_to_file($log_file_path, "Caller function:$caller_function_name\n");
    write_to_file($log_file_path, "SESSION['act_browser_dir'] = " . $_SESSION['act_browser_dir']);
    write_to_file($log_file_path, "SESSION['UPLOAD_FOLDER'] = " . $_SESSION['UPLOAD_FOLDER']);
    write_to_file($log_file_path, "SESSION['FOLDER_MAIN'] = " . $_SESSION['FOLDER_MAIN']);
    write_to_file($log_file_path, "SESSION['INITIAL_UPLOAD_FOLDER'] = " . $_SESSION['INITIAL_UPLOAD_FOLDER']);
    write_to_file($log_file_path, "\n\n================================================");
}

function write_to_file($log_file_path, $message) {
    $file = $log_file_path;
    $current = file_get_contents($file);
    $current .= date_get_date_default() . "  $message\n";
    file_put_contents($file, $current);
}

/**
 * 
 * @param type $path
 * @return type
 */
function file_get_current_file_name_without_path($path) {
    $arr = explode("/", $path);
    return $arr[sizeof($arr) - 1];
}

/**
 * This one must be placed in Document where you call it from!!!
 * @return type
 */
function file_get_current_file_name_without_path_and_extension() {
    $arr = explode("/", __FILE__);
    $file_name = $arr[sizeof($arr) - 1];
    return substr($file_name, 0, strlen($file_name) - 4);
}

function file_get_dir_name_only_by_link($link) {
    $arr = explode("/", $link);
    $file_name = $arr[sizeof($arr) - 1];
    return $file_name;
}

function get_image_icon_name($file_extension) {
    $image_map = file_browser_image_map();
    //
    $image_icon_name = NULL;
    if (array_key_exists($file_extension, $image_map)) {
        $image_icon_name = $image_map[$file_extension];
    }
    //
    if ($image_icon_name == NULL) {
        return $image_map["txt"];
    } else {
        return $image_icon_name;
    }
}

function check_if_path_dots_shall_be_shown($file_act) {
//    debug($file_act);

    if ($_SESSION['act_browser_dir'] == $_SESSION['FOLDER_MAIN']) {
        if ($file_act == "." || $file_act == "..") {
            return false;
        } else {
            return true;
        }
    } else {
        return true;
    }
}

function check_if_home_dir() {
    if ($_SESSION['act_browser_dir'] == $_SESSION['FOLDER_MAIN']) {
        return true;
    } else {
        return false;
    }
}

//==============================================================================
//==============================================================================
//==============================================================================
//==============================================================================
//===================================FILE_BROWSER===============================
//$p = isset($_POST["path"]) ? $_POST["path"] : "";
//$f = isset($_POST["filter"]) ? $_POST["filter"] : "";
//echo json_encode(searchDir("./", $p, $f, -1));

/**
 * This one is used by _file_browser.php -> (plugin not done by me!)
 * @param type $base_dir
 * @param type $p
 * @param type $f
 * @param type $allowed_depth
 * @return type
 */
function searchDir($base_dir = "./", $p = "", $f = "", $allowed_depth = -1) {
    $contents = array();

    $base_dir = trim($base_dir);
    $p = trim($p);
    $f = trim($f);

    if ($base_dir == "")
        $base_dir = "./";
    if (substr($base_dir, -1) != "/")
        $base_dir.="/";
    $p = str_replace(array("../", "./"), "", trim($p, "./"));
    $p = $base_dir . $p;

    if (!is_dir($p))
        $p = dirname($p);
    if (substr($p, -1) != "/")
        $p.="/";

    if ($allowed_depth > -1) {
        $allowed_depth = count(explode("/", $base_dir)) + $allowed_depth - 1;
        $p = implode("/", array_slice(explode("/", $p), 0, $allowed_depth));
        if (substr($p, -1) != "/")
            $p.="/";
    }

    $filter = ($f == "") ? array() : explode(",", strtolower($f));

    $files = @scandir($p);
    if (!$files)
        return array("contents" => array(), "currentPath" => $p);

    for ($i = 0; $i < count($files); $i++) {
        $fName = $files[$i];
        $fPath = $p . $fName;

        $isDir = is_dir($fPath);
        $add = false;
        $fType = "folder";

        if (!$isDir) {
            $ft = strtolower(substr($files[$i], strrpos($files[$i], ".") + 1));
            $fType = $ft;
            if ($f != "") {
                if (in_array($ft, $filter))
                    $add = true;
            }else {
                $add = true;
            }
        } else {
            if ($fName == ".")
                continue;
            $add = true;

            if ($f != "") {
                if (!in_array($fType, $filter))
                    $add = false;
            }

            if ($fName == "..") {
                if ($p == $base_dir) {
                    $add = false;
                }
                else
                    $add = true;

                $tempar = explode("/", $fPath);
                array_splice($tempar, -2);
                $fPath = implode("/", $tempar);
                if (strlen($fPath) <= strlen($base_dir))
                    $fPath = "";
            }
        }

        if ($fPath != "")
            $fPath = substr($fPath, strlen($base_dir));
        if ($add)
            $contents[] = array("fPath" => $fPath, "fName" => $fName, "fType" => $fType);
    }

    $p = (strlen($p) <= strlen($base_dir)) ? $p = "" : substr($p, strlen($base_dir));
    return array("contents" => $contents, "currentPath" => $p);
}

//===================================FILE_BROWSER END===============================
?>
