<?php
    require 'functions/conexion.php';
    require 'functions/registrar.php';
    require 'functions/login.php';
    require 'functions/mostrar_posts.php';
    require 'functions/filtrar.php';
    if(!empty($_SESSION["id"])) {
        $id = $_SESSION["id"];
        $result = mysqli_query($conn, "SELECT * FROM usuarios WHERE curp = '$id'");
        $row = mysqli_fetch_assoc($result);
    } else {

    }
?>

<?php include_once 'includes/header.php'?>
<?php include_once 'includes/nav.php'?>

    <section class="main main__gallery">
        <div class="gallery__top">
            <h1 class="gallery__titulo">Objetos Usados</h1>
            <?php include 'includes/filtro.php'?>
        </div>

        <?php
            while($row_posts = mysqli_fetch_array($result_posts)) {
                if (($row_posts['found']) == 'found') {
                    include 'includes/tarjeta_gal.php';
                }
            }
        ?> 
        
    </section>
</div><!-- div cierre container -->

<?php include_once 'includes/modales.php'?>

<?php include_once 'includes/footer.php'?>