<?php

require_once('db_config.php');
require_once('consults.php');
$db = DbConfig::getConnection() or die("No se ha podido conectar: " . pg_last_error());
$regions = getRegions($db);
$comunas = getComunas($db);
$db->close();

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Formulario de Concursante</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="styles.css">
	</head>
	<body>
		<h1>Ingreso Nuevo Concursante</h1>
		<h2>Por favor complete en el formulario con toda la informacion solicitada</h2>
		<form  enctype="multipart/form-data" name="formulario" onsubmit="return validarForm();" action="proc_conc.php" method="post">
			<table>
				<tr>
					<td>Nombre:</td>
					<td><input type="text" name="nombre" id="nombre" size="40" maxlength="80"  placeholder="Gabriel Iturra" required></td>
				</tr>
				<tr>
					<td>Email:</td>
					<td><input type="email" name="email" id="email" size="12" maxlength="200" placeholder="giturra@me.cl" required></td>
				</tr>
				<tr>
					<td>Teléfono:</td>
					<td><input type="tel" name="telefono" size="12" maxlength="20"></td>
				</tr>
				<tr>
					<td>Dirección:</td>
					<td><input type="text" name="calle-numero" size="80" maxlength="200"></td>
				</tr>
				<tr>
					<td>Región:</td>
					<td>
						<select name="regions">
							<!--<option value="seleccion">Seleccione Región</option>-->
							<?php for($i = 0; $i < count($regions); ++$i){ ?>
								<option value="<?php echo $i; ?>"><?php echo $regions[$i]['nombre']; ?></option>
							<?php } ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Comuna: </td>
					<td>
						<select name="comunas">
							<?php for($i = 0; $i < count($comunas); ++$i){ ?>
								<option value="<?php echo $i; ?>"><?php echo $comunas[$i]['nombre']; ?></option>
							<?php } ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Mini-Biografía:</td>
					<td><textarea name="biografia" cols="50" rows="10" id="biografia"></textarea></td> 
				</tr>
				<tr>
					<td>Foto Perfil</td>
					<td><input type="file" name="foto-perfil" id="foto-perfil"></td>
				</tr>


				
			</table>
			<script>
			function validateEmail(email) {
    			var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    			if (email.length == 0) {
    				alert("Debe rellenar el campo email");
    				return false;
    			}
    			else if (email.length >= 200) {
    				alert("Su email no debe exceder más de 20 caracteres");
    				return false;
    			}
    			return re.test(email);
}

			function validateName(name) {
  				if (name=="")
				{
				    alert("El campo nombre debe ser llenado");
				    return false;
				}
				else if (name.length > 81)
				{
				    alert("El campo nombre no debe exceder de 80 caracteres");
				    return false;
				}
				else if ( /[^a-zA-Z\s]/.test( name ))
				{
				    alert("El campo nombre solo puede contener letras minúsculas o mayúsculas");
				    return false;
				}
				return true;
			}


			function validarForm() {
				var nombre = document.getElementById('nombre').value;
				var email = document.getElementById('email').value;
				if (validateName(nombre) && validateEmail(email)) {
					return true;
				}
				return false;

			}
		</script>
			<input type="submit" name="submit" id="subtn" value="Participar en Concurso">
			<button type="reset">Limpiar Formulario</button>
		</form>

		
	</body>
</html>