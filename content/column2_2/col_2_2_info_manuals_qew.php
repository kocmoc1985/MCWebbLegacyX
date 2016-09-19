
<?php

//THIS IS FOR COMPOUNDS
$manuals_arr = array(
    "MCBrowser" => "browser_manual_all_eng.pdf",
    "MCBrowser Statistic" => "statistic_manual_all_eng.pdf",
);

$files_arr = array(
    "MCLauncher, latest version" => "MCLauncher.exe",
);


$latest_news_arr = array(
    "All MixCont applications can now be started from one place using MCLauncher.exe" => "2014-11-27",
);


show_latest_news($latest_news_arr);

show_manuals($manuals_arr);

show_files($files_arr);
?>


