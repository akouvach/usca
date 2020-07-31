-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.8-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             10.3.0.5771
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura para tabla participemos.geo_ciudades
CREATE TABLE IF NOT EXISTS `geo_ciudades` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `idEstado` bigint(20) NOT NULL,
  `idPais` char(2) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `fk_ciudadEstado` (`idEstado`),
  CONSTRAINT `fk_ciudadEstado` FOREIGN KEY (`idEstado`) REFERENCES `geo_estados` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla participemos.geo_ciudades: ~0 rows (aproximadamente)
DELETE FROM `geo_ciudades`;
/*!40000 ALTER TABLE `geo_ciudades` DISABLE KEYS */;
/*!40000 ALTER TABLE `geo_ciudades` ENABLE KEYS */;

-- Volcando estructura para tabla participemos.geo_estados
CREATE TABLE IF NOT EXISTS `geo_estados` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `estado` varchar(50) NOT NULL,
  `idPais` char(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla participemos.geo_estados: ~0 rows (aproximadamente)
DELETE FROM `geo_estados`;
/*!40000 ALTER TABLE `geo_estados` DISABLE KEYS */;
/*!40000 ALTER TABLE `geo_estados` ENABLE KEYS */;

-- Volcando estructura para tabla participemos.geo_paises
CREATE TABLE IF NOT EXISTS `geo_paises` (
  `id` char(2) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `iso3` char(3) COLLATE utf8_spanish_ci DEFAULT NULL,
  `codigo` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla participemos.geo_paises: ~239 rows (aproximadamente)
DELETE FROM `geo_paises`;
/*!40000 ALTER TABLE `geo_paises` DISABLE KEYS */;
INSERT INTO `geo_paises` (`id`, `nombre`, `descripcion`, `iso3`, `codigo`) VALUES
	('AD', 'ANDORRA', 'Andorra', 'AND', 20),
	('AE', 'UNITED ARAB EMIRATES', 'United Arab Emirates', 'ARE', 784),
	('AF', 'AFGHANISTAN', 'Afghanistan', 'AFG', 4),
	('AG', 'ANTIGUA AND BARBUDA', 'Antigua and Barbuda', 'ATG', 28),
	('AI', 'ANGUILLA', 'Anguilla', 'AIA', 660),
	('AL', 'ALBANIA', 'Albania', 'ALB', 8),
	('AM', 'ARMENIA', 'Armenia', 'ARM', 51),
	('AN', 'NETHERLANDS ANTILLES', 'Netherlands Antilles', 'ANT', 530),
	('AO', 'ANGOLA', 'Angola', 'AGO', 24),
	('AQ', 'ANTARCTICA', 'Antarctica', NULL, NULL),
	('AR', 'ARGENTINA', 'Argentina', 'ARG', 32),
	('AS', 'AMERICAN SAMOA', 'American Samoa', 'ASM', 16),
	('AT', 'AUSTRIA', 'Austria', 'AUT', 40),
	('AU', 'AUSTRALIA', 'Australia', 'AUS', 36),
	('AW', 'ARUBA', 'Aruba', 'ABW', 533),
	('AZ', 'AZERBAIJAN', 'Azerbaijan', 'AZE', 31),
	('BA', 'BOSNIA AND HERZEGOVINA', 'Bosnia and Herzegovina', 'BIH', 70),
	('BB', 'BARBADOS', 'Barbados', 'BRB', 52),
	('BD', 'BANGLADESH', 'Bangladesh', 'BGD', 50),
	('BE', 'BELGIUM', 'Belgium', 'BEL', 56),
	('BF', 'BURKINA FASO', 'Burkina Faso', 'BFA', 854),
	('BG', 'BULGARIA', 'Bulgaria', 'BGR', 100),
	('BH', 'BAHRAIN', 'Bahrain', 'BHR', 48),
	('BI', 'BURUNDI', 'Burundi', 'BDI', 108),
	('BJ', 'BENIN', 'Benin', 'BEN', 204),
	('BM', 'BERMUDA', 'Bermuda', 'BMU', 60),
	('BN', 'BRUNEI DARUSSALAM', 'Brunei Darussalam', 'BRN', 96),
	('BO', 'BOLIVIA', 'Bolivia', 'BOL', 68),
	('BR', 'BRAZIL', 'Brazil', 'BRA', 76),
	('BS', 'BAHAMAS', 'Bahamas', 'BHS', 44),
	('BT', 'BHUTAN', 'Bhutan', 'BTN', 64),
	('BV', 'BOUVET ISLAND', 'Bouvet Island', NULL, NULL),
	('BW', 'BOTSWANA', 'Botswana', 'BWA', 72),
	('BY', 'BELARUS', 'Belarus', 'BLR', 112),
	('BZ', 'BELIZE', 'Belize', 'BLZ', 84),
	('CA', 'CANADA', 'Canada', 'CAN', 124),
	('CC', 'COCOS (KEELING) ISLANDS', 'Cocos (Keeling) Islands', NULL, NULL),
	('CD', 'CONGO, THE DEMOCRATIC REPUBLIC OF THE', 'Congo, the Democratic Republic of the', 'COD', 180),
	('CF', 'CENTRAL AFRICAN REPUBLIC', 'Central African Republic', 'CAF', 140),
	('CG', 'CONGO', 'Congo', 'COG', 178),
	('CH', 'SWITZERLAND', 'Switzerland', 'CHE', 756),
	('CI', 'COTE D\'IVOIRE', 'Cote D\'Ivoire', 'CIV', 384),
	('CK', 'COOK ISLANDS', 'Cook Islands', 'COK', 184),
	('CL', 'CHILE', 'Chile', 'CHL', 152),
	('CM', 'CAMEROON', 'Cameroon', 'CMR', 120),
	('CN', 'CHINA', 'China', 'CHN', 156),
	('CO', 'COLOMBIA', 'Colombia', 'COL', 170),
	('CR', 'COSTA RICA', 'Costa Rica', 'CRI', 188),
	('CS', 'SERBIA AND MONTENEGRO', 'Serbia and Montenegro', NULL, NULL),
	('CU', 'CUBA', 'Cuba', 'CUB', 192),
	('CV', 'CAPE VERDE', 'Cape Verde', 'CPV', 132),
	('CX', 'CHRISTMAS ISLAND', 'Christmas Island', NULL, NULL),
	('CY', 'CYPRUS', 'Cyprus', 'CYP', 196),
	('CZ', 'CZECH REPUBLIC', 'Czech Republic', 'CZE', 203),
	('DE', 'GERMANY', 'Germany', 'DEU', 276),
	('DJ', 'DJIBOUTI', 'Djibouti', 'DJI', 262),
	('DK', 'DENMARK', 'Denmark', 'DNK', 208),
	('DM', 'DOMINICA', 'Dominica', 'DMA', 212),
	('DO', 'DOMINICAN REPUBLIC', 'Dominican Republic', 'DOM', 214),
	('DZ', 'ALGERIA', 'Algeria', 'DZA', 12),
	('EC', 'ECUADOR', 'Ecuador', 'ECU', 218),
	('EE', 'ESTONIA', 'Estonia', 'EST', 233),
	('EG', 'EGYPT', 'Egypt', 'EGY', 818),
	('EH', 'WESTERN SAHARA', 'Western Sahara', 'ESH', 732),
	('ER', 'ERITREA', 'Eritrea', 'ERI', 232),
	('ES', 'SPAIN', 'Spain', 'ESP', 724),
	('ET', 'ETHIOPIA', 'Ethiopia', 'ETH', 231),
	('FI', 'FINLAND', 'Finland', 'FIN', 246),
	('FJ', 'FIJI', 'Fiji', 'FJI', 242),
	('FK', 'FALKLAND ISLANDS (MALVINAS)', 'Falkland Islands (Malvinas)', 'FLK', 238),
	('FM', 'MICRONESIA, FEDERATED STATES OF', 'Micronesia, Federated States of', 'FSM', 583),
	('FO', 'FAROE ISLANDS', 'Faroe Islands', 'FRO', 234),
	('FR', 'FRANCE', 'France', 'FRA', 250),
	('GA', 'GABON', 'Gabon', 'GAB', 266),
	('GB', 'UNITED KINGDOM', 'United Kingdom', 'GBR', 826),
	('GD', 'GRENADA', 'Grenada', 'GRD', 308),
	('GE', 'GEORGIA', 'Georgia', 'GEO', 268),
	('GF', 'FRENCH GUIANA', 'French Guiana', 'GUF', 254),
	('GH', 'GHANA', 'Ghana', 'GHA', 288),
	('GI', 'GIBRALTAR', 'Gibraltar', 'GIB', 292),
	('GL', 'GREENLAND', 'Greenland', 'GRL', 304),
	('GM', 'GAMBIA', 'Gambia', 'GMB', 270),
	('GN', 'GUINEA', 'Guinea', 'GIN', 324),
	('GP', 'GUADELOUPE', 'Guadeloupe', 'GLP', 312),
	('GQ', 'EQUATORIAL GUINEA', 'Equatorial Guinea', 'GNQ', 226),
	('GR', 'GREECE', 'Greece', 'GRC', 300),
	('GS', 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS', 'South Georgia and the South Sandwich Islands', NULL, NULL),
	('GT', 'GUATEMALA', 'Guatemala', 'GTM', 320),
	('GU', 'GUAM', 'Guam', 'GUM', 316),
	('GW', 'GUINEA-BISSAU', 'Guinea-Bissau', 'GNB', 624),
	('GY', 'GUYANA', 'Guyana', 'GUY', 328),
	('HK', 'HONG KONG', 'Hong Kong', 'HKG', 344),
	('HM', 'HEARD ISLAND AND MCDONALD ISLANDS', 'Heard Island and Mcdonald Islands', NULL, NULL),
	('HN', 'HONDURAS', 'Honduras', 'HND', 340),
	('HR', 'CROATIA', 'Croatia', 'HRV', 191),
	('HT', 'HAITI', 'Haiti', 'HTI', 332),
	('HU', 'HUNGARY', 'Hungary', 'HUN', 348),
	('ID', 'INDONESIA', 'Indonesia', 'IDN', 360),
	('IE', 'IRELAND', 'Ireland', 'IRL', 372),
	('IL', 'ISRAEL', 'Israel', 'ISR', 376),
	('IN', 'INDIA', 'India', 'IND', 356),
	('IO', 'BRITISH INDIAN OCEAN TERRITORY', 'British Indian Ocean Territory', NULL, NULL),
	('IQ', 'IRAQ', 'Iraq', 'IRQ', 368),
	('IR', 'IRAN, ISLAMIC REPUBLIC OF', 'Iran, Islamic Republic of', 'IRN', 364),
	('IS', 'ICELAND', 'Iceland', 'ISL', 352),
	('IT', 'ITALY', 'Italy', 'ITA', 380),
	('JM', 'JAMAICA', 'Jamaica', 'JAM', 388),
	('JO', 'JORDAN', 'Jordan', 'JOR', 400),
	('JP', 'JAPAN', 'Japan', 'JPN', 392),
	('KE', 'KENYA', 'Kenya', 'KEN', 404),
	('KG', 'KYRGYZSTAN', 'Kyrgyzstan', 'KGZ', 417),
	('KH', 'CAMBODIA', 'Cambodia', 'KHM', 116),
	('KI', 'KIRIBATI', 'Kiribati', 'KIR', 296),
	('KM', 'COMOROS', 'Comoros', 'COM', 174),
	('KN', 'SAINT KITTS AND NEVIS', 'Saint Kitts and Nevis', 'KNA', 659),
	('KP', 'KOREA, DEMOCRATIC PEOPLE\'S REPUBLIC OF', 'Korea, Democratic People\'s Republic of', 'PRK', 408),
	('KR', 'KOREA, REPUBLIC OF', 'Korea, Republic of', 'KOR', 410),
	('KW', 'KUWAIT', 'Kuwait', 'KWT', 414),
	('KY', 'CAYMAN ISLANDS', 'Cayman Islands', 'CYM', 136),
	('KZ', 'KAZAKHSTAN', 'Kazakhstan', 'KAZ', 398),
	('LA', 'LAO PEOPLE\'S DEMOCRATIC REPUBLIC', 'Lao People\'s Democratic Republic', 'LAO', 418),
	('LB', 'LEBANON', 'Lebanon', 'LBN', 422),
	('LC', 'SAINT LUCIA', 'Saint Lucia', 'LCA', 662),
	('LI', 'LIECHTENSTEIN', 'Liechtenstein', 'LIE', 438),
	('LK', 'SRI LANKA', 'Sri Lanka', 'LKA', 144),
	('LR', 'LIBERIA', 'Liberia', 'LBR', 430),
	('LS', 'LESOTHO', 'Lesotho', 'LSO', 426),
	('LT', 'LITHUANIA', 'Lithuania', 'LTU', 440),
	('LU', 'LUXEMBOURG', 'Luxembourg', 'LUX', 442),
	('LV', 'LATVIA', 'Latvia', 'LVA', 428),
	('LY', 'LIBYAN ARAB JAMAHIRIYA', 'Libyan Arab Jamahiriya', 'LBY', 434),
	('MA', 'MOROCCO', 'Morocco', 'MAR', 504),
	('MC', 'MONACO', 'Monaco', 'MCO', 492),
	('MD', 'MOLDOVA, REPUBLIC OF', 'Moldova, Republic of', 'MDA', 498),
	('MG', 'MADAGASCAR', 'Madagascar', 'MDG', 450),
	('MH', 'MARSHALL ISLANDS', 'Marshall Islands', 'MHL', 584),
	('MK', 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF', 'Macedonia, the Former Yugoslav Republic of', 'MKD', 807),
	('ML', 'MALI', 'Mali', 'MLI', 466),
	('MM', 'MYANMAR', 'Myanmar', 'MMR', 104),
	('MN', 'MONGOLIA', 'Mongolia', 'MNG', 496),
	('MO', 'MACAO', 'Macao', 'MAC', 446),
	('MP', 'NORTHERN MARIANA ISLANDS', 'Northern Mariana Islands', 'MNP', 580),
	('MQ', 'MARTINIQUE', 'Martinique', 'MTQ', 474),
	('MR', 'MAURITANIA', 'Mauritania', 'MRT', 478),
	('MS', 'MONTSERRAT', 'Montserrat', 'MSR', 500),
	('MT', 'MALTA', 'Malta', 'MLT', 470),
	('MU', 'MAURITIUS', 'Mauritius', 'MUS', 480),
	('MV', 'MALDIVES', 'Maldives', 'MDV', 462),
	('MW', 'MALAWI', 'Malawi', 'MWI', 454),
	('MX', 'MEXICO', 'Mexico', 'MEX', 484),
	('MY', 'MALAYSIA', 'Malaysia', 'MYS', 458),
	('MZ', 'MOZAMBIQUE', 'Mozambique', 'MOZ', 508),
	('NA', 'NAMIBIA', 'Namibia', 'NAM', 516),
	('NC', 'NEW CALEDONIA', 'New Caledonia', 'NCL', 540),
	('NE', 'NIGER', 'Niger', 'NER', 562),
	('NF', 'NORFOLK ISLAND', 'Norfolk Island', 'NFK', 574),
	('NG', 'NIGERIA', 'Nigeria', 'NGA', 566),
	('NI', 'NICARAGUA', 'Nicaragua', 'NIC', 558),
	('NL', 'NETHERLANDS', 'Netherlands', 'NLD', 528),
	('NO', 'NORWAY', 'Norway', 'NOR', 578),
	('NP', 'NEPAL', 'Nepal', 'NPL', 524),
	('NR', 'NAURU', 'Nauru', 'NRU', 520),
	('NU', 'NIUE', 'Niue', 'NIU', 570),
	('NZ', 'NEW ZEALAND', 'New Zealand', 'NZL', 554),
	('OM', 'OMAN', 'Oman', 'OMN', 512),
	('PA', 'PANAMA', 'Panama', 'PAN', 591),
	('PE', 'PERU', 'Peru', 'PER', 604),
	('PF', 'FRENCH POLYNESIA', 'French Polynesia', 'PYF', 258),
	('PG', 'PAPUA NEW GUINEA', 'Papua New Guinea', 'PNG', 598),
	('PH', 'PHILIPPINES', 'Philippines', 'PHL', 608),
	('PK', 'PAKISTAN', 'Pakistan', 'PAK', 586),
	('PL', 'POLAND', 'Poland', 'POL', 616),
	('PM', 'SAINT PIERRE AND MIQUELON', 'Saint Pierre and Miquelon', 'SPM', 666),
	('PN', 'PITCAIRN', 'Pitcairn', 'PCN', 612),
	('PR', 'PUERTO RICO', 'Puerto Rico', 'PRI', 630),
	('PS', 'PALESTINIAN TERRITORY, OCCUPIED', 'Palestinian Territory, Occupied', NULL, NULL),
	('PT', 'PORTUGAL', 'Portugal', 'PRT', 620),
	('PW', 'PALAU', 'Palau', 'PLW', 585),
	('PY', 'PARAGUAY', 'Paraguay', 'PRY', 600),
	('QA', 'QATAR', 'Qatar', 'QAT', 634),
	('RE', 'REUNION', 'Reunion', 'REU', 638),
	('RO', 'ROMANIA', 'Romania', 'ROM', 642),
	('RU', 'RUSSIAN FEDERATION', 'Russian Federation', 'RUS', 643),
	('RW', 'RWANDA', 'Rwanda', 'RWA', 646),
	('SA', 'SAUDI ARABIA', 'Saudi Arabia', 'SAU', 682),
	('SB', 'SOLOMON ISLANDS', 'Solomon Islands', 'SLB', 90),
	('SC', 'SEYCHELLES', 'Seychelles', 'SYC', 690),
	('SD', 'SUDAN', 'Sudan', 'SDN', 736),
	('SE', 'SWEDEN', 'Sweden', 'SWE', 752),
	('SG', 'SINGAPORE', 'Singapore', 'SGP', 702),
	('SH', 'SAINT HELENA', 'Saint Helena', 'SHN', 654),
	('SI', 'SLOVENIA', 'Slovenia', 'SVN', 705),
	('SJ', 'SVALBARD AND JAN MAYEN', 'Svalbard and Jan Mayen', 'SJM', 744),
	('SK', 'SLOVAKIA', 'Slovakia', 'SVK', 703),
	('SL', 'SIERRA LEONE', 'Sierra Leone', 'SLE', 694),
	('SM', 'SAN MARINO', 'San Marino', 'SMR', 674),
	('SN', 'SENEGAL', 'Senegal', 'SEN', 686),
	('SO', 'SOMALIA', 'Somalia', 'SOM', 706),
	('SR', 'SURINAME', 'Suriname', 'SUR', 740),
	('ST', 'SAO TOME AND PRINCIPE', 'Sao Tome and Principe', 'STP', 678),
	('SV', 'EL SALVADOR', 'El Salvador', 'SLV', 222),
	('SY', 'SYRIAN ARAB REPUBLIC', 'Syrian Arab Republic', 'SYR', 760),
	('SZ', 'SWAZILAND', 'Swaziland', 'SWZ', 748),
	('TC', 'TURKS AND CAICOS ISLANDS', 'Turks and Caicos Islands', 'TCA', 796),
	('TD', 'CHAD', 'Chad', 'TCD', 148),
	('TF', 'FRENCH SOUTHERN TERRITORIES', 'French Southern Territories', NULL, NULL),
	('TG', 'TOGO', 'Togo', 'TGO', 768),
	('TH', 'THAILAND', 'Thailand', 'THA', 764),
	('TJ', 'TAJIKISTAN', 'Tajikistan', 'TJK', 762),
	('TK', 'TOKELAU', 'Tokelau', 'TKL', 772),
	('TL', 'TIMOR-LESTE', 'Timor-Leste', NULL, NULL),
	('TM', 'TURKMENISTAN', 'Turkmenistan', 'TKM', 795),
	('TN', 'TUNISIA', 'Tunisia', 'TUN', 788),
	('TO', 'TONGA', 'Tonga', 'TON', 776),
	('TR', 'TURKEY', 'Turkey', 'TUR', 792),
	('TT', 'TRINIDAD AND TOBAGO', 'Trinidad and Tobago', 'TTO', 780),
	('TV', 'TUVALU', 'Tuvalu', 'TUV', 798),
	('TW', 'TAIWAN, PROVINCE OF CHINA', 'Taiwan, Province of China', 'TWN', 158),
	('TZ', 'TANZANIA, UNITED REPUBLIC OF', 'Tanzania, United Republic of', 'TZA', 834),
	('UA', 'UKRAINE', 'Ukraine', 'UKR', 804),
	('UG', 'UGANDA', 'Uganda', 'UGA', 800),
	('UM', 'UNITED STATES MINOR OUTLYING ISLANDS', 'United States Minor Outlying Islands', NULL, NULL),
	('US', 'UNITED STATES', 'United States', 'USA', 840),
	('UY', 'URUGUAY', 'Uruguay', 'URY', 858),
	('UZ', 'UZBEKISTAN', 'Uzbekistan', 'UZB', 860),
	('VA', 'HOLY SEE (VATICAN CITY STATE)', 'Holy See (Vatican City State)', 'VAT', 336),
	('VC', 'SAINT VINCENT AND THE GRENADINES', 'Saint Vincent and the Grenadines', 'VCT', 670),
	('VE', 'VENEZUELA', 'Venezuela', 'VEN', 862),
	('VG', 'VIRGIN ISLANDS, BRITISH', 'Virgin Islands, British', 'VGB', 92),
	('VI', 'VIRGIN ISLANDS, U.S.', 'Virgin Islands, U.s.', 'VIR', 850),
	('VN', 'VIET NAM', 'Viet Nam', 'VNM', 704),
	('VU', 'VANUATU', 'Vanuatu', 'VUT', 548),
	('WF', 'WALLIS AND FUTUNA', 'Wallis and Futuna', 'WLF', 876),
	('WS', 'SAMOA', 'Samoa', 'WSM', 882),
	('YE', 'YEMEN', 'Yemen', 'YEM', 887),
	('YT', 'MAYOTTE', 'Mayotte', NULL, NULL),
	('ZA', 'SOUTH AFRICA', 'South Africa', 'ZAF', 710),
	('ZM', 'ZAMBIA', 'Zambia', 'ZMB', 894),
	('ZW', 'ZIMBABWE', 'Zimbabwe', 'ZWE', 716);
/*!40000 ALTER TABLE `geo_paises` ENABLE KEYS */;

-- Volcando estructura para tabla participemos.grupos
CREATE TABLE IF NOT EXISTS `grupos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `grupo` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `idCreador` bigint(20) NOT NULL,
  `idOrganigrama` bigint(20) NOT NULL,
  `tipo` char(1) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'U' COMMENT 'U: Usuario,  G: Geografico, T: Temático',
  `tags` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_grupoUsuarioCreador` (`idCreador`),
  KEY `fk_grupoOrganigrama` (`idOrganigrama`),
  CONSTRAINT `fk_grupoOrganigrama` FOREIGN KEY (`idOrganigrama`) REFERENCES `organigramas` (`id`),
  CONSTRAINT `fk_grupoUsuarioCreador` FOREIGN KEY (`idCreador`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla participemos.grupos: ~2 rows (aproximadamente)
DELETE FROM `grupos`;
/*!40000 ALTER TABLE `grupos` DISABLE KEYS */;
INSERT INTO `grupos` (`id`, `descripcion`, `grupo`, `idCreador`, `idOrganigrama`, `tipo`, `tags`) VALUES
	(4, 'tango', 'tango', 1, 2, 'U', 'tango, baile'),
	(5, 'zouk', 'zouk', 1, 2, 'U', 'zouk, baile');
/*!40000 ALTER TABLE `grupos` ENABLE KEYS */;

-- Volcando estructura para tabla participemos.grupos_ciudades
CREATE TABLE IF NOT EXISTS `grupos_ciudades` (
  `idCiudad` bigint(20) NOT NULL,
  `idGrupo` bigint(20) NOT NULL,
  `fechaDesde` date NOT NULL,
  PRIMARY KEY (`idCiudad`,`idGrupo`,`fechaDesde`),
  KEY `fk_gruposCiudades_Grupo` (`idGrupo`),
  CONSTRAINT `fk_gruposCiudades_Ciudad` FOREIGN KEY (`idCiudad`) REFERENCES `geo_ciudades` (`id`),
  CONSTRAINT `fk_gruposCiudades_Grupo` FOREIGN KEY (`idGrupo`) REFERENCES `grupos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Ciudades donde puede aparecer un grupo';

-- Volcando datos para la tabla participemos.grupos_ciudades: ~0 rows (aproximadamente)
DELETE FROM `grupos_ciudades`;
/*!40000 ALTER TABLE `grupos_ciudades` DISABLE KEYS */;
/*!40000 ALTER TABLE `grupos_ciudades` ENABLE KEYS */;

-- Volcando estructura para tabla participemos.grupos_relaciones
CREATE TABLE IF NOT EXISTS `grupos_relaciones` (
  `grupo_origen` bigint(20) NOT NULL,
  `grupo_destino` bigint(20) NOT NULL,
  `tipo_relacion` char(1) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'I' COMMENT 'I: Inclusion, A: Asociado',
  `fechaDesde` date NOT NULL,
  PRIMARY KEY (`grupo_origen`,`grupo_destino`),
  KEY `fk_gruposRelaciones_grupoDestino` (`grupo_destino`),
  CONSTRAINT `fk_gruposRelaciones_grupoDestino` FOREIGN KEY (`grupo_destino`) REFERENCES `grupos` (`id`),
  CONSTRAINT `fk_gruposRelaciones_grupoOrigen` FOREIGN KEY (`grupo_origen`) REFERENCES `grupos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla participemos.grupos_relaciones: ~0 rows (aproximadamente)
DELETE FROM `grupos_relaciones`;
/*!40000 ALTER TABLE `grupos_relaciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `grupos_relaciones` ENABLE KEYS */;

-- Volcando estructura para tabla participemos.menu
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ruta` varchar(50) NOT NULL,
  `menu` varchar(50) DEFAULT NULL,
  `menuIdPadre` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla participemos.menu: ~4 rows (aproximadamente)
DELETE FROM `menu`;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` (`id`, `ruta`, `menu`, `menuIdPadre`) VALUES
	(1, 'proyectos', 'proyectos', NULL),
	(2, 'ctacte', 'cta_cte', NULL),
	(3, 'tareas', 'tareas', NULL),
	(4, 'tiempo', 'tiempo', NULL),
	(5, 'productos', 'productos', NULL);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;

-- Volcando estructura para tabla participemos.organigramas
CREATE TABLE IF NOT EXISTS `organigramas` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `area` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT 'Directorio',
  `idAreaPadre` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla participemos.organigramas: ~0 rows (aproximadamente)
DELETE FROM `organigramas`;
/*!40000 ALTER TABLE `organigramas` DISABLE KEYS */;
INSERT INTO `organigramas` (`id`, `area`, `idAreaPadre`) VALUES
	(1, 'Directorio', NULL),
	(2, 'Directorio', NULL);
/*!40000 ALTER TABLE `organigramas` ENABLE KEYS */;

-- Volcando estructura para tabla participemos.sec_roles
CREATE TABLE IF NOT EXISTS `sec_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rol` varchar(50) DEFAULT NULL,
  `esAdminGlogal` char(1) NOT NULL DEFAULT 'N',
  `esAdminGrupo` char(1) NOT NULL DEFAULT 'N',
  `esAdminGeografico` char(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla participemos.sec_roles: ~6 rows (aproximadamente)
DELETE FROM `sec_roles`;
/*!40000 ALTER TABLE `sec_roles` DISABLE KEYS */;
INSERT INTO `sec_roles` (`id`, `rol`, `esAdminGlogal`, `esAdminGrupo`, `esAdminGeografico`) VALUES
	(1, 'AdministradorGlobal', 'S', 'N', 'N'),
	(2, 'AdministradorGrupo', 'N', 'N', 'N'),
	(3, 'AdministradorApp', 'N', 'N', 'N'),
	(4, 'AdministradorBlog', 'N', 'N', 'N'),
	(5, 'AdministradorProyecto', 'N', 'N', 'N'),
	(6, 'AdministradorPortfolio', 'N', 'N', 'N'),
	(7, 'Administrador', 'N', 'N', 'N');
/*!40000 ALTER TABLE `sec_roles` ENABLE KEYS */;

-- Volcando estructura para tabla participemos.sec_roles_permisos
CREATE TABLE IF NOT EXISTS `sec_roles_permisos` (
  `idRol` int(11) NOT NULL,
  `idMenu` int(11) NOT NULL,
  `fechaDesde` date NOT NULL,
  PRIMARY KEY (`idRol`,`idMenu`),
  KEY `fk_secRolesPermisos_Menu` (`idMenu`),
  CONSTRAINT `fk_secRolesPermidos_Rol` FOREIGN KEY (`idRol`) REFERENCES `sec_roles` (`id`),
  CONSTRAINT `fk_secRolesPermisos_Menu` FOREIGN KEY (`idMenu`) REFERENCES `menu` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tabla donde se vincula los permisos de acceso a cada menú para cada rol';

-- Volcando datos para la tabla participemos.sec_roles_permisos: ~0 rows (aproximadamente)
DELETE FROM `sec_roles_permisos`;
/*!40000 ALTER TABLE `sec_roles_permisos` DISABLE KEYS */;
/*!40000 ALTER TABLE `sec_roles_permisos` ENABLE KEYS */;

-- Volcando estructura para tabla participemos.sec_roles_usuarios
CREATE TABLE IF NOT EXISTS `sec_roles_usuarios` (
  `idUsuario` bigint(20) NOT NULL,
  `idRol` int(11) NOT NULL,
  `fechaDesde` date NOT NULL,
  PRIMARY KEY (`idUsuario`,`idRol`,`fechaDesde`),
  KEY `fk_rolesUsuarios_rol` (`idRol`),
  CONSTRAINT `fk_rolesUsuarios_rol` FOREIGN KEY (`idRol`) REFERENCES `sec_roles` (`id`),
  CONSTRAINT `fk_rolesUsuarios_usuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Roles por usuario';

-- Volcando datos para la tabla participemos.sec_roles_usuarios: ~0 rows (aproximadamente)
DELETE FROM `sec_roles_usuarios`;
/*!40000 ALTER TABLE `sec_roles_usuarios` DISABLE KEYS */;
INSERT INTO `sec_roles_usuarios` (`idUsuario`, `idRol`, `fechaDesde`) VALUES
	(1, 1, '2020-01-01');
/*!40000 ALTER TABLE `sec_roles_usuarios` ENABLE KEYS */;

-- Volcando estructura para tabla participemos.temas
CREATE TABLE IF NOT EXISTS `temas` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tema` varchar(50) NOT NULL,
  `tipo` char(1) NOT NULL DEFAULT 'E' COMMENT 'e: especialidad, p:producto, a:ambito',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Estruturación de temas relacionados';

-- Volcando datos para la tabla participemos.temas: ~0 rows (aproximadamente)
DELETE FROM `temas`;
/*!40000 ALTER TABLE `temas` DISABLE KEYS */;
/*!40000 ALTER TABLE `temas` ENABLE KEYS */;

-- Volcando estructura para tabla participemos.temas_relaciones
CREATE TABLE IF NOT EXISTS `temas_relaciones` (
  `idTema` bigint(20) NOT NULL,
  `idTemaRel` bigint(20) NOT NULL,
  PRIMARY KEY (`idTema`,`idTemaRel`),
  KEY `FK_Temas_relaciones_tema2` (`idTemaRel`),
  CONSTRAINT `FK_Temas_relaciones_tema1` FOREIGN KEY (`idTema`) REFERENCES `temas` (`id`),
  CONSTRAINT `FK_Temas_relaciones_tema2` FOREIGN KEY (`idTemaRel`) REFERENCES `temas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla participemos.temas_relaciones: ~0 rows (aproximadamente)
DELETE FROM `temas_relaciones`;
/*!40000 ALTER TABLE `temas_relaciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `temas_relaciones` ENABLE KEYS */;

-- Volcando estructura para tabla participemos.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `usuario` varchar(50) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `genero` char(1) COLLATE utf8_spanish_ci NOT NULL COMMENT 'M: Masculino, F:Femenino',
  `fecha_nac` date NOT NULL,
  `pass` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Registro de usuarios';

-- Volcando datos para la tabla participemos.usuarios: ~2 rows (aproximadamente)
DELETE FROM `usuarios`;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `email`, `usuario`, `genero`, `fecha_nac`, `pass`) VALUES
	(1, 'Andres', 'Kouvach', 'akouvach@yahoo.com', 'akouvach', 'M', '1972-12-30', 'akouvach'),
	(5, 'Gustavo', 'Kouvach', 'gkouvach@gmail.com', 'gkouvach', 'M', '0000-00-00', 'gkouvach');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

-- Volcando estructura para tabla participemos.usuarios_ciudades
CREATE TABLE IF NOT EXISTS `usuarios_ciudades` (
  `idUsuario` bigint(20) NOT NULL,
  `idCiudad` bigint(20) NOT NULL,
  `descripcion` varchar(50) NOT NULL DEFAULT '',
  `fechaDesde` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla participemos.usuarios_ciudades: ~0 rows (aproximadamente)
DELETE FROM `usuarios_ciudades`;
/*!40000 ALTER TABLE `usuarios_ciudades` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuarios_ciudades` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
