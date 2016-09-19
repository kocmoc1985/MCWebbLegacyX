<div id="add_form" style="width: 50%" class='slidable_element_container'>
    <img src="images/contacts_envelope_1.png" alt="contact_envelope_1">
    <h2>Send mail</h2>

    <div class='slidable_element'>
        <form action="submit.php" method="post" id="form_1">
            <label>Email@ from:</label>
            <input class="cfinset" type="email" name="from" size="30" required>
            <label>Email@ to:</label>
            <input class="cfinset" type="email" name="to" size="30" required>
            <label>Subject:</label>
            <input class="cfinset" type="text" name="subject" size="60" required >
            <textarea class="cfinset" name="message" rows="4" cols="45" maxlength="10000"></textarea>
            <input id="contactFormSubmitBtn" type="submit" value="Submit">
        </form>
    </div>
    
</div>