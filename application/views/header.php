<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>HG Soccer</title>

	<link rel="stylesheet" href="<?=base_url()?>public/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?=base_url()?>public/css/album.css">
	<link rel="stylesheet" href="<?=base_url()?>public/css/dashboard.css">
	<link rel="stylesheet" href="<?=base_url()?>public/flags/flag.min.css">
	<!-- <link rel="stylesheet" href="<?=base_url()?>public/fontawesome/css/fontawesome.css"> -->
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link rel="icon" href="<?=base_url()?>favicon.ico" type="image/x-icon">
	<link rel="shortcut icon" href="<?=base_url()?>favicon.ico" type="image/x-icon">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

	<header>
		<!-- MAIN NAVBAR -->
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark-custom">
		  <a class="navbar-brand" href="<?=base_url()?>">
		  	<img src="<?=base_url()?>public/images/logo-small.jpg" alt="HgSoccer" style="height: 100px;">
		  </a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>
		  <div class="collapse navbar-collapse" id="navbarNav">
		    <ul class="navbar-nav">
		      <li class="nav-item nav-item-main" id="inicio">
		        <a class="nav-link" href="<?=base_url()?>">Inicio <span class="sr-only">(current)</span></a>
		      </li>
		      <li class="nav-item nav-item-main" id="nosotros">
		        <a class="nav-link" href="<?=base_url()?>main/nosotros">La Empresa</a>
		      </li>
		      <li class="nav-item nav-item-main" id="jugadores">
		        <a class="nav-link" href="<?=base_url()?>main/jugadores">Jugadores</a>
		      </li>
		      <li class="nav-item nav-item-main" id="galeria">
		        <a class="nav-link" href="#">Galería</a>
		      </li>
		      <li class="nav-item nav-item-main" id="contacto">
		        <a class="nav-link" href="<?=base_url()?>main/contacto">Contacto</a>
		      </li>
		    </ul>
		  </div>
		</nav>
		<!-- /MAIN NAVBAR -->

	</header>