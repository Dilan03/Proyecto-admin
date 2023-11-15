<?php

$serverName = "127.0.0.1:33065";
$userName = "found_it";
$password = "123";
$dbName = "found_it";

$conn = mysqli_connect($serverName, $userName, $password, $dbName);

if(isset($_GET['id'])) {
   $id_post = $_GET['id'];
   echo $id_post;
}

if(isset($_GET['id_comentario'])) {
   $id_comentario = $_GET['id_comentario'];
   echo $id_comentario;
}

$queryBorrarComentario = "CALL BorrarComentario($id_comentario);";
mysqli_query($conn, $queryBorrarComentario);

header("Location: ../detailobject.php?id=".$id_post);
