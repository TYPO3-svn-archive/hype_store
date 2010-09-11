<?php

if(!defined('TYPO3_MODE'))
	die('Access denied.');



require_once(t3lib_extMgm::extPath($_EXTKEY) . 'Classes/Hook/class.tx_hypestore_tca_label.php');
require_once(t3lib_extMgm::extPath($_EXTKEY) . 'Classes/Utility/Tca.php');


# TypoScript
t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript/', 'Hype Store');


# Plugins
Tx_Extbase_Utility_Extension::registerPlugin($_EXTKEY, 'Category', 'Hype Store, Category');
Tx_Extbase_Utility_Extension::registerPlugin($_EXTKEY, 'Product', 'Hype Store, Product');
Tx_Extbase_Utility_Extension::registerPlugin($_EXTKEY, 'Cart', 'Hype Store, Cart');
Tx_Extbase_Utility_Extension::registerPlugin($_EXTKEY, 'Checkout', 'Hype Store, Checkout');
Tx_Extbase_Utility_Extension::registerPlugin($_EXTKEY, 'Watchlist', 'Hype Store, Watchlist');
Tx_Extbase_Utility_Extension::registerPlugin($_EXTKEY, 'Address', 'Hype Store, Address');

# Flexforms
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['hypestore_category'] = 'layout,select_key';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['hypestore_category'] = 'pi_flexform';
t3lib_extMgm::addPiFlexFormValue('hypestore_category', 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/category.flexform.xml');

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['hypestore_product'] = 'layout,select_key';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['hypestore_product'] = 'pi_flexform';
t3lib_extMgm::addPiFlexFormValue('hypestore_product', 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/product.flexform.xml');

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['hypestore_cart'] = 'layout,select_key';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['hypestore_cart'] = 'pi_flexform';
t3lib_extMgm::addPiFlexFormValue('hypestore_cart', 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/cart.flexform.xml');

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['hypestore_watchlist'] = 'layout,select_key';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['hypestore_watchlist'] = 'pi_flexform';
t3lib_extMgm::addPiFlexFormValue('hypestore_watchlist', 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/watchlist.flexform.xml');


# Hooks
$GLOBALS['TYPO3_CONF_VARS']['BE']['XCLASS']['t3lib/class.t3lib_tceforms.php'] = t3lib_extMgm::extPath($_EXTKEY) . '/Classes/Hook/class.tx_hypestore_t3lib_tceforms.php';


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

# Tax group
t3lib_extMgm::allowTableOnStandardPages('tx_hypestore_domain_model_tax_group');
$TCA['tx_hypestore_domain_model_tax_group'] = array(
	'ctrl' => array(
		'title'	 => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_tax_group',
		'label'	 => 'value',
		//'label_userFunc' => 'tx_hypestore_tca_label->getPrice',
		'tstamp'	=> 'tstamp',
		'crdate'	=> 'crdate',
		'cruser_id' => 'cruser_id',
		'languageField'			=> 'sys_language_uid',
		'transOrigPointerField'	=> 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'default_sortby' => 'ORDER BY value',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
			'fe_group' => 'fe_group',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/tca.php',
		'iconfile'		=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Configuration/TCA/Icons/tax-group.png',
		
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
	
	# TaxGroup
	$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['cms']['db_layout']['addTables']['tx_hypestore_domain_model_tax_group'][0] = array(
		'fList' => 'value',
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

$TCA['pages']['columns']['module']['config']['items'][] = array('LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_category', 'tx_hypestore_category', 'EXT:hype_store/Configuration/TCA/Icons/category.png');
$TCA['pages']['columns']['module']['config']['items'][] = array('LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product', 'tx_hypestore_product', 'EXT:hype_store/Configuration/TCA/Icons/product.png');
$TCA['pages']['columns']['module']['config']['items'][] = array('LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_tax_group', 'tx_hypestore_tax_group', 'EXT:hype_store/Configuration/TCA/Icons/tax-group.png');
$TCA['pages']['columns']['module']['config']['items'][] = array('LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_depot', 'tx_hypestore_depot', 'EXT:hype_store/Configuration/TCA/Icons/depot.png');
$TCA['pages']['columns']['module']['config']['items'][] = array('LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_order', 'tx_hypestore_order', 'EXT:hype_store/Configuration/TCA/Icons/order.png');

?>