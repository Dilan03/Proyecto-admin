<?php
    require 'functions/conexion.php';
    require 'functions/registrar.php';
    require 'functions/login.php';
    if(!empty($_SESSION["id"])) {
        $id = $_SESSION["id"];
        $result = mysqli_query($conn, "SELECT * FROM usuarios WHERE curp = '$id'");
        $row = mysqli_fetch_assoc($result);
    } 
    
    require 'functions/detalle.php';
    $post_id =  $row_detalle['id'];
?>

<?php include_once 'includes/header.php'?>
<?php include_once 'includes/nav.php'?>

        <section class="main">
            <h1 class="gallery__titulo">Detalle Del Objeto</h1>
            
            <?php include 'includes/detalles.php';
            
            ?>

            <div class="SeccionComentarios">
                <?php if(!empty($_SESSION["id"])) { ?>
                <form method="POST" action=<?php echo "functions/comentar.php?id_autor=".$row['curp']."&id_post=".$row_detalle['id']?> enctype="multipart/form-data">
                    <div class="comentar">
                        <img class="options__user hideElement" src="assets/icons/user-box.svg">
                
                        <div class="profilepic">
                            <?php
                                echo '<img src=data:image;base64,'.$row['foto'].' alt="profilepic"/>'
                            ?>
                        </div>
                        <textarea name="comentario" cols="100" rows="10" placeholder="Añadir un comentario" class="comentario__caja" required></textarea>
    
                    </div>
                    <button type="submit" name="comentar" class="comentar_btn">Comentar</button>
                </form>
                <?php } ?>
                <?php include 'includes/comentario.php'?>
            
            </div>
        </section>
    </div>

<?php include_once 'includes/modales.php'?>

<?php include_once 'includes/footer.php'?>