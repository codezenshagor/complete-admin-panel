<?php
// database.php
// Config for database connection

$sql = "CREATE TABLE IF NOT EXISTS `users` (
    `id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `user_name` VARCHAR(50) UNIQUE NOT NULL,
    `email` VARCHAR(100) UNIQUE NOT NULL,
    `role` VARCHAR(50) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `address` TEXT NULL,
    `birthday` DATE NULL,
    `nid_card` VARCHAR(50) NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

$pdo->exec($sql);
?>
