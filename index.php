<?php require_once('functions.php'); ?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Pedir cita</title>
</head>
<body>

<h1>Pedir cita</h1>

<?php

//comprobamos si recibimos un parámetro GET y si es numérico
//	en caso contrario guardamos la fecha actual en una variable
if(isset($_GET['f']) && is_numeric($_GET['f'])){

	//comprobamos si el parámetro GET obtenido es una fecha válida
	//	si el parámetro es una fecha válida, guardamos dicha fecha
	//	en caso contrario, guardamos la fecha actual del servidor
	if(comprueba_fecha($_GET['f'])){
		$fecha = mktime(0, 0, 0, date('m', $_GET['f']), date('d', $_GET['f']), date('Y', $_GET['f']));
	}else{
		$fecha = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
	}
}else{
	$fecha = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
}

//almacenamos la fecha actual para poder volver rápidamente al navegar en el calendario
$volver_hoy = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
echo '<a href="index.php?f='.$volver_hoy.'">Ir a hoy</a>';

//comienza la tabla
echo '<table>
	<tr>';

//creamos un enlace al mes anterior si no se muestra el mes actual
//si el mes y el año son los actuales no crea el enlace, solo la celda vacía
if( (date('m', $fecha) == date('m')) && (date('Y', $fecha) == date('Y')) ){
	echo '<td>&nbsp;</td>';
}else{
	echo '<td><a href="index.php?f='.mes_menos($fecha).'"><</td>';
}

//mostramos el nombre del mes, el enlace al mes siguiente y los nombres de los días.
echo '<td colspan="5">'.mes_espanol(date('m',$fecha)).' '.date('Y',$fecha).'</td>
	<td><a href="index.php?f='.mes_mas($fecha).'">></td>
	</tr>
	<tr>
		<th>Lunes</th>
		<th>Martes</th>
		<th>Miércoles</th>
		<th>Jueves</th>
		<th>Viernes</th>
		<th>Sábado</th>
		<th>Domingo</th>
	</tr>';

//comienzo de nueva fila para mostrar los días
echo '<tr>';

//comienzo del bucle para mostrar los días del mes
//usamos la opción 't' de la función date() para saber el número de días de cada mes
for($dia = 1; $dia <= date('t', $fecha); $dia++){
	//obtenemos la fecha completa (dia, mes, año)
	$dia_completo = mktime(0, 0, 0, date('m',$fecha), $dia, date('Y', $fecha));

	//calcula en que celda tiene que ir el día número 1
	if($dia == 1){
		for($hueco = 1; $hueco < date('N', $dia_completo); $hueco++){
			echo '<td>&nbsp;</td>';
		}
	}

	//creamos la celda del dia
	echo '<td>'.$dia.'</td>';

	//comprobamos si el día es el último del mes
	//si es así, cerramos la fila actual y la tabla
	//si no es el último día del mes pero sí de la semana, cerramos la fila y empezamos otra nueva
	if($dia == date('t', $dia_completo)){
		echo '</tr></table>';
	}elseif(date('N', $dia_completo) == 7){
		echo '</tr><tr>';
	}
}
?>

</body>
</html>