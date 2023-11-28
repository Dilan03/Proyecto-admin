<?php
// Aquí debes incluir el código de conexión a la base de datos
$serverName = "127.0.0.1:33065";
$userName = "found_it";
$password = "123";
$dbName = "found_it";

if(isset($_GET['id'])) {
    $id_post = $_GET['id'];
}

$conn = mysqli_connect($serverName, $userName, $password, $dbName);

//$querydisponible = "SELECT disponible from posts WHERE id = $id_post AND disponible = 1";
//$resultadoDisponible = mysqli_query($conn, $querydisponible);

$querypostnodisponible = "UPDATE posts SET disponible = 1 where id = $id_post";
mysqli_query($conn, $querypostnodisponible);

if (isset($_POST["confirmar"])) {

    $conn = mysqli_connect($serverName, $userName, $password, $dbName);

    // Obtener el ID de la publicación a eliminar
    if(isset($_GET['id'])) {
        $id_post = $_GET['id'];
    }

    // Eliminar la publicación de la tabla "posts"
    $queryEliminarPost = "DELETE FROM posts WHERE id_Detallesposts = $id_post";
    mysqli_query($conn, $queryEliminarPost);

    // Eliminar los detalles de la publicación de la tabla "detallesposts"
    $queryEliminarDetalles = "DELETE FROM detallesposts WHERE id = $id_post";
    mysqli_query($conn, $queryEliminarDetalles);

    // Eliminar las etiquetas de la publicación de la tabla "etiquetas"
    $queryEliminarEtiquetas = "DELETE FROM etiquetas WHERE id_post = $id_post";
    mysqli_query($conn, $queryEliminarEtiquetas);
    
    //$querypostnodisponible = "UPDATE posts SET disponible = null where id = $id_post";
    //mysqli_query($conn, $querypostnodisponible);
    header("Location: ../index.php");
    // Redirigir al usuario a la página correspondiente según el estatus de la publicación
    if ($estatus == 'lost') {
        header("Location: ../lostobjects.php");
    } elseif ($estatus == 'found') {
        header("Location: ../foundobjects.php");
    }
} 

if (isset($_POST["cancelar"])) {
    if(isset($_GET['id'])) {
        $id_post = $_GET['id'];
    }

    $querypostnodisponible = "UPDATE posts SET disponible = null where id = $id_post";
    mysqli_query($conn, $querypostnodisponible);
    header("Location: ../detailobject.php?id=".$id_post);
    // El usuario ha hecho clic en el botón "Cancelar"
    // Realiza aquí cualquier acción necesaria o redirige a otra página si es necesario
    //header("Location: ../index.php"); // Ejemplo: redirige al usuario a la página principal
}

// Verificar si se ha hecho clic en el botón "Confirmar"

?>

<form class="login-form eliminar_post movLR" method="POST">
    <h2 class="login-titulo">Eliminar publicación</h2>
    <?php
    if(isset($_GET['id'])) {
        $id_post = $_GET['id'];
    }
    //echo $visible;
    ?>
    <div class="eliminar_botones">
       <button type="submit" class="login-button" name="confirmar">Confirmar</button>
       <button type="submit" class="login-button" name="cancelar">Cancelar</button>
    </div>

    <button class="cerrar"><img src="assets/icons/equis.svg" id="cerrar_modal"></button>
</form>