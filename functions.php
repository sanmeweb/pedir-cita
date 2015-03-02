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