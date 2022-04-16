-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 16-04-2022 a las 16:51:49
-- Versión del servidor: 8.0.27
-- Versión de PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bodiary`
--

--
-- Volcado de datos para la tabla `training_exercises`
--

INSERT INTO `training_exercises` (`id`, `name`, `muscle`, `created_at`, `updated_at`) VALUES
(1, 'Pecho', 'Pecho', NULL, NULL),
(2, 'Bíceps', 'Bíceps', NULL, NULL),
(3, 'Tríceps', 'Tríceps', NULL, NULL),
(4, 'Hombros', 'Hombros', NULL, NULL),
(5, 'Trapecio', 'Trapecio', NULL, NULL),
(6, 'Espalda', 'Espalda', NULL, NULL),
(7, 'Cuádriceps', 'Cuádriceps', NULL, NULL),
(8, 'Isquiotibiales', 'Isquiotibiales', NULL, NULL),
(9, 'Gemelos', 'Gemelos', NULL, NULL),
(10, 'Glúteos', 'Glúteos', NULL, NULL),
(11, 'Abdominales', 'Abdominales', NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
