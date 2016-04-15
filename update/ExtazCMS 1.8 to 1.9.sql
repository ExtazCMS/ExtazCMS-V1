--
-- ExtazCMS 1.9
--
ALTER TABLE `extaz_informations` ADD `use_igchat` INT NULL;
ALTER TABLE `extaz_informations` ADD `use_starpass` INT NULL;
UPDATE `extaz_informations` SET `use_igchat` = '1';
UPDATE `extaz_informations` SET `use_starpass` = '1';

