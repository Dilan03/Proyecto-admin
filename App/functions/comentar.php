<?php

$serverName = "localhost:3306";
$userName = "root";
$password = "root";
$dbName = "found_it";

$conn = mysqli_connect($serverName, $userName, $password, $dbName);

if(isset($_POST["comentar"])) {

   if(isset($_GET['id_autor'])) {
      $id_autor = $_GET['id_autor'];
   }

   echo $id_autor;

   if(isset($_GET['id_post'])) {
      $id_post = $_GET['id_post'];
   }
   
   $fecha_publicacion = date('Y-m-d H:i:s');
   $comentario = $_POST["comentario"];

   $queryComentario = "CALL InsertarComentario('$id_autor', '$comentario', '$fecha_publicacion', $id_post);";
   mysqli_query($conn, $queryComentario);


   
}

header("Location: ../detailobject.php?id=".$id_post);