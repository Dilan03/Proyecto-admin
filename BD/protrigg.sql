DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `BorrarComentario` (IN `comentario_id_param` INT)   BEGIN
    DELETE FROM comentarios
    WHERE id = comentario_id_param;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `contar_objetos_nuevos` (OUT `cant` INT)   begin
	select count(*) into cant from etiquetas WHERE nombre = "lost";
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `contar_objetos_usados` (OUT `cant` INT)   begin
	select count(*) into cant from etiquetas WHERE nombre = "found";
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `contar_objetos_vendidos` (OUT `cant` INT)   begin
	select count(*) into cant from etiquetas WHERE nombre="gathered";
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `contar_posts` (OUT `cant` INT)   begin
	select count(*) into cant from posts;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `EliminarUsuario` (IN `usuario_id_param` VARCHAR(18))   BEGIN
    DELETE FROM usuarios
    WHERE curp = usuario_id_param;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertarComentario` (IN `id_autor_param` VARCHAR(18), IN `contenido_param` TEXT, IN `fecha_publicacion_param` DATETIME, IN `id_post_param` INT)   BEGIN
    INSERT INTO comentarios (id_autor, contenido, fecha_publicacion, id_post)
    VALUES (id_autor_param, contenido_param, fecha_publicacion_param, id_post_param);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertarEtiqueta` (IN `nombre_param` VARCHAR(100), IN `id_post_param` INT)   BEGIN
    INSERT INTO etiquetas (nombre, id_post)
    VALUES (nombre_param, id_post_param);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertarUsuario` (IN `curp_param` VARCHAR(18), IN `nombre_param` VARCHAR(50), IN `apellido_param` VARCHAR(50), IN `correo_param` VARCHAR(50), IN `contraseña_param` VARCHAR(50), IN `foto_param` MEDIUMBLOB, IN `telefono_param` VARCHAR(15), IN `id_rol_param` INT(1) UNSIGNED)   BEGIN
    INSERT INTO usuarios (curp, nombre, apellido, correo, contraseña, foto, telefono, id_rol)
    VALUES (curp_param, nombre_param, apellido_param, correo_param, contraseña_param, foto_param, telefono_param, id_rol_param);
END$$

--
-- Funciones
--
CREATE DEFINER=`root`@`localhost` FUNCTION `calcular_Id` (`id_nueva` INT(255)) RETURNS INT(11) DETERMINISTIC BEGIN
	declare id_nueva int;
    select max(id) into id_nueva from posts;
    set id_nueva = id_nueva + 1;
    return id_nueva;
END$$

DELIMITER ;