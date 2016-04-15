--
-- ExtazCMS 1.11
--
DROP TABLE IF EXISTS `extaz_posts_views`;
ALTER TABLE `extaz_informations` DROP `use_posts_views`;

ALTER TABLE `extaz_codes` DROP `user_id`;

TRUNCATE TABLE `extaz_faqs`;
ALTER TABLE `extaz_faqs` ADD PRIMARY KEY (`id`);
ALTER TABLE `extaz_faqs` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;

DROP TABLE IF EXISTS `extaz_permissions`;

ALTER TABLE `extaz_users` ADD `ip` VARCHAR(255) NOT NULL AFTER `password`;

CREATE TABLE `extaz_updates` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `updater` TEXT NOT NULL,
  `ip` TEXT NOT NULL,
  `name` TEXT NOT NULL,
  `version` TEXT NOT NULL,
  `type` TEXT NOT NULL,
  `created` DATETIME NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

INSERT INTO `extaz_updates` (`id`, `updater`, `ip`, `name`, `version`, `type`, `created`) VALUES
  (1, 'MrSaooty',    '::1', '',            '1.8',     'NORMAL', '2015-08-12 12:12:00'),
  (2, 'tristancode', '::1', 'Nebula',      '1.9',     'NORMAL', '2015-08-31 19:33:00'),
  (3, 'tristancode', '::1', 'White Dwarf', '1.10',    'NORMAL', '2015-10-18 08:35:00'),
  (4, 'tristancode', '::1', 'White Dwarf', '1.10#6',  'PATCH',  '2015-10-18 14:24:00'),
  (5, 'tristancode', '::1', 'Addendum',    '1.11',    'NORMAL', '2015-12-01 12:25:00');