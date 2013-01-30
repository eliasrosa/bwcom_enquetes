-- <? defined('BW') or die("Acesso negado!"); ?>


-- 
ALTER TABLE `bw_versao` ADD `com_enquetes_1` INT(1) NOT NULL;


--
CREATE TABLE IF NOT EXISTS `bw_enquetes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pergunta` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;



--
CREATE TABLE IF NOT EXISTS `bw_enquetes_opcoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_enquete` int(11) NOT NULL,
  `opcao` varchar(255) NOT NULL,
  `ordem` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


--
CREATE TABLE IF NOT EXISTS `bw_enquetes_votos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_opcao` int(11) NOT NULL,
  `token` varchar(40) NOT NULL,
  `datahora` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
