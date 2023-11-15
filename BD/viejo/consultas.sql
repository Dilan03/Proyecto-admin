-- PARA AGREGAR LA EITQUETA ANCIENT
INSERT INTO etiquetas(nombre, id_post) values('ancient',$id_post)
SELECT * FROM `etiquetas` WHERE id_post = $id_post AND nombre = 'ancient'

-- PARA DESPLEGAR, AGREGAR Y ELIMINAR
SELECT c.id, c.id_post,u.foto, u.nombre, u.apellido, c.contenido, c.fecha_publicacion, u.no_control FROM comentarios c 
INNER JOIN usuarios u ON u.no_control = c.id_autor ORDER BY c.fecha_publicacion DESC

INSERT INTO comentarios(id_autor, contenido, fecha_publicacion,id_post) values($id_autor, '$comentario','$fecha_publicacion', $id_post)

DELETE FROM comentarios WHERE id = $id_comentario;

-- DESPLEGAR LOS DETALLES DE CADA POST INDIVIDUAL 
SELECT p.id, p.id_autor, p.imagen, d.nombre_objeto, d.fecha_publicacion, d.descripcion, c.nombre as cat, u.nombre, u.apellido, u.telefono, ca.nombre as carrera, ub.nombre as ubicacion,
   (SELECT nombre FROM etiquetas WHERE etiquetas.nombre = 'ancient' AND etiquetas.id_post = p.id) as ancient,
   (SELECT nombre FROM etiquetas WHERE etiquetas.nombre = 'lost' AND etiquetas.id_post = p.id) as lost,
   (SELECT nombre FROM etiquetas WHERE etiquetas.nombre = 'found' AND etiquetas.id_post = p.id) as found,
   (SELECT nombre FROM etiquetas WHERE etiquetas.nombre = 'gathered' AND etiquetas.id_post = p.id) as gathered
   FROM posts p
   INNER JOIN detallesposts d ON p.id_detallesPosts = d.id
   INNER JOIN clasificacion c ON d.id_clasificacion = c.id 
   INNER JOIN usuarios u ON p.id_autor = u.no_control
   INNER JOIN ubicacion ub ON d.id_ubicacion = ub.id
   INNER JOIN carreras ca ON u.id_carrera = ca.id WHERE p.id = $post_id;

-- DESPLEGAR LOS POST DEL USUARIO EN PARTICULAR 

SELECT p.id, p.imagen, detalles.nombre_objeto, detalles.fecha_publicacion, clas.nombre, ub.nombre as ubi,
   (SELECT nombre FROM etiquetas WHERE etiquetas.nombre = 'ancient' AND etiquetas.id_post = p.id) as ancient,
   (SELECT nombre FROM etiquetas WHERE etiquetas.nombre = 'lost' AND etiquetas.id_post = p.id) as lost,
   (SELECT nombre FROM etiquetas WHERE etiquetas.nombre = 'found' AND etiquetas.id_post = p.id) as found,
   (SELECT nombre FROM etiquetas WHERE etiquetas.nombre = 'gathered' AND etiquetas.id_post = p.id) as gathered
   FROM posts p
   INNER JOIN detallesposts detalles ON p.id_detallesPosts = detalles.id
   INNER JOIN clasificacion clas ON detalles.id_clasificacion = clas.id
   INNER JOIN usuarios u ON p.id_autor = u.no_control
   INNER JOIN ubicacion ub ON detalles.id_ubicacion = ub.id
   WHERE p.id_autor = $id ORDER BY detalles.fecha_publicacion;

-- DESPLEGAR LOS OBJETOS EN LA PAGINA DE INICIO 

SELECT p.id, p.imagen, detalles.nombre_objeto, detalles.fecha_publicacion, clas.nombre,
    (SELECT nombre FROM etiquetas WHERE etiquetas.nombre = 'gathered' AND etiquetas.id_post = p.id) as gathered
    FROM posts p
    INNER JOIN detallesposts detalles ON p.id_detallesPosts = detalles.id
    INNER JOIN clasificacion clas ON detalles.id_clasificacion = clas.id
    INNER JOIN etiquetas ON p.id = etiquetas.id_post
    WHERE etiquetas.nombre = 'gathered' AND detalles.fecha_publicacion >= '$fechaMaxima'
    ORDER BY detalles.fecha_publicacion DESC LIMIT 4

-- INSERTAR NUEVOS USUARIOS 
INSERT INTO usuarios(no_control, nombre, apellido, correo, contraseña, foto, telefono, id_carrera, id_rol) values('$no_control','$first_name','$last_name','$email', '$password', '$foto', $phone, '$major', 0)

-- CREAR UN NUEVO POST

INSERT INTO detallesposts(id, nombre_objeto, descripcion, fecha_publicacion, id_ubicacion, id_clasificacion) values($id_post,'$nombre_objeto','$descripcion','$fecha', (SELECT id FROM ubicacion WHERE nombre = '$ubicacion'), (SELECT id FROM clasificacion WHERE nombre = '$categoria'))

INSERT INTO posts(id, imagen, id_autor, id_detallesPosts) values($id_post, '$imagen','$id_autor', $id_post)

INSERT INTO etiquetas(nombre, id_post) values('$estatus',$id_post)

-- LOG IN 

SELECT * FROM usuarios WHERE correo = '$email'

-- DESPLEGAR POSTS 

SELECT p.id, p.imagen, detalles.nombre_objeto, detalles.fecha_publicacion, clas.nombre, u.nombre as ubi,
   (SELECT nombre FROM etiquetas WHERE etiquetas.nombre = 'ancient' AND etiquetas.id_post = p.id) as ancient,
   (SELECT nombre FROM etiquetas WHERE etiquetas.nombre = 'lost' AND etiquetas.id_post = p.id) as lost,
   (SELECT nombre FROM etiquetas WHERE etiquetas.nombre = 'found' AND etiquetas.id_post = p.id) as found,
   (SELECT nombre FROM etiquetas WHERE etiquetas.nombre = 'gathered' AND etiquetas.id_post = p.id) as gathered
   FROM posts p
   INNER JOIN detallesposts detalles ON p.id_detallesPosts = detalles.id
   INNER JOIN clasificacion clas ON detalles.id_clasificacion = clas.id
   INNER JOIN ubicacion u ON detalles.id_ubicacion = u.id
   ORDER BY detalles.fecha_publicacion desc;