---
--- Skrypt OdwiedzinyPro ver 2.1
--- Wszelkie prawa zastrzeżone!
--- Copyright © 2011 ITUnix.eu. All rights reserved. 
---

CREATE TABLE IF NOT EXISTS `odwiedziny` (
  `id` int(11) NOT NULL auto_increment,
  `ip` text NOT NULL,
  `useragent` text NOT NULL,
  `godzina` text NOT NULL,
  `uid` text NOT NULL,
  `link` text NOT NULL,
  `nick` text NOT NULL,
  `awatar` text NOT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `wyswietlenia` (
  `wyswietlenia` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
INSERT INTO `wyswietlenia` (`wyswietlenia`) VALUES
(0);
