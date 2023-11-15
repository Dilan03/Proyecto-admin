<?php
$serverName = "127.0.0.1:33065";
$userName = "found_it";
$password = "123";
$dbName = "found_it";

$conn = mysqli_connect($serverName, $userName, $password, $dbName);

if(isset($_POST["publicar"])) {

   $serverName = "127.0.0.1:33065";
   $userName = "found_it";
   $password = "123";
   $dbName = "found_it";

   $conn = mysqli_connect($serverName, $userName, $password, $dbName);

   if(isset($_GET['id_user'])) {
      $id_autor = $_GET['id_user'];
   }

   $sqlFun = "SELECT calcular_Id(@p0) AS nueva_id";
   $resultFun = mysqli_query($conn, $sqlFun);
   $rowFun = mysqli_fetch_assoc($resultFun);
   $id_calculada = (int)$rowFun['nueva_id'];

   // $queryID = "SELECT id FROM posts ORDER BY id DESC LIMIT 1";
   // $resultadoConsulta = mysqli_query($conn, $queryID);
   // $datoID = mysqli_fetch_assoc($resultadoConsulta);

   $id_post = $id_calculada;

   $nombre_objeto = $_POST["nombre_objeto"];
   $fecha = $_POST["fecha"];
   $estatus = $_POST["estatus"];
   $descripcion = $_POST["descripcion"];
   $categoria = $_POST["categoria"];
   $ubicacion = $_POST["ubicacion"];

   $imagen = $_FILES['imagen']['tmp_name'];
   $imagen_name = $_FILES['imagen']['name'];
   $imagen = base64_encode(file_get_contents(addslashes($imagen)));

   $querydetalles = "INSERT INTO detallesposts(id, nombre_objeto, descripcion, fecha_publicacion, id_ubicacion, id_clasificacion) values($id_post,'$nombre_objeto','$descripcion','$fecha', (SELECT id FROM ubicacion WHERE nombre = '$ubicacion'), (SELECT id FROM clasificacion WHERE nombre = '$categoria'))";
   mysqli_query($conn, $querydetalles);

   $querypost = "INSERT INTO posts(id, imagen, id_autor, id_detallesPosts) values($id_post, '$imagen','$id_autor', $id_post)";
   mysqli_query($conn, $querypost);

   $queryetiquetas = "CALL InsertarEtiqueta('$estatus', $id_post);";
   mysqli_query($conn, $queryetiquetas);
}

if($estatus == 'lost') {
   header("Location: ../lostobjects.php");
} elseif ($estatus == 'found') {
   header("Location: ../foundobjects.php");
}  