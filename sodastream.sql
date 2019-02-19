
-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Erstellungszeit: 18. Feb 2019 um 19:44
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
  `username` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `height` int(40) DEFAULT NULL,
  `weight` int(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `water_consume`
--

CREATE TABLE `water_consume` (
  `id` int(6) NOT NULL,
  `created_at` date DEFAULT NULL,
  `input_water` smallint(6) NOT NULL,
  `user_id` int(6) NOT NULL,
  `type` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `water_consume`
--
ALTER TABLE `water_consume`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `water_consume`
--
ALTER TABLE `water_consume`
  ADD CONSTRAINT `water_consume_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
