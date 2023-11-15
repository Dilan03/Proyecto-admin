<?php
// Aquí debes incluir el código de conexión a la base de datos
$serverName = "127.0.0.1:33065";
$userName = "found_it";
$password = "123";
$dbName = "found_it";

// Verificar si se ha hecho clic en el botón "Confirmar"
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

    // Redirigir al usuario a la página correspondiente según el estatus de la publicación
    if ($estatus == 'lost') {
        header("Location: ../lostobjects.php");
    } elseif ($estatus == 'found') {
        header("Location: ../foundobjects.php");
    }
} elseif (isset($_POST["cancelar"])) {
    // El usuario ha hecho clic en el botón "Cancelar"
    // Realiza aquí cualquier acción necesaria o redirige a otra página si es necesario
    header("Location: ../index.php"); // Ejemplo: redirige al usuario a la página principal
}
?>

<form class="login-form eliminar_post movLR" method="POST">
    <h2 class="login-titulo">Eliminar publicación</h2>
    
    <div class="eliminar_botones">
       <button type="submit" class="login-button" name="confirmar">Confirmar</button>
       <button type="submit" class="login-button" name="cancelar">Cancelar</button>
    </div>

    <button class="cerrar"><img src="assets/icons/equis.svg" id="cerrar_modal"></button>
</form>