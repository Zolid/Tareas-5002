$(obtener_participantes());

function obtener_participantes(participantes) {
	$.ajax ({
		url: 'peticion.php',
		type: 'GET',
		dataType: 'html',
		data: {participantes: participantes},

	})
}