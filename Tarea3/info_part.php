

<!DOCTYPE html>
<html>
	<head>
		<title>Datos del Participante</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" type="text/css" href="estilos.css">
		<script src="Javascripts/jquery-3.2.1.js"></script>
		<script src="Javascripts/jquery.easyPagination.js"></script>
		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
		<script src="Javascripts/jquery-ui.js"></script>
	</head>
	<body>
		<h1>Bienvenido!</h1>
		<br>
		<br>
		<form action="info_part.php" method="post">
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
				echo '<h2>Fotografías</h2>';
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
		<table>
			<tbody>
				<tr style="background-color: darkgreen; color: white;">
					<td>Foto Perfil</td>
					<td>Nombre</td>
					<td>Email</td>
					<td>Teléfono</td>
					<td>Dirección</td>
					<td>Comuna</td>
					<td>Mini-Biografía</td>
				</tr>
				<?php
				require_once('db_config.php');
				require_once('dictionary.php');
				require_once('consults.php');
				$db = DbConfig::getConnection() or die("No se ha podido conectar: " . pg_last_error());
				$id = $_POST['id'];
				if (isset($id)) {
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

				}
				
				
				$db->close();
				?>
			</tbody>
		</table>
		<br>
		<br>
		<h2>Fotografías</h2>
		<div id="container">
			<?php
			$db = DbConfig::getConnection() or die("No se ha podido conectar: " . pg_last_error());
			if (isset($id)) {
				$query = "SELECT * FROM `fotografia` WHERE participante = '$id'";
				$db->prepare($query);
				$result = $db->query($query);
				$i = 0;
				while ($row = $result->fetch_assoc()) {
					echo '<div class="contFoto">';
					echo '<form action="info_foto.php" method="post">';
					echo '<button><img src="'.$row['ruta_archivo'].'" width="120" height="120" alt=""></button>';
					echo '<h3>'.$row['etiquetas'].'</h3>';
					echo '<input type="hidden" name="id" value="'.$row['id'].'">';
					echo '</form>';
					echo '</div>';
				}
			}
			$db->close(); 
			?>
		</div>
		<form style="display: inline" action="index.html">
  			<button id="subtn">Volver al Inicio</button>
		</form>
		<script>
			$('document').ready(function() {
				$('#buscar').autocomplete({
					source: 'ajax.php'
				});
			});
			$('#container').easyPaginate({
        		paginateElement: '.contFoto',
       			elementsPerPage: 5,
        		effect: 'fade'
    		});
		</script>
	</body>
</html>