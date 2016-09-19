
<h1>Test Page</h1>

<?php

function getDBConnectionInstance_() {
//    $c = mysqli_connect('student.ts.mah.se', 'testanv','qwerty','da123avt10') or die("ERROR: Cannot connect.");
    //Note if you use "or die" option it means that the execution will stop if the connection failes
//    $c = mysqli_connect('mixcont.com.mysql', 'mixcont_com', 'Sjb5MVmC', 'mixcont_com') or die("ERROR: Cannot connect.");
//    $c = mysqli_connect('mixcont.com.mysql', 'mixcont_com', 'Sjb5MVmC', 'mixcont_com');
    $c = mysqli_connect('localhost', '', '', 'test');
    return $c;
}

function executeQuery_($querry) {
    $c = getDBConnectionInstance_();
    mysqli_query($c, $querry);
}

getDBConnectionInstance_();
$pass = safestrip("Kocmoc4765");
$pass = crypt($pass, '$1$mixrt');
$usrname = safestrip("username");
$role = safestrip("admin");
//$usrname = check_input("username");
echo "username = " . $usrname;
echo "pass = " . $pass;

$q = sprintf("insert into users values('','%s','%s','%s');", "$usrname", $pass, $role);

executeQuery_($q);
?>


<h3>Ok!</h3>

