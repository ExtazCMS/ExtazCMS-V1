--
-- ExtazCMS - 1.8
--
ALTER TABLE `extaz_informations` ADD `use_votes` INT NOT NULL AFTER `use_contact`;
UPDATE `extaz_informations` SET `use_votes` = '1' WHERE `extaz_informations`.`id` = 1;

CREATE TABLE IF NOT EXISTS `extaz_votes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `ip` text NOT NULL,
  `reward` int(11) NOT NULL,
  `next_vote` text NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `extaz_posts_views` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `ip` text NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

CREATE TABLE IF NOT EXISTS `extaz_widgets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `content` longtext NOT NULL,
  `ip` text NOT NULL,
  `order` int(11) NOT NULL,
  `visible` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0;