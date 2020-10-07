<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="<?=base_url()?>public/css/bootstrap.min.css">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link rel="stylesheet" href="<?=base_url()?>public/flags/flag.min.css">
	<style>
		.form-check-label:hover{
			cursor: pointer;
		}
	</style>
</head>
<body>
	<div class="container">
		<div id="tablaJugadores" class="col-md-12">
			<h1>Jugadores</h1>

			<a href="#datosJugador" class="btn btn-primary mb-3" id="addNewPlayer">Agregar nuevo Jugador</a>

			<table class="table table-dark">
			  <thead>
			    <tr>
			      <th scope="col">#</th>
			      <th scope="col">Nombre</th>
			      <th scope="col">Apellido</th>
			      <th scope="col">Link Youtube</th>
			      <th scope="col"></th>
			    </tr>
			  </thead>
			  <tbody>
				<?php foreach ($jugadores as $key => $value): ?>
				    <tr>
				      <th scope="row"><?=$value->id?></th>
				      <td><?=$value->nombres?> <?=$value->segundoNombre?></td>
				      <td><?=$value->apellidos?> <?=$value->segundoApellido?></td>
				      <td>
				      	<?php if (isset($value->link_youtube)): ?>
				      		<iframe src="<?=$value->link_youtube?>" frameborder="0"></iframe>
				      	<?php endif ?>
				      </td>
				      <td><button class="btn btn-primary editPlayer" data-id="<?=$value->id?>">Editar</button></td>
				    </tr>
					
				<?php endforeach ?>
			  </tbody>
			</table>
		</div>

		<div id="datosJugador" class="mt-5 mb-5 col-md-7 bg-dark text-light" style="display: none">
			<button class="btn btn-primary mb-3 mt-3" id="backToPlayers">Volver a Jugadores</button>

			<form id="jugadoresForm" enctype="multipart/form-data">
			  <div class="form-group">
			    <input type="text" class="form-control" id="nombre" name="nombres" aria-describedby="emailHelp" placeholder="Nombre" required>
			  </div>
			  <div class="form-group">
			    <input type="text" class="form-control" id="segundoNombre" name="segundoNombre" placeholder="Segundo nombre">
			  </div>
			  <div class="form-group">
			    <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellido" required>
			  </div>
			  <div class="form-group">
			    <input type="text" class="form-control" id="segundoApellido" name="segundoApellido" placeholder="Segundo Apellido">
			  </div>
			  <div class="form-group">
			    <input type="text" class="form-control" id="nacionalidad" name="nacionalidad" placeholder="Nacionalidad" required>
			  </div>
			  <div class="form-group">
			  	  <img src="" alt="" id="imagenPlaceholder" style="max-width: 200px; margin-bottom: 20px;">
			      <label for="imagen">Inserte una Imaen</label>
			      <input type="file" class="form-control-file" id="imagen" name="imagen" required>
			    </div>
			  <div class="form-group">
              <div class="input-group date" id="fechaNac" data-target-input="nearest">
                  <input type="text" class="form-control datetimepicker-input" name="fechaNac" data-target="#fechaNac" required>
                  <div class="input-group-append" data-target="#fechaNac" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
              </div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" id="edad" name="edad" placeholder="Edad" required>
              </div>
              <div class="form-group">
              	<label for="pie">Pierna Habil</label>
                <select class="form-control" id="pie" name="pie" required>
                  <option value="izquierdo">izquierdo</option>
                  <option value="derecho">derecho</option>
                  <option value="ambidiestro">ambidiestro</option>
                </select>
              </div>
              <div class="form-group">
              	<label for="posicion">Posicion</label>
                <select class="form-control" id="posicion" name="posicion" required>
                  <option value="arquero">arquero</option>
                  <option value="defensor">defensor</option>
                  <option value="mediocampista">mediocampista</option>
                  <option value="delantero">delantero</option>
                </select>
              </div>
              <div class="form-check mb-3">
                 <input type="checkbox" class="form-check-input" id="profesional" name="profesional" required>
                 <label class="form-check-label" for="profesional">Es profesional?</label>
               </div>
               <div class="form-group">
                 <input type="text" class="form-control" id="peso" name="peso" placeholder="Peso">
               </div>
               <div class="form-group">
                 <input type="text" class="form-control" id="altura" name="altura" placeholder="Altura">
               </div>
               <div class="form-group">
                 <input type="text" class="form-control" id="link" name="link" placeholder="Link">
               </div>
               <div class="form-group">
                 <input type="text" class="form-control" id="link_soccerway" name="link_soccerway" placeholder="Link Soccerway"> 
               </div>
               <div class="form-group">
                 <input type="text" class="form-control" id="link_youtube" name="link_youtube" placeholder="Link Youtube"> 
               </div>
			  <button type="submit" class="btn btn-primary mb-3" data-id id="saveJugadorBtn">Guardar</button>
			</form>

			<h1>Trayectoria</h1>
			<table class="table table-dark">
			  <thead>
			    <tr>
			      <th scope="col">#</th>
			      <th scope="col">Club</th>
			      <th scope="col">Pais</th>
			      <th scope="col">Temporada</th>
			      <th scope="col"></th>
			    </tr>
			  </thead>
			  <tbody id="trayectoriaBody"></tbody>
			</table>
			
			<button class="btn btn-primary mb-3" id="addNewEquipo" data-type data-id data-toggle="modal" data-target="#modalTrayectoria">Agregar nuevo equipo</button>

		</div>
		<!-- Modal -->
		<div class="modal fade" id="modalTrayectoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Editar Trayectoria</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">

		        <form id="formTrayectoria">
					<div class="form-group">
					  <input type="text" class="form-control" id="temporada" name="temporada" placeholder="Temporada">
					</div>
					<div class="form-group">
	                 <input type="text" class="form-control" id="pais" name="pais" placeholder="Pais">
	               </div>
	               <div class="form-group">
	                 <input type="text" class="form-control" id="bandera" name="bandera" placeholder="Bandera">
	               </div>
	               <div class="form-group">
	                 <input type="text" class="form-control" id="equipo" name="equipo" placeholder="Equipo">
	               </div>
	               <div class="form-group">
	                 <input type="text" class="form-control" id="competicion" name="competicion" placeholder="Competicion">
	               </div>
		        </form>

		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
		        <button type="button" class="btn btn-primary" data-idJugador data-idEquipo id="editEquipo">Editar</button>
		      </div>
		    </div>
		  </div>
		</div>
	</div>
	<script>let baseUrl = "<?=base_url()?>"</script>
	<script src="<?=base_url()?>public/js/jquery.min.js"></script>
	<script src="<?=base_url()?>public/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />
	<script>
		$(document).ready(function(){

      $('#fechaNac').datetimepicker({
      	locale: "es",
      	viewMode: "years"
      });

			$("#addNewPlayer").click(function(){

				$("#tablaJugadores").hide();

				$("#nombre").val("");				
				$("#segundoNombre").val("");				
				$("#apellidos").val("");				
				$("#segundoApellido").val("");				
				$("#fechaNac").data("datetimepicker").date(null);
				$("#nacionalidad").val("");				
				$("#imagen").val("");				
				$("#edad").val("");				
				$('#pie option:nth-child(0)').val(); 
				$("#imagenPlaceholder").attr("src", "");				
				$('#profesional').prop('checked', false);
				$("#peso").val("");				
				$("#altura").val("");				
				$("#link").val("");				
				$("#link_soccerway").val("");				
				$("#link_youtube").val("");	

				$('#saveJugadorBtn').data("id", "");			

				$("#trayectoriaBody").html("");
				$("#addNewEquipo").data("id", "");

				$("#datosJugador").show();

			})

			$("#imagen").on("change", function(e){

				let tmppath = URL.createObjectURL(event.target.files[0]);

				$("#imagenPlaceholder").attr("src", tmppath);

			});

			$(".editPlayer").click(function(e){

				let id = $(this).data("id");

				$("#saveJugadorBtn").data("id", id);

				$("#tablaJugadores").hide();
				$("#datosJugador").show();

				$.ajax({
					url: baseUrl+"main/getJugador",
					dataType: "json",
					type: "post",
					data: {idJugador: id},
					success: function(data){

						let datosJugador     = data.datosJugador[0];
						let datosTrayectoria = data.trayectoria; 

						$("#nombre").val(datosJugador.nombres);
						$("#segundoNombre").val(datosJugador.segundoNombre);
						$("#apellidos").val(datosJugador.apellidos);
						$("#segundoApellido").val(datosJugador.segundoApellido);
						$("#nacionalidad").val(datosJugador.nacionalidad);
						$("#imagenPlaceholder").attr("src", baseUrl+'public/images/'+datosJugador.imagen)
						$("#edad").val(datosJugador.edad);
						$("#link").val(datosJugador.link);
						$("#link_soccerway").val(datosJugador.link_soccerway);
						$("#link_youtube").val(datosJugador.link_youtube);

						$("#trayectoriaBody").html("");

						if (datosTrayectoria.length > 0) {
	
							$.each(datosTrayectoria, function(index,value){

								let ele = `	<tr>
											  <th scope="row">${value.id}</th>
											  <td>${value.equipo}</td>
											  <td><i class="${value.bandera} flag"></i>  ${value.pais}</td>
											  <td>${value.temporada}</td>
											  <td><button class="btn btn-primary editTrayectoria" data-id="${value.id}" data-toggle="modal" data-target="#modalTrayectoria">Editar</td>
											</tr>`

								$("#trayectoriaBody").append(ele);

							});

						}else{

							$("#trayectoriaBody").html("");

						}


					}
				});

			});

			$(document).on("click", "#backToPlayers", function(e){
				e.preventDefault();
				//$(this).hide();
				$("#datosJugador").hide()
				$("#tablaJugadores").show();
			});

			$(document).on("click", "#addNewEquipo", function(){

				let idJugador = $("#saveJugadorBtn").data("id");

				$("#editEquipo").data("idJugador", idJugador);
				$("#editEquipo").data("idEquipo", "");
				$("#editEquipo").data("type", "insert");

				$("#temporada").val("");
				$("#pais").val("");
				$("#bandera").val("");
				$("#equipo").val("");
				$("#competicion").val("");

			});

			$(document).on("click", "#editEquipo", function(){

				let controller = $(this).data("type");
				let idJugador  = $(this).data("idJugador");
				let idEquipo   = $(this).data("idEquipo");
				let equipoData = $("#formTrayectoria").serialize();

				equipoData += "&idJugador="+idJugador;
				equipoData += "&idEquipo="+idEquipo;

				$.ajax({
					url: baseUrl+"admin/"+controller+"Equipo",
					dataType: "json",
					type: "post",
					data: equipoData,
					success: function(data){
						
						alert(data.message);

						if (data.status == "success") {

							$('#modalTrayectoria').modal('hide');

						}

					}
				})

			});

			$(document).on("click", ".editTrayectoria", function(e){
				e.preventDefault();

				let idEquipo = $(this).data("id");

				$("#editEquipo").data("type", "update");
				$("#editEquipo").data("idEquipo", idEquipo);
				$("#editEquipo").data("idJugador", "");

				$.ajax({
					url: baseUrl+"admin/getEquipo",
					dataType: "json",
					type: "post",
					data: {id: idEquipo},
					success: function(data){

						$("#temporada").val(data.temporada);
						$("#pais").val(data.pais);
						$("#bandera").val(data.bandera);
						$("#equipo").val(data.equipo);
						$("#competicion").val(data.competicion);

					}
				});
				
			});

			$("#jugadoresForm").submit(function(e){
				e.preventDefault();
				
				let id         = $("#saveJugadorBtn").data("id");
				let imagenName = $("#imagenPlaceholder").attr("src");
				let controller = "";

				id == "" ? controller = "insertJugador" : controller = "updateJugador";

				var fd = new FormData(this);
		        fd.append('id',id);
		        fd.append('imagenName',imagenName);

				$.ajax({
					url : baseUrl+"admin/"+controller,
					type: "post",
					dataType: "json",
					contentType: false,
					processData: false,
					data: fd,
					success: function(data){
						alert(data.message);
					}
				})

			});
		});
	</script>
</body>
</html>