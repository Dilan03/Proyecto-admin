<?php
// Obtener la fecha máxima hace una semana
$fechaMaxima = date('Y-m-d', strtotime('-1 week'));

// Consulta para obtener los posts más recientes
$consulta_posts = "
    SELECT p.id, p.imagen, detalles.nombre_objeto, detalles.fecha_publicacion, clas.nombre,
    (SELECT nombre FROM etiquetas WHERE etiquetas.nombre = 'lost' AND etiquetas.id_post = p.id) as lost
    FROM posts p
    INNER JOIN detallesposts detalles ON p.id_detallesPosts = detalles.id
    INNER JOIN clasificacion clas ON detalles.id_clasificacion = clas.id
    INNER JOIN etiquetas ON p.id = etiquetas.id_post
    WHERE etiquetas.nombre = 'lost' AND detalles.fecha_publicacion >= '$fechaMaxima'
    ORDER BY detalles.fecha_publicacion DESC LIMIT 4
";

$result_posts = mysqli_query($conn, $consulta_posts);

$postsL = array(); // Array para almacenar los posts

while ($fila_reciente = mysqli_fetch_assoc($result_posts)) {
    $postsL[] = $fila_reciente; // Agregar cada fila al array de posts
}
?>
