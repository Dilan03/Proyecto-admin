-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:33065
-- Tiempo de generación: 01-06-2023 a las 23:50:53
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `found_it`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `contar_objetos_encontrados` (OUT `cant` INT)   begin
	select count(*) into cant from etiquetas WHERE nombre = "found";
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `contar_objetos_perdidos` (OUT `cant` INT)   begin
	select count(*) into cant from etiquetas WHERE nombre = "lost";
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `contar_objetos_recuperados` (OUT `cant` INT)   begin
	select count(*) into cant from etiquetas WHERE nombre="gathered";
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `contar_posts` (OUT `cant` INT)   begin
	select count(*) into cant from posts;
end$$

--
-- Funciones
--
CREATE DEFINER=`root`@`localhost` FUNCTION `calcular_Id` (`id_nueva` INT(255)) RETURNS INT(11) DETERMINISTIC BEGIN
	declare id_nueva int;
    select max(id) into id_nueva from posts;
    set id_nueva = id_nueva + 1;
    return id_nueva;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `ulitmo_comentario` (`comentario` INT) RETURNS INT(11) DETERMINISTIC begin
	declare comentario_id int;
    select max(id) into comentario_id from comentarios;
    return comentario_id;
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carreras`
--

CREATE TABLE `carreras` (
  `id` varchar(5) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carreras`
--

INSERT INTO `carreras` (`id`, `nombre`) VALUES
('ADMIN', 'LICENCIATURA EN ADMINISTRACIÓN'),
('ARQ', 'ARQUITECTURA'),
('IDIND', 'INGENIERIA EN DISEÑO INDUSTRIAL '),
('IGE', 'INGENIERIA EN GESTION INDUSTRIAL'),
('IND', 'INGENIERIA INDUSTRIAL'),
('INF', 'INGENIERIA INFORMATICA'),
('ISC', 'INGENIERIA EN SISTEMAS COMPUTACIONALES');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clasificacion`
--

CREATE TABLE `clasificacion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clasificacion`
--

INSERT INTO `clasificacion` (`id`, `nombre`) VALUES
(0, 'Electronicos '),
(1, 'Ropa'),
(3, 'Otros');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL,
  `id_autor` varchar(12) NOT NULL,
  `contenido` text NOT NULL,
  `fecha_publicacion` datetime NOT NULL,
  `id_post` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Disparadores `comentarios`
--
DELIMITER $$
CREATE TRIGGER `calcular_id_comentarios` BEFORE INSERT ON `comentarios` FOR EACH ROW begin
	declare id int;
	declare nuevo_id int;
    
    SELECT ulitmo_comentario(@tt) into nuevo_id;
    
    if nuevo_id = null then
		set id = 1;
    else
		set id = nuevo_id + 1;
    end if;
    
    set new.id = id;
 end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallesposts`
--

CREATE TABLE `detallesposts` (
  `id` int(11) NOT NULL,
  `nombre_objeto` varchar(100) NOT NULL,
  `descripcion` tinytext DEFAULT NULL,
  `fecha_publicacion` datetime NOT NULL,
  `id_ubicacion` int(11) NOT NULL,
  `id_clasificacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etiquetas`
--

CREATE TABLE `etiquetas` (
  `id` int(11) NOT NULL,
  `nombre` enum('ancient','lost','found','gathered') NOT NULL,
  `id_post` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `imagen` mediumblob NOT NULL,
  `id_autor` varchar(12) NOT NULL,
  `id_detallesPosts` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `rol` enum('invitado','admin','usuario') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `rol`) VALUES
(0, 'usuario'),
(1, 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicacion`
--

CREATE TABLE `ubicacion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(15) NOT NULL,
  `numero` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ubicacion`
--

INSERT INTO `ubicacion` (`id`, `nombre`, `numero`) VALUES
(0, 'Ed. F', NULL),
(1, 'Ed. G', NULL),
(2, 'Ed. D', NULL),
(3, 'Ed. P', NULL),
(4, 'Ed. E', NULL),
(5, 'Ed. B', NULL),
(6, 'Ed. C', NULL),
(7, 'Ed. M', NULL),
(8, 'Ed. T', NULL),
(9, 'Ed. R', NULL),
(10, 'Gimnasio', NULL),
(11, 'Lab. Métodos', NULL),
(12, 'Lab. Computo', NULL),
(13, 'Cafeteria', NULL),
(14, 'Explanada', NULL),
(15, 'Ed. Admin', NULL),
(16, 'Biblioteca', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `no_control` varchar(12) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `contraseña` varchar(50) NOT NULL,
  `foto` mediumblob DEFAULT NULL,
  `telefono` varchar(15) NOT NULL,
  `id_carrera` varchar(5) NOT NULL,
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carreras`
--
ALTER TABLE `carreras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clasificacion`
--
ALTER TABLE `clasificacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_post` (`id_post`),
  ADD KEY `id_autor` (`id_autor`);

--
-- Indices de la tabla `detallesposts`
--
ALTER TABLE `detallesposts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ubicacion` (`id_ubicacion`),
  ADD KEY `id_clasificacion` (`id_clasificacion`);

--
-- Indices de la tabla `etiquetas`
--
ALTER TABLE `etiquetas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_post` (`id_post`);

--
-- Indices de la tabla `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_detallesPosts` (`id_detallesPosts`),
  ADD KEY `id_autor` (`id_autor`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ubicacion`
--
ALTER TABLE `ubicacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`no_control`),
  ADD KEY `id_carrera` (`id_carrera`),
  ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `etiquetas`
--
ALTER TABLE `etiquetas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`id_autor`) REFERENCES `usuarios` (`no_control`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detallesposts`
--
ALTER TABLE `detallesposts`
  ADD CONSTRAINT `detallesposts_ibfk_1` FOREIGN KEY (`id_ubicacion`) REFERENCES `ubicacion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detallesposts_ibfk_2` FOREIGN KEY (`id_clasificacion`) REFERENCES `clasificacion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `etiquetas`
--
ALTER TABLE `etiquetas`
  ADD CONSTRAINT `etiquetas_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`id_detallesPosts`) REFERENCES `detallesposts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`id_autor`) REFERENCES `usuarios` (`no_control`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_carrera`) REFERENCES `carreras` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
