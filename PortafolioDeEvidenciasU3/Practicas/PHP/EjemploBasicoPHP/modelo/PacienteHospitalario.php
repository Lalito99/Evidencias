<?php
/*
Archivo:  PersonalHospitalario.php
Objetivo: clase que encapsula la información de una persona que labora en el hospital
Autor:    
*/
include_once("AccesoDatos.php");
include_once("Persona.php");
class PacienteHospitalario extends Persona{
	private $nIdPac=0;
	
    
    function setIdPac($Idp){
       $this->nIdPac = $Idp;
    }   
    function getIdPac(){
       return $this->nIdPac;
    }
	
	/*Busca por clave, regresa verdadero si lo encontró*/
	function buscar(){
	$oAccesoDatos=new AccesoDatos();
	$sQuery="";
	$arrRS=null;
	$bRet = false;
		if ($this->nIdPac==0)
			throw new Exception("PacienteHospitalario->buscar(): faltan datos");
		else{
			if ($oAccesoDatos->conectar()){
		 		$sQuery = " SELECT sNombre, sApePat, sApeMat, dFecNacim, 
								  sSexo, salergias 
							FROM paciente
							WHERE nidpac = ".$this->nIdPac;
				$arrRS = $oAccesoDatos->ejecutarConsulta($sQuery);
				$oAccesoDatos->desconectar();
				if ($arrRS){
					$this->sNombre = $arrRS[0][0];
					$this->sApePat = $arrRS[0][1];
					$this->sApeMat = $arrRS[0][2];
					$this->dFechaNacim = DateTime::createFromFormat('Y-m-d',$arrRS[0][3]);
					$this->sSexo = $arrRS[0][4];
					$this->sAlergia = $arrRS[0][5];
					$bRet = true;
				}
			} 
		}
		return $bRet;
	}
	/*Insertar, regresa el número de registros agregados*/
	function insertar(){
	$oAccesoDatos=new AccesoDatos();
	$sQuery="";
	$nAfectados=-1;
		if ($this->sNombre == "" OR $this->sApePat == "" OR 
		    $this->sSexo == "" OR $this->sAlergia == "" OR $this->dFechaNacim==null)
			throw new Exception("PacienteHospitalario->insertar(): faltan datos");
		else{
			if ($oAccesoDatos->conectar()){
		 		$sQuery="INSERT INTO paciente (sNombre, sApePat, sApeMat, dFecNacim,sSexo, sAlergias)
        VALUES ('".$this->sNombre."','".$this->sApePat."','".$this->sApeMat."','".$this->dFechaNacim->format('Y-m-d')."','".$this->sSexo."','".$this->sAlergia."');";
				$nAfectados = $oAccesoDatos->ejecutarComando($sQuery);
				$oAccesoDatos->desconectar();			
			}
		}
		return $nAfectados;
	}
	
	/*Modificar, regresa el número de registros modificados*/
	function modificar(){
	$oAccesoDatos=new AccesoDatos();
	$sQuery="";
	$nAfectados=-1;
		if ($this->nIdPac==0 OR $this->sNombre == "" OR $this->sApePat == "" OR 
		    $this->sSexo == "" OR 
		    $this->sAlergia == ""  OR $this->dFechaNacim==null)
			throw new Exception("PacienteHospitalario->modificar(): faltan datos");
		else{
			if ($oAccesoDatos->conectar()){
		 		$sQuery ="UPDATE paciente
        SET sNombre= '".$this->sNombre."' ,sApePat= '".$this->sApePat."' ,sApeMat='".$this->sApeMat."',
				dFecNacim = '".$this->dFechaNacim->format('Y-m-d')."',ssexo = '".$this->sSexo."'
				,sAlergias='".$this->sAlergia."' WHERE nidpac=".$this->nIdPac;
				$nAfectados = $oAccesoDatos->ejecutarComando($sQuery);
				$oAccesoDatos->desconectar();
			}
		}
		return $nAfectados;
	}
	
	/*Borrar, regresa el número de registros eliminados*/
	function borrar(){
	$oAccesoDatos=new AccesoDatos();
	$sQuery="";
	$nAfectados=-1;
		if ($this->nIdPac==0)
			throw new Exception("PacienteHospitalario->borrar(): faltan datos");
		else{
			if ($oAccesoDatos->conectar()){
		 		$sQuery = "DELETE FROM paciente 
							WHERE nIdPac = ".$this->nIdPac;
				$nAfectados = $oAccesoDatos->ejecutarComando($sQuery);
				$oAccesoDatos->desconectar();
			}
		}
		return $nAfectados;
	}
	
	/*Busca todos los registros del personal hospitalario, 
	 regresa falso si no hay información o un arreglo de PersonalHospitalario*/
	function buscarTodos(){
	$oAccesoDatos=new AccesoDatos();
	$sQuery="";
	$arrRS=null;
	$aLinea=null;
	$j=0;
	$oPersHosp=null;
	$arrResultado=false;
		if ($oAccesoDatos->conectar()){
		 	$sQuery = "SELECT nIdPac,sNombre, sApePat, sApeMat, 
							  dFecNacim, sSexo, sAlergias 
				FROM paciente 
				ORDER BY nIdPac";
			$arrRS = $oAccesoDatos->ejecutarConsulta($sQuery);
			$oAccesoDatos->desconectar();
			if ($arrRS){
				foreach($arrRS as $aLinea){
					$oPersHosp = new PacienteHospitalario();
					$oPersHosp->setIdPac($aLinea[0]);
					$oPersHosp->setNombre($aLinea[1]);
					$oPersHosp->setApePat($aLinea[2]);
					$oPersHosp->setApeMat($aLinea[3]);
					$oPersHosp->setFechaNacim(DateTime::createFromFormat('Y-m-d',$aLinea[4]));
					$oPersHosp->setSexo($aLinea[5]);
					$oPersHosp->setsAlergia($aLinea[6]);
            		$arrResultado[$j] = $oPersHosp;
					$j=$j+1;
                }
			}
			else
				$arrResultado = false;
        }
		return $arrResultado;
	}
}
?>