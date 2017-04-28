<!DOCTYPE html>
<html>
	<head>
		<title>Listado de participantes</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="styles.css">
		<script src="Javascripts/jquery-3.2.1.js"></script>
		<script src="Javascripts/jquery-paginate.js"></script>
		<script src="Javascripts/jquery-paginate.min.js"></script>
	</head>
	<body>
		<h1>Listado de Participantes</h1>
		<hr>
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
					echo '<input id="subtn"type="submit" value="'.$row['nombre'].'"/></form></div></td>';
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
  			<button id="subtn">Volver al Inicio</button>
		</form>
		<script>
			$('#myTable').paginate({ limit: 5 });
		</script>	
	</body>
</html>

