<style type="text/css">
    .browser{
        position:relative;
        display:block;
        padding:0px;
        margin:0px;
        width:350px;
        height:300px;
        font-size:12px;
        font-family:tahoma;
        color:#222222;
        border:1px solid #888888;
    }

    .pfilter{
        padding:2px;
        margin:0px;
        height:24px;
    }
    .pfilter input[type="button"]{
        padding:1px 2px;
        margin:0px;
        color:#222222;
        border:1px solid #666666;
        background-color:#EEEEEE;
        cursor:pointer;
    }

    .pfilter input[type="text"]{
        padding:0px 2px;
        margin:0px;
        width:170px;
        height:18px;
        border:1px solid #666666;
    }

    .pPathDisplay{
        padding:2px;
        margin:0px;
        height:18px;
        background-color:#777777;
        color:#FFFFFF;
        white-space:nowrap;
        overflow:hidden;
    }

    .dvContents{
        padding:0px;
        margin:0px;
        width:100%;
        height:250px;
        overflow:auto;
    }

    .item{
        padding:3px 0px 3px 23px;
        margin:0px;
        line-height:20px;
        height:20px;
        vertical-align:middle;
        white-space:nowrap;
        cursor:pointer;
        background-position: 3px 50%;
        background-repeat:no-repeat;
    }

    .item:hover{
        background-color:yellow;
    }

    .item{
        background-image:url(./images/page_white.png);
    }

    .odd{
        background-color:#EEEEEE;

    }

    .even{
        background-color:#DDDDDD;
    }

    .item.ft_folder{
        background-image:url(./images/folder.png);
    }

    .item.ft_pdf{
        background-image:url(./images/page_white_acrobat.png);
    }

    .item.ft_cs{
        background-image:url(./images/page_white_csharp.png);
    }

    .item.ft_xls{
        background-image:url(./images/page_white_excel.png);
    }

    .item.ft_swf{
        background-image:url(./images/page_white_flash.png);
    }

    .item.ft_php{
        background-image:url(./images/page_white_php.png);
    }

    .item.ft_png,
    .item.ft_jpg,
    .item.ft_bmp,
    .item.ft_gif{
        background-image:url(./images/page_white_picture.png);
    }

    .item.ft_txt,
    .item.ft_js,
    .item.ft_css{
        background-image:url(./images/page_white_text.png);
    }

    .item.ft_htm,
    .item.ft_html{
        background-image:url(./images/page_white_code.png);
    }

    .item.ft_rar,
    .item.ft_zip{
        background-image:url(./images/page_white_compressed.png);
    }
</style>



<script type="text/javascript">
    function Ajax() {
        this.Method = "GET";//String "GET" or "POST"
        this.URL = null;// String
        this.ResponseHandler = null;// Function
        this.ErrorHandler = null;// Function
        this.Request = null;
        this.Async = true;// Boolean
        this.Data = null;// String name=value pairs
        this.ResponseFormat = "text"; //String text, xml, request, object or json
        this.ObjectState = null; //object can be used to send some info to the response handler function
        this.init = function() {
            if (!this.Request) {
                try {
                    // Try to create object for Firefox, Safari, IE7, etc.
                    this.Request = new XMLHttpRequest();
                }
                catch (e) {
                    try {
                        // Try to create object for later versions of IE.
                        this.Request = new ActiveXObject('MSXML2.XMLHTTP');
                    }
                    catch (e) {
                        try {
                            // Try to create object for early versions of IE.
                            this.Request = new ActiveXObject('Microsoft.XMLHTTP');
                        }
                        catch (e) {
                            // Could not create an XMLHttpRequest object.
                            return false;
                        }
                    }
                }
            }

            if (this.Request.overrideMimeType) {
                if (this.ResponseFormat.toLowerCase() == "text")
                    this.Request.overrideMimeType('text/html');
                if (this.ResponseFormat.toLowerCase() == "xml")
                    this.Request.overrideMimeType('text/xml');
            }
            return this.Request;
        }

// converting an object to name=value pairs
        this.decode = function(obj) {
            if (typeof obj == "object") {
                var urlstr = "";
                for (var k in obj) {
                    if (typeof obj[k] == "object") {// should be an array
                        for (var i = 0; i < obj[k].length; i++) {
                            urlstr += k + "=" + encodeURIComponent(obj[k][i]) + "&";
                        }
                    } else {
                        urlstr += k + "=" + encodeURIComponent(obj[k]) + "&";
                    }
                }
                if (urlstr.length > 0)
                    urlstr = urlstr.substr(0, urlstr.length - 1);
            } else
                urlstr = obj;
            return urlstr;
        }

// coverting name=value to pairsobject
        this.encode = function(str) {
            if (typeof obj == "string") {
                var obj = {};
                var objArr = str.split("&");
                for (var i = 0; i < objArr.length; i++) {
                    var kv = objArr[i].split("=");
                    if (kv.length == 2)
                        obj[kv[0]] = decodeURIComponent(kv[1]);
                }
            } else
                obj = str;
            return obj;
        }

        this.Send = function() {
            if (!this.init()) {
                alert('Could not create XMLHttpRequest object.');
                return;
            }
            var self = this; // Fix loss-of-scope in inner function
            self.ResponseFormat = self.ResponseFormat.toLowerCase();
            this.Request.onreadystatechange = function() {
                var resp = null;
                if (self.Request.readyState == 4) {

                    switch (self.ResponseFormat.toLowerCase()) {
                        case "text":
                            resp = self.Request.responseText;
                            break;

                        case "xml":
                            resp = self.Request.responseXML;
                            break;

                        case "request":
                            resp = self.Request;
                            break;

                        case "object":
                            resp = self.encode(self.Request.responseText);
                            break;

                        case "json":
                            if (self.Request.responseText == "") {
                                resp = null;
                            } else {
                                // check for Native JSON support (IE8+, FF3.5+, Safari 4+, Opera 10+, Chrome 4+), use eval if failed
                                if (window.JSON)
                                    resp = JSON.parse(self.Request.responseText);
                                else
                                    resp = eval('(' + self.Request.responseText + ')');
                            }
                            break;
                    }
                    if (!self.Async) {
                        if (self.ResponseHandler != null)
                            self.ResponseHandler(resp, self.ObjectState);
                        if (self.Request.onload)
                            self.Request.onload = null;
                    }
                    if (self.Request.status >= 200 && self.Request.status <= 304) {

                        // when Async=false (none synchronized request)
                        // chrome triggers onLoad + onStateChange 
                        // FF triggers onLoad, IE triggers onStateChange
                        if (self.ResponseHandler != null)
                            self.ResponseHandler(resp, self.ObjectState);
                        if (self.Request.onload)
                            self.Request.onload = null;
                    } else {
                        if (self.ErrorHandler != null)
                            self.ErrorHandler(resp);
                        else
                            alert("Problem while connecting to the server, Please refresh the page and try again");
                    }
                }
            };

            if (this.Request.onload)
                this.Request.onload = this.Request.onreadystatechange
            if (this.Method.toLowerCase() == "get") {
                this.URL += "?" + this.decode(this.Data)
                this.Data = null
            } else {
                this.Data = this.decode(this.Data)
            }
            this.Request.open(this.Method, this.URL, this.Async);
            if (this.Method.toLowerCase() == "post")
                this.Request.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
            this.Request.send(this.Data);
        };


// abort
        this.abort = function() {
            if (this.Request) {
                this.Request.onreadystatechange = function() {
                };
                this.Request.abort();
                this.Request = null;
            }
            ;
        };

    }
    ;
</script>

<script type="text/javascript">
    function browser(params) {
        if (params == null)
            params = {};
        if (params.contentsDisplay == null)
            params.contentsDisplay = document.body;
        if (params.currentPath == null)
            params.currentPath = "";
        if (params.filter == null)
            params.filter = "";
        if (params.loadingMessage == null)
            params.loadingMessage = "Loading...";
        if (params.data == null)
            params.data = "";

        var search = function() {
            if (params.pathDisplay != null)
                params.pathDisplay.innerHTML = params.loadingMessage;

            var f = typeof(params.filter) == "object" ? params.filter.value : params.filter;
            var a = new Ajax();
            with (a) {
                Method = "POST";
                URL = "ajax.php";
                Data = "path=" + params.currentPath + "&filter=" + f + "&data=" + params.data;
                ResponseFormat = "json";
                ResponseHandler = showFiles;
                Send();
            }
        }

        if (params.refreshButton != null)
            params.refreshButton.onclick = search;

        var showFiles = function(res) {
            if (params.pathDisplay != null) {
                var p = res.currentPath;
                p = p.replace(/^(\.\.\/|\.\/|\.)*/g, "");

                if (params.pathDisplay != null) {
                    params.pathDisplay.title = p;
                    if (params.pathMaxDisplay != null) {
                        if (p.length > params.pathMaxDisplay)
                            p = "..." + p.substr(p.length - params.pathMaxDisplay, params.pathMaxDisplay);
                    }
                    params.pathDisplay.innerHTML = "[Rt:\] " + p;
                }
            }

            params.contentsDisplay.innerHTML = "";
            var oddeven = "odd";

            for (i = 0; i < res.contents.length; i++) {
                var f = res.contents[i];
                var el = document.createElement("p");
                with (el) {
                    setAttribute("title", f.fName);
                    setAttribute("fPath", f.fPath);
                    setAttribute("fType", f.fType);
                    className = oddeven + " item ft_" + f.fType;
                    innerHTML = f.fName;
                }
                params.contentsDisplay.appendChild(el);
                oddeven = (oddeven == "odd") ? "even" : "odd";
                el.onclick = selectItem;
            }
        }

        var selectItem = function() {
            var ftype = this.getAttribute("fType");
            var fpath = this.getAttribute("fPath");
            var ftitle = this.getAttribute("title");

            if (params.onSelect != null)
                params.openFolderOnSelect = params.onSelect({"type": ftype, "path": fpath, "title": ftitle, "item": this}, params);
            if (params.openFolderOnSelect == null)
                params.openFolderOnSelect = true;

            if (ftype == "folder" && params.openFolderOnSelect) {
                params.currentPath = fpath;
                search();
            }
        }

        search();
    }
</script>

<script type="text/javascript">
    $(document).ready(function() {
        init();
    });

    function init() {
        browser({
            contentsDisplay: document.getElementById("dvContents"),
            refreshButton: document.getElementById("btnrefresh"),
            pathDisplay: document.getElementById("pPathDisplay"),
            filter: document.getElementById("txtFilter"),
            currentPath: "images"
        });
    }
</script>

<div id="add_form" style="width: 50%;" >
    <div class="browser" style="margin-left: auto;margin-right: auto;margin-bottom: 20px;margin-top: 20px;width: 95%" >
        <p class="pfilter">File types filter
            <input type="text" id="txtFilter" value=""/>
            <input type="button" value="Refresh" id="btnrefresh"/>
        </p>
        <p id="pPathDisplay" class="pPathDisplay">Loading...</p>
        <div id="dvContents" class="dvContents"></div>
    </div>
</div>

