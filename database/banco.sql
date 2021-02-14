-- --------------------------------------------------------
-- Servidor:                     mysql02-farm36.kinghost.net
-- Versão do servidor:           10.2.33-MariaDB-log - MariaDB Server
-- OS do Servidor:               Linux
-- HeidiSQL Versão:              10.3.0.5771
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para controlesaldo
CREATE DATABASE IF NOT EXISTS `controlesaldo` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `controlesaldo`;

-- Copiando estrutura para tabela controlesaldo.contas
CREATE TABLE IF NOT EXISTS `contas` (
  `id_conta` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) DEFAULT NULL,
  `data_aporte` date DEFAULT NULL,
  `valor_aporte` double DEFAULT NULL,
  `tipo_remuneracao` varchar(250) DEFAULT NULL,
  `numero_conta` varchar(150) DEFAULT NULL,
  `indicado_por_id_cliente` int(11) DEFAULT NULL,
  `comissao` double DEFAULT NULL,
  `comissao_indicacao` double DEFAULT NULL,
  `saldo` double DEFAULT NULL,
  `rentabilidade` double DEFAULT NULL,
  `rentabilidade_indicacao` double DEFAULT NULL,
  PRIMARY KEY (`id_conta`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela controlesaldo.contas: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `contas` DISABLE KEYS */;
INSERT INTO `contas` (`id_conta`, `id_cliente`, `data_aporte`, `valor_aporte`, `tipo_remuneracao`, `numero_conta`, `indicado_por_id_cliente`, `comissao`, `comissao_indicacao`, `saldo`, `rentabilidade`, `rentabilidade_indicacao`) VALUES
	(37, 25, '2020-12-14', 1000, 'Divisao', '20201214-23.07.30', 26, 5, 4, 1000, 50, 40),
	(38, 26, '2020-12-15', 5000, 'Divisao', '20201215-00.37.54', 27, 7, 6, 5000, 350, 300);
/*!40000 ALTER TABLE `contas` ENABLE KEYS */;

-- Copiando estrutura para tabela controlesaldo.contas_cliente
CREATE TABLE IF NOT EXISTS `contas_cliente` (
  `id_conta` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela controlesaldo.contas_cliente: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `contas_cliente` DISABLE KEYS */;
/*!40000 ALTER TABLE `contas_cliente` ENABLE KEYS */;

-- Copiando estrutura para tabela controlesaldo.historico_conta
CREATE TABLE IF NOT EXISTS `historico_conta` (
  `id_historico` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) DEFAULT NULL,
  `valor` decimal(10,2) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `numero_conta` varchar(50) DEFAULT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_historico`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela controlesaldo.historico_conta: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `historico_conta` DISABLE KEYS */;
/*!40000 ALTER TABLE `historico_conta` ENABLE KEYS */;

-- Copiando estrutura para tabela controlesaldo.rentabilidade
CREATE TABLE IF NOT EXISTS `rentabilidade` (
  `id_rentabilidade` int(11) NOT NULL AUTO_INCREMENT,
  `numero_conta` varchar(50) DEFAULT NULL,
  `id_usuario_conta` int(11) DEFAULT NULL,
  `id_usuario_comissao` int(11) DEFAULT NULL,
  `data_aniversario` date DEFAULT NULL,
  `valor_juros` double DEFAULT NULL,
  `total_sob_juros` double DEFAULT NULL,
  `saldo_cliente_comissao` double DEFAULT NULL,
  `valor_comissao` double DEFAULT NULL,
  `total_sob_comissao` double DEFAULT NULL,
  `data_calculo` date DEFAULT NULL,
  `numero_conta_comissionado` varchar(50) DEFAULT NULL,
  `saldo` double DEFAULT NULL,
  PRIMARY KEY (`id_rentabilidade`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela controlesaldo.rentabilidade: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `rentabilidade` DISABLE KEYS */;
/*!40000 ALTER TABLE `rentabilidade` ENABLE KEYS */;

-- Copiando estrutura para tabela controlesaldo.tipo_comissao
CREATE TABLE IF NOT EXISTS `tipo_comissao` (
  `id_tipo_comissao` int(11) NOT NULL AUTO_INCREMENT,
  `valor_comissao` int(11) DEFAULT NULL,
  `tipo_comissao` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_comissao`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela controlesaldo.tipo_comissao: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `tipo_comissao` DISABLE KEYS */;
INSERT INTO `tipo_comissao` (`id_tipo_comissao`, `valor_comissao`, `tipo_comissao`) VALUES
	(3, 10, 'ComissÃ£o CDC 10'),
	(4, 20, 'ComissÃ£o CDI 20');
/*!40000 ALTER TABLE `tipo_comissao` ENABLE KEYS */;

-- Copiando estrutura para tabela controlesaldo.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_usuario` varchar(50) DEFAULT NULL,
  `saldo` double DEFAULT NULL,
  `email` varchar(450) DEFAULT NULL,
  `telefone` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `senha` varchar(50) DEFAULT NULL,
  `login` varchar(450) DEFAULT NULL,
  `cpf` varchar(50) DEFAULT NULL,
  `nome` varchar(450) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela controlesaldo.usuarios: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id_usuario`, `tipo_usuario`, `saldo`, `email`, `telefone`, `status`, `senha`, `login`, `cpf`, `nome`) VALUES
	(1, 'ADMIN', NULL, NULL, NULL, NULL, '356a192b7913b04c54574d18c28d46e6395428ab', 'admin', '1', 'Administrador'),
	(25, 'CLIENTE', NULL, 'teste', '1234', NULL, NULL, NULL, '123', 'Teste 1'),
	(26, 'CLIENTE', NULL, 'teste@teste', '985', NULL, NULL, NULL, '987', 'Teste 2'),
	(27, 'CLIENTE', NULL, 'ye', '96', NULL, NULL, NULL, '852', 'Yellow');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
