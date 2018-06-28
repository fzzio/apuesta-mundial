-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 28-06-2018 a las 17:43:20
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
(2, '0917000093', '491e15e28caaf37cb40d002a8066c1f1', 'Félix Ricardo Chávez Orrala', 'ferichav@gmail.com', '0983862266', 13, '2018-06-13 04:20:36', 1),
(3, '0915910400', '1e5eeb40a3fce716b244599862fd2200', 'Dalthon  Mauricio Vera Orrala', 'dalve29@gmail.com', '0993661296', 10, '2018-06-13 04:20:36', 2),
(4, 'demomundial', '075f07b8fb4280a8ef2310b6f13494a6', 'Demo Mundial', 'demo@mail.com', '0999999999', 0, '2018-06-15 10:00:38', 2),
(5, '0918671017', '0384f9417161ce3c5c826b1c15d0a751', 'Jhonny Javier Parrales Ramírez', 'johnnyjavier2040@gmail.com', '0992748925', 10, '2018-06-17 12:57:52', 2),
(6, '0920471588', 'a28648e6793cefd224bbd96f72189d2c', 'Denisse Adriana Ochoa Cevallos', 'denochoa@hotmail.com', '0985760243', 10, '2018-06-17 13:35:00', 1),
(7, '0926532953', 'd9c4e98d13dfa327b5c98d7e00f933a0', 'Henry Antonio Lomas Ascencio', 'henry.lomas.a@gmail.com', '0979124796', 5, '2018-06-17 16:20:06', 1),
(8, '0926465949', '39125a89d12db82ba9f4656cab09ce52', 'Edwin Enrique Hermenejildo Reyes', 'edwinhermenejildo@gmail.com', '0939903054', 10, '2018-06-17 16:53:43', 1),
(9, '0917556029', '85ad8a61a364c0f800076d97e2cbad5b', 'Elizabeth Monserrat Bravo Mite', 'embravom@gmail.com', '0997437999', 10, '2018-06-17 17:10:16', 1),
(10, '0927628586', 'da56d057fe13171851e819d9be266cf5', 'Daniel Andrés Tigse Palma', 'danieltp15@hotmail.com', '0993740474', 10, '2018-06-19 09:55:29', 1),
(11, '0703689745', '71efacde22df43f9b443ed0ba2dbb59c', 'José Benito Valarezo Loor', 'benito.valarezo@gmail.com', '0995772925', 10, '2018-06-19 12:56:52', 1),
(12, '0704277532', 'a6a8cb58aed48e9376fb5c28a9c6f6dd', 'Santiago Eduardo Valarezo Loor', 'santiago.evl@gmail.com', '0992842265', 10, '2018-06-20 12:16:44', 1),
(13, '0922632146', 'e2123ce4618e73fa5a9070258528a905', 'Henry Danny Mera Parrales', 'henrymera1828@gmail.com', '0991579301', 10, '2018-06-23 11:07:40', 1),
(14, '2400088163', '2b27806676f152808879a10a18ab8f55', 'José Arturo Muñoz Borbor', 'arturmbor@gmail.com', '0939456977', 10, '2018-06-25 11:14:57', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apuesta`
--

CREATE TABLE `apuesta` (
  `id` int(11) NOT NULL,
  `id_pronostico_apostador_1` int(11) NOT NULL,
  `id_pronostico_apostador_2` int(11) DEFAULT NULL,
  `monto` float NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` int(11) NOT NULL COMMENT '1 = Emparejada, 0 = Sin contrincante'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `apuesta`
--

INSERT INTO `apuesta` (`id`, `id_pronostico_apostador_1`, `id_pronostico_apostador_2`, `monto`, `fecha`, `estado`) VALUES
(1, 1, 2, 1, '2018-06-14 13:09:07', 1),
(2, 6, 7, 2, '2018-06-15 10:27:08', 1),
(3, 3, NULL, 3, '2018-06-15 01:22:29', 0),
(4, 4, 33, 1, '2018-06-15 01:23:21', 1),
(5, 5, NULL, 3, '2018-06-15 10:13:11', 0),
(12, 8, 9, 1, '2018-06-15 10:29:56', 1),
(13, 10, NULL, 2, '2018-06-15 10:34:01', 0),
(14, 12, NULL, 1, '2018-06-17 09:08:43', 0),
(15, 13, NULL, 2, '2018-06-17 09:31:11', 0),
(16, 14, 15, 1, '2018-06-17 12:58:57', 1),
(17, 16, 17, 1, '2018-06-17 13:01:59', 1),
(18, 18, 24, 0.3, '2018-06-17 16:11:03', 1),
(19, 19, 27, 0.5, '2018-06-17 16:12:03', 1),
(20, 20, NULL, 0.5, '2018-06-17 18:02:52', 0),
(21, 21, 32, 0.5, '2018-06-17 18:04:38', 1),
(22, 22, 28, 0.5, '2018-06-17 18:04:58', 1),
(23, 23, NULL, 0.3, '2018-06-17 22:01:51', 0),
(24, 25, 36, 0.5, '2018-06-17 22:47:55', 1),
(25, 26, NULL, 0.5, '2018-06-17 22:48:28', 0),
(26, 29, 43, 1, '2018-06-17 23:26:26', 1),
(27, 30, 39, 0.3, '2018-06-17 23:49:25', 1),
(28, 31, NULL, 2, '2018-06-18 08:48:46', 0),
(29, 34, 35, 0.2, '2018-06-18 09:27:04', 1),
(30, 37, 44, 0.3, '2018-06-18 10:21:36', 1),
(31, 38, 49, 0.3, '2018-06-18 10:22:11', 1),
(32, 40, 41, 0.3, '2018-06-18 12:18:24', 1),
(33, 42, NULL, 1, '2018-06-18 12:46:41', 0),
(34, 45, 47, 1, '2018-06-18 14:51:12', 1),
(35, 46, 54, 0.8, '2018-06-18 14:57:55', 1),
(36, 48, 61, 0.3, '2018-06-18 22:16:42', 1),
(37, 50, 55, 1, '2018-06-19 08:19:24', 1),
(38, 51, 53, 1, '2018-06-19 08:21:19', 1),
(39, 52, 56, 1, '2018-06-19 08:23:16', 1),
(40, 57, 58, 0.99, '2018-06-19 10:09:42', 1),
(41, 59, NULL, 1, '2018-06-19 10:16:49', 0),
(42, 60, 63, 0.5, '2018-06-19 10:17:25', 1),
(43, 62, 64, 1, '2018-06-19 13:08:13', 1),
(44, 65, 67, 0.5, '2018-06-19 14:24:48', 1),
(45, 66, NULL, 0.5, '2018-06-19 14:29:34', 0),
(46, 68, 81, 0.5, '2018-06-19 14:34:53', 1),
(47, 69, 71, 1, '2018-06-19 14:56:59', 1),
(48, 70, 72, 1.1, '2018-06-19 14:58:54', 1),
(49, 73, NULL, 0.3, '2018-06-20 09:57:56', 0),
(50, 74, 78, 1, '2018-06-20 11:20:54', 1),
(51, 75, 80, 0.5, '2018-06-20 11:57:40', 1),
(52, 76, 82, 1, '2018-06-20 12:26:05', 1),
(53, 77, 79, 0.5, '2018-06-20 12:27:20', 1),
(54, 83, 87, 0.9, '2018-06-20 13:00:23', 1),
(55, 84, 86, 0.9, '2018-06-20 13:00:39', 1),
(56, 85, 109, 0.9, '2018-06-20 13:00:56', 1),
(57, 88, NULL, 1.2, '2018-06-20 15:36:42', 0),
(58, 89, 90, 1, '2018-06-20 15:47:25', 1),
(59, 91, 92, 0.3, '2018-06-20 21:24:25', 1),
(60, 93, 99, 0.5, '2018-06-21 07:41:18', 1),
(61, 94, 100, 1, '2018-06-21 07:42:30', 1),
(62, 95, 96, 1, '2018-06-21 09:05:24', 1),
(63, 97, 98, 1, '2018-06-21 09:25:35', 1),
(64, 101, 115, 0.5, '2018-06-21 13:22:48', 1),
(65, 102, 107, 1, '2018-06-21 13:23:58', 1),
(66, 103, 106, 0.5, '2018-06-21 13:24:36', 1),
(67, 104, 108, 1, '2018-06-21 16:24:59', 1),
(68, 105, NULL, 1, '2018-06-21 17:37:18', 0),
(69, 110, 118, 1, '2018-06-22 14:09:54', 1),
(70, 111, 114, 0.5, '2018-06-22 14:10:03', 1),
(71, 112, 113, 1, '2018-06-22 14:10:19', 1),
(72, 116, 117, 1, '2018-06-22 23:02:59', 1),
(73, 119, NULL, 1, '2018-06-23 11:36:53', 0),
(74, 120, NULL, 1, '2018-06-23 11:36:55', 0),
(75, 121, 123, 0.9, '2018-06-23 13:27:04', 1),
(76, 122, 133, 0.9, '2018-06-23 15:07:52', 1),
(77, 124, 126, 0.9, '2018-06-24 12:29:10', 1),
(78, 125, 132, 0.9, '2018-06-24 12:29:40', 1),
(79, 127, 131, 2, '2018-06-24 15:12:59', 1),
(80, 128, 130, 1, '2018-06-24 15:13:56', 1),
(81, 129, NULL, 1, '2018-06-24 15:18:26', 0),
(82, 134, 150, 1, '2018-06-25 08:11:27', 1),
(83, 135, 136, 1, '2018-06-25 10:05:07', 1),
(84, 137, 155, 0.5, '2018-06-25 11:08:13', 1),
(85, 138, 139, 0.5, '2018-06-25 11:08:49', 1),
(86, 140, NULL, 1, '2018-06-25 11:33:59', 0),
(87, 141, NULL, 1, '2018-06-25 11:33:59', 0),
(88, 142, 175, 1, '2018-06-25 11:34:51', 1),
(89, 143, 151, 1, '2018-06-25 11:35:29', 1),
(90, 144, NULL, 1, '2018-06-25 11:35:29', 0),
(91, 145, 148, 1, '2018-06-25 11:43:59', 1),
(92, 146, NULL, 1, '2018-06-25 11:44:43', 0),
(93, 147, 156, 1, '2018-06-25 11:55:57', 1),
(94, 152, 158, 0.5, '2018-06-25 12:16:05', 1),
(95, 153, 157, 1, '2018-06-25 12:17:05', 1),
(96, 154, NULL, 0.3, '2018-06-25 12:26:42', 0),
(97, 159, 162, 0.3, '2018-06-25 16:07:16', 1),
(98, 160, 168, 0.5, '2018-06-25 16:08:02', 1),
(99, 161, 166, 0.5, '2018-06-25 16:08:03', 1),
(100, 163, 171, 0.8, '2018-06-25 17:06:32', 1),
(101, 164, 170, 0.8, '2018-06-25 17:07:54', 1),
(102, 165, 172, 0.8, '2018-06-25 17:08:38', 1),
(103, 167, 169, 1, '2018-06-25 17:13:04', 1),
(104, 173, 174, 0.8, '2018-06-26 08:50:04', 1),
(105, 176, 179, 1, '2018-06-26 08:56:00', 1),
(106, 177, 180, 2, '2018-06-26 08:56:32', 1),
(107, 178, 181, 1, '2018-06-26 08:57:12', 1),
(108, 182, 184, 1, '2018-06-26 10:57:52', 1),
(109, 183, 185, 1, '2018-06-26 11:00:04', 1),
(110, 186, NULL, 1, '2018-06-26 14:55:44', 0),
(111, 187, 193, 1, '2018-06-26 14:55:55', 1),
(112, 188, 191, 2, '2018-06-26 15:03:21', 1),
(113, 189, NULL, 1, '2018-06-26 15:04:14', 0),
(114, 190, 192, 1, '2018-06-26 15:19:05', 1),
(115, 194, 200, 1, '2018-06-27 11:09:54', 1),
(116, 195, 197, 1, '2018-06-27 11:09:58', 1),
(117, 196, 199, 0.5, '2018-06-27 11:10:27', 1),
(118, 198, NULL, 0.5, '2018-06-27 11:23:27', 0),
(119, 201, 206, 0.5, '2018-06-27 14:38:40', 1),
(120, 202, 205, 0.4, '2018-06-27 14:48:23', 1),
(121, 207, 211, 0.5, '2018-06-28 08:46:18', 1),
(122, 208, NULL, 0.5, '2018-06-28 08:46:46', 0),
(123, 209, 210, 1, '2018-06-28 09:21:59', 1),
(124, 212, 227, 1, '2018-06-28 12:06:13', 1),
(125, 213, 215, 1, '2018-06-28 12:59:15', 1),
(126, 214, 216, 1, '2018-06-28 12:59:38', 1),
(127, 217, 224, 0.5, '2018-06-28 15:51:08', 1),
(128, 218, NULL, 1, '2018-06-28 15:51:09', 0),
(129, 219, 220, 0.8, '2018-06-28 15:52:44', 1),
(130, 221, 226, 1, '2018-06-28 15:59:58', 1),
(131, 222, 229, 1, '2018-06-28 16:00:28', 1),
(132, 223, NULL, 1, '2018-06-28 16:01:03', 0),
(133, 225, NULL, 0.3, '2018-06-28 16:01:17', 0),
(134, 228, NULL, 0.8, '2018-06-28 16:17:38', 0),
(135, 230, NULL, 1, '2018-06-28 16:28:30', 0),
(136, 231, NULL, 1, '2018-06-28 16:28:59', 0);

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
(3, 184, 67, '2018-06-19 13:00:00', 3, 1, NULL, NULL, 1, 'A', 3),
(4, 229, 11, '2018-06-20 10:00:00', 1, 0, NULL, NULL, 1, 'A', 3),
(5, 11, 67, '2018-06-25 09:00:00', 2, 1, NULL, NULL, 1, 'A', 3),
(6, 229, 184, '2018-06-25 09:00:00', 3, 0, NULL, NULL, 1, 'A', 3),
(7, 140, 107, '2018-06-15 10:00:00', 0, 1, NULL, NULL, 1, 'B', 3),
(8, 177, 73, '2018-06-15 13:00:00', 3, 3, NULL, NULL, 1, 'B', 3),
(9, 177, 140, '2018-06-20 07:00:00', 1, 0, NULL, NULL, 1, 'B', 3),
(10, 107, 73, '2018-06-20 13:00:00', 0, 1, NULL, NULL, 1, 'B', 3),
(11, 73, 140, '2018-06-25 13:00:00', 2, 2, NULL, NULL, 1, 'B', 3),
(13, 107, 177, '2018-06-25 13:00:00', 1, 1, NULL, NULL, 1, 'B', 3),
(14, 82, 16, '2018-06-16 05:00:00', 2, 1, NULL, NULL, 1, 'C', 3),
(15, 173, 63, '2018-06-16 11:00:00', 0, 1, NULL, NULL, 1, 'C', 3),
(16, 82, 173, '2018-06-21 10:00:00', 1, 0, NULL, NULL, 1, 'C', 3),
(17, 63, 16, '2018-06-21 07:00:00', 1, 1, NULL, NULL, 1, 'C', 3),
(18, 16, 173, '2018-06-26 09:00:00', 0, 2, NULL, NULL, 1, 'C', 3),
(19, 63, 82, '2018-06-26 09:00:00', 0, 0, NULL, NULL, 1, 'C', 3),
(20, 13, 110, '2018-06-16 08:00:00', 1, 1, NULL, NULL, 1, 'D', 3),
(21, 61, 159, '2018-06-16 14:00:00', 2, 0, NULL, NULL, 1, 'D', 3),
(22, 13, 61, '2018-06-21 13:00:00', 0, 3, NULL, NULL, 1, 'D', 3),
(23, 159, 110, '2018-06-22 10:00:00', 2, 0, NULL, NULL, 1, 'D', 3),
(24, 110, 61, '2018-06-26 13:00:00', 1, 2, NULL, NULL, 1, 'D', 3),
(25, 159, 13, '2018-06-26 13:00:00', 1, 2, NULL, NULL, 1, 'D', 3),
(26, 60, 242, '2018-06-17 07:00:00', 0, 1, NULL, NULL, 1, 'E', 3),
(27, 33, 208, '2018-06-17 13:00:00', 1, 1, NULL, NULL, 1, 'E', 3),
(28, 33, 60, '2018-06-22 07:00:00', 2, 0, NULL, NULL, 1, 'E', 3),
(29, 242, 208, '2018-06-22 13:00:00', 1, 2, NULL, NULL, 1, 'E', 3),
(30, 208, 60, '2018-06-27 13:00:00', 2, 2, NULL, NULL, 1, 'E', 3),
(31, 242, 33, '2018-06-27 13:00:00', 0, 2, NULL, NULL, 1, 'E', 3),
(32, 4, 146, '2018-06-17 10:00:00', 0, 1, NULL, NULL, 1, 'F', 3),
(33, 207, 58, '2018-06-18 07:00:00', 1, 0, NULL, NULL, 1, 'F', 3),
(34, 4, 207, '2018-06-23 13:00:00', 2, 1, NULL, NULL, 1, 'F', 3),
(35, 58, 146, '2018-06-23 10:00:00', 1, 2, NULL, NULL, 1, 'F', 3),
(36, 146, 207, '2018-06-27 09:00:00', 0, 3, NULL, NULL, 1, 'F', 3),
(37, 58, 4, '2018-06-27 09:00:00', 2, 0, NULL, NULL, 1, 'F', 3),
(38, 24, 170, '2018-06-18 10:00:00', 3, 0, NULL, NULL, 1, 'G', 3),
(39, 222, 241, '2018-06-18 13:00:00', 1, 2, NULL, NULL, 1, 'G', 3),
(40, 24, 222, '2018-06-23 07:00:00', 5, 2, NULL, NULL, 1, 'G', 3),
(41, 241, 170, '2018-06-24 07:00:00', 6, 1, NULL, NULL, 1, 'G', 3),
(42, 170, 222, '2018-06-28 13:00:00', 1, 2, NULL, NULL, 1, 'G', 3),
(43, 241, 24, '2018-06-28 13:00:00', 0, 1, NULL, NULL, 1, 'G', 3),
(44, 176, 196, '2018-06-19 10:00:00', 1, 2, NULL, NULL, 1, 'H', 3),
(45, 52, 114, '2018-06-19 07:00:00', 1, 2, NULL, NULL, 1, 'H', 3),
(46, 114, 196, '2018-06-24 10:00:00', 2, 2, NULL, NULL, 1, 'H', 3),
(47, 176, 52, '2018-06-24 13:00:00', 0, 3, NULL, NULL, 1, 'H', 3),
(48, 196, 52, '2018-06-28 09:00:00', 0, 1, NULL, NULL, 1, 'H', 3),
(49, 114, 176, '2018-06-28 09:00:00', 0, 1, NULL, NULL, 1, 'H', 3),
(50, 229, 177, '2018-06-30 13:00:00', NULL, NULL, NULL, NULL, 2, '8', 1),
(51, 73, 184, '2018-07-01 09:00:00', NULL, NULL, NULL, NULL, 2, '8', 1),
(52, 82, 13, '2018-06-30 09:00:00', NULL, NULL, NULL, NULL, 2, '8', 1),
(53, 61, 63, '2018-07-01 13:00:00', NULL, NULL, NULL, NULL, 2, '8', 1),
(54, 33, 146, '2018-07-02 09:00:00', NULL, NULL, NULL, NULL, 2, '8', 1),
(55, 207, 208, '2018-07-03 09:00:00', NULL, NULL, NULL, NULL, 2, '8', 1),
(56, 24, 114, '2018-07-02 13:00:00', NULL, NULL, NULL, NULL, 2, '8', 1),
(57, 52, 241, '2018-07-03 13:00:00', NULL, NULL, NULL, NULL, 2, '8', 1);

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
(11, 9, 2, 2, '2018-06-15 22:35:06', 1),
(12, 32, 1, 2, '2018-06-17 09:08:43', 1),
(13, 32, 2, 3, '2018-06-17 09:31:11', 1),
(14, 27, 5, 1, '2018-06-17 12:58:57', 1),
(15, 27, 2, 3, '2018-06-17 13:01:05', 1),
(16, 27, 5, 1, '2018-06-17 13:01:59', 1),
(17, 27, 1, 2, '2018-06-17 13:07:06', 1),
(18, 33, 1, 1, '2018-06-17 16:11:03', 1),
(19, 38, 1, 3, '2018-06-17 16:12:03', 1),
(20, 33, 5, 1, '2018-06-17 18:02:52', 1),
(21, 39, 5, 2, '2018-06-17 18:04:38', 1),
(22, 38, 5, 3, '2018-06-17 18:04:58', 1),
(23, 33, 7, 1, '2018-06-17 22:01:51', 1),
(24, 33, 7, 3, '2018-06-17 22:37:50', 1),
(25, 39, 8, 2, '2018-06-17 22:47:55', 1),
(26, 33, 8, 1, '2018-06-17 22:48:28', 1),
(27, 38, 8, 1, '2018-06-17 22:52:47', 1),
(28, 38, 6, 1, '2018-06-17 23:25:18', 1),
(29, 45, 6, 1, '2018-06-17 23:26:26', 1),
(30, 45, 7, 1, '2018-06-17 23:49:25', 1),
(31, 38, 2, 1, '2018-06-18 08:48:46', 1),
(32, 39, 1, 3, '2018-06-18 09:06:19', 1),
(33, 3, 3, 1, '2018-06-18 09:24:44', 1),
(34, 38, 3, 2, '2018-06-18 09:27:04', 1),
(35, 38, 1, 1, '2018-06-18 09:27:32', 1),
(36, 39, 9, 3, '2018-06-18 10:20:32', 1),
(37, 45, 9, 1, '2018-06-18 10:21:36', 1),
(38, 3, 9, 1, '2018-06-18 10:22:11', 1),
(39, 45, 3, 2, '2018-06-18 12:11:22', 1),
(40, 39, 3, 1, '2018-06-18 12:18:24', 1),
(41, 39, 1, 2, '2018-06-18 12:19:13', 1),
(42, 39, 3, 1, '2018-06-18 12:46:41', 1),
(43, 45, 8, 2, '2018-06-18 13:38:03', 1),
(44, 45, 8, 2, '2018-06-18 13:38:13', 1),
(45, 45, 1, 2, '2018-06-18 14:51:12', 1),
(46, 44, 1, 2, '2018-06-18 14:57:55', 1),
(47, 45, 6, 1, '2018-06-18 15:14:47', 1),
(48, 9, 7, 1, '2018-06-18 22:16:42', 1),
(49, 3, 1, 3, '2018-06-19 07:08:15', 1),
(50, 44, 3, 3, '2018-06-19 08:19:24', 1),
(51, 3, 2, 3, '2018-06-19 08:21:19', 1),
(52, 3, 5, 2, '2018-06-19 08:23:16', 1),
(53, 3, 6, 1, '2018-06-19 09:04:04', 1),
(54, 44, 10, 1, '2018-06-19 10:03:11', 1),
(55, 44, 10, 1, '2018-06-19 10:03:24', 1),
(56, 3, 10, 1, '2018-06-19 10:03:40', 1),
(57, 4, 10, 2, '2018-06-19 10:09:42', 1),
(58, 4, 8, 1, '2018-06-19 10:15:09', 1),
(59, 3, 8, 1, '2018-06-19 10:16:49', 1),
(60, 9, 8, 1, '2018-06-19 10:17:25', 1),
(61, 9, 3, 3, '2018-06-19 10:18:00', 1),
(62, 4, 1, 3, '2018-06-19 13:08:13', 1),
(63, 9, 11, 3, '2018-06-19 14:01:51', 1),
(64, 4, 11, 1, '2018-06-19 14:02:23', 1),
(65, 17, 11, 1, '2018-06-19 14:24:48', 1),
(66, 10, 8, 2, '2018-06-19 14:29:34', 1),
(67, 17, 8, 2, '2018-06-19 14:31:58', 1),
(68, 10, 11, 2, '2018-06-19 14:34:53', 1),
(69, 9, 3, 3, '2018-06-19 14:56:59', 1),
(70, 4, 2, 3, '2018-06-19 14:58:54', 1),
(71, 9, 10, 1, '2018-06-19 15:00:32', 1),
(72, 4, 11, 1, '2018-06-19 15:40:36', 1),
(73, 4, 7, 1, '2018-06-20 09:57:56', 1),
(74, 22, 11, 2, '2018-06-20 11:20:54', 1),
(75, 22, 11, 3, '2018-06-20 11:57:40', 1),
(76, 10, 12, 2, '2018-06-20 12:26:05', 1),
(77, 17, 12, 3, '2018-06-20 12:27:20', 1),
(78, 22, 10, 1, '2018-06-20 12:39:41', 1),
(79, 17, 8, 2, '2018-06-20 12:52:10', 1),
(80, 22, 8, 1, '2018-06-20 12:52:22', 1),
(81, 10, 3, 3, '2018-06-20 12:58:01', 1),
(82, 10, 2, 3, '2018-06-20 12:59:55', 1),
(83, 16, 10, 1, '2018-06-20 13:00:23', 1),
(84, 22, 10, 1, '2018-06-20 13:00:39', 1),
(85, 28, 10, 1, '2018-06-20 13:00:56', 1),
(86, 22, 11, 2, '2018-06-20 13:51:54', 1),
(87, 16, 11, 3, '2018-06-20 13:52:33', 1),
(88, 28, 12, 1, '2018-06-20 15:36:42', 1),
(89, 22, 11, 2, '2018-06-20 15:47:25', 1),
(90, 22, 12, 1, '2018-06-20 15:47:48', 1),
(91, 16, 9, 1, '2018-06-20 21:24:25', 1),
(92, 16, 1, 2, '2018-06-21 07:15:50', 1),
(93, 29, 6, 2, '2018-06-21 07:41:18', 1),
(94, 22, 6, 1, '2018-06-21 07:42:30', 1),
(95, 16, 2, 2, '2018-06-21 09:05:24', 1),
(96, 16, 6, 1, '2018-06-21 09:19:50', 1),
(97, 16, 2, 2, '2018-06-21 09:25:35', 1),
(98, 16, 12, 1, '2018-06-21 09:30:14', 1),
(99, 29, 12, 3, '2018-06-21 11:00:26', 1),
(100, 22, 1, 2, '2018-06-21 12:03:22', 1),
(101, 40, 11, 1, '2018-06-21 13:22:48', 1),
(102, 29, 11, 2, '2018-06-21 13:23:58', 1),
(103, 23, 11, 1, '2018-06-21 13:24:36', 1),
(104, 23, 11, 2, '2018-06-21 16:24:59', 1),
(105, 23, 12, 2, '2018-06-21 17:37:18', 1),
(106, 23, 12, 2, '2018-06-21 17:38:02', 1),
(107, 29, 1, 1, '2018-06-21 19:11:14', 1),
(108, 23, 1, 3, '2018-06-22 06:58:45', 1),
(109, 28, 1, 2, '2018-06-22 06:59:30', 1),
(110, 46, 11, 1, '2018-06-22 14:09:54', 1),
(111, 46, 11, 3, '2018-06-22 14:10:03', 1),
(112, 34, 11, 3, '2018-06-22 14:10:19', 1),
(113, 34, 1, 1, '2018-06-22 14:40:41', 1),
(114, 46, 6, 1, '2018-06-22 15:32:38', 1),
(115, 40, 6, 3, '2018-06-22 15:32:59', 1),
(116, 35, 1, 2, '2018-06-22 23:02:59', 1),
(117, 35, 11, 3, '2018-06-22 23:11:17', 1),
(118, 46, 13, 2, '2018-06-23 11:35:18', 1),
(119, 34, 13, 1, '2018-06-23 11:36:53', 1),
(120, 34, 13, 1, '2018-06-23 11:36:55', 1),
(121, 47, 11, 1, '2018-06-23 13:27:04', 1),
(122, 5, 11, 2, '2018-06-23 15:07:52', 1),
(123, 47, 1, 2, '2018-06-24 12:07:15', 1),
(124, 6, 11, 2, '2018-06-24 12:29:10', 1),
(125, 6, 11, 3, '2018-06-24 12:29:40', 1),
(126, 6, 6, 1, '2018-06-24 14:39:09', 1),
(127, 6, 2, 1, '2018-06-24 15:12:59', 1),
(128, 5, 2, 3, '2018-06-24 15:13:56', 1),
(129, 13, 2, 2, '2018-06-24 15:18:26', 1),
(130, 5, 11, 2, '2018-06-24 19:51:54', 1),
(131, 6, 11, 2, '2018-06-24 19:52:23', 1),
(132, 6, 1, 1, '2018-06-25 08:10:41', 1),
(133, 5, 1, 3, '2018-06-25 08:11:01', 1),
(134, 11, 1, 1, '2018-06-25 08:11:27', 1),
(135, 19, 2, 3, '2018-06-25 10:05:07', 1),
(136, 19, 11, 2, '2018-06-25 10:16:46', 1),
(137, 18, 11, 1, '2018-06-25 11:08:13', 1),
(138, 25, 11, 1, '2018-06-25 11:08:49', 1),
(139, 25, 14, 2, '2018-06-25 11:29:24', 1),
(140, 13, 14, 2, '2018-06-25 11:33:59', 1),
(141, 13, 14, 2, '2018-06-25 11:33:59', 1),
(142, 25, 14, 2, '2018-06-25 11:34:51', 1),
(143, 11, 14, 1, '2018-06-25 11:35:29', 1),
(144, 11, 14, 1, '2018-06-25 11:35:29', 1),
(145, 11, 9, 1, '2018-06-25 11:43:59', 1),
(146, 13, 9, 2, '2018-06-25 11:44:43', 1),
(147, 18, 9, 1, '2018-06-25 11:55:57', 1),
(148, 11, 1, 3, '2018-06-25 11:58:02', 1),
(149, 11, 3, 3, '2018-06-25 12:00:10', 1),
(150, 11, 8, 2, '2018-06-25 12:02:25', 1),
(151, 11, 8, 2, '2018-06-25 12:02:32', 1),
(152, 18, 6, 2, '2018-06-25 12:16:05', 1),
(153, 25, 6, 2, '2018-06-25 12:17:05', 1),
(154, 11, 7, 1, '2018-06-25 12:26:42', 1),
(155, 18, 10, 2, '2018-06-25 14:18:08', 1),
(156, 18, 10, 2, '2018-06-25 14:18:12', 1),
(157, 25, 1, 1, '2018-06-25 15:12:03', 1),
(158, 18, 14, 1, '2018-06-25 15:15:06', 1),
(159, 24, 9, 2, '2018-06-25 16:07:16', 1),
(160, 25, 9, 1, '2018-06-25 16:08:02', 1),
(161, 25, 9, 1, '2018-06-25 16:08:03', 1),
(162, 24, 11, 1, '2018-06-25 16:20:06', 1),
(163, 19, 1, 1, '2018-06-25 17:06:32', 1),
(164, 18, 1, 2, '2018-06-25 17:07:54', 1),
(165, 24, 1, 2, '2018-06-25 17:08:38', 1),
(166, 25, 1, 3, '2018-06-25 17:09:37', 1),
(167, 36, 1, 1, '2018-06-25 17:13:04', 1),
(168, 25, 8, 2, '2018-06-26 08:39:54', 1),
(169, 36, 8, 3, '2018-06-26 08:40:09', 1),
(170, 18, 8, 1, '2018-06-26 08:40:18', 1),
(171, 19, 8, 2, '2018-06-26 08:40:29', 1),
(172, 24, 8, 3, '2018-06-26 08:40:51', 1),
(173, 19, 1, 1, '2018-06-26 08:50:04', 1),
(174, 19, 13, 2, '2018-06-26 08:53:48', 1),
(175, 25, 13, 3, '2018-06-26 08:54:14', 1),
(176, 24, 2, 2, '2018-06-26 08:56:00', 1),
(177, 25, 2, 2, '2018-06-26 08:56:32', 1),
(178, 36, 2, 1, '2018-06-26 08:57:12', 1),
(179, 24, 14, 3, '2018-06-26 08:59:11', 1),
(180, 25, 14, 1, '2018-06-26 08:59:23', 1),
(181, 36, 14, 3, '2018-06-26 08:59:42', 1),
(182, 25, 5, 1, '2018-06-26 10:57:52', 1),
(183, 24, 3, 2, '2018-06-26 11:00:04', 1),
(184, 25, 10, 2, '2018-06-26 12:20:43', 1),
(185, 24, 13, 3, '2018-06-26 12:36:25', 1),
(186, 31, 8, 2, '2018-06-26 14:55:44', 1),
(187, 48, 8, 2, '2018-06-26 14:55:55', 1),
(188, 48, 2, 2, '2018-06-26 15:03:21', 1),
(189, 37, 2, 2, '2018-06-26 15:04:14', 1),
(190, 30, 1, 1, '2018-06-26 15:19:05', 1),
(191, 48, 1, 1, '2018-06-26 15:19:53', 1),
(192, 30, 13, 2, '2018-06-26 17:03:44', 1),
(193, 48, 1, 3, '2018-06-27 07:42:10', 1),
(194, 43, 12, 2, '2018-06-27 11:09:54', 1),
(195, 43, 12, 2, '2018-06-27 11:09:58', 1),
(196, 49, 12, 1, '2018-06-27 11:10:27', 1),
(197, 43, 2, 3, '2018-06-27 11:13:39', 1),
(198, 30, 9, 1, '2018-06-27 11:23:27', 1),
(199, 49, 11, 2, '2018-06-27 11:27:11', 1),
(200, 43, 11, 1, '2018-06-27 11:27:19', 1),
(201, 42, 11, 2, '2018-06-27 14:38:40', 1),
(202, 48, 11, 3, '2018-06-27 14:48:23', 1),
(203, 48, 2, 2, '2018-06-27 16:26:24', 1),
(204, 48, 2, 2, '2018-06-27 16:26:53', 1),
(205, 48, 2, 2, '2018-06-27 16:26:54', 1),
(206, 42, 8, 1, '2018-06-28 08:43:32', 1),
(207, 52, 8, 2, '2018-06-28 08:46:18', 1),
(208, 49, 8, 1, '2018-06-28 08:46:46', 1),
(209, 43, 2, 1, '2018-06-28 09:21:59', 1),
(210, 43, 14, 3, '2018-06-28 11:04:19', 1),
(211, 52, 14, 1, '2018-06-28 11:04:35', 1),
(212, 51, 10, 1, '2018-06-28 12:06:13', 1),
(213, 52, 10, 2, '2018-06-28 12:59:15', 1),
(214, 50, 10, 1, '2018-06-28 12:59:38', 1),
(215, 52, 14, 1, '2018-06-28 15:09:02', 1),
(216, 50, 14, 2, '2018-06-28 15:09:18', 1),
(217, 50, 11, 1, '2018-06-28 15:51:08', 1),
(218, 54, 10, 1, '2018-06-28 15:51:09', 1),
(219, 53, 11, 2, '2018-06-28 15:52:44', 1),
(220, 53, 2, 1, '2018-06-28 15:55:53', 1),
(221, 52, 2, 2, '2018-06-28 15:59:58', 1),
(222, 50, 2, 1, '2018-06-28 16:00:28', 1),
(223, 54, 2, 1, '2018-06-28 16:01:03', 1),
(224, 50, 7, 2, '2018-06-28 16:01:08', 1),
(225, 52, 7, 1, '2018-06-28 16:01:17', 1),
(226, 52, 13, 1, '2018-06-28 16:10:31', 1),
(227, 51, 13, 2, '2018-06-28 16:10:52', 1),
(228, 55, 11, 1, '2018-06-28 16:17:38', 1),
(229, 50, 11, 2, '2018-06-28 16:18:30', 1),
(230, 56, 13, 1, '2018-06-28 16:28:30', 1),
(231, 57, 13, 1, '2018-06-28 16:28:59', 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `apuesta`
--
ALTER TABLE `apuesta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT de la tabla `pais`
--
ALTER TABLE `pais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=243;

--
-- AUTO_INCREMENT de la tabla `partido`
--
ALTER TABLE `partido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de la tabla `pronostico`
--
ALTER TABLE `pronostico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=232;

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
