<?php
	
	$jugador     = $jugadores['datosJugador'][0];
	$trayectoria = $jugadores['trayectoria'];

	$jugador->posicion = ucfirst($jugador->posicion);
	$jugador->fechaNac = date("d-m-Y", strtotime($jugador->fechaNac));

?>
<div class="container">
	<div class="row mt-5">
		<div class="col-md-6 col-xs-12 p-md-5 mb-4">
			<table class="table table-dark">
			  <tbody>
			    <tr>
			      <th scope="row">Nombre:</th>
			      <td>
			      	<?=$jugador->nombres?>
			      	<?php if (isset($jugador->segundoNombre)): 
			      		echo $jugador->segundoNombre;
			      	endif ?>
			      </td>
			    </tr>
			    <tr>
			      <th scope="row">Apellido:</th>
			      <td>
			      	<?=$jugador->apellidos?>
			      	<?php if (isset($jugador->segundoApellido)): 
			      		echo $jugador->segundoApellido;
			      	endif ?>
			      </td>
			    </tr>
			    <tr>
			      <th scope="row">Nacionalidad:</th>
			      <td><?=$jugador->nacionalidad?></td>
				</tr>
				<tr>
			      <th scope="row">Fecha de Nacimiento:</th>
			      <td><?=$jugador->fechaNac?></td>
				</tr>
				<tr>
			      <th scope="row">Edad:</th>
			      <td><?=$jugador->edad?></td>
				</tr>
				<tr>
			      <th scope="row">Posición:</th>
			      <td>
			      	<?=$jugador->posicion?>
			      	
					<?php if (isset($jugador->subposicion)): ?>
						(<?=$jugador->subposicion?>)
					<?php endif ?>

			      </td>
				</tr>

				<?php if (isset($jugador->pie)): ?>
				<tr>
			      <th scope="row">Pie:</th>
			      <td><?=$jugador->pie?></td>
				</tr>
				<?php endif ?>

				<?php if (isset($jugador->altura) && $jugador->altura > 0): ?>
				<tr>
			      <th scope="row">Altura:</th>
			      <td><?=$jugador->altura?> cm</td>
				</tr>
				<?php endif ?>

				<?php if (isset($jugador->peso) && $jugador->peso > 0): ?>
				<tr>
			      <th scope="row">Peso:</th>
			      <td><?=$jugador->peso?> kg</td>
				</tr>
				<?php endif ?>

				<?php if (sizeof($jugador->link_youtube) > 0 && !empty($jugador->link_youtube[0])): ?>
				<tr>
			      <th scope="row">Youtube:</th>
			      <td>
			      	<?php foreach ($jugador->link_youtube as $key => $value): ?>
				      	<a href="<?=$value?>" target="_blank" class="link-youtube"><?=$value?></a>
			      	<?php endforeach ?>
			      </td>
				</tr>
				<?php endif ?>
				<?php if (isset($jugador->link) && !empty($jugador->link)): ?>
				<tr>
			      <th scope="row">Video:</th>
			      <td><a href="<?=base_url()?>public/videos/<?=$jugador->link?>" target="_blank" class="link-youtube"><?=$jugador->link?></a></td>
				</tr>
				<?php endif ?>
				<?php if (isset($jugador->link_soccerway) && !empty($jugador->link_soccerway)): ?>
				<tr>
			      <th scope="row">Soccerway:</th>
			      <td><a href="<?=$jugador->link_soccerway?>" target="_blank" class="link-youtube"><?=$jugador->link_soccerway?></a></td>
				</tr>
				<?php endif ?>
			  </tbody>
			</table>
		</div>
		<div class="col-md-6 mt-md-5 mb-4" id="containerImageJugador">
			<img class="imageJugador" src="<?=base_url()?>public/images/<?=$jugador->imagen?>" alt="<?=$jugador->nombres?> <?=$jugador->apellidos?>">
		</div>
	</div>
	<h1>Trayectoria</h1>
	<div class="row mb-5">
		<div class="col-md-12">
			<table class="table table-dark">
			  <thead>
			    <tr>
			      <th scope="col">Temporada</th>
			      <th scope="col">Equipo</th>
			      <th scope="col">País</th>
			      <th scope="col">Liga</th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php foreach ($trayectoria as $key => $value): ?>

				    <tr>
				      <th scope="row"><?=$value->temporada?></th>
				      <td><?=$value->equipo?></td>
				      <td><i class="<?=$value->bandera?> flag"></i> <?=$value->pais?></td>
				      <td><?=$value->competicion?></td>
				    </tr>

			  	<?php endforeach ?>
			  </tbody>
			</table>
		</div>
	</div>
</div>