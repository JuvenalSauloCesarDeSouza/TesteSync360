-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 08/07/2025 às 14:27
-- Versão do servidor: 9.1.0
-- Versão do PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `teste_sync360`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `ts_usuarios`
--

DROP TABLE IF EXISTS `ts_usuarios`;
CREATE TABLE IF NOT EXISTS `ts_usuarios` (
  `cod_us` int NOT NULL AUTO_INCREMENT,
  `foto_us` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nome_us` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `idade_us` int NOT NULL,
  `endereco_us` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `bairro_us` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `estado_us` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `biografia_us` tinytext CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`cod_us`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `ts_usuarios`
--

INSERT INTO `ts_usuarios` (`cod_us`, `foto_us`, `nome_us`, `idade_us`, `endereco_us`, `bairro_us`, `estado_us`, `biografia_us`) VALUES
(1, 'b5db61cdfd3b2e5df57acc72736d440e.png', 'Usuário de teste 2', 40, 'Rua teste', 'Bairro teste', '11', 'Minha biografia '),
(4, '4c4b7b3effc5cb47d7645d0b73cbdc66.png', 'Usuário de teste 1', 30, 'Rua teste', 'Bairro teste', '7', 'Biografia de teste'),
(5, '6102831a2e3bd959da9d6c783e72b1d3.png', 'Usuário de teste 3', 45, 'Rua teste', 'Bairro teste', '11', 'Uma biografia é a história escrita da vida de uma pessoa, detalhando seus fatos e acontecimentos importantes. É um gênero textual narrativo, geralmente escrito em terceira pessoa, que busca apresentar a trajetória de vida de alguém, seja uma figura públic');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
