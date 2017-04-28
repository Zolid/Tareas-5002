<?php
require_once('db_config.php');
require_once('validations.php');
require_once('dictionary.php');
require_once('consults.php');

$db = DbConfig::getConnection() or die("No se ha podido conectar: " . pg_last_error());

$array_id = array();

function add_contestant($db) {

	global $array_id;
	
	if (isset($_POST['nombre'])) {
		$query_nombre = mysqli_real_escape_string($db, $_POST['nombre']);

		if (!preg_match("/^[a-zA-Z ]*$/",$query_nombre)) {
			return "No se admiten numeros en su nombre";
		} 
	} else {
		return "Debe ingresar un nombre";
	}

	if (isset($_POST['email'])) {
		$query_email = mysqli_real_escape_string($db, $_POST['email']);
		if (!preg_match("/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/",$query_email)) {
			return "El mail introducido no cumple el formato de E-mail";
		}
	} else {
		return "Debe ingresar un email";
	}

	if (isset($_POST['telefono'])) {
		$query_telefono = mysqli_real_escape_string($db, $_POST['telefono']);
	} else {
		return "Debe ingresar un telefono";
	}

	if (isset($_POST['calle-numero'])) {
		$query_direccion = mysqli_real_escape_string($db, $_POST['calle-numero']);
	} else {
		return "Debe ingresar una direccion";
	}

	if (isset($_POST['regions'])) {
		$region = getRegion($_POST['regions']);
		$query_region = mysqli_real_escape_string($db, $region['nombre']);
	} else {
		return "Debe seleccionar una region";
	}

	if (isset($_POST['comunas'])) {
		$comuna = getComuna($_POST['comunas']);
		$query_comuna = mysqli_real_escape_string($db, $comuna['id']);
	} else {
		return "Debe seleccionar una comuna";
	}

	$query_biografia = (isset($_POST['biografia'])) ? mysqli_real_escape_string($db, $_POST['biografia']) : "";

	if (isset($_FILES)) {
		$uploaddir = 'uploads/';
		$a = rand(0, 9);
		$b = rand(0, 9);
		$c = rand(0, 9);
		$d = rand(0, 9);
		$e = rand(0, 9);
		$f = rand(0, 9);
		$namefile = "_".$a.$b.$c.$d.$e.$f."_";
		$uploadfile = $uploaddir . basename($namefile);

		if (move_uploaded_file($_FILES['foto-perfil']['tmp_name'], $uploadfile)) {
	    echo "El archivo es válido y fue cargado exitosamente.\n";
		} else {
		    return "Debe adjuntar un archivo";
		}

	}

	$stm = "INSERT INTO `participante` (`nombre`, `email`, `telefono`, `calle_numero`, `comuna`, `biografia`, `foto_perfil`)";
	$stm .= " VALUES ('$query_nombre', '$query_email', '$query_telefono', '$query_direccion', '$query_comuna', '$query_biografia', '$uploadfile')";

	$db->prepare($stm);
	$result = $db->query($stm);

	$sql = "SELECT id FROM participante WHERE nombre = '$query_nombre' AND email = '$query_email' ";
	$sql .= "AND telefono = '$query_telefono' AND calle_numero = '$query_direccion' AND comuna = '$query_comuna' AND biografia = '$query_biografia' ";
	$sql .= "AND foto_perfil = '$uploadfile'";
	$result = $db->query($sql);
	$row = $result->fetch_assoc();
	$id = $row['id'];
	
	$array_id['query_id'] = $id;
}



if (isset($_POST['nombre'])) {
	add_contestant($db);
	echo "Felicidades su registro ha sido existoso";
	header("Refresh: 5; URL=fotografias.php");
}


$db->close();
?>