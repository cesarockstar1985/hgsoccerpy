<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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
	}

	public function index(){

		$this->load->view("login");

	}

	public function login(){

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			
			if ($_POST['user'] == "cperalta" && $_POST['password'] == "Revolber01") {
				
				$jugadores = $this->main_model->getJugadores();


				$jugadores = $this->formatYoutubeLink($jugadores);

				$data['jugadores'] = $jugadores;

				$this->load->view("adminJugadores", $data);

			}else{

				header("location:". base_url()."/login");

			}

		}

	}

	private function formatYoutubeLink($jugadores){

		$count = 0;
		
		foreach ($jugadores as $key => $value) {
			
			if (isset($value->link_youtube) && !empty($value->link_youtube)) {

				$checkVideoType = $this->videoType($value->link_youtube);

				if ($checkVideoType == "youtube") {

					preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $value->link_youtube, $match);

					$value->link_youtube = "https://www.youtube.com/embed/".$match[1];

					$count++;

				}

			}

		}

		return $jugadores;

	}

	public function getEquipo(){

		if (isset($_POST) && !empty($_POST)) {
			
			$idEquipo = $_POST['id'];

			$equipoData = $this->main_model->getEquipo($idEquipo)[0];

			print_r(json_encode($equipoData));

		}

	}

	public function insertJugador(){

		if (isset($_POST) && !empty($_POST)) {
			
			if (
				(isset($_POST['nombres'])       && !empty($_POST['nombres']))        &&
				(isset($_POST['apellidos'])     && !empty($_POST['apellidos']))     &&
				(isset($_POST['nacionalidad'])  && !empty($_POST['nacionalidad']))  &&
				(isset($_FILES))

		 	) {

				$status  = "success";
				$message = "";

				$_POST['fechaNac'] = date("Y-m-d H:i:s",strtotime($_POST['fechaNac']));

				isset($_POST['profesional'])  ? $_POST['profesional'] = 1 : $_POST['profesional'] = 0;

				unset($_POST['imagenName']);
				unset($_POST['id']);

				$insertJugador = $this->main_model->insertJugador($_POST);

				if (is_numeric($insertJugador)) {
					
					$uploadFile   = $this->uploadFile($_FILES, "images");
					$newJugadorId = $insertJugador;

					$updateJugador = $this->main_model->updateJugador($newJugadorId, array('imagen' => $_FILES['imagen']['name']));

					if ($updateJugador) {

						$message = "Se insertó el jugador";

					}else{

						$status = "error";
						$message = "Ocurrió un error al insertar el jugador";

					}


				}else{
					$status = "error";
					$message = "Ocurrió un error al insertar el jugador";
				}

				$json = [
					"status"  => $status,
					"message" => $message 
				];

				print_r(json_encode($json));

			}

		}

	}

	public function insertEquipo(){

		$status  = "success";
		$message = ""; 

		if (isset($_POST)) {

			if (
				(isset($_POST['temporada'])   &&  !empty($_POST['temporada'])) 	&&
				(isset($_POST['pais']) 	      &&  !empty($_POST['pais'])) 		&&
				(isset($_POST['bandera'])     &&  !empty($_POST['bandera'])) 	&&
				(isset($_POST['equipo'])      &&  !empty($_POST['equipo'])) 		&&
				(isset($_POST['competicion']) &&  !empty($_POST['competicion']))
			) {
				
				$idJugador = $_POST['idJugador'];

				$_POST['id_jugador'] = $idJugador;

				unset($_POST['idJugador']);
				unset($_POST['idEquipo']);

				$insertEquipo = $this->main_model->insertEquipo($_POST);

				if ($insertEquipo) {
					
					$message = "Se insertó el nuevo equipo";

				}else{

					$status = "error";
					$message = "Ocurrió un error inesperado";

				}

			}else{

				$status = "error";
				$message = "Debe ingresar todos los datos del Equipo";

			}

			$json = ["status" => $status, "message" => $message];

			print_r(json_encode($json));

		}

	}


		public function updateJugador(){

			if ($_POST) {
				
				$id = $_POST['id'];

				$datosDb   = $this->main_model->getJugador($id)['datosJugador'][0];
				$datosForm = $_POST;

				$link_youtubeDb   = $datosDb->link_youtube;
				$link_youtubeForm = $_POST['link_youtube'];

				if (isset($_FILES)) {
					
					if (isset($_FILES['imagen']['name']) && empty($_FILES['imagen']['name'])) {

						$imageName = str_replace(base_url()."public/images/", "", $_POST['imagenName']);

					}else{

						$imageName = $_FILES['imagen']['name'];

					}

					if ($imageName != $datosDb->imagen) {
						
	/*					$file='hnbrnocz.jpg';
						$image=  imagecreatefromjpeg($file);
						ob_start();
						imagejpeg($image,NULL,100);
						$cont=  ob_get_contents();
						ob_end_clean();
						imagedestroy($image);
						$content =  imagecreatefromstring($cont);
						imagewebp($content,'images/hnbrnocz.webp');
						imagedestroy($content);*/

						$uploadFile = $this->uploadFile($_FILES, "images");

						if ($uploadFile) {
							
							$dataDB = ['imagen' => $imageName];

							$insertUpdate = $this->main_model->updateJugador($id, $dataDB);

						}

					}
				}

				if ($link_youtubeDb != $link_youtubeForm) {
					
					$dataDB = ['link_youtube' => $link_youtubeForm];

					$insertUpdate = $this->main_model->updateJugador($id, $dataDB);

					if ($insertUpdate) {
						
						$data['message'] = "Se modificaron los datos del jugador";
						$data['result']  = "error";

					}

				}else{

					$data['message'] = "son iguales";
					$data['result']  = "error";
				}

				$data = json_encode($data);

				print_r($data);

			}

		}

		public function uploadFile($files,$path){

			$target_dir = getcwd()."/public/$path/";

			$target_file = $target_dir . basename($files["imagen"]["name"]);
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

			// Check file size
			if ($files["imagen"]["size"] > 500000) {
			    echo "Sorry, your file is too large.";
			    $uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
			    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			    $uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
			    echo "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
			} else {
			    if (move_uploaded_file($files["imagen"]["tmp_name"], $target_file)) {
			        //echo "The file ". basename( $files["imagen"]["name"]). " has been uploaded.";
			        return true;

			    } else {
			        //echo "Sorry, there was an error uploading your file.";
			        return false;
			    }
			}

		}

	public function updateEquipo(){

		$status = "success";
		$message = "";

		if (isset($_POST) && !empty($_POST)) {
			
			if (
				(isset($_POST['temporada'])   &&  !empty($_POST['temporada'])) 	&&
				(isset($_POST['pais']) 	      &&  !empty($_POST['pais'])) 		&&
				(isset($_POST['bandera'])     &&  !empty($_POST['bandera'])) 	&&
				(isset($_POST['equipo'])      &&  !empty($_POST['equipo'])) 		&&
				(isset($_POST['competicion']) &&  !empty($_POST['competicion']))
			) {
				$idEquipo = $_POST['idEquipo'];

				unset($_POST['idJugador']);
				unset($_POST['idEquipo']);

				$equipoDb   = $this->main_model->getEquipo($idEquipo)[0];
				$equipoForm = $_POST;

				$updateData = [];
				$updatedBool = false;

				foreach ($equipoDb as $keyDb => $valueDb) {
					
					foreach ($equipoForm as $keyForm => $valueForm) {
						
						if ($keyDb == $keyForm) {
							
							if ($valueDb != $valueForm) {
								
								$updateData[$keyForm] = $valueForm;

								$updatedBool = true;

							}

						}

					}

				}

				if ($updatedBool) {
					
					$updateEquipo = $this->main_model->updateEquipo($idEquipo, $updateData);

					if ($updateEquipo) {
						
						$message = "El equipo fue actualizado";

					}else{
						$status = "error";
						$message = "No se puedo actualizar el Equipo";
					}

				}

			}else{

				$status = "error";
				$message = "Debe ingresar todos los datos del Equipo";

			}

			$json = ['status' => $status, "message" => $message];

			print_r(json_encode($json));

		}

	}

	function videoType($url) {
    if (strpos($url, "channel") > 0) {
        return 'channel';
    } elseif (strpos($url, 'vimeo') > 0) {
        return 'vimeo';
    } elseif (strpos($url, 'youtube') > 0 || strpos($url, "youtu.be")) {
        return 'youtube';
    } else {
        return 'unknown';
    }
}

}
