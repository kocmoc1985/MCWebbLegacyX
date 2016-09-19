/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Examples of class usage:
 * bandArr[i].bandNamn
 * bandArr[i].voted
 * bandArr[i].score = score
 * if(bandArr[i].bandNamn == selectedBand)
 */
function Band(namn, score, voted) {
    this.bandNamn = namn;
    this.score = score;
    this.voted = voted;
}

/* Library functions to support correct usage of the DOM according to W3C */
/* 
 * This funktion appends the given text message 
 * as a new TextNode into the element with the labelName
 * given as the parameter insertInto.
 * A new break-element is also inserted after the 
 * new TextNode.
 */
function writeLine(insertInto, message) {
    var insertInElement = document.getElementById(insertInto);
    newText = document.createTextNode(message);
    insertInElement.appendChild(newText);
    newBreak = document.createElement("br");
    insertInElement.appendChild(newBreak);
}
/* 
 *
 *<p>This method is good to use in connection with
 *usage of radio buttons & checkboxes.
 *
 *<ul> Tip! This helps to get are good look when placing labels to the rb and chkboxes
 *<li> width: 100pt;
 *<li> display: inline-block; 
 *</ul>  
 *
 *@Param insertInto - the element into which the container/div with text is going to be placed
 *@Param text - the text to be shown
 *@Param clas - the className of the container/div which contains the "text"
 *@Param newDivID - the id of the container in which the text is placed
 */
function writeLineContainer(insertInto, text, clas, newDivID) {
    var insertInElement = document.getElementById(insertInto);
    var newDiv = document.createElement("div");
    newDiv.className = clas;
    newDiv.id = newDivID;
    var newText = document.createTextNode(text);
    newDiv.appendChild(newText);
    insertInElement.appendChild(newDiv);

}


/**
 * Example of how to add components & attributes with JS
 * @param {type} elem_to_add_to
 * @returns {undefined}
 */
function comentInput(elem_to_add_to) {
    var coment_input_main_container = document.createElement("div");
    setAttribute(coment_input_main_container, "id", "contactForm");
    //===

    var image = document.createElement("img");
    setAttribute(image, "src", "images/contacts_envelope_1.png");
    setAttribute(image, "alt", "contacts_envelope_1");
    coment_input_main_container.appendChild(image);
    //===

    var title = document.createElement("h2");
    var title_text = document.createTextNode("Comment");
    title.appendChild(title_text);
    coment_input_main_container.appendChild(title);

    var form = document.createElement("form");
    setAttribute(form, "action", "index.php");
    setAttribute(form, "method", "post");
    //====

    var label_name = document.createElement("label");
    setAttribute(label_name, "for", "name");

    var label_text = document.createTextNode("Name");
    label_name.appendChild(label_text);

    var input_name = document.createElement("input");
    setAttribute(input_name, "class", "cfinset");
    setAttribute(input_name, "type", "text");
    setAttribute(input_name, "size", "30");
    setAttribute(input_name, "required", "");

    form.appendChild(label_name);
    form.appendChild(input_name);
    //===

    var text_area = document.createElement("textarea");
    setAttribute(text_area, "class", "cfinset");
    setAttribute(text_area, "name", "message");
    setAttribute(text_area, "rows", "4");
    setAttribute(text_area, "cols", "45");
    setAttribute(text_area, "maxlength", "10000");

    form.appendChild(text_area);
    //===
    var submit_btn = document.createElement("input");
    setAttribute(submit_btn, "id", "contactFormSubmitBtn");

    coment_input_main_container.appendChild(form);
    //===

    elem_to_add_to.appendChild(coment_input_main_container);
}

/**
 * 
 * @param {Element} parent
 * @param {Array} footElementArr
 * @param {Array} methodsArr
 * @returns {undefined}
 */
function myAddFooter(parent, footElementArr, methodsArr) {
    try {
        var elementToAddTo = document.getElementById(parent);

        for (i = 0; i < footElementArr.length; i++) {

            var footElement = document.createElement("div");

            var txt = document.createTextNode(footElementArr[i]);

            var spacer = document.createTextNode("  |  "); // this is used to just underlinr/mark the text and not the space arround it

            footElement.appendChild(txt);

            footElement.className = "footelement"; // sets the class of <p>element

            footElement.id = "elem" + i;

            elementToAddTo.appendChild(footElement);

            elementToAddTo.appendChild(spacer);

            addEvent(footElement, "click", methodsArr[i]); //adding an event with the right method
        }

    }
    catch (err) {
        newLineAdjusted("#crasched in: addFooter(x,x,x)# <-> " + err, parent, "p");
    }
}

/**
 *
 *<ul>
 *<li>$parent
 *<li>$name = must exist, otherwise the form element wont work when sending info to target
 *<li>$divID
 *<li>$rows = ex:(5)
 *<li>$cols = ex:(20)
 *<li>$labelName = the text to be shown before the textArea
 *<li>$nrBreaks = nr of br elements after the Element
 *</ul>
 */
function formAddTextArea(parent, name, id, rows, cols, labelName, nrBreaks) {

    if (document.getElementById(id) != null) {//avoid duplicities
        return;
    }

    try {
        var elementToAddTo = document.getElementById(parent);
        var textArea = document.createElement("textarea");
        var label = document.createElement("label");
        var labelText = document.createTextNode(labelName);

        label.appendChild(labelText);
        label.appendChild(document.createElement("br")); // !
        label.appendChild(document.createElement("br"));

        textArea.id = id;
        textArea.name = name;
        textArea.rows = rows;
        textArea.cols = cols;

        elementToAddTo.appendChild(label);
        elementToAddTo.appendChild(textArea);

        for (i = 0; i < nrBreaks; i++) {
            temp = document.createElement("br");
            elementToAddTo.appendChild(temp);
        }

    } catch (err) {
        newLineAdjusted("#crasched in: formAddTextArea(x,x,x,x)# <-> " + err, parent, "p");
    }

}

/**
 *<p>Creates some of the 4 listed most frequent form elements, those
 *could be used as a part of the formular or standalone elements
 *
 *
 *<ul>
 *<li>$parentId - as string must be of type: "form" !
 *<li>$labelName - as string, not the internal name, but the label shown before the component
 *<li>$name - this is used when getting the variable like "$_GET['title']" where title is the name!
 *<li>$value - the value which is sent to the recieving script, not needed for a text field!!
 *<li>$divID - the id of the container in which the input element is placed. (you shold create one & dont forget css!!)
 *<li>$inputElemId - the id of the input(text,checkbox...) element, prosto pridumatj!
 *<li>$formType - supported type of forms:<ul><li>text<li>checkbox<li>password<li>radio</ul>
 *<li>$nrBreaks - number of breaks "br" after each element
 *<li>$nrBreaksLabel - number of breaks after the labelName
 *</ul>
 */
function formAddAnyFormEasyTypes(
        parent,
        labelName,
        name,
        value,
        divID,
        inputElemId,
        formType,
        nrBreaks,
        nrBreaksLabel) {

    if (document.getElementById(divID) != null) {
        return;
    }

    try {

        var elementToAddTo = document.getElementById(parent);

        //

        var newDiv = document.createElement("div");
        newDiv.id = "" + divID;

        var label = document.createElement("label");
        var labelText = document.createTextNode(labelName);

        var input = document.createElement("input");
        input.id = inputElemId;
        input.type = formType;
        input.name = name;
        input.value = value;

        label.appendChild(labelText);

        for (i = 0; i < nrBreaksLabel; i++) {
            label.appendChild(document.createElement("br")); // !
            label.appendChild(document.createElement("br"));//!
        }


        newDiv.appendChild(label);
        newDiv.appendChild(input);
        elementToAddTo.appendChild(newDiv);


        for (i = 0; i < nrBreaks; i++) {
            temp = document.createElement("br");
            elementToAddTo.appendChild(temp);
        }
    } catch (err) {
        newLineAdjusted("#crasched in: formAddAnyFormEasyTypes(x,x,x,x,x)# <-> " + err, parent, "p");
    }
}

/*
 *<ul>
 *<li>$parent 
 *<li>$formID
 *<li>$action = something like: "http://dvwebb.mah.se/~tskral/da120a/lab4_answer.php"
 *<li>$method = the action when the send button is pressed. "post" is most frequent one so far
 *</ul>
 *
 *<p>This method is to be used when using a formular which is to be sent to
 *a target somewhere else. 
 *
 *<p>This form shall work together with the formularAppendYesNoButtons(x) method
 *which adds the Accept/Reject buttons to the form
 *
 *<p>Example for form creation Start with formularAddParentForFormularElements() then
 *<p>formAddAnyFormEasyTypes() then
 *<p>formAddAnyFormEasyTypes() then 
 *<p>formularAppendYesNoButtons() end with
 *
 *
 *<h3>Example: </h3>
 *<ol>
 *<li>formularAddParentForFormularElements("footInfo", "mf", "action", "method");//create form
 *<li>formAddAnyFormEasyTypes("mf", "1-15", "age", "", "radio", 2); // adding elements to the form
 *<li>formAddAnyFormEasyTypes("mf", "15-18", "age", "", "radio", 2);// adding ......
 *<li>formularAppendYesNoButtons("mf"); // appending the yes/no btn to the form
 *</ol>
 *
 */
function formularAddParentForFormularElements(parent, formID, action, method) {
    try {
        var xParent = document.getElementById(parent);

        var formularContainer = document.createElement("form");

        // <form divID ="f1" action="http://dvwebb.mah.se/~tskral/answer.php" method="post">
        formularContainer.id = "" + formID;
        formularContainer.action = "" + action;
        formularContainer.method = "" + method;


        xParent.appendChild(formularContainer);
    } catch (err) {
        newLineAdjusted("#crasched in: formularAddParentForFormularElements(x,x,x,x)# <-> " + err, parent, "p");
    }
}

/**
 *This method is used together with formularAddParentForFormularElements(x,x,x,x).
 *When all elements are added to the "form" this method may be called
 *to add the Accept/Reject buttons for sending the information
 *@Param parentId = must be of "form" type!
 *@Param yesNoBtnId = this id is a must! Its required by DOM rules
 *@Param conatainerId = this is the container where everything is placed
 */
function formularAppendYesNoButtons(parentId, yesNoBtnsId, containerId) {
    try {
        var container = document.createElement("div");
        container.id = containerId;

        //to constraint the ammount of this element to 1
        if (document.getElementById(containerId) != null) {
            return;
        }

        var xParent = document.getElementById(parentId);

        var xTable = document.createElement("table");
        xTable.align = "center";
        var xRow = document.createElement("tr");
        var xCol1 = document.createElement("td");
        var xCol2 = document.createElement("td");
        var xInputOk = document.createElement("input");
        xInputOk.type = "submit";
        xInputOk.id = yesNoBtnsId;//!!
        var xInputNo = document.createElement("input");
        xInputNo.type = "reset";

        xCol1.appendChild(xInputOk);
        xCol2.appendChild(xInputNo);
        xRow.appendChild(xCol1);
        xRow.appendChild(xCol2);
        xTable.appendChild(xRow);

        container.appendChild(xTable);

        xParent.appendChild(container);

    } catch (err) {
        newLineAdjusted("#crasched in: formularAppendYesNoButtons(x)# <-> " + err, parentId, "p");
    }
}


/**
 *Adds a button with eventListener to the given container 'parent'
 *<p><u>Example run:</u>
 *<p>function go(){
 *<p>   labelAddInputLabel("mainText","lbl1");
 *<p>   buttonAddButton("mainText","Ok", "btn1", exampleButtonInputFieldListenerVeryUseful);
 *<p>}
 *<p>
 *<p>function test(){
 *<p>  var text = myGetTextFromAelement("lbl1");
 *<p>  newLineAdjusted(text, "mainText", "h1");
 *<p>}
 *<p>
 *<p>addEvent(window, "load", go);
 *
 *<ul>
 *<li>$parent
 *<li>$btnName
 *<li>$btnId
 *<li>$functionToLaunch = the function to execute uppon the btn click
 *</ul>
 */
function buttonAddButton(parent, btnName, btnId, functionToLaunch) {
    try {
        var elemToAddTo = document.getElementById(parent);

        var form = document.createElement("form");

        form.type = "action";

        var btn = document.createElement("input");

        btn.id = "" + btnId;
        btn.type = "button";
        btn.value = "" + btnName;

        form.appendChild(btn);

        elemToAddTo.appendChild(form);
        elemToAddTo.appendChild(btn);

        addEvent(btn, "click", functionToLaunch);

    } catch (err) {
        newLineAdjusted("#crasched in: buttonAddButton(x,x,x,x)# <-> " + err, parent, "p");
    }
}


/**
 *This function creates a table dynamicly.
 *This applies only for 1 column
 *
 *<p><u>Example: arrX = new Array(2)</u>;
 *<p>   arrX[0] = "Hej";
 *<p>  arrX[1] = "Hallo";
 *<p> createTable("mainText",arrX);
 *
 *<ul>
 *<li>$parent = the element to which the table element is added
 *<li>$arrayX = the array with values which are to be added to the column
 *<ul>
 */
function tableCreate1ColTableWithArray(parent, arrayX) {

    try {

        var elemToInsertTo = document.getElementById(parent);

        var table = document.createElement("table");

        table.border = "1";

        table.width = "200";

        var tBody = document.createElement("tbody");

        table.appendChild(tBody);

        for (i = 0; i < arrayX.length; i++) {

            var val = document.createTextNode(arrayX[i]);

            var nRowTR = document.createElement("tr");

            var nColTD = document.createElement("td");

            nColTD.appendChild(val);

            tBody.appendChild(nRowTR);

            nRowTR.appendChild(nColTD);

        }
        elemToInsertTo.appendChild(table);
    } catch (err) {
        newLineAdjusted("#crasched in:tableCreate1ColTableWithArray(x,x,x,x)# <-> " + err, parent, "p");
    }
}

/**
 *This function creates a table dynamicly.
 *This applies for 2 columns. 
 *This is good to use in a loop!
 *
 *<p><u>Example:</u>;
 *<p>addToExistingTable("mainText", "Hej", "HEllo");
 *<p>addToExistingTable("mainText", "Haj", "Privet");
 *
 *<ul>
 *<li>$parent = the element to which the table element is added
 *<li>$var1 = cell1 text
 *<li>$var2 = cell2 text
 *</ul>
 */
function table2ColTableCreate(parent, var1, var2) {

    //1.Get the element to which the data is to be added
    var elemToInsertTo = document.getElementById(parent);

    //1.2 Create the table element
    var table = document.createElement("table");

    //1.3 adjust the table element
    table.border = "1";
    table.width = "200";

    //1.4 create the tbody element
    var tBody = document.createElement("tbody");

    //1.5 add the tbody to the table
    table.appendChild(tBody);

    //2.Create text for the cells
    var text1 = document.createTextNode("" + var1);
    var text2 = document.createTextNode("" + var2);


    //3.create new cells <td>
    var txtCell1 = document.createElement("td");
    var txtCell2 = document.createElement("td");

    //4.Add text to the cells
    txtCell1.appendChild(text1);
    txtCell2.appendChild(text2);

    //5.Create new table row
    var newRow = document.createElement("tr");

    //6.Add cells to the row
    newRow.appendChild(txtCell1);
    newRow.appendChild(txtCell2);

    //6.2 add newRow to the tBody element
    tBody.appendChild(newRow)

    //7.Add the row to the table
    elemToInsertTo.appendChild(table);
}


////<newLinesDynamic(parent,elemArr,divID,clas)>
/**
 * Adds multiple tags in batch, can also handle 
 * 
 * Note that the added div with elements can be adjuste via CSS
 * with the divID given in the parameters: 
 * 
 * <ul>
 * <li>#footSection{
 * <li>background-color:beige;
 * <li>width: 300pt;
 * <li>height: auto;
 * <li>margin-top: 5%;
 * <li>margin-left:auto;
 * <li>margin-right:auto;
 * <li>text-align: left;   
 * <li>}
 * </ul>
 * 
 *<ul> 
 *<li>$parent = the element to with the child ("p" or "h1", is going to be added to)
 *<li>$elemArr = the Array containing of MyElement class
 *<li>$id = the id of the div to which all elements are added from the array (elemArr)
 *<li>$clas = the class of the elements inside their parent (newDiv)
 *</ul>
 */
function newLinesDynamic(parent, elemArr, id, clas) {

    if (document.getElementById(id) != null) {// To display only once
        try {
            var parentt = document.getElementById(parent);
            parentt.removeChild(document.getElementById(id));
        } catch (err) {
            newLineAdjusted("#crasched in:newLineDynamic(x,x,x,x)# <-> " + err, parent, "p");
        }
    }

    //create the div for all the elements which are added from the arr
    var newDiv = document.createElement("div");
    newDiv.id = "" + id;

    for (i = 0; i < elemArr.length; i++) {

        //get the parent for all elements created in this method
        var elemToInsertTo = document.getElementById(parent);

        //Create the texnode from the in param text
        var textToInsert = document.createTextNode(elemArr[i].text);

        //Create the element with tag from the array
        var line = document.createElement(elemArr[i].tag);
        line.className = "" + clas;

        if (elemArr[i].link == true) { //has link = true
            nlml01_link(elemArr, line, newDiv, elemToInsertTo, textToInsert);

        } else { // dont have link
            nlml02_usual(line, newDiv, elemToInsertTo, textToInsert);
        }

    }
}

/**
 * Handles element with "link" or more precisly a text snippet which
 * can be pressed
 */
function nlml01_link(elemArr, line, newDiv, elemToInsertTo, textToInsert) {
    var linktext = document.createTextNode(elemArr[i].linktext);
    var link = document.createElement("div");
    link.id = "questionLink";
    link.appendChild(linktext);
    line.appendChild(textToInsert);
    newDiv.appendChild(line);
    addEvent(link, "click", questionLinkEvent);
    newDiv.appendChild(link);
    elemToInsertTo.appendChild(newDiv);
}

/**
 * Normal flow
 */
function nlml02_usual(line, newDiv, elemToInsertTo, textToInsert) {
    //add text to the element
    line.appendChild(textToInsert);
    //Insert the line to the parent in case of UL absence
    newDiv.appendChild(line);
    elemToInsertTo.appendChild(newDiv);
    //insert break
    var newBreak = document.createElement("br");
    newDiv.appendChild(newBreak);
}

/////</newLinesDynamic(parent,elemArr,divID,clas)>



/*
 *
 */
function addListenersExample() {
    //document.getElementById("add") "add" divID of the element to which
    //the listener is to be attached
    var addButton = document.getElementById("add");
    //the method which is called uppon the button clicking shoul be called without
    // this ones (), so like that- method not method()
    addEvent(addButton, "click", howTo_ArrayDeclaration);
}


/*
 *Normaly should the addEvent be used, this way of adding events is a bit outdated
 *@Param elemToAddTo = the element to which the event is attached
 *@Param eventType = onblur,onchange,onclick,ondblclick,onfocus,onkeydown ....
 *@Param eventFunction = the function to be executed
 *@Deprecated
 */
function addEvent2(elemToAddTo, eventType, eventFunction) {

    var elementToAddTo = document.getElementById(elemToAddTo);

    if (elementToAddTo === null) {
        newLine(elemToAddTo, "addEvent2:Element not found!");
    }

    switch (eventType) {
        case "onblur":
            elementToAddTo.onblur = eventFunction;
            break;
        case "onchange":
            elementToAddTo.onchange = eventFunction;
        case "onclick":
            elementToAddTo.onclick = eventFunction;
            break;
        case "ondblclick":
            elementToAddTo.ondblclick = eventFunction;
            break;
        case "onerror":
            elementToAddTo.onerror = eventFunction;
            break;
        case "onfocus":
            elementToAddTo.onfocus = eventFunction;
            break;
        case "onkeydown":
            elementToAddTo.onkeydown = eventFunction;
            break;
        case "onkeypress":
            elementToAddTo.onkeypress = eventFunction;
            break;
        case "onkeyup":
            elementToAddTo.onkeyup = eventFunction;
            break;
        case "onload":
            elementToAddTo.onload = eventFunction;
            break;
        case "onmousedown":
            elementToAddTo.onmousedown = eventFunction;
            break;
        case "onmousemove":
            elementToAddTo.onmousemove = eventFunction;
            break;
        case "onmouseout":
            elementToAddTo.onmouseout = eventFunction;
            break;
        case "onmouseover":
            elementToAddTo.onmouseover = eventFunction;
            break;
        case "onmouseup":
            elementToAddTo.onmouseup = eventFunction;
            break;
        case "onresize":
            elementToAddTo.onresize = eventFunction;
            break;
        case "onselect":
            elementToAddTo.onselect = eventFunction;
            break;
        case "onunload":
            elementToAddTo.onunload = eventFunction;
            break;
        default:
            //            elementToAddTo.onclick = eventFunction;
    }
}


/**
 * 
 */
function howTo_ArrayDeclaration() {
    document.writeln(" <h1 style=\"background-color: blue\">***********************************</h1>");
    document.writeln("<h1>Var x = new Array(10);</h1>")
    document.writeln("<h2>x[0] = \"ggg\";</h2>");
    document.writeln("<h2>x[1] = 5;</h2>");
    document.writeln("<h3>So the array may contain both Numerical and String values!!!!</h3>");
    document.writeln(" <h1 style=\"background-color: blue\">***********************************</h1>");
}

