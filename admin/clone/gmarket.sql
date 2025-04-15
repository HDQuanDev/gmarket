-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th10 22, 2024 lúc 06:23 PM
-- Phiên bản máy phục vụ: 10.4.21-MariaDB
-- Phiên bản PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `gmarket`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `post_code` varchar(50) NOT NULL,
  `city` varchar(255) NOT NULL DEFAULT '',
  `state` varchar(255) NOT NULL DEFAULT '',
  `country` varchar(255) NOT NULL DEFAULT '',
  `phone` varchar(20) NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `address`
--

INSERT INTO `address` (`id`, `user_id`, `seller_id`, `address`, `post_code`, `city`, `state`, `country`, `phone`, `is_default`, `create_date`) VALUES
(1, 1, NULL, '53 Ngõ Huyện, Hoàn Kiếm', '43000', 'Hà Nội', '', '', '0999999999', 1, '2024-10-09 04:42:44'),
(2, 1, NULL, '53 Ngõ Huyện, Hoàn Kiếm', '43000', '', '', '', '0971360307', 0, '2024-10-09 22:44:13'),
(3, 1, NULL, '53 Ngõ Huyện, Hoàn Kiếm', '43000', '', '', '', '09713603444', 0, '2024-10-10 23:24:44');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `title` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `logo` text DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `brands`
--

INSERT INTO `brands` (`id`, `name`, `title`, `description`, `logo`, `path`) VALUES
(1, 'Adidas', 'Adidas', 'Adidas', 'uM1nyOe05peZMzHX0iEbK7t1pon33cKm5dT3xwzb.png', 'Adidas-l6cRe'),
(2, 'Angel Eyes', 'Angel Eyes', 'Angel Eyes', 'yeCGFmcbVg7atCYD5Q4ArTvbHcdrq8N7Yu1NH3Po.png', 'Angel-Eyes-cmPD4'),
(3, 'APPLE', 'APPLE', 'APPLE', 'MnsE90ya901aNP5rYcN1kvbrx250go1NuEjIbxiI.jpg', 'APPLE-y0nFH'),
(4, 'Balenciaga', 'Balenciaga', 'Balenciaga', 'uZQHMvZGaZEokhX2rT96QkMNc1grDtpsSiq5Ixdb.jpg', 'Balenciaga-UnuTm'),
(5, 'Bio Oil', 'Bio Oil', 'Bio Oil', 'X8Tun7oP1kwXmmi9dQxnSzzWXrhJ0XIp12OXVuax.png', 'Bio-Oil-YrmxL'),
(6, 'Bioré', 'Bioré', 'Bioré', 'HbgxgiDyUScFTSmknPmb5wa2tuQSJUCSp1VLNLv0.png', 'Bior-aWVe0'),
(7, 'Boss', 'Boss', 'Boss', 'SG2FbHBausszZ3zCh8D2SAIN84gfyk3aErfQflXM.png', NULL),
(8, 'Burberry', 'Burberry', 'Burberry', 'YyGmpTMo2qo9YBNGoP7KmDuO4LvB1iUahXW1Y1mm.png', NULL),
(9, 'Calvin Klein', 'Calvin Klein', 'Calvin Klein', '4e7t6Vn0sLQLEKccPNaPyTjvfMmuuMz6VTAL1T01.png', NULL),
(10, 'Cartier', 'Cartier', 'Cartier', 'L0wt2aMJ3azx39en57lHkByHfaU9OVB2gKYMxXFb.png', NULL),
(11, 'Champion', 'Champion', 'Champion', 'ZGFGBzqNyDI3uJrziWy3URo6qQDxg9TndSkspIzf.png', NULL),
(12, 'Channel', 'Channel', 'Channel', 'OvXYB9IvXA480plR7VTPrTLuSdfBvhsHdD6vGE9B.png', NULL),
(13, 'Chloé', 'Chloé', 'Chloé', 'RnpJq2cOihqrDBDqko3gx8OvU39ZiRE02oypgJt1.png', NULL),
(14, 'Coach', 'Coach', 'Coach', 'wFWM89LF7KsEuSMKa2zKJThK0T0CtWzllJTJqhLN.jpg', NULL),
(15, 'Converse', 'Converse', 'Converse', 'q9p7dqZFWr0efoeq8kkprKmhOvaPEAxISjyttpEj.png', NULL),
(16, 'D&G', 'D&G', 'D&G', 'NEXSDcNFnkJAsumGn7genNaYKUZcNE186QJcxHFK.jpg', NULL),
(17, 'Dior', 'Dior', 'Dior', 'tJQWl3WtfcIcU5Fzl1HA4d2L3Dre2PqVZ4Cn9RaO.png', NULL),
(18, 'DKEA', 'DKEA', 'DKEA', 'RrDSBVDch1swJvB6mCTexWzkXrTMK2AUl4tJSP04.png', NULL),
(19, 'Fareanar', 'Fareanar', 'Fareanar', 'UgAx509xwkKHHETbEDM4FZCuq2sUhwWnQxWMUzf2.png', NULL),
(20, 'FenDi', 'FenDi', 'FenDi', '6hVBzzE1uzMa7nFPEYhAoYMz0f3pwsbGlIzrAjXY.png', NULL),
(21, 'Giorgio Armani', 'Giorgio Armani', 'Giorgio Armani', 'rVrvKcd899Sg7L0Xh4eJxCzOXASuSBH4CZmSm4p7.png', NULL),
(22, 'Givenchy', 'Givenchy', 'Givenchy', 'hOQYFj3EFSsjQhRWlYY579w1zPxRyHssobFdV44e.png', NULL),
(23, 'Gmarket', 'Gmarket', 'Gmarket', '7OaAYcxgrN28bwLP0t8D9k9cxve9OuQw4CkybgWV.png', NULL),
(24, 'Gucci', 'Gucci', 'Gucci', 'ISemSwMCsPboYQrbsEKwJN491S5t85gGxkN82Ub8.jpg', NULL),
(25, 'Haofeimei', 'Haofeimei', 'Haofeimei', 'R5DiIWmZryeQlTL5Jcu1QctnmjpPEFfikLohsZbw.jpg', NULL),
(26, 'Hermes', 'Hermes', 'Hermes', 'sqJdPKR1lBgizwASvFhFzOpEWY6PXVwBoT29nF8l.png', NULL),
(27, 'Huawei', 'Huawei', 'Huawei', '9vhQcalvzPQprMBNuFtbhOZPjZWRvGK4JN4PzbFH.png', NULL),
(28, 'Intel', 'Intel', 'Intel', 'BvOJoJ3ZFGDrhSP6DK2joEuPBlj3TGQfdNSLmuTV.png', NULL),
(29, 'Jane Fina', 'Jane Fina', 'Jane Fina', 't0YbbTJ6dKWI58HPyUSHGIxoUqHSaTTEn6bN0QYu.png', NULL),
(30, 'Lacoste', 'Lacoste', 'Lacoste', 'hnDcrPitqfFSryAZ38NIrpHObNB6g2KXNsxX3mD1.png', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `img` text DEFAULT NULL,
  `banner` text DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `img`, `banner`, `path`, `create_date`) VALUES
(1, 'Ladies clothing', 'AnVG84PgU7c3wZ1cUM8CdyJasY2fq0PwyzpzTnzL.jpg', 'An0tjvAuPDXpDJ55Ly9BVMSvpMT8Zvzs67t8GJVP.png', 'ladies-clothing-krads', '2024-10-13 02:07:47'),
(2, 'Men\'s clothing', 'sez22WYOgRELOHoqwL6ZE6OaBNp4kqlCxPiBDra6.jpg', 'w1JqEYcz2Mv1lBk5YkOWyPcjj9dxMgiUdghmKZAA.png', 'Mens-clothing-PjXnt', '2024-10-13 02:07:47'),
(4, 'Electronics - Refrigeration', '1G6PV2ciZ24QToaPCoaGAqASkAbJ7JzNwv2Vtx76.webp', 'mAg7VyDyL0Zbiq6R9XxUSf7C1fzjTzFTvuWL3smL.jpg', 'Electronics---Refrigeration-kLq7t', '2024-10-13 02:08:26'),
(5, 'Mother and baby items', 'xPDolus8X8uyOoRCBtDkqgxQTvCcIG5j6Jb9tkR0.jpg', 'fFQ6EqhpyNBV6eAeFUqqZN9ScF8FIQfHWgzcYkVs.png', 'Mother-and-baby-items-9i2Pd', '2024-10-13 02:08:26'),
(6, 'Jewelry & Watches', 'qm3LSCyej29gmw7JdJzIBjZKdsGJJz1TDSXZTq2E.jpg', 'cdQCcvfv7qTXWPv9QQRyfXqhpVq5c9t40t9aSSCY.png', 'Jewelry--Watches-xOQVq', '2024-10-13 02:09:01'),
(7, 'Smart Phone, Tablet and Accessory', 'rw76IXTaUvBu3UYqz8bJ8Rl4iLKFXgMv9PT5YkdI.jpg', 'vADfn3aBO1cEI95UiG2R91y6h5SJt3VJ0sQutoP5.png', 'in-Thoi---My-Tnh---Ph-Kin-ANOBO', '2024-10-13 02:09:01'),
(8, 'Sports', 'E0cCMF4D3dRHrvsTGobDBf5u8PrAx6Z7VJjMmBzm.png', 'x7uhErNkUi2W2QQlhtQt2rkLmYaLIoUzWNTJOnD2.png', 'Sports-LfVLy', '2024-10-13 02:09:21'),
(9, 'Toy', '8U1pR4dWy7DsugIV5Kr3jCaxA3wZ10YlXxHBxG4E.png', '5WW00MTLYF6SAiWirKMwp9NcMCAKwC2rDVEpgaub.jpg', 'Beauty-salons-WTqSq', '2024-10-13 02:09:53'),
(10, 'Shoes', 'sscBQbUX56MJM5s8Q99vjVM32clPd6SX1EyFRwMa.jpg', 'aRPyKKvg5biRdqJwLQfYdvmZ410J8HzivYk6geFW.png', 'Shoes-LmXKs', '2024-10-13 02:09:53'),
(11, 'Interior - Decoration', 'prCWxoOhhoYgtAbqjG4fQgfUFLFsnnya1IIzFfm4.png', 'kChvgo0cJDMSlJvzaIh0HKI0OImiAiw6feR6PC6G.png', 'Interior---Decoration-aVCL4', '2024-10-13 02:10:28'),
(12, 'Pet accessories', 'SPqP0FeOAvQXZpb4JiSBcZ5VTIQI61GEdzWQCkzZ.png', 'tCMymC6nYDRW7vrlpVGhSkXqk3NwP5fQjOsHf3xk.png', 'Pet-accessories-CBfbh', '2024-10-20 16:49:11'),
(13, 'Home electric', 'lBllAS501vXYiON35nYTyhHQx3xZOMh9zT22Q3Tm.png', 'm5bQ1KKhERqWZ2OZYdxGxyOLAcg2jEEFjbUykXHy.png', 'Home-electric-CGtoG', '2024-10-20 16:50:20'),
(14, 'Perfume', 'cvk5IIlXxFMKaGjcBrolpXkwUvCrhS3HpHUsePXo.jpg', 'E8L8bJxf5FQrymBtO7yVvcsMRqwsjAfgCCU2ZdGd.jpg', 'Perfume-WaXkw', '2024-10-20 16:50:20'),
(15, 'Cars - Motorcycles - Bicycles - Accessories', '38X6Xvjx3h8IfyAXPL9AaFJwPaCoUdnE9spnP6Jn.jpg', 'Fz3YYLxKanMF9s6UyYnMC6QTpfvmrumQWOuIuxac.jpg', 'Cars---Motorcycles---Bicycles---Accessories-S2Kbx', '2024-10-20 16:51:18');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `conversations`
--

CREATE TABLE `conversations` (
  `id` int(11) NOT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `title` text DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `conversations`
--

INSERT INTO `conversations` (`id`, `seller_id`, `user_id`, `product_id`, `title`, `create_date`) VALUES
(1, 1, 2, 2, 'Test sp', '2024-11-12 16:26:42');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `conversation_details`
--

CREATE TABLE `conversation_details` (
  `id` int(11) NOT NULL,
  `conversation_id` int(11) NOT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `type` varchar(50) NOT NULL DEFAULT 'user',
  `message` text DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `conversation_details`
--

INSERT INTO `conversation_details` (`id`, `conversation_id`, `seller_id`, `user_id`, `type`, `message`, `create_date`) VALUES
(1, 1, 1, 2, 'user', 'Is this too expensive ?', '2024-11-12 16:34:37'),
(2, 1, 1, 2, 'seller', 'No problem! It cans be saled', '2024-11-12 16:57:43');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer_packages`
--

CREATE TABLE `customer_packages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `amount` int(11) NOT NULL DEFAULT 0,
  `product_upload_limit` int(11) NOT NULL DEFAULT 0,
  `logo` int(11) DEFAULT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'active',
  `create_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `customer_packages`
--

INSERT INTO `customer_packages` (`id`, `name`, `amount`, `product_upload_limit`, `logo`, `status`, `create_date`) VALUES
(1, 'Free', 0, 100, 31, 'active', '2024-11-14 19:20:21');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `detail_orders`
--

CREATE TABLE `detail_orders` (
  `id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `from_seller` int(11) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `rose` double NOT NULL DEFAULT 0,
  `quantity` int(11) DEFAULT 0,
  `img` text DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `detail_orders`
--

INSERT INTO `detail_orders` (`id`, `name`, `user_id`, `from_seller`, `price`, `rose`, `quantity`, `img`, `order_id`, `create_date`) VALUES
(1, '2022 New Non-Magnetic Non-Iron Work Pants Wear-Resistant Labor Protection Pants Outdoor US Military Work Clothes Men\'s Loose Pants', 1, NULL, 14.5, 0, 1, 'https://filebroker-cdn.lazada.sg/kf/S09e06be6271a4685bc1eda703d3479bbI.jpg', 1, '2024-10-11 11:32:34'),
(2, 'Yves Saint Laurent YSL Men\'s Perfume Set YSL Gift Set YSL Y 3 Pieces (100ml + 10ml)', 1, NULL, 228.99, 0, 1, 'https://tmdtquocte.com/public/uploads/all/diJoWw72fMqElmfgFGeC0QTypUahBUePoyDqZvWG.jpg', 1, '2024-10-11 11:32:34'),
(3, 'Test sp', 1, 1, 170, 20, 3, '/public/uploads/all/1731248885-1FweDQq8LWA2WMc1xmMmW968RWsy69aSQN0Qy1gVe.png', 2, '2024-11-11 17:01:41'),
(4, 'Test sp', 1, 1, 170, 20, 3, '/public/uploads/all/1731248885-1FweDQq8LWA2WMc1xmMmW968RWsy69aSQN0Qy1gVe.png', 3, '2024-11-11 17:07:46'),
(5, 'Test sp', 1, 1, 150, 70, 3, '/public/uploads/all/1731248885-1FweDQq8LWA2WMc1xmMmW968RWsy69aSQN0Qy1gVe.png', 10, '2024-11-11 17:50:59');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `file`
--

CREATE TABLE `file` (
  `id` int(11) NOT NULL,
  `src` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT '',
  `size` varchar(255) NOT NULL DEFAULT '',
  `status` varchar(30) NOT NULL DEFAULT 'active',
  `create_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `file`
--

INSERT INTO `file` (`id`, `src`, `user_id`, `seller_id`, `type`, `size`, `status`, `create_date`) VALUES
(1, '1728860528-1463029356_526212153363597_5744639050434414847_n.jpg', 1, NULL, '', '', 'active', '2024-10-13 23:02:08'),
(2, '1728881439-1457223514_1024082176386234_1100011892429718208_n.jpg', 1, NULL, '', '', 'active', '2024-10-14 04:50:39'),
(3, '1729491279-1logo_site.jpg', 1, NULL, '', '', 'active', '2024-10-21 06:14:39'),
(11, '1731066540-462543651_3949561915368474_7074596199798687456_n.png', NULL, 1, 'image/png', '35287', 'active', '2024-11-08 11:49:00'),
(14, '1731169283-1FDbI6VbmXbQRTwkLfrcgm7GbbCJ7U1Lj0AVN0gWG.png', NULL, 1, 'image/png', '44037', 'active', '2024-11-09 16:21:23'),
(15, '1731248885-1FweDQq8LWA2WMc1xmMmW968RWsy69aSQN0Qy1gVe.png', NULL, 1, 'image/png', '31414', 'active', '2024-11-10 14:28:05'),
(16, '1731319238-1lgoo.svg', NULL, 1, 'image/png', '3345', 'active', '2024-11-11 10:00:38'),
(17, '1731567307-11.png', 1, NULL, 'image/png', '328388', 'active', '2024-11-14 06:55:07'),
(18, '1731568171-12.png', 1, NULL, 'image/png', '301349', 'active', '2024-11-14 07:09:31'),
(19, '1731568759-13.png', 1, NULL, 'image/png', '297152', 'active', '2024-11-14 07:19:19'),
(20, '1731568814-14.png', 1, NULL, 'image/png', '242676', 'active', '2024-11-14 07:20:14'),
(21, '1731569688-15.png', 1, NULL, 'image/png', '281696', 'active', '2024-11-14 07:34:48'),
(22, '1731569725-16.png', 1, NULL, 'image/png', '276081', 'active', '2024-11-14 07:35:25'),
(23, '1731569762-17.png', 1, NULL, 'image/png', '304403', 'active', '2024-11-14 07:36:02'),
(24, '1731569792-18.png', 1, NULL, 'image/png', '183133', 'active', '2024-11-14 07:36:32'),
(25, '1731569816-19.png', 1, NULL, 'image/png', '330930', 'active', '2024-11-14 07:36:56'),
(26, '1731609235-11.png', 1, NULL, 'image/png', '201312', 'active', '2024-11-14 18:33:55'),
(27, '1731609423-12.png', 1, NULL, 'image/png', '145162', 'active', '2024-11-14 18:37:03'),
(28, '1731609423-13.png', 1, NULL, 'image/png', '183749', 'active', '2024-11-14 18:37:03'),
(29, '1731609423-14.png', 1, NULL, 'image/png', '167299', 'active', '2024-11-14 18:37:03'),
(30, '1731609423-15.png', 1, NULL, 'image/png', '195216', 'active', '2024-11-14 18:37:03'),
(31, '1731612002-11.jpg', 1, NULL, 'image/jpeg', '11975', 'active', '2024-11-14 19:20:02'),
(35, '1731864161-1hdbank.webp', 1, NULL, 'image/webp', '5550', 'active', '2024-11-17 17:22:41'),
(36, '1731864161-1mastercard.png', 1, NULL, 'image/png', '84149', 'active', '2024-11-17 17:22:41'),
(37, '1731864161-1paypal.png', 1, NULL, 'image/png', '23471', 'active', '2024-11-17 17:22:41'),
(38, '1731864161-1remitly.png', 1, NULL, 'image/png', '30306', 'active', '2024-11-17 17:22:41'),
(39, '1731864161-1sendwave.png', 1, NULL, 'image/png', '9396', 'active', '2024-11-17 17:22:41'),
(40, '1731864161-1techcombank.png', 1, NULL, 'image/png', '4135', 'active', '2024-11-17 17:22:41'),
(41, '1731864161-1vietcombank.png', 1, NULL, 'image/png', '48321', 'active', '2024-11-17 17:22:41'),
(42, '1731864161-1visa.png', 1, NULL, 'image/png', '16633', 'active', '2024-11-17 17:22:41'),
(43, '1731864161-1western.png', 1, NULL, 'image/png', '118277', 'active', '2024-11-17 17:22:41'),
(44, '1731864161-1xoom.png', 1, NULL, 'image/png', '56782', 'active', '2024-11-17 17:22:41'),
(48, '1731864306-1bidv.png', 1, NULL, 'image/png', '3613', 'active', '2024-11-17 17:25:06'),
(49, '1731864346-1honeygram.png', 1, NULL, 'image/png', '3687', 'active', '2024-11-17 17:25:46');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `history_payment`
--

CREATE TABLE `history_payment` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `name_payment` varchar(255) NOT NULL DEFAULT '',
  `user_id` int(11) DEFAULT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `amount` bigint(20) NOT NULL DEFAULT 0,
  `message` text DEFAULT NULL,
  `reply` text DEFAULT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'Pending',
  `create_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `history_payment`
--

INSERT INTO `history_payment` (`id`, `type`, `name_payment`, `user_id`, `seller_id`, `amount`, `message`, `reply`, `status`, `create_date`) VALUES
(1, 'Recharge', 'WESTERN UNION', 1, NULL, 44, NULL, NULL, 'Pending', '2024-10-11 03:21:07'),
(2, 'Recharge', 'PAYPAL', NULL, 1, 434, NULL, NULL, 'Pending', '2024-11-13 09:48:57'),
(3, 'Withdraw', '', NULL, 1, 40, 'Tôi muốn rút tiền', NULL, 'Pending', '2024-11-17 14:14:28');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `marketing_subscribers`
--

CREATE TABLE `marketing_subscribers` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `marketing_subscribers`
--

INSERT INTO `marketing_subscribers` (`id`, `email`, `create_date`) VALUES
(1, 'matthewskarltonk@gmail.com', '2024-10-21 06:26:16'),
(2, 'nasriadi_samir@yahoo.com', '2024-10-21 06:26:29'),
(3, 'Tuyentrieu1971@yahoo.com', '2024-10-21 06:26:29');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `amount` double NOT NULL DEFAULT 0,
  `delivery_status` varchar(100) NOT NULL DEFAULT 'Pending',
  `payment_status` varchar(100) NOT NULL DEFAULT 'Un-paid',
  `additional_info` text DEFAULT NULL,
  `payment_option` varchar(255) DEFAULT NULL,
  `pay_img_id` int(11) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `code`, `amount`, `delivery_status`, `payment_status`, `additional_info`, `payment_option`, `pay_img_id`, `address`, `user_id`, `create_date`) VALUES
(1, '20241011-1728646354', 243.49, 'Pending', 'Un-paid', 'Làm sớm', 'HD BANK', 1, '53 Ngõ Huyện, Hoàn Kiếm ,  , ', 1, '2024-10-11 11:32:34'),
(2, '20241112-1731344501', 510, 'Pending', 'Un-paid', 'Test reason', 'VISA CARD', 2, '53 Ngõ Huyện, Hoàn Kiếm , Hà Nội , ', 1, '2024-11-11 17:01:41'),
(3, '20241112-1731344866', 510, 'Pending', 'Un-paid', 'Test re1', 'VISA CARD', 1, '53 Ngõ Huyện, Hoàn Kiếm , Hà Nội , ', 1, '2024-11-11 17:07:46'),
(4, '20241112-1731346677', 320, 'Pending', 'Un-paid', '', 'MONEYGRAM', 2, '53 Ngõ Huyện, Hoàn Kiếm ,  , ', 1, '2024-11-11 17:37:57'),
(5, '20241112-1731347268', 450, 'Pending', 'Un-paid', '', 'BIDV BANK', 3, '53 Ngõ Huyện, Hoàn Kiếm ,  , ', 1, '2024-11-11 17:47:48'),
(6, '20241112-1731347279', 450, 'Pending', 'Un-paid', '', 'BIDV BANK', 3, '53 Ngõ Huyện, Hoàn Kiếm ,  , ', 1, '2024-11-11 17:47:59'),
(7, '20241112-1731347352', 450, 'Pending', 'Un-paid', '', 'BIDV BANK', 3, '53 Ngõ Huyện, Hoàn Kiếm ,  , ', 1, '2024-11-11 17:49:12'),
(8, '20241112-1731347354', 450, 'Pending', 'Un-paid', '', 'BIDV BANK', 3, '53 Ngõ Huyện, Hoàn Kiếm ,  , ', 1, '2024-11-11 17:49:14'),
(9, '20241112-1731347392', 450, 'Pending', 'Un-paid', '', 'BIDV BANK', 3, '53 Ngõ Huyện, Hoàn Kiếm ,  , ', 1, '2024-11-11 17:49:52'),
(10, '20241112-1731347459', 450, 'Pending', 'Un-paid', '', 'BIDV BANK', 3, '53 Ngõ Huyện, Hoàn Kiếm ,  , ', 1, '2024-11-11 17:50:59');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `package_purchase_history`
--

CREATE TABLE `package_purchase_history` (
  `id` int(11) NOT NULL,
  `package_id` int(11) DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `reciept` int(11) DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'pending',
  `type` varchar(50) NOT NULL DEFAULT 'user',
  `member_id` int(11) DEFAULT NULL,
  `package_type` varchar(100) DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `package_purchase_history`
--

INSERT INTO `package_purchase_history` (`id`, `package_id`, `payment_method`, `reciept`, `status`, `type`, `member_id`, `package_type`, `create_date`) VALUES
(1, 1, 'Khách thanh toán', NULL, 'active', 'seller', 1, 'through_train', '2024-11-16 18:31:05');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pos_products`
--

CREATE TABLE `pos_products` (
  `id` int(11) NOT NULL,
  `stock_id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `image` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `base_price` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `variant` varchar(255) NOT NULL DEFAULT '',
  `create_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `brand_id` int(11) NOT NULL DEFAULT 1,
  `unit` varchar(255) DEFAULT NULL,
  `weight` varchar(255) DEFAULT NULL,
  `minimum_quantity` int(11) NOT NULL DEFAULT 1,
  `tags` text DEFAULT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `files` varchar(255) DEFAULT NULL,
  `gallery_images` text DEFAULT NULL,
  `thumbnail_image` varchar(255) DEFAULT NULL,
  `video_provider` varchar(255) DEFAULT NULL,
  `video_link` text DEFAULT NULL,
  `unit_price` double NOT NULL,
  `purchase_price` double NOT NULL DEFAULT 10,
  `profit` double DEFAULT 0,
  `rose` double DEFAULT 0,
  `discount_date_range` varchar(255) DEFAULT NULL,
  `discount` double NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `sku` varchar(255) NOT NULL DEFAULT '',
  `external_link` text DEFAULT NULL,
  `external_link_button_text` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `pdf_specification` varchar(255) DEFAULT NULL,
  `meta_title` text DEFAULT NULL,
  `meta_image` int(11) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `slugs` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `added_by` varchar(50) NOT NULL DEFAULT 'admin',
  `published` tinyint(1) NOT NULL DEFAULT 1,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `category_id`, `brand_id`, `unit`, `weight`, `minimum_quantity`, `tags`, `barcode`, `files`, `gallery_images`, `thumbnail_image`, `video_provider`, `video_link`, `unit_price`, `purchase_price`, `profit`, `rose`, `discount_date_range`, `discount`, `quantity`, `sku`, `external_link`, `external_link_button_text`, `description`, `pdf_specification`, `meta_title`, `meta_image`, `meta_description`, `slugs`, `user_id`, `seller_id`, `added_by`, `published`, `create_date`) VALUES
(1, 'Áo trắng trendset', 1, 1, '4', '4.00', 14, '', '43', NULL, '1,2,3', '2', 'youtube', '34343', 55, 10, 0, 0, '', 0, 0, '', '', '', '<p>des</p>', '', 'title', NULL, NULL, '', 1, NULL, 'admin', 1, '2024-10-21 16:30:45'),
(2, 'Nước hoa nữ Versace', 2, 1, '1', NULL, 1, 'Array', NULL, '14', '15,14,11', '15', NULL, NULL, 40, 20, 60, 70, NULL, 80, 1, '', NULL, NULL, '<p><b>test des14343</b></p>', NULL, 'test title', 14, 'test mô tả', '', NULL, 1, 'seller', 1, '2024-11-10 14:48:15');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_queries`
--

CREATE TABLE `product_queries` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `message` text DEFAULT NULL,
  `reply` text DEFAULT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'pending',
  `reply_time` timestamp NULL DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `product_queries`
--

INSERT INTO `product_queries` (`id`, `user_id`, `product_id`, `message`, `reply`, `status`, `reply_time`, `create_date`) VALUES
(1, 1, 1, 'Hàng sài rất êm tay', NULL, 'pending', NULL, '2024-11-17 08:22:01'),
(2, 2, 2, 'How long does it take to ship?', 'About 7 days', 'active', '2024-11-17 08:30:23', '2024-11-17 08:09:46');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sellers`
--

CREATE TABLE `sellers` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `inviter` varchar(255) DEFAULT NULL,
  `money` double NOT NULL DEFAULT 0,
  `rose` double NOT NULL DEFAULT 0,
  `rating` double NOT NULL DEFAULT 0,
  `visitors` int(11) NOT NULL DEFAULT 0,
  `phone` varchar(20) DEFAULT NULL,
  `bank_account_name` varchar(100) DEFAULT NULL,
  `bank_account_number` varchar(100) DEFAULT NULL,
  `bank_routing_number` varchar(100) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `cash_payment` tinyint(1) NOT NULL DEFAULT 0,
  `bank_payment` tinyint(1) NOT NULL DEFAULT 1,
  `shop_name` varchar(255) DEFAULT NULL,
  `shop_phone` varchar(20) DEFAULT NULL,
  `shop_logo` int(11) DEFAULT NULL,
  `shop_address` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `front_id_card` int(11) DEFAULT NULL,
  `back_id_card` int(11) DEFAULT NULL,
  `banners` int(11) DEFAULT NULL,
  `facebook_url` varchar(255) DEFAULT NULL,
  `instagram_url` varchar(255) DEFAULT NULL,
  `twitter_url` varchar(255) DEFAULT NULL,
  `google_url` varchar(255) DEFAULT NULL,
  `youtube_url` varchar(255) DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `package_id` int(11) DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'active',
  `create_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `sellers`
--

INSERT INTO `sellers` (`id`, `full_name`, `email`, `password`, `inviter`, `money`, `rose`, `rating`, `visitors`, `phone`, `bank_account_name`, `bank_account_number`, `bank_routing_number`, `bank_name`, `cash_payment`, `bank_payment`, `shop_name`, `shop_phone`, `shop_logo`, `shop_address`, `meta_title`, `meta_description`, `front_id_card`, `back_id_card`, `banners`, `facebook_url`, `instagram_url`, `twitter_url`, `google_url`, `youtube_url`, `is_verified`, `package_id`, `status`, `create_date`) VALUES
(1, 'Nguyễn Văn Trường', 'kous1609', '21232f297a57a5a743894a0e4a801fc3', 'kous1608', 70, 70, 0, 0, '0999999999', 'Nguyễn Văn Trường', '000842669837', '21212121', 'Mbbank', 0, 0, 'Shop Hà Nội', '0999888777', 16, '61 Ngõ Huyện, Đống Đa', 'Shop HG LUXURY', 'Mô tả', 11, 11, 14, 'https://fb.com/kous1608', '', '', 'https://fb.com/kous1608', '', 0, 1, 'active', '2024-11-08 07:36:14'),
(2, 'Trần Hoàng Thành', 'thanhtran545@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'kous1608', 0, 0, 3, 143, NULL, NULL, NULL, NULL, NULL, 0, 1, 'HN LUXURY', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 'active', '2024-11-11 18:20:30');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `seller_packages`
--

CREATE TABLE `seller_packages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL DEFAULT 0,
  `product_upload_limit` int(11) NOT NULL DEFAULT 0,
  `duration` int(11) NOT NULL DEFAULT 0,
  `logo` int(11) DEFAULT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'active',
  `create_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `seller_packages`
--

INSERT INTO `seller_packages` (`id`, `name`, `amount`, `product_upload_limit`, `duration`, `logo`, `status`, `create_date`) VALUES
(1, 'Bronze Shop', 0, 200, 365, 26, 'active', '2024-11-14 18:35:52'),
(2, 'Silver Shop', 698, 500, 365, 27, 'active', '2024-11-14 18:37:12'),
(3, 'Gold Shop', 1198, 1000, 365, 28, 'active', '2024-11-14 18:38:33'),
(4, 'Platinum Shop', 2398, 3000, 365, 29, 'active', '2024-11-14 18:38:54'),
(5, 'Kim cương', 3898, 5000, 365, 30, 'active', '2024-11-14 18:39:14');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `seller_setting`
--

CREATE TABLE `seller_setting` (
  `id` int(11) NOT NULL,
  `commission` double NOT NULL DEFAULT 0,
  `min_withdraw` double NOT NULL DEFAULT 0,
  `commission_active` tinyint(1) NOT NULL DEFAULT 1,
  `category_wise_commission` tinyint(1) NOT NULL DEFAULT 1,
  `pos_active` tinyint(1) NOT NULL DEFAULT 1,
  `13` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `seller_setting`
--

INSERT INTO `seller_setting` (`id`, `commission`, `min_withdraw`, `commission_active`, `category_wise_commission`, `pos_active`, `13`) VALUES
(1, 18, 5, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `supports`
--

CREATE TABLE `supports` (
  `id` int(11) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'Pending',
  `last_reply` timestamp NOT NULL DEFAULT current_timestamp(),
  `create_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `supports`
--

INSERT INTO `supports` (`id`, `code`, `user_id`, `seller_id`, `subject`, `status`, `last_reply`, `create_date`) VALUES
(1, '#951717294327707', 1, NULL, 'test ', 'Pending', '2024-10-20 13:59:30', '2024-10-20 13:59:30'),
(2, '@11731172813', NULL, 1, 'Test title', 'Pending', '2024-11-11 08:07:34', '2024-11-09 17:20:13');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `support_details`
--

CREATE TABLE `support_details` (
  `id` int(11) NOT NULL,
  `support_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `type` varchar(40) NOT NULL DEFAULT 'user',
  `details` text DEFAULT NULL,
  `files` varchar(255) DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `support_details`
--

INSERT INTO `support_details` (`id`, `support_id`, `user_id`, `seller_id`, `type`, `details`, `files`, `create_date`) VALUES
(1, 1, 1, NULL, 'user', 'test details', '1,2', '2024-10-20 15:13:22'),
(2, 1, 1, NULL, 'user', '<ol><li>test <u>u <b>b <i>i&nbsp;</i></b></u></li><li><b><i><u>eeee</u></i></b></li><li><b><i><u>hhh</u></i></b></li></ol>', '2,1', '2024-10-20 16:22:39'),
(3, 1, 1, NULL, 'admin', '<p><b><u><i>ewewew</i></u></b></p>', '2,1', '2024-10-20 16:35:54'),
(4, 1, 1, NULL, 'admin', '<ol><li>testes</li></ol>', '2', '2024-10-20 16:36:39'),
(5, 2, NULL, 1, 'seller', 'Test des', '14,11', '2024-11-09 17:20:13'),
(6, 2, 1, NULL, 'admin', '<ul><li><b>Test reply shop</b></li><li><b>List&nbsp;</b></li><li><b><br></b></li></ul>', '', '2024-11-11 08:07:34');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `through_trains`
--

CREATE TABLE `through_trains` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `amount` double NOT NULL DEFAULT 10,
  `people` int(11) NOT NULL DEFAULT 0,
  `duration` int(11) NOT NULL DEFAULT 1,
  `logo` int(11) DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'active',
  `create_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `through_trains`
--

INSERT INTO `through_trains` (`id`, `name`, `amount`, `people`, `duration`, `logo`, `status`, `create_date`) VALUES
(1, 'Guaranteed capital level', 1000, 80, 365, 17, 'active', '2024-11-14 06:06:51'),
(2, 'Mức vốn đảm bảo', 3000, 189, 365, 18, 'active', '2024-11-14 07:16:46'),
(3, 'Guaranteed capital level', 7000, 589, 365, 19, 'active', '2024-11-14 07:19:25'),
(4, 'Guaranteed capital level', 10000, 1289, 365, 20, 'active', '2024-11-14 07:20:19'),
(5, 'Guaranteed capital level', 15000, 2089, 365, 21, 'active', '2024-11-14 07:34:52'),
(6, 'Guaranteed capital level', 20000, 3089, 365, 22, 'active', '2024-11-14 07:35:30'),
(7, 'Mức vốn đảm bảo', 30000, 3589, 365, 23, 'active', '2024-11-14 07:36:06'),
(8, 'Mức vốn đảm bảo', 40000, 4889, 365, 24, 'active', '2024-11-14 07:36:36'),
(9, 'Mức vốn đảm bảo', 50000, 8000, 365, 25, 'active', '2024-11-14 07:37:01');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` text DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `money` bigint(20) NOT NULL DEFAULT 0,
  `card_number` varchar(255) NOT NULL,
  `credit_date` varchar(20) NOT NULL,
  `credit_cvv` varchar(20) NOT NULL,
  `card_name` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'user',
  `logo` int(11) DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'active',
  `create_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `phone`, `password`, `money`, `card_number`, `credit_date`, `credit_cvv`, `card_name`, `role`, `logo`, `status`, `create_date`) VALUES
(1, 'Nguyễn Văn Trường', 'kous1608', NULL, '21232f297a57a5a743894a0e4a801fc3', 55555, '4444 4444 4444 4444 ', '04 / 44', '3997', 'Nguyen Truong', 'admin', 32, 'active', '2024-10-08 23:11:41'),
(2, 'Trần Huyền My', 'huyenmy', '0999999999', '21232f297a57a5a743894a0e4a801fc3', 55543, '', '', '', '', 'user', 2, 'active', '2024-11-14 19:01:11');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `website_appearance`
--

CREATE TABLE `website_appearance` (
  `id` int(11) NOT NULL,
  `website_name` varchar(255) DEFAULT NULL,
  `site_motto` text NOT NULL,
  `site_icon` varchar(255) NOT NULL,
  `base_color` varchar(100) NOT NULL,
  `base_hover_color` varchar(100) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` text NOT NULL,
  `keywords` text NOT NULL,
  `meta_image` varchar(255) NOT NULL,
  `cookies_agreement_text` text NOT NULL,
  `show_cookies_agreement` tinyint(1) NOT NULL DEFAULT 1,
  `show_website_popup` tinyint(1) NOT NULL DEFAULT 1,
  `popup_content` text NOT NULL,
  `show_subscriber_form` tinyint(1) NOT NULL DEFAULT 1,
  `header_script` text NOT NULL,
  `footer_script` text NOT NULL,
  `referal_code` varchar(8) NOT NULL DEFAULT 'kous1608'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `website_appearance`
--

INSERT INTO `website_appearance` (`id`, `website_name`, `site_motto`, `site_icon`, `base_color`, `base_hover_color`, `meta_title`, `meta_description`, `keywords`, `meta_image`, `cookies_agreement_text`, `show_cookies_agreement`, `show_website_popup`, `popup_content`, `show_subscriber_form`, `header_script`, `footer_script`, `referal_code`) VALUES
(1, 'Takashimaya', 'Buy Korean domestic products at original prices from the manufacturer', '3', '#00c01e', '#00c01e', 'Takashimaya', 'Buy Korean domestic products at original prices from the manufacturer', '', '1', '<b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; WELCOME TO&nbsp;<br></b>&nbsp; &nbsp; &nbsp; &nbsp;<a href=\"https://english.visitseoul.net/index\" target=\"_blank\"><b>GMARKET VIET NAM </b><br>&nbsp;</a>', 1, 1, '<div style=\"text-align: center;\"><b style=\"background-color: rgb(255, 255, 0);\">BECOME AN EXCELLENT SALES AGENT OF GMARKET VIET NAM, YOU WILL BE HONORABLE TO VISIT THE LARGEST MERCHANDISE WAREHOUSES IN SEOUL, KOREA</b></div><div style=\"text-align: center; \"><u><b>GOOD LUCK TO SALES AGENTS!</b></u></div>', 1, 'WELCOME TO Takashimaya !', 'Takashimaya IS HONORABLE TO ACCOMPANY YOU !', 'kous1608');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `website_footer`
--

CREATE TABLE `website_footer` (
  `id` int(11) NOT NULL,
  `logo` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `play_store_link` text DEFAULT NULL,
  `app_store_link` text DEFAULT NULL,
  `contact_address` text DEFAULT NULL,
  `contact_phone` varchar(100) DEFAULT NULL,
  `contact_email` varchar(100) DEFAULT NULL,
  `payment_methods` varchar(100) DEFAULT NULL,
  `show_social_links` tinyint(1) NOT NULL DEFAULT 1,
  `facebook_url` varchar(255) NOT NULL DEFAULT '#',
  `twitter_url` varchar(255) NOT NULL DEFAULT '#',
  `instagram_url` varchar(255) NOT NULL DEFAULT '#',
  `youtube_url` varchar(255) NOT NULL DEFAULT '#',
  `linkedin_url` varchar(255) NOT NULL DEFAULT '#',
  `create_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `website_footer`
--

INSERT INTO `website_footer` (`id`, `logo`, `description`, `play_store_link`, `app_store_link`, `contact_address`, `contact_phone`, `contact_email`, `payment_methods`, `show_social_links`, `facebook_url`, `twitter_url`, `instagram_url`, `youtube_url`, `linkedin_url`, `create_date`) VALUES
(1, 3, '', '/', '/', 'Số 18 đường Phan Khiêm Ích, Phường Tân Phong, Quận 7, Thành phố Hồ Chí Minh, Việt Nam', '1900 252 656', 'gmarketvietnam2017@gmail.com', '49,48,44,41,42,43,40,39,38,35,36,37', 1, '#', '#', '#', '#', '#', '2024-11-17 17:02:51');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `website_header`
--

CREATE TABLE `website_header` (
  `id` int(11) NOT NULL,
  `header_logo` int(11) DEFAULT NULL,
  `is_header_nav` tinyint(1) NOT NULL DEFAULT 0,
  `header_nav` text NOT NULL,
  `show_language_switcher` tinyint(1) NOT NULL DEFAULT 1,
  `show_currency_switcher` tinyint(1) NOT NULL DEFAULT 0,
  `enable_stikcy_header` tinyint(1) NOT NULL DEFAULT 1,
  `topbar_banner` int(11) DEFAULT NULL,
  `topbar_banner_link` text DEFAULT NULL,
  `cskh` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `website_header`
--

INSERT INTO `website_header` (`id`, `header_logo`, `is_header_nav`, `header_nav`, `show_language_switcher`, `show_currency_switcher`, `enable_stikcy_header`, `topbar_banner`, `topbar_banner_link`, `cskh`) VALUES
(1, 1, 0, '', 1, 0, 1, 1, 'https://tmdtquocte.com/', 'https://secure.livechatinc.com/licence/17724141/v2/open_chat.cgi');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `conversation_details`
--
ALTER TABLE `conversation_details`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `customer_packages`
--
ALTER TABLE `customer_packages`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `detail_orders`
--
ALTER TABLE `detail_orders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `history_payment`
--
ALTER TABLE `history_payment`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `marketing_subscribers`
--
ALTER TABLE `marketing_subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `package_purchase_history`
--
ALTER TABLE `package_purchase_history`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `pos_products`
--
ALTER TABLE `pos_products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `product_queries`
--
ALTER TABLE `product_queries`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `sellers`
--
ALTER TABLE `sellers`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `seller_packages`
--
ALTER TABLE `seller_packages`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `seller_setting`
--
ALTER TABLE `seller_setting`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `supports`
--
ALTER TABLE `supports`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `support_details`
--
ALTER TABLE `support_details`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `through_trains`
--
ALTER TABLE `through_trains`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `website_appearance`
--
ALTER TABLE `website_appearance`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `website_footer`
--
ALTER TABLE `website_footer`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `website_header`
--
ALTER TABLE `website_header`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `conversation_details`
--
ALTER TABLE `conversation_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `customer_packages`
--
ALTER TABLE `customer_packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `detail_orders`
--
ALTER TABLE `detail_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `file`
--
ALTER TABLE `file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT cho bảng `history_payment`
--
ALTER TABLE `history_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `marketing_subscribers`
--
ALTER TABLE `marketing_subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `package_purchase_history`
--
ALTER TABLE `package_purchase_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `pos_products`
--
ALTER TABLE `pos_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `product_queries`
--
ALTER TABLE `product_queries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `sellers`
--
ALTER TABLE `sellers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `seller_packages`
--
ALTER TABLE `seller_packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `seller_setting`
--
ALTER TABLE `seller_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `supports`
--
ALTER TABLE `supports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `support_details`
--
ALTER TABLE `support_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `through_trains`
--
ALTER TABLE `through_trains`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `website_appearance`
--
ALTER TABLE `website_appearance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `website_footer`
--
ALTER TABLE `website_footer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `website_header`
--
ALTER TABLE `website_header`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
