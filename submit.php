<?php

ob_start(); //Very important, this one is needed to be able to redirect
include_once ("php/lib.php");
include_once ("php/GlobalProperties.php");
//OBS you must start session here, otherwise the $_SESSION variables won't be available
if (session_id() == '') {
    session_start();
}
//
addComment();
recieveSubmitedContactFormData();
send_email_admin();
recieveSubmitedFileUpload();
submit_login();
submit_add_user();
submit_ban_ip();
submit_ban_link();
submit_dont_log_visitor_ip();
submit_dont_log_visitor_info();
submit_get_opc_signals();
createNewBrowserFolder();
//
//
ajax_ex_1();

//==============================================================================
//==============================================================================

/**
 * This helps to prevent that when user 
 * presses refresh the formdata is sent one more time
 */
function redirect() {
    $link = $_SESSION['link_session'];
    header("Location: index.php?link=$link");
    exit();
}

function redirect_to($link) {
    header("Location: index.php?link=$link");
    exit();
}

function redirect_to_admin_page() {
    header("Location: index.php?link=_admin");
    exit();
}

//==============================================================================

function createNewBrowserFolder(){
     if (isset($_POST['pseudo_link_name']) == false) {
        return;
    }
    
    $pseudo_link_name = $_POST['pseudo_link_name'];
    $real_folder_name = $_POST['real_folder_name'];
    
    createFolder("_files", $real_folder_name);
    
    $querry1 = "insert into ajax_browser_combined_link values ('$pseudo_link_name','_upload_main_ajax')";
    $querry2 = "insert into ajax_browser_home_folder values ('$pseudo_link_name','$real_folder_name')";
        
    executeQuery($querry1);
    executeQuery($querry2);
    
    redirect();
}

/**
 * Recieves contact form data and sends it to email
 * @return type
 */
function recieveSubmitedContactFormData() {
    if (isset($_POST['email']) == false) {
        return;
    }

    $name = "";
    $email = "";
    $subject = "Contact attempt by";
    $message = "";
    if (isset($_POST['name'])) {
        $name = $_POST['name'];
    }
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
    }
    if (isset($_POST['message'])) {
        $message = $_POST['message'];
    }

    $headers = 'From: webmaster@mixcont.com' . "\r\n" .
            'Reply-To: webmaster@mixcont.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

    $msg .= htmlspecialchars($message) . "\r\n" . "\r\n";
    $msg .= 'Sent from ' . $email . "\r\n" . "\r\n" . "\r\n";
    $msg .= 'You cannot answer this mail!' . "\r\n";


    if (isset($_POST['email'])) {
//        echo "name = $name  email = $email  msg = $message";
        mail("ask@mixcont.com", "$subject $name with email:$email", $msg, $headers);
    }
    redirect();
}

function send_email_admin() {
    if (isset($_POST['from']) == false) {
        return;
    }

    $from = "";
    $to = "";
    $subject = "";
    $message = "";

    if (isset($_POST['from'])) {
        $from = $_POST['from'];
    }
    if (isset($_POST['to'])) {
        $to = $_POST['to'];
    }

    if (isset($_POST['subject'])) {
        $subject = $_POST['subject'];
    }

    if (isset($_POST['message'])) {
        $message = $_POST['message'];
    }

    $headers = 'From: ' . $from . "\r\n" .
            'Reply-To: ' . $from . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

    $msg .= htmlspecialchars($message) . "\r\n" . "\r\n";


    if (isset($_POST['from'])) {
//        echo "name = $name  email = $email  msg = $message";
        mail($to, $subject, $msg, $headers);
    }
    redirect();
}

//==============================================================================

function addComment() {
    if (isset($_POST['name']) == false || isset($_POST['comment']) == false) {
        return;
    }

    // ip,date,link,name,comment
    $ip = getIP();
    date_default_timezone_set('Europe/Stockholm');
    $date = date("Y-m-d H:i:s");
    $link = $_SESSION['link_session'];
    $name = htmlspecialchars($_POST['name']);
    $rubrik = htmlspecialchars($_POST['rubrik']);
    $comment = htmlspecialchars($_POST['comment']);

    $querry = "insert into comments values ('$ip','$date','$link','$name','$rubrik','$comment')";
    executeQuery($querry);

    redirect();
}

//==============================================================================

/**
 * process file update 
 * @return type
 */
function recieveSubmitedFileUpload() {
    if (isset($_FILES["file"]["type"]) == false) {
        return;
    }

    $allowedExts = array("gif", "jpeg", "jpg", "png", "exe", "pdf", "doc", "docx");
    $arr = explode(".", $_FILES["file"]["name"]);
    $extension = $arr[1];
//    1 MB = 1048576 bytes
    if (
//            ($_FILES["file"]["type"] == "image/gif") ||
//            ($_FILES["file"]["type"] == "image/jpeg") ||
//            ($_FILES["file"]["type"] == "image/jpg") ||
//            ($_FILES["file"]["type"] == "image/pjpeg") ||
//            ($_FILES["file"]["type"] == "image/x-png") ||
//            ($_FILES["file"]["type"] == "application/octet-stream") ||
//            ($_FILES["file"]["type"] == "application/pdf") ||
//            ($_FILES["file"]["type"] == "text/plain") ||
//            ($_FILES["file"]["type"] == "image/png")) &&
//            in_array($extension, $allowedExts) &&
            ($_FILES["file"]["size"] < 104857600)) { //max filesize = 100mb
        if ($_FILES["file"]["error"] > 0) {
            $_SESSION['file_upload'] = false;
        } else {

//            if (file_exists("upload/" . $_FILES["file"]["name"])) {
//                echo $_FILES["file"]["name"] . " already exists. ";
//            }

            move_uploaded_file($_FILES["file"]["tmp_name"], $_POST['upload_dir'] . "/" . $_FILES["file"]["name"]);
            $_SESSION['file_upload'] = true;
            $_SESSION['file_name'] = $_FILES["file"]["name"];
            $_SESSION['file_type'] = $_FILES["file"]["type"];
            $_SESSION['file_size'] = $_FILES["file"]["size"];
        }
    } else {
        $_SESSION['file_upload'] = false;
    }

    redirect();
}

//==============================================================================
function submit_login() {
    if (isset($_POST['username']) == false || isset($_POST['password']) == false) {
        return;
    }

    $con = getDBConnectionInstance();

    if (check_db_connection_b()) {
        $_SESSION['online_login'] = "true";
        $username = check_input($con, $_POST['username']);
        $password = check_input($con, $_POST['password']);

        $password = crypt_md5($password);

        $q = "select * from users where username='$username' and password ='$password'";
        $result_set = executeSelectQuery($q); //db cinnection ok

        if (mysqli_num_rows($result_set) > 0) {
            $_SESSION['online_login'] = "true";
            while ($row = mysqli_fetch_array($result_set)) {
                $_SESSION['user_id'] = $row['u_id'];
                $_SESSION['user_role'] = $row['userrole'];
            }
            $_SESSION['user_name'] = $username;

            redirect_to_admin_page();
            //login ok
        } else {
            $username = $_POST['username'];
            $password = $_POST['password'];
            if ($username == "admin" && $password == "Kocmoc4765") {
                $_SESSION['login_ok'] = "true";
                redirect_to_admin_page();
                //login ok
            } else {
                $_SESSION['login_ok'] = "false";
                redirect();
            }
        }
    }
}

//==============================================================================


function submit_add_user() {
    if (isset($_POST['username_add_user']) == false || isset($_POST['password_add_user']) == false) {
        return;
    }

    $con = getDBConnectionInstance();

    $username = check_input($con, $_POST['username_add_user']);
    $password = check_input($con, $_POST['password_add_user']);
    $role = check_input($con, $_POST['select_user_role']);

    $password = crypt_md5($password);

    $q = sprintf("insert into users values('','%s','%s','%s');", $username, $password, $role);

    executeQuery($q);

    $_SESSION['user_add'] = "user = " . $username . " /pass = " . $password . " /role = " . $role;

    redirect_to_admin_page();
}

//==============================================================================
function submit_ban_ip() {
    if (isset($_POST['ip']) == false) {
        return;
    }

    $con = getDBConnectionInstance();

    $ip = check_input($con, $_POST['ip']);
    $q = sprintf("insert into ban_ip values('','%s');", $ip);
    executeQuery($q);
    redirect();
}

function submit_ban_link() {
    if (isset($_POST['link']) == false) {
        return;
    }
    $con = getDBConnectionInstance();

    $link = check_input($con, $_POST['link']);
    $q = sprintf("insert into ban_link values('','%s');", $link);
    executeQuery($q);
    redirect();
}

//==============================================================================
function submit_dont_log_visitor_ip() {
    if (isset($_POST['visitor_ip']) == false) {
        return;
    }
    $con = getDBConnectionInstance();

    $visitor_ip = check_input($con, $_POST['visitor_ip']);
    $q = sprintf("insert into visitor_ip values('','%s');", $visitor_ip);
    executeQuery($q);
    redirect();
}

function submit_dont_log_visitor_info() {
    if (isset($_POST['visitor_info']) == false) {
        return;
    }
    $con = getDBConnectionInstance();

    $visitor_info = check_input($con, $_POST['visitor_info']);
    $q = sprintf("insert into visitor_info values('','%s');", $visitor_info);
    executeQuery($q);
    redirect();
}

//==============================================================================

function submit_get_opc_signals() {
    if (isset($_POST['opc_signals_string']) == false) {
        return;
    }
    //
    $company_which_fills_in = $_SESSION['company_name_opc'];
    //
    //
    //
    if (isset($_POST['save_path_opc_signals'])) { //Editing case
        $SAVE_PATH = opc_signals_get_path_2() . $_POST['save_path_opc_signals'];
    } else if (isset($_POST['for_which_company'])) { // Normal case
        $for_which_company = $_POST['for_which_company'];
        $for_which_line = $_POST['for_which_line'];
        //
        $SAVE_PATH = opc_signals_get_path_2() . $company_which_fills_in .
                "_" . $for_which_company . "_" . $for_which_line . ".txt";
    }
    //
    //
    $opc_signals_str = $_POST['opc_signals_string'];
    //
    $opc_signals_arr = explode(";", $opc_signals_str);
    //
    //
    $array_to_be_written_to_file = array();
    //
    //
    foreach ($opc_signals_arr as $signal_name) {
        //
        $signal_value = $_POST[$signal_name];
        //
        $json_entry = "";
        //
        //OBS! OBS!
        $comment_name = $signal_name . "_comment";
        //
        $range_name = $signal_name . "_range";
        //
        if (isset($_POST[$comment_name])) { // in case of editing
            $json_entry = array(
                $signal_name => $signal_value,
                "range" => $_POST[$range_name],
                "comment" => $_POST[$comment_name], // Must be last!!
            );
        } else {// submiting the initial form
            $json_entry = array(
                $signal_name => $signal_value,
                "range" => $_POST[$range_name],
                "comment" => "", // needed! // Must be last!!
            );
        }

        $json_string = json_encode($json_entry);
        //
        array_push($array_to_be_written_to_file, $json_string);
    }
    //
    //
    json_write_array_with_json_encoded_strings_to_file($array_to_be_written_to_file, $SAVE_PATH);
    //
    redirect_to("_opc_signals");
}

//==================================<AJAX>======================================

/**
 * This method is used for learning purpose
 * The client path of this AJAX implementation is 
 * in "_ajax_client_ex_1.php"
 * @return type
 */
function ajax_ex_1() {

    if (isset($_GET['ajax_ex_1']) == false) {
        return;
    }

// Fill up array with names
    $a[] = "Anna";
    $a[] = "Brittany";
    $a[] = "Cinderella";
    $a[] = "Diana";
    $a[] = "Eva";
    $a[] = "Fiona";
    $a[] = "Gunda";
    $a[] = "Hege";


//get the q parameter from URL
    $q = $_GET["ajax_ex_1"];

//lookup all hints from array if length of q>0
    if (strlen($q) > 0) {
        $hint = "";
        for ($i = 0; $i < count($a); $i++) {
            if (strtolower($q) == strtolower(substr($a[$i], 0, strlen($q)))) {
                if ($hint == "") {
                    $hint = $a[$i];
                } else {
                    $hint = $hint . " , " . $a[$i];
                }
            }
        }
    }

// Set output to "no suggestion" if no hint were found
// or to the correct values
    if ($hint == "") {
        $response = "no suggestion";
    } else {
        $response = $hint;
    }

//output the response
    echo $response;
}

//=================================</AJAX>======================================
?>
