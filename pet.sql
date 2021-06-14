-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2021. Jún 14. 21:14
-- Kiszolgáló verziója: 10.4.14-MariaDB
-- PHP verzió: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `pet`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `category`
--

CREATE TABLE `category` (
  `categoryId` int(10) NOT NULL,
  `type` varchar(15) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `category`
--

INSERT INTO `category` (`categoryId`, `type`) VALUES
(1, 'kutya'),
(2, 'macska'),
(3, 'bagoly'),
(5, 'elefánt'),
(6, 'varjú'),
(7, 'farkas'),
(9, 'majom'),
(10, 'holló'),
(11, 'mosómedve'),
(16, 'grizzly');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `msg` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `sentDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `messages`
--

INSERT INTO `messages` (`msg_id`, `sender_id`, `receiver_id`, `msg`, `sentDate`) VALUES
(1, 41, 17, 'Helló', '2021-05-29 18:47:22'),
(2, 45, 17, 'Lorem ipsum dolor', '2021-05-29 19:08:58'),
(3, 17, 41, 'Törölje az állatait vagy feljelentem!!!!', '2021-05-29 20:28:00'),
(4, 17, 41, 'Hogy van uram?', '2021-05-29 20:28:09'),
(5, 41, 17, 'Hallatlan', '2021-05-29 20:28:43'),
(6, 17, 21, 'I don\'t like you man.', '2021-05-29 20:56:29'),
(7, 17, 21, 'Helló', '2021-06-12 18:38:12'),
(8, 17, 21, 'El fogom lopni az állatkáit ha nem adja ide', '2021-06-12 18:38:27'),
(9, 17, 21, 'Jó napot!', '2021-06-12 18:40:49'),
(16, 17, 43, 'Hello', '2021-06-12 18:43:58'),
(17, 17, 43, 'Hello', '2021-06-12 18:44:03');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `pets`
--

CREATE TABLE `pets` (
  `id` int(10) NOT NULL,
  `email` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `age` varchar(20) COLLATE utf8_hungarian_ci NOT NULL,
  `image` varchar(35) COLLATE utf8_hungarian_ci NOT NULL,
  `description` varchar(200) COLLATE utf8_hungarian_ci NOT NULL,
  `categoryId` int(10) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `statusId` int(11) NOT NULL,
  `activatedByAdmin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `pets`
--

INSERT INTO `pets` (`id`, `email`, `age`, `image`, `description`, `categoryId`, `active`, `statusId`, `activatedByAdmin`) VALUES
(2, 'galamb@gmail.com', '3 év', 'dog2.jpg', 'Allergiás a macskákra', 1, 1, 2, 0),
(3, 'galamb@gmail.com', '2 év', 'dog3.jpg', 'Szereti ha simogatják', 1, 1, 1, 0),
(4, 'macska@gmail.com', '9 év', 'owl.jpg', 'Nem szereti az emböröket.', 3, 0, 4, 0),
(5, 'bagoly@gmail.com', '5 év', 'owl2.jpg', 'Bagoly, nem szereti ha szeretik', 3, 1, 1, 0),
(11, 'macska@gmail.com', '1 év', 'wolf1.jpg', 'Kutya', 7, 1, 4, 0),
(37, 'macska@gmail.com', '9 hónap', 'raven2.jpg', 'Hangos', 10, 1, 1, 0),
(44, 'macska@gmail.com', '5 év', 'raven.jpg', 'Szép madár', 10, 1, 4, 0),
(95, 'admin@gmail.com', '3 hét', 'elephant.jpg', 'Nó', 5, 1, 2, 0),
(96, 'admin@gmail.com', '2 év', 'wolf2.jpg', 'Félelmetes!!!', 7, 1, 1, 0),
(108, 'macska@gmail.com', '3 év', 'cat.jpg', 'Siamese Cat', 2, 1, 2, 0);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `signedup`
--

CREATE TABLE `signedup` (
  `id` int(10) NOT NULL,
  `fname` varchar(35) COLLATE utf8_hungarian_ci NOT NULL,
  `lname` varchar(25) COLLATE utf8_hungarian_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `signedUpDate` date NOT NULL,
  `activatedUser` tinyint(1) NOT NULL,
  `banned` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `signedup`
--

INSERT INTO `signedup` (`id`, `fname`, `lname`, `email`, `password`, `signedUpDate`, `activatedUser`, `banned`) VALUES
(17, 'Macska', 'Nagy', 'macska@gmail.com', '$2y$10$/I7TDqu8I394U73a4AQs..xsDj42SZLvyrAQ.ZbIGZfAm/gHdzVOa', '2021-03-27', 0, 0),
(21, 'kutya', 'kutyusz', 'kutya@gmail.com', '$2y$10$dT6y/yZeKL821KOg6H4Ww.TaTbZMDUnhol17qZLaizjeSqbSYAjLW', '2021-03-27', 0, 1),
(41, 'Bagoly', 'Nagy', 'bagoly@gmail.com', '$2y$10$r6gEN9vUon5bcTGbnapTAOBqGWxuxXAilxzORDPw/uSxAYWTw5PSO', '2021-04-16', 0, 0),
(42, 'galamb', 'Kiss', 'galamb@gmail.com', '$2y$10$1yKqmG9tZxciZTKDMCikQ.cgaDpT3dBd9eqkyr1oi2wevVoNPih/O', '2021-04-16', 0, 0),
(43, 'giliszta', 'Hosszu', 'gili@gmai.com', '$2y$10$QKy0iLGz5FRGJxhfsQu/S.nNfJmfkAYySjqwAiP6IDdi.SpixRdiG', '2021-04-16', 0, 0),
(45, 'fgwdrfw', 'rewrewwe', 'tawafex723@drluotan.com', '$2y$10$oram2wfgAO0FNy0y5d0AmuHKqV3V8rrwaND7ICKNLRbm71Ujus1va', '2021-05-04', 0, 0),
(46, 'fsdfwef', 'wrewe', 'cicoh67219@drluotan.com', '$2y$10$Ty5ao/40FtMqdgrP0yFmv.TpJdOrrApLiKKuRJNyoFHBZD1Hz7692', '2021-05-04', 0, 0),
(47, 'wdfew', 'rewrewwrew', 'wejakat203@drluotan.com', '$2y$10$Jk/b6j3X6c5/RwAqtWRLJugDb3Am3jL8HOhGy7Zkm9MSp9tQpyahG', '2021-05-04', 0, 0),
(50, 'jlwkewl', 'ekwlekw', 'gefov20212@httptuan.com', '$2y$10$YhgYfMLSE6.b/9zwJBF8jO7LwSxiBlcqymyqWMrarUlYxKIAPoida', '2021-05-04', 1, 0),
(52, 'macska', 'fekete', 'kecepom787@threepp.com', '$2y$10$Q9tD1mOlIehw0VikbLfU1eVjkB/w6QjXaA88tkdbndGUt2ZD/nHmu', '2021-05-19', 1, 1),
(53, 'Macska', 'macsek', 'pocaj98836@gocasin.com', '$2y$10$hAB7vqsEF29LFtIGncWPxeuBDcu6gEgOhg24Vg5UEHcBoIaq1HUGS', '2021-06-12', 1, 0);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `status`
--

CREATE TABLE `status` (
  `statusId` int(11) NOT NULL,
  `status` varchar(20) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `status`
--

INSERT INTO `status` (`statusId`, `status`) VALUES
(1, 'Egészséges'),
(2, 'Jó'),
(3, 'Beteg'),
(4, 'Depressziós');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users_pets`
--

CREATE TABLE `users_pets` (
  `userID` int(11) NOT NULL,
  `petID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `users_pets`
--

INSERT INTO `users_pets` (`userID`, `petID`) VALUES
(17, 3),
(17, 5),
(21, 37),
(21, 95),
(42, 2),
(42, 3),
(42, 5),
(53, 3);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryId`);

--
-- A tábla indexei `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- A tábla indexei `pets`
--
ALTER TABLE `pets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category foreign key` (`categoryId`),
  ADD KEY `statusId` (`statusId`);

--
-- A tábla indexei `signedup`
--
ALTER TABLE `signedup`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`statusId`);

--
-- A tábla indexei `users_pets`
--
ALTER TABLE `users_pets`
  ADD PRIMARY KEY (`userID`,`petID`),
  ADD KEY `petID` (`petID`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `category`
--
ALTER TABLE `category`
  MODIFY `categoryId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT a táblához `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT a táblához `pets`
--
ALTER TABLE `pets`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT a táblához `signedup`
--
ALTER TABLE `signedup`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT a táblához `status`
--
ALTER TABLE `status`
  MODIFY `statusId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `receiver_id` FOREIGN KEY (`receiver_id`) REFERENCES `signedup` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sender_id` FOREIGN KEY (`sender_id`) REFERENCES `signedup` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Megkötések a táblához `pets`
--
ALTER TABLE `pets`
  ADD CONSTRAINT `category foreign key` FOREIGN KEY (`categoryId`) REFERENCES `category` (`categoryId`),
  ADD CONSTRAINT `statusId` FOREIGN KEY (`statusId`) REFERENCES `status` (`statusId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Megkötések a táblához `users_pets`
--
ALTER TABLE `users_pets`
  ADD CONSTRAINT `petID_foreign_key` FOREIGN KEY (`petID`) REFERENCES `pets` (`id`),
  ADD CONSTRAINT `userID_foreign_key` FOREIGN KEY (`userID`) REFERENCES `signedup` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
