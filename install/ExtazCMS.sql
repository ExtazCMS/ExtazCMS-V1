-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Client: localhost:3306
-- Généré le: Ven 17 Juin 2016 à 10:12
-- Version du serveur: 10.1.14-MariaDB
-- Version de PHP: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;



-- --------------------------------------------------------

--
-- Structure de la table `extaz_buttons`
--

CREATE TABLE IF NOT EXISTS `extaz_buttons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `content` varchar(255) CHARACTER SET latin1 NOT NULL,
  `url` varchar(255) CHARACTER SET latin1 NOT NULL,
  `icon` varchar(255) CHARACTER SET latin1 NOT NULL,
  `color` varchar(255) CHARACTER SET latin1 NOT NULL,
  `order` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `extaz_codes`
--

CREATE TABLE IF NOT EXISTS `extaz_codes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `creator` text NOT NULL,
  `ip` text NOT NULL,
  `code` text NOT NULL,
  `value` int(11) DEFAULT NULL,
  `used` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;



-- --------------------------------------------------------

--
-- Structure de la table `extaz_comments`
--

CREATE TABLE IF NOT EXISTS `extaz_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ip` text NOT NULL,
  `comment` text NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;


-- --------------------------------------------------------

--
-- Structure de la table `extaz_cpages`
--

CREATE TABLE IF NOT EXISTS `extaz_cpages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `slug` text NOT NULL,
  `visible` tinyint(1) DEFAULT NULL,
  `name` text NOT NULL,
  `content` longtext NOT NULL,
  `redirect` int(11) NOT NULL,
  `url` text NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `extaz_donation_ladder`
--

CREATE TABLE IF NOT EXISTS `extaz_donation_ladder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `tokens` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `extaz_faqs`
--

CREATE TABLE IF NOT EXISTS `extaz_faqs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` text,
  `answer` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Structure de la table `extaz_informations`
--

CREATE TABLE IF NOT EXISTS `extaz_informations` (
  `id` int(11) NOT NULL DEFAULT '1',
  `debug` int(11) NOT NULL DEFAULT '0',
  `name_server` varchar(255) DEFAULT '',
  `ip_server` text,
  `port_server` int(11) DEFAULT NULL,
  `money_server` text,
  `jsonapi_ip` varchar(255) DEFAULT NULL,
  `jsonapi_port` int(11) DEFAULT NULL,
  `jsonapi_username` varchar(255) DEFAULT NULL,
  `jsonapi_password` varchar(255) DEFAULT NULL,
  `jsonapi_salt` varchar(255) DEFAULT NULL,
  `site_money` text,
  `starpass_idp` int(11) DEFAULT NULL,
  `starpass_idd` int(11) DEFAULT NULL,
  `starpass_tokens` int(11) DEFAULT NULL,
  `paypal_price` int(11) DEFAULT NULL,
  `paypal_tokens` int(11) DEFAULT NULL,
  `paypal_email` text,
  `contact_email` text,
  `logo_url` text,
  `url_site` text,
  `banner_url` text,
  `use_store` int(11) DEFAULT NULL,
  `use_paypal` int(11) DEFAULT NULL,
  `use_starpass` int(11) DEFAULT NULL,
  `use_economy` int(11) DEFAULT NULL,
  `use_server_money` int(11) DEFAULT NULL,
  `use_team` int(11) DEFAULT NULL,
  `use_contact` int(11) DEFAULT NULL,
  `use_rules` int(11) DEFAULT NULL,
  `use_donation_ladder` int(11) DEFAULT NULL,
  `use_slider` int(11) DEFAULT NULL,
  `use_votes` int(11) DEFAULT NULL,
  `use_votes_ladder` int(11) DEFAULT NULL,
  `use_igchat` int(11) DEFAULT NULL,
  `happy_hour` int(11) DEFAULT NULL,
  `happy_hour_bonus` int(11) DEFAULT NULL,
  `rules` longtext,
  `cgvandcgu` longtext,
  `background` text,
  `chat_prefix` text,
  `chat_nb_messages` int(11) DEFAULT NULL,
  `analytics` text,
  `maintenance` int(11) DEFAULT NULL,
  `votes_url_1` text,
  `votes_url_2` text,
  `votes_url_3` text,
  `votes_url_4` text,
  `votes_url_5` text,
  `votes_description` varchar(255) NOT NULL,
  `votes_time_1` int(11) DEFAULT NULL,
  `votes_time_2` int(11) DEFAULT NULL,
  `votes_time_3` int(11) DEFAULT NULL,
  `votes_time_4` int(11) DEFAULT NULL,
  `votes_time_5` int(11) DEFAULT NULL,
  `votes_name_1` text NOT NULL,
  `votes_name_2` text NOT NULL,
  `votes_name_3` text NOT NULL,
  `votes_name_4` text NOT NULL,
  `votes_name_5` text NOT NULL,
  `votes_reward` int(11) DEFAULT NULL,
  `votes_command` text,
  `votes_ladder_limit` int(11) DEFAULT NULL,
  `customs_buttons_title` text DEFAULT NULL,
  `theme_color_main` varchar(7) NOT NULL,
  `use_faq` int(11) DEFAULT NULL,
  `tax_percent` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `extaz_informations`
--

INSERT INTO `extaz_informations` (`id`, `debug`, `name_server`, `ip_server`, `port_server`, `money_server`, `jsonapi_ip`, `jsonapi_port`, `jsonapi_username`, `jsonapi_password`, `jsonapi_salt`, `site_money`, `starpass_idp`, `starpass_idd`, `starpass_tokens`, `paypal_price`, `paypal_tokens`, `paypal_email`, `contact_email`, `logo_url`, `url_site`, `banner_url`, `use_store`, `use_paypal`, `use_starpass`, `use_economy`, `use_server_money`, `use_team`, `use_contact`, `use_rules`, `use_donation_ladder`, `use_slider`, `use_votes`, `use_votes_ladder`, `use_igchat`, `happy_hour`, `happy_hour_bonus`, `rules`, `cgvandcgu`, `background`, `chat_prefix`, `chat_nb_messages`, `analytics`, `maintenance`, `votes_url_1`, `votes_url_2`, `votes_url_3`, `votes_url_4`, `votes_url_5`, `votes_description`, `votes_time_1`, `votes_time_2`, `votes_time_3`, `votes_time_4`, `votes_time_5`, `votes_name_1`, `votes_name_2`, `votes_name_3`, `votes_name_4`, `votes_name_5`, `votes_reward`, `votes_command`, `votes_ladder_limit`, `customs_buttons_title`, `theme_color_main`, `use_faq`, `tax_percent`) VALUES
(1, 0, 'serveur de test', '', NULL, 'Token', '', NULL, '', '', '', 'euros', NULL, NULL, NULL, NULL, NULL, '', 'contact@domain.com', '', 'http://www.monsite.com', '', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 25, '', '', '2.jpg', 'Web', 1, '', 0, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', NULL, 'give %player% minecraft:diamond 1&&&broadcast %player% a voté pour le serveur', 15, 0, '#00000', 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `extaz_instant_payment_notifications`
--

CREATE TABLE IF NOT EXISTS `extaz_instant_payment_notifications` (
  `id` char(36) NOT NULL,
  `notify_version` varchar(64) DEFAULT NULL COMMENT 'IPN Version Number',
  `verify_sign` varchar(127) DEFAULT NULL COMMENT 'Encrypted string used to verify the authenticityof the tansaction',
  `test_ipn` int(11) DEFAULT NULL,
  `address_city` varchar(40) DEFAULT NULL COMMENT 'City of customers address',
  `address_country` varchar(64) DEFAULT NULL COMMENT 'Country of customers address',
  `address_country_code` varchar(2) DEFAULT NULL COMMENT 'Two character ISO 3166 country code',
  `address_name` varchar(128) DEFAULT NULL COMMENT 'Name used with address (included when customer provides a Gift address)',
  `address_state` varchar(40) DEFAULT NULL COMMENT 'State of customer address',
  `address_status` varchar(20) DEFAULT NULL COMMENT 'confirmed/unconfirmed',
  `address_street` varchar(200) DEFAULT NULL COMMENT 'Customer''s street address',
  `address_zip` varchar(20) DEFAULT NULL COMMENT 'Zip code of customer''s address',
  `first_name` varchar(64) DEFAULT NULL COMMENT 'Customer''s first name',
  `last_name` varchar(64) DEFAULT NULL COMMENT 'Customer''s last name',
  `payer_business_name` varchar(127) DEFAULT NULL COMMENT 'Customer''s company name, if customer represents a business',
  `payer_email` varchar(127) DEFAULT NULL COMMENT 'Customer''s primary email address. Use this email to provide any credits',
  `payer_id` varchar(13) DEFAULT NULL COMMENT 'Unique customer ID.',
  `payer_status` varchar(20) DEFAULT NULL COMMENT 'verified/unverified',
  `contact_phone` varchar(20) DEFAULT NULL COMMENT 'Customer''s telephone number.',
  `residence_country` varchar(2) DEFAULT NULL COMMENT 'Two-Character ISO 3166 country code',
  `business` varchar(127) DEFAULT NULL COMMENT 'Email address or account ID of the payment recipient (that is, the merchant). Equivalent to the values of receiver_email (If payment is sent to primary account) and business set in the Website Payment HTML.',
  `item_name` varchar(127) DEFAULT NULL COMMENT 'Item name as passed by you, the merchant. Or, if not passed by you, as entered by your customer. If this is a shopping cart transaction, Paypal will append the number of the item (e.g., item_name_1,item_name_2, and so forth).',
  `item_number` varchar(127) DEFAULT NULL COMMENT 'Pass-through variable for you to track purchases. It will get passed back to you at the completion of the payment. If omitted, no variable will be passed back to you.',
  `quantity` varchar(127) DEFAULT NULL COMMENT 'Quantity as entered by your customer or as passed by you, the merchant. If this is a shopping cart transaction, PayPal appends the number of the item (e.g., quantity1,quantity2).',
  `receiver_email` varchar(127) DEFAULT NULL COMMENT 'Primary email address of the payment recipient (that is, the merchant). If the payment is sent to a non-primary email address on your PayPal account, the receiver_email is still your primary email.',
  `receiver_id` varchar(13) DEFAULT NULL COMMENT 'Unique account ID of the payment recipient (i.e., the merchant). This is the same as the recipients referral ID.',
  `custom` varchar(255) DEFAULT NULL COMMENT 'Custom value as passed by you, the merchant. These are pass-through variables that are never presented to your customer.',
  `invoice` varchar(127) DEFAULT NULL COMMENT 'Pass through variable you can use to identify your invoice number for this purchase. If omitted, no variable is passed back.',
  `memo` varchar(255) DEFAULT NULL COMMENT 'Memo as entered by your customer in PayPal Website Payments note field.',
  `option_name1` varchar(64) DEFAULT NULL COMMENT 'Option name 1 as requested by you',
  `option_name2` varchar(64) DEFAULT NULL COMMENT 'Option 2 name as requested by you',
  `option_selection1` varchar(200) DEFAULT NULL COMMENT 'Option 1 choice as entered by your customer',
  `option_selection2` varchar(200) DEFAULT NULL COMMENT 'Option 2 choice as entered by your customer',
  `tax` decimal(10,2) DEFAULT NULL COMMENT 'Amount of tax charged on payment',
  `auth_id` varchar(19) DEFAULT NULL COMMENT 'Authorization identification number',
  `auth_exp` varchar(28) DEFAULT NULL COMMENT 'Authorization expiration date and time, in the following format: HH:MM:SS DD Mmm YY, YYYY PST',
  `auth_amount` int(11) DEFAULT NULL COMMENT 'Authorization amount',
  `auth_status` varchar(20) DEFAULT NULL COMMENT 'Status of authorization',
  `num_cart_items` int(11) DEFAULT NULL COMMENT 'If this is a PayPal shopping cart transaction, number of items in the cart',
  `parent_txn_id` varchar(19) DEFAULT NULL COMMENT 'In the case of a refund, reversal, or cancelled reversal, this variable contains the txn_id of the original transaction, while txn_id contains a new ID for the new transaction.',
  `payment_date` varchar(28) DEFAULT NULL COMMENT 'Time/date stamp generated by PayPal, in the following format: HH:MM:SS DD Mmm YY, YYYY PST',
  `payment_status` varchar(20) DEFAULT NULL COMMENT 'Payment status of the payment',
  `payment_type` varchar(10) DEFAULT NULL COMMENT 'echeck/instant',
  `pending_reason` varchar(20) DEFAULT NULL COMMENT 'This variable is only set if payment_status=pending',
  `reason_code` varchar(20) DEFAULT NULL COMMENT 'This variable is only set if payment_status=reversed',
  `remaining_settle` int(11) DEFAULT NULL COMMENT 'Remaining amount that can be captured with Authorization and Capture',
  `shipping_method` varchar(64) DEFAULT NULL COMMENT 'The name of a shipping method from the shipping calculations section of the merchants account profile. The buyer selected the named shipping method for this transaction',
  `shipping` decimal(10,2) DEFAULT NULL COMMENT 'Shipping charges associated with this transaction. Format unsigned, no currency symbol, two decimal places',
  `transaction_entity` varchar(20) DEFAULT NULL COMMENT 'Authorization and capture transaction entity',
  `txn_id` varchar(19) DEFAULT '' COMMENT 'A unique transaction ID generated by PayPal',
  `txn_type` varchar(20) DEFAULT NULL COMMENT 'cart/express_checkout/send-money/virtual-terminal/web-accept',
  `exchange_rate` decimal(10,2) DEFAULT NULL COMMENT 'Exchange rate used if a currency conversion occured',
  `mc_currency` varchar(3) DEFAULT NULL COMMENT 'Three character country code. For payment IPN notifications, this is the currency of the payment, for non-payment subscription IPN notifications, this is the currency of the subscription.',
  `mc_fee` decimal(10,2) DEFAULT NULL COMMENT 'Transaction fee associated with the payment, mc_gross minus mc_fee equals the amount deposited into the receiver_email account. Equivalent to payment_fee for USD payments. If this amount is negative, it signifies a refund or reversal, and either ofthose p',
  `mc_gross` decimal(10,2) DEFAULT NULL COMMENT 'Full amount of the customer''s payment',
  `mc_handling` decimal(10,2) DEFAULT NULL COMMENT 'Total handling charge associated with the transaction',
  `mc_shipping` decimal(10,2) DEFAULT NULL COMMENT 'Total shipping amount associated with the transaction',
  `payment_fee` decimal(10,2) DEFAULT NULL COMMENT 'USD transaction fee associated with the payment',
  `payment_gross` decimal(10,2) DEFAULT NULL COMMENT 'Full USD amount of the customers payment transaction, before payment_fee is subtracted',
  `settle_amount` decimal(10,2) DEFAULT NULL COMMENT 'Amount that is deposited into the account''s primary balance after a currency conversion',
  `settle_currency` varchar(3) DEFAULT NULL COMMENT 'Currency of settle amount. Three digit currency code',
  `auction_buyer_id` varchar(64) DEFAULT NULL COMMENT 'The customer''s auction ID.',
  `auction_closing_date` varchar(28) DEFAULT NULL COMMENT 'The auction''s close date. In the format: HH:MM:SS DD Mmm YY, YYYY PSD',
  `auction_multi_item` int(11) DEFAULT NULL COMMENT 'The number of items purchased in multi-item auction payments',
  `for_auction` varchar(10) DEFAULT NULL COMMENT 'This is an auction payment - payments made using Pay for eBay Items or Smart Logos - as well as send money/money request payments with the type eBay items or Auction Goods(non-eBay)',
  `subscr_date` varchar(28) DEFAULT NULL COMMENT 'Start date or cancellation date depending on whether txn_type is subcr_signup or subscr_cancel',
  `subscr_effective` varchar(28) DEFAULT NULL COMMENT 'Date when a subscription modification becomes effective',
  `period1` varchar(10) DEFAULT NULL COMMENT '(Optional) Trial subscription interval in days, weeks, months, years (example a 4 day interval is 4 D',
  `period2` varchar(10) DEFAULT NULL COMMENT '(Optional) Trial period',
  `period3` varchar(10) DEFAULT NULL COMMENT 'Regular subscription interval in days, weeks, months, years',
  `amount1` decimal(10,2) DEFAULT NULL COMMENT 'Amount of payment for Trial period 1 for USD',
  `amount2` decimal(10,2) DEFAULT NULL COMMENT 'Amount of payment for Trial period 2 for USD',
  `amount3` decimal(10,2) DEFAULT NULL COMMENT 'Amount of payment for regular subscription  period 1 for USD',
  `mc_amount1` decimal(10,2) DEFAULT NULL COMMENT 'Amount of payment for trial period 1 regardless of currency',
  `mc_amount2` decimal(10,2) DEFAULT NULL COMMENT 'Amount of payment for trial period 2 regardless of currency',
  `mc_amount3` decimal(10,2) DEFAULT NULL COMMENT 'Amount of payment for regular subscription period regardless of currency',
  `recurring` varchar(1) DEFAULT NULL COMMENT 'Indicates whether rate recurs (1 is yes, blank is no)',
  `reattempt` varchar(1) DEFAULT NULL COMMENT 'Indicates whether reattempts should occur on payment failure (1 is yes, blank is no)',
  `retry_at` varchar(28) DEFAULT NULL COMMENT 'Date PayPal will retry a failed subscription payment',
  `recur_times` int(11) DEFAULT NULL COMMENT 'The number of payment installations that will occur at the regular rate',
  `username` varchar(64) DEFAULT NULL COMMENT '(Optional) Username generated by PayPal and given to subscriber to access the subscription',
  `password` varchar(24) DEFAULT NULL COMMENT '(Optional) Password generated by PayPal and given to subscriber to access the subscription (Encrypted)',
  `subscr_id` varchar(19) DEFAULT NULL COMMENT 'ID generated by PayPal for the subscriber',
  `case_id` varchar(28) DEFAULT NULL COMMENT 'Case identification number',
  `case_type` varchar(28) DEFAULT NULL COMMENT 'complaint/chargeback',
  `case_creation_date` varchar(28) DEFAULT NULL COMMENT 'Date/Time the case was registered',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `extaz_likes`
--

CREATE TABLE IF NOT EXISTS `extaz_likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_article` int(11) DEFAULT '0',
  `ip` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;


-- --------------------------------------------------------

--
-- Structure de la table `extaz_paypal_items`
--

CREATE TABLE IF NOT EXISTS `extaz_paypal_items` (
  `id` varchar(36) NOT NULL,
  `instant_payment_notification_id` varchar(36) NOT NULL,
  `item_name` varchar(127) DEFAULT NULL,
  `item_number` varchar(127) DEFAULT NULL,
  `quantity` varchar(127) DEFAULT NULL,
  `mc_gross` float(10,2) DEFAULT NULL,
  `mc_shipping` float(10,2) DEFAULT NULL,
  `mc_handling` float(10,2) DEFAULT NULL,
  `tax` float(10,2) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `extaz_posts`
--

CREATE TABLE IF NOT EXISTS `extaz_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `content` longtext,
  `img` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `likes` int(11) NOT NULL DEFAULT '0',
  `ip` varchar(255) DEFAULT NULL,
  `progress` int(11) DEFAULT NULL,
  `visible` int(11) DEFAULT NULL,
  `draft` int(11) DEFAULT NULL,
  `corrected` int(11) DEFAULT NULL,
  `posted` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `locked` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `extaz_posts`
--

INSERT INTO `extaz_posts` (`id`, `cat`, `title`, `slug`, `content`, `img`, `author`, `likes`, `ip`, `progress`, `visible`, `draft`, `corrected`, `posted`, `created`, `updated`, `locked`) VALUES
(1, 'Infos', 'Bienvenue', 'site-web', '<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>\r\n', 'http://images.vcpost.com/data/images/full/33294/minecraft-update-21.jpg?w=590', 'ExtazCMS', 0, '0', 0, 0, 0, 0, '2014-12-05 20:19:42', '2014-12-05 20:19:42', '2016-06-14 17:56:45', 0),
(2, 'Infos', 'Bienvenue', 'site-web', '<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>\r\n', 'http://images.latinospost.com/data/images/full/26631/minecraft-screenshot.jpg?w=560', 'ExtazCMS', 0, '0', 0, 0, 0, 0, '2014-12-05 20:19:42', '2014-12-05 20:19:42', '2016-06-14 20:14:09', 0),
(3, 'MAJ', 'Bienvenue', 'site-web', '<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>\r\n', 'http://media.moddb.com/images/articles/1/125/124279/auto/mc2.jpg', 'ExtazCMS', 0, '0', 0, 0, 0, 0, '2014-12-05 20:19:42', '2014-12-05 20:19:42', '2016-06-14 17:56:16', 1),
(4, 'Infos', 'Bienvenue', 'site-web', '<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>\r\n', 'http://images.latinpost.com/data/images/full/18581/minecraft-name-change-update-coming.jpg?w=600', 'ExtazCMS', 0, '0', 0, 0, 0, 0, '2014-12-05 20:19:42', '2014-12-05 20:19:42', '2016-06-14 17:56:29', 0),
(5, 'News', 'News2', 'news', '<p>&nbsp;</p>\r\n\r\n<p><!--StartFragment--></p>\r\n\r\n<div class="blog margin-bottom-40" style="box-sizing: border-box; clear: both; margin-bottom: 40px; color: rgb(51, 51, 51); font-family: &quot;Open Sans Condensed&quot;, sans-serif; font-size: 13px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 20.8px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);">\r\n<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>\r\n</div>\r\n\r\n<p><!--EndFragment--></p>\r\n', 'http://images.latinospost.com/data/images/full/26631/minecraft-screenshot.jpg', 'testeur', 0, '81.251.107.183', 0, 0, 0, 0, '2016-06-14 20:09:53', '2016-06-14 20:09:41', '2016-06-17 10:05:32', NULL),
(6, 'test', 'News3', 'newss', '<p>&nbsp;</p>\r\n\r\n<p><!--StartFragment--></p>\r\n\r\n<div class="blog margin-bottom-40" style="box-sizing: border-box; clear: both; margin-bottom: 40px; color: rgb(51, 51, 51); font-family: &quot;Open Sans Condensed&quot;, sans-serif; font-size: 13px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 20.8px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);">\r\n<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>\r\n</div>\r\n\r\n<p><!--EndFragment--></p>\r\n', 'http://images.latinospost.com/data/images/full/26631/minecraft-screenshot.jpg', 'testeur', 0, '81.251.107.183', 0, 0, 0, 0, '2016-06-14 20:13:36', '2016-06-14 20:13:27', '2016-06-14 20:16:38', NULL),
(7, 'Informationnnnnnn', 'News4', 'newsd', '<p><!--StartFragment-->Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?<!--EndFragment--></p>\r\n', 'http://images.latinospost.com/data/images/full/26631/minecraft-screenshot.jpg', 'testeur', 0, '81.251.107.183', 0, 1, 0, 0, '2016-06-14 20:27:23', '2016-06-14 20:27:14', '2016-06-14 20:27:23', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `extaz_send_tokens_history`
--

CREATE TABLE IF NOT EXISTS `extaz_send_tokens_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shipper` text NOT NULL,
  `recipient` text NOT NULL,
  `nb_tokens` int(11) DEFAULT NULL,
  `loss_rate` text NOT NULL,
  `nb_tokens_with_loss_rate` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `extaz_shop`
--

CREATE TABLE IF NOT EXISTS `extaz_shop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `description` text,
  `cat` text,
  `img` text,
  `needonline` int(11) DEFAULT NULL,
  `visible` int(11) DEFAULT NULL,
  `promo` int(11) DEFAULT NULL,
  `required` text,
  `required_name` text,
  `price_money_site` int(11) DEFAULT NULL,
  `price_money_server` int(11) DEFAULT NULL,
  `command` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Structure de la table `extaz_shop_categories`
--

CREATE TABLE IF NOT EXISTS `extaz_shop_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `created` date NOT NULL,
  `updated` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;



-- --------------------------------------------------------

--
-- Structure de la table `extaz_shop_history`
--

CREATE TABLE IF NOT EXISTS `extaz_shop_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `item` text,
  `item_id` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `money` text,
  `quantity` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;


-- --------------------------------------------------------

--
-- Structure de la table `extaz_starpass_history`
--

CREATE TABLE IF NOT EXISTS `extaz_starpass_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `tokens` int(11) DEFAULT NULL,
  `code` text,
  `note` text,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `extaz_support`
--

CREATE TABLE IF NOT EXISTS `extaz_support` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `type` text,
  `priority` int(11) DEFAULT NULL,
  `message` longtext,
  `resolved` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `extaz_support_comments`
--

CREATE TABLE IF NOT EXISTS `extaz_support_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `message` longtext,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `extaz_team`
--

CREATE TABLE IF NOT EXISTS `extaz_team` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dname` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT '',
  `rank` text,
  `color` text,
  `order` int(11) DEFAULT NULL,
  `facebook_url` text,
  `twitter_url` text,
  `youtube_url` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Structure de la table `extaz_updates`
--

CREATE TABLE IF NOT EXISTS `extaz_updates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `updater` text NOT NULL,
  `ip` text NOT NULL,
  `name` text NOT NULL,
  `version` text NOT NULL,
  `type` text NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `extaz_updates`
--

INSERT INTO `extaz_updates` (`id`, `updater`, `ip`, `name`, `version`, `type`, `created`) VALUES
(1, 'ExtazCMS', '::1', '', '1.8', 'NORMAL', '2015-08-12 12:12:00'),
(2, 'ExtazCMS', '::1', 'Nebula', '1.9', 'NORMAL', '2015-08-31 19:33:00'),
(3, 'ExtazCMS', '::1', 'White Dwarf', '1.10', 'NORMAL', '2015-10-18 08:35:00'),
(4, 'ExtazCMS', '::1', 'White Dwarf', '1.10#6', 'PATCH', '2015-10-18 14:24:00'),
(5, 'ExtazCMS', '::1', 'Addendum', '1.11', 'NORMAL', '2015-12-01 12:25:00'),
(6, 'ExtazCMS', '::1', 'Phénix', '1.12', 'NORMAL', '2016-04-09 08:30:00'),
(7, 'ExtazCMS', '::1', 'Phénix patch 1', '1.12.1', 'PATCH', '2016-04-22 00:45:00'),
(8, 'ExtazCMS', '::1', 'Phénix patch 2', '1.12.2', 'PATCH', '2016-05-01 15:30:00'),
(9, 'ExtazCMS', '::1', 'Phénix patch 3', '1.12.3', 'PATCH', '2016-05-03 02:10:00'),
(10, 'ExtazCMS', '::1', 'Saepe', '1.13', 'FINAL', '2016-06-24 18:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `extaz_users`
--

CREATE TABLE IF NOT EXISTS `extaz_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `ip` varchar(255) NOT NULL,
  `avatar` text,
  `tokens` int(11) DEFAULT NULL,
  `role` int(11) DEFAULT NULL,
  `votes` int(11) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `ban` varchar(10) NOT NULL DEFAULT '0',
  `cgvcgu` int(11) NOT NULL DEFAULT '0',
  `reward` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Structure de la table `extaz_votes`
--

CREATE TABLE IF NOT EXISTS `extaz_votes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `ip` text NOT NULL,
  `reward` int(11) NOT NULL,
  `next_vote_1` text NOT NULL,
  `next_vote_2` text NOT NULL,
  `next_vote_3` text NOT NULL,
  `next_vote_4` text NOT NULL,
  `next_vote_5` text NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;


-- --------------------------------------------------------

--
-- Structure de la table `extaz_widgets`
--

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
