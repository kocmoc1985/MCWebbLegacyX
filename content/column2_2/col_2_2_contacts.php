
<style type="text/css">

    #contactFormSubmitBtn{
        margin-right: 10px;
        float: right;
    }

</style>

<?php
$prefix = $_SESSION["company_prefix"];
$_SESSION['link_session'] = "col_2_2_info_manuals_main&value=$prefix";
?>

<div id="add_form" style="width: 65%;padding-top: 20px">
    <img src="images/contacts_envelope_1.png" alt="contact_envelope_1" style="margin-top: 5px;margin-bottom: 10px">

    <form action="submit.php" method="post" id="form_1">
        <label for="name">Name:</label>
        <input class="cfinset" type="text" name="name" size="30" required >
        <label for="email">Email@:</label>
        <input class="cfinset" type="email" name="email" size="30" required>
        <textarea class="cfinset" name="message" rows="4" cols="45" maxlength="10000"></textarea>
        <input id="contactFormSubmitBtn" type="submit" value="Submit">
    </form>
</div>


