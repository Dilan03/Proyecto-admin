<?php
$serverName = "127.0.0.1:33065";
$userName = "found_it";
$password = "123";
$dbName = "found_it";

$conn = mysqli_connect($serverName, $userName, $password, $dbName);

$date = date('Y-m-d');

$hoy = new DateTime($date);
$fecha_publicacion = new DateTime(substr($row_posts['fecha_publicacion'], 0,10));
$diferencia_dias = $hoy->diff($fecha_publicacion);    
$id_post = $row_posts['id'];

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