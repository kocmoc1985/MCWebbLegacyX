<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<style type="text/css">
    #contactInfo{
        margin-top: 20px;
        margin-left:10px;
        padding-left:10px;
        padding-bottom:5px;
        width:90%;
        overflow: auto;

        color: black;

        /* drop shadow */
        -webkit-box-shadow: 0px 5px 5px 0px #444;
        -moz-box-shadow: 0px 5px 5px 0px #444;
        box-shadow: 0px 5px 5px 0px #444;

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

    #contactInfo table{
        font-size: 12pt; 
        width: 80%;
        text-align: left;
    }

    .imgIcon{
        margin-right: 15px;
        width: 40px;
        height: 40px;
    }

    .imgText{

    }

    /******************************************************************************/


    #contactFormSubmitBtn{
        margin-right: 10px;
        float: right;
    }

</style>

<div id="contactInfo">
    <h2>Contact info</h2>

    <table>

        <tr>
            <td><img class="imgIcon" src="images/contacts_address_1.png" alt="contacts_address_1"></td>
            <td><img src="images/contacts_addr_txt.png" alt="contacts_addr_txt"></td>
            <!--<td>Johan Kocksgatan 7, 231 45, Trelleborg, Sweden</td>-->
        </tr>

        <tr>
            <td><img class="imgIcon" src="images/contacts_telephone_1.png" alt="contacts_telephone_1"></td>
            <td><img src="images/contacts_tel_txt.png" alt="contacts_tel_txt"></td>
            <!--<td>+46-708551764</td>-->
        </tr>

        <tr>
            <td><img class="imgIcon" src="images/contacts_fax_1.png" alt="contacts_fax_1"></td>
            <td><img src="images/contacts_fax_txt.png" alt="contacts_fax_txt"></td>
            <!--<td>+46-41043980</td>-->
        </tr>

        <tr>
            <td><img class="imgIcon" src="images/contacts_email_1.png" alt="email_fax_1"></td>
            <td><img src="images/contacts_email_txt.png" alt="contacts_email_txt"></td>
            <!--<td>ask@mixcont.com</td>-->
        </tr>

    </table>
</div>


<!--    if you have "id = "form1" property for the <form> tag it means that you can use
   <input> tags outside the form, but you must refer to this form like:
   "<input type="text" name="lname" form="form1"> "-->
<div id="add_form" style="width: 90%;margin-left: 10px;">
    <img src="images/contacts_envelope_1.png" alt="contact_envelope_1">
    <h2>Contact us</h2>

    <form action="submit.php" method="post" id="form_1">
        <label for="name">Name:</label>
        <input class="cfinset" type="text" name="name" size="30" required >
        <label for="email">Email@:</label>
        <input class="cfinset" type="email" name="email" size="30" required>
        <textarea class="cfinset" name="message" rows="4" cols="45" maxlength="10000"></textarea>
        <input id="contactFormSubmitBtn" type="submit" value="Submit">
    </form>
</div>

<!--You can also use this js script to add form-->
<!--<script language="javascript">
add_contact_form();
</script>-->
