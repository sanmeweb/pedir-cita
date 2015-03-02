<?php

/*
	comprueba si el argumento dado es una variable de fecha válida
*/
function comprueba_fecha($fecha){

	//comprobamos si la fecha obtenida es anterior a la presente
	//si es anterior, la consideramos no válida, devuelve false
	if( (date('Y',$fecha) <= date('Y')) && (date('m',$fecha) <= date('m')) && (date('d',$fecha) < date('d')) ){
		return false;
	}

	//obtenemos los datos individuales de la fecha para usar la función de PHP para comprobar si
	//una fecha es válida.
	$dia = (int)date('d',$fecha);
	$mes = (int)date('m',$fecha);
	$anio = (int)date('Y',$fecha);

	return checkdate($mes, $dia, $anio);
}

/*
	devuelve el primer día del mes previo a la fecha dada como argumento
*/
function mes_menos($fecha){
	$mes = date('m', $fecha);
	$anio = date('Y', $fecha);

	//comprobamos si el mes es enero
	//si es así, cambiamos el mes a diciembre y el año al anterior
	//si no, simplemente restamos el mes
	if($mes == 1){
		$mes = 12;
		$anio--;
	}else{
		$mes--;
	}

	return mktime(0, 0, 0, $mes, 1, $anio);
}

/*
	devuelve el primer día del mes siguiente a la fecha dada como argumento
*/
function mes_mas($fecha){
	$mes = date('m', $fecha);
	$anio = date('Y', $fecha);

	//comprobamos si el mes es diciembre
	//si es así, cambiamos el mes a enero y el año al siguiente
	//si no, simplemente sumamos el mes
	if($mes == 12){
		$mes = 1;
		$anio++;
	}else{
		$mes++;
	}

	return mktime(0, 0, 0, $mes, 1, $anio);
}

/*
	traduce el nombre del mes a español
*/
function mes_espanol($mes){
	switch($mes){
		case 1:
			return 'Enero';
			break;
		case 2:
			return 'Febrero';
			break;
		case 3:
			return 'Marzo';
			break;
		case 4:
			return 'Abril';
			break;
		case 5:
			return 'Mayo';
			break;
		case 6:
			return 'Junio';
			break;
		case 7:
			return 'Julio';
			break;
		case 8:
			return 'Agosto';
			break;
		case 9:
			return 'Septiembre';
			break;
		case 10:
			return 'Octubre';
			break;
		case 11:
			return 'Noviembre';
			break;
		case 12:
			return 'Diciembre';
			break;
	}
}

/*
	comprueba si una fecha es festivo en España
	devuelve true si la fecha es festiva, false en caso contrario
*/
function es_festivo($fecha){
	if((date('N',$fecha) == 6) || (date('N',$fecha) == 7)){
		//sábado o domingo
		return true;
	}elseif((date('d',$fecha) == 1) && (date('m',$fecha) == 1)){
		//1 de enero
		return true;
	}elseif((date('d',$fecha) == 6) && (date('m',$fecha) == 1)){
		//6 de enero
		return true;
	}elseif((date('d',$fecha) == 1) && (date('m',$fecha) == 5)){
		//1 de mayo
		return true;
	}elseif((date('d',$fecha) == 15) && (date('m',$fecha) == 8)){
		//15 de agosto
		return true;
	}elseif((date('d',$fecha) == 12) && (date('m',$fecha) == 10)){
		//12 de octubre
		return true;
	}elseif((date('d',$fecha) == 6) && (date('m',$fecha) == 12)){
		//6 de diciembre
		return true;
	}elseif((date('d',$fecha) == 8) && (date('m',$fecha) == 12)){
		//8 de diciembre
		return true;
	}elseif((date('d',$fecha) == 25) && (date('m',$fecha) == 12)){
		//25 de diciembre
		return true;
	}else{
		return false;
	}
}