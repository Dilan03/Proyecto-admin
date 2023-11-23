<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <?php include_once 'includes/scripts-js.php'?>
    <title>Found it</title>
</head>
<body>
    <div class="container">        
        <header class="header">
            <i class="logo"><a href="index.php"><img src="assets/icons/logo.svg" alt="logo"></a></i>
            <?php
            static $commit = 1;
            if (isset($_POST['buscador'])) {
                $buscar = $_POST['buscador'];

                // Escapar caracteres especiales en la cadena de búsqueda
                $buscar = mysqli_real_escape_string($conn, $buscar);

                // Construir la consulta SQL con la condición de búsqueda
                $consulta_posts = "
                SELECT p.id, p.imagen, detalles.nombre_objeto, detalles.fecha_publicacion, clas.nombre, u.nombre as ubi,
                (SELECT nombre FROM etiquetas WHERE etiquetas.nombre = 'ancient' AND etiquetas.id_post = p.id) as ancient,
                (SELECT nombre FROM etiquetas WHERE etiquetas.nombre = 'lost' AND etiquetas.id_post = p.id) as lost,
                (SELECT nombre FROM etiquetas WHERE etiquetas.nombre = 'found' AND etiquetas.id_post = p.id) as found,
                (SELECT nombre FROM etiquetas WHERE etiquetas.nombre = 'gathered' AND etiquetas.id_post = p.id) as gathered
                FROM posts p
                INNER JOIN detallesposts detalles ON p.id_detallesPosts = detalles.id
                INNER JOIN clasificacion clas ON detalles.id_clasificacion = clas.id
                INNER JOIN ubicacion u ON detalles.id_ubicacion = u.id
                WHERE detalles.nombre_objeto LIKE '%$buscar%';";

                // Ejecutar la consulta y mostrar los resultados
                $result_posts = mysqli_query($conn, $consulta_posts);
                // ...
                //
            }
            ?>
<div class="search__container">
<?php
    $actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    ?>
    <?php if (str_contains($actual_link, 'index')) { ?>
        <div>
            <h2 class="gallery__titulo" style="color: gray;">MARKETPLACE</h2>
        </div>
    <?php } else {?>
        <form class="search__form" method="POST">
            <button class="button__search" type="submit"> <i> <img src="assets/icons/search.svg"> </i> </button>
            <input type="text" placeholder="Buscar..." name="buscador">
        </form>
    <?php } ?>
</div>
            <div class="header__options">
                <?php if(!empty($_SESSION["id"])) { ?>
                    <div class="options__logeduser">
                        <i id="crear_post_btn"><img class="options__upload" src="assets/icons/upload.svg"></i>
                        <i id="options_btn"><img class="options__tuerca" src="assets/icons/tuerca.svg"></i>
                        <div class="options__desplegable hideElement" id="options_desplegable">
                            <a href="userposts.php">Mis publicaciones</a>
                            <a href="#" id="editar_registro_btn">Editar información</a>
                            <a href="#" id="cerrar_sesion_btn" >Cerrar sesión</a>
                            <?php if ($row["id_rol"] == 1) {?>
                            <a href="estadisticas.php">Estadisticas</a>
                            <?php }?>
                        </div>
                        <i>
                            <img class="options__user hideElement" src="assets/icons/user-box.svg" >
                            
                            <div class="profilepic">
                                <?php
                                    echo '<img src=data:image;base64,'.$row['foto'].' alt="profilepic"/>'
                                ?>
                                <!-- <img src="assets/images/perroperfil.png" alt="profilepic"> -->
                            </div>
                        </i>
                    </div>
                <?php } else { ?>
                    <div class="button__login">
                        <button type="submit" class="boton boton__tarjeta boton__tarjeta--login" id="login_btn2">Iniciar sesión</button>
                    </div>
                <?php }?>
            </div>
        </header>