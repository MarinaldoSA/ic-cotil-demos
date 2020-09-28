CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL DEFAULT '0',
  `senha` varchar(100) NOT NULL DEFAULT '0',
  `password` varchar(100) NOT NULL DEFAULT '0',
  `nome` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
testtesttest