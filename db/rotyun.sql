/*
Navicat MySQL Data Transfer

Source Server         : Camitss
Source Server Version : 50153
Source Host           : localhost:3306
Source Database       : cambodiaauto

Target Server Type    : MYSQL
Target Server Version : 50153
File Encoding         : 65001

Date: 2012-08-22 17:27:32
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `tbl_body_type`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_body_type`;
CREATE TABLE `tbl_body_type` (
  `body_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `picture` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`body_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of tbl_body_type
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_car`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_car`;
CREATE TABLE `tbl_car` (
  `car_id` int(11) NOT NULL AUTO_INCREMENT,
  `car_code` text,
  `model` text,
  `picture` varchar(255) DEFAULT NULL,
  `manufacturer_id` int(11) DEFAULT NULL,
  `released_year` char(50) DEFAULT NULL,
  `color` char(50) DEFAULT NULL,
  `mileage` decimal(10,0) DEFAULT NULL,
  `body_id` int(255) DEFAULT NULL,
  `steering` varchar(255) DEFAULT NULL,
  `no_seat` int(11) DEFAULT NULL,
  `no_door` int(11) DEFAULT NULL,
  `label_number` text,
  `fuel_type` varchar(255) DEFAULT NULL,
  `transmission` varchar(255) DEFAULT NULL,
  `drive` varchar(255) DEFAULT NULL,
  `engine_size` text,
  `description` blob,
  `video` text,
  `price` double DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status_date` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`car_id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_car
-- ----------------------------
INSERT INTO `tbl_car` VALUES ('1', 'HA001-00001', 'Audi A7 Full Option', '20120628_012123.jpg', '7', '2012', 'Black on Beige', '0', '0', ' Left\r\n', '5', '0', '', ' Petrol\r\n', ' Automatic\r\n', ' 4WD\r\n', '3.0 TFSI S Line Prestige', 0x4155444920413720563620332E30542053757065722063686172676520532D6C696E655F426C61636B5F323031323C6272202F3E0D0A5472616E736D697373696F6E3A0909382053706565642054697074726F6E6963C2AE206175746F6D61746963207472616E736D697373696F6E207769746820445350202844796E616D69632009090953686966742050726F6772616D293C6272202F3E0D0A576865656C3A2009093139E2809D2031302D53706F6B65, '', '115000', '2012-06-28 00:49:53', '2012-06-29 04:04:51', '2012-06-28 00:49:53', '1', '0');
INSERT INTO `tbl_car` VALUES ('2', 'HA001-00002', 'Audi Q5', '20120628_015334.jpg', '7', '2012', 'Black on Titanium Gray', '0', '0', ' Left\r\n', '5', '0', '', ' Petrol\r\n', ' Automatic\r\n', ' 4WD\r\n', '2.0T Quattro', 0x56656869636C652054797065204155444920204D6F64656C20513520426C61636B20323031323C6272202F3E0D0A5472616E736D697373696F6E3A0909382053706565642074697074726F6E6963206175746F6D61746963205472616E736D697373696F6E3C6272202F3E0D0A576865656C3A2009093138E2809D2031302D53706F6B65, '', '80000', '2012-06-28 01:53:34', '2012-06-28 01:53:34', '2012-06-28 01:53:34', '1', '0');
INSERT INTO `tbl_car` VALUES ('3', 'HA001-00003', 'Ford F-150 Lariat', '20120628_024119.jpg', '11', '2006', 'Black on Beige', '0', '0', ' Left\r\n', '5', '0', '', ' Petrol\r\n', ' Automatic\r\n', ' 4WD\r\n', '5.4 Triton', 0x56656869636C65205479706520466F7264204D6F64656C20462D31353020426C61636B2020323030362032482035363632202D2075736564206361723C6272202F3E0D0A5472616E736D697373696F6E3A09093035205370656564206175746F6D61746963205472616E736D697373696F6E3C6272202F3E0D0A576865656C3A2009093137E2809D2030352D53706F6B65, '', '25000', '2012-06-28 02:41:19', '2012-06-29 04:08:09', '2012-06-28 02:41:19', '1', '0');
INSERT INTO `tbl_car` VALUES ('4', 'HA001-00004', 'Hummer H2', '20120628_030618.jpg', '26', '2006', 'Para on bright Titanium', '0', '0', ' Left\r\n', '5', '0', '', ' Petrol\r\n', ' Automatic\r\n', ' 4WD\r\n', '6.0 L', 0x48756D6D65722048322056385F506172615F323030363C6272202F3E0D0A5472616E736D697373696F6E3A09093034205370656564204175746F205472616E736D697373696F6E3C6272202F3E0D0A576865656C3A2009093137E2809D2030372D53706F6B65, '', '33000', '2012-06-28 03:06:18', '2012-06-29 04:09:40', '2012-06-28 03:06:18', '1', '0');
INSERT INTO `tbl_car` VALUES ('5', 'HA001-00005', 'Infiniti G37S', '20120628_032451.jpg', '14', '2008', 'White on beige', '0', '0', ' Left\r\n', '2', '0', '', ' Petrol\r\n', ' Automatic\r\n', ' Rear\r\n', '3.7L, V6', 0x496E66696E69747920473337535F572E4F5F57686974655F323030382030326E6420436172202D2075736564206361723C6272202F3E0D0A5472616E736D697373696F6E3A0909372053706565642074697074726F6E6963206175746F6D61746963205472616E736D697373696F6E3C6272202F3E0D0A576865656C3A2009093139E2809D2031302D53706F6B65, '', '28000', '2012-06-28 03:24:51', '2012-06-29 04:11:12', '2012-06-28 03:24:51', '1', '0');
INSERT INTO `tbl_car` VALUES ('6', 'HA001-00006', 'Infiniti QX56', '20120628_034631.jpg', '14', '2011', 'Black on beige', '0', '0', ' Left\r\n', '8', '0', '', ' Petrol\r\n', ' Automatic\r\n', ' 4WD\r\n', '5.6 L, V8', 0x496E66696E697469205158353620424C41434B20323031313C6272202F3E0D0A5472616E736D697373696F6E3A0909303720205370656564204175746F2D4D616E75616C205472616E736D697373696F6E3C6272202F3E0D0A576865656C3A2009093232E2809D2030392D53706F6B65, '', '130000', '2012-06-28 03:46:31', '2012-06-29 04:14:01', '2012-06-28 03:46:31', '1', '0');
INSERT INTO `tbl_car` VALUES ('7', 'HA001-00007', 'Land Rover Range Rover Discovery 3', '20120628_040334.jpg', '19', '2005', 'Black on beige', '0', '0', ' Left\r\n', '7', '0', '', ' Diesel\r\n', ' Automatic\r\n', ' 4WD\r\n', '2.7 TDV6,HSE', 0x4C616E6420526F7665722052616E676520526F76657220446973636F76657279203320426C61636B2032303035202620323030363C6272202F3E0D0A507269636520666F723A204C616E6420526F7665722052616E676520526F76657220446973636F76657279203320426C61636B20323030352028202434353030202920203C6272202F3E0D0A507269636520666F723A204C616E6420526F7665722052616E676520526F76657220446973636F76657279203320426C61636B2032303036202820243438303020293C6272202F3E0D0A5472616E736D697373696F6E3A0909362053706565642074697074726F6E6963206175746F6D61746963205472616E736D697373696F6E3C6272202F3E0D0A576865656C3A2009093139E2809D2030362D53706F6B65, '', '45000', '2012-06-28 04:03:34', '2012-06-28 04:03:34', '2012-06-28 04:03:34', '1', '0');
INSERT INTO `tbl_car` VALUES ('8', 'HA001-00008', 'Mercedes Benz CLS 550', '20120628_050125.jpg', '20', '2012', 'White on beige', '0', '0', ' Left\r\n', '4', '0', '', ' Petrol\r\n', ' Automatic\r\n', ' 4WD\r\n', '4.6L twin turbo V8', 0x4D657263656465732042656E7A20434C53203535305F57686974655F323031323C6272202F3E0D0A5472616E736D697373696F6E3A0909372053706565642074697074726F6E6963206175746F6D61746963205472616E736D697373696F6E3C6272202F3E0D0A576865656C3A2009093138E2809D20352D53706F6B65, '', '165000', '2012-06-28 05:01:25', '2012-06-28 05:01:25', '2012-06-28 05:01:25', '1', '0');
INSERT INTO `tbl_car` VALUES ('9', 'HA001-00009', 'Mercedes Benz GL350', '20120628_194602.jpg', '20', '2010', 'White on beige', '0', '0', ' Left\r\n', '5', '0', '', ' Diesel\r\n', ' Automatic\r\n', ' 4WD\r\n', '3.0 BlueTEC Turbo diesel V6', 0x4D657263656465732042656E7A20474C33353020426C756574656320332E35205768697465203230313020325231313938202D2075736564206361723C6272202F3E0D0A5472616E736D697373696F6E3A0909372053706565642074697074726F6E6963206175746F6D61746963205472616E736D697373696F6E3C6272202F3E0D0A576865656C3A2009093230E2809D2031302D53706F6B65, '', '90000', '2012-06-28 19:46:02', '2012-06-29 04:19:05', '2012-06-28 19:46:02', '1', '0');
INSERT INTO `tbl_car` VALUES ('10', 'HA001-00010', 'Mercedes Benz GL350', '20120628_195935.jpg', '20', '2012', 'Black on beige', '0', '0', ' Left\r\n', '5', '0', '', ' Diesel\r\n', ' Automatic\r\n', ' 4WD\r\n', '3.0', 0x56656869636C652054797065204D657263656465732042656E7A20204D6F64656C20474C3335302020426C61636B20323031323C6272202F3E0D0A5472616E736D697373696F6E3A0909372053706565642074697074726F6E6963206175746F6D61746963205472616E736D697373696F6E3C6272202F3E0D0A576865656C3A2009093230E2809D2031302D53706F6B65, '', '130000', '2012-06-28 19:59:11', '2012-06-28 19:59:35', '2012-06-28 19:59:11', '1', '0');
INSERT INTO `tbl_car` VALUES ('11', 'HA001-00011', 'Mercedes-Benz E350', '20120628_203130.jpg', '20', '2010', 'Black on beige', '0', '0', ' Left\r\n', '5', '0', '', ' Petrol\r\n', ' Automatic\r\n', ' 4WD\r\n', '3.5L Direct Injection V6', 0x4D65726365646573204533353020626C61636B20323031302032552033383338202D2075736564206361723C6272202F3E0D0A5472616E736D697373696F6E3A0909372053706565642074697074726F6E6963206175746F6D61746963205472616E736D697373696F6E3C6272202F3E0D0A576865656C3A2009093138E2809D20352D53706F6B65, '', '75000', '2012-06-28 20:31:30', '2012-06-28 23:02:58', '2012-06-28 20:31:30', '1', '0');
INSERT INTO `tbl_car` VALUES ('12', 'HA001-00012', 'Mini Cooper Country man', '20120628_205713.jpg', '27', '2011', 'White on beige', '0', '0', ' Left\r\n', '4', '0', '', ' Petrol\r\n', ' Manual\r\n', ' 4WD\r\n', '1.6L', 0x4D696E6920636F6F70657220776869746520323031313C6272202F3E0D0A5472616E736D697373696F6E3A090936205370656564206D616E75616C205472616E736D697373696F6E3C6272202F3E0D0A576865656C3A2009093138E2809D2031302D53706F6B65, '', '47000', '2012-06-28 20:57:13', '2012-06-28 20:57:13', '2012-06-28 20:57:13', '1', '0');
INSERT INTO `tbl_car` VALUES ('13', 'HA001-00013', 'Porsche Cayenne S Hybrid', '20120628_211331.jpg', '23', '2011', 'Titanium Gray on black', '0', '0', ' Left\r\n', '5', '0', '', ' Petrol\r\n', ' Automatic\r\n', ' 4WD\r\n', '3.0', 0x506F727363686520436179656E6E652020532048796272696420546974616E69756D204772617920323031313C6272202F3E0D0A5472616E736D697373696F6E3A0909382053706565642074697074726F6E6963207320696E636C7573697665206175746F2073746172743C6272202F3E0D0A576865656C3A2009093230E2809D2031302D53706F6B65, '', '122000', '2012-06-28 21:13:31', '2012-08-22 03:06:00', '2012-08-22 03:06:00', '1', '0');
INSERT INTO `tbl_car` VALUES ('14', 'HA001-00014', 'Toyota Alphard', '20120628_214352.jpg', '1', '2011', 'White on beige', '0', '0', ' Left\r\n', '7', '0', '', ' Petrol\r\n', ' Automatic\r\n', ' 4WD\r\n', '2.4', 0x546F796F74617420416C7068617264205768697465203230313120327736373637202D2075736564206361723C6272202F3E0D0A5472616E736D697373696F6E3A0909372053706565642074697074726F6E6963206175746F6D61746963205472616E736D697373696F6E3C6272202F3E0D0A576865656C3A2009093136E2809D20362D53706F6B65, '', '67000', '2012-06-28 21:43:52', '2012-06-29 04:24:43', '2012-06-28 21:51:16', '1', '0');
INSERT INTO `tbl_car` VALUES ('15', 'HA001-00015', 'Toyota Camry', '20120628_221340.jpg', '1', '2008', 'Black on beige', '0', '0', ' Left\r\n', '5', '0', '', ' Petrol\r\n', ' Automatic\r\n', ' Front\r\n', '2.4', 0x56656869636C65205479706520546F796F74612043616D727920426C61636B203230303820325137373537202D2075736564206361723C6272202F3E0D0A5472616E736D697373696F6E3A09093553706565642074697074726F6E6963206175746F6D61746963205472616E736D697373696F6E3C6272202F3E0D0A576865656C3A2009093137E2809D20392D53706F6B65, '', '33000', '2012-06-28 22:13:40', '2012-06-28 22:15:53', '2012-06-28 22:13:40', '1', '0');
INSERT INTO `tbl_car` VALUES ('16', 'HA001-00016', 'Toyota Hiace', '20120628_222608.jpg', '1', '2011', 'White on Gray', '0', '0', ' Left\r\n', '15', '0', '', ' Diesel\r\n', ' Manual\r\n', ' 4WD\r\n', '2.7', 0x546F796F746120486961636520576869746520323031313C6272202F3E0D0A5472616E736D697373696F6E3A090935205370656564206D616E75616C205472616E736D697373696F6E3C6272202F3E0D0A576865656C3A2009093135E2809D20737465656C20776865656C, '', '43000', '2012-06-28 22:26:08', '2012-06-29 04:31:39', '2012-06-28 22:26:08', '1', '0');
INSERT INTO `tbl_car` VALUES ('17', 'HA001-00017', 'Toyota Hiace', '20120628_223932.jpg', '1', '2008', 'Silver on Gray', '0', '0', ' Left\r\n', '15', '0', '', ' Diesel\r\n', ' Manual\r\n', ' 4WD\r\n', '2.7', 0x56656869636C65205479706520546F796F746120204D6F64656C2048696163652053696C766572203230303820324B38313938202D207573656420636172203C6272202F3E0D0A5472616E736D697373696F6E3A090935205370656564206D616E75616C205472616E736D697373696F6E3C6272202F3E0D0A576865656C3A2009093135E2809D2030362D53706F6B65, '', '32000', '2012-06-28 22:39:32', '2012-06-29 04:28:16', '2012-06-28 22:39:32', '1', '0');
INSERT INTO `tbl_car` VALUES ('18', 'HA001-00018', 'Toyota Hiace', '20120628_225504.jpg', '1', '2008', 'White on Gray', '0', '0', ' Left\r\n', '15', '0', '', ' Diesel\r\n', ' Manual\r\n', ' 4WD\r\n', '2.7', 0x56656869636C65205479706520546F796F7461204D6F64656C204869616365205768697465203230303820324A38353134202D2075736564206361723C6272202F3E0D0A5472616E736D697373696F6E3A090935205370656564206D616E75616C205472616E736D697373696F6E3C6272202F3E0D0A576865656C3A2009093135E2809D20362D53706F6B65, '', '32000', '2012-06-28 22:55:04', '2012-06-28 22:55:04', '2012-06-28 22:55:04', '1', '0');
INSERT INTO `tbl_car` VALUES ('19', 'HA001-00019', 'Toyota Highlander Hybrid', '20120628_231530.jpg', '1', '2009', 'Silver on beige', '0', '0', ' Left\r\n', '7', '0', '', ' Petrol\r\n', ' Automatic\r\n', ' 4WD\r\n', '3.3 L', 0x546F796F746120486967686C616E646572204879627269642053796E65726779204472697665204C696D697465642053696C76657220323030393C6272202F3E0D0A5472616E736D697373696F6E3A09093220537065656420435654205472616E736D697373696F6E3C6272202F3E0D0A576865656C3A2009093139E2809D2031302D53706F6B65, '', '65000', '2012-06-28 23:15:30', '2012-06-28 23:17:43', '2012-06-28 23:15:30', '1', '0');
INSERT INTO `tbl_car` VALUES ('20', 'HA001-00020', 'Toyota Land cruiser GXR-V8 ', '20120629_004542.jpg', '1', '2012', 'Silver on beige', '0', '0', ' Left\r\n', '7', '0', '', ' Diesel\r\n', ' Automatic\r\n', ' 4WD\r\n', '4.5', 0x546F796F7461204C616E646372756973657220475852205636204761736F6C696E655F426C61636B5F323031323C6272202F3E0D0A5472616E736D697373696F6E3A090936205370656564206175746F6D61746963205472616E736D697373696F6E3C6272202F3E0D0A576865656C3A2009093137E2809D2031302D53706F6B65, '', '117000', '2012-06-28 23:25:28', '2012-06-29 00:45:42', '2012-06-28 23:25:28', '1', '0');
INSERT INTO `tbl_car` VALUES ('21', 'HA001-00021', 'Toyota Land cruiser Prado  TX.L ', '20120822_081930.jpg', '1', '2012', 'Beige on beige', '0', '0', ' Left\r\n', '7', '0', '', ' Diesel\r\n', ' Automatic\r\n', ' 4WD\r\n', '2.7 L', 0x546F796F7461204C616E646372756973657220507261646F20332E302054582E4C5F42656967655F323031323C6272202F3E0D0A5472616E736D697373696F6E3A090934205370656564206175746F6D61746963205472616E736D697373696F6E603C6272202F3E0D0A576865656C3A2009093137E2809D2030362D53706F6B65, '', '80000', '2012-06-29 01:22:32', '2012-08-22 08:19:30', '2012-08-22 08:19:30', '1', '0');
INSERT INTO `tbl_car` VALUES ('22', 'HA001-00022', 'Toyota Land cruiser Prado  TX.L', '20120629_013825.jpg', '1', '2012', 'Black on beige', '0', '0', ' Left\r\n', '7', '0', '', ' Diesel\r\n', ' Automatic\r\n', ' 4WD\r\n', '2.7', 0x546F796F7461204C616E646372756973657220507261646F20332E302054582E4C20426C61636B20323031323C6272202F3E0D0A5472616E736D697373696F6E3A09093034207370656564206175746F6D61746963205472616E736D697373696F6E3C6272202F3E0D0A576865656C3A2009093137E2809D20362D53706F6B65, '', '80000', '2012-06-29 01:38:25', '2012-06-29 01:42:09', '2012-06-29 01:38:25', '1', '0');
INSERT INTO `tbl_car` VALUES ('23', 'HA001-00023', 'Toyota Land cruiser Prado  TX.L ', '20120629_020145.jpg', '1', '2012', 'Silver on Saddle tan', '0', '0', ' Left\r\n', '7', '0', '', ' Diesel\r\n', ' Automatic\r\n', ' 4WD\r\n', '2.7', 0x546F796F7461204C616E646372756973657220507261646F20332E302054582E4C2053696C76657220323031323C6272202F3E0D0A5472616E736D697373696F6E3A090934205370656564206175746F6D61746963205472616E736D697373696F6E3C6272202F3E0D0A576865656C3A2009093137E2809D20362D53706F6B65, '', '80000', '2012-06-29 02:01:45', '2012-08-20 09:52:37', '2012-08-20 09:52:37', '2', '0');
INSERT INTO `tbl_car` VALUES ('24', 'HA001-00024', 'Toyota Tundra PU ', '20120629_021643.jpg', '1', '2007', 'Red on beige', '0', '0', ' Left\r\n', '5', '0', '', ' Petrol\r\n', ' Automatic\r\n', ' 4WD\r\n', '5.7', 0x546F796F74612054756E6472612050552052656420323030373C6272202F3E0D0A5472616E736D697373696F6E3A090936205370656564206175746F6D61746963205472616E736D697373696F6E3C6272202F3E0D0A576865656C3A2009093230E2809D2031302D53706F6B65, '', '36000', '2012-06-29 02:16:43', '2012-08-20 10:31:54', '2012-08-20 10:31:54', '2', '1');
INSERT INTO `tbl_car` VALUES ('25', 'HA001-00025', 'Toyota Tundra PU ', '20120629_023620.jpg', '1', '2008', 'Gold on beige', '0', '0', ' Left\r\n', '5', '0', '', ' Petrol\r\n', ' Automatic\r\n', ' 4WD\r\n', '5.7L', 0x56656869636C6573205479706520546F796F7461204D6F64656C2054756E64726120476F6C6420323030383C6272202F3E0D0A5472616E736D697373696F6E3A090936205370656564206175746F6D617469632F6D616E75616C205472616E736D697373696F6E3C6272202F3E0D0A576865656C3A2009093230E2809D20352D53706F6B65, '', '38000', '2012-06-29 02:36:20', '2012-06-29 02:36:20', '2012-08-21 02:56:34', '1', '0');
INSERT INTO `tbl_car` VALUES ('26', 'HA001-00026', 'AAA', '20120822_035842.jpg', '7', '', 'N/A', '0', '0', ' Left\r\n', '0', '0', '', ' Gasoline\r\n', ' Automatic\r\n', ' 4WD\r\n', '', '', '', '0', '2012-08-22 03:11:18', '2012-08-22 03:58:42', '2012-08-22 03:58:42', '1', '0');
INSERT INTO `tbl_car` VALUES ('27', 'HA001-00027', 'BBB', '20120822_102200.jpg', '7', '', 'N/A', '0', '0', ' Left\r\n', '0', '0', '', ' Gasoline\r\n', ' Automatic\r\n', ' 4WD\r\n', '', '', '', '0', '2012-08-22 04:11:22', '2012-08-22 10:22:00', '2012-08-22 10:22:00', '1', '0');

-- ----------------------------
-- Table structure for `tbl_car_decription`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_car_decription`;
CREATE TABLE `tbl_car_decription` (
  `car_id` int(11) NOT NULL DEFAULT '0',
  `name` text,
  `description` text,
  PRIMARY KEY (`car_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_car_decription
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_car_image`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_car_image`;
CREATE TABLE `tbl_car_image` (
  `car_image_id` int(11) NOT NULL AUTO_INCREMENT,
  `car_id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`car_image_id`)
) ENGINE=MyISAM AUTO_INCREMENT=170 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of tbl_car_image
-- ----------------------------
INSERT INTO `tbl_car_image` VALUES ('7', '1', '1_20120628_012307_1.jpg');
INSERT INTO `tbl_car_image` VALUES ('8', '1', '1_20120628_012307_2.jpg');
INSERT INTO `tbl_car_image` VALUES ('9', '1', '1_20120628_012307_3.jpg');
INSERT INTO `tbl_car_image` VALUES ('10', '1', '1_20120628_012307_4.jpg');
INSERT INTO `tbl_car_image` VALUES ('11', '1', '1_20120628_012307_5.jpg');
INSERT INTO `tbl_car_image` VALUES ('12', '2', '2_20120628_015449_1.jpg');
INSERT INTO `tbl_car_image` VALUES ('13', '2', '2_20120628_015450_2.jpg');
INSERT INTO `tbl_car_image` VALUES ('14', '2', '2_20120628_015450_3.jpg');
INSERT INTO `tbl_car_image` VALUES ('15', '2', '2_20120628_015450_4.jpg');
INSERT INTO `tbl_car_image` VALUES ('16', '3', '3_20120628_024208_1.jpg');
INSERT INTO `tbl_car_image` VALUES ('17', '3', '3_20120628_024208_2.jpg');
INSERT INTO `tbl_car_image` VALUES ('18', '3', '3_20120628_024208_3.jpg');
INSERT INTO `tbl_car_image` VALUES ('19', '4', '4_20120628_030721_1.jpg');
INSERT INTO `tbl_car_image` VALUES ('20', '4', '4_20120628_030721_2.jpg');
INSERT INTO `tbl_car_image` VALUES ('21', '4', '4_20120628_030721_3.jpg');
INSERT INTO `tbl_car_image` VALUES ('22', '4', '4_20120628_030721_4.jpg');
INSERT INTO `tbl_car_image` VALUES ('23', '4', '4_20120628_030721_5.jpg');
INSERT INTO `tbl_car_image` VALUES ('24', '4', '4_20120628_030721_6.jpg');
INSERT INTO `tbl_car_image` VALUES ('25', '5', '5_20120628_032750_1.jpg');
INSERT INTO `tbl_car_image` VALUES ('26', '5', '5_20120628_032750_2.jpg');
INSERT INTO `tbl_car_image` VALUES ('27', '5', '5_20120628_032750_3.jpg');
INSERT INTO `tbl_car_image` VALUES ('28', '5', '5_20120628_032750_4.jpg');
INSERT INTO `tbl_car_image` VALUES ('29', '5', '5_20120628_032750_5.jpg');
INSERT INTO `tbl_car_image` VALUES ('30', '5', '5_20120628_032750_6.jpg');
INSERT INTO `tbl_car_image` VALUES ('31', '5', '5_20120628_032750_7.jpg');
INSERT INTO `tbl_car_image` VALUES ('32', '6', '6_20120628_034755_1.jpg');
INSERT INTO `tbl_car_image` VALUES ('33', '6', '6_20120628_034755_2.jpg');
INSERT INTO `tbl_car_image` VALUES ('34', '6', '6_20120628_034755_3.jpg');
INSERT INTO `tbl_car_image` VALUES ('35', '6', '6_20120628_034755_4.jpg');
INSERT INTO `tbl_car_image` VALUES ('36', '6', '6_20120628_034755_5.jpg');
INSERT INTO `tbl_car_image` VALUES ('37', '6', '6_20120628_034755_6.jpg');
INSERT INTO `tbl_car_image` VALUES ('38', '7', '7_20120628_040500_1.jpg');
INSERT INTO `tbl_car_image` VALUES ('39', '7', '7_20120628_040500_2.jpg');
INSERT INTO `tbl_car_image` VALUES ('40', '7', '7_20120628_040500_3.jpg');
INSERT INTO `tbl_car_image` VALUES ('41', '7', '7_20120628_040500_4.jpg');
INSERT INTO `tbl_car_image` VALUES ('42', '7', '7_20120628_041254_1.jpg');
INSERT INTO `tbl_car_image` VALUES ('43', '8', '8_20120628_050228_1.jpg');
INSERT INTO `tbl_car_image` VALUES ('44', '8', '8_20120628_050228_2.jpg');
INSERT INTO `tbl_car_image` VALUES ('45', '8', '8_20120628_050228_3.jpg');
INSERT INTO `tbl_car_image` VALUES ('46', '8', '8_20120628_050228_4.jpg');
INSERT INTO `tbl_car_image` VALUES ('47', '9', '9_20120628_194726_1.jpg');
INSERT INTO `tbl_car_image` VALUES ('48', '9', '9_20120628_194726_2.jpg');
INSERT INTO `tbl_car_image` VALUES ('49', '9', '9_20120628_194726_3.jpg');
INSERT INTO `tbl_car_image` VALUES ('50', '9', '9_20120628_194726_4.jpg');
INSERT INTO `tbl_car_image` VALUES ('51', '9', '9_20120628_194726_5.jpg');
INSERT INTO `tbl_car_image` VALUES ('52', '9', '9_20120628_194726_6.jpg');
INSERT INTO `tbl_car_image` VALUES ('53', '10', '10_20120628_200023_1.jpg');
INSERT INTO `tbl_car_image` VALUES ('54', '10', '10_20120628_200023_2.jpg');
INSERT INTO `tbl_car_image` VALUES ('55', '10', '10_20120628_200023_3.jpg');
INSERT INTO `tbl_car_image` VALUES ('56', '10', '10_20120628_200023_4.jpg');
INSERT INTO `tbl_car_image` VALUES ('57', '10', '10_20120628_200023_5.jpg');
INSERT INTO `tbl_car_image` VALUES ('58', '10', '10_20120628_200023_6.jpg');
INSERT INTO `tbl_car_image` VALUES ('59', '10', '10_20120628_200023_7.jpg');
INSERT INTO `tbl_car_image` VALUES ('60', '11', '11_20120628_203208_1.jpg');
INSERT INTO `tbl_car_image` VALUES ('61', '11', '11_20120628_203208_2.jpg');
INSERT INTO `tbl_car_image` VALUES ('62', '11', '11_20120628_203208_3.jpg');
INSERT INTO `tbl_car_image` VALUES ('63', '11', '11_20120628_203208_4.jpg');
INSERT INTO `tbl_car_image` VALUES ('64', '12', '12_20120628_205838_1.jpg');
INSERT INTO `tbl_car_image` VALUES ('65', '12', '12_20120628_205839_2.jpg');
INSERT INTO `tbl_car_image` VALUES ('66', '12', '12_20120628_205839_3.jpg');
INSERT INTO `tbl_car_image` VALUES ('67', '12', '12_20120628_205839_4.jpg');
INSERT INTO `tbl_car_image` VALUES ('68', '12', '12_20120628_205839_5.jpg');
INSERT INTO `tbl_car_image` VALUES ('69', '12', '12_20120628_205839_6.jpg');
INSERT INTO `tbl_car_image` VALUES ('70', '13', '13_20120628_211415_1.jpg');
INSERT INTO `tbl_car_image` VALUES ('71', '13', '13_20120628_211415_2.jpg');
INSERT INTO `tbl_car_image` VALUES ('72', '13', '13_20120628_211415_3.jpg');
INSERT INTO `tbl_car_image` VALUES ('73', '13', '13_20120628_211415_4.jpg');
INSERT INTO `tbl_car_image` VALUES ('74', '13', '13_20120628_211415_5.jpg');
INSERT INTO `tbl_car_image` VALUES ('75', '13', '13_20120628_211415_6.jpg');
INSERT INTO `tbl_car_image` VALUES ('76', '14', '14_20120628_214438_1.jpg');
INSERT INTO `tbl_car_image` VALUES ('77', '14', '14_20120628_214438_2.jpg');
INSERT INTO `tbl_car_image` VALUES ('78', '14', '14_20120628_214438_3.jpg');
INSERT INTO `tbl_car_image` VALUES ('79', '14', '14_20120628_214438_4.jpg');
INSERT INTO `tbl_car_image` VALUES ('80', '14', '14_20120628_214438_5.jpg');
INSERT INTO `tbl_car_image` VALUES ('81', '14', '14_20120628_214438_6.jpg');
INSERT INTO `tbl_car_image` VALUES ('82', '14', '14_20120628_214438_7.jpg');
INSERT INTO `tbl_car_image` VALUES ('83', '15', '15_20120628_221428_1.jpg');
INSERT INTO `tbl_car_image` VALUES ('84', '15', '15_20120628_221428_2.jpg');
INSERT INTO `tbl_car_image` VALUES ('85', '15', '15_20120628_221428_3.jpg');
INSERT INTO `tbl_car_image` VALUES ('86', '15', '15_20120628_221428_4.jpg');
INSERT INTO `tbl_car_image` VALUES ('87', '15', '15_20120628_221428_5.jpg');
INSERT INTO `tbl_car_image` VALUES ('88', '16', '16_20120628_222718_1.jpg');
INSERT INTO `tbl_car_image` VALUES ('89', '16', '16_20120628_222718_2.jpg');
INSERT INTO `tbl_car_image` VALUES ('90', '16', '16_20120628_222718_3.jpg');
INSERT INTO `tbl_car_image` VALUES ('91', '16', '16_20120628_222718_4.jpg');
INSERT INTO `tbl_car_image` VALUES ('92', '16', '16_20120628_222718_5.jpg');
INSERT INTO `tbl_car_image` VALUES ('93', '16', '16_20120628_222718_6.jpg');
INSERT INTO `tbl_car_image` VALUES ('94', '17', '17_20120628_224028_1.jpg');
INSERT INTO `tbl_car_image` VALUES ('95', '17', '17_20120628_224028_2.jpg');
INSERT INTO `tbl_car_image` VALUES ('96', '17', '17_20120628_224028_3.jpg');
INSERT INTO `tbl_car_image` VALUES ('97', '17', '17_20120628_224028_4.jpg');
INSERT INTO `tbl_car_image` VALUES ('98', '17', '17_20120628_224028_5.jpg');
INSERT INTO `tbl_car_image` VALUES ('99', '17', '17_20120628_224028_6.jpg');
INSERT INTO `tbl_car_image` VALUES ('100', '17', '17_20120628_224028_7.jpg');
INSERT INTO `tbl_car_image` VALUES ('101', '17', '17_20120628_224028_8.jpg');
INSERT INTO `tbl_car_image` VALUES ('102', '18', '18_20120628_225622_1.jpg');
INSERT INTO `tbl_car_image` VALUES ('103', '18', '18_20120628_225622_2.jpg');
INSERT INTO `tbl_car_image` VALUES ('104', '18', '18_20120628_225622_3.jpg');
INSERT INTO `tbl_car_image` VALUES ('105', '18', '18_20120628_225622_4.jpg');
INSERT INTO `tbl_car_image` VALUES ('106', '18', '18_20120628_225622_5.jpg');
INSERT INTO `tbl_car_image` VALUES ('107', '18', '18_20120628_225622_6.jpg');
INSERT INTO `tbl_car_image` VALUES ('108', '18', '18_20120628_225622_7.jpg');
INSERT INTO `tbl_car_image` VALUES ('109', '18', '18_20120628_225622_8.jpg');
INSERT INTO `tbl_car_image` VALUES ('110', '19', '19_20120628_231629_1.jpg');
INSERT INTO `tbl_car_image` VALUES ('111', '19', '19_20120628_231629_2.jpg');
INSERT INTO `tbl_car_image` VALUES ('112', '19', '19_20120628_231629_3.jpg');
INSERT INTO `tbl_car_image` VALUES ('113', '19', '19_20120628_231629_4.jpg');
INSERT INTO `tbl_car_image` VALUES ('114', '19', '19_20120628_231629_5.jpg');
INSERT INTO `tbl_car_image` VALUES ('115', '19', '19_20120628_231629_6.jpg');
INSERT INTO `tbl_car_image` VALUES ('116', '19', '19_20120628_231629_7.jpg');
INSERT INTO `tbl_car_image` VALUES ('117', '19', '19_20120628_231629_8.jpg');
INSERT INTO `tbl_car_image` VALUES ('125', '20', '20_20120629_010243_4.jpg');
INSERT INTO `tbl_car_image` VALUES ('124', '20', '20_20120629_010243_3.jpg');
INSERT INTO `tbl_car_image` VALUES ('123', '20', '20_20120629_010243_2.jpg');
INSERT INTO `tbl_car_image` VALUES ('122', '20', '20_20120629_010243_1.jpg');
INSERT INTO `tbl_car_image` VALUES ('126', '21', '21_20120629_012349_1.jpg');
INSERT INTO `tbl_car_image` VALUES ('127', '21', '21_20120629_012349_2.jpg');
INSERT INTO `tbl_car_image` VALUES ('128', '21', '21_20120629_012349_3.jpg');
INSERT INTO `tbl_car_image` VALUES ('129', '21', '21_20120629_012349_4.jpg');
INSERT INTO `tbl_car_image` VALUES ('130', '22', '22_20120629_013907_1.jpg');
INSERT INTO `tbl_car_image` VALUES ('131', '22', '22_20120629_013907_2.jpg');
INSERT INTO `tbl_car_image` VALUES ('132', '22', '22_20120629_013907_3.jpg');
INSERT INTO `tbl_car_image` VALUES ('133', '22', '22_20120629_013907_4.jpg');
INSERT INTO `tbl_car_image` VALUES ('134', '22', '22_20120629_013907_5.jpg');
INSERT INTO `tbl_car_image` VALUES ('135', '22', '22_20120629_013907_6.jpg');
INSERT INTO `tbl_car_image` VALUES ('136', '23', '23_20120629_020403_1.jpg');
INSERT INTO `tbl_car_image` VALUES ('137', '23', '23_20120629_020403_2.jpg');
INSERT INTO `tbl_car_image` VALUES ('138', '23', '23_20120629_020403_3.jpg');
INSERT INTO `tbl_car_image` VALUES ('139', '23', '23_20120629_020403_4.jpg');
INSERT INTO `tbl_car_image` VALUES ('140', '23', '23_20120629_020403_5.jpg');
INSERT INTO `tbl_car_image` VALUES ('141', '23', '23_20120629_020403_6.jpg');
INSERT INTO `tbl_car_image` VALUES ('142', '24', '24_20120629_021818_1.jpg');
INSERT INTO `tbl_car_image` VALUES ('143', '24', '24_20120629_021818_2.jpg');
INSERT INTO `tbl_car_image` VALUES ('144', '24', '24_20120629_021818_3.jpg');
INSERT INTO `tbl_car_image` VALUES ('145', '24', '24_20120629_021818_4.jpg');
INSERT INTO `tbl_car_image` VALUES ('146', '24', '24_20120629_021818_5.jpg');
INSERT INTO `tbl_car_image` VALUES ('147', '25', '25_20120629_023704_1.jpg');
INSERT INTO `tbl_car_image` VALUES ('148', '25', '25_20120629_023704_2.jpg');
INSERT INTO `tbl_car_image` VALUES ('149', '25', '25_20120629_023704_3.jpg');
INSERT INTO `tbl_car_image` VALUES ('150', '25', '25_20120629_023704_4.jpg');
INSERT INTO `tbl_car_image` VALUES ('151', '25', '25_20120629_023704_5.jpg');
INSERT INTO `tbl_car_image` VALUES ('152', '25', '25_20120629_023704_6.jpg');
INSERT INTO `tbl_car_image` VALUES ('162', '26', '26_20120822_075830_1.jpg');

-- ----------------------------
-- Table structure for `tbl_car_to_category`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_car_to_category`;
CREATE TABLE `tbl_car_to_category` (
  `car_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`car_id`,`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of tbl_car_to_category
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_car_to_store`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_car_to_store`;
CREATE TABLE `tbl_car_to_store` (
  `car_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`car_id`,`store_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of tbl_car_to_store
-- ----------------------------
INSERT INTO `tbl_car_to_store` VALUES ('1', '1');
INSERT INTO `tbl_car_to_store` VALUES ('2', '1');
INSERT INTO `tbl_car_to_store` VALUES ('3', '1');
INSERT INTO `tbl_car_to_store` VALUES ('4', '1');
INSERT INTO `tbl_car_to_store` VALUES ('5', '1');
INSERT INTO `tbl_car_to_store` VALUES ('6', '1');
INSERT INTO `tbl_car_to_store` VALUES ('7', '1');
INSERT INTO `tbl_car_to_store` VALUES ('8', '1');
INSERT INTO `tbl_car_to_store` VALUES ('9', '1');
INSERT INTO `tbl_car_to_store` VALUES ('10', '1');
INSERT INTO `tbl_car_to_store` VALUES ('11', '1');
INSERT INTO `tbl_car_to_store` VALUES ('12', '1');
INSERT INTO `tbl_car_to_store` VALUES ('13', '1');
INSERT INTO `tbl_car_to_store` VALUES ('14', '1');
INSERT INTO `tbl_car_to_store` VALUES ('15', '1');
INSERT INTO `tbl_car_to_store` VALUES ('16', '1');
INSERT INTO `tbl_car_to_store` VALUES ('17', '1');
INSERT INTO `tbl_car_to_store` VALUES ('18', '1');
INSERT INTO `tbl_car_to_store` VALUES ('19', '1');
INSERT INTO `tbl_car_to_store` VALUES ('20', '1');
INSERT INTO `tbl_car_to_store` VALUES ('21', '1');
INSERT INTO `tbl_car_to_store` VALUES ('22', '1');
INSERT INTO `tbl_car_to_store` VALUES ('23', '1');
INSERT INTO `tbl_car_to_store` VALUES ('24', '1');
INSERT INTO `tbl_car_to_store` VALUES ('25', '1');
INSERT INTO `tbl_car_to_store` VALUES ('26', '1');
INSERT INTO `tbl_car_to_store` VALUES ('27', '1');

-- ----------------------------
-- Table structure for `tbl_category`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_category`;
CREATE TABLE `tbl_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `decription` text COLLATE utf8_bin,
  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of tbl_category
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_manufacturer`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_manufacturer`;
CREATE TABLE `tbl_manufacturer` (
  `manufacturer_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `picture` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `showable` int(11) DEFAULT '1',
  PRIMARY KEY (`manufacturer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of tbl_manufacturer
-- ----------------------------
INSERT INTO `tbl_manufacturer` VALUES ('1', 'Toyota', 'toyota.png', '1');
INSERT INTO `tbl_manufacturer` VALUES ('2', 'Lexus', 'lexus.png', '1');
INSERT INTO `tbl_manufacturer` VALUES ('3', 'Nissan', 'nissan.png', '1');
INSERT INTO `tbl_manufacturer` VALUES ('7', 'Audi', 'audi.png', '1');
INSERT INTO `tbl_manufacturer` VALUES ('8', 'BMW', 'bmw.png', '1');
INSERT INTO `tbl_manufacturer` VALUES ('9', 'Cadillac', 'cadillac.png', '1');
INSERT INTO `tbl_manufacturer` VALUES ('10', 'Chevrolet', 'chevrolet.png', '1');
INSERT INTO `tbl_manufacturer` VALUES ('11', 'Ford', 'ford.png', '1');
INSERT INTO `tbl_manufacturer` VALUES ('12', 'Honda', 'honda.png', '1');
INSERT INTO `tbl_manufacturer` VALUES ('13', 'Hyundai', 'hyandai.png', '1');
INSERT INTO `tbl_manufacturer` VALUES ('14', 'Infiniti', 'infiniti.png', '1');
INSERT INTO `tbl_manufacturer` VALUES ('15', 'Isuzu', 'isuzu.png', '1');
INSERT INTO `tbl_manufacturer` VALUES ('17', 'Jaguar', 'jaguar', '1');
INSERT INTO `tbl_manufacturer` VALUES ('18', 'Kia', 'kia.png', '1');
INSERT INTO `tbl_manufacturer` VALUES ('19', 'Land Rover', 'landrover.png', '1');
INSERT INTO `tbl_manufacturer` VALUES ('20', 'Mercedes-Benz', 'mercedes.png', '1');
INSERT INTO `tbl_manufacturer` VALUES ('21', 'Mitsubishi', 'mitsubishi.png', '1');
INSERT INTO `tbl_manufacturer` VALUES ('22', 'Peugeot', 'peugeot.png', '1');
INSERT INTO `tbl_manufacturer` VALUES ('23', 'Porsche', 'porsche.png', '1');
INSERT INTO `tbl_manufacturer` VALUES ('24', 'Suzuki', 'suzuki.png', '1');
INSERT INTO `tbl_manufacturer` VALUES ('25', 'Volkswagen', 'volkswagen.png', '1');
INSERT INTO `tbl_manufacturer` VALUES ('26', 'Hummer', 'hummer.png', '1');
INSERT INTO `tbl_manufacturer` VALUES ('27', 'Mini Cooper', 'minicooper.png', '1');

-- ----------------------------
-- Table structure for `tbl_price_range`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_price_range`;
CREATE TABLE `tbl_price_range` (
  `price_range_id` int(11) NOT NULL AUTO_INCREMENT,
  `price_from` int(64) NOT NULL,
  `price_to` int(50) NOT NULL,
  `picture` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`price_range_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of tbl_price_range
-- ----------------------------
INSERT INTO `tbl_price_range` VALUES ('1', '1', '5000', 'body.png');
INSERT INTO `tbl_price_range` VALUES ('2', '5000', '10000', 'body.png');
INSERT INTO `tbl_price_range` VALUES ('3', '10000', '20000', 'body.png');
INSERT INTO `tbl_price_range` VALUES ('4', '20000', '30000', 'body.png');
INSERT INTO `tbl_price_range` VALUES ('5', '30000', '40000', 'body.png');
INSERT INTO `tbl_price_range` VALUES ('6', '40000', '50000', 'body.png');
INSERT INTO `tbl_price_range` VALUES ('7', '50000', '1000000', 'body.png');

-- ----------------------------
-- Table structure for `tbl_store`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_store`;
CREATE TABLE `tbl_store` (
  `store_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `storeurl` text NOT NULL,
  `owner_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `picture` text,
  `telephone` text,
  `email` varchar(255) DEFAULT NULL,
  `website` text,
  `address` text,
  `map_latitude` text,
  `map_longitude` text,
  `description` text,
  PRIMARY KEY (`store_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_store
-- ----------------------------
INSERT INTO `tbl_store` VALUES ('1', 'HAK SRUN 1', 'haksrun1', 'HAK SRUN 1', '20120628_004146.png', '+855-11-98-5555 +855-12-98-5555 +855-16-98-5555', 'info@haksrun1.com', 'http://www.haksrun1.com', '#737, Monivong corner of Mao Tse Tong Blvd., Sangkat Beoung Trabek, Khan Chamkarmon, PhnomPenh, Kingdom of Cambodia.', '11.54384057613467', '104.92200279964447', 'Hello and welcome to the Haksrun1 â€“ Premium Cars Selling website! We are truly proud and excited to have the opportunity to serve you today. Established in 1999, Haksrun1 â€“ Premium Cars Selling adopted the philosophy that the single and most important');
INSERT INTO `tbl_store` VALUES ('2', 'kongk store', 'nobpaka', 'kongkea', '20120713_101638.jpg', '', 'kongkea@gmail.com', '', '', null, null, '');

-- ----------------------------
-- Table structure for `tbl_user`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '',
  `email` varchar(96) COLLATE utf8_bin NOT NULL DEFAULT '',
  `password` varchar(32) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_group_id` int(11) NOT NULL DEFAULT '1',
  `firstname` varchar(32) COLLATE utf8_bin NOT NULL DEFAULT '',
  `lastname` varchar(32) COLLATE utf8_bin NOT NULL DEFAULT '',
  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of tbl_user
-- ----------------------------
INSERT INTO `tbl_user` VALUES ('1', 'admin', 'admin', 'a53108f7543b75adbb34afc035d4cdf6', '2', '', '', '2012-06-11 00:00:00', '2012-06-11 00:00:00', '1');
INSERT INTO `tbl_user` VALUES ('2', 'info@haksrun1.com', 'info@haksrun1.com', 'c60190028f2152b3e3ee85fcf306a3d9', '1', '', '', '2012-06-27 00:00:00', '2012-06-27 00:00:00', '1');
INSERT INTO `tbl_user` VALUES ('3', 'kongkea@gmail.com', 'kongkea@gmail.com', 'b0baee9d279d34fa1dfd71aadb908c3f', '1', '', '', '2012-07-13 00:00:00', '2012-07-13 00:00:00', '1');

-- ----------------------------
-- Table structure for `tbl_user_group`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user_group`;
CREATE TABLE `tbl_user_group` (
  `user_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_bin NOT NULL,
  `permission` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`user_group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of tbl_user_group
-- ----------------------------
INSERT INTO `tbl_user_group` VALUES ('1', 'Owner', '');
INSERT INTO `tbl_user_group` VALUES ('2', 'Administrator', '');

-- ----------------------------
-- Table structure for `tbl_user_to_store`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user_to_store`;
CREATE TABLE `tbl_user_to_store` (
  `user_id` int(11) NOT NULL DEFAULT '0',
  `store_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`store_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_user_to_store
-- ----------------------------
INSERT INTO `tbl_user_to_store` VALUES ('2', '1');
INSERT INTO `tbl_user_to_store` VALUES ('3', '2');
