-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-07-2023 a las 20:45:02
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `library-system`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `author`
--

CREATE TABLE `author` (
  `authorid` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `status` enum('Disponible','No Disponible') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `author`
--

INSERT INTO `author` (`authorid`, `name`, `status`) VALUES
(2, 'Alan Forbes', 'Disponible'),
(3, 'Lynn Beighley &amp; Michael Morrison', 'Disponible');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `book`
--

CREATE TABLE `book` (
  `bookid` int(11) NOT NULL,
  `categoryid` int(11) NOT NULL,
  `authorid` int(11) NOT NULL,
  `rackid` int(11) NOT NULL,
  `name` text NOT NULL,
  `picture` varchar(250) NOT NULL,
  `publisherid` int(11) NOT NULL,
  `isbn` varchar(30) NOT NULL,
  `no_of_copy` int(5) NOT NULL,
  `status` enum('Disponible','No Disponible') NOT NULL,
  `added_on` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `book`
--

INSERT INTO `book` (`bookid`, `categoryid`, `authorid`, `rackid`, `name`, `picture`, `publisherid`, `isbn`, `no_of_copy`, `status`, `added_on`, `updated_on`) VALUES
(1, 2, 2, 2, 'The Joy of PHP Programming', 'joy-php.jpg', 8, 'B00BALXN70', 10, 'Disponible', '2022-06-12 11:12:48', '2022-06-12 11:13:27'),
(2, 2, 3, 2, 'Head First PHP &amp; MySQL', 'header-first-php.jpg', 9, '0596006306', 10, 'Disponible', '2022-06-12 11:16:01', '2022-06-12 11:16:01'),
(3, 2, 2, 1, 'dsgsdgsd', '', 7, 'sdfsd2334', 23, 'Disponible', '2022-06-12 13:29:14', '2022-06-12 13:29:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoriaspdf`
--

CREATE TABLE `categoriaspdf` (
  `Id` int(10) NOT NULL,
  `nombreCategoria` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoriaspdf`
--

INSERT INTO `categoriaspdf` (`Id`, `nombreCategoria`) VALUES
(22, 'Filosofía '),
(23, 'Física'),
(25, 'Derecho'),
(28, 'Biología '),
(29, 'Historia '),
(31, 'Matemáticas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--

CREATE TABLE `category` (
  `categoryid` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `status` enum('Disponible','No Disponible') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `category`
--

INSERT INTO `category` (`categoryid`, `name`, `status`) VALUES
(1, 'Web Design', 'Disponible'),
(2, 'Programming', 'Disponible'),
(3, 'Commerce', 'Disponible'),
(4, 'Math', 'Disponible'),
(6, 'Ciencias', 'Disponible');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `issued_book`
--

CREATE TABLE `issued_book` (
  `issuebookid` int(11) NOT NULL,
  `bookid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `issue_date_time` datetime NOT NULL DEFAULT current_timestamp(),
  `expected_return_date` datetime NOT NULL,
  `return_date_time` datetime NOT NULL,
  `status` enum('Prestado','Devuelto','No Devuelto') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `issued_book`
--

INSERT INTO `issued_book` (`issuebookid`, `bookid`, `userid`, `issue_date_time`, `expected_return_date`, `return_date_time`, `status`) VALUES
(1, 2, 2, '2022-06-12 15:33:45', '2022-06-15 16:27:59', '2022-06-16 16:27:59', 'Prestado'),
(3, 3, 3, '2022-06-12 18:46:07', '2022-06-30 18:46:02', '2022-06-12 18:46:14', 'Devuelto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `librospdf`
--

CREATE TABLE `librospdf` (
  `Id` int(10) NOT NULL,
  `nombreLibro` varchar(155) NOT NULL,
  `autorLibro` varchar(155) NOT NULL,
  `imagenLibro` varchar(255) NOT NULL,
  `pdfLibro` varchar(255) NOT NULL,
  `idCategoria` int(10) NOT NULL,
  `nPaginas` enum('PDF','AUDIO','VIDEO','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `librospdf`
--

INSERT INTO `librospdf` (`Id`, `nombreLibro`, `autorLibro`, `imagenLibro`, `pdfLibro`, `idCategoria`, `nPaginas`) VALUES
(57, 'El Genoma Humano', 'Jorge Almarza', '1687371686_biologia.jpg', '1687372548_01. Genoma Humano autor Jorge Almarza.pdf', 23, 'PDF'),
(58, 'Ética a  Nicomaco', 'Aristoteles', '1687370548_Etica.png', '1687370548_11. Ética a Nicómaco autor Imprenta Nacional de Costa Rica.pdf', 22, 'PDF'),
(59, 'Física Básica ', 'Jose Ricardo Luna & Victoria Muñoz', '1687372154_Fisica.jpg', '1687372154_1. Física Básica autor José Ricardo Luna Victoria Muñoz.pdf', 23, 'PDF'),
(61, 'Manual de Derecho Penal', 'Jose Hurtado Pozo ', '1687896544_derecho.jpg', '1687896544_03. Manual de Derecho Penal autor José Hurtado Pozo.pdf', 25, 'PDF'),
(62, 'Grecia, la Civilización olvidada', 'Rafael Parra', '1687896791_grecia.jpg', '1687896791_04. Grecia, la Civilización olvidada autor Rafael Parra Machío.pdf', 29, 'PDF'),
(64, 'La primera Guerra Mundial - Parte 1', 'Apología de la Historia', '1687981683_PodcastHistoria.jpg', '1687898662_y2mate.com - La PRIMERA GUERRA MUNDIAL Parte I  Podcast 11.mp3', 29, 'AUDIO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publisher`
--

CREATE TABLE `publisher` (
  `publisherid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('Disponible','No Disponible') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `publisher`
--

INSERT INTO `publisher` (`publisherid`, `name`, `status`) VALUES
(2, 'Amazon publishing', 'Disponible'),
(3, 'Penguin books ltd.', 'Disponible'),
(4, 'Vintage Publishing', 'Disponible'),
(5, 'Macmillan Publishers', 'Disponible'),
(6, 'Simon &amp; Schuster', 'Disponible'),
(7, 'HarperCollins', 'Disponible'),
(8, 'Plum Island', 'Disponible'),
(9, 'O’Reilly', 'Disponible');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rack`
--

CREATE TABLE `rack` (
  `rackid` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `status` enum('Disponible','No Disponible') NOT NULL DEFAULT 'Disponible'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `rack`
--

INSERT INTO `rack` (`rackid`, `name`, `status`) VALUES
(1, 'R1', 'Disponible'),
(2, 'R2', 'Disponible');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) UNSIGNED NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(64) NOT NULL,
  `role` enum('admin','user') DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `password`, `role`) VALUES
(2, 'Mark', 'Wood', 'mark@phpzag.com', '202cb962ac59075b964b07152d234b70', 'user'),
(3, 'George', 'Smith', 'goerge@phpzag.com', '202cb962ac59075b964b07152d234b70', 'user'),
(4, 'Administrador', '', 'admin@easylibrary.com', '202cb962ac59075b964b07152d234b70', 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`authorid`);

--
-- Indices de la tabla `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`bookid`);

--
-- Indices de la tabla `categoriaspdf`
--
ALTER TABLE `categoriaspdf`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryid`);

--
-- Indices de la tabla `issued_book`
--
ALTER TABLE `issued_book`
  ADD PRIMARY KEY (`issuebookid`);

--
-- Indices de la tabla `librospdf`
--
ALTER TABLE `librospdf`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `idCategoria` (`idCategoria`);

--
-- Indices de la tabla `publisher`
--
ALTER TABLE `publisher`
  ADD PRIMARY KEY (`publisherid`);

--
-- Indices de la tabla `rack`
--
ALTER TABLE `rack`
  ADD PRIMARY KEY (`rackid`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `author`
--
ALTER TABLE `author`
  MODIFY `authorid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `book`
--
ALTER TABLE `book`
  MODIFY `bookid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `categoriaspdf`
--
ALTER TABLE `categoriaspdf`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `category`
--
ALTER TABLE `category`
  MODIFY `categoryid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `issued_book`
--
ALTER TABLE `issued_book`
  MODIFY `issuebookid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `librospdf`
--
ALTER TABLE `librospdf`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT de la tabla `publisher`
--
ALTER TABLE `publisher`
  MODIFY `publisherid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `rack`
--
ALTER TABLE `rack`
  MODIFY `rackid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `librospdf`
--
ALTER TABLE `librospdf`
  ADD CONSTRAINT `librospdf_ibfk_1` FOREIGN KEY (`idCategoria`) REFERENCES `categoriaspdf` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
