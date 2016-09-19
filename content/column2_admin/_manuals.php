<style type="text/css">
    .link_container{
        margin-left: auto;
        margin-right: auto;
        border-style: groove;
        font-size: 16pt;
        clear: both;
        margin-bottom: 10px;
        width:50%;
        text-align: center;
    }

</style>

<h1 style="text-align: center">Manuals</h1>

<?php
$customers = array(
    "fedmog" => "http://mixcont.com/index.php?link=col_2_2_info_manuals_main&value=fedmog",
    "cp" => "http://mixcont.com/index.php?link=col_2_2_info_manuals_main&value=cp",
    "wh" => "http://mixcont.com/index.php?link=col_2_2_info_manuals_main&value=wh",
    "conti_hung" => "http://mixcont.com/index.php?link=col_2_2_info_manuals_main&value=conti_hung",
);


foreach ($customers as $key => $value) {
    echo "<div class='link_container'>";
    echo"<a href='$value' target='_blank'>$key</a>";
    echo "</div>";
}
?>
