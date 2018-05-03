//Valida que se escriba un número en el campo
	function valida(campo){
		var bRet = false;
		if (campo.value == "")
			alert("Faltan datos");
		else{
			if (isNaN(campo.value)){
				alert("No es un número");
				campo.value = ""; //limpia el campo
			}
			else
				bRet = true;
		}
		return bRet;
	}
