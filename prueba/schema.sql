-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-09-2026 a las 16:24:11
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bolsa_trabajo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleos`
--

CREATE TABLE `empleos` (
  `id` int(11) NOT NULL,
  `puesto` varchar(150) NOT NULL,
  `empresa` varchar(120) NOT NULL,
  `ubicacion` varchar(100) NOT NULL,
  `tipo` enum('Empleo','Prácticas') DEFAULT 'Empleo',
  `fecha_publicacion` date NOT NULL,
  `fecha_limite` date NOT NULL,
  `whatsapp_url` varchar(255) NOT NULL,
  `activo` tinyint(1) DEFAULT 1,
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleos`
--

INSERT INTO `empleos` (`id`, `puesto`, `empresa`, `ubicacion`, `tipo`, `fecha_publicacion`, `fecha_limite`, `whatsapp_url`, `activo`, `creado_en`) VALUES
(1, 'Soporte Técnico de TI e Infraestructura', 'NetSecure Solutions S.A.C.', 'Junín (Perú)', 'Empleo', '2026-09-04', '2026-09-18', 'https://wa.me/51945896830?text=Hola,%20deseo%20postular%20a%20la%20vacante%20de%20Soporte%20T%C3%A9cnico%20de%20TI%20e%20Infraestructura%20en%20NetSecure%20Solutions%20S.A.C.', 1, '2026-09-06 20:39:23'),
(2, 'Administrador Junior de Plataformas Cloud', 'Andes Tech Services', 'Huancayo (Perú)', 'Empleo', '2026-09-02', '2026-09-15', 'https://wa.me/51945896830?text=Hola,%20deseo%20postular%20a%20la%20vacante%20de%20Administrador%20Junior%20de%20Plataformas%20Cloud%20en%20Andes%20Tech%20Services.', 1, '2026-09-06 20:39:23'),
(3, 'Técnico de Conectividad y Cableado Estructurado', 'DataCore Telecomunicaciones', 'Jauja (Perú)', 'Empleo', '2026-08-27', '2026-09-20', 'https://wa.me/51945896830?text=Hola,%20deseo%20postular%20a%20la%20vacante%20de%20T%C3%A9cnico%20de%20Conectividad%20y%20Cableado%20Estructurado%20en%20DataCore%20Telecomunicaciones.', 1, '2026-09-06 20:39:23'),
(4, 'Analista de Riesgos y Seguridad Digital Junior', 'Consultora Integras TI', 'Huancayo (Perú)', 'Prácticas', '2026-08-25', '2026-09-12', 'https://wa.me/51945896830?text=Hola,%20deseo%20postular%20a%20la%20vacante%20de%20Analista%20de%20Riesgos%20y%20Seguridad%20Digital%20Junior%20en%20Consultora%20Integras%20TI.', 1, '2026-09-06 20:39:23'),
(5, 'Especialista en Monitoreo y Servidores Linux', 'CloudMatrix Peru', 'Huancayo (Perú)', 'Empleo', '2026-09-05', '2026-09-22', 'https://wa.me/51945896830?text=Hola,%20deseo%20postular%20a%20la%20vacante%20de%20Especialista%20en%20Monitoreo%20y%20Servidores%20Linux%20en%20CloudMatrix%20Peru.', 1, '2026-09-06 20:39:23'),
(6, 'Practicante de Mantenimiento y Hardware TI', 'Grupo Tecnológico Central', 'Junín (Perú)', 'Prácticas', '2026-09-03', '2026-09-14', 'https://wa.me/51945896830?text=Hola,%20deseo%20postular%20a%20la%20vacante%20de%20Practicante%20de%20Mantenimiento%20y%20Hardware%20TI%20en%20Grupo%20Tecnol%C3%B3gico%20Central.', 1, '2026-09-06 20:39:23'),
(7, 'Asistente de Base de Datos SQL / PostgreSQL', 'Innova Systems Lab', 'Huancayo (Perú)', 'Empleo', '2026-09-01', '2026-09-25', 'https://wa.me/51945896830?text=Hola,%20deseo%20postular%20a%20la%20vacante%20de%20Asistente%20de%20Base%20de%20Datos%20SQL%20/%20PostgreSQL%20en%20Innova%20Systems%20Lab.', 1, '2026-09-06 20:39:23'),
(8, 'Técnico de Helpdesk y Microinformática', 'Servicios Digitales Arguedas', 'Jauja (Perú)', 'Empleo', '2026-08-31', '2026-09-10', 'https://wa.me/51945896830?text=Hola,%20deseo%20postular%20a%20la%20vacante%20de%20T%C3%A9cnico%20de%20Helpdesk%20y%20Microinform%C3%A1tica%20en%20Servicios%20Digitales%20Arguedas.', 1, '2026-09-06 20:39:23');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `empleos`
--
ALTER TABLE `empleos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `empleos`
--
ALTER TABLE `empleos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
