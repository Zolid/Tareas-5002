<?php
require_once('db_config.php');
require_once('validations.php');
require_once('dictionary.php');
require_once('consults.php');

$db = DbConfig::getConnection() or die("No se ha podido conectar: " . pg_last_error());


$array_id = array();

function add_photos($db) {
	
	global $array_id;
	$total = count($_POST['titulo']);
	$count = 0;

	while($count < $total) {
		$sql = "SELECT `id` FROM `participante` ORDER BY `id` DESC LIMIT 1";

		$query_id = $db->query($sql);

		$last_id = $query_id->fetch_object();

		$id = (int) $last_id->id;
   		if (isset($_POST['titulo'][$count])) {
			$query_titulo = mysqli_real_escape_string($db, $_POST['titulo'][$count]);

			if (!preg_match("/^[a-zA-Z ]*$/",$query_titulo)) {
			echo "No se admiten numeros en los titulos\n";
			} 
			
		} else {
			echo "Sus fotografías deben tener un titulo\n";
		}

		if (isset($_POST['etiqueta'][$count])) {
			$query_etiqueta = mysqli_real_escape_string($db, $_POST['etiqueta'][$count]);
		} else {
			echo "Debe ingresar al menos una etiqueta\n";
		}

		if (isset($_POST['calle-numero'][$count])) {
			$query_direccion = mysqli_real_escape_string($db, $_POST['calle-numero'][$count]);
		} else {
			echo "Debe ingresar una dirección\n";
		}

		if (isset($_POST['regions'][$count])) {
			$region = getRegion($_POST['regions']);
			$query_region = mysqli_real_escape_string($db, $region['nombre']);
		} else {
			echo "Debe seleccionar una region\n";
		}

		if (isset($_POST['comunas'][$count])) {
			$comuna = getComuna($_POST['comunas'][$count]);
			$query_comuna = mysqli_real_escape_string($db, $comuna['id']);
		} else {
			echo "Debe seleccionar una comuna\n";
		}

		if (isset($_FILES)) {
			$nombreOriginal =$_FILES['archivo']['name'][$count];
			$query_ONombre = mysqli_real_escape_string($db, $nombreOriginal);
			$uploaddir = 'uploads/';
			$a = rand(0, 9);
			$b = rand(0, 9);
			$c = rand(0, 9);
			$d = rand(0, 9);
			$e = rand(0, 9);
			$f = rand(0, 9);
			$namefile = "_".$a.$b.$c.$d.$e.$f."_";
			$uploadfile = $uploaddir . basename($namefile);

			if (move_uploaded_file($_FILES['archivo']['tmp_name'][$count], $uploadfile)) {
		    	echo "El archivo es válido y fue cargado exitosamente.\n";
			} else {
			    echo "Debe adjuntar un archivo\n";
			}

		} else {
			echo "Sus no han sido agregadas\n";
		}

		$stm = "INSERT INTO `fotografia` (`titulo`, `ruta_archivo`, `nombre_archivo`, `etiquetas`, `comuna`, `calle_numero`, `participante`)";
		$stm .= " VALUES ('$query_titulo', '$uploadfile', '$query_ONombre', '$query_etiqueta', '$query_comuna', '$query_direccion', '$id')";

		$db->prepare($stm);
		$result = $db->query($stm);
		print($db->error);
				
		$sql = "SELECT id FROM fotografia WHERE titulo = '$query_titulo' AND ruta_archivo = '$uploadfile' AND nombre_archivo = '$query_ONombre' AND";

		$sql .= " etiquetas = '$query_etiqueta' AND comuna = '$query_comuna' AND calle_numero = '$query_direccion' AND id = '$id'";
		
		$result = $db->query($sql);
		printf($db->error);
		$row = $result->fetch_assoc();
		printf($db->error);
		$id = $row['id'];
		
		$array_id['query_id'] = $id;
		$count++;

	}

}

if (isset($_POST)) {
	add_photos($db);
	echo "Sus fotografías han sido agregadas\n";
	header("Refresh: 5; URL=index.html");
}


$db->close();

?>