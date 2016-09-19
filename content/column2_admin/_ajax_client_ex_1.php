
<?php ?>

<!--Note! The Server path of this AJAX implementation is in "submit.php"-->
<script language = "javascript">
    function showHint(str) {
        var xmlhttp;
        if (str.length == 0)
        {
            document.getElementById("txtHint").innerHTML = "";
            return;
        }
        if (window.XMLHttpRequest)
        {// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        }
        else
        {// code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }

        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
            {
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "submit.php?ajax_ex_1=" + str, true);
        xmlhttp.send();
    }

    /**
     * Send "AJAX/XMLHttpRequest" to the server. 
     * This method is used first in connection with an "AJAX/XMLHttpRequest"
     * @param {String} value_to_send - value to be sent to the server
     * @param {String} recieving_script - the script on the server side which shall recieve this request
     * @param {String} paramter_name - name of the parameter which is used in connection with "$_GET",
     * example: "index.php?link=home" where link is "parameter_name"
     * @returns {String}
     */
    function ajaxRequest(value_to_send, recieving_script, paramter_name) {
        var xmlhttp;
        if (value_to_send.length === 0) {
            document.getElementById("txtHint").innerHTML = "";
            return;
        }
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        }
        else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }

        xmlhttp.open("GET", recieving_script + "?" + paramter_name + "=" + value_to_send, true);
        xmlhttp.send();

        return xmlhttp;
    }
</script>


<!--================================Example_1=========================================-->
<h3>Example 1</h3>
<form action=""> 
    First name: <input type="text" id="txt1" onkeyup="showHint(this.value);" />
</form>
<p>Suggestions: <span id="txtHint"></span></p> 
<!--=========================================================================-->
<!--=========================================================================-->
<!--=========================================================================-->
<!--=========================================================================-->
<!--================================Example_2================================-->
<h3>Example 2</h3>
<form action=""> 
    First name: <input type="text" id="txt2">
</form>
<p>Suggestions: <span id="txtHint2"></span></p> 

<script language = "javascript">
    addEvent(document.getElementById("txt2"), "mouseout", go_2);

    function go_2() {
        xmlhttp = ajaxRequest(getTextFromAtextElement("txt2"), "submit.php", "ajax_ex_1");

//        This code block is very good and easy to use after the "ajaxRequest(...)" method
//        xmlhttp.onreadystatechange = function() {
//            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
//                setText("txtHint2", xmlhttp.responseText);
//            } else {
//                setText("txtHint2", "xmlhttp request failed!");
//            }
//        };

//      You may also use "ajaxRequestReady(....)" method, and it's even better 
        ajaxRequestReady(xmlhttp, functionToExecuteUpponAjaxRequestReady);

        /**
         * This method is used in connection with "ajaxRequest(...)" method and
         * is used after calling "ajaxRequest(...)".
         * @param {XMLHttpRequest} xmlhttp
         * @param {Function} function_to_execute - function to be executed uppon "XMLHttpRequest" is ready
         * @returns {String}
         */
        function ajaxRequestReady(xmlhttp, function_to_execute) {
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                    function_to_execute(xmlhttp.responseText);
                } else {
                    return null;
                }
            };
        }

        function functionToExecuteUpponAjaxRequestReady(text) {
            if (text === null) {
                setText("txtHint2", "null");
            } else if (text === "") {
                setText("txtHint2", "empty");
            } else {
                setText("txtHint2", text);
            }

        }
    }


</script>

<!--=========================================================================-->    