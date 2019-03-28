CREATE TABLE IF NOT EXISTS `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(300) NULL COLLATE utf8_unicode_ci,
  `price` int(10) unsigned DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `reviewer` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `text_review` text COLLATE utf8_unicode_ci NOT NULL,
  `moderation` INT(1) UNSIGNED NOT NULL DEFAULT '0',
  `id_product` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY FK__products (`id_product`),
  CONSTRAINT FK__products FOREIGN KEY (`id_product`) REFERENCES `products` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
