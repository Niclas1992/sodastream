-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Erstellungszeit: 20. Feb 2019 um 16:08
-- Server-Version: 5.7.23
-- PHP-Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Datenbank: `sodastream`
--
CREATE DATABASE IF NOT EXISTS `sodastream` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `sodastream`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `id` int(6) NOT NULL,
  `name` varchar(40) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(255) NOT NULL,
  `height` int(40) DEFAULT NULL,
  `weight` int(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `email`, `password`, `height`, `weight`) VALUES
(4, 'Hallo', 'Hallo', 'hallo@web.de', '$2y$10$wwlvdORYCSULXcB9xODFw.QYtr1G3LvOS6Jpa/zr1ENfB3NcWE7OG', NULL, NULL),
(6, 'niclas', 'niclas', 'niclas@web.de', '$2y$10$RxNmNAqg5JaPivmXQbGluO9Kby8buxhlnVDZaji/LvbMoltL8HC.e', 179, 74),
(7, 'super', 'super', 'super@web.de', '$2y$10$seMhzzlPgxk0ctNIdr5vYOfhemL0pNkCoBR48i2WuewjPY6CDtnjy', NULL, NULL),
(8, 'ivan', 'ivankov', 'ivan@web.de', '$2y$10$iVpYx/FPal3a1e/vWHaLnuj/jYF3No5V9pWgGDF2QNhG0/RBF/mNG', NULL, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `water_consume`
--

CREATE TABLE `water_consume` (
  `id` int(6) NOT NULL,
  `created_at` date DEFAULT NULL,
  `input_water` decimal(6,0) NOT NULL,
  `user_id` int(6) NOT NULL,
  `type` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `water_consume`
--

INSERT INTO `water_consume` (`id`, `created_at`, `input_water`, `user_id`, `type`) VALUES
(3, '2019-02-20', '2', 6, ''),
(4, '2019-02-20', '8', 6, ''),
(5, '2019-02-20', '0', 6, ''),
(6, '2019-02-20', '0', 6, ''),
(7, '2019-02-20', '1', 6, ''),
(8, '2019-02-20', '1', 6, '');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `water_consume`
--
ALTER TABLE `water_consume`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT für Tabelle `water_consume`
--
ALTER TABLE `water_consume`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `water_consume`
--
ALTER TABLE `water_consume`
  ADD CONSTRAINT `water_consume_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
