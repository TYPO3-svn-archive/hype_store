<?php

if(!defined('TYPO3_MODE'))
	die('Access denied.');



require_once(t3lib_extMgm::extPath($_EXTKEY) . 'Classes/Hook/class.tx_hypestore_tca_label.php');
require_once(t3lib_extMgm::extPath($_EXTKEY) . 'Classes/Utility/Tca.php');


# TYPOSCRIPT

# Extension
t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript/', 'Hype Store');



# PLUGINS

# Category
Tx_Extbase_Utility_Extension::registerPlugin($_EXTKEY, 'Category', 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.plugin.category');

# Product
Tx_Extbase_Utility_Extension::registerPlugin($_EXTKEY, 'Product', 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.plugin.product');

# Cart
Tx_Extbase_Utility_Extension::registerPlugin($_EXTKEY, 'Cart', 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.plugin.cart');

# Checkout
Tx_Extbase_Utility_Extension::registerPlugin($_EXTKEY, 'Checkout', 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.plugin.checkout');

# Watchlist
Tx_Extbase_Utility_Extension::registerPlugin($_EXTKEY, 'Watchlist', 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.plugin.watchlist');

# Address
//Tx_Extbase_Utility_Extension::registerPlugin($_EXTKEY, 'Address', 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.plugin.address');



# FLEXFORMS

# Category
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['hypestore_category'] = 'layout,select_key';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['hypestore_category'] = 'pi_flexform';
t3lib_extMgm::addPiFlexFormValue('hypestore_category', 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/category.flexform.xml');

# Product
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['hypestore_product'] = 'layout,select_key';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['hypestore_product'] = 'pi_flexform';
t3lib_extMgm::addPiFlexFormValue('hypestore_product', 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/product.flexform.xml');

# Cart
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['hypestore_cart'] = 'layout,select_key';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['hypestore_cart'] = 'pi_flexform';
t3lib_extMgm::addPiFlexFormValue('hypestore_cart', 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/cart.flexform.xml');

# Watchlist
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['hypestore_watchlist'] = 'layout,select_key';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['hypestore_watchlist'] = 'pi_flexform';
t3lib_extMgm::addPiFlexFormValue('hypestore_watchlist', 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/watchlist.flexform.xml');



# TABLES

# Category
t3lib_extMgm::allowTableOnStandardPages('tx_hypestore_domain_model_category');
$TCA['tx_hypestore_domain_model_category'] = array(
	'ctrl' => array(
		'title'	 => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_category',
		'label'	 => 'title',
		//'label_alt' => 'category',
		//'label_alt_force' => TRUE,
		//'label_userFunc' => 'tx_hypestore_tca_label->getCategory',
		'tstamp'	=> 'tstamp',
		'crdate'	=> 'crdate',
		'cruser_id' => 'cruser_id',
		'languageField'			=> 'sys_language_uid',
		'transOrigPointerField'	=> 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'sortby' => 'sorting',
		//'default_sortby' => 'categories, title',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
			'fe_group' => 'fe_group',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/tca.php',
		'iconfile'		=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Configuration/TCA/Icons/category.png',

		'dividers2tabs' => TRUE,
	),
);

# Product type
t3lib_extMgm::allowTableOnStandardPages('tx_hypestore_domain_model_product_type');
$TCA['tx_hypestore_domain_model_product_type'] = array(
	'ctrl' => array(
		'title'	 => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product_type',
		'label'	 => 'title',
		//'label_alt' => 'keyword',
		//'label_alt_force' => TRUE,
		'tstamp'	=> 'tstamp',
		'crdate'	=> 'crdate',
		'cruser_id' => 'cruser_id',
		'languageField'			=> 'sys_language_uid',
		'transOrigPointerField'	=> 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		//'sortby' => 'sorting',
		'default_sortby' => 'title',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
			'fe_group' => 'fe_group',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/tca.php',
		'iconfile'		=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Configuration/TCA/Icons/product-type.png',

		'dividers2tabs' => TRUE,
		'thumbnail' => 'icon',
		'adminOnly' => TRUE,
		'is_static' => TRUE,
		'typeicon_column' => 'keyword',
		'typeicons' => array(
			'apparel' => '../typo3conf/ext/hype_store/Configuration/TCA/Icons/Product/apparel.png',
			'book' => '../typo3conf/ext/hype_store/Configuration/TCA/Icons/Product/book.png',
			'furniture' => '../typo3conf/ext/hype_store/Configuration/TCA/Icons/Product/furniture.png',
		),
	),
);

# Product
t3lib_extMgm::allowTableOnStandardPages('tx_hypestore_domain_model_product');
t3lib_extMgm::addToInsertRecords('tx_hypestore_domain_model_product');
$TCA['tx_hypestore_domain_model_product'] = array(
	'ctrl' => array(
		'title'	 => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product',
		'label'	 => 'identifier',
		'label_alt' => 'title',
		'label_alt_force' => TRUE,
		'tstamp'	=> 'tstamp',
		'crdate'	=> 'crdate',
		'cruser_id' => 'cruser_id',
		'languageField'			=> 'sys_language_uid',
		'transOrigPointerField'	=> 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		//'sortby' => 'sorting',
		'default_sortby' => 'identifier',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
			'fe_group' => 'fe_group',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/tca.php',
		'iconfile'		=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Configuration/TCA/Icons/product.png',

		'dividers2tabs' => TRUE,
		'thumbnail' => 'images',
		'type'		=> 'type',
		'typeicon_column' => 'type',
		'typeicons' => array(
			'apparel' => '../typo3conf/ext/hype_store/Configuration/TCA/Icons/Product/apparel.png',
			'book' => '../typo3conf/ext/hype_store/Configuration/TCA/Icons/Product/book.png',
			'furniture' => '../typo3conf/ext/hype_store/Configuration/TCA/Icons/Product/furniture.png',
		),
	),
);
$TCA['tx_hypestore_domain_model_product']['ctrl']['typeicons']['1'] = $TCA['tx_hypestore_domain_model_product']['ctrl']['typeicons']['book'];
$TCA['tx_hypestore_domain_model_product']['ctrl']['typeicons']['2'] = $TCA['tx_hypestore_domain_model_product']['ctrl']['typeicons']['furniture'];
$TCA['tx_hypestore_domain_model_product']['ctrl']['typeicons']['3'] = $TCA['tx_hypestore_domain_model_product']['ctrl']['typeicons']['apparel'];

# Article
t3lib_extMgm::allowTableOnStandardPages('tx_hypestore_domain_model_article');
$TCA['tx_hypestore_domain_model_article'] = array(
	'ctrl' => array(
		'title'	 => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_article',
		'label'	 => 'identifier',
		'label_alt' => 'product',
		'label_alt_force' => TRUE,
		'tstamp'	=> 'tstamp',
		'crdate'	=> 'crdate',
		'cruser_id' => 'cruser_id',
		'languageField'			=> 'sys_language_uid',
		'transOrigPointerField'	=> 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		//'sortby' => 'sorting',
		'default_sortby' => 'identifier',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
			'fe_group' => 'fe_group',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/tca.php',
		'iconfile'		=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Configuration/TCA/Icons/article.png',

		'hideTable' => TRUE,
		'dividers2tabs' => TRUE,
		'thumbnail' => 'images',
		'type'		=> 'type',
		'typeicon_column' => 'type',
		'typeicons' => array(
			'apparel' => '../typo3conf/ext/hype_store/Configuration/TCA/Icons/Product/apparel.png',
			'book' => '../typo3conf/ext/hype_store/Configuration/TCA/Icons/Product/book.png',
			'furniture' => '../typo3conf/ext/hype_store/Configuration/TCA/Icons/Product/furniture.png',
		),
	),
);

# Product attribute
t3lib_extMgm::allowTableOnStandardPages('tx_hypestore_domain_model_product_attribute');
$TCA['tx_hypestore_domain_model_product_attribute'] = array(
	'ctrl' => array(
		'title'	 => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product_attribute',
		'label'	 => 'attribute',
		'tstamp'	=> 'tstamp',
		'crdate'	=> 'crdate',
		'cruser_id' => 'cruser_id',
		'languageField'			=> 'sys_language_uid',
		'transOrigPointerField'	=> 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'default_sortby' => 'ORDER BY crdate',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
			'fe_group' => 'fe_group',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/tca.php',
		'iconfile'		=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Configuration/TCA/Icons/attribute-value.png',

		'hideTable' => TRUE,
		'dividers2tabs' => TRUE,
	),
);

# Product price
t3lib_extMgm::allowTableOnStandardPages('tx_hypestore_domain_model_product_price');
$TCA['tx_hypestore_domain_model_product_price'] = array(
	'ctrl' => array(
		'title'	 => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product_price',
		'label'	 => 'value',
		//'label_userFunc' => 'tx_hypestore_tca_label->getPrice',
		'tstamp'	=> 'tstamp',
		'crdate'	=> 'crdate',
		'cruser_id' => 'cruser_id',
		'languageField'			=> 'sys_language_uid',
		'transOrigPointerField'	=> 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'default_sortby' => 'ORDER BY crdate',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
			'fe_group' => 'fe_group',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/tca.php',
		'iconfile'		=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Configuration/TCA/Icons/price.png',

		'hideTable' => TRUE,
		'dividers2tabs' => TRUE,
	),
);

# Tax svale
t3lib_extMgm::allowTableOnStandardPages('tx_hypestore_domain_model_tax_scale');
$TCA['tx_hypestore_domain_model_tax_scale'] = array(
	'ctrl' => array(
		'title'	 => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_tax_scale',
		'label'	 => 'rate',
		//'label_userFunc' => 'tx_hypestore_tca_label->getPrice',
		'tstamp'	=> 'tstamp',
		'crdate'	=> 'crdate',
		'cruser_id' => 'cruser_id',
		'languageField'			=> 'sys_language_uid',
		'transOrigPointerField'	=> 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'default_sortby' => 'ORDER BY rate',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
			'fe_group' => 'fe_group',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/tca.php',
		'iconfile'		=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Configuration/TCA/Icons/tax-scale.png',

		'dividers2tabs' => TRUE,
	),
);

# Product stock
t3lib_extMgm::allowTableOnStandardPages('tx_hypestore_domain_model_product_stock');
$TCA['tx_hypestore_domain_model_product_stock'] = array(
	'ctrl' => array(
		'title'	 => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product_stock',
		'label'	 => 'product',
		'tstamp'	=> 'tstamp',
		'crdate'	=> 'crdate',
		'cruser_id' => 'cruser_id',
		'languageField'			=> 'sys_language_uid',
		'transOrigPointerField'	=> 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'sortby' => 'sorting',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
			'fe_group' => 'fe_group',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/tca.php',
		'iconfile'		=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Configuration/TCA/Icons/stock.png',

		'hideTable' => TRUE,
		'dividers2tabs' => TRUE,
	),
);

# Article stock
t3lib_extMgm::allowTableOnStandardPages('tx_hypestore_domain_model_article_stock');
$TCA['tx_hypestore_domain_model_article_stock'] = array(
	'ctrl' => array(
		'title'	 => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_article_stock',
		'label'	 => 'article',
		'tstamp'	=> 'tstamp',
		'crdate'	=> 'crdate',
		'cruser_id' => 'cruser_id',
		'languageField'			=> 'sys_language_uid',
		'transOrigPointerField'	=> 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'sortby' => 'sorting',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
			'fe_group' => 'fe_group',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/tca.php',
		'iconfile'		=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Configuration/TCA/Icons/stock.png',

		'hideTable' => TRUE,
		'dividers2tabs' => TRUE,
	),
);

# Discount
t3lib_extMgm::allowTableOnStandardPages('tx_hypestore_domain_model_discount');
$TCA['tx_hypestore_domain_model_discount'] = array(
	'ctrl' => array(
		'title'	 => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_discount',
		'label'	 => 'title',
		'label_alt' => 'rate',
		'label_alt_force' => TRUE,
		'tstamp'	=> 'tstamp',
		'crdate'	=> 'crdate',
		'cruser_id' => 'cruser_id',
		'languageField'			=> 'sys_language_uid',
		'transOrigPointerField'	=> 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		//'sortby' => 'sorting',
		'default_sortby' => 'title',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
			'fe_group' => 'fe_group',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/tca.php',
		'iconfile'		=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Configuration/TCA/Icons/discount.png',

		'dividers2tabs' => TRUE,
		'hideTable' => TRUE,
	),
);

# Depot
t3lib_extMgm::allowTableOnStandardPages('tx_hypestore_domain_model_depot');
$TCA['tx_hypestore_domain_model_depot'] = array(
	'ctrl' => array(
		'title'	 => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_depot',
		'label'	 => 'title',
		'tstamp'	=> 'tstamp',
		'crdate'	=> 'crdate',
		'cruser_id' => 'cruser_id',
		'languageField'			=> 'sys_language_uid',
		'transOrigPointerField'	=> 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'sortby' => 'sorting',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
			'fe_group' => 'fe_group',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/tca.php',
		'iconfile'		=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Configuration/TCA/Icons/depot.png',

		'dividers2tabs' => TRUE,
	),
);

# Attribute
t3lib_extMgm::allowTableOnStandardPages('tx_hypestore_domain_model_attribute');
$TCA['tx_hypestore_domain_model_attribute'] = array(
	'ctrl' => array(
		'title'	 => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_attribute',
		'label'	 => 'title',
		'tstamp'	=> 'tstamp',
		'crdate'	=> 'crdate',
		'cruser_id' => 'cruser_id',
		'languageField'			=> 'sys_language_uid',
		'transOrigPointerField'	=> 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'default_sortby' => 'ORDER BY title',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
			'fe_group' => 'fe_group',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/tca.php',
		'iconfile'		=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Configuration/TCA/Icons/attribute.png',

		'dividers2tabs' => TRUE,
	),
);

# Cart item
t3lib_extMgm::allowTableOnStandardPages('tx_hypestore_domain_model_cart_item');
$TCA['tx_hypestore_domain_model_cart_item'] = array(
	'ctrl' => array(
		'title'	 => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_cart_item',
		'label'	 => 'product',
		'tstamp'	=> 'tstamp',
		'crdate'	=> 'crdate',
		'cruser_id' => 'cruser_id',
		'languageField'			=> 'sys_language_uid',
		'transOrigPointerField'	=> 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'default_sortby' => 'ORDER BY crdate',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
			'fe_group' => 'fe_group',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/tca.php',
		'iconfile'		=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Configuration/TCA/Icons/cart-item.png',

		'hideTable' => TRUE,
		'dividers2tabs' => TRUE,
	),
);

# Watchlist item
t3lib_extMgm::allowTableOnStandardPages('tx_hypestore_domain_model_watchlist_item');
$TCA['tx_hypestore_domain_model_watchlist_item'] = array(
	'ctrl' => array(
		'title'	 => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_watchlist_item',
		'label'	 => 'product',
		'tstamp'	=> 'tstamp',
		'crdate'	=> 'crdate',
		'cruser_id' => 'cruser_id',
		'languageField'			=> 'sys_language_uid',
		'transOrigPointerField'	=> 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'default_sortby' => 'ORDER BY crdate',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
			'fe_group' => 'fe_group',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/tca.php',
		'iconfile'		=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Configuration/TCA/Icons/watchlist-item.png',

		'hideTable' => TRUE,
		'dividers2tabs' => TRUE,
	),
);

# Order
t3lib_extMgm::allowTableOnStandardPages('tx_hypestore_domain_model_order');
$TCA['tx_hypestore_domain_model_order'] = array(
	'ctrl' => array(
		'title'	 => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_order',
		'label'	 => 'customer',
		//'label_alt' => 'category',
		//'label_alt_force' => TRUE,
		//'label_userFunc' => 'tx_hypestore_tca_label->getCategory',
		'tstamp'	=> 'tstamp',
		'crdate'	=> 'crdate',
		'cruser_id' => 'cruser_id',
		'languageField'			=> 'sys_language_uid',
		'transOrigPointerField'	=> 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'sortby' => 'sorting',
		//'default_sortby' => 'categories, title',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
			'fe_group' => 'fe_group',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/tca.php',
		'iconfile'		=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Configuration/TCA/Icons/order.png',

		'hideTable' => TRUE,
		'dividers2tabs' => TRUE,
	),
);





# EXTENDING TABLES

# Frontend Users
t3lib_div::loadTCA('fe_users');

# Common columns
$columns = array(
	'tx_hypestore_domain_model_shipping_address' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:fe_users.tx_hypestore_domain_model_shipping_address',
		'config' => array(
			'type' => 'select',
			'foreign_table' => 'tx_hypedirectory_domain_model_contact',
			'foreign_table_where' => 'AND tx_hypedirectory_domain_model_contact.frontend_user = ###THIS_UID###',
			'size' => 1,
			'minitems' => 0,
			'maxitems' => 1,
			'items' => array(
				array('', NULL),
			),
		),
	),
	'tx_hypestore_domain_model_billing_address' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:fe_users.tx_hypestore_domain_model_billing_address',
		'config' => array(
			'type' => 'select',
			'foreign_table' => 'tx_hypedirectory_domain_model_contact',
			'foreign_table_where' => 'AND tx_hypedirectory_domain_model_contact.frontend_user = ###THIS_UID###',
			'size' => 1,
			'minitems' => 0,
			'maxitems' => 1,
			'items' => array(
				array('', NULL),
			),
		),
	),
	'tx_hypestore_domain_model_cart_items' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:fe_users.tx_hypestore_domain_model_cart_items',
		'config' => array(
			'type'						=> 'inline',
			'foreign_table'				=> 'tx_hypestore_domain_model_cart_item',
			'foreign_field'				=> 'customer',
			'foreign_label'				=> 'product',
			'foreign_default_sortby'	=> 'product',
			'appearance'				=> array(
				'collapseAll'				=> TRUE,
				'expandSingle'				=> TRUE,
			),
			'minitems'					=> 0,
			'maxitems'					=> 999999,
		),
	),
	'tx_hypestore_domain_model_watchlist_items' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:fe_users.tx_hypestore_domain_model_watchlist_items',
		'config' => array(
			'type'						=> 'inline',
			'foreign_table'				=> 'tx_hypestore_domain_model_watchlist_item',
			'foreign_field'				=> 'customer',
			'foreign_label'				=> 'product',
			'foreign_default_sortby'	=> 'product',
			'appearance'				=> array(
				'collapseAll'				=> TRUE,
				'expandSingle'				=> TRUE,
			),
			'minitems'					=> 0,
			'maxitems'					=> 999999,
		),
	),
	'tx_hypestore_domain_model_orders' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:fe_users.tx_hypestore_domain_model_orders',
		'config' => array(
			'type'						=> 'inline',
			'foreign_table'				=> 'tx_hypestore_domain_model_order',
			'foreign_field'				=> 'customer',
			//'foreign_label'			=> 'product',
			//'foreign_default_sortby'	=> 'product',
			'appearance'				=> array(
				'collapseAll'				=> TRUE,
				'expandSingle'				=> TRUE,
			),
			'minitems'					=> 0,
			'maxitems'					=> 999999,
		),
	),
);

t3lib_extMgm::addTCAcolumns('fe_users', $columns, 1);
t3lib_extMgm::addToAllTCAtypes('fe_users', '--div--;Store,tx_hypestore_domain_model_shipping_address,tx_hypestore_domain_model_billing_address,tx_hypestore_domain_model_orders;;;;1-1-1,tx_hypestore_domain_model_cart_items;;;;1-1-1,tx_hypestore_domain_model_watchlist_items;;;;1-1-1', '', 'after:tx_hypedirectory_domain_model_addresses');

# Contacts
t3lib_div::loadTCA('tx_hypedirectory_domain_model_contact');

# Common columns
$columns = array(
	'tx_hypestore_domain_model_created_products' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypedirectory_domain_model_contact.tx_hypestore_domain_model_created_products',
		'config' => array(
			'type' => 'group',
			'internal_type' => 'db',
			'allowed' => 'tx_hypestore_domain_model_product',
			'prepend_tname' => FALSE,
			'foreign_table' => 'tx_hypestore_domain_model_product',
			'MM' => 'tx_hypestore_relation_product_contact',
			'MM_match_fields' => array('dedication' => 'author'),
			'MM_opposite_field' => 'authors',
			'size' => 3,
			'autoSizeMax' => 5,
			'minitems' => 0,
			'maxitems' => 999999,
			'disable_controls' => 'browser',
			'wizards' => array(
				'suggest' => array(
					'type' => 'suggest',
					'default' => array(
						'searchWholePhrase' => 1,
						'searchCondition' => 'type = \'book\'',
					),
				),
			),
		),
	),
	'tx_hypestore_domain_model_published_products' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypedirectory_domain_model_contact.tx_hypestore_domain_model_published_products',
		'config' => array(
			'type' => 'group',
			'internal_type' => 'db',
			'allowed' => 'tx_hypestore_domain_model_product',
			'prepend_tname' => FALSE,
			'foreign_table' => 'tx_hypestore_domain_model_product',
			'MM' => 'tx_hypestore_relation_product_contact',
			'MM_match_fields' => array('dedication' => 'publisher'),
			'MM_opposite_field' => 'publisher',
			'size' => 3,
			'autoSizeMax' => 5,
			'minitems' => 0,
			'maxitems' => 999999,
			'disable_controls' => 'browser',
			'wizards' => array(
				'suggest' => array(
					'type' => 'suggest',
					'default' => array(
						'searchWholePhrase' => 1,
						'searchCondition' => 'type = \'book\'',
					),
				),
			),
		),
	),
	'tx_hypestore_domain_model_edited_products' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypedirectory_domain_model_contact.tx_hypestore_domain_model_edited_products',
		'config' => array(
			'type' => 'group',
			'internal_type' => 'db',
			'allowed' => 'tx_hypestore_domain_model_product',
			'prepend_tname' => FALSE,
			'foreign_table' => 'tx_hypestore_domain_model_product',
			'MM' => 'tx_hypestore_relation_product_contact',
			'MM_match_fields' => array('dedication' => 'editor'),
			'MM_opposite_field' => 'editor',
			'size' => 3,
			'autoSizeMax' => 5,
			'minitems' => 0,
			'maxitems' => 999999,
			'disable_controls' => 'browser',
			'wizards' => array(
				'suggest' => array(
					'type' => 'suggest',
					'default' => array(
						'searchWholePhrase' => 1,
						'searchCondition' => 'type = \'book\'',
					),
				),
			),
		),
	),
);

t3lib_extMgm::addTCAcolumns('tx_hypedirectory_domain_model_contact', $columns, 1);
t3lib_extMgm::addToAllTCAtypes('tx_hypedirectory_domain_model_contact', '--div--;Store,tx_hypestore_domain_model_created_products,tx_hypestore_domain_model_published_products,tx_hypestore_domain_model_edited_products', 'person', 'after:backend_user');
t3lib_extMgm::addToAllTCAtypes('tx_hypedirectory_domain_model_contact', '--div--;Store,tx_hypestore_domain_model_created_products,tx_hypestore_domain_model_published_products,tx_hypestore_domain_model_edited_products', 'corporation', 'after:related_address');



# HOOKS

# TCE Forms
$GLOBALS['TYPO3_CONF_VARS']['BE']['XCLASS']['t3lib/class.t3lib_tceforms.php'] = t3lib_extMgm::extPath($_EXTKEY) . '/Classes/Hook/class.tx_hypestore_t3lib_tceforms.php';



# WEB MODULE

if(TYPO3_MODE == 'BE') {

	# Category
	$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['cms']['db_layout']['addTables']['tx_hypestore_domain_model_category'][0] = array(
		'fList' => 'title,subtitle,products',
		'icon' => TRUE,
	);

	# Product
	$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['cms']['db_layout']['addTables']['tx_hypestore_domain_model_product'][0] = array(
		'fList' => 'identifier,title,subtitle,images',
		'icon' => TRUE,
	);

	# TaxScale
	$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['cms']['db_layout']['addTables']['tx_hypestore_domain_model_tax_scale'][0] = array(
		'fList' => 'rate',
		'icon' => TRUE,
	);

	# Depot
	$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['cms']['db_layout']['addTables']['tx_hypestore_domain_model_depot'][0] = array(
		'fList' => 'title,city,country',
		'icon' => TRUE,
	);

	# Attribute
	$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['cms']['db_layout']['addTables']['tx_hypestore_domain_model_attribute'][0] = array(
		'fList' => 'title,unit,type',
		'icon' => TRUE,
	);

	# Order
	$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['cms']['db_layout']['addTables']['tx_hypestore_domain_model_order'][0] = array(
		'fList' => 'customer',
		'icon' => TRUE,
	);
}



# PAGE ICONS

if(TYPO3_MODE == 'BE') {

	# Extension
	$TCA['pages']['columns']['module']['config']['items'][] = array('LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore', 'hype_sto_0', 'EXT:hype_store/ext_icon.gif');
	t3lib_SpriteManager::addTcaTypeIcon('pages', 'contains-hype_sto_0', t3lib_extMgm::extRelPath($_EXTKEY) . 'ext_icon.gif');

	# Category
	$TCA['pages']['columns']['module']['config']['items'][] = array('LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_category', 'hype_sto_1', 'EXT:hype_store/Configuration/TCA/Icons/category.png');
	t3lib_SpriteManager::addTcaTypeIcon('pages', 'contains-hype_sto_1', t3lib_extMgm::extRelPath($_EXTKEY) . 'Configuration/TCA/Icons/category.png');

	# Product
	$TCA['pages']['columns']['module']['config']['items'][] = array('LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product', 'hype_sto_2', 'EXT:hype_store/Configuration/TCA/Icons/product.png');
	t3lib_SpriteManager::addTcaTypeIcon('pages', 'contains-hype_sto_2', t3lib_extMgm::extRelPath($_EXTKEY) . 'Configuration/TCA/Icons/product.png');

	# Tax scale
	$TCA['pages']['columns']['module']['config']['items'][] = array('LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_tax_scale', 'hype_sto_3', 'EXT:hype_store/Configuration/TCA/Icons/tax-scale.png');
	t3lib_SpriteManager::addTcaTypeIcon('pages', 'contains-hype_sto_3', t3lib_extMgm::extRelPath($_EXTKEY) . 'Configuration/TCA/Icons/tax-scale.png');

	# Discount
	$TCA['pages']['columns']['module']['config']['items'][] = array('LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_discount', 'hype_sto_4', 'EXT:hype_store/Configuration/TCA/Icons/discount.png');
	t3lib_SpriteManager::addTcaTypeIcon('pages', 'contains-hype_sto_4', t3lib_extMgm::extRelPath($_EXTKEY) . 'Configuration/TCA/Icons/discount.png');

	# Depot
	$TCA['pages']['columns']['module']['config']['items'][] = array('LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_depot', 'hype_sto_5', 'EXT:hype_store/Configuration/TCA/Icons/depot.png');
	t3lib_SpriteManager::addTcaTypeIcon('pages', 'contains-hype_sto_5', t3lib_extMgm::extRelPath($_EXTKEY) . 'Configuration/TCA/Icons/depot.png');

	# Order
	$TCA['pages']['columns']['module']['config']['items'][] = array('LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_order', 'hype_sto_6', 'EXT:hype_store/Configuration/TCA/Icons/order.png');
	t3lib_SpriteManager::addTcaTypeIcon('pages', 'contains-hype_sto_6', t3lib_extMgm::extRelPath($_EXTKEY) . 'Configuration/TCA/Icons/order.png');

	# Attributes
	$TCA['pages']['columns']['module']['config']['items'][] = array('LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_attribute', 'hype_sto_7', 'EXT:hype_store/Configuration/TCA/Icons/attribute.png');
	t3lib_SpriteManager::addTcaTypeIcon('pages', 'contains-hype_sto_7', t3lib_extMgm::extRelPath($_EXTKEY) . 'Configuration/TCA/Icons/attribute.png');

	# Cart Items
	$TCA['pages']['columns']['module']['config']['items'][] = array('LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_cart_item', 'hype_sto_8', 'EXT:hype_store/Configuration/TCA/Icons/cart-item.png');
	t3lib_SpriteManager::addTcaTypeIcon('pages', 'contains-hype_sto_8', t3lib_extMgm::extRelPath($_EXTKEY) . 'Configuration/TCA/Icons/cart-item.png');

	# Watchlist Items
	$TCA['pages']['columns']['module']['config']['items'][] = array('LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_watchlist_item', 'hype_sto_9', 'EXT:hype_store/Configuration/TCA/Icons/watchlist-item.png');
	t3lib_SpriteManager::addTcaTypeIcon('pages', 'contains-hype_sto_9', t3lib_extMgm::extRelPath($_EXTKEY) . 'Configuration/TCA/Icons/watchlist-item.png');
}



# HELP

if(TYPO3_MODE == 'BE') {

	# RECORD

	# Category
	t3lib_extMgm::addLLrefForTCAdescr('tx_hypestore_domain_model_category', 'EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_csh-record_category.xml');

	# Product Type
	t3lib_extMgm::addLLrefForTCAdescr('tx_hypestore_domain_model_product_type', 'EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_csh-record_product_type.xml');

	# Product
	t3lib_extMgm::addLLrefForTCAdescr('tx_hypestore_domain_model_product', 'EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_csh-record_product.xml');

	# Product Attribute
	t3lib_extMgm::addLLrefForTCAdescr('tx_hypestore_domain_model_product_attribute', 'EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_csh-record_product_attribute.xml');

	# Product Price
	t3lib_extMgm::addLLrefForTCAdescr('tx_hypestore_domain_model_product_price', 'EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_csh-record_product_price.xml');

	# Product Stock
	t3lib_extMgm::addLLrefForTCAdescr('tx_hypestore_domain_model_product_stock', 'EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_csh-record_product_stock.xml');

	# Tax Scale
	t3lib_extMgm::addLLrefForTCAdescr('tx_hypestore_domain_model_tax_scale', 'EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_csh-record_tax_scale.xml');

	# Depot
	t3lib_extMgm::addLLrefForTCAdescr('tx_hypestore_domain_model_depot', 'EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_csh-record_depot.xml');

	# Attribute
	t3lib_extMgm::addLLrefForTCAdescr('tx_hypestore_domain_model_attribute', 'EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_csh-record_attribute.xml');

	# Order
	t3lib_extMgm::addLLrefForTCAdescr('tx_hypestore_domain_model_order', 'EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_csh-record_order.xml');

	# Cart Item
	t3lib_extMgm::addLLrefForTCAdescr('tx_hypestore_domain_model_cart_item', 'EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_csh-record_cart_item.xml');

	# Watchlist Item
	t3lib_extMgm::addLLrefForTCAdescr('tx_hypestore_domain_model_watchlist_item', 'EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_csh-record_watchlist_item.xml');



	# PLUGIN

	# Category
	t3lib_extMgm::addLLrefForTCAdescr('tt_content.pi_flexform.hypestore_category.list', 'EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_csh-plugin_category.xml');

	# Product
	t3lib_extMgm::addLLrefForTCAdescr('tt_content.pi_flexform.hypestore_product.list', 'EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_csh-plugin_product.xml');

	# Cart
	t3lib_extMgm::addLLrefForTCAdescr('tt_content.pi_flexform.hypestore_cart.list', 'EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_csh-plugin_cart.xml');

	# Checkout
	t3lib_extMgm::addLLrefForTCAdescr('tt_content.pi_flexform.hypestore_checkout.list', 'EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_csh-plugin_checkout.xml');

	# Watchlist
	t3lib_extMgm::addLLrefForTCAdescr('tt_content.pi_flexform.hypestore_watchlist.list', 'EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_csh-plugin_watchlist.xml');
}

?>