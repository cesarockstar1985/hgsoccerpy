<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct(){
	       parent::__construct();
	       $this->load->model("main_model");

		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Method: PUT, GET, POST, DELETE, OPTIONS");
		header('Access-Control-Allow-Credentials: true');
		header('Content-Type: application/json');
		//header("Access-Control-Allow-Headers: Content-Type, x-xsrf-token");
		header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

	}


	public function getSessId(){

		if(isset($_POST)){

			$insertSessionId = $this->main_model->insertSessionId(session_id());

			if ($insertSessionId) {

				$data = ["sessionId" => session_id()];

				print_r(json_encode($data));

			}


		}

	}
	
	public function getMenu($searchTerm = ""){
		
		if(isset($_GET)){
			
			$pedidos = json_encode($this->main_model->getPedidos($searchTerm));
	
			print_r($pedidos);

		}

	}

	public function getMenuId($foodId){

		if(isset($_GET)){

			$pedidos = json_encode($this->main_model->getPedidos("", $foodId));

			print_r($pedidos);

		}

	}

	public function getCartItems($clientIp){

		if (isset($_POST)) {

			if (isset($clientIp) ) {
				
				$getToken = $this->getToken();

				if ($getToken) {
					
					$sum = 0;

					$cartItems = $this->main_model->getCartMenu($clientIp);

					foreach ($cartItems as $key => $value) {
						
						$sum += $value->qty;

					}

					$json = ["cartItems" => $sum];

					print_r(json_encode($json));

				}

			}else{

				echo "<h1>Forbidden</h1>";

			}

		}

	}

	public function confirmPedido($clientIp=null){


		if ($clientIp) {
			
			$clientIp = $this->sanitizeParams($clientIp);

			if (isset($_POST)) {
				
				$postdata = file_get_contents("php://input");
				$datos    = json_decode($postdata, true);

				$getTokenHeader = $this->getToken($datos);

				$getTokenDb = $this->main_model->getCSRFToken($getTokenHeader);

				if ($getTokenDb) {

					$insertPedidoArr = [
						"nombreCliente" 	=> $datos['nombre'],
						"emailCliente"  	=> $datos['email'],
						"telefonoCliente"  	=> $datos['telefono'],
						"latCliente"		=> $datos['lat'],
						"lngCliente"		=> $datos['lng'],
						"ip"				=> $clientIp
					];
					
					$insertPedido = $this->main_model->insertPedido($insertPedidoArr);

					if ($insertPedido && is_numeric($insertPedido)) {

						$boolInsertedItem = true;

						$status  = "success";
						$message = "Se ha ingresado el pedido. Nos estaremos comunicando contigo en la brevedad posible";

						$cartItems = $this->main_model->getCartMenu($clientIp);

						foreach ($cartItems as $key => $value) {
							
							$insertItemArr = [
								"id_menu" => $value->product_id,
								"nombre"  => $value->name,
								"size"	  => $value->size,
								"precio"  => $value->price,
								"cantidad"=> $value->qty,
								"pedidoId"=> $insertPedido
							];

							$insertItem = $this->main_model->insertItem($insertItemArr);

							if (!$insertItem) {
								
								$boolInsertedItem = false;

							}

						}

						if ($boolInsertedItem) {
							
							$emptyCart = $this->main_model->emptyCart($clientIp);

						}

					}else{

						$status = "error";
						$message = "Ocurrió un error al insertar el pedido. Inténtelo más tarde";

					}

					$json = [
						"status" => $status,
						"message" => $message
					];

					print_r(json_encode($json));

				}else{

					echo "<h1>Forbidden</h1>";

				}

			}

		}

	}

	public function addToCart($clientIp=null){

		if ($clientIp) {

			$clientIp = $this->sanitizeParams($clientIp);

			if(isset($_POST)){
				
				$postdata = file_get_contents("php://input");
				$datos    = json_decode($postdata, true);

				$getTokenHeader = $this->getToken($datos);

				$getTokenDB     = $this->main_model->getCSRFToken($getTokenHeader);

				if($getTokenDB){

					$productTokenId = md5($datos['id']);
					$datos['productTokenId'] = $productTokenId;

					$date = date("m-d-Y");

					$cartDatos = [
						"product_id"    => $datos['id'],
						"price" 		=> $datos['costo'],
						"qty"   		=> $datos['cantidad'],
						"created_date"  => $date,
						"name"			=> $datos['pedido'],
						"size"			=> $datos['size'],
						"obs"			=> $datos['obs'],
						"customer_ip"	=> $clientIp
					];

					$insertCart = $this->main_model->insertCart($cartDatos);

					if ($insertCart) {
						
						$status = "success";
						$message = "El producto fue agregado";

					}else{

						$status = "error";
						$message = "Ocurrio un error al procesar el producto";

					}

					$json = ["status" => $status, "message" => $message];

					print_r(json_encode($json));

				}else{

					echo "<h1>Forbidden</h1>";

				}

			}

		}

	}

	public function sanitizeParams($params){

		$params = preg_replace('/[^-a-zA-Z0-9_]/', '', $params);

		return $params;

	}

	public function getToken(){

		$headers = getallheaders();

		echo "<pre>";
		var_dump($headers);
		echo "</pre>";

		if(isset($headers['Authorization'])){

			$auth = $headers['Authorization'];
			$token = str_replace("Bearer ", "", $auth);
	
			return $token;
			
		}else{
			echo '<h1>Sin Token</h1>';

			exit();
		}


	}

	public function getCartContent($clientIp){

		$clientIp = $this->sanitizeParams($clientIp);

	   if (isset($_GET)) {
	      
	      $getCartMenu = $this->main_model->getCartMenu($clientIp);

	      $subtotal = 0;
	      
	      foreach ($getCartMenu as $key => $value) {
	      	
	      	$subtotal += $value->price*$value->qty;

	      	switch ($value->size) {
	      		case 'pequena':
	      			$value->size = "Pequeña";
	      			break;

	      		case 'mediana':
	      			$value->size = "Mediana";
	      			break;
	      		
	      		case 'grande':
	      			$value->size = "Grande";
	      			break;
	      	}

	      }

	      $json = [
	      	"productos" => $getCartMenu,
	      	"subtotal"  => $subtotal
	      ];

	      print_r(json_encode($json));

	   }

	}	

}
