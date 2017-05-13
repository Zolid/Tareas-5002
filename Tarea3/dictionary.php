<?php
require_once('db_config.php');
require_once('consults.php');

function getRegion($id) {
	$db = DbConfig::getConnection();
	$regions = getRegions($db);
	$db->close();
	return $regions[$id];
}


function getComuna($id){
	$db = DbConfig::getConnection();
	$comunas = getComunas($db);
	$db->close();
	return $comunas[$id];
}

function getComunaName($id, $db) {
	$sql = "SELECT id, nombre FROM comuna";
	$result = $db->query($sql);
	$comunas = array();
	while ($row = $result->fetch_assoc()) {
		$comunas[] = $row;
	}

	for ($i=0; $i <count($comunas) ; $i++) { 
		if ($comunas[$i]['id'] == $id) {
			return $comunas[$i]['nombre'];
		}
	}
}

?>