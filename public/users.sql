-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 16-04-2022 a las 17:00:53
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
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `email_verified_at`, `age`, `password`, `isActive`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'bodiadmin', 'admin@bodiary.com', '2022-04-13 13:30:40', NULL, '$2a$12$mdV2ldXyVpjYQ/.7q2JhYeRhLanZd0rjhijynykjZrppTsrKgDT4m', 1, 'Pi8e0T2cAH', '2022-04-13 13:30:40', '2022-04-13 13:30:40'),
(2, 2, 'emi', 'emi@gmail.com', NULL, NULL, '$2y$10$5Q/4U2/p9pGSh1kHhMO4BuVZFeVTyWVgvgN6XfJBVUCqBPwsCD.26', 1, NULL, '2022-04-16 14:59:32', '2022-04-16 14:59:32'),
(3, 2, 'Antonio', 'antonio@gmail.com', NULL, NULL, '$2y$10$We4rtNvwkgvnvFU98LggTu86mORN82TO.sei/vhRnWCf2jR2PPLlW', 1, NULL, '2022-04-16 14:59:47', '2022-04-16 14:59:47'),
(4, 2, 'Alberto', 'alberto@gmail.com', NULL, NULL, '$2y$10$E4BXn2/smeCEUTh2dNgIDO3/dlaPW4ODNkIdRbOkiIkrRSzZJ4/im', 1, NULL, '2022-04-16 14:59:59', '2022-04-16 14:59:59'),
(5, 2, 'Fernando', 'Fernando@gmail.com', NULL, NULL, '$2y$10$4DLyNVQm1QNWvNXLzy1we.KnbswrrsknC.G0XY6qBHU8awzsFnh86', 1, NULL, '2022-04-16 15:00:06', '2022-04-16 15:00:06');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
