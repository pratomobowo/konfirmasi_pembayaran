-- Script untuk menambahkan semua migrasi ke tabel migrations sebagai sudah dijalankan
-- Jalankan di server dengan: mysql -u username -p nama_database < update_migrations.sql

-- Pastikan tabel migrations ada
CREATE TABLE IF NOT EXISTS migrations (
    id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    migration VARCHAR(255) NOT NULL,
    batch INT(11) NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Hapus entri yang mungkin sudah ada (opsional)
-- TRUNCATE TABLE migrations;

-- Tambahkan semua migrasi yang ada sebagai batch 1
INSERT INTO migrations (migration, batch) 
VALUES 
('0001_01_01_000000_create_users_table', 1),
('0001_01_01_000001_create_cache_table', 1),
('0001_01_01_000002_create_jobs_table', 1),
('2025_05_16_063541_create_payments_table', 1),
('2025_05_16_165956_add_role_to_users_table', 1),
('2025_05_17_060633_create_payment_types_table', 1),
('2025_05_17_063211_create_settings_table', 1),
('2025_05_17_231045_create_activity_logs_table', 1),
('2025_05_18_010653_remove_unique_constraint_from_nim_in_payments_table', 1),
('2025_05_20_add_admin_note_to_payments_table', 1),
('2024_03_21_000000_create_email_templates_table', 1);

-- Periksa apakah semua migrasi sudah ditambahkan
-- SELECT * FROM migrations; 