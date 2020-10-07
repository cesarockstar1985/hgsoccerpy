<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

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
	       header("Access-Control-Allow-Headers: Content-Type, x-xsrf-token");

	}

	public function index(){

		//$jugadores 		   = $this->main_model->getJugadores("arquero");
		$jugadores  	   = $this->request('arquero', 'getJugadores');
		$rawJugadores	   = $this->changeExtensionBrowser($jugadores);

		$jugadores  	   = $rawJugadores['jugadores'];
		$extensionBanner   = $rawJugadores['extensionBanner'];
		$image_url  	   = $rawJugadores['image_url'];

		$data['titulo']    = "Goleros";
		$data['pagina']    = "inicio";

		$data['jugadores'] 			= $jugadores;
		$data['extensionBanner'] 	= $extensionBanner;
		$data['image_url'] 	        = $image_url;

		$this->load->view('header');
		$this->load->view('index', $data);
		$this->load->view('footer');

	}

	public function checkSocckerWay(){

		$jugadores = $this->main_model->getJugadores();

		$baseUrl = "https://es.soccerway.com";

		$playerData = [];

		foreach ($jugadores as $key => $value) {

			$cadena = $value->nombres;
			$nombre       = $value->nombres;

			if (!empty($value->segundoNombre)) {
				$cadena.= "+".$value->segundoNombre;
				$nombre      .= " ".$value->segundoNombre;
			}

			$cadena.= "+".$value->apellidos;
			$nombre      .= " ".$value->apellidos;

			if (!empty($value->segundoApellido)) {
				$cadena.= "+".$value->segundoApellido;
				$nombre      .= " ".$value->segundoApellido;
			}

			$playerData[$key]['jugador'] = $nombre;
			$playerData[$key]['id']      = $value->id;

			$html = file_get_contents("https://es.soccerway.com/search/?q=$cadena&module=all");

			libxml_use_internal_errors(true);
			$doc = new \DOMDocument();
			$doc->loadHTML($html);

			$xpath = new \DOMXpath($doc);
			$articles = $xpath->query('//td[@class="player"]');
			libxml_clear_errors();

			// all links in .blogArticle
			$links = [];
			foreach($articles as $container) {
			  $arr = $container->getElementsByTagName("a");
			  foreach($arr as $item) {
			    $href =  $item->getAttribute("href");
			    $bandera =  $item->getAttribute("class");

			    $bandera = str_replace("flag_16 left_16 ", "", $bandera);

			    $bandera = $this->getBandera($bandera);

			    $text = trim(preg_replace("/[\r\n]+/", " ", $item->nodeValue));
			    $links[] = [
			      'href' 	=> $baseUrl.$href,
			      'text' 	=> $text,
			      'bandera' => $bandera
			    ];

			    $playerData[$key]['links'] = $links;

			  }

			}
		}

		$data['jugadores'] =  $playerData;

		$this->load->view('header');
		$this->load->view('scrapedData', $data);
		$this->load->view('footer');

	}

	private function request($param = null, $endpoint){

		//
		// A very simple PHP example that sends a HTTP POST to a remote site
		//

		$postFieldsString = '';

		if ($endpoint == 'getJugadores') {
			$postFieldsString .= 'position='.$param;
		}else{
			$postFieldsString .= 'id_jugador='.$param;
		}

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL,"https://www.hgsoccerpy.com/api/$endpoint");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,
					$postFieldsString);

		// In real life you should use something like:
		// curl_setopt($ch, CURLOPT_POSTFIELDS, 
		//          http_build_query(array('postvar1' => 'value1')));

		// Receive server response ...
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$server_output = curl_exec($ch);

		curl_close ($ch);

		return json_decode($server_output);

	}

	public function getBandera($bandera){

		switch ($bandera) {
			case 'paraguay_16_left':
				$bandera = "py";
				break;
			
			case 'mexico_16_left':
				$bandera = "mx";
				break;

			case 'colombia_16_left':
				$bandera = "co";
				break;

			case 'uruguay_16_left':
				$bandera = "uy";
				break;

			case 'portugal_16_left':
				$bandera = "pt";
				break;

			case 'angola_16_left':
				$bandera = "ao";
				break;

			case 'argentina_16_left':
				$bandera = "ar";
				break;

			case 'netherlands_16_left':
				$bandera = "nl";
				break;

			case 'spain_16_left':
				$bandera = "es";
				break;

			case 'panama_16_left':
				$bandera = "pa";
				break;

			case 'brazil_16_left':
				$bandera = "br";
				break;

			case 'chile_16_left':
				$bandera = "cl";
				break;
		}

		return $bandera;

	}

	public function jugadores(){

		//$jugadores 		   = $this->main_model->getJugadores();
		$jugadores 		   = $this->request(null, 'getJugadores');
		$jugadores   	   = $this->changeExtensionBrowser($jugadores)['jugadores'];
		$data['titulo']    = "Jugadores";
		$data['pagina']    = "jugadores";

		$data['jugadores'] = $jugadores;

		$this->load->view('header');
		$this->load->view('jugadores', $data);
		$this->load->view('footer');

	}

	public function carrera($idJugador){

		$idJugador = $this->sanitize($idJugador);

		//$getJugador = $this->main_model->getJugador($idJugador);

		$getJugador = (array) $this->request($idJugador, 'getJugador');

		$youtube = explode(",", $getJugador['datosJugador'][0]->link_youtube);

		$getJugador['datosJugador'][0]->link_youtube = $youtube;

		$datos = ["jugadores" => $getJugador, "pagina" => "jugadores"];

		$this->load->view('header');
		$this->load->view('carrera', $datos);
		$this->load->view('footer');

	}

	public function sanitize($input) {
	    if (is_array($input)) {
	        foreach($input as $var=>$val) {
	            $output[$var] = $this->sanitize($val);
	        }
	    }
	    else {
	        if (get_magic_quotes_gpc()) {
	            $input = stripslashes($input);
	        }
	        $input  = $this->cleanInput($input);
	        //$output = mysql_real_escape_string($input);
	    }
	    return $input;
	}

	public function cleanInput($input) {
 
	  $search = array(
	    '@<script [^>]*?>.*?@si',            // Strip out javascript
	    '@< [/!]*?[^<>]*?>@si',            // Strip out HTML tags
	    '@<style [^>]*?>.*?</style>@siU',    // Strip style tags properly
	    '@< ![sS]*?--[ tnr]*>@'         // Strip multi-line comments
	  );
	 
	    $output = preg_replace($search, '', $input);
	    return $output;
	}

	public function nosotros(){

		$data['pagina'] = "nosotros";		

		$this->load->view('header');
		$this->load->view('empresa', $data);
		$this->load->view('footer');

	}

	public function contacto(){

		$data['pagina'] = "contacto";		

		$this->load->view('header');
		$this->load->view('contacto', $data);
		$this->load->view('footer');

	}

	public function getJugadores(){
		
		if (isset($_POST)) {

			$string = $_POST['string'];

			$jugadores    = $this->main_model->getJugadores($string);
			$jugadores    = $this->changeExtensionBrowser($jugadores)['jugadores'];

			$jugadoresPro = [];
			$jugadoresJuv = [];

			foreach ($jugadores as $key => $value) {

				$value->posicion = ucfirst($value->posicion);

				if ($value->profesional == 1) {
					
					array_push($jugadoresPro, $value);

				}else if($value->profesional == 0){

					array_push($jugadoresJuv, $value);
				}

				$jugadores = ["profesionales" => $jugadoresPro, "juveniles" => $jugadoresJuv];

			}

			printf(json_encode($jugadores));

		}

	}

	public function getJugador(){

		if ($_POST) {
			
			if (isset($_POST['idJugador']) && !empty($_POST['idJugador'])) {
				
				$idJugador = $_POST['idJugador'];

				$dataJugador = $this->main_model->getJugador($idJugador);

				print_r(json_encode($dataJugador));

			}

		}

	}

	public function changeExtensionBrowser($jugadores){

		if (isset($_SERVER['HTTP_USER_AGENT'])) {
			$user_agent = $_SERVER['HTTP_USER_AGENT']; 	
		}else{
			$user_agent = "";
		}
		
		$serverRoot = getcwd();

		foreach ($jugadores as $key => $jugador) {

			$jugador->imagen = preg_replace('/\\.[^.\\s]{3,4}$/', '', $jugador->imagen);

			if ((stripos($user_agent, "Safari") && stripos($user_agent, "Macintosh")) || stripos($user_agent, "iPhone") || stripos($user_agent, "iPad")) {

				$image_url  = base_url()."public/images/";

				$image_path_jpeg = $serverRoot."/public/images/".$jugador->imagen.".jpeg";
				$image_path_jpg  = $serverRoot."/public/images/".$jugador->imagen.".jpg";
				$image_path_png  = $serverRoot."/public/images/".$jugador->imagen.".png";

				if (file_exists($image_path_jpeg)) {

					$extension = ".jpeg";

				}else if(file_exists($image_path_jpg)){

					$extension = ".jpg";

				}else if(file_exists($image_path_png)){
					
					$extension = ".png";

				}
				
				$extensionBanner = ".jpg";

			}elseif(stripos($user_agent, "Chrome") || stripos($user_agent, "Opera") || stripos($user_agent, "Firefox")){

				$image_url 	 	 = base_url()."public/images_webp/";
				$extension 		 = ".webp";
				$extensionBanner = ".webp";
				
			}else{

				$image_url       = base_url()."public/images/";
				$extension       = ".jpeg";
				$extensionBanner = ".jpg";

			}

			$jugador->imagen = $image_url.$jugador->imagen.$extension;

		}

		$data = [
			'jugadores'       => $jugadores,
			'extensionBanner' => $extensionBanner,
			'image_url'		  => $image_url
		];

		return $data;

	}
}
