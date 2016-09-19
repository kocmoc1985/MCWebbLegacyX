<?php

logIp();
get();
createClient();
setValidInvalid();
logRdpComClient();

function logIp() {
    //
    //http://www.mixcont.com/index.php?link=_http_com&client=901&ipw=true&ver=xxx&os=WinXp
    //
    if (isset($_GET['client']) == false || isset($_GET['ipw']) == false || isset($_GET['ver']) == false) {
        return;
    }
    //
    $client = $_GET['client'];
    $ip = getIP();
    $date = date_get_date_default();
    $version = $_GET['ver'];
    $os = $_GET['os'];
    //
    $q = sprintf("update httpcom set 
        ip ='%s', last_request_date='%s', version='%s', os='%s'
        where client = %s;", $ip, $date, $version, $os, $client);
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
    //
}

function get() {
    //
    //http://www.mixcont.com/index.php?link=_http_com&client=901&param=ip
    //
    if (isset($_GET['client']) == false || isset($_GET['param']) == false) {
        return;
    }
    //
    $client = $_GET['client'];
    $parameter = $_GET['param'];
    //
    if ($parameter == "ip") {
        //
        $result = executeSelectQuery("select $parameter from httpcom where client=$client");
        $row = mysqli_fetch_array($result);
        echo "[###$parameter:$row[0]###]\n";
        //
    } else if ($parameter == "valid") {
        //
        $result = executeSelectQuery("select $parameter from httpcom where client=$client");
        $row = mysqli_fetch_array($result);
        echo "[###$parameter:$row[0]###]\n";
        //
    }
}

function createClient() {
    //
    //http://www.mixcont.com/index.php?link=_http_com&create=true&client=902&info=test
    //
    if (isset($_GET['create']) == false || isset($_GET['client']) == false || isset($_GET['info']) == false) {
        return;
    }
    //
    $client = $_GET['client'];
    $info = $_GET['info'];
    $valid = 1;
    //
    $q = sprintf("insert into httpcom values(%s,'','',%s,'%s','','');", $client, $valid, $info);
    //
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

function setValidInvalid() {
    //
    //http://www.mixcont.com/index.php?link=_http_com&valid=0&client=902
    //
    if (isset($_GET['valid']) == false || isset($_GET['client']) == false) {
        return;
    }
    //
    $client = $_GET['client'];
    $valid = $_GET['valid'];
    //
    $q = sprintf("update httpcom set valid=%s where client=%s;", $valid, $client);
    //
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

function logRdpComClient() {
    //
    //http://www.mixcont.com/index.php?link=_http_com&log=true&client=901&os=winxp&host=hpwork&ver=xxx
    //
    if (isset($_GET['log']) == false || isset($_GET['os']) == false || isset($_GET['ver']) == false) {
        return;
    }
    //
    $client = $_GET['client'];
    $ip = getIP();
    $date = date_get_date_default();
    $os = $_GET['os'];
    $hostName = $_GET['host'];
    $version = $_GET['ver'];
    //
    //
    $q = sprintf("insert into rdpcomlog values(%s,'%s','%s','%s','%s','%s');", $client, $ip, $date, $os, $hostName, $version);
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
