<style type="text/css">
    .uploadForm_x{
        margin-left:10px;
        margin-bottom: 20px;
        padding-left:10px;
        padding-bottom:5px;
        width:45%;
        display: block;
        overflow: auto;

        color: black;

        /* drop shadow */
        -webkit-box-shadow: 0px 0px 5px 0px #444;
        -moz-box-shadow: 0px 0px 5px 0px #444;
        box-shadow: 0px 0px 5px 0px #444;

        /*round corners*/
        -moz-border-radius: 10px;
        -webkit-border-radius: 10px;
        border-radius: 10px; /* future proofing */
        -khtml-border-radius: 10px; /* for old Konqueror browsers */

        /* Firefox 3.6+ */ 
        background: -moz-linear-gradient(left, #D8E7FC, #F9FCFF); 
        /* Safari 4-5, Chrome 1-9 */ 
        background: -webkit-gradient(linear, left top, right top, from(#D8E7FC), to(#F9FCFF)); 
        /* Safari 5.1+, Chrome 10+ */ 
        background: -webkit-linear-gradient(left, #D8E7FC, #F9FCFF);
        /* Opera 11.10+ */ 
        background: -o-linear-gradient(left, #D8E7FC, #F9FCFF);
    }

    .uploadForm_x img{
        display: inline-block;
        float: right;
        margin-right: 40px;
        margin-top: 20px;
    }

    .uploadForm_x table{
        width: 95%;
    }

    .colW_1{
        width: 70%;
        word-wrap:break-word;
    }

    .colW_2{
        width: 30%;
    }

    .uploadForm_x input{
        margin-bottom: 10px;
        display: block;
        margin-top: 5px;
        margin-left: 1px;
    }

    ::-webkit-file-upload-button {
        width: 57px;
        height: 23px;
    }


    .uploadForm_x label{
        font-weight: bold;
        padding-bottom: 5px;
    }
</style>

<?php
//This 2 parameters are called from the component which includes this plugin
//$_SESSION['upload_folder'] = "_files/_customers/phwh";
//$_SESSION['link_session'] ="_c_documents_projekt_phwh";
//====================================================================
//The best way to call this plugin is to do so:
//$_SESSION['upload_folder'] = "_files/_customers/phwh";
//$_SESSION['link_session'] ="_c_documents_projekt_phwh";
//include 'content/column2/_c_upload_plugin.php';
?>

<form class="uploadForm_x" action="submit.php" method="post" enctype="multipart/form-data">
    <img src="images/upload_file_1.png" alt="upload_file_1">
    <h2>Upload file</h2>
    <label for="file">Filename:</label>
    <input type="file" name="file" id="file">
    <input type="submit" name="submit" value="Submit">
    <input type="hidden" name="upload_dir" value="<?php echo $_SESSION['upload_folder'] ?>">
</form>

<?php
if (isset($_SESSION['file_upload'])) {
    $upload_failed = false;
    if ($_SESSION['file_upload']) {
        if (file_exists($_SESSION['upload_folder'] . "/" . $_SESSION['file_name'])) {
            echo"<div class='uploadForm_x'>";
            echo "<img src='images/upload_file_ok.png' alt='upload_file_ok'>";
            echo "<h2>OK!</h2>";
            echo "<table>";
            basicParameters();
            echo "</table>";
            echo"</div>";
        } else {
            $upload_failed = true;
        }
    } else {
        $upload_failed = true;
    }

    if ($upload_failed) {
        echo "<div class='uploadForm_x'>";
        echo "<img src='images/upload_file_failed.png' alt='upload_file_failed'>";
        echo "<h2>Fail!</h2>";
        echo "<table>";
        echo "<tr>";
        echo "<td>Return Code:</td>";
        echo "<td>" . $_FILES["file"]["error"] . "</td>";
        echo"</tr>";
        basicParameters();
        echo "</table>";
        echo "</div>";
    }
    unset($_SESSION['file_upload']); //!!!!!
}

function basicParameters() {
    echo "<tr>";
    echo "<td class='colW_2'>Upload:</td>";
    echo "<td class='colW_1'>" . $_SESSION['file_name'] . "</td>";
    echo"</tr>";
    echo "<tr>";
    echo "<td class='colW_2'>Type:</td>";
    echo "<td class='colW_1'>" . $_SESSION['file_type'] . "</td>";
    echo"</tr>";
    echo "<tr>";
    echo "<td class='colW_2'>Size:</td>";
    echo "<td class='colW_1'>" . ($_SESSION['file_size'] / 1024) . "</td>";
    echo"</tr>";
    echo "<tr>";
    echo "<td class='colW_2'>Upload dir:</td>";
    echo "<td class='colW_1'>" . $_SESSION['upload_folder'] . "</td>";
    echo"</tr>";
}

list_files();

function list_files() {
    $files1 = scandir($_SESSION['upload_folder']);
    sort($files1);
    echo "<div class='uploadForm_x'>";

    echo"<table>";
    echo "<tr>";
    echo "<td><h2>Files</h2></td>";
    echo "</tr>";
    foreach ($files1 as $file_act) {
        echo "<tr>";
        $path = $_SESSION['upload_folder'] . "/" . $file_act;
        echo "<td class='colW_1'><a href='$path' target='_blank'>$file_act</a></td>";
        echo "<td class='colW_2'>" . round((filesize($path) / 1024)) . " kb" . "</td>";
//        echo "<td><img src='$path'alt='$path'></td>";
        echo"</tr>";
    }
    echo"</table>";
    echo "</div>";
}
?>
