<header class="header">
    <div class="main bg-white">
        <div class="container py-3">
            <div class="row align-items-center">
                <div class="col-4">
                    <img src="/img/logo.png" alt="">
                </div>
                <div class="col-4 text-center">
                    <img src="/img/logo_paraguay.png" alt="">
                </div>
                <div class="col-4 text-right">
                    <img src="/img/logo_gobierno.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary py-lg-0">
        <div class="container">
            <a class="navbar-brand d-lg-none" href="#">MENU PRINCIPAL</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <?php
                    if(!empty($_SESSION['FC-USER'])){
                        echo '<li class="nav-item"><a class="nav-link text-white" href="/041de373322cf1e1ca80739dca77c381">Home</a></li>';
                        $optionArray = json_decode($_SESSION['PERMISSIONS']);
                        for ($i=0; $i<count($optionArray); $i++) {
                            if ($optionArray[$i] == 2) {
                                echo '<li class="nav-item"><a class="nav-link text-white" href="/041de373322cf1e1ca80739dca77c381/news.php">Noticia</a></li>';
                            }
                            if ($optionArray[$i] == 3) {
                                echo '<li class="nav-item"><a class="nav-link text-white" href="/041de373322cf1e1ca80739dca77c381/fimport.php">Fitosanitarios Importación</a></li>';
                            }
                            if ($optionArray[$i] == 4) {
                                echo '<li class="nav-item"><a class="nav-link text-white" href="/041de373322cf1e1ca80739dca77c381/fexport.php">Fitosanitarios Exportación</a></li>';
                            }
                            if ($optionArray[$i] == 5) {
                                echo '<li class="nav-item"><a class="nav-link text-white" href="/041de373322cf1e1ca80739dca77c381/resolution.php">Resoluciones Senave</a></li>';
                            }

                        }

                        echo '<li class="nav-item"><a class="nav-link text-white" href="/041de373322cf1e1ca80739dca77c381/posts.php?page=1">Publicaciones</a></li>';

                    }else{
                        echo '<li class="nav-item"><a class="nav-link text-white" href="#">INGRESAR A WEB ADMIN</a></li>';
                    }
                    ?>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <?php if(!empty($_SESSION['FC-USER'])){ ?>
                        <li class="nav-item"><a class="nav-link text-white" href="/041de373322cf1e1ca80739dca77c381/logout.php">Salir</a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
</header>
