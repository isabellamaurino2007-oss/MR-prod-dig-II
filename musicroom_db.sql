-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 12-11-2026 a las 19:20:41
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
-- Base de datos: `musicroom_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `albums`
--

CREATE TABLE `albums` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `artista` varchar(255) NOT NULL,
  `imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `albums`
--

INSERT INTO `albums` (`id`, `titulo`, `artista`, `imagen`) VALUES
(1, 'De Vista', 'Ángela Torres', 'img/jamaisvu.jpg'),
(2, 'Sonder Son', 'Brent Faiyaz', 'img/brent.jpg'),
(3, 'StarBoy', 'The Weekend ', 'img/reggae.jpg'),
(4, 'Fine Line', 'Harry Styles', 'img/disco4.jpg'),
(5, 'Love delux', 'Sade', 'img/disco5.jpg'),
(6, 'Scorpion', 'Drake', 'img/disco6.jpg'),
(7, 'Currents', 'Tame Impala', 'img/disco7.jpg'),
(8, 'DTMF', 'Bad Bunny', 'img/disco8.jpg'),
(9, 'Dont Smile At Me', 'Billie Eilish', 'img/disco9.jpg'),
(10, 'Honeslty Nevermind', '\r\nDrake', 'img/disco10.jpg'),
(11, 'La Vida Era Mas Corta', 'Milo J \r\n', 'img/disco11.jpg'),
(12, 'The Miseducation Of Lauryn Hill', 'Ms.Lauryn Hill', 'img/disco12.jpg'),
(13, 'Songs In The Key Of Life ', 'Steve Wonder \r\n', 'img/disco13.jpg'),
(14, 'The New Abnormal', 'The Strokes', 'img/disco14.jpg'),
(15, 'My World ', 'Justin Bieber \r\n', 'img/disco15.jpg'),
(16, 'IGOR ', 'Tyler , The Creator \r\n', 'img/disco16.jpg'),
(17, 'Sour ', 'Olivia Rodrigo ', 'img/disco17.jpg'),
(18, 'Midnight Memoroies ', 'One Direction\r\n', 'img/disco18.jpg'),
(19, 'Up All Night ', 'One Direction', 'img/disco19.jpg'),
(20, 'Un Verano Sin Ti', 'Bad Bunny ', 'img/disco20.jpg'),
(21, 'Grasa', 'Serú Giran ', 'img/disco21.jpg'),
(22, 'El amor despues del amor', 'Fito Paez', 'img/disco22.jpg'),
(23, 'El camino mas largo', 'No Te Va A Gustar ', 'img/disco23.jpg'),
(24, 'Yendo De La Cama Al Living ', 'Charly Garcia ', 'img/disco24.jpg'),
(25, 'Clics Modernos ', 'Charly Garcia ', 'img/disco25.jpg'),
(26, 'Frank ', 'Amy Winehouse ', 'img/disco26.jpg'),
(28, 'Abbey Road ', 'The beatles ', 'img/disco28.jpg'),
(29, 'Off The Wall', 'Michael Jackson', 'img/disco29.jpg'),
(30, 'Xcape', 'Michael Jackson', 'img/disco30.jpg'),
(31, 'Sweetner ', 'Ariana Grande ', 'img/disco31.jpg'),
(32, 'Belive ', 'Justin Bieber ', 'img/disco32.jpg'),
(33, 'AM', 'Artik Monkey', 'img/disco33.jpg'),
(34, 'Whatever people say i am , that´s what am not.', 'Artic Monkeys', 'img/disco34.jpg'),
(35, '111', 'Milo J ', 'img/disco35.jpg'),
(36, 'Orange ', 'Frank Ocean', 'img/disco36.jpg'),
(37, 'Blond', 'Frank Ocean', 'img/disco37.jpg'),
(38, 'Hit me hard and soft ', 'Billie Eilish', 'img/disco38.jpg'),
(39, 'You Seem Pretty Sad For A Girl So In Love', 'Olivia Rodrigo', 'img/disco39.jpg'),
(40, 'Queen II', 'Queen', 'img/disco40.jpg'),
(41, '1989 (Taylor´s Version)', 'Taylor Swift', 'img/disco41.jpg'),
(42, 'Lover ', 'Taylor Swift ', 'img/disco42.jpg'),
(43, 'Reputation', 'Taylor Swift', 'img/disco43.jpg'),
(44, 'Red', 'Taylor Swift', 'img/disco44.jpg'),
(45, '1989', 'Taylor Swift', 'img/disco45.jpg'),
(46, 'Por Si Mañana No Estoy', 'Omar Courtz', 'img/disco46.jpg'),
(47, 'Primera musa', 'Omar Courtz', 'img/disco47.jpg'),
(48, 'Un mechon de  pelo', 'Tini', 'img/disco48.jpg'),
(49, 'Cupido', 'Tini', 'img/disco49.jpg'),
(50, '.mp3', 'Emilia ', 'img/disco50.jpg'),
(51, 'Antes De Ameri', 'Duki', 'img/disco51.jpg'),
(52, 'Graduation', 'Kanye West', 'img/disco52.jpg'),
(53, 'Yeezus ', 'Kanye West', 'img/disco53.jpg'),
(54, 'LOUD', 'Rihanna', 'img/disco54.jpg'),
(55, 'Anti', 'Rihanna', 'img/disco55.jpg'),
(56, 'Good Girl\r\nGone Bad', 'Rihanna', 'img/disco56.jpg'),
(57, 'I AM', 'beyonce', 'img/disco57.jpg'),
(58, 'De Vista', 'Maia Reficco', 'img/disco58.jpg'),
(59, 'SOS', 'Sza', 'img/disco59.jpg'),
(60, 'Ctrl', 'Sza', 'img/disco60.jpg'),
(61, 'The Eminem Show', 'Eminem', 'img/disco61.jpg'),
(62, 'mam`s best frind', 'Sabrina Carpenter ', 'img/disco62.jpg'),
(63, 'Blood Sugar Sex Magik', 'Red Hot Chilli Pepper', 'img/disco63.jpg'),
(64, 'Hot Space ', 'Queen', 'img/disco64.jpg'),
(65, 'Get Rich Or Die Tryin`', '50 Cent', 'img/disco65.jpg'),
(66, 'The Notorious BIG', 'Big Poppa', 'img/disco66.jpg'),
(67, 'Greatest Hits', '2Pac', 'img/disco67.jpg'),
(68, 'Guns n Roses', 'Guns n Roses', 'img/disco68.jpg'),
(69, '21', 'Adele', 'img/disco69.jpg'),
(70, '1000 forms of fear ', 'sia', 'img/disco70.jpg'),
(71, 'nothing but the beat ultimate', 'David Guetta', 'img/disco71.jpg'),
(72, 'Álbum 72', 'Artista 72', 'img/disco72.jpg'),
(73, 'DooWoops & hooligans', 'Bruno Mars', 'img/disco73.jpg'),
(74, 'Parachutes', 'Coldplay', 'img/disco74.jpg'),
(75, 'The Dark Side Of The Moon', 'Pink Floyd', 'img/disco75.jpg'),
(76, 'Nevermind', 'Nirvana ', 'img/disco76.jpg'),
(77, 'Rolling Stones', 'Rolling Stones', 'img/disco77.jpg'),
(78, 'Grace', 'Jeff Buckley', 'img/disco78.jpg'),
(79, 'Hatful Of Hollow', 'The Smiths', 'img/disco79.jpg'),
(80, 'Outlandos d´amour', 'The Police', 'img/disco80.jpg'),
(81, 'Weezer', 'Weezer', 'img/disco81.jpg'),
(82, 'Algo Mejor', 'Fabiana Cantilo\r\n', 'img/disco82.jpg'),
(83, 'Esperando El Milagro', 'Las Pelotas', 'img/disco83.jpg'),
(84, 'Eveybody else is doing it, so why can´t we ?', 'The Cranberries ', 'img/disco84.jpg'),
(85, 'In Rainbows', 'Radiohead', 'img/disco85.jpg'),
(86, 'Positions', 'Ariana Grande', 'img/disco86.jpg'),
(87, '1967-1970', 'The Beatles', 'img/disco27.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `playlists`
--

CREATE TABLE `playlists` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `playlists`
--

INSERT INTO `playlists` (`id`, `nombre`, `descripcion`) VALUES
(1, 'mejores temas ', '1,2,3'),
(2, 'Isabella', 'albumes de harry. | Canciones/Álbumes: Harry Styles - Fine Line, Harry Styles - Harry\'s House'),
(3, 'Isabella 2', 'argentina | Canciones/Álbumes: Charly García - Clics Modernos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ranking`
--

CREATE TABLE `ranking` (
  `id` int(11) NOT NULL,
  `album` varchar(150) NOT NULL,
  `estrellas` int(1) NOT NULL,
  `opinion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ranking`
--

INSERT INTO `ranking` (`id`, `album`, `estrellas`, `opinion`) VALUES
(1, 'Harry Styles - Fine Line', 5, 'muy lindo tema me encanta'),
(2, 'Sade - Love Deluxe', 4, 'me gusta mucho este album !'),
(3, 'Sade - Love Deluxe', 4, 'me gusta mucho este album !'),
(4, 'Sade - Love Deluxe', 4, 'me gusta mucho este album !');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre-usuario` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre-usuario`, `email`, `password`) VALUES
(1, 'isabella maurino', 'isabellamaurino2007@gmail.com', 'isaa123'),
(2, 'catalina123', 'catalinacarreira1@gmail.com', 'catalamas capa123'),
(3, 'carolina ', 'carolina123z@gmail', 'caro123');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `playlists`
--
ALTER TABLE `playlists`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ranking`
--
ALTER TABLE `ranking`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `albums`
--
ALTER TABLE `albums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT de la tabla `playlists`
--
ALTER TABLE `playlists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ranking`
--
ALTER TABLE `ranking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
