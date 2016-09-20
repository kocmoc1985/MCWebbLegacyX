<?php

function home() {
    return "home";
}

function products() {
    return "products";
}

function faq() {
    return "FAQ";
}

function contacts() {
    return "contacts";
}

function customers() {
    return "For Customers";
}

//==
function home_rus() {
    return "Домой";
}

function products_rus() {
    return "Продукты";
}

function faq_rus() {
    return "Вопросы и ответы";
}

function contacts_rus() {
    return "Контакт";
}

//=======================
function column2MainFile() {
    return "column2Main";
}

function column2MainHomeFile() {
    return "home";
}

//=======================
function nav_bar_btns_dict_rus_eng() {
    return array(
        "домой" => "home",
        "продукты" => "products",
        "контакт" => "contacts",
        "вопросы_и_ответы" => "faq",
        "для_клиентов" => "for_customers"
    );
}

//=======================

function complete_solution() {
    return "col_2_1_complete solution";
}

function mixing_control() {
    return "col_2_1_mixing control";
}

//=======================
function analysing_tools() {
    return "col_2_1_analysing tools";
}

function mcdetector() {
    return "col_2_1_mc detector";
}

function mctracker() {
    return "col_2_1_mc tracker";
}

//=======================

function laboratory() {
    return "col_2_1_laboratory";
}

//=======================
function process_monitoring() {
    return "col_2_1_process monitoring";
}

function mcbrowser() {
    return "col_2_1_mc browser";
}

function mcprocessmonitor() {
    return "col_2_1_mc process monitor";
}

function mcmillsbrowser() {
    return "col_2_1_mc mills browser";
}

//==============================================================================
function opc_signals_get_path_1() {
    return "content/column2_3/opc_signals/";
}

function opc_signals_get_path_2() {
    return "content/column2_3/opc_signals_ready/";
}

//==============================================================================
function download_log_path() {
    return "LOG/download.log";
}

function work_ip_log_path() {
    return "LOG/work_ip.log";
}

//==============================================================================

function isOnlyColumn2($link) {
    $arr = array(
        "_castomerz",
        "_links__",
        "_manuals",
        "_opc_signals",
        "_visitors",
        "_ban_ban",
        "_login",
        "_admin",
        "_c_",
        "_work_ip",
        "_mclauncher",
        "_calendar",
        //
        "_upload",
        "_upload_public",
        "_browser_folder",
        "_cezare_3g",
        "_upload_MC_HF",
        "_upload_MC_CORDIANT",
        //
        "safonov",
    );

    foreach ($arr as $value) {
        if (strstr($link, $value)) {
            return true;
        }
    }
    return false;
}

//=============

/**
 * This Map is for the cases when a separate page is to be shown
 * @return type
 */
function predefinedLinkMap() {
    return array(
        "Examensarbete_|_Alexey_Safonov" => "_files/_upload_ls/index.html",
    );
}

//==============================================================================
/**
 * This mapping is only used for the my "File Browser"
 * Key = pseudo file, Value = real file
 * so it means when a link like "http://www.mixcont.com/index.php?link=_upload_public" 
 * is pressed i search for a file named "_upload_main_ajax.php" and not for "_upload_public.php"
 * @return type
 */
function combinedLinkMap() {
    return array(
        "_upload_public" => "_upload_main_ajax",
        //
        "_upload_concord_u_f_1" => "_upload_main_ajax",
        "_upload" => "_upload_main_ajax",
        "_exchange" => "_upload_main_ajax",
        "_upload_rus" => "_upload_main_ajax",
        "_siemens" => "_upload_main_ajax",
        "_sm_control" => "_upload_main_ajax",
        "_continental_tyres_001" => "_upload_main_ajax",
        "_cezare_3g" => "_upload_main_ajax",
        "_upload_MC_HF" => "_upload_main_ajax",
        "_upload_MC_CORDIANT" => "_upload_main_ajax",
        "_RW" => "_upload_main_ajax",
        //
        "_safonov_file_manager" => "_upload_main_ajax",
        //
        "_upload_test" => "_upload_main_ajax_test",
    );
}

//=====
function homeFolderMap() {
    return array(
        "_upload" => "_upload",
        "_upload_rus" => "_a_cherepanin_u_f_2",
        "_upload_admin" => "", // OBS! not needed in "combinedLinkMap()" method // Not sure it's true: 2014_09_04
        "_upload_public" => "_upload_public",
        "_upload_concord_u_f_1" => "_concord_u_f_1",
        "_exchange" => "_exchange",
        "_siemens" => "_siemens_opc",
        "_sm_control" => "_sm_control",
        "_wh" => "_wh_opc", // OBS! not needed in "combinedLinkMap()" method
        "_continental_tyres_001" => "conti_tyres",
        "_cezare_3g" => "cezare_3g",
        "_upload_MC_HF" => "_upload_MC_HF",
        "_upload_MC_CORDIANT" => "_upload_MC_CORDIANT",
        "_RW" => "_RW",
        //
        "_safonov_file_manager" => "_upload_ls",
        "_upload_test" => "_upload_test",
    );
}

/**
 * Dont use
 * @param type $link
 * @return type
 */
function getHomeFolderB($link) {
    $arr = homeFolderMap();
    return $arr[$link];
}

function getHomeFolder($link) {
    $q = "select link_to_folder FROM ajax_browser_home_folder where pseudo_link = '$link'";
    $result = executeSelectQuery($q);

    while ($row = mysqli_fetch_array($result)) {

        if (isset($row[0])) {
            return $row[0];
        }
    }
    return null;
}

//=====

function file_browser_image_map() {
    return array(
        "" => "folder.png",
        "html" => "page_white_code.png",
        "htm" => "page_white_code.png",
        "zip" => "page_white_compressed.png",
        "rar" => "page_white_compressed.png",
        "7z" => "page_white_compressed.png",
        "gz" => "page_white_compressed.png",
        "cs" => "page_white_csharp.png",
        "xls" => "page_white_excel.png",
        "swf" => "page_white_flash.png",
        "fla" => "page_white_flash.png",
        "php" => "page_white_php.png",
        "png" => "page_white_picture.png",
        "jpg" => "page_white_picture.png",
        "bmp" => "page_white_picture.png",
        "gif" => "page_white_picture.png",
        "txt" => "page_white_text.png",
        "doc" => "page_white_word.png",
        "docx" => "page_white_word.png",
        "pdf" => "page_white_pdf.png",
        "exe" => "page_white_exe.png",
        "dll" => "page_white_exe.png",
        "jar" => "page_white_exe.png",
    );
}

//==============================================================================

function lang_rus() {
    return "_rus";
}

function lang_de() {
    return "_de";
}

function lang_eng() {
    return "_eng";
}

//==============================================================================

function country_code_rus() {
    return "RU";
}

function country_code_belarus() {
    return "BY";
}

function country_code_kazakstan() {
    return "KZ";
}

function country_code_ukraine() {
    return "UA";
}

function country_code_israel() {
    return "IL";
}

function country_code_swe() {
    return "SE";
}

//==============================================================================

function deprecated_links() {
    return array(
        "/proc/self/environ",
        "/etc/passwd",
        "UNION_SELECT_CHAR"
    );
}

function deprecated_ips() {
    return array(
        "195.154.68.136",
        "81.15.235.16"
    );
}

//==============================================================================
//==============================================================================
?>
