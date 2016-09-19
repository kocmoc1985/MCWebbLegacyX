<style type="text/css">
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

    .list table,.list th,.list td,.list tr{
        overflow: auto;
        text-align: center;
        border-style: inset;
        border-width: 1px;
    }

    .list table{
        width: 90%;
    }
</style>

<?php
include_once ("/php/lib.php");
?>

<div id="add_form" style="width: 50%">
    <!--<img src="images/xxx.png" alt="contact_envelope_1">-->
    <h3>Create new Browser folder</h3>

    <form action="submit.php" method="post" id="browser_folder_create">

        <label>Link Name</label>
        <input class="cfinset" type="text" name="pseudo_link_name" size="50" >

        <label>Folder Name</label>
        <input class="cfinset" type="text" name="real_folder_name" size="50" >

        <input id="add_formSubmitBtn" type="submit" value="Submit">
    </form>
</div>

<?php
list_links_and_folders();
list_links_browser_path();

function list_links_and_folders() {
    echo "<div class='list'>";
    echo "<h3>List all folders</h3>";
    echo "<table style='font-size:10pt'>";

    build_table_headers("ajax_browser_home_folder");

    $q = "select * from ajax_browser_home_folder";
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

//        $id = $row['id'];
//        echo "<td>";
//        echo "<a href='index.php?link=_ban_ban&amp;action=delete_ban_ip&amp;value=$id'>delete</a>";
//        echo "</td>";

        echo "</tr>";
        //========
    }
    echo "</table>";
    echo "</div>";
}

function list_links_browser_path() {
    echo "<div class='list'>";
    echo "<h3>List path to browser</h3>";
    echo "<table style='font-size:10pt'>";

    build_table_headers("ajax_browser_combined_link");

    $q = "select * from ajax_browser_combined_link";
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

//        $id = $row['id'];
//        echo "<td>";
//        echo "<a href='index.php?link=_ban_ban&amp;action=delete_ban_ip&amp;value=$id'>delete</a>";
//        echo "</td>";

        echo "</tr>";
        //========
    }
    echo "</table>";
    echo "</div>";
}
?>
