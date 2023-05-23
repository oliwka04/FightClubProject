-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 23 Maj 2023, 20:01
-- Wersja serwera: 10.4.27-MariaDB
-- Wersja PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `fightclubdb`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `categories`
--

CREATE TABLE `categories` (
  `categoryID` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `categories`
--

INSERT INTO `categories` (`categoryID`, `name`, `description`) VALUES
(1, 'Judo', 'Sztuka walki stworzona w Japonii jako sport przez Jigorō Kanō z jūjutsu. Judo zostało docenione jako metoda ćwiczeń fizycznych, treningu moralnego i samoobrony.'),
(2, 'Karate', 'Sztuka walki i sport walki stworzone na Okinawie, jednej z Wysp Japońskich. Karate obejmuje swoim zasięgiem cały świat. Do chwili obecnej powstało ponad 100 stylów karate. Jedyną organizacją odpowiedzialną za ruch sportowy karate i uznaną przez Międzynarodowy Komitet Olimpijski jest Światowa Federacja Karate.'),
(3, 'Chessboxing', 'Dyscyplina sportowa, będąca połączeniem walki bokserskiej z partią szachową. Idea szachowego boksu została rozpowszechniona przez holenderskiego performera Iepe Rubingha. To, co początkowo uważano za sztukę, szybko przekształciło się we w pełni rozwinięty sport.'),
(4, 'Kickboxing', 'Dyscyplina sportowa, w której walczy się stosując zarówno bokserskie ciosy pięścią, jak i kopnięcia. Sport rozwijający w sposób holistyczny umiejętności fizyczne takie jak: siła, szybkość, wytrzymałość, gibkość, poczucie rytmu.'),
(5, 'Capoeira', 'Brazylijska sztuka walki, której formy są rytmiczne, akrobatyczne i skupiają się na kopnięciach. Ruchy capoeira są bardzo płynne i rytmiczne.');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cities`
--

CREATE TABLE `cities` (
  `locationID` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `cities`
--

INSERT INTO `cities` (`locationID`, `name`) VALUES
(1, 'Łódź'),
(2, 'Rzgów'),
(3, 'Aleksandrów Łódzki'),
(4, 'Guzew'),
(5, 'Tuszyn'),
(6, 'Andrespol'),
(7, 'Pabianice');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `conversations`
--

CREATE TABLE `conversations` (
  `conversationID` int(11) NOT NULL,
  `trainerID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `eventID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `difficultlevel`
--

CREATE TABLE `difficultlevel` (
  `difficultLevelID` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `difficultlevel`
--

INSERT INTO `difficultlevel` (`difficultLevelID`, `name`) VALUES
(1, 'Beginner'),
(2, 'Medium'),
(3, 'Advanced'),
(4, 'Hard'),
(5, 'Expert');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `events`
--

CREATE TABLE `events` (
  `eventID` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `photosJson` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`photosJson`)),
  `maxSlots` int(11) NOT NULL,
  `dateTime` datetime NOT NULL,
  `difficultLevelID` int(11) NOT NULL,
  `locationID` int(11) NOT NULL,
  `categoryID` int(11) NOT NULL,
  `trainerID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `events`
--

INSERT INTO `events` (`eventID`, `title`, `description`, `photosJson`, `maxSlots`, `dateTime`, `difficultLevelID`, `locationID`, `categoryID`, `trainerID`) VALUES
(1, 'Sparing szachoboksingowy', '10 osób będzie brało udział w drabinkach ala turniejowych o puchar. Zapraszamy do Andrespolu ul. Czajewskiego 15.', '1', 10, '2023-05-28 18:00:00', 4, 6, 3, 3),
(2, 'Zajęcia z Capoeira dla zaawansowanych', '15 osób może wziąć udział w treningu z Panem Tomaszem, gdzie będziemy udoskonalać umiejętności waleczne i taneczne.', '1', 15, '2023-05-26 21:30:00', 5, 5, 5, 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `messages`
--

CREATE TABLE `messages` (
  `messageID` int(11) NOT NULL,
  `content` text NOT NULL,
  `dateTime` datetime NOT NULL,
  `conversationID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `reservations`
--

CREATE TABLE `reservations` (
  `reservationID` int(11) NOT NULL,
  `eventID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `reservationDateTime` datetime NOT NULL,
  `completed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `roles`
--

CREATE TABLE `roles` (
  `roleID` int(11) NOT NULL,
  `roleName` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `roles`
--

INSERT INTO `roles` (`roleID`, `roleName`) VALUES
(1, 'Trener'),
(2, 'Administrator'),
(3, 'Użytkownik');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `name` text NOT NULL,
  `surname` text NOT NULL,
  `roleID` int(11) NOT NULL,
  `expireDate` datetime NOT NULL,
  `password_hash` text NOT NULL,
  `sessionToken` text NOT NULL,
  `email` text NOT NULL,
  `phone` int(11) NOT NULL,
  `locationID` int(11) NOT NULL,
  `aboutMe` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`userID`, `name`, `surname`, `roleID`, `expireDate`, `password_hash`, `sessionToken`, `email`, `phone`, `locationID`, `aboutMe`) VALUES
(1, 'Michał', 'Kawecki', 2, '2024-01-01 00:00:00', 'sdgdgdfgdsfgdf', '646cff3a72032', 'm.kawecki@zsp9.elodz.edu.pl', 978462394, 1, 'Fajny projekt'),
(2, 'Wojtek', 'Kadłubowski', 2, '2023-05-23 19:44:30', 'qwertyqwertz', '235235235252', 'w.kadlubowski@zsp9.elodz.edu.pl', 352345345, 3, 'Fajny ziom'),
(3, 'Tomasz', 'Tomaszewski', 1, '2023-05-23 19:44:30', 'kochamkosza1337', 'd9-27gr7g237', 't.tomaszewski@zsp9.pl', 87236422, 7, 'Kosz to moja pasja'),
(4, 'Oliwia', 'Krajewska', 3, '2023-05-23 19:44:30', 'test', 'test', 'o.krajewska@zsp9.elodz.edu.pl', 408237423, 1, 'css moment'),
(5, 'Zuzia', 'Dałek', 3, '2023-05-23 19:44:30', 'Jurek', 'kisdf', 'z.dalek@zsp9.elodz.edu.pl', 24972364, 1, 'Specjalistka od gimpa');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryID`),
  ADD UNIQUE KEY `categoryID` (`categoryID`);

--
-- Indeksy dla tabeli `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`locationID`),
  ADD UNIQUE KEY `locationID` (`locationID`);

--
-- Indeksy dla tabeli `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`conversationID`),
  ADD UNIQUE KEY `conversationID` (`conversationID`),
  ADD KEY `Conversations_fk0` (`trainerID`),
  ADD KEY `Conversations_fk1` (`userID`),
  ADD KEY `eventID` (`eventID`);

--
-- Indeksy dla tabeli `difficultlevel`
--
ALTER TABLE `difficultlevel`
  ADD PRIMARY KEY (`difficultLevelID`),
  ADD UNIQUE KEY `difficultLevelID` (`difficultLevelID`);

--
-- Indeksy dla tabeli `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`eventID`),
  ADD UNIQUE KEY `eventID` (`eventID`),
  ADD KEY `Events_fk0` (`difficultLevelID`),
  ADD KEY `Events_fk1` (`locationID`),
  ADD KEY `Events_fk2` (`categoryID`),
  ADD KEY `Events_fk3` (`trainerID`);

--
-- Indeksy dla tabeli `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`messageID`),
  ADD UNIQUE KEY `messageID` (`messageID`),
  ADD KEY `Messages_fk0` (`conversationID`);

--
-- Indeksy dla tabeli `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservationID`),
  ADD UNIQUE KEY `reservationID` (`reservationID`),
  ADD KEY `Reservations_fk0` (`eventID`),
  ADD KEY `Reservations_fk1` (`userID`);

--
-- Indeksy dla tabeli `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`roleID`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `userID` (`userID`),
  ADD KEY `Users_fk0` (`roleID`),
  ADD KEY `Users_fk1` (`locationID`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `cities`
--
ALTER TABLE `cities`
  MODIFY `locationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT dla tabeli `conversations`
--
ALTER TABLE `conversations`
  MODIFY `conversationID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `difficultlevel`
--
ALTER TABLE `difficultlevel`
  MODIFY `difficultLevelID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `events`
--
ALTER TABLE `events`
  MODIFY `eventID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `messages`
--
ALTER TABLE `messages`
  MODIFY `messageID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservationID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `roles`
--
ALTER TABLE `roles`
  MODIFY `roleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `conversations`
--
ALTER TABLE `conversations`
  ADD CONSTRAINT `Conversations_fk0` FOREIGN KEY (`trainerID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `Conversations_fk1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `Conversations_fk2` FOREIGN KEY (`eventID`) REFERENCES `events` (`eventID`);

--
-- Ograniczenia dla tabeli `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `Events_fk0` FOREIGN KEY (`difficultLevelID`) REFERENCES `difficultlevel` (`difficultLevelID`),
  ADD CONSTRAINT `Events_fk1` FOREIGN KEY (`locationID`) REFERENCES `cities` (`locationID`),
  ADD CONSTRAINT `Events_fk2` FOREIGN KEY (`categoryID`) REFERENCES `categories` (`categoryID`),
  ADD CONSTRAINT `Events_fk3` FOREIGN KEY (`trainerID`) REFERENCES `users` (`userID`);

--
-- Ograniczenia dla tabeli `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `Messages_fk0` FOREIGN KEY (`conversationID`) REFERENCES `conversations` (`conversationID`);

--
-- Ograniczenia dla tabeli `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `Reservations_fk0` FOREIGN KEY (`eventID`) REFERENCES `events` (`eventID`),
  ADD CONSTRAINT `Reservations_fk1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);

--
-- Ograniczenia dla tabeli `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `Users_fk0` FOREIGN KEY (`roleID`) REFERENCES `roles` (`roleID`),
  ADD CONSTRAINT `Users_fk1` FOREIGN KEY (`locationID`) REFERENCES `cities` (`locationID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
