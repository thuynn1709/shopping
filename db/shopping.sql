/*
Navicat MySQL Data Transfer

Source Server         : nothing
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : shopping

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-09-20 17:29:37
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for contact
-- ----------------------------
DROP TABLE IF EXISTS `contact`;
CREATE TABLE `contact` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(40) DEFAULT NULL,
  `name` varchar(40) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `content` varchar(200) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `status` tinyint(2) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of contact
-- ----------------------------

-- ----------------------------
-- Table structure for export
-- ----------------------------
DROP TABLE IF EXISTS `export`;
CREATE TABLE `export` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `author` varchar(30) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `type` tinyint(2) DEFAULT NULL COMMENT '0 = cho ai do, 1 = ban hang',
  `amount` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `sale_off` int(11) DEFAULT NULL COMMENT 'phan tram giam gia',
  `notice` varchar(100) DEFAULT NULL COMMENT 'ghi chú cần thiết',
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of export
-- ----------------------------

-- ----------------------------
-- Table structure for extracost
-- ----------------------------
DROP TABLE IF EXISTS `extracost`;
CREATE TABLE `extracost` (
  `id` int(11) unsigned NOT NULL,
  `name` varchar(500) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `author` varchar(50) DEFAULT NULL,
  `notice` varchar(100) DEFAULT NULL,
  `created` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of extracost
-- ----------------------------

-- ----------------------------
-- Table structure for import
-- ----------------------------
DROP TABLE IF EXISTS `import`;
CREATE TABLE `import` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `product_qty` int(11) DEFAULT NULL,
  `product_total_price` float DEFAULT NULL,
  `versand_in_de` float DEFAULT NULL,
  `versand_to_vn` varchar(200) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of import
-- ----------------------------
INSERT INTO `import` VALUES ('1', 'Ngoc Thuy', '1', '20', '423.3', '0', '200', '2017-09-15 22:04:37');

-- ----------------------------
-- Table structure for import_detail
-- ----------------------------
DROP TABLE IF EXISTS `import_detail`;
CREATE TABLE `import_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `import_id` int(11) DEFAULT NULL,
  `price` float(11,0) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of import_detail
-- ----------------------------

-- ----------------------------
-- Table structure for marken
-- ----------------------------
DROP TABLE IF EXISTS `marken`;
CREATE TABLE `marken` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) DEFAULT NULL,
  `country` varchar(30) DEFAULT NULL,
  `addresse` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of marken
-- ----------------------------
INSERT INTO `marken` VALUES ('1', 'Manhattan', 'Đức', 'Đức');
INSERT INTO `marken` VALUES ('2', 'Catrice', 'Đức', 'Đức');
INSERT INTO `marken` VALUES ('3', 'Humana', 'Đức', 'Đức');
INSERT INTO `marken` VALUES ('4', 'Sundance', 'Đức', 'Đức');
INSERT INTO `marken` VALUES ('5', 'Maybelline', 'Đức', 'Đức');
INSERT INTO `marken` VALUES ('6', 'Garnier', 'Đức', 'Đức');
INSERT INTO `marken` VALUES ('7', 'Schaebens', 'Đức', 'Đức');
INSERT INTO `marken` VALUES ('8', 'Ebelin', 'Đức', 'Đức');
INSERT INTO `marken` VALUES ('9', 'Balea', 'Đức', 'Đức');
INSERT INTO `marken` VALUES ('10', 'Perlodent', 'Đức', 'Đức');

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) DEFAULT NULL,
  `alias` varchar(40) DEFAULT NULL,
  `status` tinyint(3) DEFAULT NULL,
  `priority` tinyint(3) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES ('3', 'Mỹ phẩm ', 'my-pham', '1', '3', '2017-09-14 23:33:35');
INSERT INTO `menu` VALUES ('6', 'Mua hàng & Thanh toán', 'mua-hang-&-thanh-toan', '1', '4', '2017-09-14 23:34:51');
INSERT INTO `menu` VALUES ('7', 'Liên hệ', 'lien-he', '1', '5', '2017-09-14 23:38:28');
INSERT INTO `menu` VALUES ('8', 'Trang chủ', 'trang-chu', '1', '1', '2017-09-15 21:24:36');
INSERT INTO `menu` VALUES ('9', 'Đồ cho bé', 'do-cho-be', '1', '2', '2017-09-15 21:24:59');

-- ----------------------------
-- Table structure for news
-- ----------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `category_id` tinyint(2) DEFAULT NULL,
  `desc` varchar(200) DEFAULT NULL,
  `content` varchar(5000) DEFAULT NULL,
  `author` varchar(40) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `status` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of news
-- ----------------------------

-- ----------------------------
-- Table structure for news_category
-- ----------------------------
DROP TABLE IF EXISTS `news_category`;
CREATE TABLE `news_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `status` tinyint(2) DEFAULT NULL,
  `menu_id` tinyint(3) DEFAULT NULL,
  `priority` tinyint(2) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of news_category
-- ----------------------------

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `pricetotal` int(11) DEFAULT NULL,
  `list_id` varchar(100) DEFAULT NULL COMMENT 'chuoi json',
  `method` tinyint(3) DEFAULT NULL COMMENT '1-tien mat, 2 thanh toan chuyen khoan',
  `pay_status` tinyint(3) DEFAULT NULL COMMENT '0-chua thanh toan, 1-da thanh toan',
  `status` tinyint(3) DEFAULT NULL COMMENT '0- chua giao hang, 1-da giao hang',
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of orders
-- ----------------------------

-- ----------------------------
-- Table structure for order_detail
-- ----------------------------
DROP TABLE IF EXISTS `order_detail`;
CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `status` tinyint(5) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of order_detail
-- ----------------------------

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `alilas` varchar(100) DEFAULT NULL,
  `category_id` tinyint(5) DEFAULT NULL,
  `marken_id` tinyint(5) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `img_thumb` varchar(100) DEFAULT NULL,
  `img` varchar(100) DEFAULT NULL,
  `img_1` varchar(100) DEFAULT NULL,
  `img_2` varchar(100) DEFAULT NULL,
  `img_3` varchar(100) DEFAULT NULL,
  `describe` varchar(400) DEFAULT NULL,
  `expired` datetime DEFAULT NULL,
  `element` varchar(500) DEFAULT NULL COMMENT 'thanh phan san pham',
  `guide` varchar(400) DEFAULT NULL,
  `import_price` varchar(15) DEFAULT NULL,
  `price` varchar(15) DEFAULT NULL,
  `discount` varchar(10) DEFAULT NULL,
  `color` varchar(20) DEFAULT NULL,
  `status` tinyint(2) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES ('1', '1', '1', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `products` VALUES ('2', '2', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);

-- ----------------------------
-- Table structure for products_category
-- ----------------------------
DROP TABLE IF EXISTS `products_category`;
CREATE TABLE `products_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `alias` varchar(50) DEFAULT NULL,
  `status` tinyint(2) DEFAULT NULL,
  `priority` tinyint(2) DEFAULT NULL,
  `menu_id` tinyint(3) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of products_category
-- ----------------------------
INSERT INTO `products_category` VALUES ('5', 'Mặt nạ', 'mat-na', '1', '1', '3', '2017-09-15 21:28:51');
INSERT INTO `products_category` VALUES ('6', 'Son môi', 'son-moi', '1', '2', '3', '2017-09-15 21:29:53');
INSERT INTO `products_category` VALUES ('7', 'Make Up', 'make-up', '1', '3', '3', '2017-09-15 21:30:06');
INSERT INTO `products_category` VALUES ('8', 'Chăm sóc & Làm sạch da', 'cham-soc-&-lam-sach-da', '1', '4', '3', '2017-09-15 21:31:15');
INSERT INTO `products_category` VALUES ('9', 'Sữa', 'sua', '1', '1', '9', '2017-09-15 21:31:55');
INSERT INTO `products_category` VALUES ('14', 'Kem & Bàn chải', 'kem-&-ban-chai', '1', '1', '9', '2017-09-15 21:36:48');
INSERT INTO `products_category` VALUES ('15', 'Vệ sinh răng miệng', 've-sinh-rang-mieng', '1', '1', '3', '2017-09-15 21:36:56');

-- ----------------------------
-- Table structure for sales
-- ----------------------------
DROP TABLE IF EXISTS `sales`;
CREATE TABLE `sales` (
  `id` int(11) unsigned NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `discount` varchar(20) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `type` tinyint(3) DEFAULT NULL COMMENT '0-qua tang, 1- ban hang cho khach',
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sales
-- ----------------------------

-- ----------------------------
-- Table structure for slidebar
-- ----------------------------
DROP TABLE IF EXISTS `slidebar`;
CREATE TABLE `slidebar` (
  `id` int(11) NOT NULL,
  `title` varchar(300) DEFAULT NULL,
  `describe` varchar(500) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL,
  `img` varchar(100) DEFAULT NULL,
  `status` tinyint(2) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of slidebar
-- ----------------------------
INSERT INTO `slidebar` VALUES ('0', 'fdsafdsaf', '<p>fdsafdsafdsaf</p>', 'fdsafdsaf', '9008189347238-1196815_org1.png', null, '2017-09-20 17:26:38');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `address` varchar(300) DEFAULT NULL,
  `address_ship` varchar(400) DEFAULT NULL,
  `city` tinyint(4) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL COMMENT '1 = tu website, 2 = tu fb',
  `group` varchar(5) NOT NULL COMMENT '0-admin , 1=mode, 2 = user',
  `status` tinyint(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'thuynn1709@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'thuynn1709@gmail.com', 'fdafafasdfasdf', null, null, '01732510257', null, '', '1', null, null);
