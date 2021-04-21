-- phpMyAdmin SQL Dump
-- version 4.3.7
-- http://www.phpmyadmin.net
--
-- Host: mysql06-farm10.kinghost.net
-- Tempo de geração: 02/12/2020 às 19:40
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
-- Estrutura para tabela `office`
--

CREATE TABLE IF NOT EXISTS `office` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `create_date` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COMMENT='Localização do usuário\\n';

--
-- Fazendo dump de dados para tabela `office`
--

INSERT INTO `office` (`id`, `name`, `create_date`) VALUES
(1, 'Secretaria do estado de São Paulo', '2020-10-07 08:28:51'),
(2, 'Secretaria do estado de Roraima', '2020-10-07 08:29:04'),
(3, 'Secretaria do Estado de Rondônia', '2020-10-07 08:30:24'),
(4, 'Secretaria do estado do Acre', '2020-10-07 08:30:43'),
(5, 'Secretaria do estado do Amazonas', '2020-10-07 08:30:57'),
(6, 'Secretaria do estado do Pará', '2020-10-07 08:31:49'),
(7, 'Secretaria do estado do Amapá', '2020-10-07 08:32:05'),
(8, 'Secretaria do estado do Tocantins', '2020-10-07 08:32:27'),
(9, 'Secretaria do Estado do Maranhão', '2020-10-07 08:32:41'),
(10, 'Secretaria do Estado de Mato Grosso', '2020-10-07 08:32:53'),
(11, 'Consórcio Arapyau', '2020-11-30 14:00:44'),
(12, 'Macroplan Consultoria', '2020-11-30 14:22:47');

-- --------------------------------------------------------

--
-- Estrutura para tabela `position`
--

CREATE TABLE IF NOT EXISTS `position` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `create_date` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COMMENT='Cargo na entidade governamental\\n';

--
-- Fazendo dump de dados para tabela `position`
--

INSERT INTO `position` (`id`, `name`, `create_date`) VALUES
(1, 'secretário', '2020-10-07 08:27:40'),
(2, 'desenvolvedor', '2020-10-07 08:27:55'),
(3, 'secretária', '2020-10-07 08:28:04');

-- --------------------------------------------------------

--
-- Estrutura para tabela `rule`
--

CREATE TABLE IF NOT EXISTS `rule` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COMMENT='Tabela que armazena os tipos de papeis de uusário no sistema.';

--
-- Fazendo dump de dados para tabela `rule`
--

INSERT INTO `rule` (`id`, `name`, `description`, `create_date`) VALUES
(1, 'admin', 'Administrador geral do sistema', '2020-10-06 17:44:05'),
(2, 'secretario', 'Secretário de uma prefeitura ou governo de estado ou municipal', '2020-10-06 17:44:55'),
(3, 'funcionario', 'Funcionário de alguma secretaria de prefeitura ou governo de estado que não é um secretário', '2020-10-06 17:45:41');

-- --------------------------------------------------------

--
-- Estrutura para tabela `state`
--

CREATE TABLE IF NOT EXISTS `state` (
  `id` int(11) NOT NULL,
  `acronym` varchar(3) NOT NULL,
  `name` varchar(15) NOT NULL,
  `create_date` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COMMENT='Localização do usuário. Município, estado ou consórcio. Cod é o código no banco de dados da empresa macroplan\\n';

--
-- Fazendo dump de dados para tabela `state`
--

INSERT INTO `state` (`id`, `acronym`, `name`, `create_date`) VALUES
(1, 'RO', 'Rondônia', '2020-10-06 17:20:36'),
(2, 'AC', 'Acre', '2020-10-06 17:20:36'),
(3, 'AM', 'Amazonas', '2020-10-06 17:20:36'),
(4, 'RR', 'Roraima', '2020-10-06 17:20:36'),
(5, 'AP', 'Amapá', '2020-10-06 17:20:36'),
(6, 'MA', 'Maranhão', '2020-10-06 17:20:36'),
(9, 'PA', 'Pará', '2020-10-06 17:20:36'),
(11, 'TO', 'Tocantins', '2020-10-06 17:20:36'),
(13, 'MT', 'Mato Grosso', '2020-10-06 17:20:36'),
(14, 'AML', 'Amazônia Legal', '2020-11-30 13:51:14');

-- --------------------------------------------------------

--
-- Estrutura para tabela `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
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
  `birth_date` datetime DEFAULT NULL,
  `sex` varchar(20) DEFAULT NULL,
  `nick` varchar(45) DEFAULT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tabela que armazena dados de um usuário qualquer';

--
-- Fazendo dump de dados para tabela `user`
--

INSERT INTO `user` (`id`, `office_id`, `rule_id`, `state_id`, `position_id`, `email`, `fullname`, `passwd`, `address`, `zip_code`, `phone`, `birth_date`, `sex`, `nick`, `create_date`) VALUES
(DEFAULT, 12, 2, 14, 1, 'gustavo.morelli@macroplan.com.br', 'Gustavo Morelli', '749cfc9a7434a3a9ebd687fa8c9d546c', NULL, NULL, NULL, NULL, 'masculino', 'Gustavo Morelli', '2020-12-02 17:47:45'),
(DEFAULT, 2, 2, 9, 1, 'mariadelourdes@gmail.com', 'Maria de Lourdes da Silva', 'e10adc3949ba59abbe56e057f20f883e', 'Avenida Dom Helder Camara 4380, bloco 10', '1012-3123', '(21) 32423-4231', '1970-01-01 12:00:00', 'feminino', 'maria de lourdes', '2020-10-07 16:18:17'),
(DEFAULT, 1, 1, 6, 2, 'mayamoraiss@gmail.com', 'Mayara Morais dos Santos', 'e10adc3949ba59abbe56e057f20f883e', 'Travessa Tereza, 14, sobrado, Cachambi4', '2077-1005', '((21) 98425-4956', '1990-06-07 00:00:00', 'masculino', 'Mayara Morais', '2020-10-07 16:27:10'),
(DEFAULT, 11, 2, 14, 1, 'renata.piazzon@arapyau.org.br', 'Renata Piazzon', '749cfc9a7434a3a9ebd687fa8c9d546c', NULL, NULL, NULL, NULL, 'feminino', 'Renata Piazzon', '2020-11-30 14:29:07'),
(DEFAULT, 11, 2, 14, 1, 'rafaela.bergamo@arapyau.org.br', 'Rafaela Bergamo', '749cfc9a7434a3a9ebd687fa8c9d546c', NULL, NULL, NULL, NULL, 'feminino', 'Rafaela Bergamo', '2020-11-30 14:44:27'),
(DEFAULT, 11, 2, 14, 1, 'inaietsantos@gmail.com', 'InaiÃª Santos', 'c22ee753e444e8f3c490330f3d62f8d3', '', '', '', '1970-01-01 12:00:00', 'feminino', 'Inaiê Santos', '2020-11-30 14:47:35'),
(DEFAULT, 11, 2, 14, 1, 'roberto@rswaack.com.br', 'Roberto Waack', '749cfc9a7434a3a9ebd687fa8c9d546c', NULL, NULL, NULL, NULL, 'masculino', 'Roberto Waack', '2020-11-30 14:59:24'),
(DEFAULT, 12, 2, 14, 1, 'glaucio.neves@macroplan.com.br', 'Glaucio Neves', '749cfc9a7434a3a9ebd687fa8c9d546c', NULL, NULL, NULL, NULL, 'masculino', 'Glaucio Neves', '2020-11-30 15:01:27'),
(DEFAULT, 12, 2, 14, 1, 'eber.goncalves@macroplan.com.br', 'Éber Gonçalves', '749cfc9a7434a3a9ebd687fa8c9d546c', NULL, NULL, NULL, NULL, 'masculino', 'Éber Gonçalves', '2020-11-30 15:03:45'),
(DEFAULT, 11, 2, 14, 1, 'fgaetani@gmail.com', 'Francisco Gaetani', '749cfc9a7434a3a9ebd687fa8c9d546c', '', '', '', '1970-01-01 12:00:00', 'masculino', 'Francisco Gaetani', '2020-11-30 14:55:09'),
(DEFAULT, 12, 2, 14, 1, 'gustavo.morelli@macroplan.com.br', 'Gustavo Morelli', '749cfc9a7434a3a9ebd687fa8c9d546c', NULL, NULL, NULL, NULL, 'masculino', 'Gustavo Morelli', '2020-12-02 17:48:00'),
(DEFAULT, 12, 2, 14, 1, 'claudio.porto@macroplan.com.br', 'Claudio Porto', '749cfc9a7434a3a9ebd687fa8c9d546c', NULL, NULL, NULL, NULL, 'masculino', 'Claudio Porto', '2020-12-02 17:48:00'),
(DEFAULT, 12, 2, 14, 1, 'yasmin.ventura@macroplan.com.br', 'Yasmin Ventura', '749cfc9a7434a3a9ebd687fa8c9d546c', NULL, NULL, NULL, NULL, 'feminino', 'Yasmin Ventura', '2020-12-02 17:48:00'),
(DEFAULT, 12, 2, 14, 1, 'adriana.fontes@macroplan.com.br', 'Adriana Fontes', '749cfc9a7434a3a9ebd687fa8c9d546c', NULL, NULL, NULL, NULL, 'feminino', 'Adriana Fontes', '2020-12-02 17:58:19'),
(DEFAULT, 12, 2, 14, 1, 'roberta.teixeira@macroplan.com.br', 'Roberta Teixeira', '749cfc9a7434a3a9ebd687fa8c9d546c', NULL, NULL, NULL, NULL, 'feminino', 'Roberta Teixeira', '2020-12-02 17:58:37');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `office`
--
ALTER TABLE `office`
  ADD PRIMARY KEY (`id`), ADD KEY `id` (`id`), ADD KEY `id_2` (`id`);

--
-- Índices de tabela `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`id`), ADD KEY `id` (`id`);

--
-- Índices de tabela `rule`
--
ALTER TABLE `rule`
  ADD PRIMARY KEY (`id`), ADD KEY `id` (`id`), ADD KEY `id_2` (`id`);

--
-- Índices de tabela `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`id`), ADD KEY `id` (`id`);

--
-- Índices de tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`), ADD KEY `office_id` (`office_id`), ADD KEY `rule_id` (`rule_id`), ADD KEY `position_id` (`position_id`), ADD KEY `state_id` (`state_id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `office`
--
ALTER TABLE `office`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de tabela `position`
--
ALTER TABLE `position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de tabela `rule`
--
ALTER TABLE `rule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de tabela `state`
--
ALTER TABLE `state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `user`
--
ALTER TABLE `user`
ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`state_id`) REFERENCES `state` (`id`),
ADD CONSTRAINT `user_ibfk_3` FOREIGN KEY (`office_id`) REFERENCES `office` (`id`),
ADD CONSTRAINT `user_ibfk_4` FOREIGN KEY (`rule_id`) REFERENCES `rule` (`id`),
ADD CONSTRAINT `user_ibfk_5` FOREIGN KEY (`position_id`) REFERENCES `position` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
