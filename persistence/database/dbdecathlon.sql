-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Máquina: 127.0.0.1
-- Data de Criação: 04-Jan-2014 às 18:16
-- Versão do servidor: 5.6.11
-- versão do PHP: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `dbdecathlon`
--
CREATE DATABASE IF NOT EXISTS `dbdecathlon` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `dbdecathlon`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `compras`
--

CREATE TABLE IF NOT EXISTS `compras` (
  `id_compras` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_usuario` bigint(20) NOT NULL,
  `id_itens` bigint(20) NOT NULL,
  `data` datetime NOT NULL,
  `valor_pago` double NOT NULL,
  `quantidade` bigint(20) NOT NULL,
  PRIMARY KEY (`id_compras`),
  KEY `itens_itens_loja_fk` (`id_itens`),
  KEY `usuarios_vendas_fk` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `creditos`
--

CREATE TABLE IF NOT EXISTS `creditos` (
  `id_credito` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_usuario` bigint(20) NOT NULL,
  `valor` double NOT NULL,
  PRIMARY KEY (`id_credito`),
  KEY `usuarios_creditos_fk` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fans`
--

CREATE TABLE IF NOT EXISTS `fans` (
  `id_fans` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_usuario` bigint(20) NOT NULL,
  `id_fan` bigint(20) NOT NULL,
  PRIMARY KEY (`id_fans`),
  KEY `usuarios_fas_fk` (`id_usuario`),
  KEY `usuarios_fas_fk1` (`id_fan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `itens`
--

CREATE TABLE IF NOT EXISTS `itens` (
  `id_itens` bigint(20) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(30) NOT NULL,
  `valor` double NOT NULL,
  `path_image_item` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_itens`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Extraindo dados da tabela `itens`
--

INSERT INTO `itens` (`id_itens`, `descricao`, `valor`, `path_image_item`) VALUES
(1, 'Camisa vermelha', 0, 'game1/cor1.png'),
(2, 'Camisa Amarela', 0, 'game1/cor2.png'),
(3, 'Camisa Azul', 0, 'game1/cor3.png'),
(4, 'Camisa Verde', 0, 'game1/cor4.png'),
(5, 'Camisa Rosa', 0, 'game1/cor5.png'),
(6, 'Tenis Normal', 0, 'game1/tipotenis1.png'),
(7, 'Tenis Veloz', 2000, 'game1/tipotenis2.png'),
(8, 'Tenis Hiper-veloz', 5000, 'game1/tipotenis3.png'),
(9, 'Tenis Aderente', 7000, 'game1/tipotenis4.png'),
(10, 'Tenis Hiper-aderente', 10000, 'game1/tipotenis5.png'),
(11, 'Água', 0, 'game1/tiposuplemento1.png'),
(12, 'Vitaminas', 3000, 'game1/tiposuplemento2.png'),
(13, 'Energético', 7000, 'game1/tiposuplemento3.png'),
(14, 'Feijão mexicano', 10000, 'game1/tiposuplemento4.png'),
(15, 'Anabolizante', 15000, 'game1/tiposuplemento5'),
(16, 'Anjo', 0, 'game1/tipotrapaca1.png'),
(17, 'Empurrão', 10000, 'game1/tipotrapaca2.png'),
(18, 'Rouba trapaça', 20000, 'game1/tipotrapaca3.png'),
(19, 'Desliza', 20000, 'game1/tipotrapaca4.png'),
(20, 'Cria barreira', 30000, 'game1/tipotrapaca5.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `itens_power`
--

CREATE TABLE IF NOT EXISTS `itens_power` (
  `id_itens_power` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_power` bigint(20) NOT NULL,
  `id_itens` bigint(20) NOT NULL,
  PRIMARY KEY (`id_itens_power`),
  KEY `power_itens_power_fk` (`id_power`),
  KEY `itens_itens_power_fk` (`id_itens`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Extraindo dados da tabela `itens_power`
--

INSERT INTO `itens_power` (`id_itens_power`, `id_power`, `id_itens`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 2, 7),
(8, 3, 8),
(9, 4, 9),
(10, 5, 10),
(11, 1, 11),
(12, 6, 12),
(13, 7, 13),
(14, 10, 14),
(15, 11, 15),
(16, 1, 16),
(17, 12, 17),
(18, 13, 18),
(19, 14, 19),
(20, 15, 20);

-- --------------------------------------------------------

--
-- Estrutura da tabela `partida`
--

CREATE TABLE IF NOT EXISTS `partida` (
  `id_partida` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_usuario` bigint(20) NOT NULL,
  `data` datetime NOT NULL,
  `path_file_tracker` varchar(255) NOT NULL,
  PRIMARY KEY (`id_partida`),
  KEY `usuarios_partida_fk` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `perfil_usuario`
--

CREATE TABLE IF NOT EXISTS `perfil_usuario` (
  `id_usuario_perfil` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_perfil` bigint(20) NOT NULL,
  `id_usuario` bigint(20) NOT NULL,
  PRIMARY KEY (`id_usuario_perfil`),
  KEY `perfis_perfil_usuario_fk` (`id_perfil`),
  KEY `usuarios_perfil_usuario_fk` (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `perfil_usuario`
--

INSERT INTO `perfil_usuario` (`id_usuario_perfil`, `id_perfil`, `id_usuario`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 1, 50);

-- --------------------------------------------------------

--
-- Estrutura da tabela `perfis`
--

CREATE TABLE IF NOT EXISTS `perfis` (
  `id_perfil` bigint(20) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(30) NOT NULL,
  PRIMARY KEY (`id_perfil`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `perfis`
--

INSERT INTO `perfis` (`id_perfil`, `descricao`) VALUES
(1, 'jogador'),
(2, 'admin');

-- --------------------------------------------------------

--
-- Estrutura da tabela `power`
--

CREATE TABLE IF NOT EXISTS `power` (
  `id_power` bigint(20) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(30) NOT NULL,
  PRIMARY KEY (`id_power`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Extraindo dados da tabela `power`
--

INSERT INTO `power` (`id_power`, `descricao`) VALUES
(1, 'nenhum poder'),
(2, 'Aumenta velocidade 1x'),
(3, 'Aumenta velocidade 2x'),
(4, 'Aderente'),
(5, 'Muito aderente'),
(6, 'Velocidade extra'),
(7, 'Super força'),
(10, 'Super pulo'),
(11, 'Hiper pulo'),
(12, 'empurrão'),
(13, 'rouba trapaça'),
(14, 'desliza'),
(15, 'cria barreira');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` bigint(20) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `facebook` varchar(100) NOT NULL,
  `path_file_foto` varchar(255) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=51 ;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `email`, `nome`, `senha`, `facebook`, `path_file_foto`) VALUES
(1, 'oscar.devgame@gmail.com', 'Oscar', 'oscar', 'oscar.devgame', ''),
(50, 'oscar.devgame3@gmail.com', 'Oscar 3', 'oscar', '', '../resources/images/oscar.devgame3@gmail.com/default-avatar.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_itens`
--

CREATE TABLE IF NOT EXISTS `usuario_itens` (
  `id_power` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_usuario` bigint(20) NOT NULL,
  `id_itens` bigint(20) NOT NULL,
  `situacao` bigint(20) NOT NULL,
  PRIMARY KEY (`id_power`),
  KEY `itens_usuario_itens_fk` (`id_itens`),
  KEY `usuarios_usuario_itens_fk` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `itens_itens_loja_fk` FOREIGN KEY (`id_itens`) REFERENCES `itens` (`id_itens`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `usuarios_vendas_fk` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `creditos`
--
ALTER TABLE `creditos`
  ADD CONSTRAINT `usuarios_creditos_fk` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `fans`
--
ALTER TABLE `fans`
  ADD CONSTRAINT `usuarios_fas_fk` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `usuarios_fas_fk1` FOREIGN KEY (`id_fan`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `itens_power`
--
ALTER TABLE `itens_power`
  ADD CONSTRAINT `itens_itens_power_fk` FOREIGN KEY (`id_itens`) REFERENCES `itens` (`id_itens`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `power_itens_power_fk` FOREIGN KEY (`id_power`) REFERENCES `power` (`id_power`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `partida`
--
ALTER TABLE `partida`
  ADD CONSTRAINT `usuarios_partida_fk` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `perfil_usuario`
--
ALTER TABLE `perfil_usuario`
  ADD CONSTRAINT `perfis_perfil_usuario_fk` FOREIGN KEY (`id_perfil`) REFERENCES `perfis` (`id_perfil`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `usuarios_perfil_usuario_fk` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `usuario_itens`
--
ALTER TABLE `usuario_itens`
  ADD CONSTRAINT `itens_usuario_itens_fk` FOREIGN KEY (`id_itens`) REFERENCES `itens` (`id_itens`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `usuarios_usuario_itens_fk` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
