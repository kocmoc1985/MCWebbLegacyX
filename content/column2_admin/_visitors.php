<style type="text/css">
    #visitors_table{
        font-size: 10pt;
        font-weight: bold;
    }

    #visitors_table th{
        font-size: 12pt;
        font-weight: bold;
        color: black;
    }

    .list{
        margin-top: 30px;
        margin-left:auto;
        margin-right: auto;
        padding-left:5px;
        padding-right:5px;
        padding-top: 10px;
        padding-bottom:10px;
        width:50%;
        /*display: block;*/
        overflow: auto;

        color: black;

        -webkit-box-shadow: 0px 0px 5px 0px #444;
        -moz-box-shadow: 0px 0px 5px 0px #444;
        box-shadow: 0px 0px 5px 0px #444;

        -moz-border-radius: 10px;
        -webkit-border-radius: 10px;
        border-radius: 10px; 
        -khtml-border-radius: 10px; 

        background: -moz-linear-gradient(left, #D8E7FC, #F9FCFF); 
        background: -webkit-gradient(linear, left top, right top, from(#D8E7FC), to(#F9FCFF)); 
        background: -webkit-linear-gradient(left, #D8E7FC, #F9FCFF);
        background: -o-linear-gradient(left, #D8E7FC, #F9FCFF);
    }

    .list table,th,td,tr{
        overflow: auto;
        text-align: center;
        border-style: inset;
        border-width: 1px;
    }

    .list table{
        width: 90%;
    }
</style>

<h1 style="text-align: center">Visitors</h1>

<?php
include_once ("/php/lib.php");
process_delete_request();

function process_delete_request() {
    if (isset($_GET['action']) == false) {
        return;
    }

    if ($_GET['action'] == 'delete_visitor_ip') {
        $id = $_GET['value'];
        executeQuery("delete from visitor_ip where id = '" . $id . "'");
    } else if ($_GET['action'] == 'delete_visitor_info') {
        $id = $_GET['value'];
        executeQuery("delete from visitor_info where id = '" . $id . "'");
    }
}
?>

<!----------------------------------------------------------------------------->

<div id="add_form" style="width: 50%">
    <!--<img src="images/xxx.png" alt="contact_envelope_1">-->
    <h5>Add visitor ip not to log</h5>

    <form action="submit.php" method="post" id="add_ip_not_to_log">

        <label>ip</label>
        <input class="cfinset" type="text" name="visitor_ip" size="30" >

        <input id="add_formSubmitBtn" type="submit" value="Submit">
    </form>

</div>

<?php
list_not_logged_ips();
echo "<br><hr>";

function list_not_logged_ips() {
    echo "<div class='list slidable_element_container'>";
    echo "<h5>List not logged ips</h5>";
    echo "<div class='slidable_element'>";
    echo "<table style='font-size:10pt'>";

    build_table_headers("visitor_ip");

    $q = "select * from visitor_ip";
    $result = executeSelectQuery($q);

    //loops through the rows
    while ($row = mysqli_fetch_array($result)) {

        //new row
        echo "<tr>";
        $counter = 0;

        //loops through the columns
        while (isset($row["$counter"])) {
            //new column
            echo "<td>$row[$counter]</td>";
            $counter++;
        }

        $id = $row['id'];

        echo "<td>";
        echo "<a href='index.php?link=_visitors&amp;action=delete_visitor_ip&amp;value=$id'>delete</a>";
        echo "</td>";

        echo "</tr>";
        //========
    }
    echo "</table>";
    echo "</div>"; //class='slidable_element'
    echo "</div>";
}
?>

<!----------------------------------------------------------------------------->

<div id="add_form" style="width: 50%">
    <!--<img src="images/xxx.png" alt="contact_envelope_1">-->
    <h5>Add visitor info not to log</h5>

    <form action="submit.php" method="post" id="add_info_not_to_log">

        <label>info</label>
        <input class="cfinset" type="text" name="visitor_info" size="30" >

        <input id="add_formSubmitBtn" type="submit" value="Submit">
    </form>

</div>

<?php
list_not_logged_info();
echo "<br><hr><br><br>";

function list_not_logged_info() {
    echo "<div class='list slidable_element_container'>";
    echo "<h5>List not logged info</h5>";
    echo "<div class='slidable_element'>";
    echo "<table style='font-size:10pt'>";

    build_table_headers("visitor_info");

    $q = "select * from visitor_info";
    $result = executeSelectQuery($q);

    //loops through the rows
    while ($row = mysqli_fetch_array($result)) {

        //new row
        echo "<tr>";
        $counter = 0;

        //loops through the columns
        while (isset($row["$counter"])) {
            //new column
            echo "<td>$row[$counter]</td>";
            $counter++;
        }

        $id = $row['id'];

        echo "<td>";
        echo "<a href='index.php?link=_visitors&amp;action=delete_visitor_info&amp;value=$id'>delete</a>";
        echo "</td>";

        echo "</tr>";
        //========
    }
    echo "</table>";
    echo "</div>"; //class='slidable_element'
    echo "</div>";
}
?>

<!----------------------------------------------------------------------------->

<?php
showVisitors();

function showVisitors() {
    $querry = "select * from visitors order by time_connected desc limit 500";
    $result = executeSelectQuery($querry);
    display_db_result_set_in_html_table($result);
}

function display_db_result_set_in_html_table($result) {

    echo "<table id='visitors_table' border='1'>";

    echo "<tr>";
    echo"<th>Host</th>";
    echo"<th>Page</th>";
    echo"<th>Date</th>";
    echo"<th>Info</th>";
    echo "</tr>";

    //loops through the rows
    while ($row = mysqli_fetch_array($result)) {

        //new row
        echo "<tr>";
        $counter = 0;

        //loops through the columns
        while (isset($row["$counter"])) {
            //new column

            if ($counter == 0) { //!!!!!
                $ip_and_country = explode(" ", $row[$counter]);
                echo "<td>";
                echo "<a href='http://whois.domaintools.com/$ip_and_country[0]' target='_blank'>$row[$counter]</a>";
                echo "</td>";
            } else {
                echo "<td>$row[$counter]</td>";
            }

            $counter++;
        }
        echo "</tr>";
    }

    echo "</table>";
}
?>
