-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-04-2024 a las 04:33:14
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mahoraga`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

CREATE TABLE `articulos` (
  `id_articulo` int(20) NOT NULL,
  `articulo` mediumtext NOT NULL,
  `imagen` mediumtext NOT NULL,
  `descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`id_articulo`, `articulo`, `imagen`, `descripcion`) VALUES
(1, 'Figura Solo Leveling', 'https://www.clubhousestatues.com/cdn/shop/files/7C938F6A-51CD-4F12-9461-D01C433BDE6D.jpg?v=1706036717', 'Figura del popular anime en emisión Solo leveling'),
(2, 'Poster Jujutsu Kaisen', 'https://m.media-amazon.com/images/I/51EE-ixm+EL._AC_UF894,1000_QL80_.jpg', 'Poster del anime Jujustu Kaisen del villano Sukuna'),
(6, 'Llavero Tratado Virtuoso', 'https://ae01.alicdn.com/kf/S0ab15778fb8f4fa4b29ca912d3a7cbffw/NieR-Automata-2B-9S-mu-eco-Beastlord-Sword-modelos-de-tratado-virtuoso-llavero-de-arma-de.jpg', 'Llavero con forma del espada Tratado virtuoso del juego Nier Automata'),
(23, 'Figura de Anime NSFW Mikasa Ackerman', 'https://i5.walmartimages.com.mx/mg/gm/3pp/asr/72193840-4aa2-4707-960d-b587dbf7efb2.d9c6e17af4c212b2a39c622e9ed785b7.jpeg?odnHeight=612&odnWidth=612&odnBg=FFFFFF', 'Figura de Anime de ataque a los Titanes de 30CM, Mikasa Ackerman de PVC, figura de acción, chica Sex');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`id_articulo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articulos`
--
ALTER TABLE `articulos`
  MODIFY `id_articulo` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
