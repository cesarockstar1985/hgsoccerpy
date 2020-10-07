<?php
require('lib/data.php');
if($_SESSION['SGC-USER']){

	if (isset($_SESSION['SGC-PERMISSIONS'])) {
    	
    	$permissions = json_decode($_SESSION['SGC-PERMISSIONS']);

        $permissionsCount = sizeof($permissions);

        if ($permissionsCount == 1) {
            header("location:posts.php?page=1");
        }

        //si el usuario tiene mas de dos permiso se habilita el select de Direccion
        if ($permissionsCount > 2) {
            
            $disabledDireccion = "";
            $whereDirecciones = "";

        }else{

            $disabledDireccion = "disabled";
            $whereDirecciones = "WHERE id = {$permissions[0]} LIMIT 1";

        }

    	$sql = "SELECT * FROM direcciones $whereDirecciones";

        if ($permissionsCount > 2) {
            $data = mysqli_query($conn, $sql);  

        }else{

            if ($data = mysqli_query($conn, $sql)) {
                $row = mysqli_fetch_assoc($data);
            }
        }

	}

    if($_POST){

        $nombre 		  = $_POST['name'];
        $tipo   		  = $_POST['type'];
        $estado 		  = $_POST['estado'];
        $observaciones 	  = $_POST['observaciones'];

        isset($_POST['departamento']) ? $departamento = $_POST['departamento'] : $departamento = null;

        if (isset($_POST['direccion'])) {
            
            $direccionId = filter_var ( $_POST['direccion'], FILTER_SANITIZE_STRING);

            $sqlDireccion = "SELECT * FROM direcciones WHERE id = $direccionId";

            if ($dataDireccion = mysqli_query($conn, $sqlDireccion)) {
                $rowDireccion = mysqli_fetch_assoc($dataDireccion);
                
                $userDireccion   = $rowDireccion['nombreDireccion'];
                $userDireccionId = $rowDireccion['id'];

            }


        }else{
          
            $userDireccion    = $row['nombreDireccion'];
            $userDireccionId  = $row['id'];

        }

        $dir = $tipo;

        if(!empty($_FILES["file"]["type"])):

            $url 		= "/docs/sistema-gestion-calidad/".$dir."/";
            $file 		= $_FILES['file']['tmp_name'];
            $ext 		= substr(strrchr($_FILES["file"]["name"],'.'),1);
            $conn_id 	= ftp_connect('190.128.218.138');

            if (
            	$ext == "pdf"  ||
            	$ext == "doc"  ||
            	$ext == "docx" ||
            	$ext == "docm" ||
            	$ext == "xls"  ||
            	$ext == "xlsx" ||
            	$ext == "xlsm"
            ) {
            	
            	ftp_pasv($conn_id,true);

            	$login_result = ftp_login($conn_id,'webuser014','14adminSenave');

            	if((!$conn_id)||(!$login_result)):
            	    echo '<script>alert("No se pudo conectar con el servidor")</script>';
            	    exit;
            	endif;

            	$res_file = md5($nombre).'.'.$ext;
            	$upload   = ftp_put($conn_id,$url.$res_file,$file,FTP_BINARY);

            	if(!$upload):
            	    echo '<script>alert("No se pudo conectar con el servidor")</script>';
            	endif;

            	ftp_close($conn_id);

            	$res_file = 'http://web.senave.gov.py:8081/'.$url.$res_file;
            	$pfile    = $res_file;

            }else{
            	echo '<script>alert("El tipo de archivo debe ser PDF, Word o Excel")</script>';
            }

        else:

            $pfile = null;

        endif;



        $sql = "INSERT INTO sistema_gestion_calidad_archivos (`mostrar`, `fileName`, `fileType`, `userDireccion`,  `userDireccionId`, `userDepartamentoId`, `userId`,                    `userIp`,                      `fileState`, `fileObservations`, `fileUrl`, `fileInsertionDate`)";
        $sql .= " VALUES 									 (1,         '$nombre',  '$tipo',    '$userDireccion', '$userDireccionId', '$departamento'    , '".$_SESSION['SGC-USER']."', '".$_SERVER['REMOTE_ADDR']."', '$estado',   '$observaciones',   '$pfile',  '".date('Y-m-d H:i:s')."');";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo "<script>
                alert('Se insertó el archivo exitosamente');
                window.location.href = 'posts.php?page=1';
            </script>";
        }else{
            echo '<script>alert("Ocurrió un error al insertar el archivo. Intentelo más tarde")</script>';
        }

    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php require('lib/head.php') ?>
</head>
<body>
<?php require('lib/header.php') ?>

<style>
	.form-check-label:hover{
		cursor: pointer;
	}
</style>

<main>
    <div class="container py-4">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="font-weight-bold text-primary">Cargar Archivos</h1>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <hr>
                <form method="POST" enctype="multipart/form-data" class="form-row">
                    <div class="form-group col-md-3">
                        <label for="name" class="font-weight-bold">Nombre de Archivo</label>
                        <input type="text" name="name" id="name" class="form-control" value="" required>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="type" class="font-weight-bold">Tipo</label>
                        <select name="type" id="type" class="form-control" required>
                            <option value="" selected="true" disabled>-</option>
                            <option value="solicitudes">Solicitud</option>
                            <option value="procedimientos">Procedimiento</option>
                            <option value="instructivos">Instructivo</option>
                            <option value="formularios">Formulario</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="direccion" class="font-weight-bold">Dirección</label>
                        <select name="direccion" id="direccion" class="form-control" <?=$disabledDireccion?>>

                            <?php if (isset($permissionsCount) && $permissionsCount > 2): ?>
                                
                                <?php while ($row = mysqli_fetch_assoc($data)): ?>
                                    <option value="<?=$row['id']?>"><?=$row['nombreDireccion']?></option>
                                <?php endwhile ?>
                                
                            <?php else: ?>

                                <option value="<?=$row["id"]?>" selected="true"><?=$row["nombreDireccion"]?></option>

                            <?php endif ?>

                        </select>
                    </div>
                    <div class="col-md-3">
                    	<label for="departamento" class="font-weight-bold">Departamento</label>
                    	<select name="departamento" id="departamento" class="form-control" disabled></select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="category" class="font-weight-bold">Estado</label>
                       <div class="form-check">
                         <input class="form-check-input" type="radio" name="estado" id="estadoPrivado" value="privado" checked>
                         <label class="form-check-label" for="estadoPrivado">
                           Privado
                         </label>
                       </div>
                       <div class="form-check">
                         <input class="form-check-input" type="radio" name="estado" id="estadoPublico" value="publico">
                         <label class="form-check-label" for="estadoPublico">
                           Público
                         </label>
                       </div>
                    </div>
                    <div class="col-md-12">
                    	<div class="form-group">
                    	   <label for="observaciones">Observaciones</label>
                    	   <textarea class="form-control" id="observaciones" name="observaciones" rows="3"></textarea>
                    	 </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="file" class="font-weight-bold">Archivo</label>
                        <input type="file" name="file" id="file" class="form-control" required>
                        <small id="emailHelp" class="form-text text-muted">El tipo de archivos debe ser PDF, Word o Excel.</small>
                    </div>
                    <div class="form-group col-md-12 text-right">
                        <hr>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-2"></i>Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
<?php require('lib/footer.php') ?>
<script>

    const direccionIdPHP = "<?=$permissions[0]?>";

    fetchData(direccionIdPHP);

	document.getElementById("direccion").onchange = function() {

		const direccionId = this.options[this.selectedIndex].value;

		fetchData(direccionId);

	}

    function fetchData(direccionId){
        fetch('getDepartamento.php?s='+direccionId)
          .then((response) => { 
            return response.json().then((data) => {

                populateSelect(data);

            }).catch((err) => {
                console.log(err);
            }) 
        });
    }

	function populateSelect(data){

		const departamentoSelect = document.getElementById("departamento");

        if (data.length > 0) {

            departamentoSelect.disabled  = false;
            departamentoSelect.innerHTML = "";

            Object.keys(data).forEach(function(key) {

              var option   = document.createElement('option');
              option.value = data[key].id;
              option.text  = data[key].nombreDepartamento;

              departamentoSelect.appendChild(option);

            });

        }else{

            departamentoSelect.innerHTML = "";
            departamentoSelect.disabled = true;

        }

	}

</script>
</body>
</html>