<?php

########################################################################
# Extension Manager/Repository config file for ext "hype_store".
#
# Auto generated 13-01-2010 09:36
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Hype Store',
	'description' => 'Implements an online shop with categories, products, a shopping cart including checkout and other features,',
	'category' => 'fe',
	'shy' => 0,
	'version' => '0.1.1',
	'dependencies' => 'extbase,fluid',
	'conflicts' => '',
	'priority' => '',
	'loadOrder' => '',
	'module' => '',
	'state' => 'alpha',
	'uploadfolder' => 0,
	'createDirs' => '
		uploads/hype/store/category/images,
		uploads/hype/store/product/images,
		uploads/hype/store/product/files,
		uploads/hype/store/article/images,
		uploads/hype/store/article/files',
	'modify_tables' => '',
	'clearcacheonload' => 0,
	'lockType' => '',
	'author' => 'Thomas "Thasmo" Deinhamer',
	'author_email' => 'thasmo@gmail.com',
	'author_company' => '',
	'CGLcompliance' => '',
	'CGLcompliance_note' => '',
	'constraints' => array(
		'depends' => array(
			'php' => '5.2.0-0.0.0',
			'typo3' => '4.3.dev-4.3.99',
			'extbase' => '1.0.1-0.0.0',
			'fluid' => '1.0.1-0.0.0',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:43:{s:17:"ext_localconf.php";s:4:"222f";s:14:"ext_tables.php";s:4:"a4d0";s:14:"ext_tables.sql";s:4:"43f7";s:24:"ext_typoscript_setup.txt";s:4:"dd4c";s:37:"Classes/Controller/CartController.php";s:4:"8966";s:41:"Classes/Controller/CategoryController.php";s:4:"01a0";s:40:"Classes/Controller/ProductController.php";s:4:"df87";s:34:"Classes/Domain/Model/Attribute.php";s:4:"ac60";s:33:"Classes/Domain/Model/Category.php";s:4:"1879";s:33:"Classes/Domain/Model/Customer.php";s:4:"6280";s:32:"Classes/Domain/Model/Product.php";s:4:"dc0a";s:41:"Classes/Domain/Model/ProductAttribute.php";s:4:"68d2";s:37:"Classes/Domain/Model/ProductPrice.php";s:4:"c919";s:48:"Classes/Domain/Repository/CategoryRepository.php";s:4:"c9d6";s:48:"Classes/Domain/Repository/CustomerRepository.php";s:4:"abfe";s:45:"Classes/Domain/Repository/DepotRepository.php";s:4:"71f2";s:47:"Classes/Domain/Repository/ProductRepository.php";s:4:"9d42";s:40:"Classes/Hook/class.tx_hypestore_menu.php";s:4:"bfea";s:50:"Classes/Hook/class.tx_hypestore_t3lib_tceforms.php";s:4:"8fe9";s:45:"Classes/Hook/class.tx_hypestore_tca_field.php";s:4:"eb78";s:45:"Classes/Hook/class.tx_hypestore_tca_label.php";s:4:"0031";s:25:"Configuration/TCA/tca.php";s:4:"10c7";s:42:"Configuration/TCA/Icons/attribute.icon.png";s:4:"7d30";s:41:"Configuration/TCA/Icons/category.icon.png";s:4:"b8de";s:38:"Configuration/TCA/Icons/depot.icon.png";s:4:"cf25";s:38:"Configuration/TCA/Icons/event.icon.png";s:4:"fe2e";s:38:"Configuration/TCA/Icons/price.icon.png";s:4:"5580";s:40:"Configuration/TCA/Icons/product.icon.png";s:4:"2c58";s:49:"Configuration/TCA/Icons/request-accepted.icon.png";s:4:"e0bd";s:47:"Configuration/TCA/Icons/request-closed.icon.png";s:4:"d199";s:49:"Configuration/TCA/Icons/request-rejected.icon.png";s:4:"5c0f";s:40:"Configuration/TCA/Icons/request.icon.png";s:4:"9de4";s:38:"Configuration/TCA/Icons/state.icon.png";s:4:"d7cb";s:38:"Configuration/TCA/Icons/stock.icon.png";s:4:"de57";s:37:"Configuration/TCA/Icons/unit.icon.png";s:4:"ca0f";s:38:"Configuration/TCA/Icons/value.icon.png";s:4:"d2ed";s:40:"Resources/Private/Language/locallang.xml";s:4:"e254";s:43:"Resources/Private/Language/locallang_db.xml";s:4:"69bb";s:38:"Resources/Private/Layouts/default.html";s:4:"d29f";s:51:"Resources/Private/Partials/Product/interaction.html";s:4:"a3f4";s:47:"Resources/Private/Templates/Category/index.html";s:4:"9519";s:46:"Resources/Private/Templates/Category/list.html";s:4:"10fd";s:46:"Resources/Private/Templates/Product/index.html";s:4:"2aa3";}',
	'suggests' => array(
	),
);

?>