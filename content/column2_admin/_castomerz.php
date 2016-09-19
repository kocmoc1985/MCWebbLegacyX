
<style type="text/css">

</style>

<?php
$companies = array(
    "phoenix" => get_full_path_castomer("phoenix"),
    "wh" => get_full_path_castomer("wh"),
);

function get_full_path_castomer($company) {
    return "_files/_reporter/" . $company;
}

function report_exists($full_path) {
    if (file_exists($full_path)) {
        return "open/download";
    } else {
        return "";
    }
}

function get_report_path($company, $line) {
    return "_files/_reporter/" . $company . "/" . "report$line" . ".txt";
}
?>

<div id="container_main">

    <?php
    show_reports($companies);
    ?>

</div>

<?php

function show_reports($companies_arr) {
    echo "<div class='container_basic' style='margin-bottom: 250px;'>";
    echo "<h1>Reports</h1>";

    echo "<table style='width:85%;'>";
    echo "<tr>";
    echo "<th>Company</th>";
    echo "<th>Line 1</th>";
    echo "<th>Line 2</th>";
    echo "</tr>";

    foreach ($companies_arr as $key => $value) {
        echo "<tr>";
        echo "<td>" . $key . "</td>";

        for ($index = 1; $index < 3; $index++) {
            $report_path = get_report_path($key, $index);
            echo "<td>" . "<a href='" . $report_path . "' target='_blank'>" . report_exists($report_path) . "</a></td>";
        }

        echo "</tr>";
    }

    echo "</table>";
    echo "</div>";
}
?>
