<?php

function getRegions($db) {
	$sql = "SELECT id, nombre FROM region";
	$result = $db->query($sql);
	$res = array();
	while ($row = $result->fetch_assoc()) {
		$res[] = $row;
	}
	return $res;
}

function getComunas($db) {
	$sql = "SELECT id, nombre FROM comuna";
	$result = $db->query($sql);
	$res = array();
	while($row = $result->fetch_assoc()) {
		$res[] = $row;
	}
	return $res;
}

function getPhotosXPersona($db, $id) {
	$query = "SELECT * FROM `fotografia` WHERE participante = '$id'";
	$db->prepare($query);
	$result = $db->query($query);
	$photos = array();
	while ($row = $result->fetch_assoc()) {
		$photos[] = $row;
	}
	return $photos;
}

function getParticipante($db, $id) {
	$query = "SELECT nombre FROM `participante` WHERE id = '$id'";
	$db->prepare($query);
	$result = $db->query($query);
	$nombre = $result->fetch_assoc();
	return $nombre['nombre'];
}

?>