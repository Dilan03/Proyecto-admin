<?php 
$consulta_posts = "
SELECT p.id, p.imagen, detalles.nombre_objeto, detalles.fecha_publicacion, clas.nombre, u.nombre as ubi,
(SELECT nombre FROM etiquetas WHERE etiquetas.nombre = 'ancient' AND etiquetas.id_post = p.id) as ancient,
(SELECT nombre FROM etiquetas WHERE etiquetas.nombre = 'lost' AND etiquetas.id_post = p.id) as lost,
(SELECT nombre FROM etiquetas WHERE etiquetas.nombre = 'found' AND etiquetas.id_post = p.id) as found,
(SELECT nombre FROM etiquetas WHERE etiquetas.nombre = 'gathered' AND etiquetas.id_post = p.id) as gathered
FROM posts p
INNER JOIN detallesposts detalles ON p.id_detallesPosts = detalles.id
INNER JOIN clasificacion clas ON detalles.id_clasificacion = clas.id
INNER JOIN ubicacion u ON detalles.id_ubicacion = u.id
ORDER BY detalles.fecha_publicacion;
";