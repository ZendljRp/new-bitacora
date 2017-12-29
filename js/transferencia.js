function hacerTransferencia(){
	var divError = document.getElementById("divError");
	var cuenta1 = document.getElementById("cuenta1").value;
	var importe = document.getElementById("importe").value;
	var clave1 = document.getElementById("clave1").value;
	var cuenta2 = document.getElementById("cuenta2").value;
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
					document.getElementById("cuenta1").value = "";
					document.getElementById("importe").value = "";
					document.getElementById("clave1").value = "";
					document.getElementById("cuenta2").value = "";
				} else {
					divError.innerHTML = "<p>" + rpta.message + "</p>";
				}
			} else {
				divError.innerHTML = "<p>" + http.statusText + "</p>";
			}
		}
	}
	http.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	http.send("action=doTransferencia&cuenta1=" + cuenta1 + "&importe=" + importe +
		"&clave1=" + clave1 + "&cuenta2=" + cuenta2);
}