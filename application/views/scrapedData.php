<div class="container">

	<?php foreach ($jugadores as $key => $jugador): ?>
		<h1><?=$key?>: <?=$jugador['jugador']?></h1>
		
		<?php if (isset($jugador['links'])): ?>

		<table style="width:100%" border="1px">
		  <tr>
		  	<th>id</th>
		    <th>Nombre</th>
		    <th>link</th>
		    <th>text link </th>
		    <th>Link hgSoccer</th>
		  </tr>

			<?php foreach ($jugador['links'] as $key => $value): ?>
			  <tr>
			  	<td><?=$jugador['id']?></td>
			    <td><?=$value['text']?></td>
			    <td><i class="<?=$value['bandera']?> flag"></i> <a href="<?=$value['href']?>" target="_blank">Link SoccerWay</a></td>
			    <td><?=$value['href']?></td>
			    <td><a href="http://hgsoccerpy.com/hgsoccer/main/carrera/<?=$jugador['id']?>" target="_blank">HgSoccer</a></td>
			  </tr>
			<?php endforeach ?>

		</table>

		<?php else: ?>
			<h3 style = "color:red">No se encontro link de SoccerWay</h3>
			<p>id: <?=$jugador['id']?></p>
			<p><a href="http://hgsoccerpy.com/hgsoccer/main/carrera/<?=$jugador['id']?>" target="_blank">HgSoccer</a></p>
		<?php endif ?>

		<br>
		<br>

	<?php endforeach ?>

</div>