-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 18-05-2015 a las 03:19:20
-- Versión del servidor: 5.6.12-log
-- Versión de PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `aerocontrol`
--
CREATE DATABASE IF NOT EXISTS `aerocontrol` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `aerocontrol`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(9) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `airline` int(11) NOT NULL,
  `seats` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `airline` (`airline`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `aircraft`
--

INSERT INTO `aircraft` (`id`, `name`, `airline`, `seats`, `type`) VALUES
(1, 'boeing 777', 1, 350, 'Pasajeros'),
(2, 'boeing 737', 2, 200, 'Pasajeros');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `airlines`
--

CREATE TABLE IF NOT EXISTS `airlines` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(300) NOT NULL,
  `logo` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `airlines`
--

INSERT INTO `airlines` (`id`, `name`, `description`, `logo`) VALUES
(1, 'TACA', 'Una aerolínea', 'TACA'),
(2, 'Avianca', 'Una aerolínea ', 'Avianca');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `airports`
--

CREATE TABLE IF NOT EXISTS `airports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `location` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `location` (`location`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `airports`
--

INSERT INTO `airports` (`id`, `name`, `location`) VALUES
(1, 'Aeropuerto El Salvador', 1),
(2, 'Aeropuerto San Fracisco', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bookings`
--

CREATE TABLE IF NOT EXISTS `bookings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `costumer` int(11) NOT NULL,
  `flight` int(11) NOT NULL,
  `seats` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `flight` (`flight`),
  KEY `costumer` (`costumer`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cities`
--

CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `zip` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `cities`
--

INSERT INTO `cities` (`id`, `city`, `state`, `zip`) VALUES
(1, 'San Salvador', 'San Salvador', 503),
(2, 'San Francisco', 'San Francisco', 1009);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `costumers`
--

CREATE TABLE IF NOT EXISTS `costumers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `birthdate` date NOT NULL,
  `phone` varchar(9) NOT NULL,
  `user` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `status` char(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `costumers`
--

INSERT INTO `costumers` (`id`, `name`, `address`, `city`, `state`, `mail`, `birthdate`, `phone`, `user`, `password`, `status`) VALUES
(2, 'ted', 'santa tecla', 'el salvador', 'la libertad', 'gerardo.antonio97@gmail.com', '1997-10-10', '1234-1234', 'tbonilla', '4297f44b13955235245b2497399d7a93', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `flights`
--

CREATE TABLE IF NOT EXISTS `flights` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `description` varchar(500) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `airline` (`airline`),
  KEY `aircraft` (`aircraft`),
  KEY `departure_city` (`departure_city`),
  KEY `arrival_city` (`arrival_city`),
  KEY `aircraft_2` (`aircraft`),
  KEY `departure_runway` (`departure_runway`),
  KEY `arrival_runway` (`arrival_runway`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `flights`
--

INSERT INTO `flights` (`id`, `airline`, `departure_time`, `departure_city`, `arrival_time`, `arrival_city`, `aircraft`, `departure_runway`, `arrival_runway`, `cost`, `seats`, `description`) VALUES
(1, 1, '2015-04-22 12:27:29', 1, '2015-04-24 04:10:10', 2, 1, 1, 2, 2500, 150, 'This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.'),
(2, 2, '2015-04-22 12:27:29', 1, '2015-04-17 04:10:10', 1, 2, 1, 2, 2500, 250, 'This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.'),
(3, 2, '2015-04-22 12:27:29', 1, '2015-04-20 08:21:22', 2, 2, 1, 1, 2500, 200, 'This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `runways`
--

CREATE TABLE IF NOT EXISTS `runways` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idairport` int(11) NOT NULL,
  `length` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idairport` (`idairport`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `phone` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `status` char(1) NOT NULL,
  `airline` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `user-airline`
--

INSERT INTO `user-airline` (`id`, `name`, `phone`, `user`, `password`, `status`, `airline`, `type`) VALUES
(1, 'ted', 12341234, 'ted', '4297f44b13955235245b2497399d7a93', '1', 2, 1);

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
