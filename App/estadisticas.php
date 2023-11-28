<?php
require 'functions/conexion.php';
require 'functions/registrar.php';
require 'functions/login.php';
require 'functions/mostrar_posts.php';
require 'functions/filtrar.php';
$serverName = "localhost:3306";
$userName = "root";
$password = "root";
$dbName = "found_it";
    
    //crear conexion 
$conn = mysqli_connect($serverName, $userName, $password, $dbName);

if (!empty($_SESSION["id"])) {
    $id = $_SESSION["id"];
    $result = mysqli_query($conn, "SELECT * FROM usuarios WHERE curp = '$id'");
    $row = mysqli_fetch_assoc($result);
} else {
    header("Location: index.php");
}

// Llamar al procedimiento almacenado para contar los posts
$sqlP = "CALL contar_posts(@cant_posts)";
$resultP = mysqli_query($conn, $sqlP);

// Recuperar el valor del parámetro OUT
$sqlP = "SELECT @cant_posts AS cant_posts";
$resultP = mysqli_query($conn, $sqlP);
$rowP = mysqli_fetch_assoc($resultP);
$cantidadPosts = $rowP['cant_posts'];

// Llamar al procedimiento almacenado para contar los objetos encontrados
$sqlP = "CALL contar_objetos_usados(@cant_encontrados)";
$resultP = mysqli_query($conn, $sqlP);

// Recuperar el valor del parámetro OUT
$sqlP = "SELECT @cant_encontrados AS cant_encontrados";
$resultP = mysqli_query($conn, $sqlP);
$rowP = mysqli_fetch_assoc($resultP);
$cantidadEncontrados = $rowP['cant_encontrados'];

// Llamar al procedimiento almacenado para contar los objetos perdidos
$sqlP = "CALL contar_objetos_nuevos(@cant_perdidos)";
$resultP = mysqli_query($conn, $sqlP);

// Recuperar el valor del parámetro OUT
$sqlP = "SELECT @cant_perdidos AS cant_perdidos";
$resultP = mysqli_query($conn, $sqlP);
$rowP = mysqli_fetch_assoc($resultP);
$cantidadPerdidos = $rowP['cant_perdidos'];

// Llamar al procedimiento almacenado para contar los objetos recuperados
$sqlP = "CALL contar_objetos_vendidos(@cant_recuperados)";
$resultP = mysqli_query($conn, $sqlP);

// Recuperar el valor del parámetro OUT
$sqlP = "SELECT @cant_recuperados AS cant_recuperados";
$resultP = mysqli_query($conn, $sqlP);
$rowP = mysqli_fetch_assoc($resultP);
$cantidadRecuperados = $rowP['cant_recuperados'];
echo $cantidadEncontrados;

// Guardar las cantidades en el almacenamiento local del navegador
echo "<script>
localStorage.setItem('cantidadPosts', $cantidadPosts);
localStorage.setItem('cantidadEncontrados', $cantidadEncontrados);
localStorage.setItem('cantidadPerdidos', $cantidadPerdidos);
localStorage.setItem('cantidadRecuperados', $cantidadRecuperados);
</script>";
?>

<?php include_once 'includes/header.php' ?>
<?php include_once 'includes/nav.php' ?>

<section class="main main__gallery">
    <div class="gallery__top">
        <h1 class="gallery__titulo">Estadisticas</h1>
        <!-- Mostrar la cantidad de posts, objetos encontrados, objetos perdidos y objetos recuperados en la tabla dinámica -->
        <table id="tablaEstadisticas">
            <thead>
                <tr>
                    <th>Categoría</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody style="color: balck;">
                <tr>
                    <td>Posts</td>
                    <td id="cantidadPosts"></td>
                </tr>
                <tr>
                    <td>Objetos usados</td>
                    <td id="cantidadEncontrados"></td>
                </tr>
                <tr>
                    <td>Objetos nuevos</td>
                    <td id="cantidadPerdidos"></td>
                </tr>
                <tr>
                    <td>Objetos vendidos</td>
                    <td id="cantidadRecuperados"></td>
                </tr>
            </tbody>
        </table>
        <br><br>    
        <form  class = "form-baja" method="POST" enctype="multipart/form-data" >
                <label for="curp">Dar de baja usuario</label>
                <input type="text" id="curp" name="curp" placeholder="Curp del usuario" required>
                <button type="submit" name="baja" class="submit-button">DAR DE BAJA</button>
        </form>
    </div>
</section>

</div><!-- div cierre container -->

<?php
    session_start();

    $serverName = "127.0.0.1:33065";
    $userName = "found_it";
    $password = "123";
    $dbName = "found_it";
    
    //crear conexion 
    $conn = mysqli_connect($serverName, $userName, $password, $dbName);
    if (isset($_POST['baja'])) {
        $curp = isset($_POST['curp']) ? htmlspecialchars($_POST['curp']) : '';
        
        $queryEliminarUsuario = "CALL EliminarUsuario('$curp');";
        mysqli_query($conn, $queryEliminarUsuario);
    }
?>

<?php include_once 'includes/modales.php' ?>

<?php include_once 'includes/footer.php' ?>

<script>
    // Obtener las cantidades del almacenamiento local y mostrarlas en la tabla
    var cantidadPosts = localStorage.getItem('cantidadPosts');
    var cantidadEncontrados = localStorage.getItem('cantidadEncontrados');
    var cantidadPerdidos = localStorage.getItem('cantidadPerdidos');
    var cantidadRecuperados = localStorage.getItem('cantidadRecuperados');

    if (cantidadPosts && cantidadEncontrados && cantidadPerdidos && cantidadRecuperados) {
        document.getElementById('cantidadPosts').textContent = cantidadPosts;
        document.getElementById('cantidadEncontrados').textContent = cantidadEncontrados;
        document.getElementById('cantidadPerdidos').textContent = cantidadPerdidos;
        document.getElementById('cantidadRecuperados').textContent = cantidadRecuperados;
    }
</script>
