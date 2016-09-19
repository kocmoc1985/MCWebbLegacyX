<?php

$link = $_SESSION['link_session'];


if ($link == column2MainHomeFile()) {
    get_available_languages(str_replace("column2Main.php", "home", __FILE__), $link);
}

include get_document_with_proper_language($link);
?>
