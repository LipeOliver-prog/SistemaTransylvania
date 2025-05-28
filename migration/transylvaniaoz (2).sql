-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 27/05/2025 às 18:55
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `transylvaniaoz`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `boletos`
--

CREATE TABLE `boletos` (
  `id` int(11) NOT NULL,
  `nome_cliente` varchar(255) NOT NULL,
  `cpf_cliente` varchar(20) NOT NULL,
  `vencimento` date NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `nosso_numero` varchar(255) NOT NULL,
  `codigo_banco` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `boletos`
--

INSERT INTO `boletos` (`id`, `nome_cliente`, `cpf_cliente`, `vencimento`, `valor`, `nosso_numero`, `codigo_banco`) VALUES
(1, 'Diego', '123456789', '2024-11-12', 2344.00, '123456789', '001'),
(2, 'Amanda', '123456789', '2024-11-06', 2344.00, '123456789', '001'),
(3, 'Amanda', '123456789', '2024-11-13', 2344.78, '123456789', '001'),
(4, 'Diego', '123456789', '2024-11-12', 2344.00, '123456789', '001'),
(5, 'Amanda', '123456789', '2024-11-06', 130.00, '123456789', '001'),
(6, 'Diego', '123456789', '2024-11-05', 100.00, '123456789', '9001'),
(7, 'Diego', '123456789', '2024-11-06', 2544.00, '123456789', '002'),
(8, 'Amanda', '123456789', '2024-11-13', 2400.00, '123456789', '003'),
(9, 'Ana Julia Silva', '434985248630', '2024-11-21', 421.00, '123456789', '001'),
(10, 'Ana Julia Silva', '434985248630', '2024-11-06', 2544.00, '414131231231232', '231'),
(11, 'Daniel  junior silva', '23234572321', '2024-11-27', 212.50, '123456789', '001'),
(12, 'Daniel silva', '342523521452', '2024-11-27', 421.00, '414131231231232', '06263170'),
(13, 'Filipe De Oliveira Santos', '45682347530', '2024-11-28', 583.00, '1232411015678', '999'),
(14, 'Filipe Oliveira Santos', '34576523420', '2024-11-28', 587.00, '1232422025678', '999'),
(15, 'Jose Oliveira Santos', '44036856920', '2024-11-28', 592.00, '1232411015678', '999'),
(16, 'Daniel  junior silva', '23234572321', '2025-01-31', 332.00, '454544545', '001'),
(17, 'Ana Julia Silva', '434985248630', '2025-03-20', 1134.00, '212121212', '001'),
(18, 'Ana Julia Silva', '434985248630', '2025-04-01', 1027.50, '111', '111');

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `email` varchar(110) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `cpf` varchar(45) NOT NULL,
  `sexo` varchar(15) NOT NULL,
  `data_nascimento` date NOT NULL,
  `endereco` varchar(120) NOT NULL,
  `especie` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `email`, `telefone`, `cpf`, `sexo`, `data_nascimento`, `endereco`, `especie`) VALUES
(8, 'Ana Julia Silva', 'ana@gmail.com', '11847584332', '434985248630', 'feminino', '2000-03-14', 'Rua Nove de julho 223', ''),
(9, 'Daniel  junior silva', 'daniel@gmail.com', '11968523445', '23234572321', 'masculino', '2001-06-06', 'Rua Doutor Joao Nogueira 122 ', ''),
(21, 'Dracula', 'Drakinho@gmail.com', '11111 dois', '10000000000', 'masculino', '0800-01-01', 'rua vampira safadenha', 'Vampirao');

-- --------------------------------------------------------

--
-- Estrutura para tabela `frigobar`
--

CREATE TABLE `frigobar` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `nome_cliente` varchar(100) NOT NULL,
  `cpf_cliente` varchar(14) NOT NULL,
  `item` varchar(50) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `data_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `valor` decimal(10,2) NOT NULL,
  `valor_total` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `frigobar`
--

INSERT INTO `frigobar` (`id`, `id_cliente`, `nome_cliente`, `cpf_cliente`, `item`, `quantidade`, `data_registro`, `valor`, `valor_total`) VALUES
(16, 8, 'Ana Julia Silva', '434985248630', 'agua', 2, '2024-11-19 19:27:49', 5.00, 0.00),
(17, 8, 'Ana Julia Silva', '434985248630', 'cerveja', 1, '2024-11-19 19:27:49', 5.00, 0.00),
(18, 8, 'Ana Julia Silva', '434985248630', 'refrigerante', 1, '2024-11-19 19:27:49', 3.00, 0.00),
(19, 8, 'Ana Julia Silva', '434985248630', 'suco', 2, '2024-11-19 19:27:49', 8.00, 0.00),
(21, 9, 'Daniel  junior silva', '23234572321', 'agua', 1, '2024-11-25 15:08:48', 2.50, 0.00),
(22, 9, 'Daniel  junior silva', '23234572321', 'cerveja', 2, '2024-11-25 15:08:48', 10.00, 0.00),
(39, 9, 'Daniel  junior silva', '23234572321', 'agua', 2, '2025-01-31 23:55:17', 5.00, 0.00),
(40, 9, 'Daniel  junior silva', '23234572321', 'cerveja', 1, '2025-01-31 23:55:17', 5.00, 0.00),
(41, 9, 'Daniel  junior silva', '23234572321', 'refrigerante', 2, '2025-01-31 23:55:17', 6.00, 0.00),
(42, 9, 'Daniel  junior silva', '23234572321', 'suco', 4, '2025-01-31 23:55:17', 16.00, 0.00),
(43, 8, 'Ana Julia Silva', '434985248630', 'refrigerante', 4, '2025-03-18 02:13:21', 12.00, 0.00),
(44, 8, 'Ana Julia Silva', '434985248630', 'agua', 3, '2025-04-24 17:57:24', 7.50, 7.50),
(45, 8, 'Ana Julia Silva', '434985248630', 'cerveja', 4, '2025-04-24 17:57:24', 20.00, 27.50),
(46, 21, 'Dracula', '10000000000', 'agua', 3, '2025-04-26 01:36:09', 7.50, 7.50),
(47, 21, 'Dracula', '10000000000', 'cerveja', 3, '2025-04-26 01:36:09', 15.00, 22.50);

-- --------------------------------------------------------

--
-- Estrutura para tabela `funcionarios`
--

CREATE TABLE `funcionarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `email` varchar(110) NOT NULL,
  `senha` varchar(45) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `sexo` varchar(15) NOT NULL,
  `data_nascimento` date NOT NULL,
  `cidade` varchar(45) NOT NULL,
  `estado` varchar(45) NOT NULL,
  `endereco` varchar(45) NOT NULL,
  `especie` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `funcionarios`
--

INSERT INTO `funcionarios` (`id`, `nome`, `email`, `senha`, `telefone`, `sexo`, `data_nascimento`, `cidade`, `estado`, `endereco`, `especie`) VALUES
(26, 'Diego ', 'Diego161.@gmail.com', 'a13287d6df45043628f9da095de0328a', '11969238305', 'masculino', '1998-09-22', 'carapicuíba', 'sao paulo ', 'Rua das Palmeiras 123', ''),
(27, 'Maria Silva de Souza', 'maria324@gmail.com', 'ac2ae2417edef79800c8933e23c1a380', '11857634115', 'feminino', '2003-04-23', 'Sao paulo', 'SP', 'Rua doutor Ferraz da Motoca ', ''),
(33, 'esqueleto souza mendes', 'esqueleto@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '1195869521', 'outros', '1900-03-22', 'Osasco', 'SP', 'Rua Douto', 'esqueleto');

-- --------------------------------------------------------

--
-- Estrutura para tabela `quartos`
--

CREATE TABLE `quartos` (
  `idquartos` int(11) NOT NULL,
  `quarto` varchar(50) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `data_entrada` date DEFAULT NULL,
  `data_saida` date DEFAULT NULL,
  `total_preco` decimal(10,2) DEFAULT NULL,
  `especie` varchar(100) NOT NULL,
  `cpf` varchar(45) NOT NULL,
  `personalizacoes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `quartos`
--

INSERT INTO `quartos` (`idquartos`, `quarto`, `nome`, `email`, `data_entrada`, `data_saida`, `total_preco`, `especie`, `cpf`, `personalizacoes`) VALUES
(1, '', '', '0', NULL, NULL, NULL, '', '', NULL),
(2, '', '', '0', NULL, NULL, NULL, '', '', NULL),
(3, '', '', '0', NULL, NULL, NULL, '', '', NULL),
(4, '', '', '0', NULL, NULL, NULL, '', '', NULL),
(5, '', '', '0', NULL, NULL, NULL, '', '', NULL),
(6, '', '', '0', NULL, NULL, NULL, '', '', NULL),
(7, '', '', '0', NULL, NULL, NULL, '', '', NULL),
(8, '', '', '0', NULL, NULL, NULL, '', '', NULL),
(17, 'luxo_1_cama', 'Filipr Oliveira Santos', 'fo4509630@gmail.com', '2024-11-25', '2024-11-28', 540.00, '', '', NULL),
(18, 'luxo_1_cama', 'Jose Oliveira Santos', 'jose@gmail.com', '2024-11-25', '2024-11-28', 540.00, '', '', NULL),
(20, 'luxo_3_camas', 'frank', 'franks@gmial.com', '2025-03-20', '2025-03-23', 750.00, '', '', NULL),
(21, 'luxo_3_camas', 'Dracula', 'Drakinho@gmail.com', '2025-04-25', '2025-04-30', 1250.00, 'Vampirao', '', NULL),
(22, 'luxo_2_camas', 'Dracula', '', '2025-04-09', '2025-04-30', 4200.00, 'Vampirao', '10000000000', NULL),
(23, '', '', '', '0000-00-00', '0000-00-00', 0.00, '', '', NULL),
(24, '', '', '', '0000-00-00', '0000-00-00', 0.00, '', '', NULL),
(25, '', '', '', '0000-00-00', '0000-00-00', 0.00, '', '', NULL),
(26, '', '', '', '0000-00-00', '0000-00-00', 0.00, '', '', NULL),
(27, 'basico_1_cama', 'Ana Julia Silva', '', '2025-05-06', '2025-05-22', 1600.00, 'Vampirao', '434985248630', '[\"janelas blindadas\",\"caixao grande ggg\"]'),
(28, 'basico_1_cama', 'Daniel  junior silva', '', '2025-05-07', '2025-05-10', 300.00, 'esqueleto', '23234572321', '[\"garrafas de sangues frescos\"]');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `boletos`
--
ALTER TABLE `boletos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `frigobar`
--
ALTER TABLE `frigobar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Índices de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `quartos`
--
ALTER TABLE `quartos`
  ADD PRIMARY KEY (`idquartos`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `boletos`
--
ALTER TABLE `boletos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `frigobar`
--
ALTER TABLE `frigobar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de tabela `quartos`
--
ALTER TABLE `quartos`
  MODIFY `idquartos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `frigobar`
--
ALTER TABLE `frigobar`
  ADD CONSTRAINT `frigobar_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
