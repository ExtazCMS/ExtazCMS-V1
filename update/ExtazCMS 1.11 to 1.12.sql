--
-- Structure de la table `extaz_codes`
--

ALTER TABLE `extaz_codes`
ADD `user_id` int(11) NOT NULL;

--
-- Contenu de la table `extaz_updates`
--

INSERT INTO `extaz_updates` (`id`, `updater`, `ip`, `name`, `version`, `type`, `created`) VALUES
(6, 'Khran', '::1', 'Fenix', '1.12', 'NORMAL', '2016-04-15 19:30:00');

--
-- Structure de la table `extaz_informations`
--

ALTER TABLE `extaz_informations`
ADD `url_site` text,
ADD `banner_url` text,
ADD `cgvandcgu` longtext,
ADD `votes_url_1` text,
ADD `votes_url_2` text,
ADD `votes_url_3` text,
ADD `votes_url_4` text,
ADD `votes_url_5` text,
ADD `votes_time_1` int(11) DEFAULT NULL,
ADD `votes_time_2` int(11) DEFAULT NULL,
ADD `votes_time_3` int(11) DEFAULT NULL,
ADD `votes_time_4` int(11) DEFAULT NULL,
ADD `votes_time_5` int(11) DEFAULT NULL,
ADD `tax_percent` int(11) DEFAULT NULL;


--
-- Structure de la table `extaz_support`
--

ALTER TABLE `extaz_support`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
ADD PRIMARY KEY (`id`);


--
-- Structure de la table `extaz_posts`
--

ALTER TABLE `extaz_posts`
ADD `locked` int(11) DEFAULT NULL;


--
-- Structure de la table `extaz_shop`
--

ALTER TABLE `extaz_shop`
ADD `needonline` int(11) DEFAULT '1',
MODIFY `command` text CHARACTER SET utf8 COLLATE utf8_unicode_ci;


--
-- Structure de la table `extaz_users`
--

ALTER TABLE `extaz_users`
ADD `ban` varchar(10) NOT NULL DEFAULT '0',
ADD `cgvcgu` int(11) NOT NULL DEFAULT '0',
ADD `reward` int(11) NOT NULL DEFAULT '0';


--
-- Structure de la table `extaz_votes`
--

ALTER TABLE `extaz_votes`
ADD `next_vote_1` text NOT NULL,
ADD `next_vote_2` text NOT NULL,
ADD `next_vote_3` text NOT NULL,
ADD `next_vote_4` text NOT NULL,
ADD `next_vote_5` text NOT NULL;
