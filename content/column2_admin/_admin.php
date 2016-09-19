<style type="text/css">

    #chk_box_choose_role{

    }

    /**************************************************************************/
    /**************************************************************************/
    /**************************************************************************/

    #list_users_container{
        margin-top: 30px;
        margin-left:auto;
        margin-right: auto;
        padding-left:5px;
        padding-right:5px;
        padding-top: 10px;
        padding-bottom:10px;
        width:50%;
        display: block;
        overflow: auto;

        color: black;

        -webkit-box-shadow: 0px 0px 5px 0px #444;
        -moz-box-shadow: 0px 0px 5px 0px #444;
        box-shadow: 0px 0px 5px 0px #444;

        -moz-border-radius: 10px;
        -webkit-border-radius: 10px;
        border-radius: 10px; 
        -khtml-border-radius: 10px; 

        background: -moz-linear-gradient(left, #D8E7FC, #F9FCFF); 
        background: -webkit-gradient(linear, left top, right top, from(#D8E7FC), to(#F9FCFF)); 
        background: -webkit-linear-gradient(left, #D8E7FC, #F9FCFF);
        background: -o-linear-gradient(left, #D8E7FC, #F9FCFF);
    }

    #list_users_container table,#list_users_container th,#list_users_container td,#list_users_container tr{
        text-align: center;
        border-style: inset;
        border-width: 1px;
    }

    #list_users_container table{
        width: 90%;
    }


</style>

<h2 style="text-align: center;">Admin page</h2>

<?php
echo "<div style='text-align:center;'>";
if (isset($_SESSION['online_login'])) {
    echo"<br><br>";
    echo "online login = " . $_SESSION['online_login'];
}

echo"<br><br>";
echo "link = " . $_SESSION['link_session'];
echo "</div>";
//    echo ini_get('error_log');


if (isset($_GET['action'])) {
    if ($_GET['action'] == 'delete_user') {
        $u_id = $_GET['value'];
        executeQuery("delete from users where u_id = '" . $u_id . "'");
    } else if ($_GET['action'] == 'show_table') {
        $table_name = $_GET['value'];
        //This one not finished!
        display_table_data_automatically_1("list_users_container", "Showing table $table_name", $table_name, "delete_any", "id");
    }
}



if (isset($_SESSION['login_ok']) && $_SESSION['login_ok'] == "true") {
    add_form_for_user_adding();
    //====
    display_table_data_automatically_1("list_users_container", "List users", "users", "delete_user", "u_id");

    show_sql_tables_in_html_table("list_users_container");

    add_file_browser_component("_upload_admin", "list_users_container", "File Browser");

//    include "content/column2_admin/_file_browser.php";

    show_json_in_table(download_log_path(), "list_users_container", 50);

    add_ban_ip_component();

    include "content/column2_admin/_send_send_mail.php";
}

//==============================================================================
//==============================================================================

function add_file_browser_component($link, $container_id, $title) {
    //
    $home_folder_map_arr = homeFolderMap();
    if (!array_key_exists($link, $home_folder_map_arr)) {
        return;
    }
    //
    echo "<div id='$container_id' class='slidable_element_container'>";
    echo "<h2>$title</h2>";
    echo "<div class='slidable_element'>";
    //
    //OBS! OBS! OBS!
    $_SESSION['link_session'] = $link;
    $_SESSION['FOLDER_MAIN_DEFINED'] = true;
    include "content/column2_admin/_upload_main_ajax.php";
    //
    echo "</div>";
    echo "</div>";
}

function add_ban_ip_component() {
    echo "<div id='list_users_container' class='slidable_element_container'>";
    echo "<h2>Ban Ip</h2>";
    echo "<div class='slidable_element'>";
    include "content/column2_admin/_ban_ban.php";
    echo "</div>";
    echo "</div>";
}

function add_form_for_user_adding() {
    echo "<div id='add_form' style='width:50%'>";
    echo "<form action='submit.php' method='post' id='add_user_form'>";
    echo "<img src='images/add_user_1.png' alt='add_user_1' style='width:80px; height:70px'>";
    echo "<h2>Add user</h2>";
    echo "<label>Username</label>";
    echo "<input class = 'cfinset' name = 'username_add_user' size = '30' required>";

    echo "<label>Password</label>";
    echo "<input class = 'cfinset' name = 'password_add_user' size = '30' required>";

    echo "<label>Select Role</label>";
    echo "<select name = 'select_user_role' id='chk_box_choose_role'>";
    echo "<option value =''>Choose Role</option>";
    echo "<option value ='super admin'>Super Admin</option>";
    echo "<option value ='admin'>Admin</option>";
    echo "<option value ='user'>User</option>";
    echo "</select>";
    echo "<input id = 'add_formSubmitBtn' type = 'submit' value = 'Submit'>";
    echo "</form>";
    echo "</div>";
}
?>



