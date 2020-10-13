$(document).ready(function(){

	$("#"+pagina).addClass("active");

	$('.carousel').carousel('pause');

	$(".nav-item-main").click(function(){
		$(".nav-item-main").removeClass("active");
		$(this).addClass("active");
	});

	$(".nav-item-posiciones").click(function(){

		$(".nav-item-posiciones").removeClass("active");
		$(this).addClass("active");

		let string = $(this).data('string');

		$.ajax({
			url: "https://www.hgsoccerpy.com/main/getJugadores",
			dataType: "json",
			type: "post",
			data: {string: string},
			success: function(data){

				let profesionales = data.profesionales;
				let juveniles     = data.juveniles;

				let elemProfesionales = "";
				let elemJuveniles     = "";
				let tituloString      = "";

				$("#titulo-posicion").text(string);

				if (string == "defensor") {
					tituloString = "Defensores";
				}else if(string == "mediocampista"){
					tituloString = "Mediocampistas";
				}else if(string == "delantero"){
					tituloString = "Delanteros";
				}else{
					tituloString = "Goleros";
				}
				
				$("#titulo-posicion").text(tituloString)

				$.each(profesionales, function(index, value){

					elemProfesionales += `
						<div class="col-md-3">
						  <div class="card mb-4 box-shadow">
						 	<a class="linkJugador" href="${baseUrl}main/carrera/${value.id}" type="button" class="btn btn-sm btn-outline-secondary">
						    	<img class="card-img-top" src="${value.imagen}" alt="${value.nombres} ${value.apellidos}">
						 	</a>
						    <div class="card-body">
						      <p class="card-text">Nombre: ${value.nombres} ${value.apellidos}</p>
						      <p class="card-text">Posición: ${value.posicion}</p>
						      <div class="d-flex justify-content-between align-items-center">
						        <div class="btn-group">
						          <a href="${baseUrl}main/carrera/${value.id}" type="button" class="btn btn-sm btn-outline-secondary">Ver Más</a>
						        </div>
						        <!-- <small class="text-muted">9 mins</small> -->
						      </div>
						    </div>
						  </div>
						</div>
					`;

				});

				$.each(juveniles, function(index,value){
					elemJuveniles += `
						<div class="col-md-3">
						  <div class="card mb-4 box-shadow">
						  	<a class='linkJugador' href="${baseUrl}main/carrera/${value.id}" type="button" class="btn btn-sm btn-outline-secondary">
						    	<img class="card-img-top" src="${value.imagen}" alt="${value.nombres} ${value.apellidos}">
						  	</a>
						    <div class="card-body">
						      <p class="card-text">Nombre: ${value.nombres} ${value.apellidos}</p>
						      <p class="card-text">Posición: ${value.posicion}</p>
						      <div class="d-flex justify-content-between align-items-center">
						        <div class="btn-group">
						          <a href="${baseUrl}main/carrera/${value.id}" type="button" class="btn btn-sm btn-outline-secondary">Ver Más</a>
						        </div>
						        <!-- <small class="text-muted">9 mins</small> -->
						      </div>
						    </div>
						  </div>
						</div>
					`;
				});	

				$("#profesionales-container").html(elemProfesionales);
				$("#juveniles-container").html(elemJuveniles);

			}
		});
	})
});