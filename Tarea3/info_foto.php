<!DOCTYPE html>
<html>
	<head>
		<title>Información de Fotografía</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="style.css">

	</head>
	<body>
		<h1>Información Fotografía</h1>
		<div id="container">
			<?php
			require_once('db_config.php');
			require_once('dictionary.php');
			require_once('consults.php');
			$db = DbConfig::getConnection() or die("No se ha podido conectar: " . pg_last_error());
			$id = $_POST['id'];
			if (isset($id)) {
				$query = "SELECT * FROM `fotografia` WHERE id = '$id'";
				$db->prepare($query);
				$result = $db->query($query);
				$array = $result->fetch_assoc();
				$comuna = getComunaName($array['comuna'], $db);
				$participante = getParticipante($db, $array['participante']);
				echo '<h2>'.$array['titulo'].'</h2>';
				echo '<img src="'.$array['ruta_archivo'].'" height="600" width="800" alt="'.$array['etiquetas'].'">';
				echo '<h3>'.$array['etiquetas'].'</h3>';
				echo '<h3>'.$comuna.'</h3>';
				echo '<form action="info_part.php" method="post">';
				echo '<input type="submit" class="subtn" value="'.$participante.'">';
				echo '<input type="hidden" name="id" value="'.$array['participante'].'">';
				echo '<div id="calificador">';
				echo 'Calificar foto:	<select>';
				echo '<option id="opcion1" value="1">1</option>';
				echo '<option id="opcion2" value="2">2</option>';
				echo '<option id="opcion3" value="3">3</option>';
				echo '<option id="opcion4" value="5">4</option>';
				echo '<option id="opcion5" value="5">5</option>';
				echo '</select>';
				echo '<p>Puntaje: Sin información</p>';
				echo '</div>';
				echo '</form>';

			}
			$db->close();
			?>
		</div>
		<form action="index.html">
  			<button class="subtn">Volver al Inicio</button>
		</form>	
	</body>
</html>