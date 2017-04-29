$(document).on('ready',function(){
	$('#foto1').on('click', function() {
		var src = $('#foto1 img').attr('src');
		var alt = $('#foto1 img').attr('alt');
		var dueno = $('#foto1 img').attr('title');
		var ptj = $('ptj1').text();

		$('#foto img').attr('src', src);
		$('#etiqueta h2').text(alt);
		$("#btn").prop('value', dueno);
		$('#lugar h2').text("Parque Bicentario, Santiago");
		$('puntaje').text(ptj);
		
	});//Click foto1

	$('#foto2').on('click', function() {
		var src = $('#foto2 img').attr('src');
		var alt = $('#foto2 img').attr('alt');
		var dueno = $('#foto2 img').attr('title');
		var ptj = $('ptj2').text();

		$('#foto img').attr('src', src);
		$('#etiqueta h2').text(alt);
		$("#btn").prop('value', dueno);
		$('#lugar h2').text("Cajon del Maipo, Santiago");
		$('puntaje').text(ptj);
	});//Click foto2

	$('#foto3').on('click', function() {
		var src = $('#foto3 img').attr('src');
		var alt = $('#foto3 img').attr('alt');
		var dueno = $('#foto3 img').attr('title');

		$('#foto img').attr('src', src);
		$('#etiqueta h2').text(alt);
		$("#btn").prop('value', dueno);
		$('#lugar h2').text("Playa Dichato");
	});//Click foto3

	$('#foto4').on('click', function() {
		var src = $('#foto4 img').attr('src');
		var alt = $('#foto4 img').attr('alt');
		var dueno = $('#foto4 img').attr('title');

		$('#foto img').attr('src', src);
		$('#etiqueta h2').text(alt);
		$("#btn").prop('value', dueno);
		$('#lugar h2').text("Chuquicamata, Antofagasta");
	});//Click foto4

	$('#foto5').on('click', function() {
		var src = $('#foto5 img').attr('src');
		var alt = $('#foto5 img').attr('alt');
		var dueno = $('#foto5 img').attr('title');

		$('#foto img').attr('src', src);
		$('#etiqueta h2').text(alt);
		$("#btn").prop('value', dueno);
		$('#lugar h2').text("Parque de Concepcion");
	});//Click foto1

	$('#foto6').on('click', function() {
		var src = $('#foto6 img').attr('src');
		var alt = $('#foto6 img').attr('alt');
		var dueno = $('#foto6 img').attr('title');

		$('#foto img').attr('src', src);
		$('#etiqueta h2').text(alt);
		$("#btn").prop('value', dueno);
		$('#lugar h2').text("mi casa :), Santiago Centro");
	});//Click foto1

	$('#foto7').on('click', function() {
		var src = $('#foto7 img').attr('src');
		var alt = $('#foto7 img').attr('alt');
		var dueno = $('#foto7 img').attr('title');

		$('#foto img').attr('src', src);
		$('#etiqueta h2').text(alt);
		$("#btn").prop('value', dueno);
		$('#lugar h2').text("Zoológico Metropolitano");
	});//Click foto1

	$('#foto8').on('click', function() {
		var src = $('#foto8 img').attr('src');
		var alt = $('#foto8 img').attr('alt');
		var dueno = $('#foto8 img').attr('title');

		$('#foto img').attr('src', src);
		$('#etiqueta h2').text(alt);
		$("#btn").prop('value', dueno);
		$('#lugar h2').text("Bariloche, Argentina");
	});//Click foto1

	$('#foto9').on('click', function() {
		var src = $('#foto9 img').attr('src');
		var alt = $('#foto9 img').attr('alt');
		var dueno = $('#foto9 img').attr('title');

		$('#foto img').attr('src', src);
		$('#etiqueta h2').text(alt);
		$("#btn").prop('value', dueno);
		$('#lugar h2').text("Construcción en Nepal");
	});//Click foto1


	$('#foto10').on('click', function() {
		var src = $('#foto10 img').attr('src');
		var alt = $('#foto10 img').attr('alt');
		var dueno = $('#foto10 img').attr('title');

		$('#foto img').attr('src', src);
		$('#etiqueta h2').text(alt);
		$("#btn").prop('value', dueno);
		$('#lugar h2').text("Establo, Cerca de Santiago");
	});//Click foto1

	$('#foto11').on('click', function() {
		var src = $('#foto11 img').attr('src');
		var alt = $('#foto11 img').attr('alt');
		var dueno = $('#foto11 img').attr('title');

		$('#foto img').attr('src', src);
		$('#etiqueta h2').text(alt);
		$("#btn").prop('value', dueno);
		$('#lugar h2').text("Edificios en Dubai");
	});//Click foto1

	$('#foto12').on('click', function() {
		var src = $('#foto12 img').attr('src');
		var alt = $('#foto12 img').attr('alt');
		var dueno = $('#foto12 img').attr('title');

		$('#foto img').attr('src', src);
		$('#etiqueta h2').text(alt);
		$("#btn").prop('value', dueno);
		$('#lugar h2').text("Capilla Sixtina, Vaticano");
	});//Click foto1
	
});