function initPage(){
	cargarClientes();
	cargarMonedas();
}

function cargarClientes(){
	var divCliente = document.getElementById("divCliente");
	var divError = document.getElementById("divError");
	var url = "../controller/CuentaController.php";
	var http = getXMLHTTPRequest();
	http.open("POST", url, true);
	http.onreadystatechange = function(){
		if (http.readyState == 4) {
			if(http.status == 200) {
				var rpta =  http.responseText;
				divCliente.innerHTML = rpta;
			} else {
				divError.innerHTML = "<p>" + http.statusText + "</p>";
			}
		}
	}
	http.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	http.send("action=doTraerClientes");
}

function cargarMonedas(){
	var divMoneda = document.getElementById("divMoneda");
	var divError = document.getElementById("divError");
	var url = "../controller/CuentaController.php";
	var http = getXMLHTTPRequest();
	http.open("POST", url, true);
	http.onreadystatechange = function(){
		if (http.readyState == 4) {
			if(http.status == 200) {
				var rpta =  http.responseText;
				divMoneda.innerHTML = rpta;
			} else {
				divError.innerHTML = "<p>" + http.statusText + "</p>";
			}
		}
	}
	http.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	http.send("action=doTraerMonedas");
}

function crearCuenta(){
	var divError = document.getElementById("divError");
	var cliente = document.getElementById("cliente").value;
	var importe = document.getElementById("importe").value;
	var clave = document.getElementById("clave").value;
	var moneda = document.getElementById("moneda").value;
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
					document.getElementById("importe").value = "";
					document.getElementById("clave").value = "";
				} else {
					divError.innerHTML = "<p>" + rpta.message + "</p>";
				}
			} else {
				divError.innerHTML = "<p>" + http.statusText + "</p>";
			}
		}
	}
	http.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	http.send("action=doCrearCuenta&cliente=" + cliente + "&importe="
		+ importe + "&clave=" + clave + "&moneda=" + moneda);
}