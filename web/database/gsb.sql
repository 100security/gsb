-- phpMyAdmin SQL Dump
-- version 5.0.4deb2+deb11u1
-- https://www.phpmyadmin.net/
--

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Banco de dados: `gsb`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `sites`
--

CREATE TABLE `sites` (
  `id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `site` varchar(255) NOT NULL,
  `http_code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `sites`
--

INSERT INTO `sites` (`id`, `status`, `site`, `http_code`) VALUES
(1, 'Safe', 'https://www.100security.com.br/', '200'),
(2, 'Unsafe', 'http://malware.testing.google.test/testing/malware/', '-'),
(3, 'Safe', 'https://fast.com', '200'),
(4, 'Safe', 'https://www.google.com', '200'),
(5, 'Safe', 'https://codeacademy.com', '301'),
(6, 'Safe', 'https://shodan.io', '301'),
(7, 'Safe', 'https://dictation.io', '200'),
(8, 'Unsafe', 'http://17ebook.co', '302'),
(9, 'Safe', 'https://cloud.google.com', '200'),
(10, 'Safe', 'https://www.100security.com.br/', '200'),
(11, 'Safe', 'https://www.sans.org', '200'),
(12, 'Safe', 'https://www.nsa.gov', '200'),
(13, 'Safe', 'https://www.offsec.com', '200'),
(14, 'Safe', 'https://screenshot.guru', '200'),
(15, 'Safe', 'https://videos.pexels.com', '301'),
(16, 'Safe', 'https://unsplash.com', '200'),
(17, 'Safe', 'https://e.ggtimer.com', '200'),
(18, 'Safe', 'https://iconfinder.com', '301'),
(19, 'Safe', 'https://random.org', '301'),
(20, 'Safe', 'https://earn.com', '301'),
(21, 'Safe', 'https://slides.com', '200'),
(22, 'Safe', 'https://everytimezone.com', '200'),
(23, 'Safe', 'https://myfonts.com/whatthefont', '301'),
(24, 'Safe', 'https://draw.io', '301'),
(25, 'Safe', 'https://autodraw.com', '200'),
(26, 'Safe', 'https://youtube.com/webcam', '301'),
(27, 'Safe', 'https://www.virustotal.com', '200'),
(28, 'Safe', 'https://fonts.google.com', '200'),
(29, 'Safe', 'https://jotti.org', '302'),
(30, 'Safe', 'https://wolframalpha.com', '301'),
(31, 'Safe', 'https://wetransfer.com', '200'),
(32, 'Safe', 'https://kleki.com', '200'),
(33, 'Safe', 'https://onlineocr.net', '301'),
(34, 'Safe', 'https://pdfescape.com', '301'),
(35, 'Safe', 'https://translate.google.com', '200'),
(36, 'Safe', 'https://canva.com', '301'),
(37, 'Safe', 'https://midomi.com', '301'),
(38, 'Safe', 'https://fontstruct.com', '200'),
(39, 'Safe', 'https://homestyler.com', '301'),
(40, 'Safe', 'https://remotedesktop.google.com', '200'),
(41, 'Safe', 'https://privnote.com', '403'),
(42, 'Safe', 'https://app.grammarly.com', '301'),
(43, 'Safe', 'https://noteflight.com', '301'),
(44, 'Safe', 'https://urbandictionary.com', '301'),
(45, 'Safe', 'https://history.google.com', '302'),
(46, 'Safe', 'https://builtwith.com', '200'),
(47, 'Safe', 'https://downforeveryoneorjustme.com', '403'),
(48, 'Safe', 'https://similarsites.com', '301'),
(49, 'Safe', 'https://typingweb.com', '301'),
(50, 'Safe', 'https://snopes.com', '301'),
(51, 'Safe', 'https://mymaps.google.com', '302'),
(52, 'Safe', 'https://color.adobe.com', '200'),
(53, 'Safe', 'https://namechk.com', '403'),
(54, 'Safe', 'https://ifttt.com', '200'),
(55, 'Safe', 'https://tinychat.com', '200'),
(56, 'Safe', 'https://bubbl.us', '200'),
(57, 'Safe', 'https://web.skype.com', '200'),
(58, 'Safe', 'https://faxzero.com', '200'),
(59, 'Safe', 'https://powtoon.com', '301'),
(60, 'Safe', 'https://carrd.co', '200'),
(61, 'Safe', 'https://spark.adobe.com', '301'),
(62, 'Safe', 'https://anchor.fm', '302'),
(63, 'Safe', 'https://flightstats.com', '301'),
(64, 'Safe', 'https://pixton.com', '301'),
(65, 'Safe', 'https://seatguru.com', '200'),
(66, 'Safe', 'https://gtmetrix.com', '200'),
(67, 'Safe', 'https://vectr.com', '200'),
(68, 'Safe', 'https://headspace.com', '301'),
(69, 'Safe', 'https://talltweets.com', '200'),
(70, 'Safe', 'https://gist.github.com', '302'),
(71, 'Safe', 'https://clyp.it', '200'),
(72, 'Safe', 'https://todo.microsoft.com', '301'),
(73, 'Safe', 'https://instructables.com', '301'),
(74, 'Safe', 'https://domains.google.com', '302'),
(75, 'Safe', 'https://marvelapp.com', '200'),
(76, 'Safe', 'https://googleartproject.com', '301'),
(77, 'Safe', 'https://flowgram.com', '301'),
(78, 'Safe', 'https://asciiflow.com', '200'),
(79, 'Safe', 'https://camelcamelcamel.com', '403'),
(80, 'Safe', 'https://flipanim.com', '200'),
(81, 'Safe', 'https://10minutemail.com', '403'),
(82, 'Safe', 'https://minutes.io', '200'),
(83, 'Safe', 'https://duolingo.com', '302'),
(84, 'Safe', 'https://class-central.com', '301'),
(85, 'Safe', 'https://sumopaint.com', '200'),
(86, 'Safe', 'https://thunkable.com', '200'),
(87, 'Safe', 'https://htmlmail.pro', '200'),
(88, 'Safe', 'https://apify.com', '200'),
(89, 'Safe', 'https://upwork.com', '403'),
(90, 'Safe', 'https://duckduckgo.com', '200'),
(91, 'Safe', 'https://ninite.com', '200'),
(92, 'Safe', 'https://wirecutter.com', '301'),
(93, 'Safe', 'https://www.cnn.com', '302'),
(94, 'Safe', 'https://mockaroo.com', '200'),
(95, 'Safe', 'https://gohighbrow.com', '403'),
(96, 'Safe', 'https://buffer.com', '200'),
(97, 'Safe', 'https://yahoo.com', '301'),
(98, 'Safe', 'https://seedr.cc', '301'),
(99, 'Safe', 'https://slide.ly', '301'),
(100, 'Safe', 'https://sway.com', '200');

--
-- Índices para tabela `sites`
--
ALTER TABLE `sites`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabela `sites`
--
ALTER TABLE `sites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
COMMIT;
