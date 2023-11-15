<?php
if(isset($_GET['id'])) {
   $post_id = $_GET['id'];

   $consulta_detalle = "
   SELECT p.id, p.id_autor, p.imagen, d.nombre_objeto, d.fecha_publicacion, d.descripcion, c.nombre as cat, u.nombre, u.apellido, u.telefono, ub.nombre as ubicacion,
   (SELECT nombre FROM etiquetas WHERE etiquetas.nombre = 'ancient' AND etiquetas.id_post = p.id) as ancient,
   (SELECT nombre FROM etiquetas WHERE etiquetas.nombre = 'lost' AND etiquetas.id_post = p.id) as lost,
   (SELECT nombre FROM etiquetas WHERE etiquetas.nombre = 'found' AND etiquetas.id_post = p.id) as found,
   (SELECT nombre FROM etiquetas WHERE etiquetas.nombre = 'gathered' AND etiquetas.id_post = p.id) as gathered
   FROM posts p
   INNER JOIN detallesposts d ON p.id_detallesPosts = d.id
   INNER JOIN clasificacion c ON d.id_clasificacion = c.id 
   INNER JOIN usuarios u ON p.id_autor = u.curp
   INNER JOIN ubicacion ub ON d.id_ubicacion = ub.id WHERE p.id = $post_id;
   ";
   
   $result_detalle = mysqli_query($conn, $consulta_detalle);
   $row_detalle = mysqli_fetch_assoc($result_detalle);
}
