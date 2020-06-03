-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Φιλοξενητής: 127.0.0.1
-- Χρόνος δημιουργίας: 30 Σεπ 2018 στις 23:11:34
-- Έκδοση διακομιστή: 10.1.31-MariaDB
-- Έκδοση PHP: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `delivery`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `dianomeas`
--

CREATE TABLE `dianomeas` (
  `username_dian` varchar(25) NOT NULL,
  `password_dian` varchar(25) NOT NULL,
  `onoma_dian` varchar(50) NOT NULL,
  `epwnumo_dian` varchar(50) NOT NULL,
  `AFM_dian` int(10) NOT NULL,
  `AMKA_dian` bigint(11) NOT NULL,
  `IBAN_dian` char(27) NOT NULL,
  `katastash_dian` enum('Ενεργός','Μη διαθέσιμος','Ανενεργός') NOT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `start_bardia` datetime NOT NULL,
  `dianomes` int(11) NOT NULL,
  `km` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `dianomeas`
--

INSERT INTO `dianomeas` (`username_dian`, `password_dian`, `onoma_dian`, `epwnumo_dian`, `AFM_dian`, `AMKA_dian`, `IBAN_dian`, `katastash_dian`, `latitude`, `longitude`, `start_bardia`, `dianomes`, `km`) VALUES
('leuterhs', 'leuterhs1234567', 'Λευτέρης', 'Καρτάλης', 1566234568, 13445678912, 'GR1212567891234567891234568', 'Ανενεργός', 0, 0, '2018-09-30 12:47:44', 0, 0),
('petros', 'petros1234567', 'Πέτρος', 'Ιωάννου', 1676734567, 13445000012, 'GR1212560000034567891234568', 'Ανενεργός', 0, 0, '2018-09-30 12:45:51', 0, 0);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `diathetei`
--

CREATE TABLE `diathetei` (
  `onoma_kat` varchar(50) NOT NULL,
  `code_proiontos` varchar(255) NOT NULL,
  `apothema` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `diathetei`
--

INSERT INTO `diathetei` (`onoma_kat`, `code_proiontos`, `apothema`) VALUES
('eXpresso Agias Sofias', '01ellhnikos', 'άπειρο'),
('eXpresso Agias Sofias', '02frape', 'άπειρο'),
('eXpresso Agias Sofias', '03espresso', 'άπειρο'),
('eXpresso Agias Sofias', '04cappuccino', 'άπειρο'),
('eXpresso Agias Sofias', '05filtrou', 'άπειρο'),
('eXpresso Agias Sofias', '06turopita', '143'),
('eXpresso Agias Sofias', '07xortopita', '98'),
('eXpresso Agias Sofias', '08koulouri', '100'),
('eXpresso Agias Sofias', '09tost', '100'),
('eXpresso Agias Sofias', '10keik', '50'),
('eXpresso Benizelou', '01ellhnikos', 'άπειρο'),
('eXpresso Benizelou', '02frape', 'άπειρο'),
('eXpresso Benizelou', '03espresso', 'άπειρο'),
('eXpresso Benizelou', '04cappuccino', 'άπειρο'),
('eXpresso Benizelou', '05filtrou', 'άπειρο'),
('eXpresso Benizelou', '06turopita', '98'),
('eXpresso Benizelou', '07xortopita', '98'),
('eXpresso Benizelou', '08koulouri', '100'),
('eXpresso Benizelou', '09tost', '98'),
('eXpresso Benizelou', '10keik', '100'),
('eXpresso kentro', '01ellhnikos', 'άπειρο'),
('eXpresso kentro', '02frape', 'άπειρο'),
('eXpresso kentro', '03espresso', 'άπειρο'),
('eXpresso kentro', '04cappuccino', 'άπειρο'),
('eXpresso kentro', '05filtrou', 'άπειρο'),
('eXpresso kentro', '06turopita', '0'),
('eXpresso kentro', '07xortopita', '100'),
('eXpresso kentro', '08koulouri', '94'),
('eXpresso kentro', '09tost', '94'),
('eXpresso kentro', '10keik', '97'),
('eXpresso Maragkopoulou', '01ellhnikos', 'άπειρο'),
('eXpresso Maragkopoulou', '02frape', 'άπειρο'),
('eXpresso Maragkopoulou', '03espresso', 'άπειρο'),
('eXpresso Maragkopoulou', '04cappuccino', 'άπειρο'),
('eXpresso Maragkopoulou', '05filtrou', 'άπειρο'),
('eXpresso Maragkopoulou', '06turopita', '39'),
('eXpresso Maragkopoulou', '07xortopita', '100'),
('eXpresso Maragkopoulou', '08koulouri', '100'),
('eXpresso Maragkopoulou', '09tost', '100'),
('eXpresso Maragkopoulou', '10keik', '100'),
('eXpresso Rio', '01ellhnikos', 'άπειρο'),
('eXpresso Rio', '02frape', 'άπειρο'),
('eXpresso Rio', '03espresso', 'άπειρο'),
('eXpresso Rio', '04cappuccino', 'άπειρο'),
('eXpresso Rio', '05filtrou', 'άπειρο'),
('eXpresso Rio', '06turopita', '70'),
('eXpresso Rio', '07xortopita', '80'),
('eXpresso Rio', '08koulouri', '99'),
('eXpresso Rio', '09tost', '100'),
('eXpresso Rio', '10keik', '98');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `diaxeirisths`
--

CREATE TABLE `diaxeirisths` (
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `diaxeirisths`
--

INSERT INTO `diaxeirisths` (`username`, `password`) VALUES
('kon_mon', '1234567');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `katasthma`
--

CREATE TABLE `katasthma` (
  `onoma` varchar(50) NOT NULL,
  `odos` varchar(50) NOT NULL,
  `arithmos` int(11) NOT NULL,
  `TK` int(5) DEFAULT NULL,
  `thlefwno` varchar(10) DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `manager_fk` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `katasthma`
--

INSERT INTO `katasthma` (`onoma`, `odos`, `arithmos`, `TK`, `thlefwno`, `latitude`, `longitude`, `manager_fk`) VALUES
('eXpresso Agias Sofias', 'Agias Sofias', 54, 26441, '2610354987', 38.256099, 21.74548, 1222345678),
('eXpresso Benizelou', 'Eleutheriou Benizelou', 5, 26222, '2610234530', 38.22876, 21.742261, 1455632431),
('eXpresso kentro', 'Pantanassis', 65, 26225, '2610214365', 38.244496, 21.734825, 1556234567),
('eXpresso Maragkopoulou', 'Maragkopoulou', 2, 26331, '2610123654', 38.237795, 21.747575, 1223245671),
('eXpresso Rio', 'Somerset', 66, 26444, '2610342112', 38.300957, 21.782196, 1123456782);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `manager`
--

CREATE TABLE `manager` (
  `username_man` varchar(25) NOT NULL,
  `password_man` varchar(25) NOT NULL,
  `onoma_man` varchar(50) NOT NULL,
  `epwnumo_man` varchar(50) NOT NULL,
  `AFM_man` int(10) NOT NULL,
  `AMKA_man` bigint(11) DEFAULT NULL,
  `IBAN_man` char(27) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `manager`
--

INSERT INTO `manager` (`username_man`, `password_man`, `onoma_man`, `epwnumo_man`, `AFM_man`, `AMKA_man`, `IBAN_man`) VALUES
('stelios', 'stelios1234567', 'Στέλιος', 'Παπαδόπουλος', 1123456782, 12345678912, 'GR1234567891234567891234567'),
('panos', 'panos1234567', 'Παναγιώτης', 'Ιωάννου', 1222345678, 22341234567, 'GR1801111400000004012345678'),
('dimitra', 'dimitra1234567', 'Δήμητρα', 'Καρακάση', 1223245671, 14423634531, 'GR1640000123456782380012345'),
('xristina', 'xristina1234567', 'Χριστίνα', 'Γεωργίου', 1455632431, 11115432678, 'GR1601100400000004012345678'),
('basilis', 'basilis1234567', 'Βασίλης', 'Μαλτέζος', 1556234567, 11223343254, 'GR1601100400234500000401678');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `misthodosia_dian`
--

CREATE TABLE `misthodosia_dian` (
  `AFM_dian` int(11) NOT NULL,
  `mhnas` date NOT NULL,
  `km` double NOT NULL,
  `wres` int(11) NOT NULL,
  `misthos_dian` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `misthodosia_dian`
--

INSERT INTO `misthodosia_dian` (`AFM_dian`, `mhnas`, `km`, `wres`, `misthos_dian`) VALUES
(1566234568, '2018-08-00', 8795, 38, '499.87'),
(1566234568, '2018-09-00', 12566, 0, '1.26'),
(1676734567, '2018-09-00', 2534, 0, '0.25');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `misthodosia_man`
--

CREATE TABLE `misthodosia_man` (
  `katasthma` varchar(50) NOT NULL,
  `mhnas` date NOT NULL,
  `tziros` decimal(10,2) NOT NULL,
  `misthos_man` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `misthodosia_man`
--

INSERT INTO `misthodosia_man` (`katasthma`, `mhnas`, `tziros`, `misthos_man`) VALUES
('eXpresso Agias Sofias', '2018-08-00', '2.90', '800.06'),
('eXpresso Agias Sofias', '2018-09-00', '3.30', '800.07'),
('eXpresso Benizelou', '2018-09-00', '5.90', '800.12'),
('eXpresso kentro', '2018-08-00', '1.20', '800.02'),
('eXpresso Maragkopoulou', '2018-08-00', '96.20', '801.92');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `paraggelia`
--

CREATE TABLE `paraggelia` (
  `id_par` int(9) NOT NULL,
  `kostos` decimal(10,2) NOT NULL,
  `katastash_par` enum('Παραδόθηκε','Εκκρεμεί') NOT NULL DEFAULT 'Εκκρεμεί',
  `katasthma_fk` varchar(50) DEFAULT NULL,
  `dianomeas_fk` int(10) DEFAULT NULL,
  `pelaths_fk` int(9) DEFAULT NULL,
  `dieuthunsh` varchar(255) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `hmeromhnia` date NOT NULL,
  `apostash` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `paraggelia`
--

INSERT INTO `paraggelia` (`id_par`, `kostos`, `katastash_par`, `katasthma_fk`, `dianomeas_fk`, `pelaths_fk`, `dieuthunsh`, `latitude`, `longitude`, `hmeromhnia`, `apostash`) VALUES
(92, '1.10', 'Παραδόθηκε', 'eXpresso kentro', 1566234568, 11, 'Καραϊσκάκη 146, Πάτρα 262 21, Ελλάδα', 38.244232815879734, 21.735576907409722, '2018-09-29', 1815),
(93, '1.90', 'Παραδόθηκε', 'eXpresso Agias Sofias', 1566234568, 11, 'Κορίνθου 289, Πάτρα 262 21, Ελλάδα', 38.24544617929323, 21.734976092590387, '2018-09-29', 4046),
(94, '3.30', 'Παραδόθηκε', 'eXpresso Maragkopoulou', 1566234568, 11, 'Σωτηριάδου 14-16, Πάτρα 262 25, Ελλάδα', 38.24312054829237, 21.738323489440972, '2018-09-29', 4692),
(95, '2.90', 'Παραδόθηκε', 'eXpresso kentro', 1566234568, 11, 'Ρήγα Φεραίου 96, Πάτρα 262 21, Ελλάδα', 38.24750210995448, 21.734504023803765, '2018-09-29', 1592),
(96, '2.90', 'Παραδόθηκε', 'eXpresso Agias Sofias', 1566234568, 11, 'Ανδρούτσου 43, Πάτρα 262 25, Ελλάδα', 38.24871541879651, 21.743816653503472, '2018-09-29', 3093),
(97, '96.20', 'Παραδόθηκε', 'eXpresso Maragkopoulou', 1566234568, 11, 'Βότσαρη 85, Πάτρα 263 31, Ελλάδα', 38.23995217764459, 21.742014209045465, '2018-09-29', 3439),
(98, '1.20', 'Παραδόθηκε', 'eXpresso kentro', 1566234568, 11, 'Φρουρίου 34, Πάτρα 262 25, Ελλάδα', 38.245547291996814, 21.74210003973394, '2018-09-29', 2263),
(99, '1.50', 'Παραδόθηκε', 'eXpresso kentro', 1566234568, 10, 'Υψηλών Αλωνίων 11, Πάτρα 262 24, Ελλάδα', 38.241671204386286, 21.735834399475152, '2018-09-30', 1440),
(100, '5.90', 'Παραδόθηκε', 'eXpresso Benizelou', 1566234568, 11, 'Κλυτεμνιστρς 11, Πάτρα 263 32, Ελλάδα', 38.22491738839752, 21.74111298681646, '2018-09-30', 4016),
(101, '1.40', 'Παραδόθηκε', 'eXpresso Agias Sofias', 1676734567, 11, 'Νόρμαν 148, Πάτρα 262 23, Ελλάδα', 38.25127678206175, 21.747421542419488, '2018-09-30', 2534),
(102, '1.90', 'Παραδόθηκε', 'eXpresso Agias Sofias', 1566234568, 11, 'Κεφαλληνίας 13, Πάτρα 264 41, Ελλάδα', 38.2562644409448, 21.74579075933832, '2018-09-30', 5670);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `pelaths`
--

CREATE TABLE `pelaths` (
  `id_pelath` int(9) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_pelath` varchar(255) NOT NULL,
  `onoma_pelath` text NOT NULL,
  `thlefwno_pelath` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `pelaths`
--

INSERT INTO `pelaths` (`id_pelath`, `email`, `password_pelath`, `onoma_pelath`, `thlefwno_pelath`) VALUES
(9, 'maria@yahoo.gr', 'fb6701e6abe7b366ffafe4394ec00631fb6640cf', 'Μαρία Οικονόμου', '6912345678'),
(10, 'katia@hotmail.com', '38bb7660c5aa6416742228880a311dc3023eb909', 'Κατερίνα Ελευθερίου', '6901010121'),
(11, 'athina@gmail.com', '78f96502a57900b7614d98764e4b5027c88433a0', 'Αθηνά Σταθάτου', '2610721322');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `periexei`
--

CREATE TABLE `periexei` (
  `id_par` int(11) NOT NULL,
  `id_proiontos` varchar(255) NOT NULL,
  `posothta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `periexei`
--

INSERT INTO `periexei` (`id_par`, `id_proiontos`, `posothta`) VALUES
(92, '01ellhnikos', 1),
(93, '06turopita', 1),
(94, '03espresso', 1),
(94, '06turopita', 1),
(95, '01ellhnikos', 1),
(95, '07xortopita', 1),
(96, '04cappuccino', 1),
(96, '05filtrou', 1),
(97, '02frape', 1),
(97, '06turopita', 50),
(98, '02frape', 1),
(99, '09tost', 1),
(100, '02frape', 1),
(100, '04cappuccino', 2),
(100, '09tost', 1),
(101, '03espresso', 1),
(102, '06turopita', 1);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `proionta`
--

CREATE TABLE `proionta` (
  `eidos` enum('Ελληνικός','Φραπέ','Εσπρέσο','Καπουτσίνο','Φίλτρου','Τυρόπιτα','Χορτόπιτα','Κουλούρι','Τοστ','Κέικ') NOT NULL,
  `code` varchar(255) NOT NULL,
  `timh` decimal(10,2) NOT NULL,
  `eikona` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `proionta`
--

INSERT INTO `proionta` (`eidos`, `code`, `timh`, `eikona`) VALUES
('Ελληνικός', '01ellhnikos', '1.10', 'images/menu/ellhnikos.jpg'),
('Φραπέ', '02frape', '1.20', 'images/menu/frape.jpg'),
('Εσπρέσο', '03espresso', '1.40', 'images/menu/espresso.jpg'),
('Καπουτσίνο', '04cappuccino', '1.60', 'images/menu/kapoutsino.jpg'),
('Φίλτρου', '05filtrou', '1.30', 'images/menu/filtrou.jpg'),
('Τυρόπιτα', '06turopita', '1.90', 'images/menu/turopita.jpg'),
('Χορτόπιτα', '07xortopita', '1.80', 'images/menu/xortopita.jpg'),
('Κουλούρι', '08koulouri', '0.50', 'images/menu/koulouri.jpg'),
('Τοστ', '09tost', '1.50', 'images/menu/tost.png'),
('Κέικ', '10keik', '2.00', 'images/menu/keik.jpg');

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `dianomeas`
--
ALTER TABLE `dianomeas`
  ADD PRIMARY KEY (`AFM_dian`),
  ADD UNIQUE KEY `username_dian` (`username_dian`);

--
-- Ευρετήρια για πίνακα `diathetei`
--
ALTER TABLE `diathetei`
  ADD PRIMARY KEY (`onoma_kat`,`code_proiontos`),
  ADD KEY `onoma_kat` (`onoma_kat`),
  ADD KEY `code_proiontos` (`code_proiontos`);

--
-- Ευρετήρια για πίνακα `diaxeirisths`
--
ALTER TABLE `diaxeirisths`
  ADD PRIMARY KEY (`username`);

--
-- Ευρετήρια για πίνακα `katasthma`
--
ALTER TABLE `katasthma`
  ADD PRIMARY KEY (`onoma`),
  ADD UNIQUE KEY `manager_fk_2` (`manager_fk`),
  ADD KEY `manager_fk` (`manager_fk`) USING BTREE;

--
-- Ευρετήρια για πίνακα `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`AFM_man`);

--
-- Ευρετήρια για πίνακα `misthodosia_dian`
--
ALTER TABLE `misthodosia_dian`
  ADD PRIMARY KEY (`AFM_dian`,`mhnas`),
  ADD KEY `AFM_dian` (`AFM_dian`);

--
-- Ευρετήρια για πίνακα `misthodosia_man`
--
ALTER TABLE `misthodosia_man`
  ADD PRIMARY KEY (`katasthma`,`mhnas`),
  ADD KEY `katasthma` (`katasthma`);

--
-- Ευρετήρια για πίνακα `paraggelia`
--
ALTER TABLE `paraggelia`
  ADD PRIMARY KEY (`id_par`),
  ADD KEY `katasthma_fk` (`katasthma_fk`),
  ADD KEY `dianomeas_fk` (`dianomeas_fk`),
  ADD KEY `pelaths_fk` (`pelaths_fk`);

--
-- Ευρετήρια για πίνακα `pelaths`
--
ALTER TABLE `pelaths`
  ADD PRIMARY KEY (`id_pelath`);

--
-- Ευρετήρια για πίνακα `periexei`
--
ALTER TABLE `periexei`
  ADD PRIMARY KEY (`id_par`,`id_proiontos`),
  ADD KEY `id_par` (`id_par`),
  ADD KEY `id_proiontos` (`id_proiontos`);

--
-- Ευρετήρια για πίνακα `proionta`
--
ALTER TABLE `proionta`
  ADD PRIMARY KEY (`code`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `paraggelia`
--
ALTER TABLE `paraggelia`
  MODIFY `id_par` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT για πίνακα `pelaths`
--
ALTER TABLE `pelaths`
  MODIFY `id_pelath` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Περιορισμοί για άχρηστους πίνακες
--

--
-- Περιορισμοί για πίνακα `diathetei`
--
ALTER TABLE `diathetei`
  ADD CONSTRAINT `diathetei_ibfk_1` FOREIGN KEY (`onoma_kat`) REFERENCES `katasthma` (`onoma`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `diathetei_ibfk_2` FOREIGN KEY (`code_proiontos`) REFERENCES `proionta` (`code`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `katasthma`
--
ALTER TABLE `katasthma`
  ADD CONSTRAINT `katasthma_ibfk_1` FOREIGN KEY (`manager_fk`) REFERENCES `manager` (`AFM_man`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `misthodosia_dian`
--
ALTER TABLE `misthodosia_dian`
  ADD CONSTRAINT `misthodosia_dian_ibfk_1` FOREIGN KEY (`AFM_dian`) REFERENCES `dianomeas` (`AFM_dian`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `misthodosia_man`
--
ALTER TABLE `misthodosia_man`
  ADD CONSTRAINT `misthodosia_man_ibfk_1` FOREIGN KEY (`katasthma`) REFERENCES `katasthma` (`onoma`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `paraggelia`
--
ALTER TABLE `paraggelia`
  ADD CONSTRAINT `paraggelia_ibfk_1` FOREIGN KEY (`katasthma_fk`) REFERENCES `katasthma` (`onoma`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `paraggelia_ibfk_2` FOREIGN KEY (`dianomeas_fk`) REFERENCES `dianomeas` (`AFM_dian`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `paraggelia_ibfk_3` FOREIGN KEY (`pelaths_fk`) REFERENCES `pelaths` (`id_pelath`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `periexei`
--
ALTER TABLE `periexei`
  ADD CONSTRAINT `periexei_ibfk_1` FOREIGN KEY (`id_par`) REFERENCES `paraggelia` (`id_par`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `periexei_ibfk_2` FOREIGN KEY (`id_proiontos`) REFERENCES `proionta` (`code`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
