/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

//******************************************************************************

/**
 * Ready-built & styled contact form
 * @returns {undefined}
 */
function add_contact_form() {
    var id_main_container = "contactForm";
    var image_path = "images/contacts_envelope_1.png";
    var alt = "contacts_envelope_1";
    //===
    document.write("<div id=" + id_main_container + ">");
    document.write("<img src=" + image_path + " alt=" + alt + ">");
    document.write("<h2>Contact us</h2>");
    document.write("<form action='submit.php' method='post' id='form_1'>");
    document.write("<label for='name'>Name:</label>");
    document.write("<input class='cfinset' type='text' name='name' size='30' required>");
    document.write("<label for='email'>Email@:</label>");
    document.write("<input class='cfinset' type='email' name='email' size='30' required>");
    document.write("<textarea class='cfinset' name='message' rows='4' cols='45' maxlength='10000'></textarea>");
    document.write("<input id='contactFormSubmitBtn' type='submit' value='Submit'>");
    document.write("</form>");
    document.write("</div>");
}

//CSS
/**
 #contactForm{
 margin-top: 20px;
 margin-left:10px;
 padding-left:10px;
 padding-bottom:5px;
 width:90%;
 display: block;
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
 
 
 #contactForm img{
 display: inline-block;
 float: right;
 margin-top: 30px;
 width: 150px;
 height: 100px;
 }   
 
 #contactForm label{
 font-weight: bold;
 }
 
 #contactForm input{
 margin-bottom: 10px;
 display: block;
 margin-top: 2px;
 }
 
 #contactForm textarea{
 margin-bottom: 5px;
 }
 
 #contactFormSubmitBtn{
 margin-right: 10px;
 float: right;
 }
 
 .cfinset{
 border-style: inset;
 color: black;
 }
 
 */


//PHP
/**
 function recieveSubmitedContactFormData() {
 if (isset($_POST['email']) == false) {
 return;
 }
 
 $name = "";
 $email = "";
 $subject = "Contact attempt by";
 $message = "";
 if (isset($_POST['name'])) {
 $name = $_POST['name'];
 }
 if (isset($_POST['email'])) {
 $email = $_POST['email'];
 }
 if (isset($_POST['message'])) {
 $message = $_POST['message'];
 }
 
 $headers = 'From: webmaster@mixcont.com' . "\r\n" .
 'Reply-To: webmaster@mixcont.com' . "\r\n" .
 'X-Mailer: PHP/' . phpversion();
 
 $msg .= htmlspecialchars($message) . "\r\n" . "\r\n";
 $msg .= 'Sent from ' . $email . "\r\n" . "\r\n" . "\r\n";
 $msg .= 'You cannot answer this mail!' . "\r\n";
 
 
 if (isset($_POST['email'])) {
 //        echo "name = $name  email = $email  msg = $message";
 mail("ask@mixcont.com", "$subject $name with email:$email", $msg, $headers);
 }
 }
 
 */

//******************************************************************************

/**
 * Ready-built & styled contact form
 * OBS! Dont use this one, use the php version instead.
 * The js version cant keep track of the $_SESSION['session_link'] - > 
 * ("<input type='hidden' name='link' value='_test'>"); - > instead for value it should be
 * $_SESSION['session_link']!
 * @returns {undefined}
 */
function add_comment_form_deprecated() {
    var id_main_container = "commentForm";
    var image_path = "images/comment_pencil_1.png";
    var alt = "comment_pencil_1";
    //===
    document.write("<div id=" + id_main_container + ">");
    document.write("<img src=" + image_path + " alt=" + alt + ">");
    document.write("<h2>Comment</h2>");
    document.write("<form action='submit.php' method='post' id='form_1'>");
    document.write("<label for='name'>Name:</label>");
    document.write("<input class='cminset' type='text' name='name' size='30' required>");
    document.write("<label for='rubrik'>Rubrik:</label>");
    document.write("<input class='cminset' type='text' name='rubrik' size='50' required>");
    document.write("<textarea class='cminset' name='comment' rows='4' cols='45' maxlength='10000'></textarea>");
    document.write("<input id='commentFormSubmitBtn' type='submit' value='Submit'>");
    document.write("<input type='hidden' name='link' value='_test'>");
    document.write("</form>");
    document.write("</div>");
}

/**
 * This one should be used!!
 * This is php function 
 * @returns {undefined}
 */
function addCommentForm() {
//    $id_main_container = "commentForm";
//    $image_path = "images/comment_pencil_1.png";
//    $alt = "comment_pencil_1";
//    $link = $_SESSION['session_link'];
//    //===
//    echo ("<div id=" . $id_main_container . ">");
//    echo ("<img src=" . $image_path . " alt=" . $alt . ">");
//    echo ("<h2>Comment</h2>");
//    echo ("<form action='index.php' method='post' id='form_1'>");
//    echo("<label for='name'>Name:</label>");
//    echo("<input class='cminset' type='text' name='name' size='30' required>");
//    echo("<label for='rubrik'>Rubrik:</label>");
//    echo("<input class='cminset' type='text' name='rubrik' size='50' required>");
//    echo("<textarea class='cminset' name='comment' rows='4' cols='45' maxlength='10000'></textarea>");
//    echo("<input id='commentFormSubmitBtn' type='submit' value='Submit'>");
//    echo("<input type='hidden' name='link' value='$link'>");
//    echo("</form>");
//    echo("</div>");
}

//CSS
/**
 * #commentForm{
 margin-top: 30px;
 margin-left:10px;
 padding-left:10px;
 padding-bottom:5px;
 width:47%;
 display: block;
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
 
 #commentForm img{
 display: inline-block;
 float: right;
 margin-right:50px;
 margin-top: 30px;
 width: 80px;
 height: 60px;
 }   
 
 #commentForm label{
 font-weight: bold;
 }
 
 #commentForm input{
 margin-bottom: 10px;
 display: block;
 margin-top: 2px;
 }
 
 #commentForm textarea{
 margin-bottom: 5px;
 }
 
 
 .cminset{
 border-style: inset;
 color: black;
 }
 
 ================================================================================
 
 #commentsArticleArea{
 margin-top: 30px;
 margin-left:10px;
 padding-left:10px;
 padding-bottom:5px;
 width:95%;
 display: block;
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
 
 .comment{
 margin-top: 5px;
 margin-left:10px;
 padding-left:10px;
 width:95%;
 display: block;
 overflow: auto;
 color: black;
 border-bottom-style:solid;
 border-bottom-width:1px;
 }
 
 .nameDate{
 font-size: 10pt;
 color:lightgray;
 }
 
 */

//PHP

/**
 * 
 */

//******************************************************************************
