<?php
session_start();
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<!--<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">-->
<?php
include_once ("php/GlobalProperties.php");
include_once ("php/lib.php");
//
$link = DEFINE_LINK();
$link = TRANSLATE_LINK($link);
$link = CHECK_IF_COMBINED_LINK($link);
$link = CHECK_IF_PREDEFINED_LINK($link);
$link = TRANSLATE_IF_COLUMN_2_MAIN_LINK($link);
//
DEFINE_OTHER_SESSION_VARIABLES();

//DEFINE_COUNTRY();
if (isLocalHost() == false) {
    DEFINE_COUNTRY_2();
    LOG_VISITORS();
    FILTER_VISITORS();
    
}
//
LOG_INGFO(); //things as language, link 
//
//
if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang']; //====OBS!
    //
    //This one is not so much needed after i fixed the problem with the session varibles
//    SET_SQL_SESSION_VARIABLES($_GET['lang'], "", "", "", ""); //->OBS! OBS!
}
?>


<html>
    <head>
        <title><?php echo ucwords(str_replace("_", " ", $_SESSION['link_session'])) ?></title>
        <meta http-equiv = "Content-Type" content = "text/html; charset=utf-8">
        <meta content=" Estimates  properties of processed material online, Prozessleitsystems für den Gummi Mischsaal, Adaptive process control, Rubber mixing control system, predictive process control, adaptive steuerung, MixCont  predictive self learning process control system, Eine  adaptive selbstlernende Steuersystem , Optimizes  process control settings in real time to achieve maximum desired key  performance factors,Can be used  for rubber/polymer mixing, extrusion, injection molding, concrete mixing, crashing  hard rocks, bakery, margarine/chocolate mixing, oil refinery ">
        <link rel="shortcut icon" href="images/browsericon.ico">
        <link href="style/stylemain.css" rel="stylesheet" type="text/css">
        <link href="style/stylesec.css" rel="stylesheet" type="text/css">
        <link href="style/slideOutToolTip.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="js/libs/my_lib_a.js"></script>
        <script type="text/javascript" src="js/libs/my_lib_b.js"></script>
        <script type="text/javascript" src="js/libs/my_lib_c.js"></script>
        <script type="text/javascript" src="js/libs/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="js/libs/autoScrollingDiv.js"></script>
        <script type="text/javascript" src="js/libs/styleAdjust.js"></script>
        <script type="text/javascript" src="js/libs/styleAdjust2.js"></script>
        <script type="text/javascript" src="js/libs/slide_up.js"></script>
        <script type="text/javascript" src="js/libs/globalProperties.js"></script>
    </head>

    <body>
        <div id="wrapper">

            <?php
            //
            //
            if ($_SESSION['predefined_link']) {
                include $link;
                exit();
            }
            //
            //
            ?>

            <div id="header">
                <?php include 'content/column2_layout/header.php'; ?>
            </div>

            <div id="navigationBar">
                <?php include 'content/column2_layout/navigationBar.php'; ?>
            </div>


            <?php
            //This makes that for some pages column_1 & column_2 are not needed
            //
            $path = find_path("content", $link);
            //
            if (isOnlyColumn2($link)) {
                show_col_2_only($path, $link);
            } else if (strstr($link, "col_2_2_info_manuals")) {
                show_col_2_only($path, $link);
            }
            ?>


            <div id="column_1">
                <?php include 'content/column2_layout/column_1_home.php'; ?>
            </div><!-- end column_1 -->

            <div id="column_2">
                <?php
//
                $PATH = find_path("content", $link);
//
                if (file_exists($PATH . "$link.php")) {
                    include $PATH . "$link.php";
                } else {
                    echo "file not exist:  " . $PATH . "$link.php<br>";
                    $session_lang = $_SESSION['lang'];
                    echo "lang = $session_lang";
                    echo "<br>";
                    //
                    echo "link = $link";
                    echo "<br>";
                    //
                    echo "PATH = $PATH";
                }
                ?>
            </div>

            <div id="column_3">
                <?php
                if ($link !== "_visitors" && $link !== "_test" && $link !== "_c_documents_project_phwh") {
                    include 'content/column2_layout/column_3_home.php';
                }
                ?>
            </div>

            <div id="footer">
                <?php include 'content/column2_layout/footer.php'; ?>
            </div> 

        </div>

    </body>

</html>

<?php

/**
 * 
 * @param type $path
 * @param type $link
 */
function show_col_2_only($path, $link) {
    echo "<div id='column_2_temp'>";
    if (file_exists($path . "$link.php")) {
        include $path . "$link.php";
    } else {
        echo "file not exist: $path | $link.php";
    }
    echo "</div>";

    echo "<div id='footer'>";
    include 'content/column2_layout/footer.php';
    echo "</div>";
    exit();
}

/**
 * This function cannot be placed in "lib.php"!
 * This function automaticly finds the file path.
 * OBS!OBS! Note the recursion depth is 1 -> content -> folderX.
 * So it will not find a file if the file is in a folder inside folderX.
 * @param type $dir
 * @param type $file_to_find
 */
function find_path($dir, $file_to_find) {
    if ($handle = opendir($dir)) {
        while (false !== ($entry = readdir($handle))) {
            if (is_dir("content/" . $entry) && $entry != "." && $entry != "..") {
                find_path("content/" . $entry, $file_to_find);
            } else if ($entry == $file_to_find . ".php") {
                $_SESSION['path'] = $dir . "/";
            }
        }
        closedir($handle);
        if (isset($_SESSION['path'])) {
            return $_SESSION['path'];
        } else {
            return "";
        }
    }
}
?>


