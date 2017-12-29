function hacerDeposito(){
	var divError = document.getElementById("divError");
	var cuenta = document.getElementById("cuenta").value;
	var importe = document.getElementById("importe").value;
	var url = "../controller/CuentaController.php";
	var http = getXMLHTTPRequest();
	http.open("POST", url, true);
	http.onreadystatechange = function(){
		if (http.readyState == 4) {
			if(http.status == 200) {
				var rpta =  eval( "(" + http.responseText + ")" );
				if( rpta.state == 1 ){
					divError.innerHTML = "";
					alert(rpta.message);
					document.getElementById("cuenta").value = "";
					document.getElementById("importe").value = "";
				} else {
					divError.innerHTML = "<p>" + rpta.message + "</p>";
				}
			} else {
				divError.innerHTML = "<p>" + http.statusText + "</p>";
			}
		}
	}
	http.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	http.send("action=doDeposito&cuenta=" + cuenta + "&importe=" + importe);
}