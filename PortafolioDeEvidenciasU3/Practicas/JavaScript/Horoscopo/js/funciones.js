// Funciones de ejemplo

/*
saluda
Recibe: texto para saludo
Regresa: nada
*/
function saluda(x){
	alert("hola  "+x);
}

/*Funcion para enviar a php para
el archivo valida_cb_phpConScriptExterno.html
	*/
function valida(){
		var bRet = false;
		var i=0;
		var arrCb = document.getElementsByTagName("input");

		if (arrCb!=null){
			for (i=0;i<arrCb.length;i++){
				if (arrCb[i].type=="checkbox" && arrCb[i].checked){
					bRet = true;
					break;
				}
			}
		}
		if (!bRet)
			alert("No hay nada seleccionado");
		return bRet;
	}
