-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24-Nov-2020 às 19:23
-- Versão do servidor: 10.4.16-MariaDB
-- versão do PHP: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `livrimdb`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `item_aluguel`
--

CREATE TABLE `item_aluguel` (
  `fk_livros` int(10) UNSIGNED NOT NULL,
  `fk_pedido` int(10) UNSIGNED NOT NULL,
  `qtde` int(10) UNSIGNED NOT NULL,
  `qtde_retorno` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `item_aluguel`
--

INSERT INTO `item_aluguel` (`fk_livros`, `fk_pedido`, `qtde`, `qtde_retorno`) VALUES
(1, 1, 2, 2),
(0, 1, 1, 1),
(1, 2, 1, 0),
(3, 3, 2, 2),
(2, 3, 1, 1),
(2, 4, 10, 10),
(2, 4, 1, 1),
(1, 4, 13, 13);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_clientes`
--

CREATE TABLE `tbl_clientes` (
  `id_clientes` int(10) UNSIGNED NOT NULL,
  `fk_endereco` int(10) UNSIGNED NOT NULL,
  `nome` varchar(100) NOT NULL,
  `telefone` varchar(14) NOT NULL,
  `email` varchar(80) DEFAULT NULL,
  `cpf` varchar(14) NOT NULL,
  `numero_casa` int(10) UNSIGNED DEFAULT NULL,
  `dados_adicionais_endereco` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbl_clientes`
--

INSERT INTO `tbl_clientes` (`id_clientes`, `fk_endereco`, `nome`, `telefone`, `email`, `cpf`, `numero_casa`, `dados_adicionais_endereco`) VALUES
(1, 1, 'Rafael Souza', '(11)23132-4321', 'man@gmail.com', '458.789.754-35', 210, 'Nenhum'),
(2, 2, 'Joao Silva', '(12)31231-2312', 'email@gmail.com', '123.456.789-10', 12, 'Nenhum');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_endereco`
--

CREATE TABLE `tbl_endereco` (
  `id_endereco` int(10) UNSIGNED NOT NULL,
  `nome_rua` varchar(80) NOT NULL,
  `cep` int(10) UNSIGNED NOT NULL,
  `bairro` varchar(30) DEFAULT NULL,
  `cidade` varchar(30) NOT NULL,
  `uf` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbl_endereco`
--

INSERT INTO `tbl_endereco` (`id_endereco`, `nome_rua`, `cep`, `bairro`, `cidade`, `uf`) VALUES
(1, 'Rua Nova', 12313212, 'Boa Vista', 'São Paulo', 'SP'),
(2, 'Rua das Flores', 12345678, 'Boa Vista', 'SP', 'SP');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_funcionarios`
--

CREATE TABLE `tbl_funcionarios` (
  `id_funcionarios` int(10) UNSIGNED NOT NULL,
  `nome` varchar(80) NOT NULL,
  `login` varchar(25) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `nivel_acesso` enum('1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbl_funcionarios`
--

INSERT INTO `tbl_funcionarios` (`id_funcionarios`, `nome`, `login`, `senha`, `nivel_acesso`) VALUES
(4, 'Rodrigo Souza', 'rodrigo', '$2y$10$i1cHMjd9AuFJLnZ7RVrwH.amFiGPc4mFKoG7w3gl0vMNjDx7iyuhi', '2'),
(5, 'Maria Silva', 'maria', '$2y$10$1lVBbafuZINWI7B4Y0OUauqOhmb8aTgyQomTWj1bUfThDdGs360E2', '1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_livros`
--

CREATE TABLE `tbl_livros` (
  `id_livros` int(10) UNSIGNED NOT NULL,
  `qtde_estoque` int(10) UNSIGNED DEFAULT 0,
  `nome` varchar(80) NOT NULL,
  `categoria` varchar(50) DEFAULT NULL,
  `localizacao` varchar(50) DEFAULT NULL,
  `valor` decimal(6,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbl_livros`
--

INSERT INTO `tbl_livros` (`id_livros`, `qtde_estoque`, `nome`, `categoria`, `localizacao`, `valor`) VALUES
(0, 19, 'A Fantástica Volta ao Mundo', 'Turismo', 'Carredor 1, Estante A', '4.50'),
(1, 14, 'Dom Casmurro', 'Literatura', 'Corredor 7', '5.00'),
(2, 12, 'Como emagrecer', 'Esporte', 'Corredor 7', '7.00'),
(3, 4, 'Mamonas', 'Literatura', 'Corredor A', '7.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_pedido`
--

CREATE TABLE `tbl_pedido` (
  `id_pedido` int(10) UNSIGNED NOT NULL,
  `fk_funcionario` int(10) UNSIGNED NOT NULL,
  `fk_cliente` int(10) UNSIGNED NOT NULL,
  `valor_total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `data_vencimento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbl_pedido`
--

INSERT INTO `tbl_pedido` (`id_pedido`, `fk_funcionario`, `fk_cliente`, `valor_total`, `data_vencimento`) VALUES
(1, 5, 1, '14.50', '2020-12-23'),
(2, 5, 1, '5.00', '2020-12-23'),
(3, 4, 2, '21.00', '2020-12-24'),
(4, 4, 2, '142.00', '2020-12-25');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `item_aluguel`
--
ALTER TABLE `item_aluguel`
  ADD KEY `item_aluguel_FKIndex1` (`fk_pedido`),
  ADD KEY `item_aluguel_FKIndex2` (`fk_livros`);

--
-- Índices para tabela `tbl_clientes`
--
ALTER TABLE `tbl_clientes`
  ADD PRIMARY KEY (`id_clientes`),
  ADD KEY `tbl_clientes_FKIndex1` (`fk_endereco`);

--
-- Índices para tabela `tbl_endereco`
--
ALTER TABLE `tbl_endereco`
  ADD PRIMARY KEY (`id_endereco`);

--
-- Índices para tabela `tbl_funcionarios`
--
ALTER TABLE `tbl_funcionarios`
  ADD PRIMARY KEY (`id_funcionarios`);

--
-- Índices para tabela `tbl_livros`
--
ALTER TABLE `tbl_livros`
  ADD PRIMARY KEY (`id_livros`);

--
-- Índices para tabela `tbl_pedido`
--
ALTER TABLE `tbl_pedido`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `tbl_pedido_FKIndex1` (`fk_cliente`),
  ADD KEY `tbl_pedido_FKIndex2` (`fk_funcionario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tbl_clientes`
--
ALTER TABLE `tbl_clientes`
  MODIFY `id_clientes` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tbl_endereco`
--
ALTER TABLE `tbl_endereco`
  MODIFY `id_endereco` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tbl_funcionarios`
--
ALTER TABLE `tbl_funcionarios`
  MODIFY `id_funcionarios` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `tbl_livros`
--
ALTER TABLE `tbl_livros`
  MODIFY `id_livros` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tbl_pedido`
--
ALTER TABLE `tbl_pedido`
  MODIFY `id_pedido` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `item_aluguel`
--
ALTER TABLE `item_aluguel`
  ADD CONSTRAINT `item_aluguel_ibfk_1` FOREIGN KEY (`fk_pedido`) REFERENCES `tbl_pedido` (`id_pedido`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `item_aluguel_ibfk_2` FOREIGN KEY (`fk_livros`) REFERENCES `tbl_livros` (`id_livros`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tbl_clientes`
--
ALTER TABLE `tbl_clientes`
  ADD CONSTRAINT `tbl_clientes_ibfk_1` FOREIGN KEY (`fk_endereco`) REFERENCES `tbl_endereco` (`id_endereco`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tbl_pedido`
--
ALTER TABLE `tbl_pedido`
  ADD CONSTRAINT `tbl_pedido_ibfk_1` FOREIGN KEY (`fk_cliente`) REFERENCES `tbl_clientes` (`id_clientes`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbl_pedido_ibfk_2` FOREIGN KEY (`fk_funcionario`) REFERENCES `tbl_funcionarios` (`id_funcionarios`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
