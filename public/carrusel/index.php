<?php 
    $conexion = mysqli_connect("localhost", "root", "", "bolsadet_job_boart"); 
    
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <title>Carousel BTU-UNAMBA</title>
        <link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/alertify.css">
        <link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/themes/default.css">
        <link rel="stylesheet" type="text/css" href="librerias/css/estilos.css">
        <script src="librerias/jquery-3.2.1.min.js"></script>
        <script src="librerias/bootstrap/js/bootstrap.js"></script>
        <script src="librerias/bootstrap/js/bootstrap.min.js"></script>
        <script src="librerias/alertifyjs/alertify.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-inverse  navbar-fixed-top">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Orsade app</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="./">BTU-UNAMBA</a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="./">Inicio</a></li>
                        <li><a href="View/editar.php" >Administar</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="TamanoSlider">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <?php 
                        $controler_activo = 2;
                        $controle_num_slider = 1;
                        $resultado_carousel = "SELECT * FROM carousel ORDER BY id ASC";
                        $resultado_carousel_datos= mysqli_query($conexion, $resultado_carousel);
                        while ($row_carousel = mysqli_fetch_assoc($resultado_carousel_datos)) {
                            if ($controler_activo == 2) { ?> 
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <?php  
                        $controler_activo = 1;
                        }else{?>
                    <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $controle_num_slider; ?>"></li>
                    <?php 
                        $controle_num_slider++; 
                        }   
                        }
                        ?>
                </ol>
                <!-- Wrapper for slides -->  
                <div class="carousel-inner" role="listbox">
                    <?php 
                        $controler_activo = 2;
                        $resultado_carousel = "SELECT * FROM carousel ORDER BY id ASC";
                        $resultado_carousel_datos= mysqli_query($conexion, $resultado_carousel);
                        while ($row_carousel = mysqli_fetch_assoc($resultado_carousel_datos)) {
                            if ($controler_activo == 2) { ?> 
                    <div class="item active">
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($row_carousel['img']); ?>" alt="Texto 1">
                        <div class="carousel-caption">
                        </div>
                    </div>
                    <?php  
                        $controler_activo = 1;
                        }else{?>
                    <div class="item">
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($row_carousel['img']); ?>" alt="...">
                        <div class="carousel-caption">
                        </div>
                    </div>
                    <?php 
                        }   
                        }
                        ?>
                </div>
                <!-- Controls -->
                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                	<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                	<span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                	<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                	<span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </body>
</html>

