-- phpMyAdmin SQL Dump
-- version 3.5.8.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 14, 2013 at 01:50 AM
-- Server version: 5.5.32-0ubuntu0.13.04.1
-- PHP Version: 5.4.9-4ubuntu2.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `csm`
--

-- --------------------------------------------------------

--
-- Table structure for table `attribute`
--

CREATE TABLE IF NOT EXISTS `attribute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `attribute`
--

INSERT INTO `attribute` (`id`, `name`, `description`) VALUES
(1, 'Duch', 'Odzwierciedla wrodzony spokój\r\nducha oraz siłę woli. Jest bardzo istotny, gdyż pomaga otrząsnąć się z szoku wywołanego przez rany.'),
(2, 'Siła', 'To tężyzna fizyczna i ogólne wysportowanie. Determinuje ponadto obrażenia, zadawane w walce wręcz.'),
(3, 'Spryt', 'Mierzy, jak dobrze postać zna świat\r\ni kulturę, czy zachowuje przytomność umysłu w trudnych sytuacjach i określa ogólną błyskotliwość bohatera.'),
(4, 'Wigor', 'Określa wytrzymałość, odporność na choroby i trucizny oraz informuje, jak wiele bólu i fizycznego cierpienia postać zdoła znieść.'),
(5, 'Zręczność', 'Odpowiada za zwinność i chyżość bohatera.');

-- --------------------------------------------------------

--
-- Table structure for table `edge`
--

CREATE TABLE IF NOT EXISTS `edge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `edge`
--

INSERT INTO `edge` (`id`, `name`, `description`) VALUES
(1, 'Bez przebaczenia', 'Postać może wydać fuksa, by przerzucić rzut na obrażenia. W przypadku ataków obszarowych, każdy fuks odpowiada ranom zadanym jednemu przeciwnikowi.'),
(2, 'Chyży', 'Tempo postaci zwiększa się o +2. Jeśli biegnie, rzuca k10 zamiast k6.'),
(3, 'Dobywanie', 'Dzięki tej Przewadze bohater może dobyć\r\nbroni nie otrzymując standardowego modyfikatora -2 do testu ataku w tej samej rundzie. Jeśli postać jest zmuszona wykonać test Zręczności, by sięgnąć po oręż (szczegóły znajdziesz w rozdziale\r\nopisującym walkę), otrzymuje premię +2.'),
(4, 'Garda', 'Bohater, który często trafia w sam środek\r\nbójki, zazwyczaj wie, jak wyjść z niej cało. Nauczył się nie tylko atakować, ale także skutecznie blokować ciosy przeciwnika. Posiadacz tej przewagi otrzymuje premię +1 do Obrony.'),
(5, 'Podwójna garda', 'Jak ''Garda'', z tym że Obrona zwiększa\r\nsię o +2.'),
(6, 'Grad ciosów', 'Wyprowadzając Grad ciosów, wojownik\r\nwykonuje serię błyskawicznych, zaciekłych ataków, niezbyt może precyzyjnych, ale za to wściekle szybkich. Przewaga pozwala wykonać\r\nw rundzie dodatkowy atak wręcz. Wykonuje\r\ngo jednocześnie z podstawowym atakiem, choć może obrać za cel innego przeciwnika znajdującego się w zasięgu. Od obydwu testów trafienia odejmuje -2. Figury rzucają dwiema kośćmi Walki i tylko jedną Kością Figury (jak podczas\r\nstrzelania serią), modyfikując o -2 wszystkie wyniki.\r\n\r\nPostać uzbrojona w dwie bronie może wykonać tylko jeden dodatkowy atak.'),
(7, 'Nawałnica ciosów', 'Jak ''Grad Ciosów'', z tym, że postać ignoruje karę -2.'),
(8, 'Nerwy ze stali', 'Twój bohater potrafi walczyć nawet, gdy\r\nprzeszywa go piekielny ból. Możesz zignorować 1 punkt modyfikatora z Ran.'),
(9, 'Nerwy z tytanu', 'Bohater ignoruje 2 punkty modyfikatora\r\nza odniesione Rany.'),
(10, 'Opanowany', 'Prawdziwi wojownicy potrafią wziąć\r\nsię w garść, gdy cała reszta biega w panice i szuka schronienia. To właśnie czyni z nich przerażających przeciwników.\r\nPosiadacz tej przewagi otrzymuje\r\nw walce 2 karty inicjatywy i działa na\r\nwyższej.'),
(11, 'Wyjątkowo opanowany', 'Jak ''Opanowany'', z tym że postać ciągnie 3\r\nkarty.'),
(12, 'Pewna ręka', 'Twój bohater ignoruje karę za niestabilne\r\npodłoże, gdy strzela z grzbietu pędzącego\r\nwierzchowca lub z jadącego pojazdu.'),
(13, 'Podwójne uderzenie', 'Twoja postać niekoniecznie jest oburęczna\r\n– ale wyszkolono ją w walce dwiema sztukami oręża (lub obiema pięściami) jednocześnie. Atakując bronią w każdej ręce, bohater wykonuje dwa testy, ignorując karę za wykonanie kilku akcji w turze.'),
(14, 'Rock and Roll!', 'Doświadczeni strzelcy potrafią radzić sobie z odrzutem broni automatycznej. Jeśli posiadacz tej przewagi się nie porusza, może zignorować karę za strzelanie ogniem ciągłym.'),
(15, 'Sokole oko', 'Bohater słynie jako znakomity strzelec. Jeśli w tej turze się nie przemieszcza, może strzelać, jakby wykonał manewr celowania. Tej przewagi nie można nigdy użyć z bronią o szybkostrzelności\r\nwiększej niż 1.\r\nSokole oko zapewnia premię zarówno do\r\nStrzelania, jak Rzucania.'),
(16, 'Szermierz', 'Postać jest wprawnym szermierzem,\r\nposługującym się stylem florenckim – dwoma\r\nostrzami jednocześnie. Otrzymuje premię +1\r\ndo testów Walki, jeżeli przeciwnik używa jednej broni i nie posiada tarczy. Ponadto, gdy atakuje go wielu przeciwników, ich premia do ataku\r\nzmniejsza się o -1, ponieważ bohater używa\r\ndwóch wirujących ostrzy, by parować ich ciosy.'),
(17, 'Szybki cios', 'O ile bohater nie jest w Szoku, może podczas każdej tury wykonać jeden szybki jak myśl, darmowy atak wręcz, przeciwko wrogowi, który właśnie wchodzi z nim w zwarcie. Atakując w ten sposób, automatycznie przerywasz akcję przeciwnika, a samemu nie tracisz akcji, jeżeli ją wstrzymałeś lub jeszcze jej nie wykonałeś.'),
(18, 'Błyskawiczny cios', 'Jak ''Szybki cios'', z tym że bohater może\r\nwykonać jeden darmowy atak przeciwko\r\nkażdemu przeciwnikowi, który próbuje\r\nwejść z nim w zwarcie.'),
(19, 'Twardziel', 'Twój bohater ma więcej żyć, niż stado kotów. Jeśli zostanie Wyeliminowany i musi przetestować Wigor, może zignorować ujemne modyfikatory z Ran. Zasadę stosuje się tylko do testów Wigoru związanych z Eliminacją – Rany modyfikują wszystkie inne testy współczynników.'),
(20, 'Niezniszczalny', 'Twojego bohatera trudniej wysłać do\r\npiachu, niż Rasputina.\r\nJeśli postać ma umrzeć, rzuć kością.\r\nJeśli wynik jest nieparzysty, umiera. Parzysty rezultat oznacza, że pozostaje Wyeliminowana, ale jakoś udało się jej wymknąć z objęć kostuchy. Być może zostanie pojmana, ogołocona z całego dobytku, albo przez przypadek pozostawiona na pastwę losu, ale cudem udało się jej przetrwać.'),
(21, 'Ulubiona broń', 'Bohater posiada wyjątkową broń (Excalibur, Zwiastun Burzy, Lux albo Szczerbiec), którą potrafi doskonale władać. Gdy nią walczy, dodaje +1 do testów Walki, Strzelania, czy Rzucania.\r\nTę przewagę można wykupić kilkukrotnie, za każdym razem wybierając inny oręż. Jeśli postać straci ulubioną broń, może zastąpić ją innym egzemplarzem, ale premia z przewagi zacznie działać dopiero po dwóch tygodniach czasu gry.'),
(22, 'Ukochana broń', 'Jak ''Ulubiona broń'', ale premia z Ukochanej broni wzrasta do +2.'),
(23, 'Unik', 'Niektórzy bohaterowie to cwani goście, którzy zawsze potrafią znaleźć się tam, gdzie akurat nie latają kule. Dzięki tej Przewadze umieją wykorzystywać osłony, kryć się i pozostawać w ciągłym ruchu, by utrudnić strzelcom trafienie.\r\nJeżeli nie zostali ostrzelani z zaskoczenia, przeciwnik odejmuje -1 od wszystkich rzutów na Strzelanie i Rzucanie. Jeśli postać próbuje uniknąć ataku obszarowego, dodaje +1 do testu Zręczności.'),
(24, 'Błyskawiczny unik', 'Jak ''Unik'', z tym że przeciwnik odejmuje\r\n-2 od rzutów na atak, a unikając ataków obszarowych postać dodaje +2 do testów Zręczności.'),
(25, 'Zabójca olbrzymów', 'Im większy potwór, tym trudniej go ubić.\r\nJednak twój bohater dobrze zna słabe punkty olbrzymich bestii.\r\nBohater zadaje +1k6 dodatkowych obrażeń,\r\njeśli walczy z istotą o co najmniej trzy Rozmiary większą od siebie. Na przykład ogr (Rozmiar +3), posiadający tę przewagę, otrzyma premię w walce z istotą o Rozmiarze +6 lub większą. Z drugiej strony, człowiek będący Zabójcą olbrzymów (Rozmiar 0) zadaje dodatkowe obrażenia w walce z ogrem.'),
(26, 'Zamaszyste cięcie', 'Zamaszyste cięcie pozwala bohaterowi wykonać pojedynczy atak wręcz przeciwko wszystkim pobliskim postaciom (wrogom i sojusznikom – bądź ostrożny!). Trafienie testuje raz, rzucając na Walkę z modyfikatorem -2, natomiast rzuty\r\nna obrażenia wykonuje dla każdego trafionego osobno. Atak mierzy wyłącznie w istoty znajdujące się w pobliżu bohatera w chwili jego wyprowadzenia.\r\nZamaszystego cięcia nie można wykonać\r\nw tej samej rundzie, w której postać wyprowadzała Grad ciosów, ani wiele razy w ciągu jednej rundy.'),
(27, 'Niezwykle zamaszyste cięcie', 'Jak ''Zamaszyste cięcie'', ale bohater może zignorować karę -2.'),
(28, 'Zaprawiony w walce', 'Twój bohater potrafi naprawdę szybko otrząsnąć się i dojść do siebie. Otrzymuje +2 do testów Ducha na potrzeby wychodzenia z Szoku.');

-- --------------------------------------------------------

--
-- Table structure for table `hindrance`
--

CREATE TABLE IF NOT EXISTS `hindrance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `hindrance`
--

INSERT INTO `hindrance` (`id`, `name`, `description`) VALUES
(1, 'a', 'asda'),
(2, 'b', 'daf'),
(3, 'Dzwoni mama', 'Opis');

-- --------------------------------------------------------

--
-- Table structure for table `power`
--

CREATE TABLE IF NOT EXISTS `power` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `power`
--

INSERT INTO `power` (`id`, `name`, `description`) VALUES
(1, 'Pocisk', 'opis'),
(2, 'Tarcza', 'opis'),
(3, 'Leczenie', 'opis');

-- --------------------------------------------------------

--
-- Table structure for table `sheet`
--

CREATE TABLE IF NOT EXISTS `sheet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `race_id` int(11) NOT NULL,
  `appearance` text NOT NULL,
  `archetype` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `exp` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `sheet`
--

INSERT INTO `sheet` (`id`, `user_id`, `name`, `race_id`, `appearance`, `archetype`, `description`, `exp`) VALUES
(1, 1, 'Naklatanox', 1, 'Koks', 'Press R to win', 'No kurwa Naklatanox!!!', 60),
(2, 1, 'Naklatanox', 1, 'Koks', 'Press R to win', 'No kurwa Naklatanox!!!', 60);

-- --------------------------------------------------------

--
-- Table structure for table `sheet_attribute`
--

CREATE TABLE IF NOT EXISTS `sheet_attribute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sheet_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `sheet_attribute`
--

INSERT INTO `sheet_attribute` (`id`, `sheet_id`, `attribute_id`, `value`) VALUES
(1, 1, 1, 4),
(2, 1, 2, 6),
(3, 1, 3, 6),
(4, 1, 4, 13),
(5, 1, 5, 8);

-- --------------------------------------------------------

--
-- Table structure for table `sheet_edge`
--

CREATE TABLE IF NOT EXISTS `sheet_edge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sheet_id` int(11) NOT NULL,
  `edge_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `sheet_edge`
--

INSERT INTO `sheet_edge` (`id`, `sheet_id`, `edge_id`) VALUES
(4, 1, 1),
(5, 1, 2),
(6, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `sheet_hindrance`
--

CREATE TABLE IF NOT EXISTS `sheet_hindrance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sheet_id` int(11) NOT NULL,
  `hindrance_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `sheet_hindrance`
--

INSERT INTO `sheet_hindrance` (`id`, `sheet_id`, `hindrance_id`) VALUES
(4, 1, 1),
(5, 1, 2),
(6, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `sheet_power`
--

CREATE TABLE IF NOT EXISTS `sheet_power` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `power_id` int(11) NOT NULL,
  `sheet_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `sheet_power`
--

INSERT INTO `sheet_power` (`id`, `power_id`, `sheet_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sheet_skill`
--

CREATE TABLE IF NOT EXISTS `sheet_skill` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sheet_id` int(11) NOT NULL,
  `skill_id` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `sheet_skill`
--

INSERT INTO `sheet_skill` (`id`, `sheet_id`, `skill_id`, `value`) VALUES
(1, 1, 1, 6),
(2, 1, 2, 6),
(3, 1, 3, 12),
(4, 1, 1, 6),
(5, 1, 2, 6),
(6, 1, 3, 12);

-- --------------------------------------------------------

--
-- Table structure for table `skill`
--

CREATE TABLE IF NOT EXISTS `skill` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `attribute_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `skill`
--

INSERT INTO `skill` (`id`, `name`, `description`, `attribute_id`) VALUES
(1, 'Walka', 'Description', 1),
(2, 'Przekonywanie', 'Description', 2),
(3, 'Tropienie', 'opis', 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
