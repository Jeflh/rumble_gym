-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-11-2022 a las 04:48:00
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `rumble_gym`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencias`
--

CREATE TABLE `asistencias` (
  `id_usuario` int(11) NOT NULL,
  `fecha_asistencia` date NOT NULL,
  `estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `asistencias`
--

INSERT INTO `asistencias` (`id_usuario`, `fecha_asistencia`, `estado`) VALUES
(95753, '2022-11-01', 1),
(95753, '2022-11-02', 1),
(95753, '2022-11-03', 1),
(95753, '2022-11-04', 1),
(95753, '2022-11-05', 1),
(95753, '2022-11-06', 1),
(95753, '2022-11-07', 1),
(95753, '2022-11-08', 0),
(95753, '2022-11-09', 1),
(95753, '2022-11-10', 0),
(95753, '2022-11-11', 0),
(95753, '2022-11-12', 1),
(95753, '2022-11-13', 1),
(95753, '2022-11-14', 0),
(95753, '2022-11-15', 1),
(95753, '2022-11-16', 1),
(95753, '2022-11-17', 1),
(95753, '2022-11-18', 1),
(95753, '2022-11-19', 1),
(95753, '2022-11-20', 0),
(95753, '2022-11-21', 1),
(95753, '2022-11-22', 1),
(82905, '2022-11-01', 0),
(82905, '2022-11-02', 0),
(82905, '2022-11-03', 1),
(82905, '2022-11-04', 1),
(82905, '2022-11-05', 0),
(82905, '2022-11-06', 1),
(82905, '2022-11-07', 1),
(82905, '2022-11-08', 1),
(82905, '2022-11-09', 1),
(82905, '2022-11-10', 1),
(82905, '2022-11-11', 1),
(82905, '2022-11-12', 1),
(82905, '2022-11-13', 1),
(82905, '2022-11-14', 1),
(82905, '2022-11-15', 1),
(82905, '2022-11-16', 1),
(82905, '2022-11-17', 1),
(82905, '2022-11-18', 1),
(82905, '2022-11-19', 1),
(82905, '2022-11-20', 1),
(82905, '2022-11-21', 1),
(82905, '2022-11-22', 1),
(74194, '2022-11-01', 0),
(74194, '2022-11-02', 0),
(74194, '2022-11-03', 0),
(74194, '2022-11-04', 1),
(74194, '2022-11-05', 0),
(74194, '2022-11-06', 1),
(74194, '2022-11-07', 1),
(74194, '2022-11-08', 1),
(74194, '2022-11-09', 0),
(74194, '2022-11-10', 1),
(74194, '2022-11-11', 1),
(74194, '2022-11-12', 1),
(74194, '2022-11-13', 1),
(74194, '2022-11-14', 1),
(74194, '2022-11-15', 0),
(74194, '2022-11-16', 1),
(74194, '2022-11-17', 1),
(74194, '2022-11-18', 1),
(74194, '2022-11-19', 1),
(74194, '2022-11-20', 1),
(74194, '2022-11-21', 1),
(74194, '2022-11-22', 1),
(12345, '2022-11-01', 1),
(12345, '2022-11-02', 1),
(12345, '2022-11-03', 1),
(12345, '2022-11-04', 1),
(12345, '2022-11-05', 0),
(12345, '2022-11-06', 1),
(12345, '2022-11-07', 1),
(12345, '2022-11-08', 1),
(12345, '2022-11-09', 0),
(12345, '2022-11-10', 1),
(12345, '2022-11-11', 1),
(12345, '2022-11-12', 1),
(12345, '2022-11-13', 1),
(12345, '2022-11-14', 0),
(12345, '2022-11-15', 0),
(12345, '2022-11-16', 1),
(12345, '2022-11-17', 1),
(12345, '2022-11-18', 1),
(12345, '2022-11-19', 0),
(12345, '2022-11-20', 1),
(12345, '2022-11-21', 1),
(12345, '2022-11-22', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido_paterno` varchar(45) NOT NULL,
  `apellido_materno` varchar(45) NOT NULL,
  `sexo` varchar(1) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `peso` float NOT NULL,
  `altura` float NOT NULL,
  `imc` float NOT NULL,
  `domicilio` varchar(150) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `estado` tinyint(4) NOT NULL,
  `tipo_suscripcion` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre`, `apellido_paterno`, `apellido_materno`, `sexo`, `fecha_nacimiento`, `peso`, `altura`, `imc`, `domicilio`, `telefono`, `estado`, `tipo_suscripcion`, `fecha_inicio`, `fecha_fin`) VALUES
(12345, 'Juan Emmanuel', 'Fernández', 'de Lara', 'M', '2000-02-21', 90, 1.89, 25.2, 'Gaspar Antonio', '3320582950', 1, 1, '2022-11-01', '2022-12-01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id_empleado` int(11) NOT NULL,
  `password` varchar(60) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido_p` varchar(45) NOT NULL,
  `apellido_m` varchar(45) NOT NULL,
  `fecha_nac` varchar(45) NOT NULL,
  `domicilio` varchar(150) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id_empleado`, `password`, `nombre`, `apellido_p`, `apellido_m`, `fecha_nac`, `domicilio`, `telefono`, `tipo`) VALUES
(11111, '$2y$10$SW0WJLpTzSgc2KUg64M/m.G7w4jkO4V4EtXMb4ID22tpjwQgoxmM6', 'José Raúl', 'David', 'Corona', '2004-11-11', 'Su casa', '1231231231', 1),
(12345, '$2y$10$6GplZn49y0DqpsJM/4VwrO81ojcUUYXlxnlUrGOznfrtr.KrnL6Om', 'Juan Emmanuel', 'Fernández', 'de Lara', '2000-02-21', 'Gaspar Antonio', '3320582950', 1),
(99999, '$2y$10$v3Wt6Ln90znN49JFZweYVOJlYDUMsScRJQHIudMJKPq72BQyk/6dq', 'Juan José', 'Salazar', 'Villegas', '1995-05-04', 'Si', '1231231231', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre`, `descripcion`, `cantidad`, `precio`) VALUES
(15100, 'Faja ', 'Calidad de curo de acapotzalco', 5, 295),
(15102, 'Esteroides Legales', 'Marca Mash-Mey 180 capsulas.', 15103, 449),
(15104, 'Bote plastico', 'Bote con medicion avalada por asociación metrica.', 15, 210),
(15105, 'Toalla Fraydey', 'Tamaño pequeño para limpiar sudor de su carita uwu.', 20, 99.99),
(15106, 'Vitamina B', 'Vitamina para vitaminarte.', 22, 249),
(15107, 'Kit Mallas y Guantes', 'Malla deportiva talla Ajustable y gauntes.', 5, 350),
(15990, 'Botella de agua', 'Botella Epurita de 500mlts.', 15, 17),
(15991, 'Gatorade Ponche', 'Sabor Limón de 1L', 20, 25),
(15992, 'Bebida energética Amper', 'Bebida carbonatada adicionada con cafeína ', 50, 17),
(15993, 'Proteína Whey', 'Protenia sabor platano macho 500gr.', 15, 350),
(15994, 'Carnitina', 'Marca esencial 1200gr.', 50, 299),
(15995, 'Creatinina', 'Marca Power 350gr.', 6, 320),
(15996, 'Cafeina', 'Marca Gat-sports 100gm.', 10, 330),
(15997, 'Glutenamina', 'Marca ForzaGen 330gr.', 10, 480),
(15998, 'Aminoacidos', 'Marca ForzaGen 360gr.', 20, 439),
(15999, 'Proteina PRO', 'Marca ForzaGen 2900gr.', 6, 1375);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido_p` varchar(45) NOT NULL,
  `apellido_m` varchar(45) NOT NULL,
  `sexo` varchar(1) NOT NULL,
  `fecha_nac` date NOT NULL,
  `peso` float NOT NULL,
  `altura` float NOT NULL,
  `imc` float NOT NULL,
  `domicilio` varchar(150) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `estado` tinyint(4) NOT NULL,
  `tipo_suscripcion` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellido_p`, `apellido_m`, `sexo`, `fecha_nac`, `peso`, `altura`, `imc`, `domicilio`, `telefono`, `estado`, `tipo_suscripcion`, `fecha_inicio`, `fecha_fin`) VALUES
(12345, 'Juan Emmanuel', 'Fernández', 'de Lara', 'M', '2000-02-21', 90, 1.89, 25.2, 'Gaspar Antonio 42', '3324282110', 1, 1, '2022-11-23', '2022-12-23'),
(74194, 'Lachin', 'Berenice', 'Valeria', 'F', '2001-02-08', 67, 1.67, 24.0238, 'Allá con el chente', '3366998877', 1, 3, '2022-11-23', '2023-02-23'),
(82905, 'Josue Daniel', 'Rodriguez', 'Lozano', 'M', '1985-01-01', 123, 1.8, 37.963, 'Av. Aztlan 153', '1231231231', 1, 4, '2022-11-23', '2023-11-23'),
(95753, 'Diego', 'Montoya', 'Mariscal', 'M', '2010-11-03', 75, 1.72, 25.3515, 'La paz 1368', '3347811969', 1, 2, '2022-11-23', '2023-02-23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_venta` int(11) NOT NULL,
  `fecha_venta` date NOT NULL,
  `monto_venta` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asistencias`
--
ALTER TABLE `asistencias`
  ADD KEY `id_cliente_idx` (`id_usuario`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id_empleado`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_venta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asistencias`
--
ALTER TABLE `asistencias`
  ADD CONSTRAINT `id_cliente` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
