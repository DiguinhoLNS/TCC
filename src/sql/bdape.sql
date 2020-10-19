-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 16-Out-2020 às 23:53
-- Versão do servidor: 5.7.17
-- PHP Version: 7.1.3
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;
/*!40101 SET NAMES utf8mb4 */
;
--
-- Database: `bdape`
--
CREATE DATABASE IF NOT EXISTS `bdape` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `bdape`;
-- --------------------------------------------------------
--
-- Estrutura da tabela `empresas`
--
CREATE TABLE `empresas` (
  `id_adm` int(11) NOT NULL,
  `codigo_acesso` varchar(6) NOT NULL,
  `Nome` varchar(60) NOT NULL,
  `CNPJ` varchar(14) NOT NULL,
  `Endereco` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Telefone` varchar(15) NOT NULL,
  `Cor_layout` varchar(20) NOT NULL
) ENGINE = MyISAM DEFAULT CHARSET = latin1;
-- --------------------------------------------------------
--
-- Estrutura da tabela `objetos`
--
CREATE TABLE `objetos` (
  `id_obj` int(11) NOT NULL,
  `id_adm` int(11) NOT NULL,
  `Nome_obj` varchar(80) NOT NULL,
  `foto_obj` blob NOT NULL,
  `Data_cadastro` date NOT NULL,
  `Categoria` varchar(20) NOT NULL,
  `Descricao` text NOT NULL,
  `Status` varchar(15) NOT NULL
) ENGINE = MyISAM DEFAULT CHARSET = latin1;
-- --------------------------------------------------------
--
-- Estrutura da tabela `user_empresa`
--
CREATE TABLE `user_empresa` (
  `id_user_empresa` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `Nivel_acesso` int(1) NOT NULL
) ENGINE = MyISAM DEFAULT CHARSET = latin1;
-- --------------------------------------------------------
--
-- Estrutura da tabela `usuarios`
--
CREATE TABLE `usuarios` (
  `id_user` int(11) NOT NULL,
  `Nome_user` varchar(80) NOT NULL,
  `Genero_user` varchar(15) NOT NULL,
  `Data_nasc_user` varchar(15) NOT NULL,
  `CPF_user` varchar(11) NOT NULL,
  `Email_user` varchar(100) NOT NULL,
  `Telefone_user` varchar(15) NOT NULL,
  `Senha_user` varchar(20) NOT NULL
) ENGINE = MyISAM DEFAULT CHARSET = latin1;
--
-- Extraindo dados da tabela `usuarios`
--
INSERT INTO `usuarios` (
    `id_user`,
    `Nome_user`,
    `Genero_user`,
    `Data_nasc_user`,
    `CPF_user`,
    `Email_user`,
    `Telefone_user`,
    `Senha_user`
  )
VALUES (
    1,
    'Luis Gustavo Da Silva Feitoza',
    'Masculino',
    '2003-08-20',
    '50576013854',
    'luisgustavofeitoza@gmail.com',
    '11945620297',
    'Lg123'
  );
--
-- Indexes for dumped tables
--
--
-- Indexes for table `empresas`
--
ALTER TABLE `empresas`
ADD PRIMARY KEY (`id_adm`);
--
-- Indexes for table `objetos`
--
ALTER TABLE `objetos`
ADD PRIMARY KEY (`id_obj`);
--
-- Indexes for table `user_empresa`
--
ALTER TABLE `user_empresa`
ADD PRIMARY KEY (`id_user_empresa`);
--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
ADD PRIMARY KEY (`id_user`);
--
-- AUTO_INCREMENT for dumped tables
--
--
-- AUTO_INCREMENT for table `objetos`
--
ALTER TABLE `objetos`
MODIFY `id_obj` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_empresa`
--
ALTER TABLE `user_empresa`
MODIFY `id_user_empresa` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 3;
COMMIT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;