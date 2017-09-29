/*
Navicat MySQL Data Transfer

Source Server         : nothing
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : shopping

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-09-29 17:45:58
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for config_featureas_items
-- ----------------------------
DROP TABLE IF EXISTS `config_featureas_items`;
CREATE TABLE `config_featureas_items` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of config_featureas_items
-- ----------------------------

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
  `created` int(11) DEFAULT NULL,
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
  `created` int(11) DEFAULT NULL,
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
  `created` int(11) DEFAULT NULL,
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
  `product_total_price` double DEFAULT NULL,
  `versand_in_de` double DEFAULT NULL,
  `versand_to_vn` double(200,0) DEFAULT NULL,
  `status` tinyint(2) DEFAULT NULL COMMENT '0 chua import, 1 da import den bang produt',
  `created` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of import
-- ----------------------------
INSERT INTO `import` VALUES ('1', 'Ngoc Thuy ', '31', '195', '684', '0', '217', null, '2147483647');

-- ----------------------------
-- Table structure for import_detail
-- ----------------------------
DROP TABLE IF EXISTS `import_detail`;
CREATE TABLE `import_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `import_id` int(11) DEFAULT NULL,
  `product_name` varchar(60) DEFAULT NULL,
  `product_alias` varchar(60) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `status` tinyint(2) DEFAULT NULL COMMENT '0- chua import to product, 1- da import',
  `created` int(11) DEFAULT NULL,
  `updated` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of import_detail
-- ----------------------------
INSERT INTO `import_detail` VALUES ('1', '1', 'SkinActive Maske Granatapfel', 'skinactive-maske-granatapfel', '2.2', '2', '0', '20170923', '20170923');
INSERT INTO `import_detail` VALUES ('2', '1', 'SkinActive Maske Grüntee', 'skinactive-maske-grüntee', '2.2', '2', '0', '20170923', '20170923');
INSERT INTO `import_detail` VALUES ('3', '1', 'SkinActive Maske Lavendel', 'skinactive-maske-lavendel', '2.2', '2', '0', '20170922', '20170923');
INSERT INTO `import_detail` VALUES ('4', '1', 'SkinActive Maske Sakura', 'skinactive-maske-sakura', '2.2', '2', '0', '20170923', '20170923');
INSERT INTO `import_detail` VALUES ('5', '1', 'Anti-Age Maske', 'anti-age-maske', '2.2', '2', '0', '20170923', '20170923');
INSERT INTO `import_detail` VALUES ('6', '1', 'Creme-Gel Maske Melone', 'creme-gel-maske-melone', '2.2', '2', '0', '20170923', '20170923');
INSERT INTO `import_detail` VALUES ('7', '1', 'Peel-Off Maske', 'peel-off-maske', '2.2', '2', '0', '20170923', '20170923');
INSERT INTO `import_detail` VALUES ('8', '1', 'Luxus Maske', 'luxus-maske', '2.2', '2', '0', '20170923', '20170923');
INSERT INTO `import_detail` VALUES ('9', '1', 'Peel-Off Maske', 'peel-off-maske', '2.2', '2', '0', '20170923', '20170923');
INSERT INTO `import_detail` VALUES ('10', '1', 'Colour Lippenstift 020', 'colour-lippenstift-020', '2.2', '1', '0', '20170923', '20170923');
INSERT INTO `import_detail` VALUES ('11', '1', 'Ultimate Matt Lipstick 020', 'ultimate-matt-lipstick-020', '2.2', '4', '0', '20170923', '20170923');
INSERT INTO `import_detail` VALUES ('12', '1', 'Ultimate Matt Lipstick 030', 'ultimate-matt-lipstick-030', '2.2', '4', '0', '20170923', '20170923');
INSERT INTO `import_detail` VALUES ('13', '1', 'Velvet Matt Lip Cream 020', 'velvet-matt-lip-cream-020', '2.2', '3', '0', '20170923', '20170923');
INSERT INTO `import_detail` VALUES ('14', '1', 'Velvet Matt Lip Cream 080', 'velvet-matt-lip-cream-080', '2.2', '3', '0', '20170923', '20170923');
INSERT INTO `import_detail` VALUES ('15', '1', 'Ultimate Colour 500', 'ultimate-colour-500', '2.2', '1', '0', '20170923', '20170923');
INSERT INTO `import_detail` VALUES ('16', '1', 'Ultimate Colour 310', 'ultimate-colour-310', '2.2', '1', '0', '20170923', '20170923');
INSERT INTO `import_detail` VALUES ('17', '1', 'Ultimate Colour 370', 'ultimate-colour-370', '2.2', '1', '0', '20170923', '20170923');
INSERT INTO `import_detail` VALUES ('18', '1', 'Ultimate Colour 020', 'ultimate-colour-020', '2.2', '1', '0', '20170923', '20170923');
INSERT INTO `import_detail` VALUES ('19', '1', 'Superstay 24h 135', 'superstay-24h-135', '2.2', '1', '0', '20170923', '20170923');
INSERT INTO `import_detail` VALUES ('20', '1', 'Superstay 24h 460', 'superstay-24h-460', '2.2', '1', '0', '20170923', '20170923');
INSERT INTO `import_detail` VALUES ('21', '1', 'Superstay 24h 542', 'superstay-24h-542', '2.2', '1', '0', '20170923', '20170923');
INSERT INTO `import_detail` VALUES ('22', '1', 'Lips2Last 45A', 'lips2last-45a', '2.2', '2', '0', '20170923', '20170923');
INSERT INTO `import_detail` VALUES ('23', '1', 'Lips2Last 48L', 'lips2last-48l', '2', '2', '0', '20170923', '20170923');
INSERT INTO `import_detail` VALUES ('24', '1', 'Lips2Last 43H', 'lips2last-43h', '2', '2', '0', '20170923', '20170923');
INSERT INTO `import_detail` VALUES ('25', '1', 'Lips2Last 59L', 'lips2last-59l', '2', '2', '0', '20170923', '20170923');
INSERT INTO `import_detail` VALUES ('26', '1', 'Lips2Last 59N', 'lips2last-59n', '2', '2', '0', '20170923', '20170923');
INSERT INTO `import_detail` VALUES ('27', '1', 'Lips2Last 44Q', 'lips2last-44q', '1', '1', '0', '20170923', '20170923');
INSERT INTO `import_detail` VALUES ('28', '1', 'Lips2Last 56Q', 'lips2last-56q', '1', '1', '0', '20170923', '20170923');
INSERT INTO `import_detail` VALUES ('29', '1', 'Lips2Last ', 'lips2last', '1', '1', '0', '20170923', '20170923');
INSERT INTO `import_detail` VALUES ('30', '1', 'All in One Lipstick 470', 'all-in-one-lipstick-470', '2', '2', '0', '20170923', '20170923');
INSERT INTO `import_detail` VALUES ('31', '1', 'All in One Lipstick 470', 'all-in-one-lipstick-470', '3', '333', '0', '20170923', '20170923');

-- ----------------------------
-- Table structure for marken
-- ----------------------------
DROP TABLE IF EXISTS `marken`;
CREATE TABLE `marken` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) DEFAULT NULL,
  `country` varchar(30) DEFAULT NULL,
  `addresse` varchar(50) DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of marken
-- ----------------------------
INSERT INTO `marken` VALUES ('1', 'Manhattan', 'Đức', 'Đức', null);
INSERT INTO `marken` VALUES ('2', 'Catrice', 'Đức', 'Đức', null);
INSERT INTO `marken` VALUES ('3', 'Humana', 'Đức', 'Đức', null);
INSERT INTO `marken` VALUES ('4', 'Sundance', 'Đức', 'Đức', null);
INSERT INTO `marken` VALUES ('5', 'Maybelline', 'Đức', 'Đức', null);
INSERT INTO `marken` VALUES ('6', 'Garnier', 'Đức', 'Đức', null);
INSERT INTO `marken` VALUES ('7', 'Schaebens', 'Đức', 'Đức', null);
INSERT INTO `marken` VALUES ('8', 'Ebelin', 'Đức', 'Đức', null);
INSERT INTO `marken` VALUES ('9', 'Balea', 'Đức', 'Đức', null);
INSERT INTO `marken` VALUES ('10', 'Perlodent', 'Đức', 'Đức', null);

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
  `created` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES ('3', 'Mỹ phẩm ', 'my-pham', '1', '3', '2147483647');
INSERT INTO `menu` VALUES ('6', 'Mua hàng & Thanh toán', 'mua-hang-&-thanh-toan', '1', '4', '2147483647');
INSERT INTO `menu` VALUES ('7', 'Liên hệ', 'lien-he', '1', '5', '2147483647');
INSERT INTO `menu` VALUES ('8', 'Trang chủ', 'trang-chu', '1', '1', '2147483647');
INSERT INTO `menu` VALUES ('9', 'Đồ cho bé', 'do-cho-be', '1', '2', '2147483647');

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
  `status` tinyint(2) DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  `updated` int(11) DEFAULT NULL,
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
  `created` int(11) DEFAULT NULL,
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
  `pay_method` tinyint(3) DEFAULT NULL COMMENT '1-tien mat, 0- thanh toan chuyen khoan',
  `pay_status` tinyint(3) DEFAULT NULL COMMENT '0-chua thanh toan, 1-da thanh toan',
  `status` tinyint(3) DEFAULT NULL COMMENT '0- chua giao hang, 1-da giao hang',
  `created` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of orders
-- ----------------------------
INSERT INTO `orders` VALUES ('1', '1', '2', '230000', '0', '0', '1', '2147483647');

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
  `discount` int(11) DEFAULT NULL,
  `status` tinyint(5) DEFAULT NULL COMMENT '0 chưa hoàn than, 1 hoàn thành',
  `created` int(11) DEFAULT NULL,
  `updated` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of order_detail
-- ----------------------------
INSERT INTO `order_detail` VALUES ('2', '1', '8', '2', '120000', '10000', '1', '2147483647', '2147483647');

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `alias` varchar(100) DEFAULT NULL,
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
  `created` int(11) DEFAULT NULL,
  `updated` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES ('3', '1', '1', '5', '3', '2', null, null, null, null, null, null, null, null, null, null, '140000', null, null, null, null, null);
INSERT INTO `products` VALUES ('4', 'fdasfasfdf', 'fdasfasfdf', null, null, '1111', null, null, null, null, null, null, null, null, null, null, null, null, null, null, '2147483647', null);
INSERT INTO `products` VALUES ('5', '121213', '121213', null, null, '1111', null, null, null, null, null, null, null, null, null, null, '140000', null, null, null, '2147483647', null);
INSERT INTO `products` VALUES ('6', '1213123', '1213123', null, null, '1111', null, null, null, null, null, null, null, null, null, null, null, null, null, null, '2147483647', null);
INSERT INTO `products` VALUES ('7', '12321321', '12321321', null, null, '12123', null, null, null, null, null, null, null, null, null, null, null, null, null, null, '2147483647', null);
INSERT INTO `products` VALUES ('8', 'SkinActive Maske Granatapfel ', 'skinactive-maske-granatapfel', '15', '1', '2', null, null, null, null, null, '', '1970-01-01 01:00:00', '', '', null, '120000', '', '#000000', '1', '2147483647', '2147483647');
INSERT INTO `products` VALUES ('9', 'SkinActive Maske Grüntee', 'skinactive-maske-grüntee', null, null, '2', null, null, null, null, null, null, null, null, null, null, null, null, null, '0', '2147483647', '2147483647');
INSERT INTO `products` VALUES ('10', 'SkinActive Maske Lavendel', 'skinactive-maske-lavendel', null, null, '2', null, null, null, null, null, null, null, null, null, null, null, null, null, '0', '2147483647', '2147483647');
INSERT INTO `products` VALUES ('11', 'SkinActive Maske Sakura', 'skinactive-maske-sakura', null, null, '2', null, null, null, null, null, null, null, null, null, null, null, null, null, '0', '2147483647', '2147483647');
INSERT INTO `products` VALUES ('12', 'Anti-Age Maske', 'anti-age-maske', null, null, '2', null, null, null, null, null, null, null, null, null, null, null, null, null, '0', '2147483647', '2147483647');
INSERT INTO `products` VALUES ('13', 'Creme-Gel Maske Melone', 'creme-gel-maske-melone', null, null, '2', null, null, null, null, null, null, null, null, null, null, null, null, null, '0', '2147483647', '2147483647');
INSERT INTO `products` VALUES ('14', 'Peel-Off Maske', 'peel-off-maske', null, null, '4', null, null, null, null, null, null, null, null, null, null, null, null, null, '0', '2147483647', '2147483647');
INSERT INTO `products` VALUES ('15', 'Luxus Maske', 'luxus-maske', null, null, '2', null, null, null, null, null, null, null, null, null, null, null, null, null, '0', '2147483647', '2147483647');
INSERT INTO `products` VALUES ('16', 'Colour Lippenstift 020', 'colour-lippenstift-020', null, null, '1', null, null, null, null, null, null, null, null, null, null, null, null, null, '0', '2147483647', '2147483647');
INSERT INTO `products` VALUES ('17', 'Ultimate Matt Lipstick 020', 'ultimate-matt-lipstick-020', null, null, '4', null, null, null, null, null, null, null, null, null, null, null, null, null, '0', '2147483647', '2147483647');
INSERT INTO `products` VALUES ('18', 'Ultimate Matt Lipstick 030', 'ultimate-matt-lipstick-030', null, null, '4', null, null, null, null, null, null, null, null, null, null, null, null, null, '0', '2147483647', '2147483647');
INSERT INTO `products` VALUES ('19', 'Velvet Matt Lip Cream 020', 'velvet-matt-lip-cream-020', null, null, '3', null, null, null, null, null, null, null, null, null, null, null, null, null, '0', '2147483647', '2147483647');
INSERT INTO `products` VALUES ('20', 'Velvet Matt Lip Cream 080', 'velvet-matt-lip-cream-080', null, null, '3', null, null, null, null, null, null, null, null, null, null, null, null, null, '0', '2147483647', '2147483647');
INSERT INTO `products` VALUES ('21', 'Ultimate Colour 500', 'ultimate-colour-500', null, null, '1', null, null, null, null, null, null, null, null, null, null, null, null, null, '0', '2147483647', '2147483647');
INSERT INTO `products` VALUES ('22', 'Ultimate Colour 310', 'ultimate-colour-310', null, null, '1', null, null, null, null, null, null, null, null, null, null, null, null, null, '0', '2147483647', '2147483647');
INSERT INTO `products` VALUES ('23', 'Ultimate Colour 370', 'ultimate-colour-370', null, null, '1', null, null, null, null, null, null, null, null, null, null, null, null, null, '0', '2147483647', '2147483647');
INSERT INTO `products` VALUES ('24', 'Ultimate Colour 020', 'ultimate-colour-020', null, null, '1', null, null, null, null, null, null, null, null, null, null, null, null, null, '0', '2147483647', '2147483647');
INSERT INTO `products` VALUES ('25', 'Superstay 24h 135', 'superstay-24h-135', null, null, '1', null, null, null, null, null, null, null, null, null, null, null, null, null, '0', '2147483647', '2147483647');
INSERT INTO `products` VALUES ('26', 'Superstay 24h 460', 'superstay-24h-460', null, null, '1', null, null, null, null, null, null, null, null, null, null, null, null, null, '0', '2147483647', '2147483647');
INSERT INTO `products` VALUES ('27', 'Superstay 24h 542', 'superstay-24h-542', null, null, '1', null, null, null, null, null, null, null, null, null, null, null, null, null, '0', '2147483647', '2147483647');
INSERT INTO `products` VALUES ('28', 'Lips2Last 45A ', 'lips2last-45a', '15', '1', '2', null, null, null, null, null, '', '1970-01-01 00:00:00', '', '', null, '', '', '#000000', '1', '2147483647', '2147483647');
INSERT INTO `products` VALUES ('29', 'Lips2Last 48L', 'lips2last-48l', null, null, '2', null, null, null, null, null, null, null, null, null, null, null, null, null, '0', '2147483647', '2147483647');
INSERT INTO `products` VALUES ('30', 'Lips2Last 43H', 'lips2last-43h', null, null, '2', null, null, null, null, null, null, null, null, null, null, null, null, null, '0', '2147483647', '2147483647');
INSERT INTO `products` VALUES ('31', 'Lips2Last 59L', 'lips2last-59l', null, null, '2', null, null, null, null, null, null, null, null, null, null, null, null, null, '0', '2147483647', '2147483647');
INSERT INTO `products` VALUES ('32', 'Lips2Last 59N', 'lips2last-59n', null, null, '2', null, null, null, null, null, null, null, null, null, null, null, null, null, '0', '2147483647', '2147483647');
INSERT INTO `products` VALUES ('33', 'Lips2Last 44Q', 'lips2last-44q', null, null, '1', null, null, null, null, null, null, null, null, null, null, null, null, null, '0', '2147483647', '2147483647');
INSERT INTO `products` VALUES ('34', 'Lips2Last 56Q', 'lips2last-56q', null, null, '1', null, null, null, null, null, null, null, null, null, null, null, null, null, '0', '2147483647', '2147483647');
INSERT INTO `products` VALUES ('35', 'Lips2Last ', 'lips2last', null, null, '1', null, null, null, null, null, null, null, null, null, null, null, null, null, '0', '2147483647', '2147483647');
INSERT INTO `products` VALUES ('36', 'All in One Lipstick 470', 'all-in-one-lipstick-470', null, null, '335', null, null, null, null, null, null, null, null, null, null, null, null, null, '0', '2147483647', '2147483647');

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
  `created` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of products_category
-- ----------------------------
INSERT INTO `products_category` VALUES ('5', 'Mặt nạ', 'mat-na', '1', '1', '3', '2147483647');
INSERT INTO `products_category` VALUES ('6', 'Son môi', 'son-moi', '1', '2', '3', '2147483647');
INSERT INTO `products_category` VALUES ('7', 'Make Up', 'make-up', '1', '3', '3', '2147483647');
INSERT INTO `products_category` VALUES ('8', 'Chăm sóc & Làm sạch da', 'cham-soc-&-lam-sach-da', '1', '4', '3', '2147483647');
INSERT INTO `products_category` VALUES ('9', 'Sữa', 'sua', '1', '1', '9', '2147483647');
INSERT INTO `products_category` VALUES ('14', 'Kem & Bàn chải', 'kem-&-ban-chai', '1', '1', '9', '2147483647');
INSERT INTO `products_category` VALUES ('15', 'Vệ sinh răng miệng', 've-sinh-rang-mieng', '1', '1', '3', '2147483647');

-- ----------------------------
-- Table structure for sales
-- ----------------------------
DROP TABLE IF EXISTS `sales`;
CREATE TABLE `sales` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_detail_id` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `pricetotal` int(11) DEFAULT NULL,
  `type` tinyint(3) DEFAULT NULL COMMENT '0-qua tang, 1- ban hang cho khach',
  `created` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sales
-- ----------------------------
INSERT INTO `sales` VALUES ('2', '8', '1', '2', '2', '120000', '0', '240000', '1', '2147483647');

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
  `created` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of slidebar
-- ----------------------------
INSERT INTO `slidebar` VALUES ('0', 'fdsafdsaf', '<p>fdsafdsafdsaf</p>', 'fdsafdsaf', '9008189347238-1196815_org1.png', null, '20170920');

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
  `created` int(11) DEFAULT NULL,
  `updated` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'thuynn1709@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'thuynn1709@gmail.com', 'fdafafasdfasdf', null, null, '01732510257', null, '', '1', null, null);
