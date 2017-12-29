function funcLogon(){
    var divError = document.getElementById("divError");
    var usuario  = document.getElementById("usuario").value;
    var clave    = document.getElementById("clave").value;
    var url      = "../controller/LogonController.php";
    var http     = getXMLHTTPRequest();
    http.open("POST", url, true);
    http.onreadystatechange = function(){
        if (http.readyState == 4) {
            if(http.status == 200) {
                var rpta =  eval( "(" + http.responseText + ")" );
                if( rpta.state == 1 ){
                    document.location.href = "main.php";
                } else {
                    divError.innerHTML = "<p>" + rpta.message + "</p>";
                }
            } else {
                divError.innerHTML = "<p>" + http.statusText + "</p>";
            }
        }
    };
    http.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    http.send("action=doProcesar&usuario=" + usuario + "&clave=" + clave);
}