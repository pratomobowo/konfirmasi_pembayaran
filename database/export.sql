-- SQLite to MySQL export generated on 2025-05-20 04:22:00
-- This file contains CREATE TABLE statements and INSERT data

SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` datetime NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(255) NULL,
  `created_at` datetime NULL,
  `updated_at` datetime NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'Admin', 'admin@example.com', NULL, '$2y$12$oh0iHqxdHifg4Tr/3zskROlzckNdDvXwzMDhl1dou6OUsCfhl5IoG', NULL, '2025-05-16 06:53:01', '2025-05-16 17:05:30', 'super_admin'),
(2, 'Super Admin', 'superadmin@example.com', NULL, '$2y$12$cfQmzb.vROiPTqh5RFx4R.EI6gRQst5rgivYKfJVGQVoqalv52WVy', NULL, '2025-05-17 05:15:51', '2025-05-17 05:15:51', 'super_admin'),
(3, 'Admin Keuangan', 'finance@example.com', NULL, '$2y$12$5perCVANVGKCCkmMIPkcfeCZUUhD7uYOONUjirPfA5oYLxLltWSQO', NULL, '2025-05-17 05:15:52', '2025-05-18 11:49:31', 'admin_keuangan');

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` datetime NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` int(11) NULL,
  `ip_address` varchar(255) NULL,
  `user_agent` text NULL,
  `payload` text NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('8GVk6SGiTLFymM46fYKhCfMhwMeGfaGuh38jixH8', 1, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRHNudU9RU3doWXFJRHlCQ1JhZEF1T3RHTGI3bkRRdXBDNjlMNGJzaCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1747640998),
('tzhfdyyoDW0etqCCTZYzMnNvUdtGJC9E5Pf3bDvB', NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYlk1aFA3d1dFZVVLbmpWUVMxQzNidlJ5UEpVVmV4MkJQeERFazd0OCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1747712087),
('wZMnHbLc56BczdDwluiX6m8EXLAmeSYPTLwMwHI8', 1, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicktPSnQ0aExNN3lwQ1JLQnppQW1xYTZzVEVTdzZpVGFRV1U4NmlGdyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1747714235);

DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` text NOT NULL,
  `attempts` int(11) NOT NULL,
  `reserved_at` int(11) NULL,
  `available_at` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` text NOT NULL,
  `options` text NULL,
  `cancelled_at` int(11) NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` int(11) NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` text NOT NULL,
  `exception` text NOT NULL,
  `failed_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `payments`;
CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `nim` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NULL,
  `payment_type` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_proof` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `notes` text NULL,
  `verified_at` datetime NULL,
  `created_at` datetime NULL,
  `updated_at` datetime NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `payments` (`id`, `student_name`, `nim`, `email`, `phone_number`, `payment_type`, `amount`, `payment_proof`, `status`, `notes`, `verified_at`, `created_at`, `updated_at`) VALUES
(1, 'Pratomo bowo', '6311055', 'pratomobowo@gmail.com', '082215711850', 'Praktikum', 200000, 'payment_proofs/z1qhnAasYVFC9V4bWGkCiNwPWdtRzX8TRgsZgBRB.jpg', 'verified', NULL, '2025-05-16 17:48:45', '2025-05-16 15:36:21', '2025-05-16 17:48:45'),
(2, 'Asiyah', '6311050', 'asiyah@gmail.com', '0822222222', 'SPP', 1800000, 'payment_proofs/JPxz4GwQsFJSEJxTsPZrDW3oWMU8m7aVcRzIUSZc.png', 'rejected', 'Bukti Transfer tidak valid', NULL, '2025-05-17 07:18:04', '2025-05-17 07:18:51'),
(3, 'Fatimah Zahira', '123456', 'zahira@gmail.com', '082213311331', 'Praktikum', 2000000, 'payment_proofs/v9ao82Nhkm4TKm4T3hyH9g37FrA3Qjjd0sxuuzJZ.png', 'pending', NULL, NULL, '2025-05-17 15:54:44', '2025-05-17 15:54:44'),
(4, 'Cici', '6311054', 'bowo@usbypkp.ac.id', '080808080', 'Praktikum', 150000, 'payment_proofs/Up1SRWHbFEAlwFITdEQ7aFPDxLfPeSyXVEcLhgS7.jpg', 'verified', NULL, '2025-05-18 01:10:04', '2025-05-18 01:03:31', '2025-05-18 01:10:04'),
(5, 'Cici', '6311054', 'bowo@usbypkp.ac.id', '080808080', 'Praktikum', 150000, 'payment_proofs/w1eKjcb3Q479imiBUbOU80yDOgQClBii7RkfSSZX.jpg', 'rejected', 'kacau sih', NULL, '2025-05-18 01:08:45', '2025-05-18 11:53:08'),
(6, 'bbh', '12345', 'bowo@usbypkp.ac.id', '1234', 'SPP', 20000, 'payment_proofs/aMpt1jTlt8yzxOYoQVc7V5TLvjfXQV9yH118Y9Mb.png', 'rejected', 'karena', NULL, '2025-05-18 12:00:13', '2025-05-18 12:00:54'),
(7, 'bowo', '6311055', 'bowo@usbypkp.ac.id', '020202020', 'Praktikum', 522222, 'payment_proofs/MqCjqDt4bibsjQrHfTCaUafcgQcqZEuwPnzttBZv.png', 'rejected', 'salah gambar', NULL, '2025-05-19 07:46:07', '2025-05-19 07:46:45');

DROP TABLE IF EXISTS `payment_types`;
CREATE TABLE `payment_types` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NULL,
  `is_active` text NOT NULL DEFAULT '1',
  `created_at` datetime NULL,
  `updated_at` datetime NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `payment_types` (`id`, `name`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'SPP', 'Biaya Sumbangan Pembinaan Pendidikan', '1', '2025-05-17 06:21:12', '2025-05-17 06:21:12'),
(2, 'Praktikum', 'Biaya kegiatan praktikum', '1', '2025-05-17 06:21:12', '2025-05-17 06:21:12'),
(3, 'Ujian', 'Biaya ujian semester', '1', '2025-05-17 06:21:12', '2025-05-17 06:21:12'),
(4, 'Wisuda', 'Biaya wisuda dan kelengkapannya', '1', '2025-05-17 06:21:12', '2025-05-17 06:21:12'),
(5, 'Lainnya', 'Jenis pembayaran lainnya', '1', '2025-05-17 06:21:12', '2025-05-17 06:21:12');

DROP TABLE IF EXISTS `activity_logs`;
CREATE TABLE `activity_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NULL,
  `user_name` varchar(255) NULL,
  `user_role` varchar(255) NULL,
  `action` varchar(255) NOT NULL,
  `module` varchar(255) NOT NULL,
  `reference_id` varchar(255) NULL,
  `description` text NULL,
  `old_values` text NULL,
  `new_values` text NULL,
  `ip_address` varchar(255) NULL,
  `user_agent` varchar(255) NULL,
  `created_at` datetime NULL,
  `updated_at` datetime NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `activity_logs` (`id`, `user_id`, `user_name`, `user_role`, `action`, `module`, `reference_id`, `description`, `old_values`, `new_values`, `ip_address`, `user_agent`, `created_at`, `updated_at`) VALUES
(1, 1, 'Admin', 'super_admin', 'login', 'auth', NULL, 'User Admin berhasil login', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', '2025-05-18 00:01:56', '2025-05-18 00:01:56'),
(2, 1, 'Admin', 'super_admin', 'login', 'auth', NULL, 'User Admin berhasil login', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', '2025-05-18 00:01:56', '2025-05-18 00:01:56'),
(3, 1, 'Admin', 'super_admin', 'create', 'payment', '4', 'Pembayaran baru dibuat untuk Cici (NIM: 6311054)', NULL, '{"student_name":"Cici","nim":"6311054","email":"bowo@usbypkp.ac.id","phone_number":"080808080","payment_type":"Praktikum","amount":"150000.00","payment_proof":"payment_proofs\/Up1SRWHbFEAlwFITdEQ7aFPDxLfPeSyXVEcLhgS7.jpg","status":"pending","updated_at":"2025-05-18T01:03:31.000000Z","created_at":"2025-05-18T01:03:31.000000Z","id":4}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', '2025-05-18 01:03:32', '2025-05-18 01:03:32'),
(4, 1, 'Admin', 'super_admin', 'create', 'payment', '5', 'Pembayaran baru dibuat untuk Cici (NIM: 6311054)', NULL, '{"student_name":"Cici","nim":"6311054","email":"bowo@usbypkp.ac.id","phone_number":"080808080","payment_type":"Praktikum","amount":"150000.00","payment_proof":"payment_proofs\/w1eKjcb3Q479imiBUbOU80yDOgQClBii7RkfSSZX.jpg","status":"pending","updated_at":"2025-05-18T01:08:45.000000Z","created_at":"2025-05-18T01:08:45.000000Z","id":5}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', '2025-05-18 01:08:45', '2025-05-18 01:08:45'),
(5, 1, 'Admin', 'super_admin', 'update', 'payment', '4', 'Pembayaran untuk Cici (NIM: 6311054) telah diverifikasi', '{"id":4,"student_name":"Cici","nim":"6311054","email":"bowo@usbypkp.ac.id","phone_number":"080808080","payment_type":"Praktikum","amount":"150000.00","payment_proof":"payment_proofs\/Up1SRWHbFEAlwFITdEQ7aFPDxLfPeSyXVEcLhgS7.jpg","status":"pending","notes":null,"verified_at":null,"created_at":"2025-05-18T01:03:31.000000Z","updated_at":"2025-05-18T01:03:31.000000Z"}', '{"id":4,"student_name":"Cici","nim":"6311054","email":"bowo@usbypkp.ac.id","phone_number":"080808080","payment_type":"Praktikum","amount":"150000.00","payment_proof":"payment_proofs\/Up1SRWHbFEAlwFITdEQ7aFPDxLfPeSyXVEcLhgS7.jpg","status":"verified","notes":null,"verified_at":"2025-05-18T01:10:04.000000Z","created_at":"2025-05-18T01:03:31.000000Z","updated_at":"2025-05-18T01:10:04.000000Z"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', '2025-05-18 01:10:04', '2025-05-18 01:10:04'),
(6, 1, 'Admin', 'super_admin', 'login', 'auth', NULL, 'User Admin berhasil login', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', '2025-05-18 11:41:55', '2025-05-18 11:41:55'),
(7, 1, 'Admin', 'super_admin', 'login', 'auth', NULL, 'User Admin berhasil login', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', '2025-05-18 11:41:55', '2025-05-18 11:41:55'),
(8, 1, 'Admin', 'super_admin', 'update', 'payment', '5', 'Pembayaran untuk Cici (NIM: 6311054) telah ditolak dengan catatan: kacau sih', '{"id":5,"student_name":"Cici","nim":"6311054","email":"bowo@usbypkp.ac.id","phone_number":"080808080","payment_type":"Praktikum","amount":"150000.00","payment_proof":"payment_proofs\/w1eKjcb3Q479imiBUbOU80yDOgQClBii7RkfSSZX.jpg","status":"pending","notes":null,"verified_at":null,"created_at":"2025-05-18T01:08:45.000000Z","updated_at":"2025-05-18T01:08:45.000000Z"}', '{"id":5,"student_name":"Cici","nim":"6311054","email":"bowo@usbypkp.ac.id","phone_number":"080808080","payment_type":"Praktikum","amount":"150000.00","payment_proof":"payment_proofs\/w1eKjcb3Q479imiBUbOU80yDOgQClBii7RkfSSZX.jpg","status":"rejected","notes":"kacau sih","verified_at":null,"created_at":"2025-05-18T01:08:45.000000Z","updated_at":"2025-05-18T11:53:08.000000Z"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', '2025-05-18 11:53:08', '2025-05-18 11:53:08'),
(9, 1, 'Admin', 'super_admin', 'create', 'payment', '6', 'Pembayaran baru dibuat untuk bbh (NIM: 12345)', NULL, '{"student_name":"bbh","nim":"12345","email":"bowo@usbypkp.ac.id","phone_number":"1234","payment_type":"SPP","amount":"20000.00","payment_proof":"payment_proofs\/aMpt1jTlt8yzxOYoQVc7V5TLvjfXQV9yH118Y9Mb.png","status":"pending","updated_at":"2025-05-18T12:00:13.000000Z","created_at":"2025-05-18T12:00:13.000000Z","id":6}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', '2025-05-18 12:00:13', '2025-05-18 12:00:13'),
(10, 1, 'Admin', 'super_admin', 'update', 'payment', '6', 'Pembayaran untuk bbh (NIM: 12345) telah ditolak dengan catatan: karena', '{"id":6,"student_name":"bbh","nim":"12345","email":"bowo@usbypkp.ac.id","phone_number":"1234","payment_type":"SPP","amount":"20000.00","payment_proof":"payment_proofs\/aMpt1jTlt8yzxOYoQVc7V5TLvjfXQV9yH118Y9Mb.png","status":"pending","notes":null,"verified_at":null,"created_at":"2025-05-18T12:00:13.000000Z","updated_at":"2025-05-18T12:00:13.000000Z"}', '{"id":6,"student_name":"bbh","nim":"12345","email":"bowo@usbypkp.ac.id","phone_number":"1234","payment_type":"SPP","amount":"20000.00","payment_proof":"payment_proofs\/aMpt1jTlt8yzxOYoQVc7V5TLvjfXQV9yH118Y9Mb.png","status":"rejected","notes":"karena","verified_at":null,"created_at":"2025-05-18T12:00:13.000000Z","updated_at":"2025-05-18T12:00:54.000000Z"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', '2025-05-18 12:00:54', '2025-05-18 12:00:54'),
(11, 1, 'Admin', 'super_admin', 'login', 'auth', NULL, 'User Admin berhasil login', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', '2025-05-19 07:27:48', '2025-05-19 07:27:48'),
(12, 1, 'Admin', 'super_admin', 'login', 'auth', NULL, 'User Admin berhasil login', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', '2025-05-19 07:27:48', '2025-05-19 07:27:48'),
(13, 1, 'Admin', 'super_admin', 'create', 'payment', '7', 'Pembayaran baru dibuat untuk bowo (NIM: 6311055)', NULL, '{"student_name":"bowo","nim":"6311055","email":"bowo@usbypkp.ac.id","phone_number":"020202020","payment_type":"Praktikum","amount":"522222.00","payment_proof":"payment_proofs\/MqCjqDt4bibsjQrHfTCaUafcgQcqZEuwPnzttBZv.png","status":"pending","updated_at":"2025-05-19T07:46:07.000000Z","created_at":"2025-05-19T07:46:07.000000Z","id":7}', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', '2025-05-19 07:46:07', '2025-05-19 07:46:07'),
(14, 1, 'Admin', 'super_admin', 'update', 'payment', '7', 'Pembayaran untuk bowo (NIM: 6311055) telah ditolak dengan catatan: salah gambar', '{"id":7,"student_name":"bowo","nim":"6311055","email":"bowo@usbypkp.ac.id","phone_number":"020202020","payment_type":"Praktikum","amount":"522222.00","payment_proof":"payment_proofs\/MqCjqDt4bibsjQrHfTCaUafcgQcqZEuwPnzttBZv.png","status":"pending","notes":null,"verified_at":null,"created_at":"2025-05-19T07:46:07.000000Z","updated_at":"2025-05-19T07:46:07.000000Z"}', '{"id":7,"student_name":"bowo","nim":"6311055","email":"bowo@usbypkp.ac.id","phone_number":"020202020","payment_type":"Praktikum","amount":"522222.00","payment_proof":"payment_proofs\/MqCjqDt4bibsjQrHfTCaUafcgQcqZEuwPnzttBZv.png","status":"rejected","notes":"salah gambar","verified_at":null,"created_at":"2025-05-19T07:46:07.000000Z","updated_at":"2025-05-19T07:46:45.000000Z"}', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', '2025-05-19 07:46:45', '2025-05-19 07:46:45'),
(15, 1, 'Admin', 'super_admin', 'login', 'auth', NULL, 'User Admin berhasil login', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', '2025-05-20 03:34:59', '2025-05-20 03:34:59'),
(16, 1, 'Admin', 'super_admin', 'login', 'auth', NULL, 'User Admin berhasil login', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', '2025-05-20 03:34:59', '2025-05-20 03:34:59');

DROP TABLE IF EXISTS `email_templates`;
CREATE TABLE `email_templates` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `trigger_type` varchar(255) NOT NULL,
  `is_active` text NOT NULL DEFAULT '1',
  `created_at` datetime NULL,
  `updated_at` datetime NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `email_templates` (`id`, `name`, `subject`, `body`, `trigger_type`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Pembayaran Ditolak', 'Pembayaran anda ditolak!', 'Halo {nama}, pembayaran anda di tolak', 'payment_rejected', '1', '2025-05-18 11:52:41', '2025-05-18 11:52:41');

DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text NULL,
  `group` varchar(255) NULL,
  `description` varchar(255) NULL,
  `created_at` datetime NULL,
  `updated_at` datetime NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `settings` (`id`, `key`, `value`, `group`, `description`, `created_at`, `updated_at`) VALUES
(1, 'mail_mailer', 'smtp', 'smtp', NULL, '2025-05-18 11:51:06', '2025-05-18 11:51:06'),
(2, 'mail_host', 'smtp.gmail.com', 'smtp', NULL, '2025-05-18 11:51:06', '2025-05-18 11:51:06'),
(3, 'mail_port', '587', 'smtp', NULL, '2025-05-18 11:51:06', '2025-05-18 11:51:06'),
(4, 'mail_username', 'noreply@usbypkp.ac.id', 'smtp', NULL, '2025-05-18 11:51:06', '2025-05-18 11:51:06'),
(5, 'mail_password', 'dsxnkmgjcvduoxnq', 'smtp', NULL, '2025-05-18 11:51:06', '2025-05-18 11:51:06'),
(6, 'mail_encryption', 'tls', 'smtp', NULL, '2025-05-18 11:51:06', '2025-05-18 11:51:06'),
(7, 'mail_from_address', 'noreply@usbypkp.ac.id', 'smtp', NULL, '2025-05-18 11:51:06', '2025-05-18 11:51:06'),
(8, 'mail_from_name', 'USBYPKP', 'smtp', NULL, '2025-05-18 11:51:06', '2025-05-18 11:51:06');

SET FOREIGN_KEY_CHECKS=1;
