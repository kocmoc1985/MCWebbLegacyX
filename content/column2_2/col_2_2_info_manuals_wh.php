<?php

//THIS IS FOR WALTERHAUSEN
$manuals_arr = array(
    "Cooling temperatures" => "cooling_temperatures_wh.pdf",
    "MCBrowser" => "browser_manual_all_de.pdf",
    "MCBrowser Statistic" => "statistic_manual_all_de.pdf",
    "Edit_parameter" => "param_manual_all_de.pdf",
    "Mills browser" => "mills_browser_manual_all_de.pdf",
    "Compare batches one by one" => "one_by_one_wh.pdf",
    "Set discharge temperature" => "set_temp_max_wh.pdf",
);

$files_arr = array(
    "MCLauncher, latest version" => "MCLauncher_wh.exe",
);

$latest_news_arr = array(
    "MixCont applications MCBrowser & Editparam gained new interface with improved usability" => "2013-08-15",
    "Mills Browser is released" => "2014-10-20",
);

show_latest_news($latest_news_arr);

show_manuals($manuals_arr);

show_files($files_arr);
?>


