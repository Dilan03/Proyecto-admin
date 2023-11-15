<?php
    require 'functions/conexion.php';
    require 'functions/registrar.php';
    require 'functions/login.php';
    require 'functions/mostrar_posts.php';
    if(!empty($_SESSION["id"])) {
        $id = $_SESSION["id"];
        $result = mysqli_query($conn, "SELECT * FROM usuarios WHERE curp = '$id'");
        $row = mysqli_fetch_assoc($result);
    } 
?>

<?php include_once 'includes/header.php'?>
<?php include_once 'includes/nav.php'?>

    <section class="main main__gallery">
        <div class="gallery__top">
            <h1 class="gallery__titulo">Mis publicaciones</h1>
            <?php include 'includes/filtro.php'?>
        </div>

        <?php
            $user_posts = mysqli_query($conn, "
            SELECT p.id, p.imagen, detalles.nombre_objeto, detalles.fecha_publicacion, clas.nombre, ub.nombre as ubi,
            (SELECT nombre FROM etiquetas WHERE etiquetas.nombre = 'ancient' AND etiquetas.id_post = p.id) as ancient,
            (SELECT nombre FROM etiquetas WHERE etiquetas.nombre = 'lost' AND etiquetas.id_post = p.id) as lost,
            (SELECT nombre FROM etiquetas WHERE etiquetas.nombre = 'found' AND etiquetas.id_post = p.id) as found,
            (SELECT nombre FROM etiquetas WHERE etiquetas.nombre = 'gathered' AND etiquetas.id_post = p.id) as gathered
            FROM posts p
            INNER JOIN detallesposts detalles ON p.id_detallesPosts = detalles.id
            INNER JOIN clasificacion clas ON detalles.id_clasificacion = clas.id
            INNER JOIN usuarios u ON p.id_autor = u.curp
            INNER JOIN ubicacion ub ON detalles.id_ubicacion = ub.id
            WHERE p.id_autor = '$id' ORDER BY detalles.fecha_publicacion;");

            while($row_posts = mysqli_fetch_array($user_posts)) {
                include 'includes/tarjeta_gal.php';
            }
        ?> 
        
    </section>
</div><!-- div cierre container -->

<?php include_once 'includes/modales.php'?>

<?php include_once 'includes/footer.php'?>