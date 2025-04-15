CREATE TABLE `commission_history` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `order_id` int(11) NOT NULL,
 `order_code` varchar(50) NOT NULL,
 `seller_id` int(11) NOT NULL,
 `admin_commission` double NOT NULL DEFAULT 0,
 `seller_earning` double NOT NULL DEFAULT 0,
 `previous_balance` double NOT NULL DEFAULT 0,
 `current_balance` double NOT NULL DEFAULT 0,
 `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
 PRIMARY KEY (`id`),
 KEY `seller_id` (`seller_id`),
 KEY `order_id` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
