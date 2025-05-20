-- SQLite to MySQL Data Migration
-- Generated on 2025-05-20 05:41:28

SET FOREIGN_KEY_CHECKS=0;

-- Table data for `activity_logs`
INSERT INTO `activity_logs` (`id`, `user_id`, `user_name`, `user_role`, `action`, `module`, `reference_id`, `description`, `old_values`, `new_values`, `ip_address`, `user_agent`, `created_at`, `updated_at`) VALUES
('1', '1', 'Admin', 'super_admin', 'login', 'auth', NULL, 'User Admin berhasil login', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', '2025-05-18 00:01:56', '2025-05-18 00:01:56'),
('2', '1', 'Admin', 'super_admin', 'login', 'auth', NULL, 'User Admin berhasil login', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', '2025-05-18 00:01:56', '2025-05-18 00:01:56'),
('3', '1', 'Admin', 'super_admin', 'create', 'payment', '4', 'Pembayaran baru dibuat untuk Cici (NIM: 6311054)', NULL, '{"student_name":"Cici","nim":"6311054","email":"bowo@usbypkp.ac.id","phone_number":"080808080","payment_type":"Praktikum","amount":"150000.00","payment_proof":"payment_proofs\\/Up1SRWHbFEAlwFITdEQ7aFPDxLfPeSyXVEcLhgS7.jpg","status":"pending","updated_at":"2025-05-18T01:03:31.000000Z","created_at":"2025-05-18T01:03:31.000000Z","id":4}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', '2025-05-18 01:03:32', '2025-05-18 01:03:32'),
('4', '1', 'Admin', 'super_admin', 'create', 'payment', '5', 'Pembayaran baru dibuat untuk Cici (NIM: 6311054)', NULL, '{"student_name":"Cici","nim":"6311054","email":"bowo@usbypkp.ac.id","phone_number":"080808080","payment_type":"Praktikum","amount":"150000.00","payment_proof":"payment_proofs\\/w1eKjcb3Q479imiBUbOU80yDOgQClBii7RkfSSZX.jpg","status":"pending","updated_at":"2025-05-18T01:08:45.000000Z","created_at":"2025-05-18T01:08:45.000000Z","id":5}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', '2025-05-18 01:08:45', '2025-05-18 01:08:45'),
('5', '1', 'Admin', 'super_admin', 'update', 'payment', '4', 'Pembayaran untuk Cici (NIM: 6311054) telah diverifikasi', '{"id":4,"student_name":"Cici","nim":"6311054","email":"bowo@usbypkp.ac.id","phone_number":"080808080","payment_type":"Praktikum","amount":"150000.00","payment_proof":"payment_proofs\\/Up1SRWHbFEAlwFITdEQ7aFPDxLfPeSyXVEcLhgS7.jpg","status":"pending","notes":null,"verified_at":null,"created_at":"2025-05-18T01:03:31.000000Z","updated_at":"2025-05-18T01:03:31.000000Z"}', '{"id":4,"student_name":"Cici","nim":"6311054","email":"bowo@usbypkp.ac.id","phone_number":"080808080","payment_type":"Praktikum","amount":"150000.00","payment_proof":"payment_proofs\\/Up1SRWHbFEAlwFITdEQ7aFPDxLfPeSyXVEcLhgS7.jpg","status":"verified","notes":null,"verified_at":"2025-05-18T01:10:04.000000Z","created_at":"2025-05-18T01:03:31.000000Z","updated_at":"2025-05-18T01:10:04.000000Z"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', '2025-05-18 01:10:04', '2025-05-18 01:10:04'),
('6', '1', 'Admin', 'super_admin', 'login', 'auth', NULL, 'User Admin berhasil login', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', '2025-05-18 11:41:55', '2025-05-18 11:41:55'),
('7', '1', 'Admin', 'super_admin', 'login', 'auth', NULL, 'User Admin berhasil login', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', '2025-05-18 11:41:55', '2025-05-18 11:41:55'),
('8', '1', 'Admin', 'super_admin', 'update', 'payment', '5', 'Pembayaran untuk Cici (NIM: 6311054) telah ditolak dengan catatan: kacau sih', '{"id":5,"student_name":"Cici","nim":"6311054","email":"bowo@usbypkp.ac.id","phone_number":"080808080","payment_type":"Praktikum","amount":"150000.00","payment_proof":"payment_proofs\\/w1eKjcb3Q479imiBUbOU80yDOgQClBii7RkfSSZX.jpg","status":"pending","notes":null,"verified_at":null,"created_at":"2025-05-18T01:08:45.000000Z","updated_at":"2025-05-18T01:08:45.000000Z"}', '{"id":5,"student_name":"Cici","nim":"6311054","email":"bowo@usbypkp.ac.id","phone_number":"080808080","payment_type":"Praktikum","amount":"150000.00","payment_proof":"payment_proofs\\/w1eKjcb3Q479imiBUbOU80yDOgQClBii7RkfSSZX.jpg","status":"rejected","notes":"kacau sih","verified_at":null,"created_at":"2025-05-18T01:08:45.000000Z","updated_at":"2025-05-18T11:53:08.000000Z"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', '2025-05-18 11:53:08', '2025-05-18 11:53:08'),
('9', '1', 'Admin', 'super_admin', 'create', 'payment', '6', 'Pembayaran baru dibuat untuk bbh (NIM: 12345)', NULL, '{"student_name":"bbh","nim":"12345","email":"bowo@usbypkp.ac.id","phone_number":"1234","payment_type":"SPP","amount":"20000.00","payment_proof":"payment_proofs\\/aMpt1jTlt8yzxOYoQVc7V5TLvjfXQV9yH118Y9Mb.png","status":"pending","updated_at":"2025-05-18T12:00:13.000000Z","created_at":"2025-05-18T12:00:13.000000Z","id":6}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', '2025-05-18 12:00:13', '2025-05-18 12:00:13'),
('10', '1', 'Admin', 'super_admin', 'update', 'payment', '6', 'Pembayaran untuk bbh (NIM: 12345) telah ditolak dengan catatan: karena', '{"id":6,"student_name":"bbh","nim":"12345","email":"bowo@usbypkp.ac.id","phone_number":"1234","payment_type":"SPP","amount":"20000.00","payment_proof":"payment_proofs\\/aMpt1jTlt8yzxOYoQVc7V5TLvjfXQV9yH118Y9Mb.png","status":"pending","notes":null,"verified_at":null,"created_at":"2025-05-18T12:00:13.000000Z","updated_at":"2025-05-18T12:00:13.000000Z"}', '{"id":6,"student_name":"bbh","nim":"12345","email":"bowo@usbypkp.ac.id","phone_number":"1234","payment_type":"SPP","amount":"20000.00","payment_proof":"payment_proofs\\/aMpt1jTlt8yzxOYoQVc7V5TLvjfXQV9yH118Y9Mb.png","status":"rejected","notes":"karena","verified_at":null,"created_at":"2025-05-18T12:00:13.000000Z","updated_at":"2025-05-18T12:00:54.000000Z"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', '2025-05-18 12:00:54', '2025-05-18 12:00:54'),
('11', '1', 'Admin', 'super_admin', 'login', 'auth', NULL, 'User Admin berhasil login', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', '2025-05-19 07:27:48', '2025-05-19 07:27:48'),
('12', '1', 'Admin', 'super_admin', 'login', 'auth', NULL, 'User Admin berhasil login', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', '2025-05-19 07:27:48', '2025-05-19 07:27:48'),
('13', '1', 'Admin', 'super_admin', 'create', 'payment', '7', 'Pembayaran baru dibuat untuk bowo (NIM: 6311055)', NULL, '{"student_name":"bowo","nim":"6311055","email":"bowo@usbypkp.ac.id","phone_number":"020202020","payment_type":"Praktikum","amount":"522222.00","payment_proof":"payment_proofs\\/MqCjqDt4bibsjQrHfTCaUafcgQcqZEuwPnzttBZv.png","status":"pending","updated_at":"2025-05-19T07:46:07.000000Z","created_at":"2025-05-19T07:46:07.000000Z","id":7}', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', '2025-05-19 07:46:07', '2025-05-19 07:46:07'),
('14', '1', 'Admin', 'super_admin', 'update', 'payment', '7', 'Pembayaran untuk bowo (NIM: 6311055) telah ditolak dengan catatan: salah gambar', '{"id":7,"student_name":"bowo","nim":"6311055","email":"bowo@usbypkp.ac.id","phone_number":"020202020","payment_type":"Praktikum","amount":"522222.00","payment_proof":"payment_proofs\\/MqCjqDt4bibsjQrHfTCaUafcgQcqZEuwPnzttBZv.png","status":"pending","notes":null,"verified_at":null,"created_at":"2025-05-19T07:46:07.000000Z","updated_at":"2025-05-19T07:46:07.000000Z"}', '{"id":7,"student_name":"bowo","nim":"6311055","email":"bowo@usbypkp.ac.id","phone_number":"020202020","payment_type":"Praktikum","amount":"522222.00","payment_proof":"payment_proofs\\/MqCjqDt4bibsjQrHfTCaUafcgQcqZEuwPnzttBZv.png","status":"rejected","notes":"salah gambar","verified_at":null,"created_at":"2025-05-19T07:46:07.000000Z","updated_at":"2025-05-19T07:46:45.000000Z"}', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', '2025-05-19 07:46:45', '2025-05-19 07:46:45'),
('15', '1', 'Admin', 'super_admin', 'login', 'auth', NULL, 'User Admin berhasil login', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', '2025-05-20 03:34:59', '2025-05-20 03:34:59'),
('16', '1', 'Admin', 'super_admin', 'login', 'auth', NULL, 'User Admin berhasil login', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', '2025-05-20 03:34:59', '2025-05-20 03:34:59'),
('17', '1', 'Admin', 'super_admin', 'create', 'payment_type', '6', 'Jenis pembayaran baru \'test\' telah dibuat', NULL, '{"name":"test","description":"test","is_active":false,"updated_at":"2025-05-20T04:38:54.000000Z","created_at":"2025-05-20T04:38:54.000000Z","id":6}', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', '2025-05-20 04:38:54', '2025-05-20 04:38:54'),
('18', '1', 'Admin', 'super_admin', 'update', 'payment_type', '6', 'Jenis pembayaran \'test\' telah diperbarui', '{"id":6,"name":"test","description":"test","is_active":false,"created_at":"2025-05-20T04:38:54.000000Z","updated_at":"2025-05-20T04:38:54.000000Z"}', '{"id":6,"name":"test","description":"test","is_active":true,"created_at":"2025-05-20T04:38:54.000000Z","updated_at":"2025-05-20T04:40:38.000000Z"}', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', '2025-05-20 04:40:38', '2025-05-20 04:40:38');

-- Table data for `email_templates`
INSERT INTO `email_templates` (`id`, `name`, `subject`, `body`, `trigger_type`, `is_active`, `created_at`, `updated_at`) VALUES
('1', 'Pembayaran Ditolak', 'Pembayaran anda ditolak!', 'Halo {nama}, pembayaran anda di tolak', 'payment_rejected', '1', '2025-05-18 11:52:41', '2025-05-18 11:52:41');

-- Table data for `migrations`
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
('1', '0001_01_01_000000_create_users_table', '1'),
('2', '0001_01_01_000001_create_cache_table', '1'),
('3', '0001_01_01_000002_create_jobs_table', '1'),
('4', '2025_05_16_063541_create_payments_table', '1'),
('5', '2025_05_16_165956_add_role_to_users_table', '2'),
('6', '2025_05_17_060633_create_payment_types_table', '3'),
('7', '2025_05_17_063211_create_settings_table', '4'),
('8', '2025_05_17_231045_create_activity_logs_table', '5'),
('10', '2024_03_21_000000_create_email_templates_table', '6'),
('11', '2025_05_18_010623_remove_unique_constraint_from_nim_in_payments_table', '7'),
('12', '2025_05_18_010653_remove_unique_constraint_from_nim_in_payments_table', '7'),
('13', '2024_03_21_create_settings_table', '8');

-- Table data for `payment_types`
INSERT INTO `payment_types` (`id`, `name`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
('1', 'SPP', 'Biaya Sumbangan Pembinaan Pendidikan', '1', '2025-05-17 06:21:12', '2025-05-17 06:21:12'),
('2', 'Praktikum', 'Biaya kegiatan praktikum', '1', '2025-05-17 06:21:12', '2025-05-17 06:21:12'),
('3', 'Ujian', 'Biaya ujian semester', '1', '2025-05-17 06:21:12', '2025-05-17 06:21:12'),
('4', 'Wisuda', 'Biaya wisuda dan kelengkapannya', '1', '2025-05-17 06:21:12', '2025-05-17 06:21:12'),
('5', 'Lainnya', 'Jenis pembayaran lainnya', '1', '2025-05-17 06:21:12', '2025-05-17 06:21:12'),
('6', 'test', 'test', '1', '2025-05-20 04:38:54', '2025-05-20 04:40:38');

-- Table data for `payments`
INSERT INTO `payments` (`id`, `student_name`, `nim`, `email`, `phone_number`, `payment_type`, `amount`, `payment_proof`, `status`, `notes`, `verified_at`, `created_at`, `updated_at`) VALUES
('1', 'Pratomo bowo', '6311055', 'pratomobowo@gmail.com', '082215711850', 'Praktikum', '200000', 'payment_proofs/z1qhnAasYVFC9V4bWGkCiNwPWdtRzX8TRgsZgBRB.jpg', 'verified', NULL, '2025-05-16 17:48:45', '2025-05-16 15:36:21', '2025-05-16 17:48:45'),
('2', 'Asiyah', '6311050', 'asiyah@gmail.com', '0822222222', 'SPP', '1800000', 'payment_proofs/JPxz4GwQsFJSEJxTsPZrDW3oWMU8m7aVcRzIUSZc.png', 'rejected', 'Bukti Transfer tidak valid', NULL, '2025-05-17 07:18:04', '2025-05-17 07:18:51'),
('3', 'Fatimah Zahira', '123456', 'zahira@gmail.com', '082213311331', 'Praktikum', '2000000', 'payment_proofs/v9ao82Nhkm4TKm4T3hyH9g37FrA3Qjjd0sxuuzJZ.png', 'pending', NULL, NULL, '2025-05-17 15:54:44', '2025-05-17 15:54:44'),
('4', 'Cici', '6311054', 'bowo@usbypkp.ac.id', '080808080', 'Praktikum', '150000', 'payment_proofs/Up1SRWHbFEAlwFITdEQ7aFPDxLfPeSyXVEcLhgS7.jpg', 'verified', NULL, '2025-05-18 01:10:04', '2025-05-18 01:03:31', '2025-05-18 01:10:04'),
('5', 'Cici', '6311054', 'bowo@usbypkp.ac.id', '080808080', 'Praktikum', '150000', 'payment_proofs/w1eKjcb3Q479imiBUbOU80yDOgQClBii7RkfSSZX.jpg', 'rejected', 'kacau sih', NULL, '2025-05-18 01:08:45', '2025-05-18 11:53:08'),
('6', 'bbh', '12345', 'bowo@usbypkp.ac.id', '1234', 'SPP', '20000', 'payment_proofs/aMpt1jTlt8yzxOYoQVc7V5TLvjfXQV9yH118Y9Mb.png', 'rejected', 'karena', NULL, '2025-05-18 12:00:13', '2025-05-18 12:00:54'),
('7', 'bowo', '6311055', 'bowo@usbypkp.ac.id', '020202020', 'Praktikum', '522222', 'payment_proofs/MqCjqDt4bibsjQrHfTCaUafcgQcqZEuwPnzttBZv.png', 'rejected', 'salah gambar', NULL, '2025-05-19 07:46:07', '2025-05-19 07:46:45');

-- Table data for `sessions`
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('tzhfdyyoDW0etqCCTZYzMnNvUdtGJC9E5Pf3bDvB', NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYlk1aFA3d1dFZVVLbmpWUVMxQzNidlJ5UEpVVmV4MkJQeERFazd0OCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', '1747712087'),
('wZMnHbLc56BczdDwluiX6m8EXLAmeSYPTLwMwHI8', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicktPSnQ0aExNN3lwQ1JLQnppQW1xYTZzVEVTdzZpVGFRV1U4NmlGdyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9wYXltZW50cyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', '1747718719');

-- Table data for `settings`
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `description`, `created_at`, `updated_at`) VALUES
('1', 'mail_mailer', 'smtp', 'smtp', NULL, '2025-05-18 11:51:06', '2025-05-18 11:51:06'),
('2', 'mail_host', 'smtp.gmail.com', 'smtp', NULL, '2025-05-18 11:51:06', '2025-05-18 11:51:06'),
('3', 'mail_port', '587', 'smtp', NULL, '2025-05-18 11:51:06', '2025-05-18 11:51:06'),
('4', 'mail_username', 'noreply@usbypkp.ac.id', 'smtp', NULL, '2025-05-18 11:51:06', '2025-05-18 11:51:06'),
('5', 'mail_password', 'dsxnkmgjcvduoxnq', 'smtp', NULL, '2025-05-18 11:51:06', '2025-05-18 11:51:06'),
('6', 'mail_encryption', 'tls', 'smtp', NULL, '2025-05-18 11:51:06', '2025-05-18 11:51:06'),
('7', 'mail_from_address', 'noreply@usbypkp.ac.id', 'smtp', NULL, '2025-05-18 11:51:06', '2025-05-18 11:51:06'),
('8', 'mail_from_name', 'USBYPKP', 'smtp', NULL, '2025-05-18 11:51:06', '2025-05-18 11:51:06');

-- Table data for `users`
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
('1', 'Admin', 'admin@example.com', NULL, '$2y$12$oh0iHqxdHifg4Tr/3zskROlzckNdDvXwzMDhl1dou6OUsCfhl5IoG', NULL, '2025-05-16 06:53:01', '2025-05-16 17:05:30', 'super_admin'),
('2', 'Super Admin', 'superadmin@example.com', NULL, '$2y$12$cfQmzb.vROiPTqh5RFx4R.EI6gRQst5rgivYKfJVGQVoqalv52WVy', NULL, '2025-05-17 05:15:51', '2025-05-17 05:15:51', 'super_admin'),
('3', 'Admin Keuangan', 'finance@example.com', NULL, '$2y$12$5perCVANVGKCCkmMIPkcfeCZUUhD7uYOONUjirPfA5oYLxLltWSQO', NULL, '2025-05-17 05:15:52', '2025-05-18 11:49:31', 'admin_keuangan');

SET FOREIGN_KEY_CHECKS=1;
