<style type="text/css">

    #show_work_ip_container{
        margin-top: 30px;
        margin-left:auto;
        margin-right: auto;
        padding-left:5px;
        padding-right:5px;
        padding-top: 10px;
        padding-bottom:10px;
        width:95%;
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

    #show_work_ip_container table,#list_users_container th,#list_users_container td,#list_users_container tr{
        text-align: center;
        border-style: inset;
        border-width: 1px;
    }

    #show_work_ip_container table{
        width: 90%;
    }


</style>

<?php
//
// It work's in following way: i make a "http" request from java
// and the server part (PHP) of the functionality is beeing executed.
// Pay attention that client part (JS) is not executed!
//
log_work_ip();
db_request();
get_ip_request();
//
if (file_exists(work_ip_log_path())) {
    show_json_in_table(work_ip_log_path(), "show_work_ip_container", 10);
}

//
//
function log_work_ip() {
    //This if makes that only the "HTTPComm" client is accepted
    if (isset($_GET['watcher']) == false) {
        return;
    }
    //
    $json_arr = array(
        'date_time' => date_get_date_default(),
        'ip' => getIP(),
    );
    //
    $json_string = json_encode($json_arr);
    //===============
    //===============
    file_create_dir_if_not_exist("LOG");
    file_delete_file(work_ip_log_path());
    file_create_file_if_not_exist(work_ip_log_path());
    //
    $file = work_ip_log_path();
    // Open the file to get existing content
    $current = file_get_contents($file);
    // Append a new person to the file
    $current .= "$json_string\n";
    // Write the contents back to the file
    file_put_contents($file, $current);
}

function db_request() {
    if (isset($_GET['db_request']) == false || isset($_GET['db_request_parameter']) == false) {
        return;
    }
    $parameter = $_GET['db_request_parameter'];
    //
    //
    if ($parameter == "visitors_count") {
        $result_2 = executeSelectQuery("select count(*) from " . "visitors");
        $row_2 = mysqli_fetch_array($result_2);
        $nr_records = $row_2[0];
        echo "[###visitors_count:$nr_records###]\n";
    }
}

function get_ip_request() {
    if (isset($_GET['ip_request']) == false) {
        return;
    }
    $ip = extract_ip_from_file(work_ip_log_path());
    echo "[###ip:$ip###]\n";
}

function extract_ip_from_file($path) {
    $arr = array();

    $file = fopen($path, "r");
    while (!feof($file)) {
        $act_line = fgets($file);
        array_push($arr, $act_line);
    }

    $arr_reverse = array_reverse($arr);
    fclose($file);
    //=====
    //In this section each line is decoded into array/hashmap
    $counter = 0;
    foreach ($arr_reverse as $act_line) {
        $json_arr = (array) json_decode($act_line);
        foreach ($json_arr as $key => $value) {
            if ($counter == 0) {
                $counter++;
                continue;
            } else {
                return $value;
            }
        }
    }
}
?>


<script language = "javascript" >
    //
    // NOTE USING AJAX IS NOT THE RIGHT WAY
    // When i make an "http" request from java only the server
    // side operations are done which is understandable.
    // But the client part is not executed!!
    //
    $(document).ready(function() {
//        ajax_request_logg_work_ip();
    });

    function ajax_request_logg_work_ip() {
        $.ajax({
            async: "true", //is true by default
            type: "GET",
            url: "ajax.php",
            data: {logg_work_ip: "a"}
        })
                .done(function(response) {
        });
    }

</script>

