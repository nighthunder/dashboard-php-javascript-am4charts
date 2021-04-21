-- phpMyAdmin SQL Dump
-- version 4.3.7
-- http://www.phpmyadmin.net
--
-- Host: mysql06-farm10.kinghost.net
-- Tempo de geração: 28/10/2020 às 11:44
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
  `name` varchar(60) NOT NULL,
  `passwd` varchar(90) NOT NULL,
  `address` varchar(45) DEFAULT NULL,
  `telefone` varchar(45) DEFAULT NULL,
  `birth_date` datetime DEFAULT NULL,
  `sex` varchar(1) DEFAULT NULL,
  `nick` varchar(45) DEFAULT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tabela que armazena dados de um usuário qualquer';

--
-- Fazendo dump de dados para tabela `user`
--

INSERT INTO `user` (`id`, `office_id`, `rule_id`, `state_id`, `position_id`, `email`, `name`, `passwd`, `address`, `telefone`, `birth_date`, `sex`, `nick`, `create_date`) VALUES
(1, 2, 2, 2, 1, 'mariadelourdes@gmail.com', 'Maria de Loudes da Silva', 'e10adc3949ba59abbe56e057f20f883e', NULL, '2131435435', '2019-02-11 00:00:00', 'f', 'maria de lourdes', '2020-10-07 16:18:17'),
(2, 1, 1, 2, 2, 'mayamoraiss@gmail.com', 'Mayara Morais', 'e10adc3949ba59abbe56e057f20f883e', NULL, '99999999', '0000-00-00 00:00:00', 'f', 'Mayara Morais', '2020-10-07 16:27:10');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`), ADD KEY `office_id` (`office_id`), ADD KEY `rule_id` (`rule_id`), ADD KEY `position_id` (`position_id`);

--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `user`
--
ALTER TABLE `user`
ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`id`) REFERENCES `state` (`id`),
ADD CONSTRAINT `user_ibfk_3` FOREIGN KEY (`office_id`) REFERENCES `office` (`id`),
ADD CONSTRAINT `user_ibfk_4` FOREIGN KEY (`rule_id`) REFERENCES `rule` (`id`),
ADD CONSTRAINT `user_ibfk_5` FOREIGN KEY (`position_id`) REFERENCES `position` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
