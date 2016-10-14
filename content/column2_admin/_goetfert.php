<style type="text/css">
    .list{
        margin-top: 30px;
        margin-left:auto;
        margin-right: auto;
        padding-left:5px;
        padding-right:5px;
        padding-top: 10px;
        padding-bottom:10px;
        width:120%;
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

    .list table,.list th,.list td,.list tr{
        overflow: auto;
        text-align: center;
        border-style: inset;
        border-width: 1px;
    }

    .list table{
        width: 95%;
    }
</style>

<?php
include_once ("/php/lib.php");

?>



<?php

goetfertTestLog();

function goetfertTestLog() {
    echo "<div class='list'>";
    echo "<h3>Goetfert test log</h3>";
    echo "<table style='font-size:10pt'>";

    build_table_headers("goetfertTest");

    $q = "select * from goetfertTest order by date_ desc limit 100";
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

        echo "</tr>";
        //========
    }
    echo "</table>";
    echo "</div>";
}
?>
