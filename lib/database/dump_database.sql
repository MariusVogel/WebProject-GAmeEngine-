-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 21. Jun 2018 um 15:27
-- Server-Version: 5.7.22-0ubuntu0.16.04.1
-- PHP-Version: 7.0.30-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `JumpNRun`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Benutzer`
--

CREATE TABLE `Benutzer` (
  `id` int(11) NOT NULL,
  `benutzername` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `pw` varchar(255) NOT NULL,
  `code` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `Benutzer`
--

INSERT INTO `Benutzer` (`id`, `benutzername`, `mail`, `pw`, `code`) VALUES
(2, 'jannis', 'jannis.luechtefeld@yahoo.de', '$2y$10$M3dpZnK8aHSM0S6zoT/TAOTe52EfpFX.U5VY/BO0GvgJj5SnOnClS', '1'),
(3, 'marius', 'mariusvogel1@gmail.com', '$2y$10$nGzEpuwDNj2kMnmHjz84Fu53t0fBiVb5ih2Pz2Cv6PgJ1kX9hqYPq', '1');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Score`
--

CREATE TABLE `Score` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `Score`
--

INSERT INTO `Score` (`id`, `userId`, `score`, `datum`) VALUES
(1, 3, 9001, '2018-06-15 08:49:15'),
(2, 6, 1001, '2018-06-15 08:49:15');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `Benutzer`
--
ALTER TABLE `Benutzer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`benutzername`),
  ADD UNIQUE KEY `mail` (`mail`);

--
-- Indizes für die Tabelle `Score`
--
ALTER TABLE `Score`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userId` (`userId`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `Benutzer`
--
ALTER TABLE `Benutzer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT für Tabelle `Score`
--
ALTER TABLE `Score`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
