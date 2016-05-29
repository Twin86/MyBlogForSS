-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: 192.168.101.57
-- Czas wygenerowania: 29 Maj 2016, 15:08
-- Wersja serwera: 5.5.41-37.0-log
-- Wersja PHP: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `sibi_blog`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategorie`
--

CREATE TABLE IF NOT EXISTS `kategorie` (
  `id_kategori` int(6) NOT NULL AUTO_INCREMENT,
  `title` varchar(60) CHARACTER SET latin2 NOT NULL,
  `opis` text CHARACTER SET latin2,
  `on_off` int(1) NOT NULL,
  `parent` int(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_kategori`),
  UNIQUE KEY `id_kategori_UNIQUE` (`id_kategori`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=25 ;

--
-- Zrzut danych tabeli `kategorie`
--

INSERT INTO `kategorie` (`id_kategori`, `title`, `opis`, `on_off`, `parent`) VALUES
(1, 'News', 'Wszystko to co ostatnio w sporcie się wydażyło.', 1, 0),
(2, 'Wyniki', 'Najnowsze informacje z boisk najlepszych lig piłkarskich !', 1, 0),
(3, 'Szatnia', 'Najnowsze informacje pozabojskowe, bo wiadomo że najważniejsza jest atmosfera !', 1, 0),
(4, 'Kto i gdzie', 'Najnowsze informacje transferowe, śledz na bierząco kto gdzie przeszedł, dlaczego i ile mu za to dali ! ', 1, 0),
(5, 'Hiszpania', 'Wiadomości z słonecznej Hiszpani, La Liga, ole !', 1, 2),
(6, 'Anglia', 'Wiadomości z deszczowej Premier League !', 1, 2),
(7, 'Niemcy', 'Wiadomości z ligi niemieckiej !', 1, 2),
(8, 'Puchary', 'Wiadomości z Ligi Mistrzów oraz Ligi Europy, wyniki, relacje i wiele innych  !', 1, 0),
(9, 'Liga Mistrzów', 'Wiadomości z Ligi Mistrzów, komentarze do meczów, relacje live from tv', 1, 8),
(10, 'Liga Europy', 'Wiadomości z Ligi Europy, komentarze do meczów, relacje live from tv', 1, 8),
(13, 'Sieroty', 'Kategoria dla wpisów z kategorii usuniętej. ', 0, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `komentarze`
--

CREATE TABLE IF NOT EXISTS `komentarze` (
  `id_koment` int(6) NOT NULL AUTO_INCREMENT,
  `komentarz` text COLLATE utf8_unicode_ci NOT NULL,
  `czas_kom` time NOT NULL,
  `data_kom` date NOT NULL,
  `id_user` int(6) NOT NULL,
  `id_wpis` int(6) NOT NULL,
  `no_login_nick` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_koment`),
  KEY `fk_kom_to_wpis_id` (`id_wpis`),
  KEY `fk_kom_users_id` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=53 ;

--
-- Zrzut danych tabeli `komentarze`
--

INSERT INTO `komentarze` (`id_koment`, `komentarz`, `czas_kom`, `data_kom`, `id_user`, `id_wpis`, `no_login_nick`) VALUES
(1, '<p>Litwo! Ojczyzno moja! Ty jesteś jak zdrowie. Ile cię trzeba cenić, ten tylko się zadziwił lecz w głównym sądzie w tylu lat kilku dzieje tego dnia powiadał. Dobrze, mój kus cap ! - nowe wiary, prawa, toalety. Miała nad brzegiem ruczaju na świecie jeśli równie kłaść na brzegu niegdyś zarosłym pokrzywą był tytuł demokraty. Wreszcie po łacinie. Mężczyznom dano jako wierzchołki drzewa cały las i inni, więcej książkowej nauki. Ale wszyscy siedli i porządek. Brama na siano. w niebo, miecz oburącz trzyma. Takim był, wyznawał: był żonaty a wszystko ze świecami \nw Litwie Woźny umiał komponować iżby je napełnił myślami. Po cóż kłócić się ziemi.</p>', '21:44:10', '2016-04-18', 1, 1, NULL),
(2, '<p>Goście weszli w niemieckiej karecie. Sam Woźny po tobie. Panno Święta, co je posłyszał, znikał nagle z legiją Dunaj tam pogląda, gdzie panieńskim rumieńcem dzięcielina pała a w Petersburgu mieszkała przed laty, nad błękitnym Niemnem rozciągnionych. Do zobaczenia! tak Suwarów w stodołę miał długie, cienkie, jak kochał pana Tadeusza. W biegu dotknęła blisko siebie leżące wstecz nagle pierwsze zamiary odmienił kazał, aby w paryskich kawiarniach. Bo nie zmruża jako gwiazda w takim Litwinka tylko widział swych domysłów tajnie! Więc do zwierciadła. Wtem brząknął w jasełkach ukryte chłopięta. Biegła i objął gospodarstwo. przyrzekł na tem, Że przed wieścią dla wieku, urodzenia, rozumu, urzędu.</p>', '21:45:02', '2016-04-18', 1, 1, NULL),
(6, '<p>Goście weszli w niemieckiej karecie. Sam Woźny po tobie. Panno Święta, co je posłyszał, znikał nagle z legiją Dunaj tam pogląda, gdzie panieńskim rumieńcem dzięcielina pała a w Petersburgu mieszkała przed laty, nad błękitnym Niemnem rozciągnionych. Do zobaczenia! tak Suwarów w stodołę miał długie, cienkie, jak kochał pana Tadeusza. W biegu dotknęła blisko siebie leżące wstecz nagle pierwsze zamiary odmienił kazał, aby w paryskich kawiarniach. Bo nie zmruża jako gwiazda w takim Litwinka tylko widział swych domysłów tajnie! Więc do zwierciadła. Wtem brząknął w jasełkach ukryte chłopięta. Biegła i objął gospodarstwo. przyrzekł na tem, Że przed wieścią dla wieku, urodzenia, rozumu, urzędu.</p>', '22:44:30', '2016-04-18', 1, 3, NULL),
(8, '<p>Goście weszli w niemieckiej karecie. Sam Woźny po tobie. Panno Święta, co je posłyszał, znikał nagle z legiją Dunaj tam pogląda, gdzie panieńskim rumieńcem dzięcielina pała a w Petersburgu mieszkała przed laty, nad błękitnym Niemnem rozciągnionych. Do zobaczenia! tak Suwarów w stodołę miał długie, cienkie, jak kochał pana Tadeusza. W biegu dotknęła blisko siebie leżące wstecz nagle pierwsze zamiary odmienił kazał, aby w paryskich kawiarniach. Bo nie zmruża jako gwiazda w takim Litwinka tylko widział swych domysłów tajnie! Więc do zwierciadła. Wtem brząknął w jasełkach ukryte chłopięta. Biegła i objął gospodarstwo. przyrzekł na tem, Że przed wieścią dla wieku, urodzenia, rozumu, urzędu.</p>', '22:44:36', '2016-04-18', 1, 4, NULL),
(9, '<p>Litwo! Ojczyzno moja! Ty jesteś jak zdrowie. Ile cię trzeba cenić, ten tylko się zadziwił lecz w głównym sądzie w tylu lat kilku dzieje tego dnia powiadał. Dobrze, mój kus cap ! - nowe wiary, prawa, toalety. Miała nad brzegiem ruczaju na świecie jeśli równie kłaść na brzegu niegdyś zarosłym pokrzywą był tytuł demokraty. Wreszcie po łacinie. Mężczyznom dano jako wierzchołki drzewa cały las i inni, więcej książkowej nauki. Ale wszyscy siedli i porządek. Brama na siano. w niebo, miecz oburącz trzyma. Takim był, wyznawał: był żonaty a wszystko ze świecami \nw Litwie Woźny umiał komponować iżby je napełnił myślami. Po cóż kłócić się ziemi.</p>', '22:44:50', '2016-04-18', 1, 5, NULL),
(12, 'Test3', '12:25:51', '2016-04-27', 1, 11, NULL),
(13, 'To liga niemiecka przestaje mieć jakikolwiek sens, bo jeżeli Bayern sam nie zacznie strzelać sobie bramek to znów zrobią miastra :(', '12:51:17', '2016-04-27', 1, 11, NULL),
(14, 'Milik w Interze, wow a czemu nie, trzeba iść do przodu. Jeżeli dadzą mu szansę to będzie dobrze.', '12:55:00', '2016-04-27', 1, 6, NULL),
(19, 'Mój kolejny komentarz:)', '14:38:05', '2016-05-09', 2, 17, NULL),
(20, 'A co ja mogę powiedzieć, nic ciekawego. Jeszcze z dwa sezony a cała Borusia będzie czerwona.', '23:24:23', '2016-05-09', 2, 11, NULL),
(22, 'Prawdziwy fenomen co mogę powiedzieć, podaje,strzela ale wieku nie oszukasz, czas trochę chyba odpuścić.', '22:57:09', '2016-05-11', 2, 19, NULL),
(23, 'Testowicz, dlaczego powtarzasz moje posty ? ', '22:59:36', '2016-05-11', 3, 19, NULL),
(24, 'A pytaj tego kto napisał tego bloga, chyba sam się nie zna na robocie :)', '23:00:29', '2016-05-11', 2, 19, NULL),
(25, '<p> onet </p> ds asd as', '15:44:28', '2016-05-12', 1, 19, NULL),
(26, '<b> czy ja wiem </b>', '15:44:55', '2016-05-12', 1, 19, NULL),
(28, 'Witaj testowicz fajnie że wpadłeś :)', '13:12:03', '2016-05-13', 1, 17, NULL),
(32, 'Coś czuję że to Euro będzie przełomowe, tylko żeby chłopaki w siebie uwierzyły.', '14:56:19', '2016-05-19', 1, 22, NULL),
(36, 'O coś źle zadziałało, chyba trzeba sprawdzić tego geta :)', '15:00:37', '2016-05-19', 1, 22, NULL),
(37, 'Słyszeliście że Wszołek złamał rękę, to się nazywa fart', '15:58:48', '2016-05-19', 12, 19, NULL),
(39, 'test', '15:45:59', '2016-05-23', 17, 25, NULL),
(44, 'test2', '18:25:46', '2016-05-23', 18, 25, 'Jasiek'),
(45, 'I to się nazywa miszczu :)', '18:49:00', '2016-05-23', 18, 1, 'Wacek'),
(46, 'Testuje mały bug', '22:15:38', '2016-05-23', 18, 25, 'Twin86'),
(47, 'I czy kogoś to jeszcze obchodzi ?', '22:34:04', '2016-05-23', 18, 23, 'Smutny gość'),
(48, 'Niby się dogadał a dalej w Realu siedzi, nigdzie nie pójdzie, jestem tego pewien.', '15:01:46', '2016-05-24', 18, 19, 'Kowalski'),
(49, 'W wielkiej piłce niczego nie możesz być pewien.', '15:03:04', '2016-05-24', 18, 19, 'Seba'),
(50, 'Teraz euro i wszystko się okaże, mam tylko nadzieję że nasz super duet strzeli kilka bramek :)', '16:55:27', '2016-05-24', 18, 6, 'Napaleniec'),
(51, 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi', '15:36:55', '2016-05-25', 18, 23, 'Blogorek'),
(52, 'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound', '15:37:25', '2016-05-25', 18, 23, 'Smutny');

-- --------------------------------------------------------

--
-- Zastąpiona struktura widoku `max_id_in_wpisy`
--
CREATE TABLE IF NOT EXISTS `max_id_in_wpisy` (
`max(id_wpis) +1` bigint(12)
);
-- --------------------------------------------------------

--
-- Zastąpiona struktura widoku `sub_kategorie`
--
CREATE TABLE IF NOT EXISTS `sub_kategorie` (
`id_kategori` int(6)
,`title` varchar(60)
,`opis` text
,`on_off` int(1)
,`parent` int(6)
);
-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) CHARACTER SET latin2 NOT NULL,
  `surname` varchar(45) CHARACTER SET latin2 NOT NULL,
  `password` varchar(16) CHARACTER SET latin2 NOT NULL,
  `url_avatar` varchar(45) CHARACTER SET latin2 DEFAULT NULL,
  `email` varchar(45) CHARACTER SET latin2 NOT NULL,
  `nick` varchar(12) CHARACTER SET latin2 NOT NULL,
  `permissions` int(1) NOT NULL DEFAULT '1',
  `is_lock` int(1) NOT NULL DEFAULT '0',
  `hash_pass` char(40) COLLATE utf8_unicode_ci NOT NULL,
  `salt` char(4) COLLATE utf8_unicode_ci NOT NULL,
  `permissions_name` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `id_user_UNIQUE` (`id_user`),
  UNIQUE KEY `nick_UNIQUE` (`nick`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=20 ;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id_user`, `name`, `surname`, `password`, `url_avatar`, `email`, `nick`, `permissions`, `is_lock`, `hash_pass`, `salt`, `permissions_name`) VALUES
(1, 'Sebastian', 'Tarka', '12345678', '', 'twin86@gmail.com', 'Twin86', 2, 1, '22227d933222e065f56c77286f14de064e1e0f40', '3O8e', 'Admin'),
(2, 'Janek', 'Testowicz', '12345678', '', 'testowy@email.com', 'Testowicz', 1, 0, '', '', 'Bloger'),
(3, 'Janek', 'Kowalski', '1234', '', 'kowalski@gmail.com', 'Kowalski', 1, 1, '', '', 'Bloger'),
(4, 'Grzegorz', 'Budzyn', '1234', NULL, 'grzegorz@grzegorz.pl', 'Gregorio', 2, 1, '', '', 'Admin'),
(5, 'Piotrek', 'Łuszczak', '1234567890', '', 'piotrek@luszczak.pl', 'Grafitowy', 1, 1, 'd8c4924f2b245082102220218557988ab93e1f4b', 'DyYP', 'Bloger'),
(6, 'Józek', 'Kowalik', '1234', '', 'jozek@jegomail.com', 'Kowalik', 1, 1, '77e97cc176b0c88b7d60ca4984b36323793b6e52', 'waTE', 'Bloger'),
(7, 'Sebek', 'Wik', '12345678', '', 'wik@gmail.com', 'TerWik', 1, 1, '330e9a6727eded43d4200d1ddbc0e5371331ab96', '2TKG', 'Bloger'),
(8, 'jakis', 'Jakies', '87654321', '', 'yrz@onet.pl', 'xyz', 1, 1, '529d031e99d9be512436bf5882be2ea75baa18c7', '5QRu', 'Bloger'),
(9, 'Sebastian', 'Tarka', 'Qazwsx12', '', 'sibi.polska@gmail.com', 'sibi', 1, 1, '06ef438a1b0068d4ddce37239939461e04eb60fd', 'JI8L', 'Bloger'),
(10, 'Sebek', 'Jakiś', '12345678', '', 'qwert@gmail.com', 'Bedzie_OK', 1, 1, 'd672bdedc7b2f851ce395fcab3db2069a895eb51', 'lLPo', 'Bloger'),
(11, 'Sabina', 'Jamroz', '12345678', '', 'sabex2@onet.pl', 'Sabinex', 1, 1, 'aa43622b015083495c7a965db06422269e313a8d', 'qMgL', 'Bloger'),
(12, 'Hieronim', 'Wacławek', '12345678', '', 'hierro@gmail.com', 'Hieronim', 1, 0, '2103942bc8e02939dd13efca63780b7e2235c8da', 'CXEe', 'Bloger'),
(13, 'MajaX', 'SablewskaX', '12345678', '', 'szabla2X@onet.pl', 'Majka', 1, 0, '83b2f5b3ca16cffcacf770780946eadf2b62d1f8', '5H71', '(select users.permissions_name'),
(15, 'MajaXX', 'SablewskaXX', '12345678', '', 'szabla2XX@onet.pl', 'Majka1', 1, 0, '83b2f5b3ca16cffcacf770780946eadf2b62d1f8', '5H71', 'Bloger'),
(16, 'Piotr', 'Tarka', 'WiciaSamoZlo', '', 'wicia12@onet.pl', 'Piter', 2, 1, '312d59eb6840218e9b03dff11ec9e442162f346a', 'WHAw', 'Admin'),
(17, 'Łukasz', 'Szukała', '12345678', '', 'szukala@onet.pl', 'Szukala', 1, 0, 'db011fae9da7783ee9387e676b0bee405e4d9bf2', '9ae', 'Bloger'),
(18, 'anonim', 'anonim', '12345678', '', 'anonim', 'anonim', 1, 0, '', '', 'Bloger'),
(19, 'xyz', 'xyz', '12345678', '', 'zzzz@onet.pl', 'Tester', 1, 1, '3c2a7a4f53fec35a2400524edf07644ecb787c8b', '11UY', 'Bloger');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wiadomosci`
--

CREATE TABLE IF NOT EXISTS `wiadomosci` (
  `id_msg` int(6) NOT NULL AUTO_INCREMENT,
  `tytul` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tresc` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `id_user` int(6) DEFAULT NULL,
  `is_read` int(1) NOT NULL,
  PRIMARY KEY (`id_msg`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Zrzut danych tabeli `wiadomosci`
--

INSERT INTO `wiadomosci` (`id_msg`, `tytul`, `tresc`, `email`, `id_user`, `is_read`) VALUES
(1, '', '', 'sibi.polska@gmail.com', NULL, 0),
(2, '', 'jakas wiadomosc ziekuje', 'asas@gmail.com', NULL, 0),
(3, 'Wiadomość z bloga', 'Wiadomość testowa, dziękuję za kontakt ', 'twin86@gmail.com', NULL, 0),
(4, 'Wiadomość z bloga', 'hello nie spinaj sie :D', 'grz@sciema.pl', NULL, 1),
(5, 'Wiadomość z bloga', 'Wiadomość testowa', 'twin86@gmail.com', NULL, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wpisy`
--

CREATE TABLE IF NOT EXISTS `wpisy` (
  `id_wpis` int(6) NOT NULL AUTO_INCREMENT,
  `title` tinytext COLLATE utf8_unicode_ci,
  `wpis` text CHARACTER SET latin2,
  `url_wpis` varchar(60) CHARACTER SET latin2 NOT NULL,
  `data_wpis` date DEFAULT NULL,
  `czas_wpis` time DEFAULT NULL,
  `autor_wpis_id` int(6) NOT NULL,
  `img_url` varchar(125) CHARACTER SET latin2 DEFAULT NULL,
  `szablon_id` int(6) NOT NULL,
  `kat_id` int(6) NOT NULL,
  `on_off` int(1) NOT NULL,
  PRIMARY KEY (`id_wpis`),
  UNIQUE KEY `id_wpis_UNIQUE` (`id_wpis`),
  KEY `fk_user_id` (`autor_wpis_id`),
  KEY `fk_kat_id` (`kat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=26 ;

--
-- Zrzut danych tabeli `wpisy`
--

INSERT INTO `wpisy` (`id_wpis`, `title`, `wpis`, `url_wpis`, `data_wpis`, `czas_wpis`, `autor_wpis_id`, `img_url`, `szablon_id`, `kat_id`, `on_off`) VALUES
(1, 'To nie był spalony', 'Lorem ipsum dolor sit amet dignissim dolor eget est. Vivamus orci molestie a, bibendum varius nec, sagittis eleifend. Nulla in tortor augue, congue id, urna. Cras ut metus. Curabitur condimentum nulla. Nullam consequat ligula nunc, rhoncus et, tincidunt nec, sem. Quisque consectetuer congue ac, felis. Mauris id augue. Sed condimentum ante ipsum dolor sit amet, consectetuer ac, laoreet ante ullamcorper pede ultrices mi. Cras vitae velit tempus urna eu mauris. Pellentesque fringilla neque scelerisque eu, tortor. Cras lacus lorem, at sapien sodales lectus urna luctus orci, placerat quam. Nunc leo. In hac habitasse platea dictumst. Praesent feugiat. Proin non tincidunt augue quis ante. Vestibulum tincidunt. Praesent scelerisque sem. Quisque eu justo. Vestibulum cursus tristique, augue eu odio eget.', 'page.php?id=1', '2016-05-14', '09:32:25', 1, ' img/uploads/637e05b4ec7beac7072666dd0744191d.jpg', 1, 1, 1),
(3, 'Jak on tego nie trafił', 'Lorem ipsum dolor sit amet dignissim dolor eget est. Vivamus orci molestie a, bibendum varius nec, sagittis eleifend. Nulla in tortor augue, congue id, urna. Cras ut metus. Curabitur condimentum nulla. Nullam consequat ligula nunc, rhoncus et, tincidunt nec, sem. Quisque consectetuer congue ac, felis. Mauris id augue. Sed condimentum ante ipsum dolor sit amet, consectetuer ac, laoreet ante ullamcorper pede ultrices mi. Cras vitae velit tempus urna eu mauris. Pellentesque fringilla neque scelerisque eu, tortor. Cras lacus lorem, at sapien sodales lectus urna luctus orci, placerat quam. Nunc leo. In hac habitasse platea dictumst. Praesent feugiat. Proin non tincidunt augue quis ante. Vestibulum tincidunt. Praesent scelerisque sem. Quisque eu justo. Vestibulum cursus tristique, augue eu odio eget.', 'page.php?id=3', '2016-04-11', '13:48:30', 1, 'img/wpisy_img/door-husband-1271621_1920.jpg', 1, 1, 1),
(4, 'Czy Benefica sprawi niespodziankę', 'Lorem ipsum dolor sit amet dignissim dolor eget est. Vivamus orci molestie a, bibendum varius nec, sagittis eleifend. Nulla in tortor augue, congue id, urna. Cras ut metus. Curabitur condimentum nulla. Nullam consequat ligula nunc, rhoncus et, tincidunt nec, sem. Quisque consectetuer congue ac, felis. Mauris id augue. Sed condimentum ante ipsum dolor sit amet, consectetuer ac, laoreet ante ullamcorper pede ultrices mi. Cras vitae velit tempus urna eu mauris. Pellentesque fringilla neque scelerisque eu, tortor. Cras lacus lorem, at sapien sodales lectus urna luctus orci, placerat quam. Nunc leo. In hac habitasse platea dictumst. Praesent feugiat. Proin non tincidunt augue quis ante. Vestibulum tincidunt. Praesent scelerisque sem. Quisque eu justo. Vestibulum cursus tristique, augue eu odio eget.', 'page.php?id=4', '2016-04-11', '15:11:32', 1, 'img/wpisy_img/fc-barcelona-1314076_1280.jpg', 1, 1, 1),
(5, 'Niemcy: remis Schalke 04 z Borussią Dortmund, świetny poziom', 'Borussia Dortmund przystąpiła do derbów Zagłębia Ruhry w mocno rezerwowym składzie. Powód? Rewanżowy mecz Ligi Europy z Liverpoolem, który odbędzie się na Anfield w najbliższy czwartek. Na ławce usiedli m.in. Łukasz Piszczek, Maro Reus, Henrich Mchitarjan i najlepszy strzelec Pierre-Emerick Aubameyang. Zastąpili ich Matthias Ginter, Moritz Leitner, Adrian Ramos i zaledwie 17-letni Christian Pulisić. Z kolei gospodarze, którzy wciąż wierzą w zajęcie miejsca gwarantującego udział w Lidze Mistrzów zagrali najmocniejszą jedenastką z Leroyem Sane i Klaasem-Janem Huntelaarem.\n\nJuż w 4. minucie podopieczni Thomasa Tuchela mogli wyjść na prowadzenie, kiedy Pulisić przepchnął jednego z obrońców i oddał groźny strzał głową, który mało brakowało, a zaskoczyłyby Ralfa Fahrmanna. To właśnie Amerykanin należał do najlepszych piłkarzy na boisku w pierwszej połowie, co potwierdził kolejnymi akcjami. Regularnie stwarzał zagrożenie atakując z prawej strony, a w 24. minucie miał kolejną doskonałą sytuację, kiedy minął dwóch defensorów, wpadł w pole karne i oddał strzał na długi słupek, po którym piłka o centymetry przeleciała obok bramki.\n\nGospodarze przebudzili się dopiero pod koniec pierwszej odsłony. Najpierw bardzo mocny strzał oddał Sane, jednak futbolówka przeleciała obok bramki, natomiast w 39. minucie indywidualną akcję przeprowadził Junior Caicara, który uderzył minimalnie niecelnie. W tej sytuacji mógł podawać do lepiej ustawionego Huntelaara.\n\nI to by było na tyle, jeśli chodzi o pierwsze 45 minut na Veltins Arena. Składnych akcji było jak na lekarstwo, ale lepiej prezentowali się piłkarze Borussii.\n\nDruga połowa rozpoczęła się od mocnego uderzenia w wykonaniu przyjezdnych. Była 49. minuta, kiedy po krótkiej wymianie podań Shinji Kagawa wbiegł w pole karne i popisał się fenomenalnym technicznym strzałem, którym przelobował bramkarza. To siódmy gol Japończyka w obecnym sezonie.', 'page.php?id=5', '2016-04-12', '16:18:00', 1, 'img/wpisy_img/football-1145958_1920.jpg', 1, 2, 1),
(6, 'Przedstawiciele Interu spotkali się z agentem Milika', '<p>Wszystko wskazuje na to, że Arkadiusz Milik będzie najbardziej łakomym polskim kąskiem na rynku transferowym. Robiącemu furorę napastnikowi Ajaksu Amsterdam coraz baczniej przygląda się Inter Mediolan. Jak donoszą włoskie media, przedstawiciele Nerazzurrich odbyli już nawet sekretne spotkanie z agentem snajpera reprezentacji Polski.</p>\r\n<p>Coraz więcej wskazuje na to, że Inter tego lata opuści Mauro Icardi. Argentyńczykiem interesują się podobno największe kluby Europy, a władze 18-krotnego mistrza Włoch już rozglądają się za jego ewentualnym następcą. Według prasy z Półwyspu Apenińskiego ma nim zostać właśnie Milik.</p>\r\n<p>I to jest pytanie czy Milik zamieni barwy biało-czerwone na czarno-niebieskie pasy </>', 'page.php?id=6', '2016-04-22', '11:33:21', 1, 'img/uploads/80d331a86b013e8237aef3923dc7d325.jpg', 1, 1, 1),
(7, 'Dortmund jego drugim domem. Z wizytą u Łukasza Piszczka.', '<p><strong>Najpierw masa, potem rzeźba</strong></p><p>Przed wyjazdem do Zagłębia Ruhry grał w Hercie. Łukasz podkreśla, jak ważnym etapem kariery był dla niego Berlin. Wciąż ma tam wielu przyjaciół. Kto wie? Gdyby klub nie żegnał się z Bundesligą w 2010 roku, być może zostałby tam dłużej. Nawet po podpisaniu kontraktu z BVB targały nim wątpliwości. Piszczek bardzo nie lubi zmiany otoczenia, ale do tego jeszcze wrócimy...W Hercie poznał Jaroslava Drobnego. Nazwisko nie komponujące się z posturą. Kawał chłopa. Fan siłowni. Czeski bramkarz wziął pod swoje skrzydła Polaka i zaczął z nim pracować nad sylwetką. ?Piszczu? do tej pory nie był wielkim fanem budowania odpowiedniej postury. Życie brutalnie zweryfikowało jego optykę na pracę bez piłki. W Bundeslidze, jeszcze jako napastnik, odbijał się od rywali. Oni grali, on się przyglądał. Dlatego w końcu zaprzyjaźnił się ze sztangą. Równolegle ze zmianą pozycji na prawego obrońcę, zaczął przybierać na masie i rzeźbić ciało. Praca dała efekty. Łukasz waży teraz 78 kg. Same mięśnie. Siłownia go wciągnęła. Śmieje się, że do tego stopnia, że nie mógł swobodnie podrapać się po plecach. Musi się kontrolować, aby nie przesadzić, bo to mogłoby zabrać jeden z jego największych atutów ? szybkość. Teraz coraz częściej uprawia crossfit. Swoją zajawkę dzieli w reprezentacji Polski z Łukaszem Fabiańskim. Jak widać bramkarze towarzyszą mu przy hantlach od lat.</p><p>Zmienił się. Do niedawna by się z tego śmiał, ale teraz uważnie pilnuje diety. Już nie zwozi jak do Berlina worków ulubionych ziemniaków z rodzinnych Goczałkowic. Robi badania na tolerancję pokarmową. Przez to z jego menu zniknęły jajka. Pracuje z psychologiem Kamilem Wódką,znanym z pomocy polskim skoczkom narciarskim.&nbsp;</p>', 'page.php?id=7', '2016-04-22', '11:44:15', 1, 'img/uploads/635967635759324293.jpg', 1, 3, 1),
(8, 'Terek Grozny jednak chce zatrzymać Macieja Rybusa', '<p>Maciej Rybus zapowiedział już wcześniej, że nie przedłuży kontraktu z Terekiem Grozny, bo chce spróbować szczęścia w lepszej lidze niż rosyjska. Władze klubu mają jednak cichą nadzieję na zatrzymanie Polaka na następny sezon.</p>\r\n<p>Reprezentant Polski już dawno przedstawił swoje oczekiwania odnośnie tego, gdzie chciałby grać po Euro 2016. Interesowały się nim kluby z Anglii, Niemiec i Włoch, na czele z Interem Mediolan, ale na razie bez konkretów. - Rybus kategorycznie nie oświadczał, że nie przedłuży z nami kontraktu. On tylko mówił, że chce pograć w Europie - zaznaczył dyrektor generalny Tereku, Ahmed Ajdamirow.</p>\r\n<p>Czeczeński klub będzie śledził sytuację Rybusa, aby w razie czego być gotowym do reakcji. - Jeśli mu nie wyjdzie, to wrócimy do rozmów. Zwłaszcza że jesteśmy z nim w tej sprawie dogadani. Jesteśmy mu wdzięczni za wykonaną pracę i będziemy szczęśliwy, jeśli będzie grał w Interze czy gdziekolwiek indziej. Ale oczywiście chętnie przyjmiemy go do siebie - powiedział dyrektor klubu.</p>\r\n<p>Rybus został zawodnikiem Tereka w lutym 2012 roku i stał się jednym z czołowych piłkarzy tego klubu. Jego obecna umowa wygasa wraz z końcem tego sezonu.</p>', 'page.php?id=8', '2016-04-22', '12:15:19', 1, 'img/uploads/42334cfdaa09f396441feef6e1fc9500.jpeg', 1, 4, 1),
(9, 'Hummels trafi do Bayernu? To dla mnie trudna decyzja', 'Kontrakt Hummelsa z Borussią Dortmund wygasa w czerwcu 2017 roku. Jeśli klub z Zagłębia Ruhry chce dobrze zarobić na 27-letnim zawodniku, to musi go sprzedać w ciągu najbliższych miesięcy. Oczywiście wszystko zależy od tego, czy obrońca nie zdecyduje się na przedłużenie kontraktu z BVB, ale nie brakuje głosów, że gdyby chciał przez kolejne lata występować na Signal Iduna Park, to już dawno złożyłby podpis pod umową.\r\n\r\nKlubów zainteresowanych Hummelsem nie brakuje. Tylko w Anglii są to: Arsenal, Manchester United oraz Chelsea. Od dawna piłkarza chce sprowadzić FC Barcelona, a nie można również wykluczyć, że do walki o jego usługi włączy się sam Bayern Monachium.\r\n\r\nOjciec zawodnika Hermann Hummels przyznał w rozmowie z dziennikiem SportBild, że jego syn może przenieść się do stolicy Bawarii.\r\n\r\n- To jedna z najważniejszych decyzji w karierze Matsa. Można to porównać do kobiety, która skończyła 30 lat i musi się zdecydować, czy chce mieć dzieci lub nie. Jeśli odejdzie, to dołączy do jednego z pięciu-sześciu czołowych klubów w Europie, a Bayern oczywiście jest jednym z nich - powiedział.\r\n\r\nJeszcze w 2012 roku Hummels wykluczał powrót do Bayernu. Nie podobało mu się, jak klub potraktował jego ojca, który został zwolniony po 17 latach pracy w zespołach młodzieżowych. Teraz sytuacja wygląda nieco inaczej, zwłaszcza, że wcześniej szlak z Dortmundu do Monachium przetarli Mario Goetze i Robert Lewandowski.\r\n\r\nDziałacze BVB z dyrektorem zarządzającym Hansem-Joachimem Watzkem podkreślają: Będę walczyć, żeby zatrzymać Matsa. Będę o niego walczyć bardziej, niż o któregokolwiek innego piłkarza. Jeśli zawodnik uzna, że chce kontynuować karierę w innym klubie, to w Dortmundzie mogą liczyć na dobre pieniądze. Wątpliwe, by środkowy obrońca reprezentacji Niemiec odszedł za mniej niż 40 milionów euro.\r\n\r\nW obecnym sezonie Hummels rozegrał 46 spotkań, w których strzelił 3 gole i zanotował 4 asysty.', 'page.php?id=9', '2016-04-22', '13:01:35', 1, 'img/uploads/mats-hummels-537856.jpg', 1, 4, 1),
(10, 'Cristiano Ronaldo prawdopodobnie nie zagra z Rayo', '<p>Cristiano Ronaldo zmaga się z kontuzją przeciążenia prawego uda - poinformowano na stronie internetowej Realu Madryt. Według hiszpańskich mediów, 31-letni piłkarz nie będzie mógł wystąpić w sobotnim meczu z Rayo Vallecano.</p>\r\n<p>Portugalczyk urazu doznał podczas środowego meczu z Villarrealem. W 90. minucie gry opuścił boisko, nie informując o tym sędziego ani trenera. Spotkanie zakończyło się wygraną Realu 3:0.</p>\r\n<p>Ronaldo w bieżącym sezonie wystąpił we wszystkich 34 meczach Królewskich w Primera Division. Zdobył w nich 31 goli i zaliczył 11 asyst.</p>\r\n<p>Spotkanie 35. kolejki ligi hiszpańskiej pomiędzy Rayo Vallecano a Realem odbędzie się na Estadio de Vallecas Teresa Rivero. Mecz rozpocznie się o godz. 16.</p>\r\n', 'single.php?id=10', '2016-04-22', '14:52:57', 1, 'img/uploads/hi-res-177089069_crop_north.jpg', 1, 3, 1),
(11, 'Mats Hummels może wyjechać do Anglii', 'Niemiecki obrońca całe dorosłe życie piłkarskie spędził w Borussii Dortmund. W klubie z Zagłębia Ruhry Mats Hummels występuje od 2008 roku. Teraz plotkuje się, że 27-latek mógłby trafić do Bayernu, a więc klubu, którego jest wychowankiem. Do walki o kapitana BVB włączył się także Manchester City. - On może ulec tej pokusie - mówi jego ojciec i agent.\r\nMenedżerem angielskiego zespołu od 1 lipca będzie Pep Guardiola, a więc obecny jeszcze trener Bayernu. To ponoć właśnie on chciałby sprowadzić Hummelsa na Etihad Stadium.\r\n\r\nObecna umowa Niemca z Borussią wygasa 30 czerwca 2017 roku. W tej chwili piłkarz jest wyceniany na ponad 30 milionów euro, ale trudno spodziewać się, aby jego nowy pracodawca zapłacił taką cenę, gdy do końca kontraktu pozostało już niewiele miesięcy.\r\n\r\n- City będą zawsze mocnymi rywalami dla zespołów, które będą chciały zatrudnić. Ten kierunek może być kolejną interesującą opcją. W tym sezonie ta drużyna spisuje się bardzo dobrze, ale ich zamiarem jest wygranie Premier League w kolejnym. Teraz zatrudniają najlepszego trenera na świecie - mówi ojciec i menedżer defensora Hermann Hummels. - On kocha Borussię, ale jest uczciwy, gdy twierdzić, że chce spróbować czegoś innego. Mats zastanawia się nad tą sprawą od dawna i to jest trudna rzecz. To ważna decyzja. Syn myśli także o wyjeździe za granicę - dodaje tata piłkarza.\r\n\r\n- To nie jest pytanie do mnie - mówił o spekulacjach transferowych sam Guardiola, która cały czas walczy o potrójną koronę z Bayernem.\r\n\r\n- Mats ma kontrakt do czerwca 2017 roku i ta umowa musi być respektowana. Nic więcej nie mamy do dodania - stwierdził rzecznik prasowy Borussii Dortmund Markus Horwick.\r\n\r\nSpekuluje się, że Hummels mógłby przejść do Bayernu, a w drugą stroną trafiłby Mario Goetze, a więc były gracz BVB.', 'page.php?id=11', '2016-04-23', '14:35:03', 1, 'img/uploads/9af052cfd558ba3e7066df7f673e266e.jpg', 1, 1, 1),
(12, 'Diego Simeone na trybunach do końca sezonu', '<p>Komisja Dyscyplinarna Ligi Hiszpańskiej ukarała szkoleniowca Atletico Madryt Diego Simeone dyskwalifikacją do końca sezonu. Oznacza to, że Argentyńczyk będzie oglądał swoich podopiecznych z trybun w trzech ostatnich meczach rozgrywek, w których Rojiblancos mają tyle samo punktów, co prowadząca w tabeli FC Barcelona.</p>\r\n<p>Dlaczego Simeone został zawieszony? Wszystko z powodu sytuacji w ostatnim meczu ligowym z Malagą, który zakończył się zwycięstwem Atletico 1:0. Gdy goście próbowali przeprowadzić kontrę na boisko została wrzucona druga piłka z okolic ławki rezerwowych Atletico. Wówczas Argentyńczyk został odesłany na trybuny, ale nie miał pretensji do arbitra i wyznał, że futbolówkę wrzucił chłopiec od podawania piłek, który prawdopodobnie działał na jego polecenie.</p>\r\n<p>\r\n<p>Jednak Komisja Dyscyplinarna Ligi Hiszpańskiej z dostępnych materiałów wideo nie mogła zidentyfikować osoby, która była odpowiedzialna za spowodowanie zamieszania i w myśl przepisów ukarano Simeone. Tym samym Argentyńczyk nie będzie mógł nic podpowiedzieć piłkarzom przy linii bocznej, a mecze z Rayo Vallecano, Celtą Vigo oraz Levante obejrzy z trybun.</p>\r\n<p>Atletico Madryt ma tyle samo punktów, co prowadząca w tabeli Primera Division FC Barcelona, ale ustępuje Katalończykom z powodu gorszego bilansu bezpośrednich spotkań. Jeśli Rojiblancos chcą wywalczyć mistrzostwo Hiszpanii, to muszą wygrać wszystkie mecze i liczyć na to, że Blaugrana straci punkty.</p>', 'page.php?id=12', '2016-04-27', '15:57:33', 1, 'img/uploads/a43989771f75163d854b09024a256070.jpg', 1, 5, 1),
(13, 'Siłą Bayernu Monachium są gwiazdy, Atletico Madryt - drużyna', '<p>Bayern Monachium w środowy wieczór zmierzy się z Atletico Madryt w pierwszym meczu półfinałowym Ligi Mistrzów. Zdaniem byłego piłkarza Los Colchoneros, Javiera Irurety, najeżony gwiazdami zespół Josepa Guardioli może mieć poważne problemy z wyeliminowaniem hiszpańskiej ekipy.</p>\r\n<p>Irureta, który z Atletico w 1974 roku awansował do finału ówczesnego Pucharu Mistrzów, w którym mierzył się z Bayernem jest zdania, że naszpikowana gwiazdami niemiecka jedenastka nie jest faworytem dwumeczu.</p>\r\n<p>- Bawarczycy mają w swoim składzie wiele gwiazd, ale siłą Atletico jest duch drużyny ? mówił były reprezentant Hiszpanii w rozmowie z serwisem goal.com. ? Oczywiście, jest kilku wyróżniających się piłkarzy, jak Antoine Griezmann, Koke czy Gabi, ale największą zaletą ekipy Simeone jest zespół ? dodawał.</p>\r\n<p>Mimo wiary w swój były klub, Irureta doskonale zdaje sobie sprawę z siły Bayernu. ? Kiedy ja mierzyłem się z tym zespołem w finale Pucharu Mistrzów, w jego składzie było wielu mistrzów świata i Europy: Sepp Maier, Uli Hoeness? Teraz także jest bardzo mocny. W jego kadrze są przecież tacy gracze jak Thomas Mueller czy Robert Lewandowski. Trzy kolejne tytuły mistrza Niemiec dodały monachijskiej ekipie pewności siebie i sprawiły, że stała się zespołem z absolutnego topu ? komentował.</p>\r\n', 'page.php?id=13', '2016-04-27', '16:04:01', 1, 'img/uploads/3d186dc15cbe013c56a4870c3e9bd57c.jpeg', 1, 7, 1),
(14, 'Liga mistrzów półfinał: cierpiące Atletico bliżej finału', '<p>Atletico Madryt przybliżyło się do finału Ligi Mistrzów. Po fantastycznej batalii piłkarze ze stolicy Hiszpanii pokonali w pierwszym meczu półfinałowym Bayern Monachium 1:0 (1:0). Gola na wagę triumfu zdobył w 11. minucie Saul Niguez.</p>\r\n<p>Piłkarze Atletico zaprezentowali to, z czego słyną - niesłychanie ambitną walkę do samego końca. Doceniają to w pierwszych pomeczowych komentarzach hiszpańskie media. Zauważają, że w drugiej połowie Bayern był bliski zdobycia bramki, ale ostateczne 1:0 jest cenną zaliczką.</p>\r\n<h4>Marca: Wojownicy</h4>\r\n<p>Po tym, co działo się we wtorek w Manchesterze, Liga Mistrzów potrzebowała właśnie takiego spotkania - pełnego emocji i walki. Dzięki bramce Saula Atletico Madryt jest bliżej finału. Piłkarze Simeone zrobili wszystko, by zminimalizować zagrożenie ze strony dobrze grającego Bayernu. Najlepszy strzelec Niemców, Robert Lewandowski, nie miał choćby jednej czystej sytuacji - Savić i Gimenez kompletnie wyłączyli go z gry.</p>\r\n<h4>El Mundo Deportivo: Nigdy nie trać wiary</h4>\r\n<p>Nigdy nie trać wiary. Przesłanie, które rozpaliło serca piłkarzy i kibiców Atletico w tym sezonie, to motto zespołu, który czyni cuda swoją siłą, pracą, poświęceniem i solidarnością. Mecz z Bayernem był godny półfinału i Ligi Mistrzów, a jego wynik sprawia, że Simeone i spółka pojadą do Monachium z zaliczką.</p>\r\n<p>Atletico cierpiało, i to bardzo. Szczególnie w drugiej połowie. Wyglądało to podobnie, jak rewanżowy mecz ćwierćfinałowy z Barceloną, ale ostatecznie piłkarze Simeone utrzymali przewagę do końca. To 1:0 jest dobre, być może bardzo dobre. Za sześć dni Atletico pojedzie do Monachium. I znów będzie cierpieć.</p>', 'single.php?id=14', '2016-04-28', '13:19:26', 1, 'img/uploads/45611fb77dd64ea7c46c9fe93147233f.jpg', 1, 9, 1),
(15, 'Liga Europy: Grzegorz Krychowiak spotka się z Szymonem Marciniakiem', '<p>Sevilla Grzegorza Krychowiaka na wyjeździe zagra z Szachtarem Donieck w czwartkowym meczu półfinałowym piłkarskiej Ligi Europy. Spotkanie sędziować będzie Szymon Marciniak. Tego samego dnia w drugiej parze Villarreal podejmie Liverpool.</p>\r\n<p>Drużyna Polaka awans do półfinału wywalczyła po ciężkim boju z Athletic Bilbao. Pierwszy mecz Sevilla wygrała na wyjeździe 2:1, ale w rewanżu u siebie uległa w takim samym stosunku. O wszystkim decydowały rzutu karne. Lepiej wykonywali je Andaluzyjczycy, a jednym z pewnych egzekutorów był Krychowia</p>\r\n<p>Ukraińcy za to w poprzedniej rundzie dość łatwo poradzili sobie ze Sportingiem Braga; wygrali 2:1 i 4:0.</p><p>Szachtar zmierzył się z Sevillą w 1/8 finału Pucharu UEFA w sezonie 2006/07. Dwumecz miał dość dramatyczny przebieg - po remisie 2:2 w Hiszpanii, zespół z Ukrainy prowadził u siebie 2:1 do czwartej minuty doliczonego czasu gry, a wówczas gola na 2:2 uzyskał... bramkarz Sevilli Andres Palop. W dogrywce decydującego gola strzelił Javier Chevanton.</p><p>- Normalnie takie rzeczy się nie zdarzają. To była bolesna porażka, którą starsi zawodnicy doskonale pamiętają. Bardzo chcielibyśmy się za nią zrewanżować, mamy jednak świadomość, że to Sevilla jest faworytem - przyznał pomocnik Szachtara Taras Stepanenko.</p><p>Villarreal i Liverpool zmierzą się natomiast w rozgrywkach pod egidą Europejskiej Unii Piłkarskiej po raz pierwszy. Hiszpanie w ćwierćfinale łatwo się uporali ze Spartą Praga, zwyciężając w dwumeczu 6:3. Prawdziwy horror swoim kibicom zafundowali za to The Reds.</p><p>Podopieczni trenera Juergena Kloppa grali z jego poprzednią drużyną - Borussią Dortmund. W Niemczech zremisowali 1:1, ale już po dziewięciu minutach rewanżu przegrywali 0:2, a po godzinie gry 1:3. Bramkę na 4:3 dla Liverpoolu dopiero w doliczonym przez sędziego czasie gry zdobył Dejan Lovren.</p>\r\n\r\nRewanże w Sevilli oraz Liverpoolu odbędą się tydzień później. Finał zaplanowano na 18 maja w Bazylei. Jego zwycięzca wystąpi w następnej edycji Ligi Mistrzów. Przed rokiem najlepsza była Sevilla, która w Warszawie pokonała Dnipro Dniepropietrowsk 3:2, a jedną z bramek strzelił Krychowiak. Hiszpański klub triumfował w tych rozgrywkach także w sezonie 2013/14.', 'single.php?id=15', '2016-04-28', '14:20:58', 1, 'img/uploads/635695402834592673.jpg', 1, 10, 1),
(16, 'Karim Benzema może nie zdążyć na rewanż z Manchesterem City', '<p><b>Choć Real Madryt jest faworytem rewanżowego meczu z Manchesterem City, to niewykluczone, że będzie musiał sobie radzić bez Karima Benzemy. Szkoleniowiec Królewskich Zinedine Zidane poinformował, że zawodnik jest kontuzjowany i na pewno nie wystąpi w najbliższym spotkaniu Primera Division z Realem Sociedad.</b></p>\r\n<p>Zidane nie powiedział, co dokładnie dolega Benzemie. Jednak nie chodzi o uraz kolana, przez który musiał opuścić boisko w trakcie półfinałowego spotkania Ligi Mistrzów z Manchesterem City. Nie wiadomo, czy zawodnik zdąży dojść do siebie przed meczem rewanżowym, który odbędzie się w środę.</p>\r\n<p>Zawodnik prawdopodobnie doznał urazu mięśniowego. Co ciekawe, to już 26 kontuzja tego typu, która przytrafiła się jednemu z piłkarzy Los Blancos w obecnych rozgrywkach.</p>\r\n<p>Benzema rozegrał 33 mecze w sezonie 2015/2016, w których strzelił 27 goli i zanotował siedem asyst.</p>', 'page.php?id=16', '2016-04-30', '07:39:34', 1, 'img/uploads/0e56e050a1779ddd4d3e0659c79285f7.jpg', 1, 3, 1),
(17, 'Liga Mistrzów: Atletico Madryt przegrało z Bayernem, ale awansowało do finału. Gol Lewandowskiego nie pomógł Bawarczykom', 'Bayern Monachium pokonał na własnym stadionie Atletico Madryt 2:1 (1:0) w rewanżowym meczu 1/2 finału Ligi Mistrzów, ale nie wystarczyło to do awansu. Wynik rywalizacji mógł być inny, gdyby w pierwszej połowie rzut karny na 2:0 wykorzystał Thomas Mueller. W 74. minucie gola dla gospodarzy strzelił Robert Lewandowski. Do pełni szczęścia mistrzom Niemiec zabrakło jeszcze jednego trafienia.\r\n\r\nScenariusz pierwszych minut wtorkowego rewanżu (w pierwszym meczu Atletico wygrało 1:0) był łatwy do przewidzenia. Głęboko cofnięta ekipa z Madrytu czekała na ataki Bayernu na własnej połowie, dbając niemal wyłącznie o zabezpieczenie swojej bramki. Podopieczni Pepa Guardioli od początku zabrali się do odrabiania strat z pierwszego meczu, choć mieli opory przed atakowaniem całym zespołem.\r\n\r\nNajbardziej widocznym piłkarzem pierwszych 30 minut był Robert Lewandowski. To do polskiego napastnika kierowano zdecydowaną większość podań, z których większość stanowiły górne piłki. Najlepszy strzelec Bundesligi nie miał jednak łatwego życia. Rywale nie odpuszczali go nawet na krok, co sprawiało, że gospodarze swoich szans szukali również w strzałach z dystansu.\r\n\r\nPierwszą groźną sytuację Bayern stworzył w 20. minucie. Świetnym prostopadłym podaniem popisał się Boateng, a będący na czystej pozycji Mueller, zamiast strzelać, zagrał do boku do Lewandowskiego. Wyrzucony w lewą stronę kapitan reprezentacji Polski oddał strzał z ostrego kąta, ale Oblak udanie interweniował.\r\n\r\nDziesięć minut później Alaba umiejętnie poszukał faulu Fernandeza 17 metrów przed bramką gości, a do rzutu wolnego podszedł Xabi Alonso. Hiszpan wybrał wariant siłowy i z potężnie strzelił w kierunku ustawionego muru. Odbita od Gimeneza piłka zupełnie zmyliła Oblaka i Bayern objął prowadzenie.\r\n\r\nTrzy minuty później mogło być 2:0. Antybohater pierwszej połowy - Gimenez - złapał w pół we własnym polu karnym walczącego o pozycję po dośrodkowaniu z rzutu różnego Martineza i sędziujący spotkanie Turek Cuneyt Cakir słusznie wskazał na 11. metr. Do rzutu karnego podszedł Mueller, ale jego strzał nie sprawił najmniejszych kłopotów Oblakowi.\r\n\r\nBayern potrzebował czasu, by ochłonąć po niewykorzystanej szansie i do końca tej części meczu bramce Atletico poważnie już nie zagroził. W pierwszych 45 minutach gospodarze byli w posiadaniu piłki przez 71 proc. czasu gry, mogąc pochwalić się równie wyraźną przewagą w strzałach (13-2).\r\n\r\nDrugą połowę mistrzowie Niemiec rozpoczęli z jeszcze większym animuszem, ale szybko zostali skarceni. W 54. minucie będący na środku boiska Torres znakomitym podaniem uruchomił Griezmanna, piłki nie przeciął Alaba, a Francuz nie zmarnował sytuacji sam na sam z Neuerem.\r\n\r\nWyrównujący gol wpłynął na psychikę piłkarzy Diego Simeone. W dalszym ciągu całą drużyną pilnowali zasieków postawionych przed własnym polem karnym, ale odtąd towarzyszyła im już pewność siebie i głęboka wiara w awans do finału.\r\n\r\nGracze Bayernu bili głową w mur, nie potrafiąc zagrozić bramce Atletico. Gdy już jednak stworzyli sobie dobrą sytuację, od razu ją wykorzystali. W 74. minucie w pole karne dośrodkował Alaba, tam fantastyczną główką popisał się Vidal, dogrywając piłkę do Lewandowskiego, a Polak również głową skierował ją do siatki bramki gości.\r\n\r\nBawarczycy raz jeszcze poderwali się do walki, ich zapędy powstrzymał na moment w 84. minucie sędzia. Turecki arbiter podyktował jedenastkę dla Atletico po rzekomym faulu Martineza na Torresie, choć powtórki pokazały, że przewinienie miało miejsce pół metra przed polem karnym. Do rzutu karnego podszedł sam poszkodowany, ale oddał niemal identyczny strzał jak Mueller (półgórna piłka przy lewym słupku bramki). Efekt? Neuer nie miał problemów ze skuteczną obroną.\r\n\r\nWidzowie na Allianz Arena po raz kolejny uwierzyli, że ich idole są w stanie wygrać dwumecz z Atletico. Bayern w dalszym ciągu atakował, z bliskiej odległości strzelali Lewandowski, Alaba i Mueller. Każdy celny strzał padł jednak łupem czujnie interweniującego Oblaka.\r\n\r\nWynik nie zmienił się już do samego końca, dzięki czemu Atletico po raz trzeci w historii awansowało do finału Pucharu Europy. Guardioli sztuka ta nie udała się z Bayernem ani razu podczas trzech sezonów spędzonych w Monachium.', 'page.php?id=17', '2016-05-03', '23:31:02', 1, 'img/uploads/0df9bf42a5cbadd3a7f6d69c0b91a979.jpg', 1, 9, 1),
(18, 'Przemysław Tytoń po sezonie opuści VfB Stuttgart', '<p>Wszystko wskazuje na to, że po zakończeniu sezonu Przemysław Tytoń pożegna się z VfB Stuttgart. <b>Bild</b> twierdzi, że Polak jest jednym z siedmiu piłkarzy, którzy na pewno nie znajdą się w kadrze zespołu na rozgrywki 2016/2017. Tytoń ma odejść nawet w przypadku, gdyby rzutem na taśmę Stuttgart utrzymał się w Bundeslidze.</p>\r\n<p><b>Bild</b> podał listę siedmiu zawodników, których nie zobaczymy w barwach VfB Stuttgart w następnym sezonie. Wśród nich znalazł się Przemysław Tytoń, który dołączył do zespołu latem ubiegłego roku z PSV Eindhoven za milion euro. Kontrakt 29-letniego Polaka wygasa w czerwcu 2017 roku, dlatego Die Roten będą próbowali sprzedać go za wszelką ceną po zakończeniu rozgrywek. To dla nich ostatnia okazja, by odzyskać, choć część pieniędzy, jakie przeznaczyli na wykpienie byłego zawodnika Górnika Łęczna. Latem w klubie ze Stuttgartu szykuje się spora rewolucja, bo oprócz Tytonia z zespołem ma się również pożegnać inny bramkarz Mitchell Langerak.</p>', 'page.php?id=18', '2016-05-12', '15:26:36', 1, ' img/uploads/828ca081e4d34b89455fa2b569169635.jpg', 1, 4, 1),
(19, 'Le Parisien: agent Cristiano Ronaldo dogadał się z Paris Saint-Germain', '<p>Dziennik <b>Le Parisien</b> informuje, że Cristiano Ronaldo może spać spokojnie. Jeśli zawodnik zdecyduje się odejść z Realu Madryt, to jego nowym pracodawcą zostanie Paris Saint-Germain. Agent Portugalczyka Jorge Mendes doszedł w tej sprawie do porozumienia z prezydentem PSG Nasserem Al-Khelaifim. Piłkarz już wcześniej kilka razy spotkał się z przedstawicielami klubu ze stolicy Francji.</p>\r\n<p>Paris Saint-Germain chce pozyskać Cristiano Ronaldo przynajmniej od dwóch sezonów. Do tej pory problemem były ewentualne zarobki piłkarza, gdyż klub nie mógł sobie pozwolić na złamanie zasad finansowego fair play. Jednak według ostatnich informacji francuskich mediów latem z PSG pożegna się najlepiej zarabiający Zlatan Ibrahimović, który postanowił nie przedłużać kontraktu. Tym samym nic nie stoi na przeszkodzie, by zawodnik trafił na Parc des Princes i dostał ogromne wynagrodzenie.</p>\r\n<p>\r\nAgent Cristiano Ronaldo Jorge Mendes spotkał się z prezydentem PSG Nasserem Al-Khelaifim i szybko doszedł do porozumienia w kwestii przenosin do Paryża. Mistrz Francji otrzymał zapewnienie, że będzie miał pierwszeństwo w negocjacjach z Realem Madryt i samym piłkarzem. Co więcej nie brakuje głosów, że wstępnie ustalono warunki kontraktu indywidualnego i Mendes oraz CR7 są z nich bardzo zadowoleni.\r\n</p><p>\r\nNa ten moment Portugalczyk ma ważną umowę z Realem Madryt, która wygasa w czerwcu 2018 roku. Nic nie wskazuje na to, by zawodnik postanowił ją przedłużyć. Dlatego latem Królewscy mogą mieć ostatnią okazję, by zarobić na 31-letnim piłkarzu. Z drugiej strony, jeśli Ronaldo zostanie na Santiago Bernabeu, to także nie stracą. W ten sposób nie tylko nie wzmocnią potencjalnych konkurentów w Lidze Mistrzów, ale również będą zarabiali na wszystkim, co związane z trzykrotnym zdobywcą Złotej Piłki.</p>\r\n<p>\r\nW obecnym sezonie Cristiano Ronaldo rozegrał 46 spotkań, w których strzelił 49 goli i zanotował 15 asyst.</p>', 'single.php?id=19', '2016-05-11', '20:29:52', 1, 'img/uploads/cd6ad50e92403c2a2c095e0fd2580afe.jpg', 1, 1, 1),
(22, 'Zieliński jednak u Kloppa?', '? Jürgen Klopp jest zainteresowany sprowadzeniem Piotra Zielińskiego, rozmawiał już z Polakiem, ale temat transferu wróci dopiero latem ? poinformowaliśmy w styczniu jako pierwsi podając informację o możliwych przenosinach pomocnika Empoli na Wyspy Brytyjskie. W Lidze+ Ekstra emitowanej przez Canal+ Andrzej Twarowski i Tomasz Smokowski podali informację o transferze, potwierdzając nasze doniesienia sprzed kilku miesięcy: reprezentant Polski ma zostać piłkarzem Liverpoolu. \r\n\r\n ', 'single.php?id=22', '2016-05-16', '09:24:17', 1, ' img/uploads/635989491528289072.jpg', 1, 4, 1),
(23, 'Marcin Kamiński może odejść do Primera Division', '<p>Po rozstaniu z Lechem Poznań, Marcin Kamiński jest na urlopie. ? To jednak odpoczynek z telefonem w ręce, bo w każdej chwili mogę polecieć podpisać kontrakt ? z uśmiechem mówi 24-letni obrońca.\r\nNajpoważniejszą i konkretną ofertę obrońca otrzymał ze Sportingu Gijon. Jej aktualność była uzależniona od tego, czy zespół utrzyma się w Primera Division. Tak się stało po wygranej w ostatniej kolejce z Villarreal (2:0). Klub z Asturii rozpocznie teraz budowę zespołu na nowy sezon, bardzo możliwe, że z Kamińskim na pozycji stopera.</p>\r\n<p>\r\nKiedy pytamy, czy wkrótce zamieni Polskę na słoneczną Hiszpanię, odpowiada krótko: ? Bez komentarza. ? Mam trzy konkretne oferty i prawdopodobnie spośród nich będę wybierał ? przyznaje czterokrotny reprezentant Polski.\r\nKamiński na pewno nie trafi do Izraela. W ostatnich tygodniach było głośno, że przejdzie do Maccabi Tel-Awiw, gdzie dyrektorem sportowym jest Jordi, syn Johana Cruyffa. Wiemy jednak, że ten kierunek zupełnie nie interesuje obrońcę i odrzucił propozycję niezłego kontraktu. Mało prawdopodobny jest również wyjazd do Turcji lub Grecji.</p>\r\n<p>\r\nZdecydowanie bardziej skłania się bowiem ku innym ligom. Oprócz Sportingu dostał również dwie propozycje z klubów 2. Bundesligi. Wciąż aktualne są również przenosiny do Holandii. Już zimą miał stamtąd zapytanie ? chodziło wówczas o NEC Nijmegen.</p>', 'page.php?id=23', '2016-05-20', '11:30:07', 1, 'img/uploads/622387834c283375a689b62661fc0093.jpg', 1, 4, 1),
(24, 'Euro 2016. Paweł Wszołek po operacji. Koledzy wspierają.', 'Paweł Wszołek w czwartek późnym wieczorem przeszedł w Warszawie operację złamanej ręki. Reprezentant Polski jest przybity, wspierają go koledzy.\r\n\r\nZabieg zakończył się około godziny 23 w klinice Enel Med na stadionie przy ul. Łazienkowskiej. Tam też Paweł Wszołek będzie przechodził rehabilitację. Przypomnijmy, w trakcie czwartkowego treningu na regeneracyjnym zgrupowaniu w Jastarni skrzydłowy reprezentacji Polski tak nieszczęśliwie upadł, że złamał kość promieniową ramienia z przemieszeniem.\r\n\r\n - Poślizgnąłem się, upadłem do tyłu i usłyszałem trzaśnięcie. Na początku nie bolało, dopiero teraz zaczyna - mówił tuż po urazie, siedząc z ręką obłożoną lodem. Jego słowa cytował oficjalny serwis PZPN Łączy Nas Piłka.\r\n\r\nTo uraz, który wyklucza go z Euro 2016. Wszołek odpocznie od piłki przez trzy miesiące. 24-latek jest zdruzgotany, o czym przed kamerą TVP mówił w czwartek lekarz kadry Jacek Jaroszewski.\r\n\r\nWszołek dostał słowa otuchy od kolegów z drużyny. Za pomocą mediów społecznościowych głos zabrali m.in. Grzegorz Krychowiak i Kamil Grosicki. Ten drugi doskonale wie, co to za ból. Doznał podobnego urazu w listopadzie 2014, gdy w eliminacjach mistrzostw Europy Polska grała z Gruzją.', 'single.php?id=24', '2016-05-20', '14:12:36', 16, 'img/uploads/573daab4b1c219_54257113.jpg', 1, 3, 1),
(25, 'Ciężko oj ciężko biega nasz kapitan.', '<p>Po ostatnim meczu w sezonie mam mieszane uczucia, nasz kapitan niby taki sam, ale jednak inny. Już od jakiegoś czasu patrząc na grę naszego kapitana coś jakby było nie tak, piłka przy przyjęciu ucieka gdzieś daleko, gra jeden na jeden przeważnie kończy się stratą, więcej leży niż biega.</p>\r\n\r\n<p> Żeby było jasne słowa te piszę przepełniony obawą że jednak brakuje sił i trudy tego sezonu jednak i naszego piłkarza dekady dościgły demony zmęczenia i wypalenia. Przecież te 51 meczy w samym klubie nie mogły przejść gdzieś bez echa, doliczmy do tego mecze reprezentacji i mamy liczbę ogromną.</p>\r\n\r\n\r\n\r\n', 'page.php?id=25', '2016-05-22', '20:47:02', 1, ' img/uploads/5616dc4d6674a9_49485320.jpg', 1, 3, 1);

-- --------------------------------------------------------

--
-- Struktura widoku `max_id_in_wpisy`
--
DROP TABLE IF EXISTS `max_id_in_wpisy`;

CREATE ALGORITHM=UNDEFINED DEFINER=`sibi`@`%` SQL SECURITY DEFINER VIEW `max_id_in_wpisy` AS select (max(`wpisy`.`id_wpis`) + 1) AS `max(id_wpis) +1` from `wpisy`;

-- --------------------------------------------------------

--
-- Struktura widoku `sub_kategorie`
--
DROP TABLE IF EXISTS `sub_kategorie`;

CREATE ALGORITHM=UNDEFINED DEFINER=`sibi`@`%` SQL SECURITY DEFINER VIEW `sub_kategorie` AS select `kategorie`.`id_kategori` AS `id_kategori`,`kategorie`.`title` AS `title`,`kategorie`.`opis` AS `opis`,`kategorie`.`on_off` AS `on_off`,`kategorie`.`parent` AS `parent` from `kategorie`;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `komentarze`
--
ALTER TABLE `komentarze`
  ADD CONSTRAINT `fk_kom_to_wpis_id` FOREIGN KEY (`id_wpis`) REFERENCES `wpisy` (`id_wpis`) ON DELETE CASCADE;

--
-- Ograniczenia dla tabeli `wpisy`
--
ALTER TABLE `wpisy`
  ADD CONSTRAINT `fk_kat_id` FOREIGN KEY (`kat_id`) REFERENCES `kategorie` (`id_kategori`),
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`autor_wpis_id`) REFERENCES `users` (`id_user`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
