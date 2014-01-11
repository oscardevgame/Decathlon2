-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Máquina: 127.0.0.1
-- Data de Criação: 11-Jan-2014 às 02:17
-- Versão do servidor: 5.6.11
-- versão do PHP: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES latin1 */;

--
-- Base de Dados: `dbdecathlon`
--
CREATE DATABASE IF NOT EXISTS `dbdecathlon` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `dbdecathlon`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `compras`
--

DROP TABLE IF EXISTS `compras`;
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

DROP TABLE IF EXISTS `creditos`;
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

DROP TABLE IF EXISTS `fans`;
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

DROP TABLE IF EXISTS `itens`;
CREATE TABLE IF NOT EXISTS `itens` (
  `id_itens` bigint(20) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(30) NOT NULL,
  `valor` double NOT NULL,
  `categoria` varchar(30) NOT NULL,
  `path_image_item` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_itens`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Extraindo dados da tabela `itens`
--

INSERT INTO `itens` (`id_itens`, `descricao`, `valor`, `categoria`, `path_image_item`) VALUES(1, 'Camisa vermelha', 0, 'camisa', 'game1/camisa1.png');
INSERT INTO `itens` (`id_itens`, `descricao`, `valor`, `categoria`, `path_image_item`) VALUES(2, 'Camisa Amarela', 0, 'camisa', 'game1/camisa2.png');
INSERT INTO `itens` (`id_itens`, `descricao`, `valor`, `categoria`, `path_image_item`) VALUES(3, 'Camisa Azul', 0, 'camisa', 'game1/camisa3.png');
INSERT INTO `itens` (`id_itens`, `descricao`, `valor`, `categoria`, `path_image_item`) VALUES(4, 'Camisa Verde', 0, 'camisa', 'game1/camisa4.png');
INSERT INTO `itens` (`id_itens`, `descricao`, `valor`, `categoria`, `path_image_item`) VALUES(5, 'Camisa Rosa', 0, 'camisa', 'game1/camisa5.png');
INSERT INTO `itens` (`id_itens`, `descricao`, `valor`, `categoria`, `path_image_item`) VALUES(6, 'Tenis Normal', 0, 'tenis', 'game1/tipotenis1.png');
INSERT INTO `itens` (`id_itens`, `descricao`, `valor`, `categoria`, `path_image_item`) VALUES(7, 'Tenis Veloz', 2000, 'tenis', 'game1/tipotenis2.png');
INSERT INTO `itens` (`id_itens`, `descricao`, `valor`, `categoria`, `path_image_item`) VALUES(8, 'Tenis Hiper-veloz', 5000, 'tenis', 'game1/tipotenis3.png');
INSERT INTO `itens` (`id_itens`, `descricao`, `valor`, `categoria`, `path_image_item`) VALUES(9, 'Tenis Aderente', 7000, 'tenis', 'game1/tipotenis4.png');
INSERT INTO `itens` (`id_itens`, `descricao`, `valor`, `categoria`, `path_image_item`) VALUES(10, 'Tenis Hiper-aderente', 10000, 'tenis', 'game1/tipotenis5.png');
INSERT INTO `itens` (`id_itens`, `descricao`, `valor`, `categoria`, `path_image_item`) VALUES(11, 'Água', 0, 'suplemento', 'game1/suplemento1.png');
INSERT INTO `itens` (`id_itens`, `descricao`, `valor`, `categoria`, `path_image_item`) VALUES(12, 'Vitaminas', 3000, 'suplemento', 'game1/suplemento2.png');
INSERT INTO `itens` (`id_itens`, `descricao`, `valor`, `categoria`, `path_image_item`) VALUES(13, 'Energético', 7000, 'suplemento', 'game1/suplemento3.png');
INSERT INTO `itens` (`id_itens`, `descricao`, `valor`, `categoria`, `path_image_item`) VALUES(14, 'Feijão mexicano', 10000, 'suplemento', 'game1/suplemento4.png');
INSERT INTO `itens` (`id_itens`, `descricao`, `valor`, `categoria`, `path_image_item`) VALUES(15, 'Anabolizante', 15000, 'suplemento', 'game1/suplemento5.png');
INSERT INTO `itens` (`id_itens`, `descricao`, `valor`, `categoria`, `path_image_item`) VALUES(16, 'Anjo', 0, 'trapaca', 'game1/tipotrapaca1.png');
INSERT INTO `itens` (`id_itens`, `descricao`, `valor`, `categoria`, `path_image_item`) VALUES(17, 'Empurrão', 10000, 'trapaca', 'game1/tipotrapaca2.png');
INSERT INTO `itens` (`id_itens`, `descricao`, `valor`, `categoria`, `path_image_item`) VALUES(18, 'Rouba trapaça', 20000, 'trapaca', 'game1/tipotrapaca3.png');
INSERT INTO `itens` (`id_itens`, `descricao`, `valor`, `categoria`, `path_image_item`) VALUES(19, 'Desliza', 20000, 'trapaca', 'game1/tipotrapaca4.png');
INSERT INTO `itens` (`id_itens`, `descricao`, `valor`, `categoria`, `path_image_item`) VALUES(20, 'Cria barreira', 30000, 'trapaca', 'game1/tipotrapaca5.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `itens_power`
--

DROP TABLE IF EXISTS `itens_power`;
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

INSERT INTO `itens_power` (`id_itens_power`, `id_power`, `id_itens`) VALUES(1, 1, 1);
INSERT INTO `itens_power` (`id_itens_power`, `id_power`, `id_itens`) VALUES(2, 1, 2);
INSERT INTO `itens_power` (`id_itens_power`, `id_power`, `id_itens`) VALUES(3, 1, 3);
INSERT INTO `itens_power` (`id_itens_power`, `id_power`, `id_itens`) VALUES(4, 1, 4);
INSERT INTO `itens_power` (`id_itens_power`, `id_power`, `id_itens`) VALUES(5, 1, 5);
INSERT INTO `itens_power` (`id_itens_power`, `id_power`, `id_itens`) VALUES(6, 1, 6);
INSERT INTO `itens_power` (`id_itens_power`, `id_power`, `id_itens`) VALUES(7, 2, 7);
INSERT INTO `itens_power` (`id_itens_power`, `id_power`, `id_itens`) VALUES(8, 3, 8);
INSERT INTO `itens_power` (`id_itens_power`, `id_power`, `id_itens`) VALUES(9, 4, 9);
INSERT INTO `itens_power` (`id_itens_power`, `id_power`, `id_itens`) VALUES(10, 5, 10);
INSERT INTO `itens_power` (`id_itens_power`, `id_power`, `id_itens`) VALUES(11, 1, 11);
INSERT INTO `itens_power` (`id_itens_power`, `id_power`, `id_itens`) VALUES(12, 6, 12);
INSERT INTO `itens_power` (`id_itens_power`, `id_power`, `id_itens`) VALUES(13, 7, 13);
INSERT INTO `itens_power` (`id_itens_power`, `id_power`, `id_itens`) VALUES(14, 10, 14);
INSERT INTO `itens_power` (`id_itens_power`, `id_power`, `id_itens`) VALUES(15, 11, 15);
INSERT INTO `itens_power` (`id_itens_power`, `id_power`, `id_itens`) VALUES(16, 1, 16);
INSERT INTO `itens_power` (`id_itens_power`, `id_power`, `id_itens`) VALUES(17, 12, 17);
INSERT INTO `itens_power` (`id_itens_power`, `id_power`, `id_itens`) VALUES(18, 13, 18);
INSERT INTO `itens_power` (`id_itens_power`, `id_power`, `id_itens`) VALUES(19, 14, 19);
INSERT INTO `itens_power` (`id_itens_power`, `id_power`, `id_itens`) VALUES(20, 15, 20);

-- --------------------------------------------------------

--
-- Estrutura da tabela `partida`
--

DROP TABLE IF EXISTS `partida`;
CREATE TABLE IF NOT EXISTS `partida` (
  `id_partida` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_usuario` bigint(20) NOT NULL,
  `data` datetime NOT NULL,
  `path_file_tracker` varchar(255) NOT NULL,
  `pontuacao` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id_partida`),
  KEY `usuarios_partida_fk` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `perfil_usuario`
--

DROP TABLE IF EXISTS `perfil_usuario`;
CREATE TABLE IF NOT EXISTS `perfil_usuario` (
  `id_usuario_perfil` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_perfil` bigint(20) NOT NULL,
  `id_usuario` bigint(20) NOT NULL,
  PRIMARY KEY (`id_usuario_perfil`),
  KEY `perfis_perfil_usuario_fk` (`id_perfil`),
  KEY `usuarios_perfil_usuario_fk` (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Extraindo dados da tabela `perfil_usuario`
--

INSERT INTO `perfil_usuario` (`id_usuario_perfil`, `id_perfil`, `id_usuario`) VALUES(1, 1, 1);
INSERT INTO `perfil_usuario` (`id_usuario_perfil`, `id_perfil`, `id_usuario`) VALUES(2, 2, 1);
INSERT INTO `perfil_usuario` (`id_usuario_perfil`, `id_perfil`, `id_usuario`) VALUES(3, 1, 50);
INSERT INTO `perfil_usuario` (`id_usuario_perfil`, `id_perfil`, `id_usuario`) VALUES(4, 1, 51);
INSERT INTO `perfil_usuario` (`id_usuario_perfil`, `id_perfil`, `id_usuario`) VALUES(5, 1, 52);
INSERT INTO `perfil_usuario` (`id_usuario_perfil`, `id_perfil`, `id_usuario`) VALUES(6, 1, 53);
INSERT INTO `perfil_usuario` (`id_usuario_perfil`, `id_perfil`, `id_usuario`) VALUES(7, 1, 54);
INSERT INTO `perfil_usuario` (`id_usuario_perfil`, `id_perfil`, `id_usuario`) VALUES(8, 1, 55);
INSERT INTO `perfil_usuario` (`id_usuario_perfil`, `id_perfil`, `id_usuario`) VALUES(9, 1, 56);

-- --------------------------------------------------------

--
-- Estrutura da tabela `perfis`
--

DROP TABLE IF EXISTS `perfis`;
CREATE TABLE IF NOT EXISTS `perfis` (
  `id_perfil` bigint(20) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(30) NOT NULL,
  PRIMARY KEY (`id_perfil`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `perfis`
--

INSERT INTO `perfis` (`id_perfil`, `descricao`) VALUES(1, 'jogador');
INSERT INTO `perfis` (`id_perfil`, `descricao`) VALUES(2, 'admin');

-- --------------------------------------------------------

--
-- Estrutura da tabela `power`
--

DROP TABLE IF EXISTS `power`;
CREATE TABLE IF NOT EXISTS `power` (
  `id_power` bigint(20) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(30) NOT NULL,
  PRIMARY KEY (`id_power`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Extraindo dados da tabela `power`
--

INSERT INTO `power` (`id_power`, `descricao`) VALUES(1, 'nenhum poder');
INSERT INTO `power` (`id_power`, `descricao`) VALUES(2, 'Aumenta velocidade 1x');
INSERT INTO `power` (`id_power`, `descricao`) VALUES(3, 'Aumenta velocidade 2x');
INSERT INTO `power` (`id_power`, `descricao`) VALUES(4, 'Aderente');
INSERT INTO `power` (`id_power`, `descricao`) VALUES(5, 'Muito aderente');
INSERT INTO `power` (`id_power`, `descricao`) VALUES(6, 'Velocidade extra');
INSERT INTO `power` (`id_power`, `descricao`) VALUES(7, 'Super força');
INSERT INTO `power` (`id_power`, `descricao`) VALUES(10, 'Super pulo');
INSERT INTO `power` (`id_power`, `descricao`) VALUES(11, 'Hiper pulo');
INSERT INTO `power` (`id_power`, `descricao`) VALUES(12, 'empurrão');
INSERT INTO `power` (`id_power`, `descricao`) VALUES(13, 'rouba trapaça');
INSERT INTO `power` (`id_power`, `descricao`) VALUES(14, 'desliza');
INSERT INTO `power` (`id_power`, `descricao`) VALUES(15, 'cria barreira');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` bigint(20) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `facebook` varchar(100) NOT NULL,
  `path_file_foto` varchar(255) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `email`, `nome`, `senha`, `facebook`, `path_file_foto`) VALUES(1, 'oscar.devgame@gmail.com', 'Oscar', 'oscar', 'oscar.devgame', '');
INSERT INTO `usuarios` (`id_usuario`, `email`, `nome`, `senha`, `facebook`, `path_file_foto`) VALUES(50, 'oscar.devgame3@gmail.com', 'Oscar 3', 'oscar', '', '../resources/images/oscar.devgame3@gmail.com/default-avatar.png');
INSERT INTO `usuarios` (`id_usuario`, `email`, `nome`, `senha`, `facebook`, `path_file_foto`) VALUES(51, 'oscar.devgame4@gmail.com', 'Oscar4', 'oscar', '', '../resources/images/oscar.devgame4@gmail.com/default-avatar.png');
INSERT INTO `usuarios` (`id_usuario`, `email`, `nome`, `senha`, `facebook`, `path_file_foto`) VALUES(52, 'oscar.devgame5@gmail.com', 'Oscar5', 'oscar', '', 'resources/images/oscar.devgame5@gmail.com/default-avatar.png');
INSERT INTO `usuarios` (`id_usuario`, `email`, `nome`, `senha`, `facebook`, `path_file_foto`) VALUES(53, 'oscar.devgame6@gmail.com', 'Oscar6', 'oscar', '', 'resources/images/oscar.devgame6@gmail.com/default-avatar.png');
INSERT INTO `usuarios` (`id_usuario`, `email`, `nome`, `senha`, `facebook`, `path_file_foto`) VALUES(54, 'oscar.devgame7@gmail.com', 'Oscar7', 'oscar', '', 'resources/images/oscar.devgame7@gmail.com/default-avatar.png');
INSERT INTO `usuarios` (`id_usuario`, `email`, `nome`, `senha`, `facebook`, `path_file_foto`) VALUES(55, 'oscar.devgame8@gmail.com', 'Oscar8', 'oscar', '', 'resources/images/oscar.devgame8@gmail.com/default-avatar.png');
INSERT INTO `usuarios` (`id_usuario`, `email`, `nome`, `senha`, `facebook`, `path_file_foto`) VALUES(56, 'oscar.devgame9@gmail.com', 'Oscar9', 'oscar', '', 'resources/images/oscar.devgame9@gmail.com/default-avatar.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_itens`
--

DROP TABLE IF EXISTS `usuario_itens`;
CREATE TABLE IF NOT EXISTS `usuario_itens` (
  `id_usuario_itens` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_usuario` bigint(20) NOT NULL,
  `id_itens_power` bigint(20) NOT NULL,
  `situacao` varchar(20) NOT NULL,
  PRIMARY KEY (`id_usuario_itens`),
  KEY `itens_usuario_itens_fk` (`id_itens_power`),
  KEY `usuarios_usuario_itens_fk` (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `usuario_itens`
--

INSERT INTO `usuario_itens` (`id_usuario_itens`, `id_usuario`, `id_itens_power`, `situacao`) VALUES(2, 1, 11, 'ativo');
INSERT INTO `usuario_itens` (`id_usuario_itens`, `id_usuario`, `id_itens_power`, `situacao`) VALUES(3, 1, 6, 'ativo');
INSERT INTO `usuario_itens` (`id_usuario_itens`, `id_usuario`, `id_itens_power`, `situacao`) VALUES(5, 1, 1, 'ativo');
INSERT INTO `usuario_itens` (`id_usuario_itens`, `id_usuario`, `id_itens_power`, `situacao`) VALUES(6, 1, 16, 'ativo');

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
  ADD CONSTRAINT `itens_usuario_itens_fk` FOREIGN KEY (`id_itens_power`) REFERENCES `itens_power` (`id_itens_power`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `usuarios_usuario_itens_fk` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
