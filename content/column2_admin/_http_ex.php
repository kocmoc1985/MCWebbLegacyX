<?php

logExecutorClient();
logExecutorServerOffline();
logExecutorClientLaunchedApp();

function logExecutorClient() {
    //
    //http://www.mixcont.com/index.php?link=_http_ex&c=%s&ip=%s&u=%s&os=%s&v=%s
    //
    if(isset($_GET['app']) || isset($_GET['npms']) ){
        return;
    }
    //
    if (isset($_GET['c']) == false || isset($_GET['ip']) == false || isset($_GET['u']) == false) {
        return;
    }
    //
    $company = $_GET['c'];
    $ip_local = $_GET['ip'];
    $user_name = $_GET['u'];
    $os = $_GET['os'];
    $version=$_GET['v'];    
    $date = date_get_date_default();
    //
    //
    $q = sprintf("insert into executorlog values('','%s','%s','%s','%s','%s','%s');", $company, $ip_local, $user_name, $os, $version, $date);
    //
    try {
        executeQuery($q);
        //
        echo "[###status:true###]\n";
        //
    } catch (Exception $e) {
        //
        echo "[###status:false $e###]\n";
        //
    }
}

function logExecutorServerOffline() {
    //
    //http://www.mixcont.com/index.php?link=_http_ex&c=%s&ip=%s&u=%s&os=%s&v=%s&npms=off
    //
    //
    if (isset($_GET['npms']) == false) {
        return;
    }
    //
    $company = $_GET['c'];
    $ip_local = $_GET['ip'];
    $user_name = $_GET['u'];
    $os = $_GET['os'];
    $version=$_GET['v'];    
    $date = date_get_date_default();
    //
    //
    $q = sprintf("insert into executoroffline values('','%s','%s','%s','%s','%s','%s');", $company, $ip_local, $user_name, $os, $version, $date);
    //
    try {
        executeQuery($q);
        //
        echo "[###status:true###]\n";
        //
    } catch (Exception $e) {
        //
        echo "[###status:false $e###]\n";
        //
    }
}

function logExecutorClientLaunchedApp() {
    //
    //http://www.mixcont.com/index.php?link=_http_ex&c=%s&ip=%s&u=%s&os=%s&v=%s&app=%s
    //
    if (isset($_GET['app']) == false) {
        return;
    }
    //
    $company = $_GET['c'];
    $ip_local = $_GET['ip'];
    $user_name = $_GET['u'];
    $os = $_GET['os'];
    $version=$_GET['v'];
    $launched_app = $_GET['app'];
    $date = date_get_date_default();
    //
    //
    $q = sprintf("insert into executorloglaunch values('','%s','%s','%s','%s','%s','%s','%s');", $company, $ip_local, $user_name, $os, $version,$launched_app, $date);
    //
    try {
        executeQuery($q);
        //
        echo "[###status:true###]\n";
        //
    } catch (Exception $e) {
        //
        echo "[###status:false $e###]\n";
        //
    }
}
?>
