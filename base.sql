DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `role` int DEFAULT NULL,
  `avatar` varchar(250) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
);



INSERT INTO `admin` (`id`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES
	(1,'Administrador','admin@admin.com','$2y$10$0S620x76fUNAXcsqlsULlOJGstkOxNLZoFdQrdJis56AyXdl/AQum',1,NULL,'2020-11-05 09:34:35'),
	(15,'Nicolas','admin@anteojosnegros.com','$2y$10$0V.BFFYOpRczGbSqjURzzumSj0hxmM4utUGzBfrxAI7xXin6S.Qum',1,'2021-03-12 18:29:35','2021-03-12 18:29:35');

CREATE TABLE `banner_types` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `use_example` varchar(200) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `banners` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `type` int NOT NULL,
  `mobile` int NOT NULL DEFAULT '0',
  `path_background` varchar(100) DEFAULT NULL,
  `banner_title` varchar(200) DEFAULT NULL,
  `banner_description` varchar(500) DEFAULT NULL,
  `button_text` varchar(250) DEFAULT NULL,
  `button_link` varchar(300) DEFAULT NULL,
  `button_target` varchar(50) DEFAULT NULL,
  `order` int DEFAULT NULL,
  `active` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
);






/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
