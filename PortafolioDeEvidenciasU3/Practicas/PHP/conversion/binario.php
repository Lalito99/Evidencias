<?php
$numero=$_POST['numero'];
$conversion=$_POST['conversion'];
function Binario($numero) { 
    $resultado = 0;
        $exponente = 1;
        do{ 
                $digito = $numero % 2;
                $numero = floor($numero / 2); //4
                $resultado = $resultado + $digito * $exponente;//
                $exponente = $exponente * 10;   
        }while($numero > 0);
        echo "$resultado";
}
function dec2hex($numero)
{
    $hexvalues = array('0','1','2','3','4','5','6','7',
               '8','9','A','B','C','D','E','F');
    $hexval = '';
     while($numero != '0')
     {
        $hexval = $hexvalues[bcmod($numero,'16')].$hexval;  
        $numero = bcdiv($numero,'16',0);
    }
    return $hexval;
}

switch ($conversion) {
	case 'Hexadecimal':
		echo('<br><br><br>');
		echo "El numero: ".$numero." fue convertido en: "." ";
		echo dec2hex($numero);
		echo " Hexadecimal";
		break;
	case 'Binario':
		echo('<br><br><br>');
		echo "El numero: ".$numero." fue convertido en: "." ";
		echo Binario($numero);
		echo " Binario";
		break;
	default:
		break;
}

?>