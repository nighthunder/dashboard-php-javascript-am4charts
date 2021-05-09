-- phpMyAdmin SQL Dump
-- version 4.3.7
-- http://www.phpmyadmin.net
--
-- Host: mysql06-farm10.kinghost.net
-- Tempo de geração: 06/05/2021 às 16:46
-- Versão do servidor: 10.2.33-MariaDB-log
-- Versão do PHP: 5.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de dados: `crodemu02`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `office_id` int(11) NOT NULL,
  `rule_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `email` varchar(40) NOT NULL,
  `fullname` varchar(90) DEFAULT NULL,
  `passwd` varchar(90) NOT NULL,
  `address` varchar(90) DEFAULT NULL,
  `zip_code` varchar(12) DEFAULT NULL,
  `phone` varchar(16) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `sex` varchar(20) DEFAULT NULL,
  `nick` varchar(45) DEFAULT NULL,
  `activity` varchar(40) DEFAULT NULL,
  `institution` varchar(90) DEFAULT NULL,
  `office` varchar(60) DEFAULT NULL,
  `state` varchar(40) DEFAULT NULL,
  `county` varchar(90) DEFAULT NULL,
  `indicador` varchar(1) DEFAULT NULL,
  `funcionalidade` varchar(1) DEFAULT NULL,
  `newsletter` varchar(1) DEFAULT NULL,
  `lgpd` varchar(1) DEFAULT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=572 DEFAULT CHARSET=utf8mb4 COMMENT='Tabela que armazena dados de um usuário qualquer';

--
-- Fazendo dump de dados para tabela `user`
--

INSERT INTO `user` (`id`, `office_id`, `rule_id`, `state_id`, `position_id`, `email`, `fullname`, `passwd`, `address`, `zip_code`, `phone`, `birth_date`, `sex`, `nick`, `activity`, `institution`, `office`, `state`, `county`, `indicador`, `funcionalidade`, `newsletter`, `lgpd`, `create_date`) VALUES
(1, 12, 2, 14, 1, 'gustavo.morelli@macroplan.com.br', 'Gustavo Morelli', '749cfc9a7434a3a9ebd687fa8c9d546c', NULL, NULL, NULL, NULL, 'masculino', 'Gustavo Morelli', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '2020-12-02 17:47:45'),
(2, 2, 2, 3, 1, 'mariadelourdes@gmail.com', 'Maria de Lourdes Moreira', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', '2007-05-08', '', 'Maria de Lourdes da Silva', 'Academia', '', '', 'Acre', '', NULL, NULL, '', 'N', '2020-10-07 16:18:17'),
(4, 11, 2, 14, 1, 'renata.piazzon@arapyau.org.br', 'Renata Piazzon', '749cfc9a7434a3a9ebd687fa8c9d546c', NULL, NULL, NULL, NULL, 'feminino', 'Renata Piazzon', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '2020-11-30 14:29:07'),
(5, 11, 2, 14, 1, 'rafaela.bergamo@arapyau.org.br', 'Rafaela Bergamo', '749cfc9a7434a3a9ebd687fa8c9d546c', NULL, NULL, NULL, NULL, 'feminino', 'Rafaela Bergamo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '2020-11-30 14:44:27'),
(6, 11, 2, 14, 1, 'inaietsantos@gmail.com', 'InaiÃª Santos', 'c22ee753e444e8f3c490330f3d62f8d3', '', '', '', '1970-01-01', 'feminino', 'Inaiê Santos', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '2020-11-30 14:47:35'),
(7, 11, 2, 14, 1, 'roberto@rswaack.com.br', 'Roberto Waack', '749cfc9a7434a3a9ebd687fa8c9d546c', NULL, NULL, NULL, NULL, 'masculino', 'Roberto Waack', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '2020-11-30 14:59:24'),
(8, 12, 2, 14, 1, 'glaucio.neves@macroplan.com.br', 'Glaucio Neves', '749cfc9a7434a3a9ebd687fa8c9d546c', NULL, NULL, NULL, NULL, 'masculino', 'Glaucio Neves', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '2020-11-30 15:01:27'),
(9, 12, 2, 14, 1, 'eber.goncalves@macroplan.com.br', 'Éber Gonçalves', '82dc420a41d972143e57cc5899131414', '', '', '', '0000-00-00', 'masculino', 'Éber Gonçalves', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '2020-11-30 15:03:45'),
(10, 11, 2, 14, 1, 'fgaetani@gmail.com', 'Francisco Gaetani', '749cfc9a7434a3a9ebd687fa8c9d546c', '', '', '', '0000-00-00', 'masculino', 'Francisco Gaetani', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '2020-11-30 14:55:09'),
(12, 12, 2, 14, 1, 'claudio.porto@macroplan.com.br', 'Claudio Porto', '749cfc9a7434a3a9ebd687fa8c9d546c', NULL, NULL, NULL, NULL, 'masculino', 'Claudio Porto', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '2020-12-02 17:48:00'),
(13, 12, 2, 14, 1, 'yasmin.ventura@macroplan.com.br', 'Yasmin Ventura', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, NULL, 'feminino', 'Yasmin Ventura', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '2020-12-02 17:48:00'),
(14, 12, 2, 14, 1, 'adriana.fontes@macroplan.com.br', 'Adriana Fontes', '749cfc9a7434a3a9ebd687fa8c9d546c', 'Avenida Dom Helder Camara 4380, bloco 10', '1012-3123', '(21) 32423-4231', '1970-01-01', 'feminino', 'Adriana Fontes', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '2020-12-02 17:58:19'),
(15, 12, 2, 14, 1, 'roberta.teixeira@macroplan.com.br', 'Roberta Teixeira', '749cfc9a7434a3a9ebd687fa8c9d546c', NULL, NULL, NULL, NULL, 'feminino', 'Roberta Teixeira', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '2020-12-02 17:58:37'),
(16, 11, 2, 14, 1, 'vinicius.elias@arapyau.org.br', 'Vinícius Elias', '749cfc9a7434a3a9ebd687fa8c9d546c', '', '', '', '0000-00-00', 'masculino', 'Vinicius Elias', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '2020-11-30 14:44:27'),
(17, 11, 2, 14, 1, 'denisehills@natura.net ', 'Denise Hills', 'ea5e89557f942df11976eec9ddebb14d', NULL, NULL, NULL, NULL, 'feminino', 'Denise Hills', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '2021-01-12 00:00:00'),
(18, 11, 2, 14, 1, 'sabrina.fernandes@arapyau.org.br', 'Sabrina Fernandes', '82dc420a41d972143e57cc5899131414', NULL, NULL, NULL, NULL, 'feminino', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00:00'),
(20, 11, 2, 14, 1, 'angelaklinke68@gmail.com', 'Angela Klinke', '82dc420a41d972143e57cc5899131414', NULL, NULL, NULL, NULL, 'feminino', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00:00'),
(21, 11, 2, 14, 1, 'reni@analitica.inf.br', 'Reni', '82dc420a41d972143e57cc5899131414', NULL, NULL, NULL, NULL, 'feminino', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00:00'),
(22, 11, 2, 14, 1, 'livia.pagotto@arapyau.org.br', 'Lívia Pagotto', '82dc420a41d972143e57cc5899131414', NULL, NULL, NULL, NULL, 'feminino', 'Lívia Pagotto', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00:00'),
(23, 11, 2, 14, 1, 'alan.rigolo@arapyau.org.br', 'Alan Rigolo', '82dc420a41d972143e57cc5899131414', NULL, NULL, NULL, NULL, 'masculino', 'Alan Rigolo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00:00'),
(24, 11, 2, 14, 1, 'debora.passos@arapyau.org.br', 'Debora Passos', '82dc420a41d972143e57cc5899131414', NULL, NULL, NULL, NULL, 'feminino', 'Debora Passos', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00:00'),
(25, 11, 2, 14, 1, 'leanylemos@gmail.com', 'Leany Lemos', '82dc420a41d972143e57cc5899131414', NULL, NULL, NULL, NULL, 'feminino', 'Leany Lemos', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00:00'),
(26, 11, 2, 14, 1, 'r.ferreira@fordfoundation.org', 'Raíssa Ferreira', '82dc420a41d972143e57cc5899131414', NULL, NULL, NULL, NULL, 'feminino', 'Raíssa Ferreira', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00:00'),
(27, 11, 2, 14, 1, 'gmacedo@ihumanize.org', 'Glaucia Macedo', '82dc420a41d972143e57cc5899131414', NULL, NULL, NULL, NULL, 'feminino', 'Glaucia Macedo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00:00'),
(28, 11, 2, 14, 1, 'acarolina@ihumanize.org', 'Ana Carolina', '82dc420a41d972143e57cc5899131414', NULL, NULL, NULL, NULL, 'feminino', 'Ana Carolina', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00:00'),
(29, 11, 2, 14, 1, 'gabriel@climaesociedade.org', 'Gabriel', '82dc420a41d972143e57cc5899131414', NULL, NULL, NULL, NULL, 'masculino', 'Gabriel', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00:00'),
(73, 11, 2, 14, 1, 'souza_19@hotmail.com', 'Karen', '82dc420a41d972143e57cc5899131414', NULL, NULL, NULL, NULL, 'feminino', 'Karen', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '2021-02-10 16:10:01'),
(74, 11, 2, 14, 1, 'mauroodealmeida@gmail.com', 'Mauro Almeida', '82dc420a41d972143e57cc5899131414', NULL, NULL, NULL, NULL, 'masculino', 'Mauro Almeida', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '2021-02-10 16:10:01'),
(75, 11, 2, 14, 1, 'tschor@sedecti.am.gov.br', 'tschor', '82dc420a41d972143e57cc5899131414', NULL, NULL, NULL, NULL, 'masculino', 'tschor', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '2021-02-10 16:10:01'),
(76, 11, 2, 14, 1, 'denis.minev@gmail.com', 'Denis Minev', '82dc420a41d972143e57cc5899131414', NULL, NULL, NULL, NULL, 'masculino', 'Denis Minev', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '2021-02-10 16:10:01'),
(77, 11, 2, 14, 1, 'sjatene@gmail.com', 'sjatene', '82dc420a41d972143e57cc5899131414', NULL, NULL, NULL, NULL, 'masculino', 'Marcio Szechtman', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '2021-02-10 16:10:01'),
(78, 11, 2, 14, 1, 'cleidecftavares@gmail.com', 'Cleide Tavares', '82dc420a41d972143e57cc5899131414', NULL, NULL, NULL, NULL, 'feminino', 'Cleide Tavares', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '2021-02-17 11:11:11'),
(79, 11, 2, 14, 1, 'daniela.chiaretti@valor.com.br', 'Daniela Chiaretti', '82dc420a41d972143e57cc5899131414', NULL, NULL, NULL, NULL, 'feminino', 'Daniela Chiaretti', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '2021-02-18 12:21:00'),
(464, 1, 2, 1, 1, 'mayamoraiss@gmail.com', 'Maya Morais', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', '2021-04-07', '', NULL, 'Academia', 'uÃ© manÃ©', 'uÃ© manÃ©', 'Amapá', 'uÃ©', NULL, NULL, 'S', '0', '2021-04-07 08:44:47'),
(472, 1, 2, 1, 1, 'teste@teste.com', 'teste', '81dc9bdb52d04dc20036dbd8313ed055', NULL, NULL, NULL, '2021-04-07', 'feminino', NULL, 'Agropecuária', 'teste', 'teste', 'Amazonas', 'cxc', NULL, NULL, '0', '0', '2021-04-07 10:02:37'),
(473, 1, 2, 1, 1, 'raquel@gmail.com', 'Raquel Santos', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, '2021-04-07', 'feminino', NULL, 'Academia e Gestão pública', 'Macroplan', 'Macroplan', 'Alagoas', 'Santos', NULL, NULL, '0', '0', '2021-04-07 10:09:22'),
(474, 1, 2, 5, 1, 'aldo.polastre76@gmail.com', 'Aldo Polastre', '827ccb0eea8a706c4c34a16891f84e7b', '', '', '', '2021-04-07', 'feminino', NULL, 'Academia e Gestão pública', 'teste', 'teste', 'Amapá', 'macapá', NULL, NULL, 'S', '0', '2021-04-07 10:35:28'),
(475, 1, 2, 1, 1, 'teste@teste.com', 'teste teste', '81dc9bdb52d04dc20036dbd8313ed055', NULL, NULL, NULL, '2021-04-07', 'feminino', NULL, 'Comércio', '111', '111', 'Mato Grosso', 'rrr', NULL, NULL, '0', '0', '2021-04-07 18:41:13'),
(476, 1, 2, 6, 1, 'maranhao@gmail.com', 'maranhão', '81dc9bdb52d04dc20036dbd8313ed055', '', '', '', '2021-04-08', 'feminino', NULL, 'Gestão pública', '123', '123', 'Maranhão', 'sdsd', NULL, NULL, '0', '0', '2021-04-08 10:16:47'),
(477, 1, 2, 13, 1, 'matogrosso@gmail.com', 'matogrosso', '81dc9bdb52d04dc20036dbd8313ed055', '', '', '', '2021-04-08', '', NULL, 'Gestão pública', '1', '1', 'Mato Grosso', '1', NULL, NULL, '0', '0', '2021-04-08 10:24:58'),
(481, 1, 2, 1, 1, 'rondonia@gmail.com', 'rondonia', '81dc9bdb52d04dc20036dbd8313ed055', NULL, NULL, NULL, '2021-04-08', 'feminino', NULL, 'Academia', '1', '1', 'Rondônia', '1', NULL, NULL, '0', '0', '2021-04-08 10:39:00'),
(482, 1, 2, 1, 1, 'roraima@gmail.com', 'roraima', '81dc9bdb52d04dc20036dbd8313ed055', NULL, NULL, NULL, '2021-04-08', 'feminino', NULL, 'Gestão pública', '2', '2', 'Roraima', 'e', NULL, NULL, '0', '0', '2021-04-08 10:41:49'),
(483, 1, 2, 1, 1, 'saopaulo@gmail.com', 'saopaulo', '81dc9bdb52d04dc20036dbd8313ed055', '', '', '', '2021-04-08', '', NULL, 'Academia', '1', '1', 'São Paulo', 'sadasd', NULL, NULL, '0', '0', '2021-04-08 10:46:43'),
(484, 1, 2, 1, 1, 'teste3@gmail.com', 'teste3', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, '2021-04-08', 'feminino', NULL, 'Academia', 'teste3', 'teste3', 'Espírito Santo', 'teste3', NULL, NULL, '0', '0', '2021-04-08 11:05:17'),
(485, 1, 2, 1, 1, 'teste4@gmail.com', 'teste4', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, '2021-04-08', 'feminino', NULL, 'Academia', 'teste4', 'teste4', 'Pará', 'teste4', NULL, NULL, '0', '0', '2021-04-08 11:06:00'),
(486, 1, 2, 1, 1, 'riodejaneiro@gmail.com', 'riodejaneiro', '81dc9bdb52d04dc20036dbd8313ed055', '', '', '', '2021-04-08', '', NULL, 'Academia', '13', '12', 'Rio de Janeiro', 'ew', NULL, NULL, '0', '0', '2021-04-08 11:10:34'),
(487, 1, 2, 1, 1, 'matogrosso@gmail.com', 'matogrosso', '81dc9bdb52d04dc20036dbd8313ed055', '', '', '', '2021-04-08', '', NULL, 'Gestão pública', '1', '1', 'Mato Grosso', '1', NULL, NULL, '0', '0', '2021-04-08 11:12:57'),
(521, 1, 2, 1, 1, 'amapa@gmail.com', 'amapa', '81dc9bdb52d04dc20036dbd8313ed055', NULL, NULL, NULL, '2021-04-08', 'feminino', NULL, 'Agropecuária', '', '', 'Amapá', 'macapa', NULL, NULL, 'N', 'S', '2021-04-08 18:59:45'),
(522, 1, 2, 1, 1, 'acre@gmail.com', 'acreano', '81dc9bdb52d04dc20036dbd8313ed055', '', '', '', '2021-04-09', '', NULL, 'Academia', '', '', 'Acre', 'rio branco', NULL, NULL, 'N', 'S', '2021-04-09 07:56:57'),
(523, 1, 2, 1, 1, 'teste@gmail.com', 'Maya', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', '2021-04-21', '', NULL, 'Administração pública, defesa e segurida', 'teste', 'teste', 'São Paulo', 'teste', NULL, NULL, 'S', 'S', '2021-04-09 12:40:35'),
(527, 1, 2, 1, 1, 'saopaulo2@gmail.com', 'sdadasd', '827ccb0eea8a706c4c34a16891f84e7b', '', '', '', '2021-04-09', '', NULL, 'Academia', '', '', 'Minas Gerais', '11', NULL, NULL, 'N', 'S', '2021-04-09 13:16:24'),
(528, 1, 2, 1, 1, 'saopaulo3@gmail.com', '1234', '827ccb0eea8a706c4c34a16891f84e7b', NULL, NULL, NULL, '2021-04-09', 'feminino', NULL, 'Academia', '', '', 'Acre', 'd', NULL, NULL, 'N', 'S', '2021-04-09 13:19:29'),
(529, 1, 2, 1, 1, 'mato@gmail.com', 'matogrosso2', '81dc9bdb52d04dc20036dbd8313ed055', NULL, NULL, NULL, '2021-04-10', 'feminino', NULL, 'Academia', '', '', 'Mato Grosso do Sul', 'trtr', NULL, NULL, 'N', 'S', '2021-04-10 00:10:08'),
(530, 1, 2, 1, 1, 'aldo.polastre@macroplan.com.br', 'aldo polastre', '81dc9bdb52d04dc20036dbd8313ed055', '', '', '', '1976-01-20', '', NULL, 'Indústrias extrativas', '', '', 'Rio Grande do Sul', 'ds', NULL, NULL, 'S', 'S', '2021-04-10 00:13:44'),
(531, 1, 2, 1, 1, 'joaomarcos@gmail.com', 'João Marcos', '827ccb0eea8a706c4c34a16891f84e7b', '', '', '', '2021-04-12', '', NULL, 'Gestão pública', '', '', 'São Paulo', 'sp', NULL, NULL, 'N', 'S', '2021-04-12 09:24:18'),
(532, 1, 2, 1, 1, 'aldo_polastre@yahoo.com.br', 'Aldo teste', '81dc9bdb52d04dc20036dbd8313ed055', '', '', '', '2021-04-14', '', NULL, 'Gestão pública', 'UFMG', 'Dono', 'Minas Gerais', 'Belo Horizonte', NULL, NULL, 'S', 'S', '2021-04-14 15:39:44'),
(533, 1, 2, 1, 1, 'bruno.young@macroplan.com.br', 'Bruno Young', '82dc420a41d972143e57cc5899131414', '', '', '', '1991-03-01', '', NULL, 'Academia', '', '', 'Rio de Janeiro', 'ds', NULL, NULL, '', 'S', '2021-04-10 00:13:44'),
(534, 1, 2, 1, 1, 'brunoyoung1@hotmail.com', 'Bruno Young', '82dc420a41d972143e57cc5899131414', '', '', '', '1991-03-01', '', NULL, 'Academia', '', '', 'Rio de Janeiro', 'ds', NULL, NULL, '', 'S', '2021-04-10 00:13:44'),
(535, 1, 2, 1, 1, 'gabriel.polastre@gmail.com', 'Gabriel Polastre', '81dc9bdb52d04dc20036dbd8313ed055', NULL, NULL, NULL, '2021-04-14', 'feminino', NULL, 'Academia', '', '', 'Rio de Janeiro', 'e', NULL, NULL, 'S', 'S', '2021-04-14 18:39:14'),
(537, 1, 2, 1, 1, 'testesteste@gmail.com', 'testetesteteste', '81dc9bdb52d04dc20036dbd8313ed055', NULL, NULL, NULL, '2021-04-26', 'feminino', NULL, 'Gestão pública', '', '', 'Mato Grosso', 'teert', NULL, NULL, 'N', 'S', '2021-04-26 14:59:56'),
(538, 1, 2, 1, 1, 'amazonas123@gmail.com', 'Amazonas teste', '81dc9bdb52d04dc20036dbd8313ed055', '', '', '', '2021-04-26', '', NULL, 'Academia', '', '', 'Amapá', 'Manaus', NULL, NULL, '', 'S', '2021-04-26 16:28:02'),
(539, 1, 2, 1, 1, 'venturyasmin@gmail.com', 'Yasmin  Araujo', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', '2021-04-27', '', NULL, 'Serviços', '', '', 'Amazonas', '', NULL, NULL, '', 'S', '2021-04-27 16:53:45'),
(540, 1, 2, 1, 1, 'mayara.morais@macroplan.com.br', 'Mayara Morais', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'S', 'S', '2021-04-28 15:59:49'),
(545, 1, 2, 1, 1, 'mayaramoraiss@yahoo.com.br', 'Mayara Morais dos Santos', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'S', NULL, '2021-04-28 17:10:29'),
(556, 1, 2, 1, 1, 'juli.arretada@gmail.com', 'Juliette', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', '2021-04-28', '', NULL, 'Agropecuária, pecuária, produção florest', 'Caxias', 'Caxias', 'Maranhão', 'Caxias', NULL, NULL, '', 'S', '2021-04-29 16:19:02'),
(557, 1, 2, 1, 1, 'eber.goncalves@gmail.com', 'Eber Gonçalves', '81dc9bdb52d04dc20036dbd8313ed055', NULL, NULL, NULL, '2021-04-29', 'feminino', NULL, 'Informação e comunicação', '', '', 'Rio de Janeiro', 'Rio de Janeiro', NULL, NULL, 'S', 'S', '2021-04-29 18:03:05'),
(560, 1, 2, 1, 1, 'cami.lucas@gmail.com', 'Camila de lucas', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, '2021-05-06', 'feminino', NULL, 'Agricultura', '', '', 'Acre', 'Instituição', 'S', 'S', 'S', 'S', '2021-05-06 14:45:45'),
(561, 1, 2, 1, 1, 'gil.vigor@gmail.com', 'Gil do vigor', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', '2021-05-06', '', NULL, 'Administração pública, defesa e segurida', 'Instituição', 'Instituição', 'Amapá', 'Instituição', '', 'S', '', 'S', '2021-05-06 14:48:02'),
(562, 1, 2, 1, 1, 'feiuk@gmail.com', 'Fiuk', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, '2021-05-06', 'feminino', NULL, 'Agricultura', '', '', 'Acre', 'Rio Branco', 'N', 'S', 'S', 'S', '2021-05-06 15:40:31'),
(563, 1, 2, 1, 1, 'pocah@gmail.com', 'Pocah Energia', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, '2021-05-06', 'feminino', NULL, 'Agricultura', '', '', 'Acre', 'Rio Branco', 'S', 'N', 'N', 'S', '2021-05-06 15:44:01'),
(564, 1, 2, 1, 1, 'pocahronte@gmail.com', 'Pocah Energia', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, '2021-05-06', 'feminino', NULL, 'Agricultura', '', '', 'Acre', 'Rio Branco', 'S', 'N', 'N', 'S', '2021-05-06 15:46:43'),
(565, 1, 2, 1, 1, 'pocronte@gmail.com', 'Pocah Energia', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, '2021-05-06', 'feminino', NULL, 'Agricultura', '', '', 'Acre', 'Rio Branco', 'S', 'N', 'N', 'S', '2021-05-06 15:50:30'),
(566, 1, 2, 1, 1, 'poc@gmail.com', 'Pocah Energia', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, '2021-05-06', 'feminino', NULL, 'Agricultura', '', '', 'Acre', 'Rio Branco', 'S', 'N', 'N', 'S', '2021-05-06 15:50:44'),
(567, 1, 2, 1, 1, '1', '1', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, '2021-05-06', 'feminino', NULL, 'Agricultura', '1', '1', 'Acre', '1', 'N', 'N', 'N', 'S', '2021-05-06 15:58:16'),
(568, 1, 2, 1, 1, '2', '2', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, '2021-05-06', 'feminino', NULL, 'Agricultura', '', '', 'Acre', '2', 'N', 'N', 'N', 'S', '2021-05-06 15:59:06'),
(569, 1, 2, 1, 1, '3', '3', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, '2021-05-06', 'feminino', NULL, 'Agricultura', '', '3', 'Acre', '3', 'N', 'N', 'N', 'S', '2021-05-06 16:03:24'),
(570, 1, 2, 1, 1, '5', '5', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, '2021-05-06', 'feminino', NULL, 'Agricultura', '5', '', 'Acre', '5', 'S', 'N', 'N', 'S', '2021-05-06 16:10:26'),
(571, 1, 2, 1, 1, '7@gmail.com', '7', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, '2021-05-06', 'feminino', NULL, 'Agricultura', '7', '', 'Acre', '7', 'N', 'N', 'N', 'S', '2021-05-06 16:38:59');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=572;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
