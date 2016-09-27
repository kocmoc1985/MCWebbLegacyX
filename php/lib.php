<?php

function DEFINE_LINK() {

    if (isset($_POST['link'])) {
        $_SESSION['link_session'] = str_replace(" ", "_", $_POST['link']);
        return str_replace(" ", "_", $_POST['link']);
    } else if (isset($_GET['link'])) {
        $_SESSION['link_session'] = str_replace(" ", "_", $_GET['link']);
        return str_replace(" ", "_", $_GET['link']);
    } else {
        $_SESSION['link_session'] = "home";
        return "home";
    }
}

function CHECK_IF_COMBINED_LINK($link) {
    $q = "select browser_link FROM ajax_browser_combined_link where pseudo_link = '$link'";
    $result = executeSelectQuery($q);

    while ($row = mysqli_fetch_array($result)) {

        if (isset($row[0])) {
            $_SESSION['FOLDER_MAIN_DEFINED'] = true;
            return $row[0];
        }
    }
    return $link;
}

function CHECK_IF_COMBINED_LINK_B($link) {
    $arr = combinedLinkMap(); //----->>!!!!
    if (array_key_exists($link, $arr)) {
        $_SESSION['FOLDER_MAIN_DEFINED'] = true;
        return $arr[$link];
    } else {
        return $link;
    }
//    echo "link = $link";
//    echo "<br>";
//    echo "comb_link = $combined_link";
}

/**
 * Translating of the link in case if language
 * is other then english
 * @param type $link
 * @return type
 */
function TRANSLATE_LINK($link) {
    print_silent_variables("link_untranslated", $link);

    if (GET_LANG() == lang_eng()) {
        return $link;
    }

    $rus_eng_dict = nav_bar_btns_dict_rus_eng();

    if (array_key_exists($link, $rus_eng_dict)) {
        $translation = $rus_eng_dict[$link];
        $_SESSION['link_session'] = $translation; //VERY IMPORTANT
        return $translation;
    } else {
        return $link;
    }
}

/**
 * This allows to create links manually, for example
 * i wan't to have a link: http://www.mixcont.com/index.php?link=testLink
 * the locations of the links are taken from the "predefinedLinkMap()" function
 * @return type
 */
function CHECK_IF_PREDEFINED_LINK($link) {
    $arr = predefinedLinkMap();
    if (array_key_exists($link, $arr)) {
        $_SESSION['predefined_link'] = true;
        return $arr[$link];
    } else {
        $_SESSION['predefined_link'] = false;
        return $link;
    }
}

/**
 * 
 * @param type $link
 * @return type
 */
function TRANSLATE_IF_COLUMN_2_MAIN_LINK($link) {
    $arr = array(
        "home",
        "products",
        "faq",
        "for_customers",
    );

    foreach ($arr as $value) {
        if (strstr($link, $value)) {
            return column2MainFile();
        }
    }
    return $link;
}

/**
 * This may be used by different moduls
 */
function DEFINE_OTHER_SESSION_VARIABLES() {
    //This one is for "Upload" moduls
    if (isset($_POST['upload_path'])) {
        $_SESSION['upload_path'] = $_POST['upload_path'];
    }
}

/**
 * Below you see the JSON array which is recieved from the http://freegeoip.net
 *  "ip": "77.99.179.98",
  "country_code": "GB",
  "country_name": "United Kingdom",
  "region_code": "H9",
  "region_name": "London, City of",
  "city": "London",
  "zipcode": "",
  "latitude": 51.5142,
  "longitude": -0.0931,
  "metro_code": "",
  "areacode": ""
 */
function DEFINE_COUNTRY() {
    $link = 'http://ip-api.com/json/' . $_SERVER['REMOTE_ADDR'];
    $location = file_get_contents($link);
    $json_a = json_decode($location, true);

    $ip = $_SERVER['REMOTE_ADDR'];
    $country_code = $json_a['countryCode'];
    $city = $json_a['city'];

    print_silent_variables("ip", getIP());
    print_silent_variables("country_code", $country_code);
    print_silent_variables("city", $city);

    //!!!!
    $_SESSION['visitor_country_code'] = str_replace(' ', '', $country_code);
    $_SESSION['visitor_ip'] = str_replace(' ', '', $ip);
}

function DEFINE_COUNTRY_2() {
    $country_code = file_get_contents('http://api.hostip.info/country.php?ip=' . $_SERVER['REMOTE_ADDR'] . "'");
    print_silent_variables("country_code", $country_code);
    print_silent_variables("ip", getIP());
    //
    $_SESSION['visitor_country_code'] = str_replace(' ', '', $country_code);
    $_SESSION['visitor_ip'] = str_replace(' ', '', getIP());
}

function LOG_VISITORS() {
    $ip_raw = getIP();
    $ip = getIP() . " (" . $_SESSION['visitor_country_code'] . ")";
    date_default_timezone_set('Europe/Stockholm');
    $date = date("Y-m-d H:i:s");
    $link = $_SESSION['link_session'];
    $user_details = $_SERVER['HTTP_USER_AGENT'];

    print_silent_variables("user_details", $user_details);

    //=======================

    if (get_if_requested_parameter_exists_in_db("select * from visitor_ip where ip ='$ip_raw'")) {
        return;
    }

    if (get_if_an_entry_from_db_matches_given_text($user_details, "select * from visitor_info", 1)) {
        return;
    }

    //=======================

    $querry = "insert into visitors values ('$ip','$link','$date','$user_details')";
    executeQuery($querry);
}

/**
 * 
 * @param type $param1
 * @param type $param2
 * @param type $param3
 * @param type $param4
 * @param type $param5
 */
function SET_SQL_SESSION_VARIABLES($param1, $param2, $param3, $param4, $param5) {
    $table = "session_sql_var";
    $ip = getIP();
    executeQuery("delete from $table where ip = '" . $ip . "'"); // remove if exists, before adding.
    //
    $q = sprintf("insert into $table values('%s','%s','%s','%s','%s','%s')", $ip, $param1, $param2, $param3, $param4, $param5);

    executeQuery($q);
}

/**
 * This information is available by looking into HTML code in
 * the very top of the "BODY" element
 */
function LOG_INGFO() {
    $lang = GET_LANG();
    print_silent_variables("site_lang", $lang);
    //
    $link = $_SESSION['link_session'];
    print_silent_variables("link", $link);
    //
    $upload_path = $_SESSION['path'];
    print_silent_variables("upload_path", $upload_path);
    //
    print_silent_variables("session_id", session_id());
    //
    //
    //
    if (isset($_GET['lang'])) {
        print_silent_variables("lang_set_by", "_GET->" . $_GET['lang']);
    } else if (isset($_SESSION['lang']) && strlen($_SESSION['lang']) > 0) {
        print_silent_variables("lang_set_by", "_SESSION->" . $_SESSION['lang']);
    } else if (check_db_connection_b() && strlen(get_sql_session_param("1")) > 0) {
        print_silent_variables("lang_set_by", "_SQL->" . get_sql_session_param("1"));
    } else {
        print_silent_variables("lang_set_by", "DEFAULT->" . lang_eng());
    }
    //=================================================================
    if (isset($_SESSION['visitor_country_code']) == false) {
        print_silent_variables("DEBUG_1", "A1");
        return false;
    } else {
        $visitor_country = $_SESSION['visitor_country_code'];
        //
        if (strlen($visitor_country) == 0) {
            print_silent_variables("DEBUG_1", "A2");
        }
    }


    //=================================================================
}

/**
 * 
 */
function FILTER_VISITORS() {
    $link = $_SESSION['link_session'];
    $ip = getIP();


    if (get_if_an_entry_from_db_matches_given_text($link, "select * from ban_link", 1)) {
        exit();
    }

    foreach (deprecated_links() as $deprecated_link) {
        if (strstr($link, $deprecated_link)) {
            exit();
        }
    }

    //===========================================

    if (get_if_requested_parameter_exists_in_db("select * from ban_ip where ip ='$ip'")) {
        exit();
    }

    foreach (deprecated_ips() as $deprecated_ip) {
        if (strstr($ip, $deprecated_ip)) {
            exit();
        }
    }
}

/**
 * This information is available by looking into HTML code in
 * the very top of the "BODY" element 
 * @param type $param_name
 * @param type $value
 */
function print_silent_variables($param_name, $value) {
    echo "<div id='$param_name' style='font-size:0pt'>$value</div>";
}

//==============================================================================

function getDBConnectionInstance() {
    if (isLocalHost()) {
        $c = mysqli_connect('localhost', 'root', '', 'mixcont_com');
    } else {
        $c = mysqli_connect('mixcont.com.mysql', 'mixcont_com', 'Sjb5MVmC', 'mixcont_com');
    }
//    $c = mysqli_connect('student.ts.mah.se', 'testanv','qwerty','da123avt10') or die("ERROR: Cannot connect.");
//    $c = mysqli_connect('mixcont.com.mysql', 'mixcont_com', 'Sjb5MVmC', 'mixcont_com') or die("ERROR: Cannot connect.");
    return $c;
}

function executeSelectQuery($querry) {
    $c = getDBConnectionInstance();
    $result_set = mysqli_query($c, $querry);
    mysqli_close($c);
    return $result_set;
}

function executeQuery($querry) {
    $c = getDBConnectionInstance();
    mysqli_query($c, $querry);
    mysqli_close($c);
}

function check_db_connection_b() {
    $check_1 = mysqli_connect_errno(getDBConnectionInstance()); // 0 means no failure, error code otherwise
    if ($check_1 == 0) {
        return true;
    } else {
        return false;
    }
}

function check_input($con, $value) {
    // deletes html tags
    $value = strip_tags($value);

    // Stripslashes
    if (get_magic_quotes_gpc()) {
        $value = stripslashes($value);
    }
    // Quote if not a number
    if (!is_numeric($value)) {
        $value = mysqli_real_escape_string($con, $value);
    }
    return $value;
}

function crypt_md5($password) {
    $salt = '$1$kocmoc47$';
    return crypt($password, $salt);
}

function build_table_headers($table_name) {
    $q = "show columns from $table_name";
    $result = executeSelectQuery($q);

    echo "<tr>";
    while ($row = mysqli_fetch_array($result)) {
        echo "<th>$row[0]</th>";
    }
    echo "</tr>";
}

function get_if_requested_parameter_exists_in_db($query) {
    if (check_db_connection_b()) {
        $result_set = executeSelectQuery($query); //db cinnection ok

        if (mysqli_num_rows($result_set) > 0) {
            return true;
        } else {
            return false;
        }
    }
}

/**
 * Loops through all of the db entries, and checks 
 * if the input text/string contains a pattern of any entry listed
 * in the database
 * @param type $text
 * @param type $query
 * @return boolean
 */
function get_if_an_entry_from_db_matches_given_text($text, $query, $column_index) {
    if (check_db_connection_b()) {
        $result_set = executeSelectQuery($query); //db cinnection ok
        while ($row = mysqli_fetch_array($result_set)) {
            if (strstr(strtolower($text), strtolower($row[$column_index]))) {
                return true;
            }
        }
        return false;
    }
}

/**
 * Automatically builds the table. Delete action implemented.
 * @param type $css_id - id name of element used for CSS
 * @param type $title - Table title
 * @param type $sql_table - Name of the sql tale
 * @param type $delete_action_name - Give name for the delete action, ex: delete_user
 * @param type $auto_increment_id_name - The name of the field in database
 */
function display_table_data_automatically_1($css_id, $title, $sql_table, $delete_action_name, $auto_increment_id_name) {
    echo "<div id='$css_id'>";
    echo "<h2>$title</h2>";
    echo "<table>";

    build_table_headers($sql_table);

    $q = "select * from " . $sql_table;
    $result = executeSelectQuery($q);

    //loops through the rows
    while ($row = mysqli_fetch_array($result)) {

        //new row
        echo "<tr>";
        $counter = 0;

        //loops through the columns
        while (isset($row["$counter"])) {
            //new column
            echo "<td>$row[$counter]</td>";
            $counter++;
        }

        echo "<td>";
        $value = $row[$auto_increment_id_name];
        echo "<a class='delete' href='index.php?link=_admin&amp;action=$delete_action_name&amp;value=$value'>delete</a>";
        echo "</td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "</div>";
}

function show_sql_tables_in_html_table($css_id) {
    echo "<div id='$css_id' class='slidable_element_container'>";
    echo "<h2>Listing SQL tables</h2>";
    echo "<div class='slidable_element'>";
    echo "<table>";

    echo "<tr>";
    echo"<th>Table</th>";
    echo"<th>Nr records</th>";
    echo "</tr>";

    $q = "show tables";
    $result = executeSelectQuery($q);

    //loops through the rows
    while ($row = mysqli_fetch_array($result)) {

        //new row
        echo "<tr>";
        $counter = 0;

        //loops through the columns
        while (isset($row["$counter"])) {
            //new column
            $table_name = $row[$counter];
            echo "<td>$table_name</td>";
            $counter++;
        }

        $result_2 = executeSelectQuery("select count(*) from " . $table_name);
        $row_2 = mysqli_fetch_array($result_2);

        $nr_records = $row_2[0];

        echo "<td>";
        echo $nr_records;
        echo "</td>";

        echo "<td>";
        echo "<a class='delete' href='index.php?link=_admin&amp;action=show_table&amp;value=$table_name'>show table</a>";
        echo "</td>";

        echo "</tr>";
    }

    echo "</table>";
    echo "</div>"; //class='slidable_element'
    echo "</div>";
}

function modifyColumnCharLength($table, $column, $nrchars) {
//    executeQuery("ALTER TABLE `$table` MODIFY COLUMN `$column` VARCHAR(120)");
    executeQuery("alter table " . $table . "modify column" . $column . "varchar(" . $nrchars . ")");
}

//==============================================================================

/**
 * Shows the latest first
 * @param type $path
 * @param type $css_id
 * @param type $max_records_to_show
 */
function show_json_in_table($path, $css_id, $max_records_to_show) {
    echo "<div id='$css_id' class='slidable_element_container'>";
    echo "<h3>Showing log: $path</h3>";
    echo "<div class='slidable_element'>";
    echo "<table>";

    //    echo "<tr>";
    //    echo"<th>Table</th>";
    //    echo"<th>Nr records</th>";
    //    echo "</tr>";
    //=====
    //In this section the file is read and placed into array
    //which is reversed at the end of the section - this
    //to be able to have the latest records first
    $arr = array();

    $file = fopen($path, "r");
    while (!feof($file)) {
        $act_line = fgets($file);
        array_push($arr, $act_line);
    }

    $arr_2 = array_reverse($arr);
    fclose($file);
    //=====
    //In this section each line is decoded into array/hashmap
    $records_shown = 0;
    foreach ($arr_2 as $act_line) {
        if ($records_shown >= ($max_records_to_show + 1)) {
            break;
        }
        //===
        $json_arr = (array) json_decode($act_line);
        echo "<tr>";
        foreach ($json_arr as $key => $value) {
            echo "<td>$value</td>";
        }
        $records_shown++;
        echo "</tr>";
    }

    //=====

    echo "</table>";
    echo "</div>"; //class='slidable_element'
    echo "</div>";
}

//==============================================================================
function getIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}

function isLocalHost() {
    if (getIP() == "127.0.0.1") {
        return true;
    } else {
        return false;
    }
}

//==============================================================================
//==============================================================================

function debugg($message) {
    echo "<h3>$message</h3>";
    exit();
}

//==============================================================================
//==============================================================================

/**
 * Super Important
 * @return type
 */
function GET_LANG() {
    if (isset($_GET['lang'])) {
        return $_GET['lang'];
    } else if (isset($_SESSION['lang']) && strlen($_SESSION['lang']) > 0) {
        return $_SESSION['lang'];
    }
//    else if (check_db_connection_b() && strlen(get_sql_session_param("1")) > 0) {
//        return get_sql_session_param("1");
//    } 
    else {
        return lang_eng();
    }
}

/**
 * 
 * @param type $param_nr
 * @return string
 */
function get_sql_session_param($param_nr) {
    if (check_db_connection_b()) {
        $q = "select param_$param_nr from session_sql_var where ip = '" . getIP() . "'";
        $result_set = executeSelectQuery($q);

        while ($row = mysqli_fetch_array($result_set)) {
            return $row["param_$param_nr"];
        }
    }
    return "";
}

function get_conditions_for_choose_lang() {
    if (isset($_SESSION['visitor_country_code']) == false) {
        return false;
    }
    //
    $visitor_country = $_SESSION['visitor_country_code'];
    //
    if (strlen($visitor_country) == 0) {
        return false;
    }
    if (
            $visitor_country == country_code_rus() ||
            $visitor_country == country_code_belarus() ||
            $visitor_country == country_code_kazakstan() ||
            $visitor_country == country_code_ukraine() ||
            $visitor_country == country_code_israel() ||
//            $visitor_country == country_code_swe() ||
            $_SESSION['visitor_ip'] == "213.115.93.254" ||
            $_SESSION['visitor_ip'] == "127.0.0.1" ||
            $_SESSION['visitor_ip'] == "78.82.67.25"
    ) {
        return true;
    } else {
        return false;
    }
}

/**
 * This method is to be able to have different languages
 * @param type $link
 * @return type
 */
function get_document_with_proper_language($link) {
    return $link . "/" . $link . "" . GET_LANG() . ".php";
}

function get_available_languages($path_to_folder, $link) {
//    debugg($path_to_folder);
    if (file_exists($path_to_folder) == false) {
        return;
    } elseif (get_conditions_for_choose_lang() == false) {
        return;
    }

    echo "<div id='choose_lang'>";

    if ($handle = opendir($path_to_folder)) {

        while (false !== ($entry = readdir($handle))) {

            if ((isset($_GET['lang']) && $_GET['lang'] !== lang_eng()) || (GET_LANG() !== lang_eng() )) {
                echo "<div class='country_flag'>";
                echo "$link;" . lang_eng();
                echo "<img src='images/flag_eng.gif'>";
                echo "</div>";
                break;
            }

            if (strstr($entry, lang_rus())) {
                echo "<div class='country_flag'>";
                echo "$link;" . lang_rus();
                echo "<img src='images/flag_rus.gif'>";
                echo "</div>";
            }

            if (strstr($entry, lang_de())) {
                echo "<div class='country_flag'>";
                echo "$link;" . lang_de();
                echo "<img src='images/flag_de.gif'>";
                echo "</div>";
            }
        }

        closedir($handle);
    }

    echo "</div>"; //id='choose_lang'
}

//=============================================================================
/**
 * Removes last char in a String
 * @param type $string
 * @return type
 */
function string_delete_last_char($string) {
    return substr($string, 0, strlen($string) - 1);
}

function date_get_date_default() {
    date_default_timezone_set('Europe/Stockholm');
    return date("Y-m-d H:i:s");
}

function file_get_extension($file_name_and_extension) {
    return pathinfo($file_name_and_extension, PATHINFO_EXTENSION);
}

function createFolder($path, $folderName) {
    $path_ = $path . "/" . $folderName;
    if (file_exists($path_) == false) {
        mkdir($path_, 0777);
    }
}

function file_create_dir_if_not_exist($path) {
    if (file_exists($path) == false) {
        mkdir($path, 0777);
    }
}

function file_create_file_if_not_exist($file_path) {
    if (file_exists($file_path) == false) {
        fopen($file_path, "w");
    }
}

function file_delete_file($path) {
    if (!unlink($path)) {
        return true;
    } else {
        return false;
    }
}

function file_delete_dir($dirPath) {
    if (is_dir($dirPath)) {
        $objects = scandir($dirPath);
        foreach ($objects as $object) {
            if ($object != "." && $object != "..") {
                if (filetype($dirPath . DIRECTORY_SEPARATOR . $object) == "dir") {
                    file_delete_dir($dirPath . DIRECTORY_SEPARATOR . $object);
                } else {
                    unlink($dirPath . DIRECTORY_SEPARATOR . $object);
                }
            }
        }
        reset($objects);
        rmdir($dirPath);
    }
}

function json_write_array_with_json_encoded_strings_to_file($array, $file_path) {
    $to_record = "";
    //
    foreach ($array as $encoded_json_string) {
        //
        //Building the string to be recorded to file
        $to_record .= $encoded_json_string . "\n";
    }
    //Write to file
    file_put_contents($file_path, $to_record);
}

?>
