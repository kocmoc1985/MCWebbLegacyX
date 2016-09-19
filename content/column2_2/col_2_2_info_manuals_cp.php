
<?php

//THIS IS FOR COMPOUNDS
$manuals_arr = array(
    "MCBrowser" => "browser_manual_cp.pdf",
    "MCBrowser Statistic" => "statistic_manual_all_de.pdf",
    "Edit_parameter" => "edit_parameters_manual_cp.pdf",
    "Online monitor" => "npmc_manual_cp.pdf",
    "Mills browser" => "mills_browser_manual_all_de.pdf",
    "MCLabUsers" => "mclabusers_manual_cp.pdf",
);

$files_arr = array(
    "MCLauncher, latest version" => "MCLauncher_cp.exe",
);


$latest_news_arr = array(
    "All MixCont applications can now be started from one place using MCLauncher.exe" => "2013-09-27",
    "MCLabUsers manual now available" => "2014-02-25",
);


show_latest_news($latest_news_arr);

show_manuals($manuals_arr);

show_files($files_arr);
?>


