<?php
/////// CONEXIÓN A LA BASE DE DATOS /////////
require_once('db_config.php');
require_once('consults.php');
$db = DbConfig::getConnection() or die("No se ha podido conectar: " . pg_last_error());

//////////////// VALORES INICIALES ///////////////////////

$query = "SELECT * FROM `participante` ORDER BY id";

///////// LO QUE OCURRE AL TECLEAR SOBRE EL INPUT DE BUSQUEDA ////////////

if (isset($_GET['participantes'])) {
	$q=$db->real_escape_string($_GET['participantes']);
	$query = "SELECT * FROM `participante` WHERE id LIKE '%".$q."%' OR nombre LIKE '%".$q."%' OR email LIKE '%".$q."%' OR telefono LIKE '%".$q."%' OR calle_numero LIKE '%".$q."%' OR bigrafia LIKE '%".$q."%'";
}

$part = $db->query($query);
if () {

} else {
	echo "No se encontraron coincidencias con sus criterios de búsqueda.";
}

$db->close();

?>