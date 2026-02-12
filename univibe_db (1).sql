-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Servidor: db:3306
-- Tiempo de generación: 12-02-2026 a las 21:10:59
-- Versión del servidor: 8.0.45
-- Versión de PHP: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `univibe_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atributos`
--

CREATE TABLE `atributos` (
  `id` int NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `icono` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `atributos`
--

INSERT INTO `atributos` (`id`, `nombre`, `icono`) VALUES
(1, 'Fiesta', 'local_bar'),
(2, 'Limpieza', 'cleaning_services'),
(3, 'Estudio', 'menu_book'),
(4, 'Mascotas', 'pets'),
(5, 'Musica', 'music_note_2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carreras`
--

CREATE TABLE `carreras` (
  `id` int NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carreras`
--

INSERT INTO `carreras` (`id`, `nombre`) VALUES
(1, 'Grado en Ingeniería Informática'),
(2, 'Grado en Medicina'),
(3, 'Grado en Derecho'),
(4, 'Grado en Administración y Dirección de Empresas'),
(5, 'Grado en Enfermería'),
(6, 'Grado en Psicología'),
(7, 'Grado en Educación Primaria'),
(8, 'Grado en Ingeniería Mecánica'),
(9, 'Grado en Arquitectura'),
(10, 'Grado en Periodismo'),
(11, 'Grado en Biotecnología'),
(12, 'Grado en Fisioterapia'),
(13, 'Grado en Marketing'),
(14, 'Grado en Turismo'),
(15, 'Grado en Bellas Artes'),
(16, 'Grado en Ciencias de la Actividad Física y del Deporte'),
(17, 'Grado en Farmacia'),
(18, 'Grado en Ingeniería Civil'),
(19, 'Grado en Matemáticas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inmuebles`
--

CREATE TABLE `inmuebles` (
  `id` int NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` text,
  `direccion` varchar(255) DEFAULT NULL,
  `precio` int DEFAULT NULL,
  `imagen_principal` varchar(255) DEFAULT NULL,
  `imagen1` varchar(255) DEFAULT NULL,
  `imagen2` varchar(255) DEFAULT NULL,
  `imagen3` varchar(255) DEFAULT NULL,
  `imagen4` varchar(255) DEFAULT NULL,
  `propietario_id` int DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `universidad_id` int DEFAULT NULL,
  `metros` int NOT NULL,
  `habitaciones` int NOT NULL,
  `banios` int NOT NULL,
  `n_personas` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `inmuebles`
--

INSERT INTO `inmuebles` (`id`, `titulo`, `descripcion`, `direccion`, `precio`, `imagen_principal`, `imagen1`, `imagen2`, `imagen3`, `imagen4`, `propietario_id`, `created_at`, `universidad_id`, `metros`, `habitaciones`, `banios`, `n_personas`) VALUES
(1, 'Piso Virgen en el Centro', 'Piso recién reformado, listo para entrar.', 'Calle prueba', 450, '1770758928_14aab6c90c801a17b387.jpg', '1770758928_c0721c62569b41e17287.jpg', '1770758928_45b6b2272eeab63da172.jpg', '1770758928_35c72dbf0afd2b9c79cc.jpg', '1770758928_d15e32e94a0e27381425.jpg', 3, '2026-01-25 17:44:30', 1, 120, 4, 1, 4),
(2, 'Estudio moderno cerca del Campus', 'Ideal para estudiantes de ciencias, todo equipado y silencioso.', 'Calle Einstein 4', 350, '1770758984_8f4802a840dc9cde27b6.jpg', '1770758984_b617e63e2971c05e406b.jpg', '1770758984_dcbc5c99662637a4e2c8.jpg', '1770758984_9dbf108c90f4178bbdb7.jpg', '1770758984_4749af1b2cd0c5ebb8b3.jpg', 7, '2026-02-04 18:19:54', 1, 100, 4, 2, 4),
(15, 'Ático con Terraza', 'Increíble ático con vistas al centro y mucha luz natural.', 'Avenida Constitución 12', 450, 'atico_principal.jpg', 'img1.jpg', 'img2.jpg', 'img3.jpg', 'img4.jpg', 7, '2026-02-12 18:27:22', 1, 85, 3, 1, 3),
(16, 'Estudio Minimalista', 'Pequeño pero funcional, ideal para una persona.', 'Calle Mayor 5', 300, 'estudio_principal.jpg', 'img1.jpg', 'img2.jpg', 'img3.jpg', 'img4.jpg', 7, '2026-02-12 18:27:22', 1, 40, 1, 1, 1),
(17, 'Piso para Estudiantes', 'Piso amplio con 4 habitaciones cerca de la facultad.', 'Calle Doctor Fleming 22', 600, 'estudiantes_principal.jpg', 'img1.jpg', 'img2.jpg', 'img3.jpg', 'img4.jpg', 7, '2026-02-12 18:27:22', 1, 110, 4, 2, 4),
(18, 'Habitación Premium', 'Habitación con baño privado en piso compartido de lujo.', 'Calle Sierpes 1', 380, 'hab_lujo_principal.jpg', 'img1.jpg', 'img2.jpg', 'img3.jpg', 'img4.jpg', 7, '2026-02-12 18:27:22', 1, 20, 1, 1, 1),
(19, 'Apartamento Moderno', 'Reformado recientemente con muebles de diseño.', 'Calle Real 45', 500, 'moderno_principal.jpg', 'img1.jpg', 'img2.jpg', 'img3.jpg', 'img4.jpg', 7, '2026-02-12 18:27:22', 1, 75, 2, 1, 2),
(20, 'Bajo con Jardín', 'Planta baja con patio privado, ideal para mascotas.', 'Calle Olivo 8', 420, 'bajo_principal.jpg', 'img1.jpg', 'img2.jpg', 'img3.jpg', 'img4.jpg', 7, '2026-02-12 18:27:22', 1, 90, 3, 1, 3),
(21, 'Loft Industrial', 'Espacio abierto tipo loft techos muy altos.', 'Polígono Norte 3', 350, 'loft_principal.jpg', 'img1.jpg', 'img2.jpg', 'img3.jpg', 'img4.jpg', 7, '2026-02-12 18:27:22', 1, 120, 1, 1, 2),
(22, 'Piso Luminoso', 'Todas las habitaciones exteriores, muy soleado.', 'Avenida de la Paz 100', 480, 'luz_principal.jpg', 'img1.jpg', 'img2.jpg', 'img3.jpg', 'img4.jpg', 7, '2026-02-12 18:27:22', 1, 95, 3, 2, 3),
(23, 'Duplex Familiar', 'Dos plantas, ideal para grupos grandes o familias.', 'Calle Luna 15', 750, 'duplex_principal.jpg', 'img1.jpg', 'img2.jpg', 'img3.jpg', 'img4.jpg', 7, '2026-02-12 18:27:22', 1, 140, 5, 3, 6),
(24, 'Céntrico Económico', 'La mejor ubicación al precio más bajo.', 'Plaza España 2', 280, 'economico_principal.jpg', 'img1.jpg', 'img2.jpg', 'img3.jpg', 'img4.jpg', 7, '2026-02-12 18:27:22', 1, 55, 2, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inmueble_atributos`
--

CREATE TABLE `inmueble_atributos` (
  `inmueble_id` int NOT NULL,
  `atributo_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `inmueble_atributos`
--

INSERT INTO `inmueble_atributos` (`inmueble_id`, `atributo_id`) VALUES
(2, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matches`
--

CREATE TABLE `matches` (
  `id` int NOT NULL,
  `estudiante_id` int DEFAULT NULL,
  `inmueble_id` int DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `matches`
--

INSERT INTO `matches` (`id`, `estudiante_id`, `inmueble_id`, `created_at`) VALUES
(1, 10, 2, '2026-02-04 18:06:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes`
--

CREATE TABLE `solicitudes` (
  `id` int NOT NULL,
  `estudiante_id` int DEFAULT NULL,
  `inmueble_id` int DEFAULT NULL,
  `estado` enum('interesado','aceptado','rechazado') DEFAULT 'interesado',
  `fecha_solicitud` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `solicitudes`
--

INSERT INTO `solicitudes` (`id`, `estudiante_id`, `inmueble_id`, `estado`, `fecha_solicitud`) VALUES
(115, 10, 2, 'interesado', '2026-02-12 21:08:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `universidades`
--

CREATE TABLE `universidades` (
  `id` int NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `siglas` varchar(20) DEFAULT NULL,
  `ciudad` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `universidades`
--

INSERT INTO `universidades` (`id`, `nombre`, `siglas`, `ciudad`) VALUES
(1, 'Universidad Politécnica de Valencia', 'UPV', 'Valencia'),
(2, 'Universidad de Valencia', 'UV', 'Valencia'),
(3, 'Universidad Complutense de Madrid', 'UCM', 'Madrid'),
(4, 'Universidad de Barcelona', 'UB', 'Barcelona');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `id_carrera` int DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `rol` enum('admin','estudiante','propietario') DEFAULT 'estudiante',
  `foto_perfil` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `universidad_id` int DEFAULT NULL,
  `link_instagram` varchar(255) NOT NULL,
  `link_spotify` varchar(255) NOT NULL,
  `link_x` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `telefono`, `descripcion`, `id_carrera`, `password`, `rol`, `foto_perfil`, `created_at`, `universidad_id`, `link_instagram`, `link_spotify`, `link_x`, `token`) VALUES
(1, 'Admin UniVibe', 'admin@univibe.com', '123213', 'asdasddsa', 1, '$2y$12$1sVsQyMSyw4YqxSAA7F0NON6yVWh28iB3Jpi5l8zrLIW..pI5/uHK', 'admin', NULL, '2026-01-25 17:44:30', 1, '', '', '', ''),
(3, 'Pedro Propietario', 'pedro@p pisos.com', NULL, '', NULL, '1234', 'propietario', NULL, '2026-01-25 17:44:30', NULL, '', '', '', ''),
(7, 'Pepe', 'pepe@gmail.com', NULL, '', NULL, '$2y$12$xylzez4pzCu8HtOzahvfWuE0kguCgxZv7OBRxY3vf2VDPfoSP026a', 'propietario', NULL, '2026-02-04 13:03:08', NULL, '', '', '', '45659c66ace885757e78266bb11e721a02fca7fe2ecf43fefaf03d6a6ffc520f'),
(8, 'paco', 'paco@gmail.com', NULL, '', NULL, '$2y$12$zydrfW6SvE5/8PvC3pwGNeS1z.GGgk1O9NSwJi1T4T3G6jFtuQ4eC', 'estudiante', NULL, '2026-02-04 13:03:51', NULL, '', '', '', ''),
(10, 'Jorge Gómez García', 'jorge@gmail.com', '640812573', '\"Macarena es mi mejor amiga, tiene el pelo largo, castaño y abundante. Suele llevarlo deshecho y con flequillo. Siempre está morena y, aunque no se maquilla, destaca por sus ojos delineados en negro. Es una persona muy inteligente, empática y generosa\". ', 1, '$2y$10$qVhrai1RwsafBawMwXnEoeeHy1HgNsTHe5qXZJYS.lFsPL8M.hDUy', 'estudiante', 'hoke.jpeg', '2026-02-04 16:40:34', 1, '', '', '', '32aa8acb98daab433a138541cdcff63a6fbca7bbb29f8ca75975185df6906aca'),
(18, 'Pedro Garcia', 'pedrogarcia@gmail.com', '640812573', 'Hola me llamo Pedro ,soy un chico que le gusta la fiesta', 1, '$2y$10$nitc9liTAXW8Q8IKpFTsDec/hxPUi8uuBAw88U61FWnr9mtxCsLQu', 'estudiante', 'avatar_default.png', '2026-02-11 15:38:30', 1, '', '', '', '2a09e3077021f8749957d6f6dee4607ea810113198fbc9d9bb923d13e056a6a8');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_atributos`
--

CREATE TABLE `usuario_atributos` (
  `usuario_id` int NOT NULL,
  `atributo_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuario_atributos`
--

INSERT INTO `usuario_atributos` (`usuario_id`, `atributo_id`) VALUES
(8, 1),
(18, 1),
(8, 2),
(10, 2),
(18, 2),
(8, 3),
(10, 3),
(8, 4),
(10, 4),
(8, 5);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `atributos`
--
ALTER TABLE `atributos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `carreras`
--
ALTER TABLE `carreras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inmuebles`
--
ALTER TABLE `inmuebles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `propietario_id` (`propietario_id`),
  ADD KEY `universidad_id` (`universidad_id`);

--
-- Indices de la tabla `inmueble_atributos`
--
ALTER TABLE `inmueble_atributos`
  ADD PRIMARY KEY (`inmueble_id`,`atributo_id`),
  ADD KEY `atributo_id` (`atributo_id`);

--
-- Indices de la tabla `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estudiante_id` (`estudiante_id`),
  ADD KEY `inmueble_id` (`inmueble_id`);

--
-- Indices de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_solicitud` (`estudiante_id`,`inmueble_id`),
  ADD KEY `inmueble_id` (`inmueble_id`);

--
-- Indices de la tabla `universidades`
--
ALTER TABLE `universidades`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `universidad_id` (`universidad_id`);

--
-- Indices de la tabla `usuario_atributos`
--
ALTER TABLE `usuario_atributos`
  ADD PRIMARY KEY (`usuario_id`,`atributo_id`),
  ADD KEY `atributo_id` (`atributo_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `atributos`
--
ALTER TABLE `atributos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `carreras`
--
ALTER TABLE `carreras`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `inmuebles`
--
ALTER TABLE `inmuebles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `matches`
--
ALTER TABLE `matches`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT de la tabla `universidades`
--
ALTER TABLE `universidades`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `inmuebles`
--
ALTER TABLE `inmuebles`
  ADD CONSTRAINT `inmuebles_ibfk_1` FOREIGN KEY (`propietario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `inmuebles_ibfk_2` FOREIGN KEY (`universidad_id`) REFERENCES `universidades` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `inmueble_atributos`
--
ALTER TABLE `inmueble_atributos`
  ADD CONSTRAINT `inmueble_atributos_ibfk_1` FOREIGN KEY (`inmueble_id`) REFERENCES `inmuebles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `inmueble_atributos_ibfk_2` FOREIGN KEY (`atributo_id`) REFERENCES `atributos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `matches`
--
ALTER TABLE `matches`
  ADD CONSTRAINT `matches_ibfk_1` FOREIGN KEY (`estudiante_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `matches_ibfk_2` FOREIGN KEY (`inmueble_id`) REFERENCES `inmuebles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD CONSTRAINT `solicitudes_ibfk_1` FOREIGN KEY (`estudiante_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `solicitudes_ibfk_2` FOREIGN KEY (`inmueble_id`) REFERENCES `inmuebles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`universidad_id`) REFERENCES `universidades` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `usuario_atributos`
--
ALTER TABLE `usuario_atributos`
  ADD CONSTRAINT `usuario_atributos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `usuario_atributos_ibfk_2` FOREIGN KEY (`atributo_id`) REFERENCES `atributos` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
