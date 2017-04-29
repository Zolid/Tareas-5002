
<!DOCTYPE html>
<html>
	<head>
		<title>Galería de fotografías</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="styles.css">
		<script src="Javascripts/jquery-3.2.1.js"></script>
		<script src="Javascripts/jquery-paginate.js"></script>
		<script src="Javascripts/jquery-paginate.min.js"></script>
	</head>
	<body>
		<h1>Listado de fotografías</h1>
		<table id="myTable">
		<tbody>
		<?php
		require_once('db_config.php');
		$db = DbConfig::getConnection() or die("No se ha podido conectar: " . pg_last_error());
		$query = "SELECT * FROM `fotografia`";
		$db->prepare($query);
		$result = $db->query($query);
		$i = 5;
		while ($row = $result->fetch_assoc()) {
			if ($i % 5 == 0) {
				echo '<tr>';
			}

			echo '<td>';
			echo '<div class="foto" style="float: left;">';
			echo '<form action="info_foto.php" method="post">';
			echo '<button class="subtn"><img src="'.$row['ruta_archivo'].'" width="120" height="120" alt=""></button>';
			echo '<h3>'.$row['etiquetas'].'</h3>';
			echo '<input type="hidden" name="id" value="'.$row['id'].'">';
			echo '</form>';
			echo '</div>';
			echo '</td>';
			
			if ($i % 5 == 4) {
				echo '</tr>';
			}
			$i++;
		}
		$db->close();
		?>
		</table>
		</tbody>
		<br>
		<br>
		

		<form style="display: inline" action="index.html" method="get">
  			<button>Volver al Inicio</button>
		</form>
		<script>
			$('#myTable').paginate({ limit: 5 });
		</script>	
	</body>
</html>