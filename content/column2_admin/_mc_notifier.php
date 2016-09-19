<?php

send_email_admin();

function send_email_admin() {
    //
    //http://www.mixcont.com/index.php?link=_mc_notifier&to=xxxx&subject=xxxx&message=xxxxx
    //
    if (isset($_GET['subject']) == false || isset($_GET['to']) == false) {
        return;
    }
    //
    $from = "alarm@mixcont.com";
    $to = $_GET['to'];
    $subject = $_GET['subject'];
    $message = $_GET['message'];
    //
    //
    $headers = 'From: ' . $from . "\r\n" .
            'Reply-To: ' . $from . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
    //
    $msg .= htmlspecialchars($message) . "\r\n" . "\r\n";
    //
//    $msg = str_replace("_", " ", $msg);
    //
    try {
        mail($to, $subject, $msg, $headers);
        echo "[###sending:true###]\n";
    } catch (Exception $e) {
        echo "[###sending:false###]\n";
    }
}
?>


