<?php

//THIS IS FOR FEDMOG
$manuals_arr = array(
    "MCBrowser" => "browser_manual_all_eng.pdf",
    "MCBrowser Statistic" => "statistic_manual_all_eng.pdf",
    "Edit_parameter" => "param_manual_all_eng.pdf",
    "Online monitor" => "npmc_manual_all_eng.pdf",
    "Barcode reader" => "bcr_manual_all_eng.pdf",
    "MCLabAdmin" => "lab_admin_all_eng.pdf",
    "MCLabClient " => "lab_client_all_eng.pdf",
    "MDR" => "mdr_all_eng.pdf",
    "MV2000" => "mv_all_eng.pdf",
    "Materials scan" => "db_viewer_eng.pdf",
);

$files_arr = array(
    "MCLauncher, latest version" => "MCLauncher_fedmog.exe",
);


$latest_news_arr = array(
    "All MixCont applications can now be started from one place using MCLauncher.exe" => "2013-09-27",
    "MCBrowser update: renewed interface with greater usability" => "2013-09-27",
    "Editparameter program is released" => "2013-09-27",
    "MillsBrowser is released" => "2014-05-07",
    "Graphical interface for barcode reader released" => "2014-06-05",
    "Graphical interface for barcode reader is now able to edit row data" => "2014-06-27",
);

show_latest_news($latest_news_arr);

show_manuals($manuals_arr);

show_files($files_arr);
?>
