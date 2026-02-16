-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 16-02-2026 a las 01:52:50
-- Versión del servidor: 11.4.8-MariaDB-ubu2404
-- Versión de PHP: 8.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `jorgegomez_univibe`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atributos`
--

CREATE TABLE `atributos` (
  `id` int(11) NOT NULL,
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
(5, 'Musica', 'music_note_2'),
(6, 'Cocina', 'cooking'),
(7, 'Orden', 'inventory_2'),
(8, 'Visitas', 'group');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carreras`
--

CREATE TABLE `carreras` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
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
(21, 'Grado en Historia'),
(22, 'Grado en Biología'),
(23, 'Grado en Física'),
(24, 'Grado en Química'),
(25, 'Grado en Ingeniería de Telecomunicaciones'),
(26, 'Grado en Criminología'),
(27, 'Grado en Relaciones Internacionales'),
(28, 'Grado en Comunicación Audiovisual'),
(29, 'Grado en Traducción e Interpretación'),
(30, 'Grado en Publicidad y Relaciones Públicas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inmuebles`
--

CREATE TABLE `inmuebles` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `precio` int(11) DEFAULT NULL,
  `imagen_principal` varchar(255) DEFAULT NULL,
  `imagen1` varchar(255) DEFAULT NULL,
  `imagen2` varchar(255) DEFAULT NULL,
  `imagen3` varchar(255) DEFAULT NULL,
  `imagen4` varchar(255) DEFAULT NULL,
  `propietario_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `universidad_id` int(11) DEFAULT NULL,
  `metros` int(11) NOT NULL,
  `habitaciones` int(11) NOT NULL,
  `banios` int(11) NOT NULL,
  `n_personas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `inmuebles`
--

INSERT INTO `inmuebles` (`id`, `titulo`, `descripcion`, `direccion`, `precio`, `imagen_principal`, `imagen1`, `imagen2`, `imagen3`, `imagen4`, `propietario_id`, `created_at`, `universidad_id`, `metros`, `habitaciones`, `banios`, `n_personas`) VALUES
(28, 'Piso luminoso cerca de Renfe', 'Apartamento ideal para compartir, con mucha luz natural y mobiliario funcional.', 'Calle de la Princesa 22, Madrid', 950, 'imagen (1).avif', 'imagen (2).avif', 'imagen (3).avif', 'imagen (4).avif', 'imagen (5).avif', 38, '2026-02-16 01:06:13', 1, 85, 3, 1, 3),
(29, 'Estudio coqueto en el centro', 'Perfecto para una persona. Recién reformado y con aire acondicionado.', 'Calle Sierpes 10, Sevilla', 550, 'imagen (1).webp', 'imagen (2).webp', 'imagen (3).webp', 'imagen (4).webp', 'imagen (5).webp', 38, '2026-02-16 01:06:13', 2, 40, 1, 1, 1),
(30, 'Piso amplio para estudiantes', 'Cinco dormitorios equipados con escritorio. Gastos de comunidad incluidos.', 'Gran Via de les Corts Catalanes 585, Barcelona', 1800, 'imagen (6).webp', 'imagen (7).webp', 'imagen (6).avif', 'imagen (7).avif', 'imagen (8).avif', 38, '2026-02-16 01:06:13', 1, 120, 5, 2, 5),
(31, 'Apartamento vistas al Turia', 'Vistas espectaculares al parque. Zona tranquila y bien comunicada.', 'Calle de la Paz 4, Valencia', 800, 'imagen (9).avif', 'imagen (10).avif', 'imagen (11).avif', 'imagen (12).avif', 'imagen (13).avif', 38, '2026-02-16 01:06:13', 2, 70, 2, 1, 2),
(32, 'Bajo con patio privado', 'Disfruta de un pequeño jardín en pleno centro. Cocina totalmente equipada.', 'Calle Recogidas 15, Granada', 650, 'imagen (14).avif', 'imagen (15).avif', 'imagen (16).avif', 'imagen (17).avif', 'imagen (18).avif', 38, '2026-02-16 01:06:13', 3, 90, 2, 1, 2),
(33, 'Ático con terraza circular', 'Espectacular ático cerca de la zona universitaria. Muy silencioso.', 'Avenida de la Buhaira 12, Sevilla', 1100, 'imagen (19).avif', 'imagen (8).webp', 'imagen (9).webp', 'imagen (10).webp', 'imagen (11).webp', 39, '2026-02-16 01:06:13', 2, 100, 3, 2, 3),
(34, 'Habitación en piso compartido', 'Piso reformado con ambiente joven. Todo exterior.', 'Calle San Vicente 33, Bilbao', 400, 'imagen (12).webp', 'imagen (13).webp', 'imagen (14).webp', 'imagen (15).webp', 'imagen (16).webp', 39, '2026-02-16 01:06:13', 1, 110, 4, 2, 4),
(35, 'Dúplex moderno en zona norte', 'Acabados de lujo y plaza de garaje incluida en el precio.', 'Calle de Arturo Soria 120, Madrid', 1400, 'imagen (17).webp', 'imagen (18).webp', 'imagen (19).webp', 'imagen (20).webp', 'imagen (21).webp', 39, '2026-02-16 01:06:13', 1, 130, 3, 2, 4),
(36, 'Piso reformado junto al campus', 'A 2 minutos andando de la facultad. Ideal para no usar coche.', 'Calle de San Quintín 5, Salamanca', 750, 'imagen (22).webp', 'imagen (23).webp', 'imagen (24).webp', 'imagen (25).webp', 'imagen (26).webp', 39, '2026-02-16 01:06:13', 3, 80, 3, 1, 3),
(37, 'Apartamento minimalista', 'Decoración nórdica y electrodomésticos de bajo consumo.', 'Paseo de Zorrilla 40, Valladolid', 600, 'imagen (27).webp', 'imagen (1).jpg', 'imagen (2).jpg', 'imagen (17).avif', 'imagen (16).avif', 39, '2026-02-16 01:06:13', 1, 55, 1, 1, 2),
(38, 'Casa tradicional restaurada', 'Suelos de madera y techos altos. Mucho encanto.', 'Calle San Fernando 2, Córdoba', 900, 'inm (23).avif', 'inm (1).avif', 'inm (2).avif', 'inm (3).avif', 'inm (4).avif', 40, '2026-02-16 01:06:13', 2, 140, 4, 2, 6),
(39, 'Estudio funcional y barato', 'Cerca de bibliotecas y zonas de estudio. Muy económico.', 'Calle de Benito Pérez Galdós 8, Santander', 450, 'inm (5).avif', 'inm (6).avif', 'inm (7).avif', 'inm (8).avif', 'inm (9).avif', 40, '2026-02-16 01:06:13', 1, 35, 1, 1, 1),
(40, 'Piso familiar en barrio tranquilo', 'Cerca de colegios y parques. Ideal para familias o grupos grandes.', 'Calle de Alcalá 200, Madrid', 1300, 'inm (10).avif', 'inm (11).avif', 'inm (12).avif', 'inm (13).avif', 'inm (14).avif', 40, '2026-02-16 01:06:13', 1, 115, 3, 2, 4),
(41, 'Loft cerca de la playa', 'Abierto y moderno. A 5 minutos del paseo marítimo.', 'Calle Larios 1, Málaga', 850, 'inm (15).avif', 'inm (16).avif', 'inm (17).avif', 'inm (18).avif', 'inm (19).avif', 40, '2026-02-16 01:06:13', 2, 65, 1, 1, 2),
(42, 'Piso con balcón a la catedral', 'Ubicación inmejorable en el casco histórico.', 'Rúa del Villar 12, Santiago de Compostela', 700, 'inm (20).avif', 'inm (21).avif', 'inm (22).avif', 'inm (9).avif', 'inm (8).avif', 40, '2026-02-16 01:06:13', 3, 85, 2, 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inmueble_atributos`
--

CREATE TABLE `inmueble_atributos` (
  `inmueble_id` int(11) NOT NULL,
  `atributo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matches`
--

CREATE TABLE `matches` (
  `id` int(11) NOT NULL,
  `estudiante_id` int(11) DEFAULT NULL,
  `inmueble_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes`
--

CREATE TABLE `solicitudes` (
  `id` int(11) NOT NULL,
  `estudiante_id` int(11) DEFAULT NULL,
  `inmueble_id` int(11) DEFAULT NULL,
  `estado` enum('interesado','aceptado','rechazado') DEFAULT 'interesado',
  `fecha_solicitud` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `solicitudes`
--

INSERT INTO `solicitudes` (`id`, `estudiante_id`, `inmueble_id`, `estado`, `fecha_solicitud`) VALUES
(155, 10, 30, 'interesado', '2026-02-16 01:51:58'),
(156, 10, 37, 'interesado', '2026-02-16 01:52:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `universidades`
--

CREATE TABLE `universidades` (
  `id` int(11) NOT NULL,
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
(4, 'Universidad de Barcelona', 'UB', 'Barcelona'),
(6, 'Universidad Autónoma de Madrid', 'UAM', 'Madrid'),
(7, 'Universidad Politécnica de Madrid', 'UPM', 'Madrid'),
(8, 'Universidad Rey Juan Carlos', 'URJC', 'Madrid'),
(9, 'Universidad Carlos III de Madrid', 'UC3M', 'Madrid'),
(10, 'Universidad Autónoma de Barcelona', 'UAB', 'Barcelona'),
(11, 'Universidad Politécnica de Cataluña', 'UPC', 'Barcelona'),
(12, 'Universidad Pompeu Fabra', 'UPF', 'Barcelona'),
(13, 'Universidad de Sevilla', 'US', 'Sevilla'),
(14, 'Universidad Pablo de Olavide', 'UPO', 'Sevilla'),
(15, 'Universidad de Granada', 'UGR', 'Granada'),
(16, 'Universidad de Málaga', 'UMA', 'Málaga'),
(17, 'Universidad de Córdoba', 'UCO', 'Córdoba'),
(18, 'Universidad de Cádiz', 'UCA', 'Cádiz'),
(19, 'Universidad de Alicante', 'UA', 'Alicante'),
(20, 'Universidad Miguel Hernández de Elche', 'UMH', 'Elche'),
(21, 'Universidad del País Vasco', 'UPV/EHU', 'Bilbao'),
(22, 'Universidad de Santiago de Compostela', 'USC', 'Santiago'),
(23, 'Universidad de Oviedo', 'UNIOVI', 'Oviedo'),
(24, 'Universidad de Zaragoza', 'UNIZAR', 'Zaragoza'),
(25, 'Universidad de Salamanca', 'USAL', 'Salamanca'),
(26, 'Universidad de Murcia', 'UMU', 'Murcia'),
(27, 'Universidad de Valladolid', 'UVA', 'Valladolid');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `id_carrera` int(11) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `rol` enum('admin','estudiante','propietario') DEFAULT 'estudiante',
  `foto_perfil` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `universidad_id` int(11) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `telefono`, `descripcion`, `id_carrera`, `password`, `rol`, `foto_perfil`, `created_at`, `universidad_id`, `token`) VALUES
(3, 'Pedro Propietario', 'pedro@p pisos.com', NULL, '', NULL, '1234', 'propietario', 'avatar_default.png', '2026-01-25 17:44:30', NULL, ''),
(7, 'Pepe', 'pepe@gmail.com', NULL, '', NULL, '$2y$12$xylzez4pzCu8HtOzahvfWuE0kguCgxZv7OBRxY3vf2VDPfoSP026a', 'propietario', 'avatar_default.png', '2026-02-04 13:03:08', NULL, '64cdc9a774932db1393d7626653493e380adeb2c5b121aed4f4612e5351fb9c7'),
(8, 'paco', 'paco@gmail.com', NULL, '', NULL, '$2y$12$zydrfW6SvE5/8PvC3pwGNeS1z.GGgk1O9NSwJi1T4T3G6jFtuQ4eC', 'estudiante', 'hoke.jpeg', '2026-02-04 13:03:51', NULL, ''),
(10, 'Jorge Gómez García', 'jorge@gmail.com', '640812573', ' pelo largo, castasdfdsf', 2, '$2y$10$qVhrai1RwsafBawMwXnEoeeHy1HgNsTHe5qXZJYS.lFsPL8M.hDUy', 'estudiante', '8713c257321614470f98.jpg', '2026-02-04 16:40:34', 1, '2248ffa063bab36af05f65d4a7c5c781f686550fd0433355f496e1b0a87ee8b2'),
(35, 'María José Mira Hernández ', 'arijo2003@gmail.com', '619873519', 'Me gusta pasar tiempo en familia y de calidad ', 2, '$2y$10$NqhWm1gTRj/iB3hjfQZnQe21/lzAg0cJDFPrcifvvlcwYvuu8Vx/K', 'estudiante', 'avatar_default.png', '2026-02-15 23:06:06', 2, '72b7800f5d46ca4ce3bdaf104df06db5d04bacdc3ad3321aa4b607c95fef33b1'),
(36, 'Admin', 'admin@univibe.com', NULL, NULL, NULL, '$2y$10$8xK9WX6WGyP1SpQxfUYBfe/rDLpiSMBhbxd1Y2155vE7iVoAAEEpS', 'admin', NULL, '2026-02-16 00:14:05', NULL, NULL),
(38, 'Carmen García', 'carmen.prop@example.com', '600111222', 'Propietaria con más de 10 años de experiencia alquilando a estudiantes en Madrid. Busco gente responsable y limpia.', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'propietario', 'propietario1.jpg', '2026-02-16 01:46:27', NULL, NULL),
(39, 'Javier Ruiz', 'javier.ruiz@example.com', '611222333', 'Arquitecto de profesión. Me encanta reformar pisos antiguos y darles un toque moderno y funcional para jóvenes.', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'propietario', 'propietario2.jpg', '2026-02-16 01:46:27', NULL, NULL),
(40, 'Elena Montes', 'elena.montes@example.com', '622333444', 'Ofrezco habitaciones en pisos compartidos con ambiente de estudio y respeto. Siempre disponible para cualquier avería.', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'propietario', 'propietario3.jpg', '2026-02-16 01:46:27', NULL, NULL),
(41, 'Ricardo Sanz', 'rsanz.inmuebles@example.com', '633444555', 'Gestiono varios lofts de diseño en zonas céntricas. Trato directo y sin comisiones de agencia.', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'propietario', 'propietario4.jpg', '2026-02-16 01:46:27', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_atributos`
--

CREATE TABLE `usuario_atributos` (
  `usuario_id` int(11) NOT NULL,
  `atributo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuario_atributos`
--

INSERT INTO `usuario_atributos` (`usuario_id`, `atributo_id`) VALUES
(8, 1),
(8, 2),
(10, 2),
(35, 2),
(8, 3),
(10, 3),
(35, 3),
(8, 4),
(10, 4),
(35, 4),
(8, 5),
(35, 6),
(35, 7),
(35, 8);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `carreras`
--
ALTER TABLE `carreras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `inmuebles`
--
ALTER TABLE `inmuebles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `matches`
--
ALTER TABLE `matches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT de la tabla `universidades`
--
ALTER TABLE `universidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

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
