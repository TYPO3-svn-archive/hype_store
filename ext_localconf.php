<?php

if(!defined('TYPO3_MODE'))
	die('Access denied.');



# CONFIGURATION

# Extension
$configuration = unserialize($_EXTCONF);



# PLUGINS

# Category
Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'Category',
	array('Category' => 'index,list'),
	array('Category' => '')
);

# Product
Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'Product',
	array('Product' => 'index'),
	array('Product' => '')
);

# Cart
Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'Cart',
	array('Cart' => 'index,update,add,remove,move'),
	array('Cart' => 'index,update,add,remove,move')
);

# Checkout
Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'Checkout',
	array('Checkout' => 'index,validate'),
	array('Checkout' => 'index,validate')
);

# Watchlist
Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'Watchlist',
	array('Watchlist' => 'index,add,remove,move'),
	array('Watchlist' => 'index,add,remove,move')
);



# HOOKS

# Backend
if(TYPO3_MODE == 'BE') {

	# DB List
	$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['typo3/class.db_list_extra.inc']['getTable'][$_EXTKEY] = 'EXT:hype_store/Classes/Hook/class.tx_hypestore_db_list_extra.php:tx_hypestore_db_list_extra';

	# TCE Main
	$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][$_EXTKEY] = 'EXT:hype_store/Classes/Hook/class.tx_hypestore_tcemain.php:tx_hypestore_tcemain';
}

# Frontend
if(TYPO3_MODE == 'FE') {

	# RealUrl
	$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/realurl/class.tx_realurl_autoconfgen.php']['extensionConfiguration'][$_EXTKEY] = 'EXT:hype_store/Classes/Hook/class.tx_hypestore_realurl_autoconfgen.php:&tx_hypestore_realurl_autoconfgen->addRealURLConfig';
}



# XCLASS

# Backend
if(TYPO3_MODE == 'BE') {

	# TCE Forms
	$GLOBALS['TYPO3_CONF_VARS']['BE']['XCLASS']['t3lib/class.t3lib_tceforms.php'] = t3lib_extMgm::extPath($_EXTKEY) . '/Classes/XClass/class.tx_hypestore_t3lib_tceforms.php';

	# TCE Forms Inline
	$GLOBALS['TYPO3_CONF_VARS']['BE']['XCLASS']['t3lib/class.t3lib_tceforms_inline.php'] = t3lib_extMgm::extPath($_EXTKEY) . '/Classes/XClass/class.tx_hypestore_t3lib_tceforms_inline.php';
}

?>