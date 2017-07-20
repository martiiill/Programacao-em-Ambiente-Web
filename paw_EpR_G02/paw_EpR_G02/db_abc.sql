-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 13-Jul-2017 às 14:52
-- Versão do servidor: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_abc`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `administrador`
--

CREATE TABLE `administrador` (
  `username` varchar(100) NOT NULL,
  `password` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `administrador`
--

INSERT INTO `administrador` (`username`, `password`) VALUES
('ana', 'ana');

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nome` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`id`, `nome`) VALUES
(1, 'Livre'),
(2, 'Informatica'),
(3, 'Gestao'),
(4, 'Culin&aacute;ria'),
(5, 'Sa&uacute;de');

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentario`
--

CREATE TABLE `comentario` (
  `titulo` varchar(100) NOT NULL,
  `texto` text NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `comentario`
--

INSERT INTO `comentario` (`titulo`, `texto`, `username`) VALUES
('Doc do Joao', 'Um comentario da rute.', 'rute'),
('Doc do Joao', 'COment do jota', 'joao'),
('titulo', 'comt da rute', 'rute');

-- --------------------------------------------------------

--
-- Estrutura da tabela `documento`
--

CREATE TABLE `documento` (
  `titulo` text NOT NULL,
  `autor` text NOT NULL,
  `resumo` text NOT NULL,
  `categoria` text NOT NULL,
  `dataCriacao` date NOT NULL,
  `conteudo` text NOT NULL,
  `palavrasChave` text NOT NULL,
  `url` text NOT NULL,
  `tamanho` float NOT NULL,
  `partilha` varchar(200) NOT NULL,
  `comentario` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `documento`
--

INSERT INTO `documento` (`titulo`, `autor`, `resumo`, `categoria`, `dataCriacao`, `conteudo`, `palavrasChave`, `url`, `tamanho`, `partilha`, `comentario`) VALUES
('Doc do Joao', 'joao', 'Um resumos', 'Livre', '2017-07-10', 'conteudo', 'palavras', 'www.sapo.pt', 8, 'publico', 1),
('Doc Partilhado', 'joao', 'resumo', 'Culin&aacute;ria', '2017-06-20', 'conteudo', 'palavra', 'www.sapo.pt', 8, 'rute,rui1', 0),
('Doc partilhado com o joao', 'rute', 'resumo', 'Sa&uacute;de', '2017-07-11', 'conteudo', 'palavra', 'www.sapo.pt', 8, 'joao', 1),
('Doc partilhado com a rute', 'rui1', 'resumo', 'Sa&uacute;de', '2017-07-10', 'conteudo', 'palavra', 'www.sapo.pt', 8, 'rute', 1),
('Doc Importado', 'joao', 'Um doc', 'Culinária', '2017-07-11', 'Conteudo alterado', 'palavra', 'Validacoesficheiro2.docx', 11781, ',rui1,rute', 1),
('titulo', 'pedr', 'resumo', 'Saúde', '2017-01-04', 'Conteudo alterado', 'palavra,chave', 'Validacoesficheiro2.docx', 11781, ',rui1,rute', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `edicao`
--

CREATE TABLE `edicao` (
  `porque` varchar(100) NOT NULL,
  `doc` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `edicao`
--

INSERT INTO `edicao` (`porque`, `doc`) VALUES
('Porque o documento e meu.', 'Doc Partilhado'),
('porque sim', 'Doc Importado'),
('Porque quero.', 'Doc Importado'),
('Porque quero.', 'Doc Importado'),
('porque sim', 'titulo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `observacao`
--

CREATE TABLE `observacao` (
  `titulo` varchar(50) NOT NULL,
  `observacao` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `observacao`
--

INSERT INTO `observacao` (`titulo`, `observacao`) VALUES
('Doc do Joao ', 'A minha primeira observacao.'),
('Doc Partilhado ', 'Este e fixe.'),
('Doc Partilhado ', 'Rute gosta do doc do joao.'),
('Doc Importado ', 'Custou mutio a faze.'),
('Doc Importado ', 'foi facil'),
('Doc Importado ', 'foi facil'),
('Doc partilhado com a rute ', 'foi dificil'),
('Doc Importado ', 'foi facil'),
('Doc Partilhado ', 'Custou mutio a faze.'),
('titulo ', 'observacao minha');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
  `nome` text NOT NULL,
  `morada` text,
  `contacto` int(9) DEFAULT NULL,
  `estadoConta` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`nome`, `morada`, `contacto`, `estadoConta`, `username`, `password`) VALUES
('Rute Silva', 'Rua de D. Afondo', 913234111, 'ativada', 'rute', 'f1a43c29d7ead597872853363894a326'),
('João Pereira', 'Travessa do Curral', 252900751, 'ativada', 'joao', 'dccd96c256bc7dd39bae41a405f25e43'),
('Rui Costa', 'Avenida da Ponte', 932199530, 'ativada', 'rui1', '0eb46665addf43389ae950050f787a45'),
('Pedro Miguel', 'Morada', 912345678, 'ativada', 'pedr', '26ee6bb47ca0cc944412feff17bc5f85');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
