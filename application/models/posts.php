<?php
require('lib/data.php');
if($_SESSION['SGC-USER']) {

    $userPermissions = json_decode($_SESSION['SGC-PERMISSIONS'])[0];

    $archivoWhere = "";
    $get = "";

    if (isset($_GET['page']) && is_numeric($_GET['page'])) {
        $getPage=filter_var ( $_GET['page'], FILTER_SANITIZE_STRING);
    }else{
        header("location:index.php");
    }

    if (isset($_GET['s'])) {
        
        $get=filter_var ( $_GET['s'], FILTER_SANITIZE_STRING);

        $archivoWhere = " sgca.`userDireccion` = '{$get}' AND";

    }

    $activePagination = "";

    $offset = ($getPage-1)*10;

    //
    $sql = "SELECT sgca.*, usgc.`user_name` as 'username'
            FROM sistema_gestion_calidad_archivos sgca
            LEFT JOIN user_sistema_gestion_calidad usgc
            ON sgca.`userId` = usgc.`user_id`
            WHERE $archivoWhere
            sgca.`mostrar` = 1
            LIMIT $offset, 10;";


    $dataArchivos = mysqli_query($conn, $sql);

    $sqlDirecciones = "SELECT * FROM direcciones";
    $dataDirecciones = mysqli_query($conn,$sqlDirecciones);

    $sqlCountFiles = "SELECT COUNT(*) AS count FROM sistema_gestion_calidad_archivos WHERE mostrar = 1";

    $dataCountFiles = mysqli_query($conn, $sqlCountFiles);

    if($dataCountFiles){

        $countFiles = mysqli_fetch_assoc($dataCountFiles)['count'];

        $totalPages = ceil($countFiles / 10);

    }


}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php require('lib/head.php') ?>
    <link rel="stylesheet" href="/css/sidebar-style.css">
</head>
<body>
<?php require('lib/header.php') ?>
<main>
    <div class="row">
        <nav id="sidebar" class="col-md-3">
            <div class="sidebar-header">
                <h3>Direcciones</h3>
            </div>

            <ul class="list-unstyled components">

                <?php
                    while ($rowDirecciones=mysqli_fetch_assoc($dataDirecciones)) {

                        $rowDirecciones['nombreDireccion'] == $get && isset($get) ? $active = "active" : $active = "";
                ?>

                <li class="<?=$active?>">
                    <a href="posts.php?page=1&s=<?=$rowDirecciones['nombreDireccion']?>"><?=$rowDirecciones['nombreDireccion']?></a>
                </li>

                <?php } ?>

            </ul>
        </nav>
        <div class="container py-4 col-md-9">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="font-weight-bold text-primary">Publicaciones</h1>
                </div>
            </div>
            <div class="row justify-content-center mt-4">
                <div class="col-md-12">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Nombre del Archivo</th>
                            <th>Tipo</th>
                            <th>Subido Por</th>
                            <th>Estado</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            
                            while($row=mysqli_fetch_array($dataArchivos)){

                                switch ($row['fileState']) {
                                    case 'publico':
                                        $row['fileState'] = "<button class='btn btn-success'>Público</button>";
                                        break;

                                    case 'privado':
                                        $row['fileState'] = "<button class='btn btn-warning'>Privado</button>";
                                        break;

                                }

                                $countFiles++;

                        ?>
                            <tr>
                                <td><?=$row['fileInsertionDate']?></td>
                                <td><?=$row['fileName']?></td>
                                <td><?=$row['fileType']?></td>
                                <td><?=$row['username']?></td>
                                <td><?=$row['fileState']?></td>
                                <td>
                                    <ul class="list-inline m-0">
                                        <?php if ($row['userDireccionId'] == $userPermissions): ?>
                                            <li class="list-inline-item"><a href="post_edit.php?id=<?=$row['id']?>"><span class="fas fa-pencil-alt"></span></a></li>
                                            <li class="list-inline-item"><a href="post_delete.php?id=<?=$row['id']?>" onclick="return confirm('Seguro que quiere eliminar el registro');"><span class="fas fa-trash"></span></a></li>
                                        <?php endif ?>
                                        <li class="list-inline-item"><a href="<?=$row['fileUrl']?>" target="_blank"><span class="fas fa-eye"></span></a></li>
                                    </ul>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

        <?php if (isset($countFiles) && $countFiles > 10): ?>
        <nav aria-label="Page navigation example">
          <ul class="pagination">
            
            <?php if ($getPage > 1): ?>
                <li class="page-item"><a class="page-link" href="posts.php?page=<?=$getPage-1?>">Anterior</a></li>
            <?php endif ?>

            <?php for ($i=1; $i <= $totalPages; $i++): ?>

                <?php $getPage == $i ? $activePagination = "active" : $activePagination = "" ?>
                
                <li class="page-item <?=$activePagination?>"><a class="page-link" href="posts.php?page=<?=$i?>"><?=$i?></a></li>

            <?php endfor ?>
            
            <?php if ($getPage != $totalPages): ?>
                <li class="page-item"><a class="page-link" href="posts.php?page=<?=$getPage+1?>">Siguiente</a></li>
            <?php endif ?>
          </ul>
        </nav>
        <?php endif ?>
        </div>
    </div>
</main>
<?php require('lib/footer.php') ?>
</body>
</html>