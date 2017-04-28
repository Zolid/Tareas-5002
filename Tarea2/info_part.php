

<!DOCTYPE html>
<html>
	<head>
		<title>Datos del Participante</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" type="text/css" href="estilos.css">
		<script src="Javascripts/jquery-3.2.1.js"></script>
		<script src="Javascripts/jquery.easyPagination.js"></script>
	</head>
	<body>
		<h1>Bienvenido!</h1>
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
			$('#container').easyPaginate({
        		paginateElement: '.contFoto',
       			elementsPerPage: 5,
        		effect: 'fade'
    		});
		</script>
	</body>
</html>