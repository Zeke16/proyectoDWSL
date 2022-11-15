-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-11-2022 a las 02:34:40
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_proyecto_dwsl`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbldepartamentos`
--

CREATE TABLE `tbldepartamentos` (
  `id_departamento` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `codigo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbldepartamentos`
--

INSERT INTO `tbldepartamentos` (`id_departamento`, `nombre`, `codigo`) VALUES
(1, 'AHUACHAPAN', 'AH'),
(2, 'SANTA ANA', 'SA'),
(3, 'SONSONATE', 'SO'),
(4, 'CHALATENANGO', 'CH'),
(5, 'LA LIBERTAD', 'LL'),
(6, 'SAN SALVADOR', 'SS'),
(7, 'CUSCATLAN', 'CU'),
(8, 'LA PAZ', 'LP'),
(9, 'CABAÑAS', 'CA'),
(10, 'SAN VICENTE', 'SV'),
(11, 'USULUTAN', 'US'),
(12, 'SAN MIGUEL', 'SM'),
(13, 'MORAZAN', 'MO'),
(14, 'LA UNION', 'LU');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblmunicipios`
--

CREATE TABLE `tblmunicipios` (
  `id_municipio` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `id_departamento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tblmunicipios`
--

INSERT INTO `tblmunicipios` (`id_municipio`, `nombre`, `id_departamento`) VALUES
(1, 'Ahuachapán', 1),
(2, 'Jujutla', 1),
(3, 'Atiquizaya', 1),
(4, 'Concepción de Ataco', 1),
(5, 'El Refugio', 1),
(6, 'Guaymango', 1),
(7, 'Apaneca', 1),
(8, 'San Francisco Menéndez', 1),
(9, 'San Lorenzo', 1),
(10, 'San Pedro Puxtla', 1),
(11, 'Tacuba', 1),
(12, 'Turín', 1),
(13, 'Candelaria de la Frontera', 2),
(14, 'Chalchuapa', 2),
(15, 'Coatepeque', 2),
(16, 'El Congo', 2),
(17, 'El Porvenir', 2),
(18, 'Masahuat', 2),
(19, 'Metapán', 2),
(20, 'San Antonio Pajonal', 2),
(21, 'San Sebastián Salitrillo', 2),
(22, 'Santa Ana', 2),
(23, 'Santa Rosa Guachipilín', 2),
(24, 'Santiago de la Frontera', 2),
(25, 'Texistepeque', 2),
(26, 'Acajutla', 3),
(27, 'Armenia', 3),
(28, 'Caluco', 3),
(29, 'Cuisnahuat', 3),
(30, 'Izalco', 3),
(31, 'Juayúa', 3),
(32, 'Nahuizalco', 3),
(33, 'Nahulingo', 3),
(34, 'Salcoatitán', 3),
(35, 'San Antonio del Monte', 3),
(36, 'San Julián', 3),
(37, 'Santa Catarina Masahuat', 3),
(38, 'Santa Isabel Ishuatán', 3),
(39, 'Santo Domingo de Guzmán', 3),
(40, 'Sonsonate', 3),
(41, 'Sonzacate', 3),
(42, 'Alegría', 11),
(43, 'Berlín', 11),
(44, 'California', 11),
(45, 'Concepción Batres', 11),
(46, 'El Triunfo', 11),
(47, 'Ereguayquín', 11),
(48, 'Estanzuelas', 11),
(49, 'Jiquilisco', 11),
(50, 'Jucuapa', 11),
(51, 'Jucuarán', 11),
(52, 'Mercedes Umaña', 11),
(53, 'Nueva Granada', 11),
(54, 'Ozatlán', 11),
(55, 'Puerto El Triunfo', 11),
(56, 'San Agustín', 11),
(57, 'San Buenaventura', 11),
(58, 'San Dionisio', 11),
(59, 'San Francisco Javier', 11),
(60, 'Santa Elena', 11),
(61, 'Santa María', 11),
(62, 'Santiago de María', 11),
(63, 'Tecapán', 11),
(64, 'Usulután', 11),
(65, 'Carolina', 12),
(66, 'Chapeltique', 12),
(67, 'Chinameca', 12),
(68, 'Chirilagua', 12),
(69, 'Ciudad Barrios', 12),
(70, 'Comacarán', 12),
(71, 'El Tránsito', 12),
(72, 'Lolotique', 12),
(73, 'Moncagua', 12),
(74, 'Nueva Guadalupe', 12),
(75, 'Nuevo Edén de San Juan', 12),
(76, 'Quelepa', 12),
(77, 'San Antonio del Mosco', 12),
(78, 'San Gerardo', 12),
(79, 'San Jorge', 12),
(80, 'San Luis de la Reina', 12),
(81, 'San Miguel', 12),
(82, 'San Rafael Oriente', 12),
(83, 'Sesori', 12),
(84, 'Uluazapa', 12),
(85, 'Arambala', 13),
(86, 'Cacaopera', 13),
(87, 'Chilanga', 13),
(88, 'Corinto', 13),
(89, 'Delicias de Concepción', 13),
(90, 'El Divisadero', 13),
(91, 'El Rosario (Morazán)', 13),
(92, 'Gualococti', 13),
(93, 'Guatajiagua', 13),
(94, 'Joateca', 13),
(95, 'Jocoaitique', 13),
(96, 'Jocoro', 13),
(97, 'Lolotiquillo', 13),
(98, 'Meanguera', 13),
(99, 'Osicala', 13),
(100, 'Perquín', 13),
(101, 'San Carlos', 13),
(102, 'San Fernando (Morazán)', 13),
(103, 'San Francisco Gotera', 13),
(104, 'San Isidro (Morazán)', 13),
(105, 'San Simón', 13),
(106, 'Sensembra', 13),
(107, 'Sociedad', 13),
(108, 'Torola', 13),
(109, 'Yamabal', 13),
(110, 'Yoloaiquín', 13),
(111, 'La Unión', 14),
(112, 'San Alejo', 14),
(113, 'Yucuaiquín', 14),
(114, 'Conchagua', 14),
(115, 'Intipucá', 14),
(116, 'San José', 14),
(117, 'El Carmen (La Unión)', 14),
(118, 'Yayantique', 14),
(119, 'Bolívar', 14),
(120, 'Meanguera del Golfo', 14),
(121, 'Santa Rosa de Lima', 14),
(122, 'Pasaquina', 14),
(123, 'Anamoros', 14),
(124, 'Nueva Esparta', 14),
(125, 'El Sauce', 14),
(126, 'Concepción de Oriente', 14),
(127, 'Polorós', 14),
(128, 'Lislique', 14),
(129, 'Antiguo Cuscatlán', 5),
(130, 'Chiltiupán', 5),
(131, 'Ciudad Arce', 5),
(132, 'Colón', 5),
(133, 'Comasagua', 5),
(134, 'Huizúcar', 5),
(135, 'Jayaque', 5),
(136, 'Jicalapa', 5),
(137, 'La Libertad', 5),
(138, 'Santa Tecla', 5),
(139, 'Nuevo Cuscatlán', 5),
(140, 'San Juan Opico', 5),
(141, 'Quezaltepeque', 5),
(142, 'Sacacoyo', 5),
(143, 'San José Villanueva', 5),
(144, 'San Matías', 5),
(145, 'San Pablo Tacachico', 5),
(146, 'Talnique', 5),
(147, 'Tamanique', 5),
(148, 'Teotepeque', 5),
(149, 'Tepecoyo', 5),
(150, 'Zaragoza', 5),
(151, 'Agua Caliente', 4),
(152, 'Arcatao', 4),
(153, 'Azacualpa', 4),
(154, 'Cancasque', 4),
(155, 'Chalatenango', 4),
(156, 'Citalá', 4),
(157, 'Comapala', 4),
(158, 'Concepción Quezaltepeque', 4),
(159, 'Dulce Nombre de María', 4),
(160, 'El Carrizal', 4),
(161, 'El Paraíso', 4),
(162, 'La Laguna', 4),
(163, 'La Palma', 4),
(164, 'La Reina', 4),
(165, 'Las Vueltas', 4),
(166, 'Nueva Concepción', 4),
(167, 'Nueva Trinidad', 4),
(168, 'Nombre de Jesús', 4),
(169, 'Ojos de Agua', 4),
(170, 'Potonico', 4),
(171, 'San Antonio de la Cruz', 4),
(172, 'San Antonio Los Ranchos', 4),
(173, 'San Fernando', 4),
(174, 'San Francisco Lempa', 4),
(175, 'San Francisco Morazán', 4),
(176, 'San Ignacio', 4),
(177, 'San Isidro Labrador', 4),
(178, 'Las Flores', 4),
(179, 'San Luis del Carmen', 4),
(180, 'San Miguel de Mercedes', 4),
(181, 'San Rafael', 4),
(182, 'Santa Rita', 4),
(183, 'Tejutla', 4),
(184, 'Cojutepeque', 7),
(185, 'Candelaria', 7),
(186, 'El Carmen (Cuscatlán)', 7),
(187, 'El Rosario (Cuscatlán)', 7),
(188, 'Monte San Juan', 7),
(189, 'Oratorio de Concepción', 7),
(190, 'San Bartolomé Perulapía', 7),
(191, 'San Cristóbal', 7),
(192, 'San José Guayabal', 7),
(193, 'San Pedro Perulapán', 7),
(194, 'San Rafael Cedros', 7),
(195, 'San Ramón', 7),
(196, 'Santa Cruz Analquito', 7),
(197, 'Santa Cruz Michapa', 7),
(198, 'Suchitoto', 7),
(199, 'Tenancingo', 7),
(200, 'Aguilares', 6),
(201, 'Apopa', 6),
(202, 'Ayutuxtepeque', 6),
(203, 'Cuscatancingo', 6),
(204, 'Ciudad Delgado', 6),
(205, 'El Paisnal', 6),
(206, 'Guazapa', 6),
(207, 'Ilopango', 6),
(208, 'Mejicanos', 6),
(209, 'Nejapa', 6),
(210, 'Panchimalco', 6),
(211, 'Rosario de Mora', 6),
(212, 'San Marcos', 6),
(213, 'San Martín', 6),
(214, 'San Salvador', 6),
(215, 'Santiago Texacuangos', 6),
(216, 'Santo Tomás', 6),
(217, 'Soyapango', 6),
(218, 'Tonacatepeque', 6),
(219, 'Zacatecoluca', 8),
(220, 'Cuyultitán', 8),
(221, 'El Rosario (La Paz)', 8),
(222, 'Jerusalén', 8),
(223, 'Mercedes La Ceiba', 8),
(224, 'Olocuilta', 8),
(225, 'Paraíso de Osorio', 8),
(226, 'San Antonio Masahuat', 8),
(227, 'San Emigdio', 8),
(228, 'San Francisco Chinameca', 8),
(229, 'San Pedro Masahuat', 8),
(230, 'San Juan Nonualco', 8),
(231, 'San Juan Talpa', 8),
(232, 'San Juan Tepezontes', 8),
(233, 'San Luis La Herradura', 8),
(234, 'San Luis Talpa', 8),
(235, 'San Miguel Tepezontes', 8),
(236, 'San Pedro Nonualco', 8),
(237, 'San Rafael Obrajuelo', 8),
(238, 'Santa María Ostuma', 8),
(239, 'Santiago Nonualco', 8),
(240, 'Tapalhuaca', 8),
(241, 'Cinquera', 9),
(242, 'Dolores', 9),
(243, 'Guacotecti', 9),
(244, 'Ilobasco', 9),
(245, 'Jutiapa', 9),
(246, 'San Isidro (Cabañas)', 9),
(247, 'Sensuntepeque', 9),
(248, 'Tejutepeque', 9),
(249, 'Victoria', 9),
(250, 'Apastepeque', 10),
(251, 'Guadalupe', 10),
(252, 'San Cayetano Istepeque', 10),
(253, 'San Esteban Catarina', 10),
(254, 'San Ildefonso', 10),
(255, 'San Lorenzo', 10),
(256, 'San Sebastián', 10),
(257, 'San Vicente', 10),
(258, 'Santa Clara', 10),
(259, 'Santo Domingo', 10),
(260, 'Tecoluca', 10),
(261, 'Tepetitán', 10),
(262, 'Verapaz', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_carreras`
--

CREATE TABLE `tbl_carreras` (
  `id_carrera` int(11) NOT NULL,
  `nombre_carrera` varchar(255) NOT NULL,
  `numero_materias` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_carreras`
--

INSERT INTO `tbl_carreras` (`id_carrera`, `nombre_carrera`, `numero_materias`) VALUES
(1, 'Ingeniería en Desarrollo de Software', 48);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_empresas`
--

CREATE TABLE `tbl_empresas` (
  `id_empresa` int(11) NOT NULL,
  `nombre_empresa` varchar(255) NOT NULL,
  `nrc` varchar(17) NOT NULL,
  `direccion_empresa` varchar(255) NOT NULL,
  `id_departamento` int(11) NOT NULL,
  `id_municipio` int(11) NOT NULL,
  `telefono` varchar(13) NOT NULL,
  `id_tipo_usuario` int(11) NOT NULL,
  `correo_electronico` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_empresas`
--

INSERT INTO `tbl_empresas` (`id_empresa`, `nombre_empresa`, `nrc`, `direccion_empresa`, `id_departamento`, `id_municipio`, `telefono`, `id_tipo_usuario`, `correo_electronico`, `password`) VALUES
(6, 'asdasd', '2131', 'asdasd', 11, 57, '12514', 2, 'asda@ascasc.com', 'asdfas'),
(7, 'asdasd', '2131', 'asdasd', 11, 57, '12514', 2, 'asda@ascasc.com', 'asdfas'),
(8, 'asdasd', '2131', 'asdasd', 11, 57, '12514', 2, 'asda@ascasc.com', 'asdfas'),
(9, 'gasgasg', '23', '2safasf', 7, 197, '35235', 2, 'correo@gmail.com', 'saf'),
(10, 'asfsa', '123', 'safaf', 11, 60, '1231', 2, 'adas@correo.com', 'sfa'),
(11, 'asd', '1231', 'asfasf', 10, 250, '141', 2, 'correo@gmail.com', 'safa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_estado_proyectos`
--

CREATE TABLE `tbl_estado_proyectos` (
  `id_estado` int(11) NOT NULL,
  `estado` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_estado_proyectos`
--

INSERT INTO `tbl_estado_proyectos` (`id_estado`, `estado`) VALUES
(1, 'Sin asignar'),
(2, 'En Proceso'),
(3, 'Finalizado'),
(4, 'En pausa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_estudiantes`
--

CREATE TABLE `tbl_estudiantes` (
  `id_estudiante` int(11) NOT NULL,
  `nombre_estudiante` varchar(255) NOT NULL,
  `edad` int(11) NOT NULL,
  `dui` varchar(10) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `telefono` varchar(13) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `carnet` varchar(9) NOT NULL,
  `id_carrera` int(11) NOT NULL,
  `materias_cursadas` int(11) NOT NULL,
  `id_tipo_usuario` int(11) NOT NULL,
  `correo_electronico` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_estudiantes`
--

INSERT INTO `tbl_estudiantes` (`id_estudiante`, `nombre_estudiante`, `edad`, `dui`, `direccion`, `telefono`, `fecha_nacimiento`, `carnet`, `id_carrera`, `materias_cursadas`, `id_tipo_usuario`, `correo_electronico`, `password`) VALUES
(1, 'Ezequiel Ramirez', 22, '06045720-9', '', '79291814', '2000-05-16', 'u20181130', 1, 30, 2, 'kr2000.16@gmail.com', '123456'),
(2, 'asfafa', 2353, 'asfa', 'asfasfas', '14', '2022-10-30', 'safa', 1, 21, 2, 'asda@ascasc.com', 'asdasdg'),
(3, 'asfdasd', 2342, 'asfasf', 'asdasd', '2342', '2022-11-21', 'asfasfas', 1, 234, 2, 'asda@ascasc.com', 'asfas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_postulante_empresas`
--

CREATE TABLE `tbl_postulante_empresas` (
  `id_postulacion_empresa` int(11) NOT NULL,
  `id_proyecto_empresa` int(11) NOT NULL,
  `id_estudiantes` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_postulante_universidad`
--

CREATE TABLE `tbl_postulante_universidad` (
  `id_postulacion_universidad` int(11) NOT NULL,
  `id_proyecto_universidad` int(11) NOT NULL,
  `id_estudiantes` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_proyecto_empresas`
--

CREATE TABLE `tbl_proyecto_empresas` (
  `id_proyecto_empresa` int(11) NOT NULL,
  `nombre_proyecto` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_estimada_final` date NOT NULL,
  `fecha_finalizado` date NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `id_tipo_proyecto` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `id_carrera` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_proyecto_universidad`
--

CREATE TABLE `tbl_proyecto_universidad` (
  `id_proyecto_universidad` int(11) NOT NULL,
  `nombre_proyecto` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_final_estimada` date NOT NULL,
  `fecha_finalizado` date NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_tipo_proyecto` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `id_carrera` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_proyecto_universidad`
--

INSERT INTO `tbl_proyecto_universidad` (`id_proyecto_universidad`, `nombre_proyecto`, `descripcion`, `fecha_inicio`, `fecha_final_estimada`, `fecha_finalizado`, `id_usuario`, `id_tipo_proyecto`, `id_estado`, `id_carrera`) VALUES
(1, 'Proyecto de prueba', 'asfa', '2022-11-10', '2022-11-30', '0000-00-00', 1, 1, 1, 1),
(2, 'Proyecto de prueba', 'asfasfas', '2022-11-01', '2022-11-15', '0000-00-00', 1, 2, 1, 1),
(3, 'Proyecto de prueba', 'fafsafas', '2022-11-22', '2022-11-04', '0000-00-00', 1, 3, 1, 1),
(4, 'asfafaasf', 'asfasfasfasf', '2022-11-17', '2022-11-08', '0000-00-00', 1, 2, 1, 1),
(5, 'Proyecto de prueba', 'sdgasg', '2022-11-21', '2022-11-22', '0000-00-00', 1, 1, 1, 1),
(6, 'dsga', 'asdgsagas', '2323-04-23', '2352-05-23', '0000-00-00', 1, 1, 1, 1),
(7, 'sadga', 'sdagdad', '3124-04-23', '4124-12-31', '0000-00-00', 1, 2, 1, 1),
(8, 'asfasfa', 'asfafas', '0000-00-00', '2522-05-23', '0000-00-00', 1, 1, 1, 1),
(9, 'asfasfa', 'asfafas', '0000-00-00', '2522-05-23', '0000-00-00', 1, 1, 1, 1),
(10, 'asfafaasf', 'asfasfasfas', '0000-00-00', '2141-04-12', '0000-00-00', 1, 2, 1, 1),
(11, 'Proyecto ', 'basfdb knjlbsfd knjlvbfdcz knlbsfd knl', '2022-11-21', '2022-12-08', '0000-00-00', 1, 2, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_super_administrador`
--

CREATE TABLE `tbl_super_administrador` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_tipo_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_super_administrador`
--

INSERT INTO `tbl_super_administrador` (`id_usuario`, `nombre_usuario`, `correo`, `password`, `id_tipo_usuario`) VALUES
(1, 'Zeke', 'kr2000.16@gmail.com', '123456', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_proyecto`
--

CREATE TABLE `tbl_tipo_proyecto` (
  `id_tipo_proyecto` int(11) NOT NULL,
  `nombre_tipo_proyecto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_tipo_proyecto`
--

INSERT INTO `tbl_tipo_proyecto` (`id_tipo_proyecto`, `nombre_tipo_proyecto`) VALUES
(1, 'Pasantía sin remuneración'),
(2, 'Pasantía remunerada'),
(3, 'Servicios profesionales');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_usuario`
--

CREATE TABLE `tbl_tipo_usuario` (
  `id_tipo_usuario` int(11) NOT NULL,
  `tipo_usuario` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_tipo_usuario`
--

INSERT INTO `tbl_tipo_usuario` (`id_tipo_usuario`, `tipo_usuario`) VALUES
(1, 'Administrador'),
(2, 'Usuario ');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbldepartamentos`
--
ALTER TABLE `tbldepartamentos`
  ADD PRIMARY KEY (`id_departamento`);

--
-- Indices de la tabla `tblmunicipios`
--
ALTER TABLE `tblmunicipios`
  ADD PRIMARY KEY (`id_municipio`),
  ADD KEY `id_departamento` (`id_departamento`);

--
-- Indices de la tabla `tbl_carreras`
--
ALTER TABLE `tbl_carreras`
  ADD PRIMARY KEY (`id_carrera`);

--
-- Indices de la tabla `tbl_empresas`
--
ALTER TABLE `tbl_empresas`
  ADD PRIMARY KEY (`id_empresa`),
  ADD KEY `tipo_usuario` (`id_tipo_usuario`),
  ADD KEY `id_departamento` (`id_departamento`),
  ADD KEY `id_municipio` (`id_municipio`);

--
-- Indices de la tabla `tbl_estado_proyectos`
--
ALTER TABLE `tbl_estado_proyectos`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `tbl_estudiantes`
--
ALTER TABLE `tbl_estudiantes`
  ADD PRIMARY KEY (`id_estudiante`),
  ADD KEY `id_carrera` (`id_carrera`),
  ADD KEY `id_tipo_usuario` (`id_tipo_usuario`);

--
-- Indices de la tabla `tbl_postulante_empresas`
--
ALTER TABLE `tbl_postulante_empresas`
  ADD PRIMARY KEY (`id_postulacion_empresa`),
  ADD KEY `id_proyecto_empresa` (`id_proyecto_empresa`);

--
-- Indices de la tabla `tbl_postulante_universidad`
--
ALTER TABLE `tbl_postulante_universidad`
  ADD PRIMARY KEY (`id_postulacion_universidad`),
  ADD KEY `id_proyecto_universidad` (`id_proyecto_universidad`);

--
-- Indices de la tabla `tbl_proyecto_empresas`
--
ALTER TABLE `tbl_proyecto_empresas`
  ADD PRIMARY KEY (`id_proyecto_empresa`),
  ADD KEY `id_carrera` (`id_carrera`),
  ADD KEY `id_empresa` (`id_empresa`),
  ADD KEY `id_estado` (`id_estado`),
  ADD KEY `id_tipo_proyecto` (`id_tipo_proyecto`);

--
-- Indices de la tabla `tbl_proyecto_universidad`
--
ALTER TABLE `tbl_proyecto_universidad`
  ADD PRIMARY KEY (`id_proyecto_universidad`),
  ADD KEY `id_carrera` (`id_carrera`),
  ADD KEY `id_estado` (`id_estado`),
  ADD KEY `id_tipo_proyecto` (`id_tipo_proyecto`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `tbl_super_administrador`
--
ALTER TABLE `tbl_super_administrador`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_tipo_usuario` (`id_tipo_usuario`);

--
-- Indices de la tabla `tbl_tipo_proyecto`
--
ALTER TABLE `tbl_tipo_proyecto`
  ADD PRIMARY KEY (`id_tipo_proyecto`);

--
-- Indices de la tabla `tbl_tipo_usuario`
--
ALTER TABLE `tbl_tipo_usuario`
  ADD PRIMARY KEY (`id_tipo_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbldepartamentos`
--
ALTER TABLE `tbldepartamentos`
  MODIFY `id_departamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `tblmunicipios`
--
ALTER TABLE `tblmunicipios`
  MODIFY `id_municipio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=263;

--
-- AUTO_INCREMENT de la tabla `tbl_carreras`
--
ALTER TABLE `tbl_carreras`
  MODIFY `id_carrera` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tbl_empresas`
--
ALTER TABLE `tbl_empresas`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `tbl_estado_proyectos`
--
ALTER TABLE `tbl_estado_proyectos`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tbl_estudiantes`
--
ALTER TABLE `tbl_estudiantes`
  MODIFY `id_estudiante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_postulante_empresas`
--
ALTER TABLE `tbl_postulante_empresas`
  MODIFY `id_postulacion_empresa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_postulante_universidad`
--
ALTER TABLE `tbl_postulante_universidad`
  MODIFY `id_postulacion_universidad` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_proyecto_empresas`
--
ALTER TABLE `tbl_proyecto_empresas`
  MODIFY `id_proyecto_empresa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_proyecto_universidad`
--
ALTER TABLE `tbl_proyecto_universidad`
  MODIFY `id_proyecto_universidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `tbl_super_administrador`
--
ALTER TABLE `tbl_super_administrador`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tbl_tipo_proyecto`
--
ALTER TABLE `tbl_tipo_proyecto`
  MODIFY `id_tipo_proyecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_tipo_usuario`
--
ALTER TABLE `tbl_tipo_usuario`
  MODIFY `id_tipo_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tblmunicipios`
--
ALTER TABLE `tblmunicipios`
  ADD CONSTRAINT `tblmunicipios_ibfk_1` FOREIGN KEY (`id_departamento`) REFERENCES `tbldepartamentos` (`id_departamento`);

--
-- Filtros para la tabla `tbl_empresas`
--
ALTER TABLE `tbl_empresas`
  ADD CONSTRAINT `tbl_empresas_ibfk_1` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `tbl_tipo_usuario` (`id_tipo_usuario`),
  ADD CONSTRAINT `tbl_empresas_ibfk_2` FOREIGN KEY (`id_departamento`) REFERENCES `tbldepartamentos` (`id_departamento`),
  ADD CONSTRAINT `tbl_empresas_ibfk_3` FOREIGN KEY (`id_municipio`) REFERENCES `tblmunicipios` (`id_municipio`);

--
-- Filtros para la tabla `tbl_estudiantes`
--
ALTER TABLE `tbl_estudiantes`
  ADD CONSTRAINT `tbl_estudiantes_ibfk_1` FOREIGN KEY (`id_carrera`) REFERENCES `tbl_carreras` (`id_carrera`),
  ADD CONSTRAINT `tbl_estudiantes_ibfk_2` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `tbl_tipo_usuario` (`id_tipo_usuario`);

--
-- Filtros para la tabla `tbl_postulante_empresas`
--
ALTER TABLE `tbl_postulante_empresas`
  ADD CONSTRAINT `tbl_postulante_empresas_ibfk_1` FOREIGN KEY (`id_proyecto_empresa`) REFERENCES `tbl_proyecto_empresas` (`id_proyecto_empresa`);

--
-- Filtros para la tabla `tbl_postulante_universidad`
--
ALTER TABLE `tbl_postulante_universidad`
  ADD CONSTRAINT `tbl_postulante_universidad_ibfk_1` FOREIGN KEY (`id_proyecto_universidad`) REFERENCES `tbl_proyecto_universidad` (`id_proyecto_universidad`);

--
-- Filtros para la tabla `tbl_proyecto_empresas`
--
ALTER TABLE `tbl_proyecto_empresas`
  ADD CONSTRAINT `tbl_proyecto_empresas_ibfk_1` FOREIGN KEY (`id_carrera`) REFERENCES `tbl_carreras` (`id_carrera`),
  ADD CONSTRAINT `tbl_proyecto_empresas_ibfk_2` FOREIGN KEY (`id_empresa`) REFERENCES `tbl_empresas` (`id_empresa`),
  ADD CONSTRAINT `tbl_proyecto_empresas_ibfk_3` FOREIGN KEY (`id_estado`) REFERENCES `tbl_estado_proyectos` (`id_estado`),
  ADD CONSTRAINT `tbl_proyecto_empresas_ibfk_4` FOREIGN KEY (`id_tipo_proyecto`) REFERENCES `tbl_tipo_proyecto` (`id_tipo_proyecto`);

--
-- Filtros para la tabla `tbl_proyecto_universidad`
--
ALTER TABLE `tbl_proyecto_universidad`
  ADD CONSTRAINT `tbl_proyecto_universidad_ibfk_1` FOREIGN KEY (`id_carrera`) REFERENCES `tbl_carreras` (`id_carrera`),
  ADD CONSTRAINT `tbl_proyecto_universidad_ibfk_2` FOREIGN KEY (`id_estado`) REFERENCES `tbl_estado_proyectos` (`id_estado`),
  ADD CONSTRAINT `tbl_proyecto_universidad_ibfk_3` FOREIGN KEY (`id_tipo_proyecto`) REFERENCES `tbl_tipo_proyecto` (`id_tipo_proyecto`),
  ADD CONSTRAINT `tbl_proyecto_universidad_ibfk_4` FOREIGN KEY (`id_usuario`) REFERENCES `tbl_super_administrador` (`id_usuario`);

--
-- Filtros para la tabla `tbl_super_administrador`
--
ALTER TABLE `tbl_super_administrador`
  ADD CONSTRAINT `tbl_super_administrador_ibfk_1` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `tbl_tipo_usuario` (`id_tipo_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
