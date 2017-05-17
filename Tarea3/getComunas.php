<?php
require_once('db_config.php');
require_once('validations.php');
require_once('dictionary.php');
require_once('consults.php');

$db = DbConfig::getConnection() or die("No se ha podido conectar: " . pg_last_error());

$query = "SELECT C.nombre as comuna, F.titulo as titulo, P.nombre as participante, F.id as id FROM `comuna` as C, fotografia as F, participante as P WHERE C.id = F.comuna AND P.id = F.participante";
$db->prepare($query);
$result = $db->query($query);
$db->close(); 
$out = [];
while ($row = $result->fetch_assoc()) {
	$out[$row['comuna']][] = $row;
}

echo json_encode($out,JSON_PRETTY_PRINT);

?>