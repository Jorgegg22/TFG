-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Servidor: db:3306
-- Tiempo de generación: 08-02-2026 a las 19:08:06
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
  `icono` varchar(50) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `atributos`
--

INSERT INTO `atributos` (`id`, `nombre`, `icono`, `color`) VALUES
(1, 'Fiesta', 'local_bar', NULL),
(2, 'Limpieza', 'cleaning_services', NULL),
(3, 'Estudio', 'menu_book', NULL),
(4, 'Mascotas', 'pets', NULL),
(5, 'Musica', 'music_note_2', NULL);

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
(19, 'Grado en Matemáticas'),
(20, 'Grado en Química');

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

INSERT INTO `inmuebles` (`id`, `titulo`, `descripcion`, `direccion`, `precio`, `imagen_principal`, `propietario_id`, `created_at`, `universidad_id`, `metros`, `habitaciones`, `banios`, `n_personas`) VALUES
(1, 'Piso Virgen en el Centro', 'Piso recién reformado, listo para entrar.', 'Calle prueba', 450, NULL, 3, '2026-01-25 17:44:30', 1, 0, 0, 0, 0),
(2, 'Estudio moderno cerca del Campus', 'Ideal para estudiantes de ciencias, todo equipado y silencioso.', 'Calle Einstein 4', 350, NULL, 3, '2026-02-04 18:19:54', 1, 100, 4, 2, 4),
(3, 'Piso compartido con terraza', 'Buscamos gente tranquila, ambiente de estudio. Salón muy amplio.', 'Av. Madrid 12', 280, NULL, 3, '2026-02-04 18:19:54', 1, 0, 0, 0, 0),
(4, 'Habitación grande y luminosa', 'Cama doble y escritorio grande. Gastos de luz y agua incluidos.', 'Calle Recogidas 22', 400, NULL, 3, '2026-02-04 18:19:54', 1, 0, 0, 0, 0),
(5, 'Loft céntrico de diseño', 'Para quien busca privacidad y estilo. Aire acondicionado nuevo.', 'Plaza Nueva 5', 600, NULL, 3, '2026-02-04 18:19:54', 1, 0, 0, 0, 0),
(6, 'Piso económico cerca del metro', 'A 5 minutos de la parada. 3 habitaciones disponibles.', 'Camino de Ronda 100', 250, NULL, 3, '2026-02-04 18:19:54', 1, 0, 0, 0, 0),
(7, 'Apartamento luminoso cerca de Derecho', 'Piso exterior con dos balcones, muy tranquilo para estudiar.', 'Calle Rector López Argüeta 5', 550, NULL, 3, '2026-02-05 16:18:34', 1, 0, 0, 0, 0),
(8, 'Ático con terraza zona Campus', 'Espectacular ático con vistas. Ideal para compartir entre 3 personas.', 'Av. de Fuente Nueva 12', 850, NULL, 7, '2026-02-05 16:18:34', 1, 0, 0, 0, 0),
(9, 'Estudio acogedor en el casco antiguo', 'Pequeño pero con encanto, ideal para una sola persona.', 'Cuesta del Chapiz 22', 400, NULL, 3, '2026-02-05 16:18:34', 1, 0, 0, 0, 0),
(10, 'Piso grande para 4 estudiantes', '4 habitaciones espaciosas, dos baños completos y cocina equipada.', 'Calle Pedro Antonio de Alarcón 45', 900, NULL, 7, '2026-02-05 16:18:34', 1, 0, 0, 0, 0),
(11, 'Habitación en piso compartido reformado', 'Ambiente internacional, buscamos gente sociable.', 'Camino de Ronda 150', 300, NULL, 3, '2026-02-05 16:18:34', 1, 0, 0, 0, 0),
(12, 'Bajo con patio privado', 'Zona muy tranquila, permite mascotas.', 'Calle Arabial 88', 600, NULL, 7, '2026-02-05 16:18:34', 1, 0, 0, 0, 0),
(13, 'Loft moderno zona Cartuja', 'Estilo industrial, todo diáfano. Aire acondicionado.', 'Paseo de Cartuja 10', 520, NULL, 3, '2026-02-05 16:18:34', 1, 0, 0, 0, 0),
(14, 'Piso económico cerca de Medicina', 'Básico pero funcional, a 5 minutos de la facultad.', 'Av. de la Ilustración 2', 480, NULL, 7, '2026-02-05 16:18:34', 1, 0, 0, 0, 0);

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
(2, 3),
(3, 3),
(4, 3),
(7, 3),
(5, 4),
(6, 4),
(8, 4),
(10, 4),
(11, 4),
(12, 4),
(13, 4);

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
(1, 10, 2, '2026-02-04 18:06:12'),
(2, 9, 2, '2026-02-04 18:13:57');

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
(71, 10, 11, 'interesado', '2026-02-08 11:14:31'),
(72, 10, 6, 'interesado', '2026-02-08 11:14:32'),
(73, 10, 5, 'interesado', '2026-02-08 11:58:07'),
(74, 10, 12, 'interesado', '2026-02-08 12:04:11'),
(89, 16, 3, 'interesado', '2026-02-08 13:11:20');

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
  `token` varchar(255) NOT NULL,
  `token_expira` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `telefono`, `descripcion`, `id_carrera`, `password`, `rol`, `foto_perfil`, `created_at`, `universidad_id`, `link_instagram`, `link_spotify`, `link_x`, `token`, `token_expira`) VALUES
(1, 'Admin UniVibe', 'admin@univibe.com', '123213', 'asdasddsa', 1, '$2y$12$1sVsQyMSyw4YqxSAA7F0NON6yVWh28iB3Jpi5l8zrLIW..pI5/uHK', 'admin', NULL, '2026-01-25 17:44:30', 1, '', '', '', '09c72a51cc9dacf61c48fb5d3c8bd4fb3e6515926017b1c4e99965de082c5ec8', '2026-02-08'),
(2, 'Javi Estudiante', 'javi@gmail.com', NULL, '', NULL, '1234', 'estudiante', NULL, '2026-01-25 17:44:30', NULL, '', '', '', '', NULL),
(3, 'Pedro Propietario', 'pedro@p pisos.com', NULL, '', NULL, '1234', 'propietario', NULL, '2026-01-25 17:44:30', NULL, '', '', '', '', NULL),
(6, 'Jorge Gómez Garcia', 'jgg2232004@gmail.com', NULL, '', NULL, '$2y$12$1sVsQyMSyw4YqxSAA7F0NON6yVWh28iB3Jpi5l8zrLIW..pI5/uHK', 'estudiante', NULL, '2026-02-03 11:52:58', NULL, '', '', '', '', NULL),
(7, 'Pepe', 'pepe@gmail.com', NULL, '', NULL, '$2y$12$xylzez4pzCu8HtOzahvfWuE0kguCgxZv7OBRxY3vf2VDPfoSP026a', 'propietario', NULL, '2026-02-04 13:03:08', NULL, '', '', '', '', NULL),
(8, 'paco', 'paco@gmail.com', NULL, '', NULL, '$2y$12$zydrfW6SvE5/8PvC3pwGNeS1z.GGgk1O9NSwJi1T4T3G6jFtuQ4eC', 'estudiante', NULL, '2026-02-04 13:03:51', NULL, '', '', '', '', NULL),
(9, 'Silvia', 'silvia@gmail.com', NULL, 'asdasadsadsdsasdsdsdasdasdadad', NULL, '$2y$10$P7vOZs9egODV0A.8thBc3uUhdxKCEeQzI4Hckd852Yi4O3P5k9Mdu', 'estudiante', NULL, '2026-02-04 16:23:17', NULL, '', '', '', '', NULL),
(10, 'Jorge', 'jorge@gmail.com', '640812573', '\"Macarena es mi mejor amiga, tiene el pelo largo, castaño y abundante. Suele llevarlo deshecho y con flequillo. Siempre está morena y, aunque no se maquilla, destaca por sus ojos delineados en negro. Es una persona muy inteligente, empática y generosa\". ', 1, '$2y$10$qVhrai1RwsafBawMwXnEoeeHy1HgNsTHe5qXZJYS.lFsPL8M.hDUy', 'estudiante', 'foto_jorge', '2026-02-04 16:40:34', 1, '', '', '', 'a1da9e88b1eb490768dc814ad4740c4486c93471dca8cbdf4db6d41c0b86107c', '2026-02-08'),
(11, 'ejemplo', 'ejemplo@gmail.com', '12321331', 'qwdasdsad', 2, '$2y$10$8Zuqv/7mzOyXVg/a9nNKv.W2IA.nmivHE3U5BWe6Jsk0jAfkbxgey', 'estudiante', NULL, '2026-02-06 22:13:51', 1, '', '', '', '', NULL),
(15, 'Majo Mira Hernandez', 'majo@gmail.com', '640812573', 'Hola,me llamo maria jose,me gusta la musica de coldplay', 2, '$2y$10$dZQ5KNYZjAFYCANIBcFRJ.qMC19jgU1OyuK5HJNEFc10/HAx5mQCO', 'estudiante', NULL, '2026-02-08 12:53:32', 2, '', '', '', '4dfb0a46cb30f78f3f07e8664921d2d3b423b0ed9968062c358d4760d6163fe2', '2026-02-08'),
(16, 'pepe gomez', 'pepegomez@gmail.com', '1234567', 'asdasdddad', 1, '$2y$10$VtOa8d5aAvJ0o/LTOcwUXONH/c6W/GjRBE1BcgQ3EGOzu.D2jf3l.', 'estudiante', NULL, '2026-02-08 12:56:08', 4, '', '', '', '2b742a0e1dc079b818f48115d553a9b7a756abc35dab6362cc969f9def6c10bb', '2026-02-08');

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
(6, 1),
(8, 1),
(11, 1),
(6, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(15, 2),
(16, 2),
(8, 3),
(10, 3),
(11, 3),
(15, 3),
(16, 3),
(8, 4),
(10, 4),
(11, 4),
(8, 5),
(9, 5),
(11, 5),
(15, 5);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `matches`
--
ALTER TABLE `matches`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT de la tabla `universidades`
--
ALTER TABLE `universidades`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
