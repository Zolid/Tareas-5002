<!DOCTYPE html>
<html>
	<head>
		<title>Listado de participantes</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="styles.css">
		<script src="Javascripts/jquery-3.2.1.js"></script>
		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
		<script src="Javascripts/jquery-ui.js"></script>
		<script src="Javascripts/jquery-paginate.js"></script>
		<script src="Javascripts/jquery-paginate.min.js"></script>
	</head>
	<body>
		<h1>Listado de Participantes</h1>
		<hr>
		<br>
		<br>
		<form action="listado.php" method="post">
			<input type="text" name="buscar" id="buscar">
			<input type="submit" name="Buscar" value="Buscar">
		</form>
		<br>
		<br>
		<?php
require_once('db_config.php');
require_once('dictionary.php');
require_once('consults.php');

$db = DbConfig::getConnection() or die("No se ha podido conectar: " . pg_last_error());
if (isset($_POST['buscar'])){
	$filtro = $_POST['buscar'];
	$sql = $db->query("SELECT DISTINCT(P.id) AS id, P.nombre as nombre FROM `participante` as P, fotografia as F WHERE P.nombre LIKE '%".$filtro."%' AND P.id = F.participante;" );
	if (mysqli_num_rows($sql) > 0) {
		while ($part = $sql->fetch_assoc()){
			if ($part['nombre'] == $filtro) {
				echo '<table>';
				echo '<tbody>';
				echo '<tr style="background-color: darkgreen; color: white;">';
				echo '<td>Foto Perfil</td>';
				echo '<td>Nombre</td>';
				echo '<td>Email</td>';
				echo '<td>Teléfono</td>';
				echo '<td>Dirección</td>';
				echo '<td>Comuna</td>';
				echo '<td>Mini-Biografía</td>';
				$id = $part['id'];
				$query1 = "SELECT * FROM `participante` WHERE id = '$id'";
				$db->prepare($query1);
				$result = $db->query($query1);
				$array = $result->fetch_assoc();
				$comuna = getComunaName($array['comuna'], $db);
				echo '<tr>';
				echo '<td><img src="'.$array['foto_perfil'].'" alt="foto-perfil" width="120" height="120"></td>';
				echo '<td style="text-align: center;">'.$array['nombre'].'</td>';
				echo '<td>'.$array['email'].'</td>';
				echo '<td>'.$array['telefono'].'</td>';
				echo '<td>'.$array['calle_numero'].'</td>';
				echo '<td>'.$comuna.'</td>';
				echo '<td>'.$array['biografia'].'</td>';
				echo '</tr>';
				echo '</tbody>';
				echo '</table>';
				$query = "SELECT * FROM `fotografia` WHERE participante = '$id'";
				$db->prepare($query);
				$result = $db->query($query);
				$i = 5;
				echo '<table id="table">';
				while ($row = $result->fetch_assoc()) {
					if ($i % 5 == 0) {
						echo '<tr>';
					}
					echo '<td>';
					echo '<div class="contFoto">';
					echo '<form action="info_foto.php" method="post">';
					echo '<button><img src="'.$row['ruta_archivo'].'" width="120" height="120" alt=""></button>';
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
				echo '</table>';
			}
		}
	} else {
		echo "No se han encontrado resultados.";
	}

} else {
	echo '';
}
$db->close();
?>
		<br>
		<br>
		<table id="myTable">
			<thead style="background-color: darkgreen; color: white;">
				<tr>
					<td>Foto Perfil</td>
					<td>Nombre</td>
					<td>Email</td>
					<td>N° de Fotos</td>
					<td>Puntaje</td>
				</tr>
			</thead>
			<tbody>
				<?php
				require_once('db_config.php');

				$db = DbConfig::getConnection() or die("No se ha podido conectar: " . pg_last_error());

				$query_list = "SELECT P.id AS id, P.foto_perfil AS foto, P.nombre as nombre, P.email, COUNT(F.titulo) as nFotos FROM `participante` AS P, `fotografia` as F WHERE P.id = F.participante GROUP BY P.id";

				$db->prepare($query_list);
				$result = $db->query($query_list);
				$array_query = array();
				$i = 0;
				while ($row = $result->fetch_assoc()) {
					echo '<tr>';
					echo '<td><img src="'.$row['foto'].'" alt="foto-perfil['.$i.']" width="120" height="120"></td>';
					echo '<td><div>';
					echo '<form action="info_part.php" method="post">';
					echo '<input type="hidden" name="id" value="'.$row['id'].'"/>';
					echo '<input class="subtn"type="submit" value="'.$row['nombre'].'"/></form></div></td>';
					echo '<td>'.$row['email'].'</td>';
					echo '<td>'.$row['nFotos'].'</td>';
					echo '<td> Sin información</td>';
					echo '</tr>';
					$i++;
					
				}

				$db->close();
?>			</tbody>
		</table>
		<br>
		<br>
		<form style="display: inline" action="index.html" method="get">
  			<button class="subtn">Volver al Inicio</button>
		</form>
		<script>
			$('document').ready(function() {
				$('#buscar').autocomplete({
					source: 'ajax.php'
				});
			});
			$('#myTable').paginate({ limit: 5 });
			$('#table').paginate({ limit: 5 });
		</script>
	</body>
</html>

