<?php

if(!defined('TYPO3_MODE'))
	die('Access denied.');


# Category plugin
Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'Category',
	array('Category' => 'index,list'),
	array('Category' => '')
);

# Product plugin
Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'Product',
	array('Product' => 'index'),
	array('Product' => '')
);

# Cart plugin
Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'Cart',
	array('Cart' => 'index,update,add,remove,move'),
	array('Cart' => 'index,update,add,remove,move')
);

# Checkout plugin
Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'Checkout',
	array('Checkout' => 'index,validate'),
	array('Checkout' => 'index,validate')
);

# Watchlist plugin
Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'Watchlist',
	array('Watchlist' => 'index,add,remove,move'),
	array('Watchlist' => 'index,add,remove,move')
);

# Address plugin
Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'Address',
	array('Address' => 'index,create,edit,save,delete'),
	array('Address' => 'index,create,edit,save,delete')
);

t3lib_extMgm::addPageTSConfig('
	# ***************************************************************************************
	# CONFIGURATION of RTE in table "tx_hypestore_category", field "description"
	# ***************************************************************************************
	RTE.config.tx_hypestore_category.description {
		hidePStyleItems = H1, H4, H5, H6
		proc.exitHTMLparser_db = 1
		proc.exitHTMLparser_db {
			keepNonMatchedTags = 1
			tags.font.allowedAttribs = color
			tags.font.rmTagIfNoAttrib = 1
			tags.font.nesting = global
		}
	}
');

t3lib_extMgm::addPageTSConfig('
	# ***************************************************************************************
	# CONFIGURATION of RTE in table "tx_hypestore_product", field "description"
	# ***************************************************************************************
	RTE.config.tx_hypestore_product.description {
		hidePStyleItems = H1, H4, H5, H6
		proc.exitHTMLparser_db = 1
		proc.exitHTMLparser_db {
			keepNonMatchedTags = 1
			tags.font.allowedAttribs = color
			tags.font.rmTagIfNoAttrib = 1
			tags.font.nesting = global
		}
	}
');

?>