-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.3.0 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.11.0.7065
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for sistema_inscripcion_deportes
CREATE DATABASE IF NOT EXISTS `sistema_inscripcion_deportes` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `sistema_inscripcion_deportes`;

-- Dumping structure for table sistema_inscripcion_deportes.delegados
CREATE TABLE IF NOT EXISTS `delegados` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `code` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `dni` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone_number` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `escuela_id` bigint unsigned NOT NULL,
  `deporte_id` bigint unsigned NOT NULL DEFAULT '0',
  `user_id` bigint unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `delegados_deporte_id` (`deporte_id`),
  KEY `delegados_escuela_id` (`escuela_id`),
  KEY `delegados_user_id` (`user_id`),
  CONSTRAINT `delegados_deporte_id` FOREIGN KEY (`deporte_id`) REFERENCES `deportes` (`id`),
  CONSTRAINT `delegados_escuela_id` FOREIGN KEY (`escuela_id`) REFERENCES `escuelas` (`id`),
  CONSTRAINT `delegados_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table sistema_inscripcion_deportes.delegados: ~2 rows (approximately)
INSERT INTO `delegados` (`id`, `name`, `code`, `dni`, `phone_number`, `escuela_id`, `deporte_id`, `user_id`, `created_at`, `updated_at`) VALUES
	(2, 'test', '147777', '11111111', '8888', 20, 21, 1, '2023-09-18 00:36:35', '2023-09-18 00:57:25'),
	(7, 'testing testing', '191106', '00000000', '7777', 20, 1, 1, '2023-09-18 00:56:58', '2023-09-18 00:57:19');

-- Dumping structure for table sistema_inscripcion_deportes.deportes
CREATE TABLE IF NOT EXISTS `deportes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `num_max_players` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int NOT NULL DEFAULT '0',
  `fecha_limite` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sistema_inscripcion_deportes.deportes: ~2 rows (approximately)
INSERT INTO `deportes` (`id`, `name`, `image`, `num_max_players`, `order`, `fecha_limite`, `created_at`, `updated_at`) VALUES
	(1, 'sed', 'deporte.jpg', '11', 2, '2024-10-12 15:33:32', '2023-05-03 22:51:49', '2023-05-03 22:51:49'),
	(21, 'testing testing', 'deporte.jpg', '5', 1, '2024-09-17 22:56:13', NULL, NULL);

-- Dumping structure for table sistema_inscripcion_deportes.escuelas
CREATE TABLE IF NOT EXISTS `escuelas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `facultad_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `escuelas_facultad_id_foreign` (`facultad_id`),
  CONSTRAINT `escuelas_facultad_id_foreign` FOREIGN KEY (`facultad_id`) REFERENCES `facultades` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sistema_inscripcion_deportes.escuelas: ~24 rows (approximately)
INSERT INTO `escuelas` (`id`, `name`, `facultad_id`, `created_at`, `updated_at`) VALUES
	(1, 'Dolores nam qui totam porro voluptatem voluptatem est.', 1, '2023-05-03 06:25:04', '2023-05-03 06:25:04'),
	(2, 'In optio eos commodi non magnam praesentium.', 2, '2023-05-03 06:25:04', '2023-05-03 06:25:04'),
	(3, 'Et quis deleniti deleniti eaque ducimus sit.', 3, '2023-05-03 06:25:04', '2023-05-03 06:25:04'),
	(4, 'Aut est sit sunt similique.', 3, '2023-05-03 06:25:04', '2023-05-03 06:25:04'),
	(5, 'Occaecati animi dolor quo aliquam eos occaecati.', 5, '2023-05-03 06:25:04', '2023-05-03 06:25:04'),
	(6, 'Voluptatem quia voluptatem reprehenderit fugit.', 9, '2023-05-03 06:25:04', '2023-05-03 06:25:04'),
	(7, 'Voluptatem et voluptas sunt quam.', 2, '2023-05-03 06:25:04', '2023-05-03 06:25:04'),
	(8, 'Est at doloribus quibusdam et sint laboriosam debitis.', 4, '2023-05-03 06:25:04', '2023-05-03 06:25:04'),
	(9, 'Laborum eius voluptas velit et magni at ipsa.', 2, '2023-05-03 06:25:05', '2023-05-03 06:25:05'),
	(10, 'Et accusantium voluptas et repellendus.', 10, '2023-05-03 06:25:05', '2023-05-03 06:25:05'),
	(11, 'Voluptate ea sed non soluta voluptas.', 2, '2023-05-03 06:25:05', '2023-05-03 06:25:05'),
	(12, 'Dolor quia eaque sit et aut qui cum et.', 2, '2023-05-03 06:25:05', '2023-05-03 06:25:05'),
	(13, 'Est deleniti exercitationem at quis dolorem omnis.', 7, '2023-05-03 06:25:05', '2023-05-03 06:25:05'),
	(14, 'Voluptatum iste ex minus deleniti est veritatis magni.', 8, '2023-05-03 06:25:05', '2023-05-03 06:25:05'),
	(15, 'Perferendis deleniti aut nam itaque sit accusamus voluptates.', 2, '2023-05-03 06:25:05', '2023-05-03 06:25:05'),
	(16, 'Totam non similique sed modi illo ipsam.', 5, '2023-05-03 06:25:05', '2023-05-03 06:25:05'),
	(17, 'Sapiente et non sequi omnis eum.', 2, '2023-05-03 06:25:05', '2023-05-03 06:25:05'),
	(18, 'Dicta aperiam aperiam odio beatae.', 9, '2023-05-03 06:25:05', '2023-05-03 06:25:05'),
	(19, 'Qui tenetur porro id dolores.', 1, '2023-05-03 06:25:05', '2023-05-03 06:25:05'),
	(20, 'Sistemas', 10, '2023-05-03 06:25:05', '2023-05-03 06:25:05'),
	(21, 'Voluptatem molestiae quo itaque.', 10, '2023-05-03 06:25:05', '2023-05-03 06:25:05'),
	(22, 'Eos maiores rerum eius accusamus similique et non.', 5, '2023-05-03 06:25:05', '2023-05-03 06:25:05'),
	(23, 'Ut minus assumenda praesentium quo.', 9, '2023-05-03 06:25:05', '2023-05-03 06:25:05'),
	(24, 'Perferendis dolore consequuntur inventore voluptatem veniam est omnis.', 4, '2023-05-03 06:25:06', '2023-05-03 06:25:06');

-- Dumping structure for table sistema_inscripcion_deportes.estados
CREATE TABLE IF NOT EXISTS `estados` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sistema_inscripcion_deportes.estados: ~3 rows (approximately)
INSERT INTO `estados` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'inscrito', NULL, NULL),
	(2, 'eliminado', NULL, NULL),
	(3, 'activo', NULL, NULL);

-- Dumping structure for table sistema_inscripcion_deportes.facultades
CREATE TABLE IF NOT EXISTS `facultades` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `sigla` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sistema_inscripcion_deportes.facultades: ~10 rows (approximately)
INSERT INTO `facultades` (`id`, `sigla`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'est', 'Ullam voluptatem enim aperiam temporibus commodi.', '2023-05-03 06:22:57', '2023-05-03 06:22:57'),
	(2, 'amet', 'Molestiae sunt excepturi consectetur sed adipisci voluptatibus atque iste.', '2023-05-03 06:22:57', '2023-05-03 06:22:57'),
	(3, 'ea', 'Corrupti debitis fugiat quasi voluptas.', '2023-05-03 06:22:57', '2023-05-03 06:22:57'),
	(4, 'alias', 'Ut qui libero nisi ipsum et quibusdam.', '2023-05-03 06:22:57', '2023-05-03 06:22:57'),
	(5, 'eius', 'Possimus in et a est sunt.', '2023-05-03 06:22:57', '2023-05-03 06:22:57'),
	(6, 'sit', 'Dolorem optio alias magni qui.', '2023-05-03 06:22:57', '2023-05-03 06:22:57'),
	(7, 'ipsam', 'Et temporibus eius quisquam et.', '2023-05-03 06:22:57', '2023-05-03 06:22:57'),
	(8, 'velit', 'Itaque fugit maxime cum.', '2023-05-03 06:22:57', '2023-05-03 06:22:57'),
	(9, 'eveniet', 'Eveniet quibusdam ipsum quae consequatur.', '2023-05-03 06:22:57', '2023-05-03 06:22:57'),
	(10, 'ipsum', 'FIMEES', '2023-05-03 06:22:58', '2023-05-03 06:22:58');

-- Dumping structure for table sistema_inscripcion_deportes.inscritos
CREATE TABLE IF NOT EXISTS `inscritos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ap_paterno` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ap_materno` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dni` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `escuela_id` bigint unsigned NOT NULL,
  `deporte_id` bigint unsigned NOT NULL,
  `estado_id` bigint unsigned NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `inscritos_user_id_foreign` (`user_id`),
  KEY `inscritos_escuela_id_foreign` (`escuela_id`),
  KEY `inscritos_deporte_id_foreign` (`deporte_id`),
  KEY `inscritos_estado_id_foreign` (`estado_id`),
  CONSTRAINT `inscritos_deporte_id_foreign` FOREIGN KEY (`deporte_id`) REFERENCES `deportes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `inscritos_escuela_id_foreign` FOREIGN KEY (`escuela_id`) REFERENCES `escuelas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `inscritos_estado_id_foreign` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`id`) ON DELETE CASCADE,
  CONSTRAINT `inscritos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=340 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sistema_inscripcion_deportes.inscritos: ~31 rows (approximately)
INSERT INTO `inscritos` (`id`, `codigo`, `name`, `ap_paterno`, `ap_materno`, `dni`, `user_id`, `escuela_id`, `deporte_id`, `estado_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(6, 'natus', 'quam', 'porro', 'voluptatem', '', 2, 19, 1, 1, NULL, '2023-05-04 00:43:15', '2023-05-04 00:43:15'),
	(8, 'in', 'incidunt', 'maiores', 'et', '', 3, 14, 1, 1, NULL, '2023-05-04 00:43:15', '2023-05-04 00:43:15'),
	(77, 'et', 'dolorem', 'recusandae', 'impedit', '', 1, 20, 1, 2, '2023-09-12 15:25:55', '2023-05-04 00:43:19', '2023-09-12 15:25:55'),
	(82, 'eos', 'itaque', 'fugit', 'ut', '', 1, 18, 1, 1, NULL, '2023-05-04 00:43:19', '2023-05-04 00:43:19'),
	(88, 'nesciunt', 'quae', 'cumque', 'nulla', '', 2, 22, 1, 1, NULL, '2023-05-04 00:43:20', '2023-05-04 00:43:20'),
	(128, 'ut', 'a', 'rerum', 'magnam', '', 3, 4, 1, 1, NULL, '2023-05-04 00:43:21', '2023-05-04 00:43:21'),
	(131, 'sit', 'consequatur', 'expedita', 'aliquid', '', 3, 21, 1, 1, NULL, '2023-05-04 00:43:22', '2023-05-04 00:43:22'),
	(133, 'reiciendis', 'odit', 'et', 'recusandae', '', 2, 23, 1, 1, NULL, '2023-05-04 00:43:22', '2023-05-04 00:43:22'),
	(147, 'aspernatur', 'consequatur', 'consequatur', 'ipsum', '', 3, 8, 1, 1, NULL, '2023-05-04 00:43:22', '2023-05-04 00:43:22'),
	(148, 'dolores', 'doloribus', 'debitis', 'optio', '', 3, 11, 1, 1, NULL, '2023-05-04 00:43:22', '2023-05-04 00:43:22'),
	(163, 'dicta', 'magni', 'et', 'aperiam', '', 3, 1, 1, 1, NULL, '2023-05-04 00:43:23', '2023-05-04 00:43:23'),
	(181, 'repudiandae', 'corrupti', 'totam', 'ea', '', 2, 17, 1, 1, NULL, '2023-05-04 00:43:26', '2023-05-04 00:43:26'),
	(220, 'totam', 'beatae', 'vitae', 'cumque', '', 1, 4, 1, 1, NULL, '2023-05-04 00:43:27', '2023-05-04 00:43:27'),
	(292, 'nobis', 'libero', 'eius', 'ipsa', '', 3, 11, 1, 1, NULL, '2023-05-04 00:43:31', '2023-05-04 00:43:31'),
	(307, '191106', 'safsdaf', 'safsadf', 'sadfasdf', '78451236', 1, 20, 1, 2, '2023-09-17 07:10:40', '2023-05-04 04:44:01', '2023-09-17 07:10:40'),
	(308, '191106', 'safasdf', 'asfsd', 'safwsadf', '', 1, 20, 1, 2, '2023-09-17 07:10:54', '2023-05-04 04:47:22', '2023-09-17 07:10:54'),
	(309, '190063', 'sfsd', 'saf', 'safs', '', 1, 20, 1, 2, '2023-09-17 07:12:16', '2023-05-04 04:48:19', '2023-09-17 07:12:16'),
	(310, '191106', 'fasfsa', 'fasfsa', 'fasfsa', '', 1, 20, 1, 2, '2023-09-17 07:13:08', '2023-05-04 04:48:53', '2023-09-17 07:13:08'),
	(311, '191106', 'sadfasdf', 'sadfasdf', 'sadfasdf', '00000000', 1, 20, 1, 1, NULL, '2023-05-04 04:58:59', '2023-09-17 07:06:39'),
	(326, '191106', 'deyvis', 'sss', 'test', '73905791', 1, 20, 1, 1, NULL, '2023-09-12 14:56:26', '2023-09-12 14:56:26'),
	(327, '191106', 'sss', 'sss', 'sss', '73905792', 1, 20, 1, 1, NULL, '2023-09-12 15:26:24', '2023-09-12 15:26:24'),
	(328, '191107', 'ss', 'ss', 'ss', '73568495', 1, 20, 1, 2, '2023-09-17 07:25:44', '2023-09-12 16:27:10', '2023-09-17 07:25:44'),
	(329, '000000', 'testing 1', 'testing 2', 'testing 3', '73905791', 1, 20, 1, 1, NULL, '2023-09-17 06:52:33', '2023-09-17 06:52:33'),
	(330, '000000', 'testing 1', 'testing 2', 'testing 3', '73905791', 1, 20, 1, 1, NULL, '2023-09-17 06:52:33', '2023-09-17 06:52:33'),
	(331, '000000', 'testing 1', 'testing 2', 'testing 3', '73905791', 1, 20, 1, 1, NULL, '2023-09-17 06:52:33', '2023-09-17 06:52:33'),
	(332, '000000', 'testing 1', 'testing 2', 'testing 3', '73905791', 1, 20, 1, 1, NULL, '2023-09-17 06:52:33', '2023-09-17 06:52:33'),
	(335, '000000', 'testing 1', 'testing 2', 'testing 3', '73905791', 1, 20, 1, 1, NULL, '2023-09-17 06:52:33', '2023-09-17 06:52:33'),
	(336, '000000', 'testing 1', 'testing 2', 'testing 3', '73905791', 1, 20, 1, 1, NULL, '2023-09-17 06:52:33', '2023-09-17 06:52:33'),
	(337, '000000', 'testing 1', 'testing 2 testing 2', 'testing 3', '73905791', 1, 20, 1, 1, NULL, '2023-09-17 06:52:33', '2023-09-17 06:52:33'),
	(338, '000000', 'testing 1', 'testing 2', 'testing 3', '73905791', 1, 20, 1, 1, NULL, '2023-09-17 06:52:33', '2023-09-17 06:52:33'),
	(339, '000000', 'testing 1', 'testing 2', 'testing 3', '73905791', 1, 20, 1, 1, NULL, '2023-09-17 06:52:33', '2023-09-17 06:52:33');

-- Dumping structure for table sistema_inscripcion_deportes.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sistema_inscripcion_deportes.migrations: ~10 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(2, '2023_05_03_000505_create_facultades_table', 1),
	(3, '2023_05_03_000533_create_escuelas_table', 1),
	(4, '2023_05_03_001230_create_tipos_table', 1),
	(5, '2023_05_03_002303_create_users_table', 1),
	(6, '2023_05_03_122821_create_roles_table', 2),
	(7, '2023_05_03_122830_create_estados_table', 2),
	(9, '2023_05_03_122836_create_accesos_table', 3),
	(10, '2023_05_03_172828_create_deportes_table', 4),
	(13, '2023_05_03_172840_create_inscritos_table', 5);

-- Dumping structure for table sistema_inscripcion_deportes.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `route_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sistema_inscripcion_deportes.permissions: ~3 rows (approximately)
INSERT INTO `permissions` (`id`, `name`, `route_name`, `created_at`, `updated_at`) VALUES
	(1, 'Inscripción Judadores', 'inscription.index', NULL, NULL),
	(2, 'Reporte de Jugadores', 'reporte_jugadores.index', NULL, NULL),
	(3, 'Inscripción Delegados', 'delegado.index', NULL, NULL);

-- Dumping structure for table sistema_inscripcion_deportes.permission_role
CREATE TABLE IF NOT EXISTS `permission_role` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint unsigned NOT NULL DEFAULT '0',
  `permission_id` bigint unsigned NOT NULL DEFAULT '0',
  `state_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_id_fk1` (`role_id`),
  KEY `permission_id_fk1` (`permission_id`),
  KEY `state_id_fk1` (`state_id`),
  CONSTRAINT `permission_id_fk1` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`),
  CONSTRAINT `role_id_fk1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  CONSTRAINT `state_id_fk1` FOREIGN KEY (`state_id`) REFERENCES `estados` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table sistema_inscripcion_deportes.permission_role: ~3 rows (approximately)
INSERT INTO `permission_role` (`id`, `role_id`, `permission_id`, `state_id`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 3, NULL, NULL),
	(2, 1, 3, 3, NULL, NULL),
	(3, 2, 2, 3, NULL, NULL);

-- Dumping structure for table sistema_inscripcion_deportes.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sistema_inscripcion_deportes.roles: ~2 rows (approximately)
INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'delegado', NULL, NULL),
	(2, 'organizador', NULL, NULL);

-- Dumping structure for table sistema_inscripcion_deportes.role_user
CREATE TABLE IF NOT EXISTS `role_user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL DEFAULT '0',
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_fk` (`user_id`),
  KEY `role_id_fk` (`role_id`),
  CONSTRAINT `role_id_fk` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  CONSTRAINT `user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table sistema_inscripcion_deportes.role_user: ~0 rows (approximately)
INSERT INTO `role_user` (`id`, `user_id`, `role_id`) VALUES
	(2, 1, 1);

-- Dumping structure for table sistema_inscripcion_deportes.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ap_paterno` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ap_materno` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `escuela_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_user_unique` (`user`),
  KEY `users_escuela_id_foreign` (`escuela_id`),
  CONSTRAINT `users_escuela_id_foreign` FOREIGN KEY (`escuela_id`) REFERENCES `escuelas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sistema_inscripcion_deportes.users: ~4 rows (approximately)
INSERT INTO `users` (`id`, `user`, `password`, `name`, `ap_paterno`, `ap_materno`, `escuela_id`, `created_at`, `updated_at`) VALUES
	(1, 'deyvis', '$2y$10$tjow9iMR0Eg6xHlaFkeCGOX15mg6F7mSCESbji9wfaesownDnjFjq', 'deyvis', 'mamani', 'lacuta', 20, '2023-05-03 07:50:56', '2023-05-03 07:50:56'),
	(2, 'juan1', '$2y$10$14AUXS4djpVfswyDgdqVJ..Pgob/aBsFVgqBPRQsrshM1oPV0q9IS', 'juan', 'juan', 'juan', 22, '2023-05-03 07:55:53', '2023-05-03 07:55:53'),
	(3, 'alex1', '$2y$10$JWeDHk9AiOu.oxljm8AVkuXM7e3/fQCt3OXg8OWyO4D0hsRYhIbbe', 'alex', 'alex', 'alex', 11, '2023-05-03 07:58:42', '2023-05-03 07:58:42'),
	(7, 'test', '$2a$12$NZrK/Uh.VX7KbxluoxBDmuP07QtzWe25Jg8zS7vopYVeXLwycEvDW', '', '', '', 4, NULL, NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
