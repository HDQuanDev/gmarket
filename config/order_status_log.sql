CREATE TABLE `order_status_log` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `order_id` int(11) NOT NULL,
 `status` varchar(100) NOT NULL,
 `changed_by` varchar(50) NOT NULL DEFAULT 'admin',
 `admin_id` int(11) DEFAULT NULL,
 `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
 PRIMARY KEY (`id`),
 KEY `order_id` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
