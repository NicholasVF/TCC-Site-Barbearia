-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28/11/2024 às 13:08
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
-- Banco de dados: `barbearia`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `agenda`
--

CREATE TABLE `agenda` (
  `id_agenda` int(11) NOT NULL,
  `id_funcionario` int(11) NOT NULL,
  `id_login` int(11) NOT NULL,
  `id_servico` int(11) NOT NULL,
  `data_hora_agendamento` datetime NOT NULL,
  `status` varchar(50) DEFAULT 'pendente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `agenda`
--

INSERT INTO `agenda` (`id_agenda`, `id_funcionario`, `id_login`, `id_servico`, `data_hora_agendamento`, `status`) VALUES
(1, 1, 1, 1, '2024-11-22 14:30:00', 'não pendente'),
(2, 5, 4, 3, '2024-11-22 13:00:00', 'não pendente'),
(5, 1, 8, 12, '2024-11-29 16:00:00', 'pendente'),
(6, 1, 14, 1, '2024-11-29 17:00:00', 'pendente'),
(9, 4, 15, 3, '2024-11-30 19:00:00', 'pendente');

-- --------------------------------------------------------

--
-- Estrutura para tabela `funcionarios`
--

CREATE TABLE `funcionarios` (
  `id_funcionario` int(11) NOT NULL,
  `id_servico` int(11) DEFAULT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `funcionarios`
--

INSERT INTO `funcionarios` (`id_funcionario`, `id_servico`, `nome`, `email`) VALUES
(1, 4, 'João Silva', 'joao.silva@email.com'),
(2, 3, 'Leonardo', 'leleco@gmail.com'),
(4, 3, 'Nicholas Vendrame', 'nicholas.vfabre@gmail.com'),
(5, 1, 'higor tralha', 'teste@gmail.com');

-- --------------------------------------------------------

--
-- Estrutura para tabela `horarios`
--

CREATE TABLE `horarios` (
  `id_horario` int(11) NOT NULL,
  `id_funcionario` int(11) DEFAULT NULL,
  `data` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fim` time NOT NULL,
  `status` enum('disponível','indisponível') NOT NULL DEFAULT 'disponível'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `horarios`
--

INSERT INTO `horarios` (`id_horario`, `id_funcionario`, `data`, `hora_inicio`, `hora_fim`, `status`) VALUES
(1, 1, '2024-10-01', '00:00:00', '00:00:00', 'indisponível'),
(2, 5, '2024-10-12', '08:00:00', '21:00:00', 'disponível'),
(4, 2, '0000-00-00', '08:00:00', '23:45:00', 'disponível'),
(5, 4, '0000-00-00', '08:00:00', '21:00:00', 'disponível');

-- --------------------------------------------------------

--
-- Estrutura para tabela `login`
--

CREATE TABLE `login` (
  `id_login` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `tipo_usuario` enum('usuario','admin') DEFAULT 'usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `login`
--

INSERT INTO `login` (`id_login`, `nome`, `email`, `senha`, `tipo_usuario`) VALUES
(1, 'Nicholas', 'nicholas@gmail.com', '$2y$10$VzeqvydCla69op723JSu1eb2nASbN/DbJkmQRLvQKG96/349I.FUi', 'usuario'),
(2, 'admin', 'admin@gmail.com', '$2y$10$dIFkYTqskorbDqqHz4kT1ePuA2ExKsfjcUkTn9zH1pGFWt7mWjLGy', 'admin'),
(3, 'Teste', 'teste@gmail.com', '$2y$10$sRMWw3KgXQdr13JCycIS6.WBFpBBkd.ghiz.6CROXhHL4O/oA10Zi', 'usuario'),
(4, 'lucas', 'lucas@gmail.com', '$2y$10$jn70sAJy97i5Jh0vBtCDyuvtkOK1VqHQfMV87jcHQ05sJ5AlcxOeK', 'usuario'),
(5, 'Joao Silva', 'joao@l.com', '$2y$10$CaUyQttHILP.Iz5cGWLv4eDx/PnAM226hwUlyYp1bVU7exoR2RNvG', 'usuario'),
(6, 'maria', 'maria@example.com', '$2y$10$TvxoBg.ThLxlCiMfJLJVrOEXV04f.BvQwZVErP9NgWT3EXWg5SLN2', 'usuario'),
(7, 'Weslley', 'weslley@gmail.com', '$2y$10$TV1qULB1K0KPL9AxJDme7.liKWaXnBfoKgknVtCrOPYhemODzpy8q', 'usuario'),
(8, 'magaiver', 'magaiver@gmail.com', '$2y$10$ObMdqZpbS/a7OK.S2X6tq.Zs/eJb9jfRa1myPftawstpSCeUS4ANe', 'usuario'),
(9, 'davi', 'davi@gmail.com', '$2y$10$JxoVToU95JT9lPuN2.ugQOg8IKDQX.5/QbYCCZN/wR5YXpUHAj4DC', 'usuario'),
(10, 'carlos', 'carlos@gmail.com', '$2y$10$BE1b4g8UR4bClAkxjU5mh.s6eOpmzpEb1wISy.WjfHLPNSECfAy02', 'usuario'),
(11, 'Antonio', 'antonio@gmail.com', '$2y$10$GXtSMBGBQ.BpXMcjMJMxtu61F76V6SJjnRxRKOY2nZukVn428U/pu', 'usuario'),
(12, 'evandro', 'evandro@gmail.com', '$2y$10$PihfGZ9pGXoqeGCnLBupAOr8b.c.BNSc/oklcPta3LevnG3vSwkeq', 'usuario'),
(13, 'kaua', 'kaua@gmail.com', '$2y$10$tlfAXnf/tl3TeE8QK1JsZOHYmO3tWx0pB6/J05GO9kTS4eGlp8Ls.', 'usuario'),
(14, 'Guga', 'guga@gmail.com', '$2y$10$LyAdotTuvFfjpvUwcNrwyu5Rn42hJvtnERY9g/NShE3n3zUiRX25K', 'usuario'),
(15, 'Lucas Castelan', 'lucasc@gmail.com', '$2y$10$Wn04aZaLzAexN.hBSll7WOtDjdO3KE0DvemSoVFF4CByPlKkVaWSm', 'usuario');

-- --------------------------------------------------------

--
-- Estrutura para tabela `servicos`
--

CREATE TABLE `servicos` (
  `id_servico` int(11) NOT NULL,
  `servico` varchar(90) DEFAULT NULL,
  `preco` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `servicos`
--

INSERT INTO `servicos` (`id_servico`, `servico`, `preco`) VALUES
(1, 'Corte de Cabelo', '25,00'),
(3, 'Barba', '20,00'),
(4, 'barba e cabelo', '37,00'),
(12, 'navalhado', '30,00'),
(13, 'massagem facial', '40,00'),
(14, 'pintar cabelo', '130,00');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id_agenda`),
  ADD KEY `fk_funcionario` (`id_funcionario`),
  ADD KEY `fk_login` (`id_login`),
  ADD KEY `fk_servico` (`id_servico`);

--
-- Índices de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`id_funcionario`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_servico` (`id_servico`);

--
-- Índices de tabela `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`id_horario`),
  ADD KEY `id_funcionario` (`id_funcionario`);

--
-- Índices de tabela `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_login`);

--
-- Índices de tabela `servicos`
--
ALTER TABLE `servicos`
  ADD PRIMARY KEY (`id_servico`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id_agenda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `id_funcionario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `horarios`
--
ALTER TABLE `horarios`
  MODIFY `id_horario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `login`
--
ALTER TABLE `login`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `servicos`
--
ALTER TABLE `servicos`
  MODIFY `id_servico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `agenda`
--
ALTER TABLE `agenda`
  ADD CONSTRAINT `fk_funcionario` FOREIGN KEY (`id_funcionario`) REFERENCES `funcionarios` (`id_funcionario`),
  ADD CONSTRAINT `fk_login` FOREIGN KEY (`id_login`) REFERENCES `login` (`id_login`),
  ADD CONSTRAINT `fk_servico` FOREIGN KEY (`id_servico`) REFERENCES `servicos` (`id_servico`);

--
-- Restrições para tabelas `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD CONSTRAINT `funcionarios_ibfk_1` FOREIGN KEY (`id_servico`) REFERENCES `servicos` (`id_servico`);

--
-- Restrições para tabelas `horarios`
--
ALTER TABLE `horarios`
  ADD CONSTRAINT `horarios_ibfk_1` FOREIGN KEY (`id_funcionario`) REFERENCES `funcionarios` (`id_funcionario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
