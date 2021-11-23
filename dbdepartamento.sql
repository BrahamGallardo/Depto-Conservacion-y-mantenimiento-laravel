-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-11-2021 a las 17:19:48
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbdepartamento`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE `areas` (
  `idarea` int(11) NOT NULL,
  `area` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`idarea`, `area`) VALUES
(1, 'Administrativa'),
(2, 'Operativa'),
(3, 'General');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_trabajador`
--

CREATE TABLE `estados_trabajador` (
  `idestado_trabajador` int(11) NOT NULL,
  `estado_trabajador` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estados_trabajador`
--

INSERT INTO `estados_trabajador` (`idestado_trabajador`, `estado_trabajador`) VALUES
(1, 'Activo'),
(2, 'Con permiso'),
(3, 'En comisión'),
(4, 'De vacaciones'),
(5, 'Inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `idhorario` int(11) NOT NULL,
  `hora_entrada` time DEFAULT NULL,
  `hora_salida` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`idhorario`, `hora_entrada`, `hora_salida`) VALUES
(1, '08:00:00', '13:30:00'),
(2, '08:00:00', '14:00:00'),
(3, '08:00:00', '15:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `idrol` int(11) NOT NULL,
  `nombre_rol` varchar(45) DEFAULT NULL,
  `idarea` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`idrol`, `nombre_rol`, `idarea`) VALUES
(1, 'Jefe1', 1),
(2, 'Jefe2', 2),
(3, 'Secretaria', 1),
(4, 'Técnico ', 2),
(5, 'Supervisor', 1),
(6, 'Administrador', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_trabajador`
--

CREATE TABLE `tipos_trabajador` (
  `idtipo_trabajador` int(11) NOT NULL,
  `tipo_trabajador` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipos_trabajador`
--

INSERT INTO `tipos_trabajador` (`idtipo_trabajador`, `tipo_trabajador`) VALUES
(1, 'Base'),
(2, 'Regular'),
(3, 'Formalizado'),
(4, 'Eventual');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajadores`
--

CREATE TABLE `trabajadores` (
  `idtrabajador` int(11) NOT NULL,
  `nombre_trabajador` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `idtipo_trabajador` int(11) NOT NULL,
  `idrol` int(11) NOT NULL,
  `idestado` int(11) NOT NULL,
  `idhorario` int(11) NOT NULL,
  `nombre_de_usuario` varchar(15) DEFAULT NULL,
  `contrasena` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `trabajadores`
--

INSERT INTO `trabajadores` (`idtrabajador`, `nombre_trabajador`, `email`, `telefono`, `idtipo_trabajador`, `idrol`, `idestado`, `idhorario`, `nombre_de_usuario`, `contrasena`) VALUES
(1, 'Abraham Cruz Gallardo', 'braham.gc@gmail.com', '9511200448', 4, 6, 1, 1, 'Brahm', 'Gallardo.01'),
(2, 'Manuel Manuel Mitchel', 'manuel@gmail.com', '9511471580', 4, 6, 1, 1, NULL, NULL),
(3, 'prueba', 'notiene@gmail.com', '9511234567', 4, 4, 5, 3, NULL, NULL),
(4, 'Prueba2', 'qwert@gmail.com', '111111234567', 2, 5, 5, 2, NULL, NULL),
(5, 'argbdg', 'abfd@asdf.com', 'argbdg', 2, 3, 5, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Abraham Gallardo', 'abraham@gmail.com', '$2y$10$Vt433.DGj/LOiqV8zsgtKeN58NgeMEIk3U3FoUlzChVAM2x/.K.MS', 'vLrcqMak7y0aap0gkNZkiFkSxnUU07cdm6A5R6toGye8n6gHbR5XNieRfcIr', '2021-11-08 04:39:45', '2021-11-11 20:18:14'),
(2, 'Mitchel Manuel Alonso', 'manuel@hotmail.com', '$2y$10$fSwcu0EOAyAgfDj.Mz2BqOnb./842Isd2VYuDPfSrJ7enOgu2eZc.', 'CFFsZF46qF323J3DKJbAIJsWthjkNXvhkoqlroQNBKRuubegZv4SZpQUsr6T', '2021-11-08 09:13:44', '2021-11-09 00:43:03'),
(3, 'Admin', 'admin@admin.com', '$2y$10$T.DYsIWUpmQCj.ECJIsE2Oi9o8dNa4RkIT/O5hklMST/F1fcrRRim', NULL, '2021-11-09 00:43:56', '2021-11-09 00:43:56');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`idarea`);

--
-- Indices de la tabla `estados_trabajador`
--
ALTER TABLE `estados_trabajador`
  ADD PRIMARY KEY (`idestado_trabajador`);

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`idhorario`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`idrol`),
  ADD KEY `fk_rol_area_idx` (`idarea`);

--
-- Indices de la tabla `tipos_trabajador`
--
ALTER TABLE `tipos_trabajador`
  ADD PRIMARY KEY (`idtipo_trabajador`);

--
-- Indices de la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
  ADD PRIMARY KEY (`idtrabajador`),
  ADD KEY `fk_trabajador_tipo_idx` (`idtipo_trabajador`),
  ADD KEY `fk_trabajador_rol_idx` (`idrol`),
  ADD KEY `fk_trabajador_estado_idx` (`idestado`),
  ADD KEY `fk_trabajador_horario_idx` (`idhorario`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
  MODIFY `idarea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `estados_trabajador`
--
ALTER TABLE `estados_trabajador`
  MODIFY `idestado_trabajador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `idhorario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `idrol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tipos_trabajador`
--
ALTER TABLE `tipos_trabajador`
  MODIFY `idtipo_trabajador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
  MODIFY `idtrabajador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `fk_rol_area` FOREIGN KEY (`idarea`) REFERENCES `areas` (`idarea`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
  ADD CONSTRAINT `fk_trabajador_estado` FOREIGN KEY (`idestado`) REFERENCES `estados_trabajador` (`idestado_trabajador`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_trabajador_horario` FOREIGN KEY (`idhorario`) REFERENCES `horarios` (`idhorario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_trabajador_rol` FOREIGN KEY (`idrol`) REFERENCES `roles` (`idrol`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_trabajador_tipo` FOREIGN KEY (`idtipo_trabajador`) REFERENCES `tipos_trabajador` (`idtipo_trabajador`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
