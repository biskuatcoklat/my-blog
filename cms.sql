-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table cms.articles
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `user_id` int NOT NULL,
  `category_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `foto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `user_id` (`user_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `articles_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table cms.articles: ~5 rows (approximately)
INSERT INTO `articles` (`id`, `title`, `slug`, `content`, `user_id`, `category_id`, `created_at`, `updated_at`, `foto`) VALUES
	(1, 'The Future of AI', 'the-future-of-ai', 'Content about the future of AI', 1, 1, '2024-07-20 03:55:54', '2024-07-22 03:12:13', '669dce0db1b9e.jpg'),
	(2, 'Top 10 Health Tips', 'top-10-health-tips', 'Content about health tips', 2, 2, '2024-07-20 03:55:54', '2024-07-22 03:11:52', '669dcdf8d1250.jpg'),
	(3, 'Exploring the Alps', 'exploring-the-alps', 'Content about exploring the Alps', 3, 3, '2024-07-20 03:55:54', '2024-07-22 03:11:00', '669dcdc45aa3f.jpg'),
	(4, '5 Delicious Pasta Recipes', '5-delicious-pasta-recipes', 'Content about pasta recipes', 4, 4, '2024-07-20 03:55:54', '2024-07-22 03:10:41', '669dcdb187a9f.png'),
	(7, 'Gunung', 'gunung', 'sinabung wonderfull', 5, 3, '2024-07-22 03:14:01', '2024-07-22 03:14:01', '669dce798c337.jpg'),
	(8, 'Sekolah', 'sekolah ', 'sekolah adalah tempat belajar', 6, 7, '2024-07-22 04:20:59', '2024-07-22 04:21:45', '669dde2ba1a1b.jpg');

-- Dumping structure for table cms.article_tags
CREATE TABLE IF NOT EXISTS `article_tags` (
  `article_id` int NOT NULL,
  `tag_id` int NOT NULL,
  PRIMARY KEY (`article_id`,`tag_id`),
  KEY `tag_id` (`tag_id`),
  CONSTRAINT `article_tags_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `article_tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table cms.article_tags: ~10 rows (approximately)
INSERT INTO `article_tags` (`article_id`, `tag_id`) VALUES
	(1, 1),
	(3, 1),
	(2, 2),
	(4, 2),
	(3, 3),
	(4, 4),
	(1, 5),
	(2, 5);

-- Dumping structure for table cms.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table cms.categories: ~5 rows (approximately)
INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`) VALUES
	(1, 'Technology', 'technology', 'All about the latest in technology.', '2024-07-20 03:55:29', '2024-07-20 03:55:29'),
	(2, 'Health', 'health', 'Health tips and news.', '2024-07-20 03:55:29', '2024-07-20 03:55:29'),
	(3, 'Travel', 'travel', 'Travel guides and tips.', '2024-07-20 03:55:29', '2024-07-20 03:55:29'),
	(4, 'Food', 'food', 'Delicious recipes and food news.', '2024-07-20 03:55:29', '2024-07-20 03:55:29'),
	(5, 'Lifestyle', 'lifestyle', 'Tips and news on living your best life.', '2024-07-20 03:55:29', '2024-07-20 03:55:29'),
	(7, 'Science', 'Science', 'Science', '2024-07-22 04:21:29', '2024-07-22 04:21:29');

-- Dumping structure for table cms.comments
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `article_id` int NOT NULL,
  `user_id` int NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `article_id` (`article_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table cms.comments: ~10 rows (approximately)
INSERT INTO `comments` (`id`, `article_id`, `user_id`, `content`, `created_at`, `updated_at`) VALUES
	(1, 1, 2, 'Great insights on AI!', '2024-07-20 03:57:01', '2024-07-20 03:57:01'),
	(2, 2, 3, 'Very helpful health tips, thank you!', '2024-07-20 03:57:01', '2024-07-20 03:57:01'),
	(3, 3, 4, 'I can\'t wait to visit the Alps now!', '2024-07-20 03:57:01', '2024-07-20 03:57:01'),
	(4, 4, 5, 'Those pasta recipes are amazing!', '2024-07-20 03:57:01', '2024-07-20 03:57:01'),
	(6, 1, 3, 'AI is the future indeed.', '2024-07-20 03:57:01', '2024-07-20 03:57:01'),
	(7, 2, 4, 'I will definitely try these health tips.', '2024-07-20 03:57:01', '2024-07-20 03:57:01'),
	(8, 3, 5, 'The Alps are on my bucket list now.', '2024-07-20 03:57:01', '2024-07-20 03:57:01'),
	(9, 4, 1, 'Yummy! Can\'t wait to try these recipes.', '2024-07-20 03:57:01', '2024-07-20 03:57:01');

-- Dumping structure for table cms.tags
CREATE TABLE IF NOT EXISTS `tags` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table cms.tags: ~5 rows (approximately)
INSERT INTO `tags` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
	(1, 'Tech', 'tech', '2024-07-20 03:55:42', '2024-07-20 03:55:42'),
	(2, 'Wellness', 'wellness', '2024-07-20 03:55:42', '2024-07-20 03:55:42'),
	(3, 'Adventure', 'adventure', '2024-07-20 03:55:42', '2024-07-20 03:55:42'),
	(4, 'Cuisine', 'cuisine', '2024-07-20 03:55:42', '2024-07-20 03:55:42'),
	(5, 'LifeHacks', 'lifehacks', '2024-07-20 03:55:42', '2024-07-20 03:55:42');

-- Dumping structure for table cms.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table cms.users: ~5 rows (approximately)
INSERT INTO `users` (`id`, `username`, `password`, `email`, `created_at`, `updated_at`) VALUES
	(1, 'johndoe', 'password123', 'johndoe@example.com', '2024-07-20 03:54:58', '2024-07-20 03:54:58'),
	(2, 'janedoe', 'password456', 'janedoe@example.com', '2024-07-20 03:54:58', '2024-07-20 03:54:58'),
	(3, 'alexsmith', 'password789', 'alexsmith@example.com', '2024-07-20 03:54:58', '2024-07-20 03:54:58'),
	(4, 'mariabrown', 'password101', 'mariabrown@example.com', '2024-07-20 03:54:58', '2024-07-20 03:54:58'),
	(5, 'mikejohnson', 'password102', 'mikejohnson@example.com', '2024-07-20 03:54:58', '2024-07-20 03:54:58'),
	(6, 'wahyu', '$2y$10$DFAPFyrG6ca8nb02vaVFyeT3lwtTdNri8MmTWnHCowuOGFT9wWDu.', 'wahyu@gmail.com', '2024-07-22 04:05:48', '2024-07-22 04:05:48');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
