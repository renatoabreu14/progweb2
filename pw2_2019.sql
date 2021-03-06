-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 02, 2019 at 10:06 PM
-- Server version: 10.1.40-MariaDB-0ubuntu0.18.04.1
-- PHP Version: 7.2.19-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pw2_2019`
--

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `endereco` text NOT NULL,
  `email` varchar(250) NOT NULL,
  `senha` varchar(250) NOT NULL,
  `telefone` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cliente`
--

INSERT INTO `cliente` (`id`, `nome`, `cpf`, `endereco`, `email`, `senha`, `telefone`) VALUES
(1, 'Renato Oliveira Abreu', '12345678910', 'Rua Fulano de tal, 35 St. Res. Cohacol 5 Jatai-GO', 'renato.abreu.info@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '64992481630'),
(2, 'Elizeu', '12345678910', 'sdlfdlhçkjgadksf', 'elizeu_os@hotmail.com', 'e10adc3949ba59abbe56e057f20f883e', '6412347896');

-- --------------------------------------------------------

--
-- Table structure for table `editora`
--

CREATE TABLE `editora` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `editora`
--

INSERT INTO `editora` (`id`, `nome`) VALUES
(1, 'Editora Campus'),
(2, 'Abril');

-- --------------------------------------------------------

--
-- Table structure for table `genero`
--

CREATE TABLE `genero` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `genero`
--

INSERT INTO `genero` (`id`, `nome`) VALUES
(1, 'Terror'),
(2, 'Romance'),
(3, 'Ficção');

-- --------------------------------------------------------

--
-- Table structure for table `itemvenda`
--

CREATE TABLE `itemvenda` (
  `id` int(11) NOT NULL,
  `fk_idvenda` int(11) NOT NULL,
  `fk_idlivro` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `valorlivro` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `itemvenda`
--

INSERT INTO `itemvenda` (`id`, `fk_idvenda`, `fk_idlivro`, `quantidade`, `valorlivro`) VALUES
(1, 10, 1, 2, 100),
(2, 11, 1, 2, 100),
(3, 12, 1, 2, 100),
(4, 13, 1, 2, 100),
(5, 14, 1, 2, 100);

-- --------------------------------------------------------

--
-- Table structure for table `livro`
--

CREATE TABLE `livro` (
  `id` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `descricao` text NOT NULL,
  `autor` varchar(50) NOT NULL,
  `idgenero` int(11) NOT NULL,
  `ideditora` int(11) NOT NULL,
  `valor` double NOT NULL,
  `ano` int(11) NOT NULL,
  `capa` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `livro`
--

INSERT INTO `livro` (`id`, `titulo`, `descricao`, `autor`, `idgenero`, `ideditora`, `valor`, `ano`, `capa`) VALUES
(1, 'Senhor dos Anéis', 'sdfadgdfagdafgfa', 'Fulano', 2, 1, 100, 1987, '07ff3c9d607cd5060badc70c938e9dd4.jpg'),
(17, 'Game of Thrones', 'sfsdfsdfs', 'George R. R. Martin', 3, 2, 100, 2001, 'c339e0fe27fe7a68d739bd5dcc22d7f1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `situacao`
--

CREATE TABLE `situacao` (
  `id` int(11) NOT NULL,
  `descricao` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `situacao`
--

INSERT INTO `situacao` (`id`, `descricao`) VALUES
(1, 'Aguardando confirmação de pagamento');

-- --------------------------------------------------------

--
-- Table structure for table `venda`
--

CREATE TABLE `venda` (
  `id` int(11) NOT NULL,
  `fk_idcliente` int(11) NOT NULL,
  `datavenda` date NOT NULL,
  `fk_idsituacao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `venda`
--

INSERT INTO `venda` (`id`, `fk_idcliente`, `datavenda`, `fk_idsituacao`) VALUES
(10, 1, '2019-07-02', 1),
(11, 1, '2019-07-02', 1),
(12, 1, '2019-07-02', 1),
(13, 1, '2019-07-02', 1),
(14, 1, '2019-07-02', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `editora`
--
ALTER TABLE `editora`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `genero`
--
ALTER TABLE `genero`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `itemvenda`
--
ALTER TABLE `itemvenda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_idvenda` (`fk_idvenda`),
  ADD KEY `fk_idproduto` (`fk_idlivro`);

--
-- Indexes for table `livro`
--
ALTER TABLE `livro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idgenero` (`idgenero`),
  ADD KEY `ideditora` (`ideditora`);

--
-- Indexes for table `situacao`
--
ALTER TABLE `situacao`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `venda`
--
ALTER TABLE `venda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_idcliente` (`fk_idcliente`),
  ADD KEY `fk_idsituacao` (`fk_idsituacao`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `editora`
--
ALTER TABLE `editora`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `genero`
--
ALTER TABLE `genero`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `itemvenda`
--
ALTER TABLE `itemvenda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `livro`
--
ALTER TABLE `livro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `situacao`
--
ALTER TABLE `situacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `venda`
--
ALTER TABLE `venda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `itemvenda`
--
ALTER TABLE `itemvenda`
  ADD CONSTRAINT `fk_itemvenda_livro` FOREIGN KEY (`fk_idlivro`) REFERENCES `livro` (`id`),
  ADD CONSTRAINT `fk_itemvenda_venda` FOREIGN KEY (`fk_idvenda`) REFERENCES `venda` (`id`);

--
-- Constraints for table `livro`
--
ALTER TABLE `livro`
  ADD CONSTRAINT `fk_livro_editora` FOREIGN KEY (`ideditora`) REFERENCES `editora` (`id`),
  ADD CONSTRAINT `fk_livro_genero` FOREIGN KEY (`idgenero`) REFERENCES `genero` (`id`);

--
-- Constraints for table `venda`
--
ALTER TABLE `venda`
  ADD CONSTRAINT `fk_venda_cliente` FOREIGN KEY (`fk_idcliente`) REFERENCES `cliente` (`id`),
  ADD CONSTRAINT `fk_venda_situacao` FOREIGN KEY (`fk_idsituacao`) REFERENCES `situacao` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
