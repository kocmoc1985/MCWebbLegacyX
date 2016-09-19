<style type="text/css">


</style>

<?php
//http://mixcont.com/index.php?link=col_2_2_info_manuals_main&value=cp
//localy
//http://localhost/MCWebLegacyX/index.php?link=col_2_2_info_manuals_main&value=cp
//define company name based on what "value" we get from the link
$value = $_GET['value'];
$company_name = get_full_company_name($value);

//This to be able to redirect to right place after submiting question form
$_SESSION["company_prefix"] = $value;
?>

<div id="container_main">

    <h1 style="text-align: center;margin-bottom: 40px">Support page for <?php echo " $company_name" ?></h1>

    <?php
    include "content/column2_2/col_2_2_info_manuals_$value.php";
    //
    ?>

    <div class="container_basic">
        <h1>Have questions?</h1>
        <?php
        include "content/column2_2/col_2_2_contacts.php";
        ?>
        <p>Don't hesitate to ask us we will answer you question very soon!</p>
    </div>

</div>

<?php

function get_full_company_name($company_prefix) {
    $arr = array(
        "cp" => "Compounds AG",
        "fedmog" => "Federalmogul",
        "wh" => "Phoenix Walterhausen",
        "qew" => "QEW",
        "phoenix" => "Phoenix",
    );
    return $arr[$company_prefix];
}

function get_full_file_path_manual($file_name) {
    return "pdfs/manuals/" . $file_name;
}

function get_full_file_path_file($file_name) {
    return "_files/_support/" . $_SESSION['company_prefix'] . "/" . $file_name;
}

function exists($full_path) {
    if (file_exists($full_path)) {
        return "open/download";
    } else {
        return "";
    }
}

function show_latest_news($arr) {
    if (count($arr) == 0) {
        return;
    }
    echo "<div class='container_basic slidable_element_container'>";
    echo "<h1>Information board</h1>";
    echo "<div class='slidable_element'>";
    foreach ($arr as $key => $value) {
        echo "<div class='container_basic_entry'>";
        echo "$key";
        echo "<br><br>";
        echo "/$value";
        echo "</div>";
    }
    echo "</div>"; //class='slidable_element'
    echo "</div>";
}

function show_manuals($arr) {
    if (count($arr) == 0) {
        return;
    }
    echo "<div class='container_basic'>";
    echo "<h1>Manuals</h1>";

    echo "<table>";
    echo "<tr>";
    echo "<th>Manual for</th>";
    echo "<th>Download</th>";
    echo "</tr>";

    foreach ($arr as $key => $value) {
        echo "<tr>";
        echo "<td>" . $key . "</td>";
        echo "<td style='width:30%'>" . "<a href='" . get_full_file_path_manual($value) . "' target='_blank'>" . exists(get_full_file_path_manual($value)) . "</a></td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "</div>";
}

function show_files($arr) {
    if (count($arr) == 0) {
        return;
    }
    echo "<div class='container_basic'>";
    echo "<h1>Files</h1>";

    echo "<table>";
    echo "<tr>";
    echo "<th>File description</th>";
    echo "<th>Download</th>";
    echo "</tr>";

    foreach ($arr as $key => $value) {
        echo "<tr>";
        echo "<td>" . $key . "</td>";
        echo "<td style='width:30%'>" . "<a href='" . get_full_file_path_file($value) . "' target='_blank'>" . exists(get_full_file_path_file($value)) . "</a></td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "</div>";
}
?>




