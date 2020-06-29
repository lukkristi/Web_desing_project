-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 15. Jun 2018 um 05:39
-- Server Version: 5.5.59
-- PHP-Version: 5.4.45-0+deb7u12

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `WebDiP2017x080`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `dnevnik`
--

CREATE TABLE IF NOT EXISTS `dnevnik` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `radnja` varchar(45) NOT NULL,
  `vrijeme` datetime NOT NULL,
  `korisnik` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=94 ;

--
-- Daten für Tabelle `dnevnik`
--

INSERT INTO `dnevnik` (`id`, `radnja`, `vrijeme`, `korisnik`) VALUES
(1, 'Prijava u sustav', '2018-06-05 17:23:14', 'tonkira'),
(2, 'Prijava u sustav', '2018-06-05 17:25:32', 'bozpetr'),
(3, 'Neuspjesna prijava', '2018-06-05 17:30:55', 'bozpetr'),
(4, 'Neuspjesna prijava', '2018-06-05 17:32:12', 'bozpetr'),
(5, 'Neuspjesna prijava', '2018-06-05 17:32:17', 'bozpetr'),
(6, 'Neuspjesna prijava', '2018-06-05 17:32:21', 'bozpetr'),
(7, 'Prijava u sustav', '2018-06-05 17:37:55', 'samejic'),
(8, 'Prijava u sustav', '2018-06-05 17:41:47', 'samejic'),
(9, 'Odjava sa sustava', '2018-06-05 17:42:03', 'samejic'),
(11, 'Neuspjesna prijava', '2018-06-05 17:51:05', 'samejic'),
(15, 'Neuspjesna prijava', '2018-06-05 17:58:59', 'samejic'),
(16, 'Neuspjesna prijava', '2018-06-05 17:59:12', 'samejic'),
(17, 'Neuspjesna prijava', '2018-06-05 17:59:15', 'samejic'),
(18, 'Racun je zakljucan', '2018-06-05 17:59:15', 'samejic'),
(19, 'Crnogorac', '2018-06-05 23:07:20', 'Nova lozinka'),
(20, 'Crnogorac', '2018-06-05 23:19:12', 'Nova lozinka'),
(21, 'Prijava u sustav', '2018-06-05 23:49:36', 'matmilob'),
(22, 'Neuspjesna prijava', '2018-06-06 22:11:02', 'matmilob'),
(23, 'Prijava u sustav', '2018-06-06 22:11:02', 'matmilob'),
(24, 'Neuspjesna prijava', '2018-06-06 21:09:51', 'matmilob'),
(25, 'Neuspjesna prijava', '2018-06-07 19:17:35', 'matmilob'),
(26, 'Racun je zakljucan', '2018-06-07 19:17:35', 'matmilob'),
(27, 'Prijava u sustav', '2018-08-30 21:21:13', 'segi5'),
(28, 'Odjava sa sustava', '2018-06-07 22:26:38', 'segi5'),
(29, 'Odjava sa sustava', '2018-06-07 22:26:54', ''),
(30, 'Prijava u sustav', '2018-06-07 22:27:24', 'segi5'),
(31, 'Odjava sa sustava', '2018-06-07 22:27:31', 'segi5'),
(32, 'Kreiran novi Hotel', '2018-06-11 23:38:27', 'Becislav'),
(33, 'Prijava u sustav', '2018-06-12 14:22:23', 'lukkristi'),
(34, 'Odjava sa sustava', '2018-06-12 14:24:08', 'lukkristi'),
(35, 'Prijava u sustav', '2018-06-12 14:24:28', 'lukkristi'),
(36, 'Prijava u sustav', '2018-06-12 16:20:45', 'tonkira'),
(37, 'Odjava sa sustava', '2018-06-12 16:23:05', 'tonkira'),
(38, 'Prijava u sustav', '2018-06-12 17:18:39', 'tonkira'),
(39, 'Kreiran novi Hotel', '2018-06-12 17:19:03', 'tonkira'),
(40, 'Kreiran novi Hotel', '2018-06-12 17:21:38', 'tonkira'),
(41, 'Kreiran novi Hotel', '2018-06-12 17:21:43', 'tonkira'),
(42, 'Kreiran novi Hotel', '2018-06-12 17:29:54', 'tonkira'),
(43, 'Kreirana nova Soba', '2018-06-12 17:31:51', 'tonkira'),
(44, 'Odjava sa sustava', '2018-06-12 17:35:07', 'tonkira'),
(45, 'Neuspjesna prijava', '2018-06-12 17:37:52', 'tonkira'),
(46, 'Prijava u sustav', '2018-06-12 17:42:40', 'tonkira'),
(47, 'Odjava sa sustava', '2018-06-12 19:51:14', 'tonkira'),
(48, 'Prijava u sustav', '2018-06-12 23:25:00', 'tonkira'),
(49, 'Nova rezervacija', '2018-06-12 23:25:37', 'tonkira'),
(50, 'Prijava u sustav', '2018-06-13 01:44:04', 'sloba'),
(51, 'Prijava oglasa', '2018-06-13 01:45:09', 'sloba'),
(52, 'Prijava oglasa', '2018-06-13 01:47:07', 'sloba'),
(53, 'Prijava oglasa', '2018-06-13 01:50:30', 'sloba'),
(54, 'Prijava oglasa', '2018-06-13 01:50:58', 'sloba'),
(55, 'Prijava oglasa', '2018-06-13 01:53:51', 'sloba'),
(56, 'Odjava sa sustava', '2018-06-13 01:54:09', 'sloba'),
(57, 'Prijava u sustav', '2018-06-14 00:33:01', 'sloba'),
(58, 'Odjava sa sustava', '2018-06-14 00:47:56', 'sloba'),
(59, 'Prijava u sustav', '2018-06-14 00:48:08', 'tonkira'),
(60, 'Odjava sa sustava', '2018-06-14 00:49:06', 'tonkira'),
(61, 'Prijava u sustav', '2018-06-14 00:49:22', 'lukkristi'),
(62, 'Stvorena nova vrsta oglasa', '2018-06-13 23:58:26', 'lukkristi'),
(63, 'Neuspjesna prijava', '2018-06-14 23:31:15', 'Mirkec'),
(64, 'Prijava u sustav', '2018-06-14 23:35:54', 'Mirkec'),
(65, 'Neuspjesna prijava', '2018-06-14 23:36:10', 'Mirkec'),
(66, 'Odjava sa sustava', '2018-06-15 00:02:40', 'Mirkec'),
(67, 'Odjava sa sustava', '2018-06-15 00:02:45', ''),
(68, 'Nova lozinka', '2018-06-15 00:13:10', 'mirkec'),
(69, 'Prijava u sustav', '2018-06-15 01:18:45', 'sloba'),
(70, 'Prijava oglasa', '2018-06-15 01:21:59', 'sloba'),
(71, 'Odjava sa sustava', '2018-06-15 01:23:21', 'sloba'),
(72, 'Prijava u sustav', '2018-06-15 01:27:51', 'tonkira'),
(73, 'Kreirana nova Soba', '2018-06-15 01:29:08', 'tonkira'),
(74, 'Kreirana nova Soba', '2018-06-15 01:30:55', 'tonkira'),
(75, 'Nova rezervacija', '2018-06-15 01:31:20', 'tonkira'),
(76, 'Odjava sa sustava', '2018-06-15 01:42:18', 'tonkira'),
(77, 'Prijava u sustav', '2018-06-15 01:42:27', 'sloba'),
(78, 'Odjava sa sustava', '2018-06-15 01:42:46', 'sloba'),
(79, 'Racun je zakljucan', '2018-06-15 01:51:02', 'cupavac'),
(80, 'Prijava u sustav', '2018-06-15 01:51:54', 'lukkristi'),
(81, 'Kreiran novi Hotel', '2018-06-15 10:58:19', 'Becislav'),
(82, 'Dodjela moderatora hotelu', '2018-06-15 10:59:32', 'Becislav'),
(83, 'Dodjela moderatora hotelu', '2018-06-15 10:59:54', 'Becislav'),
(84, 'Odjava sa sustava', '2018-06-15 11:10:26', 'lukkristi'),
(85, 'Prijava u sustav', '2018-06-15 11:12:09', 'lukkristi'),
(86, 'Odjava sa sustava', '2018-06-15 11:40:59', 'lukkristi'),
(87, 'Prijava u sustav', '2018-06-15 11:41:43', 'lukkristi'),
(88, 'Odjava sa sustava', '2018-06-15 03:05:02', 'lukkristi'),
(89, 'Prijava u sustav', '2018-06-15 03:05:29', 'sloba'),
(90, 'Odjava sa sustava', '2018-06-15 03:07:45', 'sloba'),
(91, 'Odjava sa sustava', '2018-06-15 04:20:21', ''),
(92, 'Prijava u sustav', '2018-06-15 04:20:34', 'lukkristi'),
(93, 'Odjava sa sustava', '2018-06-15 05:28:59', 'lukkristi');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `dodijeljeni_moderator`
--

CREATE TABLE IF NOT EXISTS `dodijeljeni_moderator` (
  `moderator` int(11) NOT NULL,
  `tip_oglasa` int(11) NOT NULL,
  PRIMARY KEY (`moderator`,`tip_oglasa`),
  KEY `fk_korisnik_has_tip_oglasa_tip_oglasa1_idx` (`tip_oglasa`),
  KEY `fk_korisnik_has_tip_oglasa_korisnik1_idx` (`moderator`)
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_croatian_ci;

--
-- Daten für Tabelle `dodijeljeni_moderator`
--

INSERT INTO `dodijeljeni_moderator` (`moderator`, `tip_oglasa`) VALUES
(3, 1),
(3, 2),
(3, 3),
(5, 4),
(4, 5),
(5, 5),
(4, 6),
(4, 7);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `hotel`
--

CREATE TABLE IF NOT EXISTS `hotel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Daten für Tabelle `hotel`
--

INSERT INTO `hotel` (`id`, `naziv`) VALUES
(1, 'Turist'),
(2, 'Antunovi?'),
(3, 'Savus'),
(4, 'Istra'),
(5, 'Parq Boutique'),
(6, 'Varaždin'),
(7, 'Art'),
(8, 'Europa'),
(9, 'Aurora'),
(10, 'Marina'),
(11, 'Marakana'),
(12, 'Kopakabana'),
(13, 'Savus2');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `hotel_moderator`
--

CREATE TABLE IF NOT EXISTS `hotel_moderator` (
  `hotel` int(11) NOT NULL,
  `moderator` int(11) NOT NULL,
  PRIMARY KEY (`hotel`,`moderator`),
  KEY `fk_hotel_has_korisnik_korisnik1_idx` (`moderator`),
  KEY `fk_hotel_has_korisnik_hotel1_idx` (`hotel`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `hotel_moderator`
--

INSERT INTO `hotel_moderator` (`hotel`, `moderator`) VALUES
(2, 3),
(5, 3),
(6, 3),
(8, 3),
(11, 3),
(1, 4),
(3, 4),
(13, 4),
(2, 5),
(3, 5),
(9, 5),
(11, 5),
(12, 5);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `konfiguracija_sustava`
--

CREATE TABLE IF NOT EXISTS `konfiguracija_sustava` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pomak` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=cp1250 COLLATE=cp1250_croatian_ci AUTO_INCREMENT=29 ;

--
-- Daten für Tabelle `konfiguracija_sustava`
--

INSERT INTO `konfiguracija_sustava` (`id`, `pomak`) VALUES
(1, 2018),
(2, 0),
(8, 2018),
(9, 2018),
(10, 2018),
(11, 2018),
(12, 2018),
(13, 2018),
(14, 2018),
(15, 2018),
(16, 2018),
(17, 2018),
(18, 2018),
(19, 0),
(20, 2018),
(21, 3),
(22, 0),
(23, 2),
(24, 0),
(25, 9),
(26, 9),
(27, 9),
(28, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `korisnik`
--

CREATE TABLE IF NOT EXISTS `korisnik` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ime` varchar(45) CHARACTER SET latin1 NOT NULL,
  `prezime` varchar(45) CHARACTER SET latin1 NOT NULL,
  `korisnicko_ime` varchar(45) CHARACTER SET latin1 NOT NULL,
  `email` varchar(45) CHARACTER SET latin1 NOT NULL,
  `lozinka` varchar(45) CHARACTER SET latin1 NOT NULL,
  `kriptirana_lozinka` varchar(45) CHARACTER SET latin1 NOT NULL,
  `datum_registracije` varchar(45) CHARACTER SET latin1 NOT NULL,
  `status_potvrde` varchar(45) CHARACTER SET latin1 NOT NULL,
  `broj_promasaja` int(11) NOT NULL,
  `aktivacijski_kod` varchar(45) CHARACTER SET latin1 NOT NULL,
  `vrijeme_prijave` varchar(45) CHARACTER SET latin1 NOT NULL,
  `tip_korisnika` int(11) NOT NULL,
  `uvjeti_korištenja` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tip_korisnika_idx` (`tip_korisnika`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin2 COLLATE=latin2_croatian_ci AUTO_INCREMENT=24 ;

--
-- Daten für Tabelle `korisnik`
--

INSERT INTO `korisnik` (`id`, `ime`, `prezime`, `korisnicko_ime`, `email`, `lozinka`, `kriptirana_lozinka`, `datum_registracije`, `status_potvrde`, `broj_promasaja`, `aktivacijski_kod`, `vrijeme_prijave`, `tip_korisnika`, `uvjeti_korištenja`) VALUES
(1, 'Lukas', 'Krišti?', 'lukkristi', 'lukkristi@foi.hr', 'Lukas5', 'lukas5', '4.4.2018.', '1', 0, '1', '20:00', 1, 1),
(2, 'Ivo', 'Krišti?', 'ivokristi', 'lukas-j.karburator@hotmail.com', 'Ivija24', 'Ivija24', '4.4.2018.', '1', 0, '1', '20:10', 1, 1),
(3, 'Toni', 'Kiralj', 'tonkira', 'tonikiralj@gmail.com', 'Toni911', 'Toni911', '5.4.2018.', '1', 1, '1', '13:00', 2, 1),
(4, 'Božica', 'Petri?', 'bozpetr', 'bozicapetric@gmail.com', 'Bozo3496', 'Bozo3496', '5.4.2018.', '1', 1, '1', '12:30', 2, 1),
(5, 'Marija', 'Vincijanovi?', 'marvinc', 'marijavincijanovic@gmail.com', 'Cimi37', 'Cimi37', '5.4.2018.', '1', 0, '1', '15:30', 2, 1),
(6, 'Ivana', 'Vincijanovi?', 'ivavinc', 'ivanavinci@gmail.com', 'Cinci74', 'Cinci74', '5.4.2018.', '1', 0, '1', '22:30', 3, 1),
(7, 'Jela', 'Topi?', 'bakuta', 'jelatopic@gmail.com', 'Roki21', 'Roki21', '3.4.2018.', '1', 0, '1', '14:05', 1, 1),
(8, 'Berislav', 'Bari?i?', 'berbaric', 'berislavbaricic@gmai.com', 'Bebrina4', 'Bebrina4', '3.4.2018.', '1', 2, '1', '15:12', 3, 1),
(9, 'Matej', 'Milobara', 'matmilob', 'matejmilobara@live.com', 'Cabo88', 'Cabo88', '3.4.2018.', '1', 3, '1', '11:31', 3, 1),
(10, 'Petar', 'Tomi?', 'pettomi', 'petartomic@hotmail.com', 'Crvenivrag1', 'Crvenivrag1', '4.4.2018.', '1', 3, '1', '04:24', 3, 1),
(13, 'Sakib', 'Mejic', 'samejic', 'hvala@yk20.com', 'jastreb', 'asdasdasd', '3.6.2018', '1', 0, '0', '23:46', 3, 1),
(15, 'Danijel', 'Ivic', 'Crnogorac', 'kunefu@loketa.com', '199053742', '5f0b13718b4b974ff2b858b04c0fd5f63ab72104', '04.06.2018', '1', 0, 'e0572e410a63acfbfb51187cfa3283ad', '2018-06-04 12:21:26', 3, 1),
(16, 'Slobo', 'Milan', 'sloba', 'sad@yk20.com', 'kilaza', 'f4092e16e9ff818985f48d555be359610c057e42', '06.06.2018', '1', 0, '817e154e744a1871b64c0e357b3c81ae', '2018-06-06 01:40:03', 3, 1),
(18, 'Macka', 'Lipovac', 'Macka', 'assad@yk20.com', '123456', '65d3d3db9cf0319f588b35e447e4c53b3e28cd60', '06.06.2018', '1', 0, '6d542ee3c3d2a94e46ab0e4842a955ac', '2018-06-06 20:16:09', 3, 1),
(19, 'David', 'Esegovic', 'segi5', 'segi@yk20.com', 'zelena', '90a1bbb8865713047c156e97aa7b83a7041802a3', '06.06.2018', '1', 0, '6ea99725487cfbc27d639e5087c20f2d', '2018-06-06 20:28:42', 3, 1),
(20, 'Becislav', 'Karan', 'Becislav', 'beco@fxprix.com', 'marama', '5d5dba14e8132bc604cdd31e8a6b1f09e531fdf2', '07.06.2018', '0', 3, '14fdd945c4a42e804ac90fdf15414c7b', '2018-06-06 21:09:51', 3, 1),
(21, 'Mirko', 'Juric', 'mirkec', 'mirko@yk20.com', '529087477', 'b036341d616602c501bca044461a87cf3ca8772f', '14.06.2018', '1', 3, 'b05869012531a185831a872ccf1d9f8b', '2018-06-14 23:24:16', 3, 1),
(22, 'Kolac', 'Cupavac', 'cupavac', 'cupko@yk20.com', 'kolacic', '87065d0f136e41df58a80f07b6cd950d29015dd0', '15.06.2018', '0', 0, 'a4a2ecb5761067ef1f9f6d2c5b195fac', '2018-06-15 01:51:02', 3, 1),
(23, 'Ivica', 'Olic', 'Ola555', 'hva@yk20.com', 'kameni', 'asdasdsa', '3.6.2018', '1', 0, 'asdasdasd342', '12:30', 2, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lokacija`
--

CREATE TABLE IF NOT EXISTS `lokacija` (
  `id` int(11) NOT NULL,
  `pozicijaX` int(11) NOT NULL,
  `pozicijaY` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `lokacija`
--

INSERT INTO `lokacija` (`id`, `pozicijaX`, `pozicijaY`) VALUES
(1, 200, '100'),
(2, 50, '60'),
(3, 100, '200'),
(4, 200, '200'),
(5, 80, '80');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lokacije_na_stranici`
--

CREATE TABLE IF NOT EXISTS `lokacije_na_stranici` (
  `stranica_id` int(11) NOT NULL,
  `lokacija_id` int(11) NOT NULL,
  `oglas` int(11) DEFAULT NULL,
  `kljuc` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`stranica_id`,`lokacija_id`),
  UNIQUE KEY `kljuc_UNIQUE` (`kljuc`),
  KEY `fk_stranica_has_lokacija_lokacija1_idx` (`lokacija_id`),
  KEY `fk_stranica_has_lokacija_stranica1_idx` (`stranica_id`),
  KEY `fk_lokacije_na_stranici_oglas1_idx` (`oglas`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Daten für Tabelle `lokacije_na_stranici`
--

INSERT INTO `lokacije_na_stranici` (`stranica_id`, `lokacija_id`, `oglas`, `kljuc`) VALUES
(1, 1, 1, 1),
(1, 2, 3, 2),
(2, 4, 6, 3),
(3, 3, 5, 4),
(6, 4, 2, 5);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `oglas`
--

CREATE TABLE IF NOT EXISTS `oglas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naslov` varchar(45) CHARACTER SET latin1 NOT NULL,
  `slika` blob,
  `tekst` text CHARACTER SET latin1 NOT NULL,
  `tip_oglasa` int(11) NOT NULL,
  `url` text CHARACTER SET latin1 NOT NULL,
  `vrijeme_pocetka_prikaza` time NOT NULL,
  `status` int(11) NOT NULL,
  `oglas_predlozio` int(11) NOT NULL,
  `broj_klikova` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tip_oglasa_idx` (`tip_oglasa`),
  KEY `fk_oglas_korisnik1_idx` (`oglas_predlozio`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin2 COLLATE=latin2_croatian_ci AUTO_INCREMENT=48 ;

--
-- Daten für Tabelle `oglas`
--

INSERT INTO `oglas` (`id`, `naslov`, `slika`, `tekst`, `tip_oglasa`, `url`, `vrijeme_pocetka_prikaza`, `status`, `oglas_predlozio`, `broj_klikova`) VALUES
(1, 'Prodajem Auto', NULL, 'Novi auto ', 1, 'www.mojauto.com', '12:00:00', 1, 6, 5),
(2, 'Prodajem Knjige', NULL, 'Cijela kolekcija Gospodara prstenova', 7, 'www.nesto.com', '13:00:00', 1, 6, 10),
(3, 'Prodajem Gitaru', NULL, 'Koristena gitara 2 mjeseca ', 8, 'www.gitara.cm', '15:00:00', 0, 8, 1),
(4, 'Iznajmljujem Stan', NULL, 'Iznajmljujem novo ure?eni stan', 2, 'www.mojstan.com', '20:00:00', 0, 9, 50),
(5, 'Iznajmljujem Brod', NULL, 'Iznajmljujem brod za jednodnevne izlete u Zadru', 4, 'www.rentabrod.com', '06:00:00', 1, 10, 23),
(6, 'Zamjena mobitela', NULL, 'Zamjena Iphone S8 za samsung S9', 6, 'www.mobitel.com', '10:00:00', 1, 9, 12),
(7, 'Iznajmljivanje soba', NULL, 'Iznajljujem sobe u Splitu za ultru', 3, 'www.apartmani.com', '09:00:00', 0, 6, 42),
(8, 'Prodaja zemljista u DUPCIMA', NULL, 'Dupci, manjim dijelom unutar gra?evinskog podru?ja i ve?im dijelom u zoni poljoprivrednog. Cijena po m².\r\nGradski plin i vodovod, telefon, te asfaltirani put.', 2, 'https://www.oglasnik.hr/zemljista-prodajem/dupci-manjim-dijelom-unutar-grad-vecim-poljoprivredno-6-264-m2-oglas-2293429', '13:00:00', 1, 16, 67),
(9, 'gradjevinske parcele ', NULL, 'Stupnik, gra?evinske prcele 500, 600, 700, 800 m², Ul. Sv. Benedikta, Donjostupni?ka ulica. Od 25 do 50 €/m².\r\nGradski plin, vodovod, telefon, te asfaltiran put.', 2, 'https://www.oglasnik.hr/zemljista-prodajem/stupnik-gradevinske-prcele-500-600-700-800-m2-oglas-2293423', '15:00:00', 1, 16, 31),
(14, 'Lucko , poljoprivredno zemljište', NULL, 'LUCKO –4811 m2 - poljoprivredno zemljiste s mogucnoti prenamjene u naselju Vrbice, povrsine 80x60m. Cijena po kvadratnom metru.\r\n\r\nKOMUNALIJE:\r\nGradski plinGradski vodovodTelefon Asfaltni put Uredna dokumentacija – vlasnicki list – namjena  sigurnost Stru?na pomo? kod prijenosa vlasništvaLicenca HGK\r\nKupac ne placa agencijsku proviziju', 2, 'https://www.oglasnik.hr/zemljista-prodajem/lucko-4-811-m2-poljoprivredno-zemljiste-s-mogucnoscu-prenamjene-oglas-2161915', '16:00:00', 1, 15, 123),
(15, 'Centar, Medvedgradska, izuzetan 3-sobni', NULL, 'Centar, Medvedgradska ulica- atraktivan dvoetazni 3-sobni stan u blizini Gliptoteke i Kaptol centra. Stan je dvostrane orijentacije u kvalitetnoj zgradi ( s novouredjenim krovistem) temeljito ureden 2010.g sa puno svjetla i lijepim pogledom na livadu i Gliptoteku. Sa infrastruktura na dohvat ruke. Donja etaza se sastoji od', 2, 'https://www.oglasnik.hr/stanovi-prodaja/centar-medvedgradska-izuzetan-3-sobni-dvoetazni-luksuzni-stan-oglas-3057562', '10:00:00', 1, 10, 175),
(25, 'VIVAX Point X1 blue, pametni telefon', NULL, 'Point X1 ima Quad-Core procesor koji uz 2GB RAM-a osigurava rad mnogo aplikacija u isto vrijeme. Memorija od 16GB se može proširiti do 128GB što omogu?ava da pohranite mnogo fotografija ili kreirate omiljene glazbene liste, a kao i ostali VIVAX mobiteli ima dual SIM utor. Mobitel ima zaslon veli?ine 5,2“ što je savršen omjer izme?u veli?ine i ?itkosti te elegancije ure?aja. Sa?uvajte najdragocjenije trenutke, a uz najnoviji hit tržišta koristite i dvostruku kameru gdje imate i dvostruko više mogu?nosti za savršene fotografije. Stražnje kamere imaju 13 MP i 5 MP, a jedna od mogu?nosti je i zamu?enje pozadine kako bi više istaknuli pojedini dio fotografije VIVAX Point X1 ne zadržava se samo na poboljšanim kamerama, nego ima i super tanki dizajn od samo 7,4 mm, metalno ku?ište i naravno identifikaciju putem otiska prsta. Ure?aj je dostupan u tri vrlo atraktive boje: crna, plava i crvena Dostupna je i dodatna silikonska maskica, te flip cover.', 6, 'https://www.oglasnik.hr/ostale-marke-mobitela/vivax-point-x1-blue-pametni-telefon-gratis-maskica-oglas-3426802', '12:00:00', 1, 18, 12),
(26, 'KB-SIGMA tipkovnica', NULL, 'MS KB-SIGMA+ SAMURAI CRNI. KB-SIGMA - ži?ana multimedijalna tipkovnica, 11 multimedijalnih slim tipki, metalni rub, USB priklju?ak. MS SAMURAI crni - PRO gaming ži?ani miš je opremljen sa 7 programibilnih tipki koje ?e vaše gaming iskustvo pretvoriti u pravo zadovoljstvo. Izmjenjiva rezolucija od 1000, 2000, 3200 dpi prilagodit ?e se svakoj vašoj potrebi. Miš dolazi sa pozadinskim osvijetljenjem u 7 boja, koje možete mijenjati kako želite. Zahvaljuju?i ergonomskom dizajnu zajedno sa gumenim anti-slip premazom, mo?i ?ete igrati satima. Miš ima AVAGO 3050 gaming ?ip, presvu?eni USB kabel 1.8m', 5, 'https://www.oglasnik.hr/tipkovnice-i-misevi/kb-sigma-samurai-crni-paket-oglas-3426798', '15:00:00', 1, 18, 36),
(29, 'PS4 Dualshock Controller v2 Steel Black', NULL, 'PS4 Dualshock Controller v2 Steel Black\n\nNenadmašna kontrola\nBeži?ni upravlja? DUALSHOCK 4 ažuriran je novim izgledom i završnom obradom, što obuhva?a vidljiviju, šareniju svjetlosnu traku koja ?e vam omogu?iti još izravnije upravljanje igrom. To je najergonomi?niji, najintuitivniji upravlja? za PlayStation ikada.', 5, 'https://www.oglasnik.hr/oprema-za-igrace-konzole/ps4-dualshock-controller-v2-steel-black-oglas-3426202', '10:00:00', 1, 18, 68),
(30, 'YAMAHA P-125B DIGITAL PIANO', NULL, 'Boja: Crna\nBroj tipki: 88, Graded hammer standard (GHS) keyboard, matte finish on black keys\nBroj polifonija: 192\nBroj zvukova: 24\nBroj pjesama: 21 demo songs and 50 piano songs\nBroj pjesama za snimanje: 1\nBroj matrica za snimanje: 2\nPoja?ala: 7 W x 2\nZvu?nici: 12 cm x 2 + 4 cm x 2\nPower Supply: PA-150B or other Yamaha-preferred parts\nŠirina: 1326mm\nVisina: 166mm\nDubina: 295mm\nTežina: 11.8kg', 8, 'https://www.oglasnik.hr/klaviri/yamaha-p-125b-digital-piano-oglas-3425989', '15:00:00', 1, 16, 36),
(31, 'Krakov i Bratislava Comfort: 4 dana', NULL, 'Krakov i Bratislava Comfort: 4 dana\r\nFULL PANSION 2 dana, obilazak svega', 3, 'https://www.oglasnik.hr/ponuda-odmor-i-smjestaj/krakov-i-bratislava-comfort-4-dana-oglas-3172967', '16:00:00', 1, 16, 12),
(32, 'Arthur C. Clarke Knjige', NULL, '1) "Grad i zvezde" (The City and the Stairs - 1952. god.), 220 stranica, "Prosveta" - Beograd, 1987. god.\r\n\r\n2) Matica Zemlja (Imperial Earth - 1975. god.), 228 stranica, "Prosveta" - Beograd, 1986. god.\r\n\r\n3) Sastanak sa Ramom (Randezvous With Rama - 1975. god.), 196 stranica, "Prosveta" - Beograd, 1986. god.\r\n\r\nKomplet - 100kn, pojedina?no 40kn/kom.\r\n\r\nPreuzimanje: OSOBNO na navedenoj adresi.\r\nAko šaljem poštom cijena je ve?a za 50kn.\r\nHvala.', 7, 'https://www.oglasnik.hr/beletristika/arthur-c-clarke-komplet-ili-pojedinacno-prodajem-oglas-3426934', '10:00:00', 1, 16, 5),
(33, 'Fiat 500 1. 2 8v pop', NULL, 'Zra?ni jastuci za voza?a i suvoza?a \r\nBo?ni zra?ni jastuci naprijed \r\nZra?ne zavjese \r\nZra?ni jastuk za koljena voza?a \r\nCentralno daljinsko zaklju?avanje \r\nElektronska blokada motora \r\nElektri?no podizanje prednjih prozora \r\nElektri?no podešavanje vanjskih retrovizora \r\nBrisa? stražnjeg stakla ', 1, 'https://www.oglasnik.hr/prodaja-automobila/fiat-500-1-2-8v-pop-oglas-2550250', '06:00:00', 1, 16, 45),
(34, 'Skoda octavia 2008 god', NULL, '130 000 km, registrirana i servisirana prije mjesec dana. Trebam hitno novce.', 1, 'www.mojoglas.com/skodaOctavia2008', '10:00:00', 1, 19, 10),
(35, 'Paulo Coelho kolekcija', NULL, 'po knjizti 100 kn', 7, 'www.PauloCoelho.com', '18:00:00', 1, 13, 18),
(36, 'Kofer za harmoniku 120b', NULL, 'Kofer za harmoniku 120b kao nov ispravan!', 8, 'https://www.oglasnik.hr/harmonike/kofer-za-harmoniku-120b-oglas-3427045', '09:00:00', 1, 13, 6),
(37, 'ALHAMBRA 3C SERIA S KLASICNA GITARA', NULL, 'Gitara Alhambra 3C serija S popularan model za glazbenu školu zbog svoje izuzetne svirljivosti i ?isto?e zvuka. Posebna pažnja je tako?er bila poduzeta za vrijeme osmišljavanja instrumenta, daju?i mu više stilski oblik. Dakle, model 3C serija S ne oslanja se samo na svoj izgled, a najzahtjevniji glazbenici shvatit ?e da je ova gitara više od susreta s okom.', 8, 'https://www.oglasnik.hr/akusticna-gitara/alhambra-3c-seria-s-klasicna-gitara-oglas-3322095', '17:35:00', 99, 13, 53),
(38, 'Mlada i slatka Dea traži novi dom', NULL, 'Dea je mlada cura, prekrasne svijetle dlake i tamne njuškice. Dlaka joj je malo duža, ali njuškica je prava staffordska. Vesela je, razigrana, društvena i zdrava. Mazna Dea nalazi se u Skloništu za nezbrinute životinje u Li?u i ?eka svoju novu obitelj. Ova ?upava ljepotica ?eka na svoj topli dom. Malena je rastom pa može na?i mjesto u svakom stanu :) Cijepljena, ?ipirana (troškove pla?a udomitelj prilikom udomljenja = 250,00kn) . Br ?ipa 191100000814374\r\nSterilizirana', 9, 'https://www.oglasnik.hr/udomljavanje/mlada-i-slatka-dea-trazi-novi-dom-oglas-2143166', '13:00:00', 1, 19, 108),
(39, 'Hans traži novi dom', NULL, 'Hans je mladi ljepotan u tipu njema?kog ov?ara, a jednim malo "zgužvanim" uhecom :) . razigran, pun energije, savršen za nekoga tko je aktivan i voli boraviti vani. Ipak, Hans želi obitelj samo za sebe. Nije veliki ljubitelj drugih pasa i želi biti jedini mezimac. ;) Ako trebate nekog da vas pokrene, Hans je pravi za to.\r\n\r\nHans ?eka u Skloništu za nezbrinute životinje Li?: 091/214-8855', 9, 'https://www.oglasnik.hr/udomljavanje/mlada-i-slatka-dea-trazi-novi-dom-oglas-2143166', '13:00:00', 1, 18, 108),
(40, 'Kombajn', NULL, 'Prodaje se stari kombajn FAHR, godine 1958. Za dijelove ili u cijelosti.', 10, 'https://www.oglasnik.hr/kombajni/kombajn-oglas-3431833', '08:00:00', 1, 16, 38),
(41, 'Traktor Fiat 450 DT, 81g., 4x4 45KS', NULL, 'Traktor Fiat 450 DT, 81g., 4x4 45KS, u odli?nom stanju', 10, 'https://www.oglasnik.hr/traktori/traktor-fiat-450-dt-81g-4x4-45ks-oglas-3431131', '09:00:00', 0, 16, 0),
(43, 'Aparat za varenje Uljanik TBH 140', NULL, 'Prodaje se aparat za varenje Uljanik TBH 140 A ,rabljen, ispravan.\n\ncijena: 600 kn\nGrad Zagreb\n091/250-5263', 12, 'https://www.oglasnik.hr/rucni-strojevi-i-alati-prodaja/aparat-za-varenje-uljanik-tbh-140-oglas-3428493', '13:00:00', 1, 8, 88),
(44, 'Polirka za aute, brodove, farove, nova', NULL, 'vicaHrastek (Prikaži sve oglase)\r\nLokacija  Jankomir, Stenjevec, Grad Zagreb\r\nTelefon  091/904-6858\r\ncijena: 399 kn\r\nProdajem novu neraspakiranu profesionalnu polirku 180mm snage 2450w kvalitetna robusna izvedba,pogodna za poliranje automobila, brodova, farova, inoxa, namještaja…', 12, 'https://www.oglasnik.hr/rucni-strojevi-i-alati-prodaja/polirka-za-aute-brodove-farove-nova-nekoristena-oglas-3428268', '21:00:00', 0, 9, 0),
(45, 'Stolac za ljuljanje', NULL, 'Zagreb - Okolica, Grad Zagreb\r\n\r\nTelefon  091/919-1397\r\n\r\ncijena: 1.100 kn\r\nO?uvan i ?vrste konstrukcije. Manja ošte?enja laka su vidljiva na slikama pa ga je potrebno prelakirati. Mogu?a primopredaja na Trešnjevci.\r\n\r\n', 11, 'https://www.oglasnik.hr/antikviteti/stolac-za-ljuljanje-oglas-3341224', '11:30:00', 1, 7, 0),
(46, 'Zidni sat, stari', NULL, 'branegajic\r\nLokacija  Velika Gorica, Zagreba?ka\r\nTelefon  097/777-9640, 095/520-2181\r\ncijena: 200 kn\r\n\r\nSatovi, stari, zidni, 200 kn fiksno.', 11, 'https://www.oglasnik.hr/antikviteti/zidni-sat-stari-oglas-424635', '10:00:00', 0, 6, 0),
(47, 'Antikna masivna komoda / bar', NULL, 'avica, Trnje, Grad Zagreb\r\n\r\nTelefon  098/234-238, 091/502-0898\r\n\r\ncijena: 2.950 kn\r\n\r\nPredivna komoda, sve pravo drvo,u izvanrednom stanju.\r\nMože se koristiti kao bar ( otvara se gornja polica bez otvaranja gornje plo?e, a može se i otvorit gornja plo?a).\r\nVrlo efektan komad koji se ne susre?e baš ?esto. Dimenzije 110x60- donji dio komode ,širina 50 cm, visina 100 cm.\r\nSve informacije na 091-5020-898.', 11, 'https://www.oglasnik.hr/antikviteti/antikna-masivna-komoda-bar-oglas-3428445', '18:00:00', 1, 8, 10);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `prijaveljni_oglas`
--

CREATE TABLE IF NOT EXISTS `prijaveljni_oglas` (
  `korisnik` int(11) NOT NULL,
  `oglas` int(11) NOT NULL,
  `razlog` text NOT NULL,
  PRIMARY KEY (`korisnik`,`oglas`),
  KEY `fk_korisnik_has_oglas_oglas1_idx` (`oglas`),
  KEY `fk_korisnik_has_oglas_korisnik1_idx` (`korisnik`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `prijaveljni_oglas`
--

INSERT INTO `prijaveljni_oglas` (`korisnik`, `oglas`, `razlog`) VALUES
(6, 3, 'Gitara je nesipravna '),
(8, 7, 'Uvrijedljiva ponuda'),
(16, 1, 'Auto je vec  prodan '),
(16, 15, 'Ne primjeren sadrzaj'),
(16, 26, 'link ne radi'),
(16, 32, 'Url ne radi'),
(16, 35, 'Ostala jedna knjiga i trebate maknit oglas'),
(16, 37, 'Slika se ne prikazuje');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rezervacija`
--

CREATE TABLE IF NOT EXISTS `rezervacija` (
  `korisnik` int(11) NOT NULL,
  `sobe` int(11) NOT NULL,
  `dolazak` date NOT NULL,
  `odlazak` date NOT NULL,
  `trajanje` int(11) NOT NULL,
  PRIMARY KEY (`korisnik`,`sobe`),
  KEY `fk_korisnik_has_sobe_sobe1_idx` (`sobe`),
  KEY `fk_korisnik_has_sobe_korisnik1_idx` (`korisnik`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `rezervacija`
--

INSERT INTO `rezervacija` (`korisnik`, `sobe`, `dolazak`, `odlazak`, `trajanje`) VALUES
(6, 1, '2018-04-05', '2018-04-11', 6),
(8, 10, '2018-04-19', '2018-04-30', 11),
(9, 4, '2018-04-09', '2018-04-13', 4),
(9, 9, '2018-06-13', '2018-06-16', 3),
(10, 2, '2018-09-02', '2018-09-06', 4),
(10, 6, '2018-04-11', '2018-04-13', 2),
(15, 8, '2018-06-20', '2018-06-29', 9),
(21, 5, '2018-06-26', '2018-06-30', 4),
(21, 6, '2018-06-28', '2018-07-27', 30);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sobe`
--

CREATE TABLE IF NOT EXISTS `sobe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `broj` varchar(45) NOT NULL,
  `slika` blob,
  `opis` text NOT NULL,
  `velicina` int(11) NOT NULL,
  `hotel_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sobe_hotel1_idx` (`hotel_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Daten für Tabelle `sobe`
--

INSERT INTO `sobe` (`id`, `broj`, `slika`, `opis`, `velicina`, `hotel_id`) VALUES
(1, '23', NULL, 'Soba sa pogledom na more', 1, 8),
(2, '71', NULL, 'VIP soba', 3, 9),
(3, '10', NULL, 'Apartman za obitelj s pomocnim krevetom', 3, 3),
(4, '12', NULL, 'Dvokrevetna soba za malde parove', 2, 2),
(5, '31', NULL, 'Jednokrevetna soba za poslovne ljude sa minibarom ', 1, 3),
(6, '15', NULL, 'Dvokrevetn soba sa klimom i balkonom te pogledom u prirodu', 2, 2),
(7, '35', NULL, 'Dvokrevetna soba za medeni mjesec', 2, 8),
(8, '11', NULL, 'Dvokrevetna soba za jednokratni smjestaj', 2, 1),
(9, '8', NULL, 'Jednokrevetna soba za opustanje ', 1, 6),
(10, '55', NULL, 'Dvokrevetna luksuzna soba ', 2, 5),
(11, '23', '', '', 0, 2),
(12, '81', '', 'Apartman sa lijepim pogledom', 2, 11),
(13, '1', '', '', 0, 2),
(14, '55', '', 'luksuzna soba', 5, 8),
(15, '121', '', 'Dvokrevetna soba sa pogledom na prirodu', 2, 6),
(16, '6', '', 'Pogled na Farmu', 4, 5),
(17, '6', '', 'Pogled na Farmu', 4, 5);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `stranica`
--

CREATE TABLE IF NOT EXISTS `stranica` (
  `id` int(11) NOT NULL,
  `naziv` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `stranica`
--

INSERT INTO `stranica` (`id`, `naziv`) VALUES
(1, 'Po?etna'),
(2, 'Prijava'),
(3, 'O nama'),
(4, 'Moji oglasi'),
(5, 'Registracija'),
(6, 'Hoteli'),
(7, 'Sobe');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tip_korisnika`
--

CREATE TABLE IF NOT EXISTS `tip_korisnika` (
  `id` int(11) NOT NULL,
  `naziv` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `tip_korisnika`
--

INSERT INTO `tip_korisnika` (`id`, `naziv`) VALUES
(1, 'Administrator'),
(2, 'Moderator'),
(3, 'RegistriraniKorisnik');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tip_oglasa`
--

CREATE TABLE IF NOT EXISTS `tip_oglasa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(45) NOT NULL,
  `visina` int(11) NOT NULL,
  `sirina` int(11) NOT NULL,
  `cijena` int(11) NOT NULL,
  `trajanje` int(11) NOT NULL,
  `brzina_izmjene` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Daten für Tabelle `tip_oglasa`
--

INSERT INTO `tip_oglasa` (`id`, `naziv`, `visina`, `sirina`, `cijena`, `trajanje`, `brzina_izmjene`) VALUES
(1, 'Auto-Moto', 100, 200, 100, 5, 5),
(2, 'Nekretnine', 200, 200, 150, 7, 10),
(3, 'Turizam', 200, 400, 200, 20, 30),
(4, 'Nautika', 100, 100, 80, 10, 10),
(5, 'Informatika', 200, 200, 150, 10, 2),
(6, 'Mobiteli', 100, 100, 100, 5, 5),
(7, 'Literatura', 100, 200, 140, 10, 15),
(8, 'Glazbala', 200, 100, 150, 6, 5),
(9, 'Kucni ljubimci', 100, 100, 80, 4, 2),
(10, 'Strojevi', 200, 100, 130, 3, 15),
(11, 'Kolekcionarstvo', 80, 100, 70, 5, 10),
(12, 'Alati', 80, 80, 70, 3, 10),
(13, 'Biciklizam', 80, 100, 95, 6, 15);

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `dodijeljeni_moderator`
--
ALTER TABLE `dodijeljeni_moderator`
  ADD CONSTRAINT `fk_korisnik_has_tip_oglasa_korisnik1` FOREIGN KEY (`moderator`) REFERENCES `korisnik` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_korisnik_has_tip_oglasa_tip_oglasa1` FOREIGN KEY (`tip_oglasa`) REFERENCES `tip_oglasa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `hotel_moderator`
--
ALTER TABLE `hotel_moderator`
  ADD CONSTRAINT `fk_hotel_has_korisnik_hotel1` FOREIGN KEY (`hotel`) REFERENCES `hotel` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_hotel_has_korisnik_korisnik1` FOREIGN KEY (`moderator`) REFERENCES `korisnik` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `korisnik`
--
ALTER TABLE `korisnik`
  ADD CONSTRAINT `tip_korisnika` FOREIGN KEY (`tip_korisnika`) REFERENCES `tip_korisnika` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `lokacije_na_stranici`
--
ALTER TABLE `lokacije_na_stranici`
  ADD CONSTRAINT `fk_lokacije_na_stranici_oglas1` FOREIGN KEY (`oglas`) REFERENCES `oglas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_stranica_has_lokacija_lokacija1` FOREIGN KEY (`lokacija_id`) REFERENCES `lokacija` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_stranica_has_lokacija_stranica1` FOREIGN KEY (`stranica_id`) REFERENCES `stranica` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `oglas`
--
ALTER TABLE `oglas`
  ADD CONSTRAINT `fk_oglas_korisnik1` FOREIGN KEY (`oglas_predlozio`) REFERENCES `korisnik` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tip_oglasa` FOREIGN KEY (`tip_oglasa`) REFERENCES `tip_oglasa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `prijaveljni_oglas`
--
ALTER TABLE `prijaveljni_oglas`
  ADD CONSTRAINT `fk_korisnik_has_oglas_korisnik1` FOREIGN KEY (`korisnik`) REFERENCES `korisnik` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_korisnik_has_oglas_oglas1` FOREIGN KEY (`oglas`) REFERENCES `oglas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `rezervacija`
--
ALTER TABLE `rezervacija`
  ADD CONSTRAINT `fk_korisnik_has_sobe_korisnik1` FOREIGN KEY (`korisnik`) REFERENCES `korisnik` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_korisnik_has_sobe_sobe1` FOREIGN KEY (`sobe`) REFERENCES `sobe` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `sobe`
--
ALTER TABLE `sobe`
  ADD CONSTRAINT `fk_sobe_hotel1` FOREIGN KEY (`hotel_id`) REFERENCES `hotel` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
