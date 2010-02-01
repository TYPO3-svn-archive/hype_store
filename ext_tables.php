<?php

if(!defined('TYPO3_MODE'))
    die('Access denied.');



require_once(t3lib_extMgm::extPath($_EXTKEY) . 'Classes/Hook/class.tx_hypestore_tca_label.php');


# add default setup & constants
t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript/', 'Hype Store');


# Plugins
Tx_Extbase_Utility_Extension::registerPlugin($_EXTKEY, 'Category', 'Hype Store, Category');
Tx_Extbase_Utility_Extension::registerPlugin($_EXTKEY, 'Product', 'Hype Store, Product');
Tx_Extbase_Utility_Extension::registerPlugin($_EXTKEY, 'Cart', 'Hype Store, Cart');
Tx_Extbase_Utility_Extension::registerPlugin($_EXTKEY, 'Checkout', 'Hype Store, Checkout');
Tx_Extbase_Utility_Extension::registerPlugin($_EXTKEY, 'Watchlist', 'Hype Store, Watchlist');

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


# Tables
t3lib_extMgm::allowTableOnStandardPages('tx_hypestore_domain_model_category');

$TCA['tx_hypestore_domain_model_category'] = array(
    'ctrl' => array(
        'title'     => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_category',    
        'label'     => 'title',
		//'label_alt' => 'category',
		//'label_alt_force' => TRUE,
		//'label_userFunc' => 'tx_hypestore_tca_label->getCategory',
        'tstamp'    => 'tstamp',
        'crdate'    => 'crdate',
        'cruser_id' => 'cruser_id',
        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l10n_parent',
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
        'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY) . 'Configuration/TCA/Icons/category.icon.png',
		
		'dividers2tabs' => TRUE,
    ),
);


t3lib_extMgm::allowTableOnStandardPages('tx_hypestore_domain_model_product');

$TCA['tx_hypestore_domain_model_product'] = array(
    'ctrl' => array(
        'title'     => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product',    
        'label'     => 'identifier',
		'label_alt' => 'title',
		'label_alt_force' => TRUE,
        'tstamp'    => 'tstamp',
        'crdate'    => 'crdate',
        'cruser_id' => 'cruser_id',
        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l10n_parent',
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
        'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY) . 'Configuration/TCA/Icons/product.icon.png',
		
		'dividers2tabs' => TRUE,
		'thumbnail' => 'images',
    ),
);


t3lib_extMgm::allowTableOnStandardPages('tx_hypestore_domain_model_product_attribute');

$TCA['tx_hypestore_domain_model_product_attribute'] = array(
    'ctrl' => array(
        'title'     => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product_attribute', 
        'label'     => 'attribute',
        'tstamp'    => 'tstamp',
        'crdate'    => 'crdate',
        'cruser_id' => 'cruser_id',
        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l10n_parent',
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
        'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY) . 'Configuration/TCA/Icons/value.icon.png',
		
		'hideTable' => TRUE,
		'dividers2tabs' => TRUE,
    ),
);


t3lib_extMgm::allowTableOnStandardPages('tx_hypestore_domain_model_product_price');

$TCA['tx_hypestore_domain_model_product_price'] = array(
    'ctrl' => array(
        'title'     => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product_price', 
        'label'     => 'value',
		'label_userFunc' => 'tx_hypestore_tca_label->getPrice',
        'tstamp'    => 'tstamp',
        'crdate'    => 'crdate',
        'cruser_id' => 'cruser_id',
        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l10n_parent',
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
        'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY) . 'Configuration/TCA/Icons/price.icon.png',
		
		'hideTable' => TRUE,
		'dividers2tabs' => TRUE,
    ),
);


t3lib_extMgm::allowTableOnStandardPages('tx_hypestore_domain_model_product_stock');

$TCA['tx_hypestore_domain_model_product_stock'] = array(
    'ctrl' => array(
        'title'     => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product_stock',    
        'label'     => 'product',
        'tstamp'    => 'tstamp',
        'crdate'    => 'crdate',
        'cruser_id' => 'cruser_id',
        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l10n_parent',
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
        'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY) . 'Configuration/TCA/Icons/stock.icon.png',
		
		'hideTable' => TRUE,
		'dividers2tabs' => TRUE,
    ),
);


t3lib_extMgm::allowTableOnStandardPages('tx_hypestore_domain_model_product_state');

$TCA['tx_hypestore_domain_model_product_state'] = array(
    'ctrl' => array(
        'title'     => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product_state',    
        'label'     => 'reason',
        'tstamp'    => 'tstamp',
        'crdate'    => 'crdate',
        'cruser_id' => 'cruser_id',
        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l10n_parent',
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
        'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY) . 'Configuration/TCA/Icons/state.icon.png',
		
		'hideTable' => TRUE,
		'dividers2tabs' => TRUE,
    ),
);


t3lib_extMgm::allowTableOnStandardPages('tx_hypestore_domain_model_product_event');

$TCA['tx_hypestore_domain_model_product_event'] = array(
    'ctrl' => array(
        'title'     => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product_event',    
        'label'     => 'action',
        'tstamp'    => 'tstamp',
        'crdate'    => 'crdate',
        'cruser_id' => 'cruser_id',
        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l10n_parent',
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
        'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY) . 'Configuration/TCA/Icons/event.icon.png',
		
		'hideTable' => TRUE,
		'dividers2tabs' => TRUE,
    ),
);


t3lib_extMgm::allowTableOnStandardPages('tx_hypestore_domain_model_depot');

$TCA['tx_hypestore_domain_model_depot'] = array(
    'ctrl' => array(
        'title'     => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_depot',    
        'label'     => 'title',
        'tstamp'    => 'tstamp',
        'crdate'    => 'crdate',
        'cruser_id' => 'cruser_id',
        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l10n_parent',
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
        'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY) . 'Configuration/TCA/Icons/depot.icon.png',
		
		'dividers2tabs' => TRUE,
    ),
);


t3lib_extMgm::allowTableOnStandardPages('tx_hypestore_domain_model_attribute');

$TCA['tx_hypestore_domain_model_attribute'] = array(
    'ctrl' => array(
        'title'     => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_attribute',
        'label'     => 'title',
        'tstamp'    => 'tstamp',
        'crdate'    => 'crdate',
        'cruser_id' => 'cruser_id',
        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l10n_parent',
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
        'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY) . 'Configuration/TCA/Icons/attribute.icon.png',
		
		'dividers2tabs' => TRUE,
    ),
);


t3lib_extMgm::allowTableOnStandardPages('tx_hypestore_domain_model_cart_item');

$TCA['tx_hypestore_domain_model_cart_item'] = array(
    'ctrl' => array(
        'title'     => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_cart_item',
        'label'     => 'product',
        'tstamp'    => 'tstamp',
        'crdate'    => 'crdate',
        'cruser_id' => 'cruser_id',
        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l10n_parent',
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
        'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY) . 'Configuration/TCA/Icons/cart_item.icon.png',
		
		'hideTable' => TRUE,
		'dividers2tabs' => TRUE,
    ),
);


t3lib_extMgm::allowTableOnStandardPages('tx_hypestore_domain_model_watchlist_item');

$TCA['tx_hypestore_domain_model_watchlist_item'] = array(
    'ctrl' => array(
        'title'     => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_watchlist_item',
        'label'     => 'product',
        'tstamp'    => 'tstamp',
        'crdate'    => 'crdate',
        'cruser_id' => 'cruser_id',
        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l10n_parent',
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
        'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY) . 'Configuration/TCA/Icons/watchlist_item.icon.png',
		
		'hideTable' => TRUE,
		'dividers2tabs' => TRUE,
    ),
);


t3lib_extMgm::allowTableOnStandardPages('tx_hypestore_domain_model_customer_address');

$TCA['tx_hypestore_domain_model_customer_address'] = array(
    'ctrl' => array(
        'title'     => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_customer_address',    
        'label'     => 'title',
		//'label_alt' => 'category',
		//'label_alt_force' => TRUE,
		//'label_userFunc' => 'tx_hypestore_tca_label->getCategory',
        'tstamp'    => 'tstamp',
        'crdate'    => 'crdate',
        'cruser_id' => 'cruser_id',
        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l10n_parent',
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
        'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY) . 'Configuration/TCA/Icons/customer_address.icon.png',
		
		'hideTable' => TRUE,
		'dividers2tabs' => TRUE,
    ),
);


t3lib_extMgm::allowTableOnStandardPages('tx_hypestore_domain_model_order');

$TCA['tx_hypestore_domain_model_order'] = array(
    'ctrl' => array(
        'title'     => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_order',    
        'label'     => 'customer',
		//'label_alt' => 'category',
		//'label_alt_force' => TRUE,
		//'label_userFunc' => 'tx_hypestore_tca_label->getCategory',
        'tstamp'    => 'tstamp',
        'crdate'    => 'crdate',
        'cruser_id' => 'cruser_id',
        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l10n_parent',
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
        'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY) . 'Configuration/TCA/Icons/order.icon.png',
		
		'hideTable' => TRUE,
		'dividers2tabs' => TRUE,
    ),
);


t3lib_extMgm::allowTableOnStandardPages('tx_hypestore_domain_model_manufacturer');

$TCA['tx_hypestore_domain_model_manufacturer'] = array(
    'ctrl' => array(
        'title'     => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_manufacturer',    
        'label'     => 'title',
		//'label_alt' => 'category',
		//'label_alt_force' => TRUE,
		//'label_userFunc' => 'tx_hypestore_tca_label->getCategory',
        'tstamp'    => 'tstamp',
        'crdate'    => 'crdate',
        'cruser_id' => 'cruser_id',
        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l10n_parent',
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
        'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY) . 'Configuration/TCA/Icons/manufacturer.icon.png',
		
		'dividers2tabs' => TRUE,
    ),
);



$columns = array (
	'tx_hypestore_domain_model_addresses' => array (
		'exclude' => 1,
		'label' => "LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:fe_users.tx_hypestore_domain_model_addresses",
		'config' => array (
			'type'				=> 'inline',
			'foreign_table'		=> 'tx_hypestore_domain_model_customer_address',
			'foreign_field'		=> 'customer',
			//'foreign_label'		=> 'product',
			'appearance'		=> array(
				'collapseAll'		=> TRUE,
				'expandSingle'		=> TRUE,
			),
			'minitems'			=> 0,
			'maxitems'			=> 999999,
		),
	),
	'tx_hypestore_domain_model_cart_items' => array (
		'exclude' => 1,
		'label' => "LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:fe_users.tx_hypestore_domain_model_cart_items",
		'config' => array (
			'type'				=> 'inline',
			'foreign_table'		=> 'tx_hypestore_domain_model_cart_item',
			'foreign_field'		=> 'customer',
			//'foreign_label'		=> 'product',
			'appearance'		=> array(
				'collapseAll'		=> TRUE,
				'expandSingle'		=> TRUE,
			),
			'minitems'			=> 0,
			'maxitems'			=> 999999,
		),
	),
	'tx_hypestore_domain_model_watchlist_items' => array (
		'exclude' => 1,
		'label' => "LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:fe_users.tx_hypestore_domain_model_watchlist_items",
		'config' => array (
			'type'				=> 'inline',
			'foreign_table'		=> 'tx_hypestore_domain_model_watchlist_item',
			'foreign_field'		=> 'customer',
			//'foreign_label'		=> 'product',
			'appearance'		=> array(
				'collapseAll'		=> TRUE,
				'expandSingle'		=> TRUE,
			),
			'minitems'			=> 0,
			'maxitems'			=> 999999,
		),
	),
	'tx_hypestore_domain_model_orders' => array (
		'exclude' => 1,
		'label' => "LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:fe_users.tx_hypestore_domain_model_orders",
		'config' => array (
			'type'				=> 'inline',
			'foreign_table'		=> 'tx_hypestore_domain_model_order',
			'foreign_field'		=> 'customer',
			//'foreign_label'		=> 'product',
			'appearance'		=> array(
				'collapseAll'		=> TRUE,
				'expandSingle'		=> TRUE,
			),
			'minitems'			=> 0,
			'maxitems'			=> 999999,
		),
	),
);

t3lib_div::loadTCA('fe_users');
t3lib_extMgm::addTCAcolumns('fe_users', $columns, 1);
t3lib_extMgm::addToAllTCAtypes('fe_users', '--div--;Store,tx_hypestore_domain_model_addresses,tx_hypestore_domain_model_orders,tx_hypestore_domain_model_cart_items,tx_hypestore_domain_model_watchlist_items');

//$TCA['fe_users']['ctrl']['label'] = 'name';
//$TCA['fe_users']['ctrl']['label_alt'] = 'username';
//$TCA['fe_users']['ctrl']['label_alt_force'] = TRUE;


# Web module list
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
	
	# Manufacturer
	$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['cms']['db_layout']['addTables']['tx_hypestore_domain_model_manufacturer'][0] = array(
		'fList' => 'title,city,website',
		'icon' => TRUE,
	);
}

?>