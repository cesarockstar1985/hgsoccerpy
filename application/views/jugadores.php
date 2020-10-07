	<main role="main">

		<div class="row">
	
	  <div class="album py-3 bg-dark col-md-12">
	    <div class="container">

		<h1 id="titulo-posicion" style="color: #fff"><?=$titulo?></h1>
		<br>


		<!--PROFESIONALES-->
		<div class="alert alert-danger" role="alert">
		  Profesionales
		</div>
		<div class="row" id="profesionales-container">

			<?php foreach ($jugadores as $key => $value) { ?>
				
				<?php if ($value->profesional == 1): ?>

			        <div class="col-md-3">
			          <div class="card mb-4 box-shadow">
			          	<a class="linkJugador" href="<?=base_url()?>main/carrera/<?=$value->id?>" type="button" class="btn btn-sm btn-outline-secondary">
			            	<img class="card-img-top" src="<?=$value->imagen?>" alt="<?=$value->nombres?> <?=$value->apellidos?>">
			          	</a>
			            <div class="card-body">
			              <p class="card-text">Nombre: <?=$value->nombres?> <?=$value->apellidos?></p>
			              <p class="card-text">Posición: <?=ucfirst($value->posicion)?></p>
			              <div class="d-flex justify-content-between align-items-center">
			                <div class="btn-group">
			                  <a href="<?=base_url()?>main/carrera/<?=$value->id?>" type="button" class="btn btn-sm btn-outline-secondary">Ver Más</a>
			                </div>
			                <!-- <small class="text-muted">9 mins</small> -->
			              </div>
			            </div>
			          </div>
			        </div>

				<?php endif ?>

			<?php } ?>

		</div>
		<!--PROFESIONALES-->

		<!--JUVENILES-->
		<div class="alert alert-danger" role="alert">
		  Juveniles
		</div>

		<div class="row" id="juveniles-container">

			<?php foreach ($jugadores as $key => $value) { ?>
				
				<?php if ($value->profesional == 0): ?>

			        <div class="col-md-3">
			          <div class="card mb-4 box-shadow">
			          	<a class="linkJugador" href="<?=base_url()?>main/carrera/<?=$value->id?>" type="button" class="btn btn-sm btn-outline-secondary">
			            	<img class="card-img-top" src="<?=$value->imagen?>" alt="<?=$value->nombres?> <?=$value->apellidos?>">
			          	</a>
			            <div class="card-body">
			              <p class="card-text">Nombre: <?=$value->nombres?> <?=$value->apellidos?></p>
			              <p class="card-text">Posición: <?=ucfirst($value->posicion)?></p>
			              <div class="d-flex justify-content-between align-items-center">
			                <div class="btn-group">
			                  <a href="<?=base_url()?>main/carrera/<?=$value->id?>" type="button" class="btn btn-sm btn-outline-secondary">Ver Más</a>
			                </div>
			                <!-- <small class="text-muted">9 mins</small> -->
			              </div>
			            </div>
			          </div>
			        </div>

				<?php endif ?>

			<?php } ?>

		</div>
		<!--JUVENILES-->

	    </div>
	  </div>

	 </div>

	</main>