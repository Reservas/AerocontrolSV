-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-07-2015 a las 21:44:09
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `aerocontrol`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
`id` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(9) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`id`, `user`, `password`, `name`, `phone`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin', '1234-1234');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aircraft`
--

CREATE TABLE IF NOT EXISTS `aircraft` (
`id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `airline` int(11) NOT NULL,
  `seats` int(11) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `aircraft`
--

INSERT INTO `aircraft` (`id`, `name`, `airline`, `seats`, `type`) VALUES
(1, 'boeing 777', 1, 350, 'Pasajeros'),
(2, 'boeing 737', 2, 200, 'Pasajeros'),
(3, 'Airbus A300', 5, 300, 'Comercial '),
(4, 'Airbus A319', 4, 156, 'Civil'),
(5, 'Boeing B-747', 6, 524, 'Comercial '),
(6, 'Airbus A320', 4, 300, 'Comercial ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `airlines`
--

CREATE TABLE IF NOT EXISTS `airlines` (
`id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(300) NOT NULL,
  `logo` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `airlines`
--

INSERT INTO `airlines` (`id`, `name`, `description`, `logo`) VALUES
(1, 'TACA', 'Una aerolï¿½nea     ', 'TACA.gif'),
(2, 'Avianca', 'Una aerolÃ­nea      ', 'Avianca.jpg'),
(3, 'American Airlines', 'Agencia de Viajes Vuele Facil, American Airlines sirve a 260 ciudades con una flota de 612 aviones. Transporta mÃ¡s pasajeros entre Estados Unidos y AmÃ©rica Latina que cualquier otra lÃ­nea aÃ©rea', 'American Airlines.jpg'),
(4, 'Delta Airlines ', 'Agencia de Viajes Vuele Facil, Delta Airlines es una aerolÃ­nea comercial cuya base estÃ¡ situada en Atlanta en el estado de Georgia en los Estados Unidos.', 'Delta Airlines .jpg'),
(5, 'IBERIA ', 'Agencia de Viajes Vuele Facil, IBERIA es una aerolÃ­nea espaÃ±ola, cuyo nombre oficial es Iberia LÃ­neas AÃ©reas de EspaÃ±a, S.A. Es una de las compaÃ±Ã­as aÃ©reas mÃ¡s antiguas del mundo, es la cuarta aerolÃ­nea de Europa', 'IBERIA .jpg'),
(6, 'Copa Airlines ', 'Agencia de Viajes Vuele Facil le ofrece Copa Airlines es la aerolÃ­nea internacional de PanamÃ¡. Vuela 45 destinos en 24 paÃ­ses en Norte, Centro y Sur AmÃ©rica y El Caribe, ademÃ¡s Copa Airlines', 'Copa Airlines .jpg'),
(7, 'Aeromexico', 'Agencia de Viajes Vuele Facil, TACA Airlines es una empresa de aviaciÃ³n establecida en El Salvador en 1931. El nombre "TACA" se origina como Transportes AÃ©reos Centroamericanos que fue modificado a Transportes AÃ©reos del Continente', 'Aeromexico.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `airports`
--

CREATE TABLE IF NOT EXISTS `airports` (
`id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `location` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `airports`
--

INSERT INTO `airports` (`id`, `name`, `location`) VALUES
(1, 'Aeropuerto El Salvador', 1),
(2, 'Aeropuerto San Fracisco', 2),
(3, 'Aeropuerto Internacional de Ottawa', 12),
(4, 'Aeropuerto Internacional de la Ciudad de MÃ©xico', 13),
(5, 'Aeropuerto Internacional TobÃ­as BolaÃ±os', 14),
(6, 'Aeropuerto Ciudad Libertad', 15),
(7, 'Aeropuerto Comandante Espora', 3),
(8, 'Aeropuerto Apolo', 4),
(10, 'Aeropuerto Internacional de GaleÃ£o', 5),
(11, 'Aeropuerto Internacional El Dorado', 6),
(12, 'Aeropuerto Internacional GuaranÃ­', 8),
(13, 'Aeropuerto Regional', 9),
(14, 'Aeropuerto Internacional JosÃ© JoaquÃ­n de Olmedo', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bookings`
--

CREATE TABLE IF NOT EXISTS `bookings` (
`id` int(11) NOT NULL,
  `costumer` int(11) NOT NULL,
  `flight` int(11) NOT NULL,
  `seats` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cities`
--

CREATE TABLE IF NOT EXISTS `cities` (
`id` int(11) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `zip` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cities`
--

INSERT INTO `cities` (`id`, `city`, `state`, `zip`) VALUES
(1, 'San Salvador', 'El Salvador', 503),
(2, 'San Francisco', 'San Francisco', 1009),
(3, 'Buenos Aires', 'Argentina', 54),
(4, 'La Paz', 'Bolivia', 591),
(5, 'RÃ­o de Janeiro', 'Brasil', 55),
(6, 'BogotÃ¡', 'Colombia', 57),
(7, 'BogotÃ¡', 'Ecuador', 593),
(8, 'AsunciÃ³n', 'Paraguay', 595),
(9, 'Lima', 'PerÃº', 51),
(10, 'Montevideo', 'Uruguay', 598),
(11, 'Caracas', 'Venezuela', 58),
(12, 'Ottawa', 'CanÃ¡da', 1613),
(13, 'Ciudad de MÃ©xico D.F.', 'MÃ©xico', 52),
(14, 'San JosÃ©', 'Costa Rica', 506),
(15, 'La Habana', 'Cuba', 53);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `costumers`
--

CREATE TABLE IF NOT EXISTS `costumers` (
`id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `birthdate` date NOT NULL,
  `phone` varchar(9) NOT NULL,
  `user` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `status` char(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `costumers`
--

INSERT INTO `costumers` (`id`, `name`, `address`, `city`, `state`, `mail`, `birthdate`, `phone`, `user`, `password`, `status`) VALUES
(2, 'ted', 'santa tecla', 'el salvador', 'la libertad', 'gerardo.antonio97@gmail.com', '1997-10-10', '1234-1234', 'tbonilla', '4297f44b13955235245b2497399d7a93', '1'),
(3, 'Ronaldo', 'Nose', 'San Salvador', 'San Salvador', 'diego.ronaldosv@gmail.com', '0000-00-00', '22222222', 'drmh', '202cb962ac59075b964b07152d234b70', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `flights`
--

CREATE TABLE IF NOT EXISTS `flights` (
`id` int(11) NOT NULL,
  `airline` int(11) NOT NULL,
  `departure_time` datetime NOT NULL,
  `departure_city` int(11) NOT NULL,
  `arrival_time` datetime NOT NULL,
  `arrival_city` int(11) NOT NULL,
  `aircraft` int(11) NOT NULL,
  `departure_runway` int(11) NOT NULL,
  `arrival_runway` int(11) NOT NULL,
  `cost` double NOT NULL,
  `seats` int(4) NOT NULL,
  `description` varchar(500) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `flights`
--

INSERT INTO `flights` (`id`, `airline`, `departure_time`, `departure_city`, `arrival_time`, `arrival_city`, `aircraft`, `departure_runway`, `arrival_runway`, `cost`, `seats`, `description`) VALUES
(1, 1, '2015-06-25 16:30:00', 15, '2015-06-25 14:30:00', 14, 1, 1, 2, 300, 250, 'nvhvhjgvjh'),
(2, 6, '2015-06-30 21:00:00', 13, '2015-06-30 11:00:00', 11, 5, 1, 1, 250, 300, 'Tacos'),
(6, 5, '2015-06-26 19:30:00', 9, '2015-06-26 12:30:00', 12, 3, 1, 1, 350, 250, 'khghjfj'),
(7, 4, '2015-06-30 10:00:00', 4, '2015-06-23 08:00:00', 10, 4, 1, 1, 500, 100, 'Aqui'),
(8, 6, '2015-06-28 19:00:00', 3, '2015-06-28 13:00:00', 14, 5, 1, 1, 750, 300, 'Argentina'),
(9, 6, '2015-06-29 10:00:00', 10, '2015-06-29 05:00:00', 15, 5, 1, 2, 400, 200, 'Uruguay'),
(10, 1, '2015-06-27 17:00:00', 14, '2015-06-28 13:00:00', 7, 1, 1, 1, 550, 150, 'Esto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `runways`
--

CREATE TABLE IF NOT EXISTS `runways` (
`id` int(11) NOT NULL,
  `idairport` int(11) NOT NULL,
  `length` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `runways`
--

INSERT INTO `runways` (`id`, `idairport`, `length`) VALUES
(1, 1, 1000),
(2, 2, 2000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user-airline`
--

CREATE TABLE IF NOT EXISTS `user-airline` (
`id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `status` char(1) NOT NULL,
  `airline` int(11) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `user-airline`
--

INSERT INTO `user-airline` (`id`, `name`, `phone`, `user`, `password`, `status`, `airline`, `type`) VALUES
(1, 'Avianca', 12341234, 'AdminAvianca', '4297f44b13955235245b2497399d7a93', '1', 2, 1),
(2, 'Taca', 23242526, 'AdminTaca', '4297f44b13955235245b2497399d7a93', '1', 1, 1),
(3, 'Ame Air', 74345687, 'AdminAme', '4297f44b13955235245b2497399d7a93', '1', 3, 1),
(4, 'Delta Air', 23237434, 'AdminDelta', '4297f44b13955235245b2497399d7a93', '1', 4, 1),
(5, 'IBERIA', 21239845, 'AdminIbe', '4297f44b13955235245b2497399d7a93', '1', 5, 1),
(6, 'Copa Air', 76454534, 'AdminCopa', '4297f44b13955235245b2497399d7a93', '1', 6, 1),
(7, 'AeroMexico', 23457432, 'AdminAero', '4297f44b13955235245b2497399d7a93', '1', 7, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `user` (`user`);

--
-- Indices de la tabla `aircraft`
--
ALTER TABLE `aircraft`
 ADD PRIMARY KEY (`id`), ADD KEY `airline` (`airline`);

--
-- Indices de la tabla `airlines`
--
ALTER TABLE `airlines`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `airports`
--
ALTER TABLE `airports`
 ADD PRIMARY KEY (`id`), ADD KEY `location` (`location`);

--
-- Indices de la tabla `bookings`
--
ALTER TABLE `bookings`
 ADD PRIMARY KEY (`id`), ADD KEY `flight` (`flight`), ADD KEY `costumer` (`costumer`);

--
-- Indices de la tabla `cities`
--
ALTER TABLE `cities`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `costumers`
--
ALTER TABLE `costumers`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `mail` (`mail`), ADD UNIQUE KEY `user` (`user`);

--
-- Indices de la tabla `flights`
--
ALTER TABLE `flights`
 ADD PRIMARY KEY (`id`), ADD KEY `airline` (`airline`), ADD KEY `aircraft` (`aircraft`), ADD KEY `departure_city` (`departure_city`), ADD KEY `arrival_city` (`arrival_city`), ADD KEY `aircraft_2` (`aircraft`), ADD KEY `departure_runway` (`departure_runway`), ADD KEY `arrival_runway` (`arrival_runway`);

--
-- Indices de la tabla `runways`
--
ALTER TABLE `runways`
 ADD PRIMARY KEY (`id`), ADD KEY `idairport` (`idairport`);

--
-- Indices de la tabla `user-airline`
--
ALTER TABLE `user-airline`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `user` (`user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admin`
--
ALTER TABLE `admin`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `aircraft`
--
ALTER TABLE `aircraft`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `airlines`
--
ALTER TABLE `airlines`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `airports`
--
ALTER TABLE `airports`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `bookings`
--
ALTER TABLE `bookings`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `cities`
--
ALTER TABLE `cities`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `costumers`
--
ALTER TABLE `costumers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `flights`
--
ALTER TABLE `flights`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `runways`
--
ALTER TABLE `runways`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `user-airline`
--
ALTER TABLE `user-airline`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `aircraft`
--
ALTER TABLE `aircraft`
ADD CONSTRAINT `aircraft_ibfk_1` FOREIGN KEY (`airline`) REFERENCES `airlines` (`id`);

--
-- Filtros para la tabla `airports`
--
ALTER TABLE `airports`
ADD CONSTRAINT `airports_ibfk_1` FOREIGN KEY (`location`) REFERENCES `cities` (`id`);

--
-- Filtros para la tabla `bookings`
--
ALTER TABLE `bookings`
ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`flight`) REFERENCES `flights` (`id`),
ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`costumer`) REFERENCES `costumers` (`id`);

--
-- Filtros para la tabla `flights`
--
ALTER TABLE `flights`
ADD CONSTRAINT `flights_ibfk_1` FOREIGN KEY (`airline`) REFERENCES `airlines` (`id`),
ADD CONSTRAINT `flights_ibfk_2` FOREIGN KEY (`departure_city`) REFERENCES `cities` (`id`),
ADD CONSTRAINT `flights_ibfk_3` FOREIGN KEY (`arrival_city`) REFERENCES `cities` (`id`),
ADD CONSTRAINT `flights_ibfk_4` FOREIGN KEY (`aircraft`) REFERENCES `aircraft` (`id`),
ADD CONSTRAINT `flights_ibfk_5` FOREIGN KEY (`departure_runway`) REFERENCES `runways` (`id`),
ADD CONSTRAINT `flights_ibfk_6` FOREIGN KEY (`arrival_runway`) REFERENCES `runways` (`id`);

--
-- Filtros para la tabla `runways`
--
ALTER TABLE `runways`
ADD CONSTRAINT `runways_ibfk_1` FOREIGN KEY (`idairport`) REFERENCES `airports` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
