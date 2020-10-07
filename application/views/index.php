	<main role="main">

		<!-- CAROUSEL -->
		<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
		  <div class="carousel-inner">
		    <div class="carousel-item active">
		    	<div class="col-md-12 text-center slider-text">
		    		<img src="<?=base_url()?>public/images/logo.jpg" class="logo" alt="HgSoccer">
		    		<h1>Management y Marketing Deportivo</h1>
		    	</div>
		      <img class="d-block w-100 same-height" src="<?=$image_url?>jumbo<?=$extensionBanner?>" alt="Third slide">
		    </div>
		    <div class="carousel-item">
		    	<div class="slider-text slider-text-inactive">
      		  		<h1>José Aquino</h1>
      		  		<p>Arquero</p>	
		    	</div>
		      <img class="d-block w-100 same-height" src="<?=$image_url?>slider/jose_aquino<?=$extensionBanner?>" alt="Second slide">
		    </div>
		    <div class="carousel-item">
		    	<div class="slider-text slider-text-inactive">
      		  		<h1>Fidencio Oviedo</h1>
      		  		<p>Volante Central</p>	
		    	</div>
		      <img class="d-block w-100 same-height" src="<?=$image_url?>slider/fidencio<?=$extensionBanner?>" alt="First slide">
		    </div>
		    <div class="carousel-item">
		    	<div class="slider-text slider-text-inactive">
      		  		<h1>Pablo Adorno</h1>
      		  		<p>Central Zurdo Lateral Izquierdo</p>	
		    	</div>
		      <img class="d-block w-100 same-height" src="<?=$image_url?>slider/pablo_adorno<?=$extensionBanner?>" alt="First slide">
		    </div>
		  </div>
		  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
		    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
		    <span class="sr-only">Previous</span>
		  </a>
		  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
		    <span class="carousel-control-next-icon" aria-hidden="true"></span>
		    <span class="sr-only">Next</span>
		  </a>
		</div>
		<!-- /CAROUSEL -->
		
		<!-- NAVBAR POSICIONES -->
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark-custom navbar-custom">
<!-- 		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavPosiciones" aria-controls="navbarNavPosiciones" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button> -->
		  <div class="collapse navbar-collapse collapse-custom" id="navbarNavPosiciones">
		    <ul class="navbar-nav">
		      <li class="nav-item nav-item-posiciones active" data-string="arquero">
		        <a class="nav-link" href="javascript:void(0)">Goleros <span class="sr-only">(current)</span></a>
		      </li>
		      <li class="nav-item nav-item-posiciones" data-string="defensor">
		        <a class="nav-link" href="javascript:void(0)">Defensores</a>
		      </li>
		      <li class="nav-item nav-item-posiciones" data-string="mediocampista">
		        <a class="nav-link" href="javascript:void(0)">Mediocampistas</a>
		      </li>
		      <li class="nav-item nav-item-posiciones" data-string="delantero">
		        <a class="nav-link" href="javascript:void(0)">Delanteros</a>
		      </li>
		    </ul>
		  </div>
		</nav>
		<!--/NAVBAR POSICIONES-->

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
			              <p class="card-text">
			              	Posición: <?=ucfirst($value->posicion)?>
			              	<?php if (isset($value->subposicion)): ?>
			              		(<?=$value->subposicion?>)
			              	<?php endif ?>		
			              </p>
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
			              <p class="card-text">
			              	Posición: <?=ucfirst($value->posicion)?>
			              	<?php if (isset($value->subposicion)): ?>
			              		(<?=$value->subposicion?>)
			              	<?php endif ?>	
			              </p>
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