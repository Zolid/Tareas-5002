<?php
require_once('db_config.php');
require_once('consults.php');
$db = DbConfig::getConnection();
$regions = getRegions($db);
$comunas = getComunas($db);
$db->close();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Formulario de Fotografías</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="styles.css">
	</head>
	<body>
		<h1>Ingreso de Fotografías</h1>
		<form id="formulario" enctype="multipart/form-data" action="proc_foto.php" method="post">
			<table id="tabla_archivo">
				<tbody>
					<tr>
						<td>Título de Fotografía</td>
						<td><input type="text" name="titulo[0]" size="30" maxlength="50"></td>
					</tr>
					<tr>
						<td>Archivo</td>
						<td><input  type="file" name="archivo[0]"></td>
					</tr>
					<tr>
						<td>Etiqueta:</td>
						<td><input type="text" name="etiqueta[0]" size="12" maxlength="20"></td>
					</tr>
					<tr>
						<td>Región:</td>
						<td>
							<select name="regions[0]">
								<?php for($i = 0; $i < count($regions); ++$i){ ?>
									<option value="<?php echo $i; ?>"><?php echo $regions[$i]['nombre']; ?></option>
								<?php } ?>
							</select>
						</td>
					</tr>
					<tr>
						<td>Comuna: </td>
					<td>
						<select name="comunas[0]">
							<?php for($i = 0; $i < count($comunas); ++$i){ ?>
								<option value="<?php echo $i; ?>"><?php echo $comunas[$i]['nombre']; ?></option>
							<?php } ?>
						</select>
					</td>
				</tr>
					<tr>
						<td>Dirección:</td>
						<td><input type="text" name="calle-numero[0]" size="80" maxlength="200"></td>
					</tr>
				</tbody>
			</table>
			<input type="button" id="btn" name="btn" value="Agregar Otra Foto">
			<input id="subtn" type="submit" name="submit" value="Enviar Fotografías">

		</form>

		
		<script>
			var max = 0;
			function $(selector) {
				return document.querySelector(selector);
			}

			$("#btn").addEventListener("click", function(){
				if (max < 9) {
					var value = max + 2;
					max += 1
					var button = document.getElementById('btn');
					var table = document.createElement("table");
					var brk = document.createElement("br")
					var thead = table.createTHead();
					row = thead.insertRow(0);
					cell = row.insertCell();
					cell.innerHTML = "<h2> Fotografía " + value.toString() + "</h2>"
					var tbody = table.createTBody();
					row0 = tbody.insertRow(0);
					cell0 = row0.insertCell(0);
					cell1 = row0.insertCell(1);
					cell0.innerHTML = "Título de Fotografía";
					cell1.innerHTML = '<input type="text" name="titulo['+max+']" size="30" maxlength="50">'
					row1 = tbody.insertRow(1);
					cell0 = row1.insertCell(0);
					cell1 = row1.insertCell(1);
					cell0.innerHTML = "Archivo";
					cell1.innerHTML = '<input type="file" id="file" name="archivo['+max+']">'
					row2 = tbody.insertRow(2);
					cell0 = row2.insertCell(0);
					cell1 = row2.insertCell(1);
					cell0.innerHTML = "Etiqueta";
					cell1.innerHTML = '<input type="text" name="etiqueta['+max+']" size="12" maxlength="20">'
					row3 = tbody.insertRow(3);
					cell0 = row3.insertCell(0);
					cell1 = row3.insertCell(1);
					cell0.innerHTML = "Región:"
					cell1.innerHTML =  '<select value="regions['+max+']">'+
												'<?php for($i = 0; $i < count($regions); ++$i){ ?>'+
												'<option value="<?php echo $i; ?>"><?php echo $regions[$i]['nombre']; ?></option>'+
												'<?php } ?>'+
										'</select>'
					row4 = tbody.insertRow(4);
					cell0 = row4.insertCell(0);
					cell1 = row4.insertCell(1);
					cell0.innerHTML = "Comuna:";
					cell1.innerHTML = '<select value="comunas['+max+']">'+
										'<?php for($i = 0; $i < count($comunas); ++$i){ ?>'+
										"<option value="+"<?php echo $i; ?>"+"><?php echo $comunas[$i]['nombre']; ?></option>"+
										'<?php } ?>'+
										'</select>'
					row5 = tbody.insertRow(5);
					cell0 = row5.insertCell(0);
					cell1 = row5.insertCell(1);
					cell0.innerHTML = "Dirección"
					cell1.innerHTML = '<input type="text" name="calle-numero['+max+']" size="80" maxlength="200">'
					
					$("#formulario").insertBefore(table, button);
					$("#formulario").insertBefore(brk, button);


					}
				});

				/*function validateName(name) {
	  				if (name=="")
					{
					    alert("Family name must be filled out");
					    return false;
					}
					else if (name.length > 51)
					{
					    alert("Family name cannot be more than 35 characters");
					    return false;
					}
					else if (/[^a-zA-Z0-9\-]/.test( name ))
					{
					    alert("Family name can only contain alphanumeric characters and hypehns(-)")
					    return false;
					}
					return true;
				}

				function validateTag(tag) {
	  				if (tag == "") {
	  					alert("El campo de etiqueta es obligatorio");
	  					return false;
	  				}
	  				else if (tag.length > 0) {
	  					alert("Debe agregar una etiqueta");
	  					return false;
	  				}
	  				return true;
				}

				var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"];    
				function ValidateFiles() {
				    var arrInputs = document.getElementsByClassName("archivo");
				    for (var i = 0; i < arrInputs.length; i++) {
				        var oInput = arrInputs[i];
				        if (oInput.type == "file") {
				            var sFileName = oInput.value;
				            if (sFileName.length > 0) {
				                var blnValid = false;
				                for (var j = 0; j < _validFileExtensions.length; j++) {
				                    var sCurExtension = _validFileExtensions[j];
				                    if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
				                        blnValid = true;
				                        break;
				                    }
				                }
				                
				                if (!blnValid) {
				                    alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
				                    return false;
				                }
				            }
				        }
				    }
  
   					return true;
				}

				function validateRegion() {
					var opciones = document.getElementsByTagName('option');
					for (var i = 0; i < opciones.length; ++i) {
						if (opciones[i].value != "Seleccione") {
							
							return true;
						}
					}
					return false;
				}

				function validateForm() {
					var titulos = document.getElementsByClassName('titulo');
					var etiquetas = document.getElementsByClassName('etiqueta')

					for (var i = 0; i < titulos.length; ++i) {
						if (validateName(titulos[i]) == false) {
							return false;
						}
					}

					for (var i = 0; i < etiquetas.length; ++i) {
						if (validateTag(etiquetas[i]) == false) {
							return false;
						}
					}

					if (ValidateFiles() == false || validateRegion() == false) {
						return false;
					}
					return true;
				}*/

		</script>
		
	</body>
</html>