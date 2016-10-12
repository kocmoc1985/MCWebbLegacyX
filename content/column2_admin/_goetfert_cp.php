<?php

logGoettfert();
logGoettfertTest();

function logGoettfert() {
    //
    //http://www.mixcont.com/index.php?link=_goetfert_cp&c=%s&ip=%s&u=%s&os=%s&v=%s&ot=%s
    //
    if (isset($_GET['ot']) == false) {
        return;
    }
    //
    $company = $_GET['c'];
    $ip_local = $_GET['ip'];
    $user_name = $_GET['u'];
    $os = $_GET['os'];
    $version=$_GET['v'];
    $other=$_GET['ot'];
    $date = date_get_date_default();
    //
    //
    $q = sprintf("insert into goetfertLaunch values('','%s','%s','%s','%s','%s','%s','%s');", $company, $ip_local, $user_name, $os, $version,$other, $date);
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

function logGoettfertTest() {
    //
    //http://www.mixcont.com/index.php?link=_goetfert_cp&c=%s&ip=%s&u=%s&os=%s&v=%s&tst=%s
    //
    if (isset($_GET['tst']) == false) {
        return;
    }
    //
    $company = $_GET['c'];
    $ip_local = $_GET['ip'];
    $user_name = $_GET['u'];
    $os = $_GET['os'];
    $version=$_GET['v'];
    $test=$_GET['tst'];
    $date = date_get_date_default();
    //
    //
    $q = sprintf("insert into goetfertTest values('','%s','%s','%s','%s','%s','%s','%s');", $company, $ip_local, $user_name, $os, $version,$test, $date);
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