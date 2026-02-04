-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 04-02-2026 a las 12:32:09
-- Versión del servidor: 8.0.43-0ubuntu0.24.04.2
-- Versión de PHP: 8.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `univibe`
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
  `nombre` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
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
  `precio` decimal(10,2) DEFAULT NULL,
  `imagen_principal` varchar(255) DEFAULT NULL,
  `propietario_id` int DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `universidad_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `inmuebles`
--

INSERT INTO `inmuebles` (`id`, `titulo`, `descripcion`, `direccion`, `precio`, `imagen_principal`, `propietario_id`, `created_at`, `universidad_id`) VALUES
(1, 'Piso Virgen en el Centro', 'Piso recién reformado, listo para entrar.', NULL, 450.00, NULL, 3, '2026-01-25 17:44:30', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inmueble_atributos`
--

CREATE TABLE `inmueble_atributos` (
  `inmueble_id` int NOT NULL,
  `atributo_id` int NOT NULL,
  `valor_vibe` decimal(3,2) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matches`
--

CREATE TABLE `matches` (
  `id` int NOT NULL,
  `estudiante_id` int DEFAULT NULL,
  `inmueble_id` int DEFAULT NULL,
  `estado` enum('pendiente','aceptado','rechazado') DEFAULT 'pendiente',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes`
--

CREATE TABLE `solicitudes` (
  `id` int NOT NULL,
  `estudiante_id` int DEFAULT NULL,
  `inmueble_id` int DEFAULT NULL,
  `estado` enum('interesado','aceptado','rechazado') DEFAULT 'interesado',
  `mensaje_presentacion` text,
  `fecha_solicitud` datetime DEFAULT CURRENT_TIMESTAMP,
  `fecha_respuesta` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `descripcion` varchar(255) NOT NULL,
  `id_carrera` int DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `rol` enum('admin','estudiante','propietario') DEFAULT 'estudiante',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `universidad_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `descripcion`, `id_carrera`, `password`, `rol`, `created_at`, `universidad_id`) VALUES
(1, 'Admin UniVibe', 'admin@univibe.com', '', NULL, '1234', 'admin', '2026-01-25 17:44:30', NULL),
(2, 'Javi Estudiante', 'javi@gmail.com', '', NULL, '1234', 'estudiante', '2026-01-25 17:44:30', NULL),
(3, 'Pedro Propietario', 'pedro@p pisos.com', '', NULL, '1234', 'propietario', '2026-01-25 17:44:30', NULL),
(6, 'Jorge Gómez Garcia', 'jgg2232004@gmail.com', '', NULL, '$2y$12$1sVsQyMSyw4YqxSAA7F0NON6yVWh28iB3Jpi5l8zrLIW..pI5/uHK', 'estudiante', '2026-02-03 11:52:58', NULL),
(7, 'Pepe', 'pepe@gmail.com', '', NULL, '$2y$12$xylzez4pzCu8HtOzahvfWuE0kguCgxZv7OBRxY3vf2VDPfoSP026a', 'propietario', '2026-02-04 13:03:08', NULL),
(8, 'paco', 'paco@gmail.com', '', NULL, '$2y$12$zydrfW6SvE5/8PvC3pwGNeS1z.GGgk1O9NSwJi1T4T3G6jFtuQ4eC', 'estudiante', '2026-02-04 13:03:51', NULL);

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
(6, 2),
(8, 2),
(8, 3),
(8, 4),
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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `matches`
--
ALTER TABLE `matches`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `universidades`
--
ALTER TABLE `universidades`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
