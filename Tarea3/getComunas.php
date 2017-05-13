<?php
require_once('db_config.php');
require_once('validations.php');
require_once('dictionary.php');
require_once('consults.php');

$db = DbConfig::getConnection() or die("No se ha podido conectar: " . pg_last_error());

$query = "SELECT C.nombre, F.titulo FROM `comuna` as C, fotografia as F WHERE C.id = F.comuna";
$db->prepare($query);
$result = $db->query($query);
$db->close(); 
$out = [];
while ($row = $result->fetch_assoc()) {
	$out[$row['nombre']][] = $row;
}

echo json_encode($out,JSON_PRETTY_PRINT);

?>