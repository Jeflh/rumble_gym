<?php

require_once "config/config.php";
require_once "core/routes.php";
require_once "core/functions.php";
require_once "config/db/db.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); // Para mostrar los errores

date_default_timezone_set('America/Mexico_City');	// Para definir la zona horaria

if (isset($_GET['c'])) {

	$controlador = cargarControlador($_GET['c']);

	if (isset($_GET['a'])) {
		if (isset($_GET['id'])) {
			cargarAccion($controlador, $_GET['a'], $_GET['id']);
		} else {
			cargarAccion($controlador, $_GET['a']);
		}
	} else {
			cargarAccion($controlador, MAIN_ACTION);
	}
} else {

	$controlador = cargarControlador(MAIN_CONTROLLER);
	$accionTmp = MAIN_ACTION;
	$controlador->$accionTmp();
}

?>