-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2023. Máj 24. 21:53
-- Kiszolgáló verziója: 10.4.28-MariaDB
-- PHP verzió: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `alkatresz_webshop`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalok`
--

CREATE TABLE `felhasznalok` (
  `id` int(11) NOT NULL,
  `felhasznalonev` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `jelszo` varchar(100) NOT NULL,
  `teljes_nev` varchar(100) NOT NULL,
  `lakcim` varchar(100) NOT NULL,
  `jog` varchar(5) NOT NULL,
  `profilkep` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `felhasznalok`
--

INSERT INTO `felhasznalok` (`id`, `felhasznalonev`, `email`, `jelszo`, `teljes_nev`, `lakcim`, `jog`, `profilkep`) VALUES
(9, 'felhasznalo', 'felhasznalo@gmail.com', 'ae584fad1aaa7e6dd965d2147b7683fc', 'felhasznalo', 'felhasznalo utca', 'user', 'kepek/felhasznalo/1482178892userprofilkep.jpg'),
(10, 'admin', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'admin utca', 'admin', 'kepek/admin/1586787161adminprofilkep.jpg');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kategoriak`
--

CREATE TABLE `kategoriak` (
  `id` int(11) NOT NULL,
  `nev` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `kategoriak`
--

INSERT INTO `kategoriak` (`id`, `nev`) VALUES
(1, 'Gumiabroncsok és kapcsolódó termékek'),
(4, 'Fékberendezés'),
(5, 'Szűrők'),
(6, 'Motor'),
(7, 'Elektromosság'),
(8, 'Felfüggesztés, lengőkarok'),
(9, 'Motor hűtőrendszer'),
(10, 'Karosszéria'),
(11, 'Kipufogó'),
(12, 'Kuplung / -alkatrészek'),
(13, 'Világítás'),
(14, 'Vonóhorog / alkatrészek'),
(15, 'Kormányzás'),
(16, 'Beltéri kényelmi kiegészítők'),
(17, 'Tömítések és tömítőgyűrűk');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `markak`
--

CREATE TABLE `markak` (
  `id` int(11) NOT NULL,
  `nev` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `markak`
--

INSERT INTO `markak` (`id`, `nev`) VALUES
(3, 'Audi'),
(4, 'Volkswagen'),
(5, 'Suzuki'),
(6, 'Honda'),
(7, 'Chevrolet'),
(8, 'Seat'),
(9, 'BMW'),
(11, 'Ford'),
(12, 'Mercedes'),
(13, 'Alfa Romeo'),
(14, 'Bentley'),
(15, 'Daewoo'),
(16, 'Opel'),
(17, 'Renault');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `rendelesek`
--

CREATE TABLE `rendelesek` (
  `id` int(11) NOT NULL,
  `felhasznalo_id` int(11) NOT NULL,
  `termek_id` int(11) NOT NULL,
  `datum` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `rendelesek`
--

INSERT INTO `rendelesek` (`id`, `felhasznalo_id`, `termek_id`, `datum`) VALUES
(17, 9, 16, '2023-05-24');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `termekek`
--

CREATE TABLE `termekek` (
  `id` int(11) NOT NULL,
  `nev` varchar(100) NOT NULL,
  `kategoria_id` int(11) NOT NULL,
  `marka_id` int(11) NOT NULL,
  `ar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `termekek`
--

INSERT INTO `termekek` (`id`, `nev`, `kategoria_id`, `marka_id`, `ar`) VALUES
(4, 'Dobfék', 4, 5, 23452),
(8, 'Légszűrő', 5, 14, 32499),
(9, 'Sport kipufogó', 11, 6, 78249),
(10, 'Hengerfejtömítés', 17, 17, 17345),
(11, 'Könyöktámasz', 16, 7, 23820),
(12, 'Vonóhorog', 14, 4, 10310),
(13, 'Lambda szonda', 6, 11, 11005),
(14, 'Vízhűtő', 9, 13, 25099),
(15, 'Kuplungtárcsa', 12, 15, 14685),
(16, 'Kormányrúd', 15, 12, 39593);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `felhasznalok`
--
ALTER TABLE `felhasznalok`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `kategoriak`
--
ALTER TABLE `kategoriak`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `markak`
--
ALTER TABLE `markak`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `rendelesek`
--
ALTER TABLE `rendelesek`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_FELH_ID` (`felhasznalo_id`),
  ADD KEY `FK_TERMEK_ID` (`termek_id`);

--
-- A tábla indexei `termekek`
--
ALTER TABLE `termekek`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_KATEGORIA_ID` (`kategoria_id`),
  ADD KEY `FK_MARKA_ID` (`marka_id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `felhasznalok`
--
ALTER TABLE `felhasznalok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT a táblához `kategoriak`
--
ALTER TABLE `kategoriak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT a táblához `markak`
--
ALTER TABLE `markak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT a táblához `rendelesek`
--
ALTER TABLE `rendelesek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT a táblához `termekek`
--
ALTER TABLE `termekek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `rendelesek`
--
ALTER TABLE `rendelesek`
  ADD CONSTRAINT `FK_FELH_ID` FOREIGN KEY (`felhasznalo_id`) REFERENCES `felhasznalok` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_TERMEK_ID` FOREIGN KEY (`termek_id`) REFERENCES `termekek` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `termekek`
--
ALTER TABLE `termekek`
  ADD CONSTRAINT `FK_KATEGORIA_ID` FOREIGN KEY (`kategoria_id`) REFERENCES `kategoriak` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_MARKA_ID` FOREIGN KEY (`marka_id`) REFERENCES `markak` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
