<?php

$serverName = "localhost:3306";
$userName = "root";
$password = "root";
$dbName = "found_it";

$conn = mysqli_connect($serverName, $userName, $password, $dbName);

if(isset($_POST["actualizarPost"])) {

   if(isset($_GET['id_user'])) {
      $id_autor = $_GET['id_user'];
   }

   if(isset($_GET['id_post'])) {
      $id_post = $_GET['id_post'];
   }

   $nombre_objeto = $_POST["nombre_objeto"];
   $fecha = $_POST["fecha"];
   $estatus = $_POST["estatus"];
   $descripcion = $_POST["descripcion"];
   $categoria = $_POST["categoria"];
   $ubicacion = $_POST["ubicacion"];

   $imagen = $_FILES['imagen']['tmp_name'];
   $imagen_name = $_FILES['imagen']['name'];
   $imagen = base64_encode(file_get_contents(addslashes($imagen)));

   $querydetalles = "UPDATE detallesposts SET nombre_objeto = '$nombre_objeto', descripcion = '$descripcion', fecha_publicacion = '$fecha', id_ubicacion = (SELECT id FROM ubicacion WHERE nombre = '$ubicacion'), id_clasificacion = (SELECT id FROM clasificacion WHERE nombre = '$categoria') WHERE id = $id_post";
   mysqli_query($conn, $querydetalles);

   $querypost = "UPDATE posts SET imagen = '$imagen' WHERE id = $id_post";
   mysqli_query($conn, $querypost);

   $queryetiquetas = "UPDATE etiquetas SET nombre = '$estatus' WHERE id_post = $id_post AND (nombre = 'lost' OR nombre = 'found' OR nombre = 'gathered')";
   mysqli_query($conn, $queryetiquetas);

   $date = date('Y-m-d');

   $hoy = new DateTime($date);
   $fecha_publicacion = new DateTime($fecha);
   $diferencia_dias = $hoy->diff($fecha_publicacion);  

   if($diferencia_dias->days > 8) {
      $existeAncient = mysqli_query($conn,"SELECT * FROM `etiquetas` WHERE id_post = $id_post AND nombre = 'ancient'");

      if((mysqli_num_rows($existeAncient) > 0)) {
         
      } else {
         $queryetiquetas = "INSERT INTO etiquetas(nombre, id_post) values('ancient',$id_post)";
         mysqli_query($conn, $queryetiquetas);
      }
   }else {
      $queryetiquetasD = "DELETE FROM etiquetas WHERE id_post = $id_post and nombre = 'ancient'";
      mysqli_query($conn, $queryetiquetasD);
   }

   header("Location: ../detailobject.php?id=".$id_post);
   echo "<meta http-equiv='refresh' content='0'>";
}