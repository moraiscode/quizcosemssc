-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 14/11/2023 às 22:04
-- Versão do servidor: 10.4.27-MariaDB
-- Versão do PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `cosemssc2023`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `jogador`
--

CREATE TABLE `jogador` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `whatsapp` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `estado` varchar(2) NOT NULL,
  `profissao` varchar(255) NOT NULL,
  `vitorioso` tinyint(1) NOT NULL DEFAULT 0,
  `codigoretirada` int(5) UNSIGNED ZEROFILL DEFAULT NULL,
  `entregue` tinyint(1) DEFAULT NULL,
  `datetime` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `jogador`
--

INSERT INTO `jogador` (`id`, `nome`, `whatsapp`, `email`, `estado`, `profissao`, `vitorioso`, `codigoretirada`, `entregue`, `datetime`) VALUES
(10, 'Felipe Amorim', '98176341786', 'contato.felipeamorim@gmail.com', 'DF', 'Nutricionista', 1, 982787, 1, '2023-11-14 12:25:01'),
(11, 'Paulo da Silva', '32141414141', 'contato.felipeamorim@gmail.com', 'DF', 'Professor', 1, 329538, 1, '2023-11-14 15:40:53'),
(12, 'Ricardo Matos', '97310297309', 'ricardo@gmail.com', 'SC', 'Professor', 1, 329532, NULL, '2023-11-14 13:53:12'),
(14, 'Cláudio Nicolas Severino Pires', '32131313131', 'claudio@gmail.com', 'SP', 'Nutricionista', 1, 312532, NULL, '2023-11-14 14:25:57'),
(15, 'Julio Roberto Raimundo Baptista', '41231243123', 'julio@gmail.com', 'AC', 'Nutricionista', 0, NULL, NULL, '2023-11-14 14:26:22'),
(16, 'Larissa Aparecida Isabel de Paula', '32112412341', 'larissa@gmail.com', 'AC', 'Nutricionista', 0, NULL, NULL, '2023-11-14 14:27:13'),
(17, 'Fulano de Tal', '72919293222', 'fulano@gmail.com', 'PE', 'Professor', 1, 312532, 1, '2023-11-14 19:26:48');

-- --------------------------------------------------------

--
-- Estrutura para tabela `log_acesso`
--

CREATE TABLE `log_acesso` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `data_login` datetime DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `dispositivo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `log_acesso`
--

INSERT INTO `log_acesso` (`id`, `usuario_id`, `data_login`, `ip`, `dispositivo`) VALUES
(1, 1, '2023-11-13 01:06:37', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:120.0) Gecko/20100101 Firefox/120.0'),
(2, 2, '2023-11-13 01:55:45', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:120.0) Gecko/20100101 Firefox/120.0'),
(3, 2, '2023-11-13 01:58:26', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:120.0) Gecko/20100101 Firefox/120.0'),
(4, 2, '2023-11-13 02:01:25', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:120.0) Gecko/20100101 Firefox/120.0'),
(5, 2, '2023-11-13 02:10:24', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:120.0) Gecko/20100101 Firefox/120.0'),
(6, 2, '2023-11-13 02:17:20', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:120.0) Gecko/20100101 Firefox/120.0'),
(7, 2, '2023-11-13 02:23:20', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Edg/119.0.0.0'),
(8, 2, '2023-11-13 02:38:32', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Edg/119.0.0.0'),
(9, 2, '2023-11-13 02:39:09', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Edg/119.0.0.0'),
(10, 2, '2023-11-13 02:47:16', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Edg/119.0.0.0'),
(11, 2, '2023-11-13 06:29:14', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Edg/119.0.0.0'),
(12, 2, '2023-11-13 17:14:43', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Edg/119.0.0.0'),
(13, 2, '2023-11-14 13:19:34', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Edg/119.0.0.0'),
(14, 2, '2023-11-14 14:34:45', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Edg/119.0.0.0'),
(15, 2, '2023-11-14 14:35:08', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Edg/119.0.0.0'),
(16, 2, '2023-11-14 15:11:50', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Edg/119.0.0.0'),
(17, 2, '2023-11-14 15:11:55', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Edg/119.0.0.0'),
(18, 2, '2023-11-14 15:12:18', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Edg/119.0.0.0'),
(19, 2, '2023-11-14 15:12:37', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Edg/119.0.0.0'),
(20, 2, '2023-11-14 15:12:48', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Edg/119.0.0.0'),
(21, 2, '2023-11-14 15:12:59', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Edg/119.0.0.0'),
(22, 2, '2023-11-14 15:18:02', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Edg/119.0.0.0'),
(23, 2, '2023-11-14 15:20:28', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Edg/119.0.0.0'),
(24, 2, '2023-11-14 20:00:03', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36 Edg/120.0.0.0'),
(25, 2, '2023-11-14 20:29:59', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36 Edg/120.0.0.0');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `senha`, `admin`) VALUES
(1, 'felipe', '@Admin2023', 1),
(2, 'cfn', '@cfnSC2023', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `jogador`
--
ALTER TABLE `jogador`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `whatsapp` (`whatsapp`);

--
-- Índices de tabela `log_acesso`
--
ALTER TABLE `log_acesso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `jogador`
--
ALTER TABLE `jogador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `log_acesso`
--
ALTER TABLE `log_acesso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `log_acesso`
--
ALTER TABLE `log_acesso`
  ADD CONSTRAINT `log_acesso_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
