-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 16-06-2018 a las 02:24:09
-- Versión del servidor: 5.6.38
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "-05:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `apuesta_mundial`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apostador`
--

CREATE TABLE `apostador` (
  `id` int(11) NOT NULL,
  `cedula` varchar(13) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `celular` varchar(30) NOT NULL,
  `monto_inicial` float NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `apostador`
--

INSERT INTO `apostador` (`id`, `cedula`, `password`, `nombre`, `email`, `celular`, `monto_inicial`, `fecha`, `estado`) VALUES
(1, '0922159363', 'd838a873bbbffc09aee45a2510759f5f', 'Fabricio Diógenes Orrala Parrales', 'fzzio007@gmail.com', '0997213150', 10, '2018-06-13 04:03:18', 1),
(2, '0917000093', '491e15e28caaf37cb40d002a8066c1f1', 'Félix Ricardo Chávez Orrala', 'ferichav@gmail.com', '0983862266', 10, '2018-06-13 04:20:36', 1),
(3, '0915910400', '1e5eeb40a3fce716b244599862fd2200', 'Dalthon  Mauricio Vera Orrala', 'dalve29@gmail.com', '0993661296', 10, '2018-06-13 04:20:36', 1),
(4, '0924682461', '0066fdca207700676998c29bf2b68f4d', 'RONALD ENRIQUE BORBOR MALAVE', 'ron_odonto@hotmail.com', '0987297036', 10, '2018-06-15 10:00:38', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apuesta`
--

CREATE TABLE `apuesta` (
  `id` int(11) NOT NULL,
  `id_pronostico_apostador_1` int(11) NOT NULL,
  `id_pronostico_apostador_2` int(11) DEFAULT NULL,
  `monto` float NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `estado` int(11) NOT NULL COMMENT '1 = Emparejada, 0 = Sin contrincante'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `apuesta`
--

INSERT INTO `apuesta` (`id`, `id_pronostico_apostador_1`, `id_pronostico_apostador_2`, `monto`, `fecha`, `estado`) VALUES
(1, 1, 2, 1, '2018-06-14 13:09:07', 1),
(2, 6, 7, 2, '2018-06-15 10:27:08', 1),
(3, 3, NULL, 3, '2018-06-15 01:22:29', 0),
(4, 4, NULL, 1, '2018-06-15 01:23:21', 0),
(5, 5, NULL, 3, '2018-06-15 10:13:11', 0),
(12, 8, 9, 1, '2018-06-15 10:29:56', 1),
(13, 10, NULL, 2, '2018-06-15 10:34:01', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE `pais` (
  `id` int(11) NOT NULL,
  `nombre` varchar(80) DEFAULT NULL,
  `iso` char(10) DEFAULT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`id`, `nombre`, `iso`, `estado`) VALUES
(1, 'Afganistán', 'AF', 0),
(2, 'Islas Gland', 'AX', 0),
(3, 'Albania', 'AL', 0),
(4, 'Alemania', 'DE', 1),
(5, 'Andorra', 'AD', 0),
(6, 'Angola', 'AO', 0),
(7, 'Anguilla', 'AI', 0),
(8, 'Antártida', 'AQ', 0),
(9, 'Antigua y Barbuda', 'AG', 0),
(10, 'Antillas Holandesas', 'AN', 0),
(11, 'Arabia Saudí', 'SA', 1),
(12, 'Argelia', 'DZ', 0),
(13, 'Argentina', 'AR', 1),
(14, 'Armenia', 'AM', 0),
(15, 'Aruba', 'AW', 0),
(16, 'Australia', 'AU', 1),
(17, 'Austria', 'AT', 0),
(18, 'Azerbaiyán', 'AZ', 0),
(19, 'Bahamas', 'BS', 0),
(20, 'Bahréin', 'BH', 0),
(21, 'Bangladesh', 'BD', 0),
(22, 'Barbados', 'BB', 0),
(23, 'Bielorrusia', 'BY', 0),
(24, 'Bélgica', 'BE', 1),
(25, 'Belice', 'BZ', 0),
(26, 'Benin', 'BJ', 0),
(27, 'Bermudas', 'BM', 0),
(28, 'Bhután', 'BT', 0),
(29, 'Bolivia', 'BO', 0),
(30, 'Bosnia y Herzegovina', 'BA', 0),
(31, 'Botsuana', 'BW', 0),
(32, 'Isla Bouvet', 'BV', 0),
(33, 'Brasil', 'BR', 1),
(34, 'Brunéi', 'BN', 0),
(35, 'Bulgaria', 'BG', 0),
(36, 'Burkina Faso', 'BF', 0),
(37, 'Burundi', 'BI', 0),
(38, 'Cabo Verde', 'CV', 0),
(39, 'Islas Caimán', 'KY', 0),
(40, 'Camboya', 'KH', 0),
(41, 'Camerún', 'CM', 0),
(42, 'Canadá', 'CA', 0),
(43, 'República Centroafricana', 'CF', 0),
(44, 'Chad', 'TD', 0),
(45, 'República Checa', 'CZ', 0),
(46, 'Chile', 'CL', 0),
(47, 'China', 'CN', 0),
(48, 'Chipre', 'CY', 0),
(49, 'Isla de Navidad', 'CX', 0),
(50, 'Ciudad del Vaticano', 'VA', 0),
(51, 'Islas Cocos', 'CC', 0),
(52, 'Colombia', 'CO', 1),
(53, 'Comoras', 'KM', 0),
(54, 'República Democrática del Congo', 'CD', 0),
(55, 'Congo', 'CG', 0),
(56, 'Islas Cook', 'CK', 0),
(57, 'Corea del Norte', 'KP', 0),
(58, 'Corea del Sur', 'KR', 1),
(59, 'Costa de Marfil', 'CI', 0),
(60, 'Costa Rica', 'CR', 1),
(61, 'Croacia', 'HR', 1),
(62, 'Cuba', 'CU', 0),
(63, 'Dinamarca', 'DK', 1),
(64, 'Dominica', 'DM', 0),
(65, 'República Dominicana', 'DO', 0),
(66, 'Ecuador', 'EC', 0),
(67, 'Egipto', 'EG', 1),
(68, 'El Salvador', 'SV', 0),
(69, 'Emiratos Árabes Unidos', 'AE', 0),
(70, 'Eritrea', 'ER', 0),
(71, 'Eslovaquia', 'SK', 0),
(72, 'Eslovenia', 'SI', 0),
(73, 'España', 'ES', 1),
(74, 'Islas ultramarinas de Estados Unidos', 'UM', 0),
(75, 'Estados Unidos', 'US', 0),
(76, 'Estonia', 'EE', 0),
(77, 'Etiopía', 'ET', 0),
(78, 'Islas Feroe', 'FO', 0),
(79, 'Filipinas', 'PH', 0),
(80, 'Finlandia', 'FI', 0),
(81, 'Fiyi', 'FJ', 0),
(82, 'Francia', 'FR', 1),
(83, 'Gabón', 'GA', 0),
(84, 'Gambia', 'GM', 0),
(85, 'Georgia', 'GE', 0),
(86, 'Islas Georgias del Sur y Sandwich del Sur', 'GS', 0),
(87, 'Ghana', 'GH', 0),
(88, 'Gibraltar', 'GI', 0),
(89, 'Granada', 'GD', 0),
(90, 'Grecia', 'GR', 0),
(91, 'Groenlandia', 'GL', 0),
(92, 'Guadalupe', 'GP', 0),
(93, 'Guam', 'GU', 0),
(94, 'Guatemala', 'GT', 0),
(95, 'Guayana Francesa', 'GF', 0),
(96, 'Guinea', 'GN', 0),
(97, 'Guinea Ecuatorial', 'GQ', 0),
(98, 'Guinea-Bissau', 'GW', 0),
(99, 'Guyana', 'GY', 0),
(100, 'Haití', 'HT', 0),
(101, 'Islas Heard y McDonald', 'HM', 0),
(102, 'Honduras', 'HN', 0),
(103, 'Hong Kong', 'HK', 0),
(104, 'Hungría', 'HU', 0),
(105, 'India', 'IN', 0),
(106, 'Indonesia', 'ID', 0),
(107, 'Irán', 'IR', 1),
(108, 'Iraq', 'IQ', 0),
(109, 'Irlanda', 'IE', 0),
(110, 'Islandia', 'IS', 1),
(111, 'Israel', 'IL', 0),
(112, 'Italia', 'IT', 0),
(113, 'Jamaica', 'JM', 0),
(114, 'Japón', 'JP', 1),
(115, 'Jordania', 'JO', 0),
(116, 'Kazajstán', 'KZ', 0),
(117, 'Kenia', 'KE', 0),
(118, 'Kirguistán', 'KG', 0),
(119, 'Kiribati', 'KI', 0),
(120, 'Kuwait', 'KW', 0),
(121, 'Laos', 'LA', 0),
(122, 'Lesotho', 'LS', 0),
(123, 'Letonia', 'LV', 0),
(124, 'Líbano', 'LB', 0),
(125, 'Liberia', 'LR', 0),
(126, 'Libia', 'LY', 0),
(127, 'Liechtenstein', 'LI', 0),
(128, 'Lituania', 'LT', 0),
(129, 'Luxemburgo', 'LU', 0),
(130, 'Macao', 'MO', 0),
(131, 'ARY Macedonia', 'MK', 0),
(132, 'Madagascar', 'MG', 0),
(133, 'Malasia', 'MY', 0),
(134, 'Malawi', 'MW', 0),
(135, 'Maldivas', 'MV', 0),
(136, 'Malí', 'ML', 0),
(137, 'Malta', 'MT', 0),
(138, 'Islas Malvinas', 'FK', 0),
(139, 'Islas Marianas del Norte', 'MP', 0),
(140, 'Marruecos', 'MA', 1),
(141, 'Islas Marshall', 'MH', 0),
(142, 'Martinica', 'MQ', 0),
(143, 'Mauricio', 'MU', 0),
(144, 'Mauritania', 'MR', 0),
(145, 'Mayotte', 'YT', 0),
(146, 'México', 'MX', 1),
(147, 'Micronesia', 'FM', 0),
(148, 'Moldavia', 'MD', 0),
(149, 'Mónaco', 'MC', 0),
(150, 'Mongolia', 'MN', 0),
(151, 'Montserrat', 'MS', 0),
(152, 'Mozambique', 'MZ', 0),
(153, 'Myanmar', 'MM', 0),
(154, 'Namibia', 'NA', 0),
(155, 'Nauru', 'NR', 0),
(156, 'Nepal', 'NP', 0),
(157, 'Nicaragua', 'NI', 0),
(158, 'Níger', 'NE', 0),
(159, 'Nigeria', 'NG', 1),
(160, 'Niue', 'NU', 0),
(161, 'Isla Norfolk', 'NF', 0),
(162, 'Noruega', 'NO', 0),
(163, 'Nueva Caledonia', 'NC', 0),
(164, 'Nueva Zelanda', 'NZ', 0),
(165, 'Omán', 'OM', 0),
(166, 'Países Bajos', 'NL', 0),
(167, 'Pakistán', 'PK', 0),
(168, 'Palau', 'PW', 0),
(169, 'Palestina', 'PS', 0),
(170, 'Panamá', 'PA', 1),
(171, 'Papúa Nueva Guinea', 'PG', 0),
(172, 'Paraguay', 'PY', 0),
(173, 'Perú', 'PE', 1),
(174, 'Islas Pitcairn', 'PN', 0),
(175, 'Polinesia Francesa', 'PF', 0),
(176, 'Polonia', 'PL', 1),
(177, 'Portugal', 'PT', 1),
(178, 'Puerto Rico', 'PR', 0),
(179, 'Qatar', 'QA', 0),
(180, 'Reino Unido', 'GB', 0),
(181, 'Reunión', 'RE', 0),
(182, 'Ruanda', 'RW', 0),
(183, 'Rumania', 'RO', 0),
(184, 'Rusia', 'RU', 1),
(185, 'Sahara Occidental', 'EH', 0),
(186, 'Islas Salomón', 'SB', 0),
(187, 'Samoa', 'WS', 0),
(188, 'Samoa Americana', 'AS', 0),
(189, 'San Cristóbal y Nevis', 'KN', 0),
(190, 'San Marino', 'SM', 0),
(191, 'San Pedro y Miquelón', 'PM', 0),
(192, 'San Vicente y las Granadinas', 'VC', 0),
(193, 'Santa Helena', 'SH', 0),
(194, 'Santa Lucía', 'LC', 0),
(195, 'Santo Tomé y Príncipe', 'ST', 0),
(196, 'Senegal', 'SN', 1),
(197, 'Serbia y Montenegro', 'CS', 0),
(198, 'Seychelles', 'SC', 0),
(199, 'Sierra Leona', 'SL', 0),
(200, 'Singapur', 'SG', 0),
(201, 'Siria', 'SY', 0),
(202, 'Somalia', 'SO', 0),
(203, 'Sri Lanka', 'LK', 0),
(204, 'Suazilandia', 'SZ', 0),
(205, 'Sudáfrica', 'ZA', 0),
(206, 'Sudán', 'SD', 0),
(207, 'Suecia', 'SE', 1),
(208, 'Suiza', 'CH', 1),
(209, 'Surinam', 'SR', 0),
(210, 'Svalbard y Jan Mayen', 'SJ', 0),
(211, 'Tailandia', 'TH', 0),
(212, 'Taiwán', 'TW', 0),
(213, 'Tanzania', 'TZ', 0),
(214, 'Tayikistán', 'TJ', 0),
(215, 'Territorio Británico del Océano Índico', 'IO', 0),
(216, 'Territorios Australes Franceses', 'TF', 0),
(217, 'Timor Oriental', 'TL', 0),
(218, 'Togo', 'TG', 0),
(219, 'Tokelau', 'TK', 0),
(220, 'Tonga', 'TO', 0),
(221, 'Trinidad y Tobago', 'TT', 0),
(222, 'Túnez', 'TN', 1),
(223, 'Islas Turcas y Caicos', 'TC', 0),
(224, 'Turkmenistán', 'TM', 0),
(225, 'Turquía', 'TR', 0),
(226, 'Tuvalu', 'TV', 0),
(227, 'Ucrania', 'UA', 0),
(228, 'Uganda', 'UG', 0),
(229, 'Uruguay', 'UY', 1),
(230, 'Uzbekistán', 'UZ', 0),
(231, 'Vanuatu', 'VU', 0),
(232, 'Venezuela', 'VE', 0),
(233, 'Vietnam', 'VN', 0),
(234, 'Islas Vírgenes Británicas', 'VG', 0),
(235, 'Islas Vírgenes de los Estados Unidos', 'VI', 0),
(236, 'Wallis y Futuna', 'WF', 0),
(237, 'Yemen', 'YE', 0),
(238, 'Yibuti', 'DJ', 0),
(239, 'Zambia', 'ZM', 0),
(240, 'Zimbabue', 'ZW', 0),
(241, 'Inglaterra', 'GB-ENG', 1),
(242, 'Serbia', 'RS', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partido`
--

CREATE TABLE `partido` (
  `id` int(11) NOT NULL,
  `id_pais_local` int(11) DEFAULT NULL,
  `id_pais_visitante` int(11) DEFAULT NULL,
  `fecha` datetime NOT NULL,
  `goles_local` int(11) DEFAULT NULL,
  `goles_visitante` int(11) DEFAULT NULL,
  `incidencias_local` text,
  `incidencias_visitante` text,
  `fase` int(11) NOT NULL COMMENT '1 = Grupos, 2 = Octavos, 3 = Cuartos, 4 = Semifinal, 5 = Final, 6 = Tercer Puesto, 0 = Inactivo',
  `grupo` varchar(1) DEFAULT NULL COMMENT 'Los grupos pueden ser A, B, C, D, E, F, G, H o ninguno',
  `estado` int(11) NOT NULL COMMENT '1 = Por Jugar, 2 = Jugando, 3 = Finalizado, 0 Inactivo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `partido`
--

INSERT INTO `partido` (`id`, `id_pais_local`, `id_pais_visitante`, `fecha`, `goles_local`, `goles_visitante`, `incidencias_local`, `incidencias_visitante`, `fase`, `grupo`, `estado`) VALUES
(1, 184, 11, '2018-06-14 10:00:00', 5, 0, '', NULL, 1, 'A', 3),
(2, 67, 229, '2018-06-15 07:00:00', 0, 1, NULL, NULL, 1, 'A', 3),
(3, 184, 67, '2018-06-19 13:00:00', NULL, NULL, NULL, NULL, 1, 'A', 1),
(4, 229, 11, '2018-06-20 10:00:00', NULL, NULL, NULL, NULL, 1, 'A', 1),
(5, 11, 67, '2018-06-25 09:00:00', NULL, NULL, NULL, NULL, 1, 'A', 1),
(6, 229, 184, '2018-06-25 09:00:00', NULL, NULL, NULL, NULL, 1, 'A', 1),
(7, 140, 107, '2018-06-15 10:00:00', 0, 1, NULL, NULL, 1, 'B', 3),
(8, 177, 73, '2018-06-15 13:00:00', 3, 3, NULL, NULL, 1, 'B', 3),
(9, 177, 140, '2018-06-20 07:00:00', NULL, NULL, NULL, NULL, 1, 'B', 1),
(10, 107, 73, '2018-06-20 13:00:00', NULL, NULL, NULL, NULL, 1, 'B', 1),
(11, 73, 140, '2018-06-25 13:00:00', NULL, NULL, NULL, NULL, 1, 'B', 1),
(13, 107, 177, '2018-06-25 13:00:00', NULL, NULL, NULL, NULL, 1, 'B', 1),
(14, 82, 16, '2018-06-16 05:00:00', NULL, NULL, NULL, NULL, 1, 'C', 1),
(15, 173, 63, '2018-06-16 11:00:00', NULL, NULL, NULL, NULL, 1, 'C', 1),
(16, 82, 173, '2018-06-21 10:00:00', NULL, NULL, NULL, NULL, 1, 'C', 1),
(17, 63, 16, '2018-06-21 07:00:00', NULL, NULL, NULL, NULL, 1, 'C', 1),
(18, 16, 173, '2018-06-26 09:00:00', NULL, NULL, NULL, NULL, 1, 'C', 1),
(19, 63, 82, '2018-06-26 09:00:00', NULL, NULL, NULL, NULL, 1, 'C', 1),
(20, 13, 110, '2018-06-16 08:00:00', NULL, NULL, NULL, NULL, 1, 'D', 1),
(21, 61, 159, '2018-06-16 14:00:00', NULL, NULL, NULL, NULL, 1, 'D', 1),
(22, 13, 61, '2018-06-21 13:00:00', NULL, NULL, NULL, NULL, 1, 'D', 1),
(23, 159, 110, '2018-06-22 10:00:00', NULL, NULL, NULL, NULL, 1, 'D', 1),
(24, 110, 61, '2018-06-26 13:00:00', NULL, NULL, NULL, NULL, 1, 'D', 1),
(25, 159, 13, '2018-06-26 13:00:00', NULL, NULL, NULL, NULL, 1, 'D', 1),
(26, 60, 242, '2018-06-17 07:00:00', NULL, NULL, NULL, NULL, 1, 'E', 1),
(27, 33, 208, '2018-06-17 13:00:00', NULL, NULL, NULL, NULL, 1, 'E', 1),
(28, 33, 60, '2018-06-22 07:00:00', NULL, NULL, NULL, NULL, 1, 'E', 1),
(29, 242, 208, '2018-06-22 13:00:00', NULL, NULL, NULL, NULL, 1, 'E', 1),
(30, 208, 60, '2018-06-27 13:00:00', NULL, NULL, NULL, NULL, 1, 'E', 1),
(31, 242, 33, '2018-06-27 13:00:00', NULL, NULL, NULL, NULL, 1, 'E', 1),
(32, 4, 146, '2018-06-17 10:00:00', NULL, NULL, NULL, NULL, 1, 'F', 1),
(33, 207, 58, '2018-06-18 07:00:00', NULL, NULL, NULL, NULL, 1, 'F', 1),
(34, 4, 207, '2018-06-23 13:00:00', NULL, NULL, NULL, NULL, 1, 'F', 1),
(35, 58, 146, '2018-06-23 10:00:00', NULL, NULL, NULL, NULL, 1, 'F', 1),
(36, 146, 207, '2018-06-27 09:00:00', NULL, NULL, NULL, NULL, 1, 'F', 1),
(37, 58, 4, '2018-06-27 09:00:00', NULL, NULL, NULL, NULL, 1, 'F', 1),
(38, 24, 170, '2018-06-18 10:00:00', NULL, NULL, NULL, NULL, 1, 'G', 1),
(39, 222, 241, '2018-06-18 13:00:00', NULL, NULL, NULL, NULL, 1, 'G', 1),
(40, 24, 222, '2018-06-23 07:00:00', NULL, NULL, NULL, NULL, 1, 'G', 1),
(41, 241, 170, '2018-06-24 07:00:00', NULL, NULL, NULL, NULL, 1, 'G', 1),
(42, 170, 222, '2018-06-28 13:00:00', NULL, NULL, NULL, NULL, 1, 'G', 1),
(43, 241, 24, '2018-06-28 13:00:00', NULL, NULL, NULL, NULL, 1, 'G', 1),
(44, 176, 196, '2018-06-19 10:00:00', NULL, NULL, NULL, NULL, 1, 'H', 1),
(45, 52, 114, '2018-06-19 07:00:00', NULL, NULL, NULL, NULL, 1, 'H', 1),
(46, 114, 196, '2018-06-24 10:00:00', NULL, NULL, NULL, NULL, 1, 'H', 1),
(47, 176, 52, '2018-06-16 13:00:00', NULL, NULL, NULL, NULL, 1, 'H', 1),
(48, 196, 52, '2018-06-28 09:00:00', NULL, NULL, NULL, NULL, 1, 'H', 1),
(49, 114, 176, '2018-06-28 09:00:00', NULL, NULL, NULL, NULL, 1, 'H', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pronostico`
--

CREATE TABLE `pronostico` (
  `id` int(11) NOT NULL,
  `id_partido` int(11) NOT NULL,
  `id_apostador` int(11) NOT NULL,
  `resultado` int(11) NOT NULL COMMENT '1 = Gana Local, 2 = Gana Visitante, 3 Empate',
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pronostico`
--

INSERT INTO `pronostico` (`id`, `id_partido`, `id_apostador`, `resultado`, `fecha`, `estado`) VALUES
(1, 1, 1, 1, '2018-06-13 04:11:31', 1),
(2, 1, 2, 2, '2018-06-13 05:26:31', 1),
(3, 2, 1, 1, '2018-06-15 01:21:39', 1),
(4, 3, 1, 2, '2018-06-15 01:21:39', 1),
(5, 8, 2, 1, '2018-06-15 10:12:45', 1),
(6, 7, 1, 3, '2018-06-15 08:21:32', 1),
(7, 7, 3, 2, '2018-06-15 09:21:32', 1),
(8, 7, 1, 1, '2018-06-15 10:28:42', 1),
(9, 7, 2, 2, '2018-06-15 10:29:22', 1),
(10, 7, 3, 2, '2018-06-15 10:33:33', 1),
(11, 9, 2, 2, '2018-06-15 22:35:06', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `super_administrador`
--

CREATE TABLE `super_administrador` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `user` varchar(100) NOT NULL,
  `password` varchar(40) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_modificacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `super_administrador`
--

INSERT INTO `super_administrador` (`id`, `nombre`, `email`, `user`, `password`, `fecha_registro`, `fecha_modificacion`, `estado`) VALUES
(1, 'Super Administrador', 'info@mail.com.ec', 'admin', 'e015ef992e2d8a57d866d70d078ff1cb', '2018-03-23 19:30:06', '2018-06-15 17:07:58', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `apostador`
--
ALTER TABLE `apostador`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `apuesta`
--
ALTER TABLE `apuesta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_apostador_1` (`id_pronostico_apostador_1`),
  ADD KEY `fk_apostador_2` (`id_pronostico_apostador_2`);

--
-- Indices de la tabla `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `partido`
--
ALTER TABLE `partido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_equipo_local` (`id_pais_local`),
  ADD KEY `fk_equipo_visitante` (`id_pais_visitante`);

--
-- Indices de la tabla `pronostico`
--
ALTER TABLE `pronostico`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_apostador` (`id_apostador`),
  ADD KEY `fk_partido` (`id_partido`);

--
-- Indices de la tabla `super_administrador`
--
ALTER TABLE `super_administrador`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `apostador`
--
ALTER TABLE `apostador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `apuesta`
--
ALTER TABLE `apuesta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `pais`
--
ALTER TABLE `pais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=243;

--
-- AUTO_INCREMENT de la tabla `partido`
--
ALTER TABLE `partido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de la tabla `pronostico`
--
ALTER TABLE `pronostico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `super_administrador`
--
ALTER TABLE `super_administrador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `apuesta`
--
ALTER TABLE `apuesta`
  ADD CONSTRAINT `fk_apostador_1` FOREIGN KEY (`id_pronostico_apostador_1`) REFERENCES `pronostico` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_apostador_2` FOREIGN KEY (`id_pronostico_apostador_2`) REFERENCES `pronostico` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `partido`
--
ALTER TABLE `partido`
  ADD CONSTRAINT `fk_equipo_local` FOREIGN KEY (`id_pais_local`) REFERENCES `pais` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_equipo_visitante` FOREIGN KEY (`id_pais_visitante`) REFERENCES `pais` (`id`);

--
-- Filtros para la tabla `pronostico`
--
ALTER TABLE `pronostico`
  ADD CONSTRAINT `fk_apostador` FOREIGN KEY (`id_apostador`) REFERENCES `apostador` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_partido` FOREIGN KEY (`id_partido`) REFERENCES `partido` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
