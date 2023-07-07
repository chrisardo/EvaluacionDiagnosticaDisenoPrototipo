<?php
$host = "localhost:3306";
$root = "root";
$password = "";
$db = "evaluacion_diagnostica";


@$mysqli = new MySQLi($host, $root, $password, $db);
if (@$mysqli->connect_error) {
	die("Fallo la conexión a la base de datos");
} else {
	//echo "Conexión exitosa!";
}
$con = mysqli_connect($host, $root, $password) or die("No se ha podido conectar al Servidor");
mysqli_query($con, "SET SESSION collation_connection ='utf8_unicode_ci'");
$db = mysqli_select_db($con, $db) or die("Upps! Error en conectar a la Base de Datos");
mysqli_set_charset($con, "UTF8");
