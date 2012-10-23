<?php

# Product
$TCA['tx_hypestore_domain_model_product'] = array(
	'ctrl' => $TCA['tx_hypestore_domain_model_product']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => '
			sys_language_uid,l10n_parent,l10n_diffsource,hidden,starttime,endtime,fe_group,
			title,subtitle,identifier,gtin,categories,introduction,description,images,files,
			list_price,flat_price,tax_scale,minimum_order_quantity, related_products,
			stock_threshold,stock_unit,stocks,related_page, related_address,manufacturer,
			authors,publisher,editor,edition,tracks'
	),
	'feInterface' => $TCA['tx_hypestore_domain_model_product']['feInterface'],
	'columns' => array(
		'pid' => array(
			'type' => 'passthrough'
		),
		'deleted' => array(
			'type' => 'passthrough'
		),
		'sorting' => array(
			'type' => 'passthrough'
		),
		'tstamp' => array(
			'type' => 'passthrough'
		),
		'crdate' => array(
			'type' => 'passthrough'
		),
		'cruser_id' => array(
			'type' => 'select',
			'foreign_table' => 'be_users',
		),

		'sys_language_uid' => array(
			'exclude' => 1,
			'label'	=> 'LLL:EXT:lang/locallang_general.xml:LGL.language',
			'config' => array(
				'type'				=> 'select',
				'foreign_table'		=> 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0),
				),
			),
			'displayCond' => 'PARENT',
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude'	=> 1,
			'label'		=> 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
			'config'		=> array(
				'type'	=> 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table'		=> 'tx_hypestore_domain_model_product',
				'foreign_table_where' => 'AND tx_hypestore_domain_model_product.pid=###CURRENT_PID### AND tx_hypestore_domain_model_product.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
		'hidden' => array(
			'exclude' => 1,
			'label'	=> 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'	=> array(
				'type'	=> 'check',
				'default' => 0
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'label'	=> 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
			'config'	=> array(
				'type'	=> 'input',
				'size'	=> 8,
				'max'	=> 20,
				'eval'	=> 'date',
				'default'	=> 0,
				'checkbox'	=> 0,
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'label'	=> 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
			'config'	=> array(
				'type'	=> 'input',
				'size'	=> 8,
				'max'		=> 20,
				'eval'	=> 'date',
				'checkbox' => 0,
				'default'	=> 0,
				'range'	=> array(
					'upper' => mktime(3, 14, 7, 1, 19, 2038),
					'lower' => mktime(0, 0, 0, date('m')-1, date('d'), date('Y')),
				),
			),
		),
		'fe_group' => array(
			'exclude' => 1,
			'label'	=> 'LLL:EXT:lang/locallang_general.xml:LGL.fe_group',
			'config'	=> array(
				'type'	=> 'select',
				'size' => 5,
				'maxitems' => 99,
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xml:LGL.hide_at_login', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.any_login', -2),
					array('LLL:EXT:lang/locallang_general.xml:LGL.usergroups', '--div--'),
				),
				'foreign_table' => 'fe_groups'
			),
		),

		'title' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product.title',
			'config' => array(
				'type' => 'input',
				'size' => 28,
				'eval' => 'required,trim',
			),
		),
		'subtitle' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product.subtitle',
			'config' => array(
				'type' => 'input',
				'size' => 28,
				'eval' => 'trim',
			),
		),
		'identifier' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product.identifier',
			'config' => array(
				'type' => 'input',
				'size' => 12,
				'eval' => 'required,trim',
			),
			'displayCond' => 'FIELD:articles:REQ:false',
		),
		'gtin' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product.gtin',
			'config' => array(
				'type' => 'input',
				'size' => 12,
				'max' => 14,
				'eval' => 'num,nospace,unique,trim',
			),
			'displayCond' => 'FIELD:articles:REQ:false',
		),
		'categories' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product.categories',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_hypestore_domain_model_category',
				'MM' => 'tx_hypestore_relation_category_product',
				'minitems' => 0,
				'maxitems' => 999999,

				'renderMode' => 'tree',
				'treeConfig' => array(
					'parentField' => 'parent_category',
					'appearance' => array(
						'expandAll' => TRUE,
						'showHeader' => TRUE
					),
				),
			),
		),
		'introduction' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product.introduction',
			'config' => array(
				'type' => 'text',
			),
		),
		'description' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product.description',
			'config' => array(
				'type' => 'text',
				'cols' => 30,
				'rows' => 5,
				'wizards' => array(
					'_PADDING' => 2,
					'RTE' => array(
						'notNewRecords' => 1,
						'RTEonly'		=> 1,
						'type'			=> 'script',
						'title'			=> 'LLL:EXT:cms/locallang_ttc.xml:bodytext.W.RTE',
						'icon'			=> 'wizard_rte2.gif',
						'script'		=> 'wizard_rte.php',
					),
				),
			),
		),
		'images' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product.images',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'file',
				'allowed' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
				'max_size' => $GLOBALS['TYPO3_CONF_VARS']['BE']['maxFileSize'],
				'uploadfolder' => 'uploads/hype/store/product/image/',
				'size' => 5,
				'autoSizeMax' => 10,
				'minitems' => 0,
				'maxitems' => 999999,
				'show_thumbs' => TRUE,
			),
		),
		'files' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product.files',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'file',
				'allowed' => '*',
				'disallowed' => 'php,php3',
				'max_size' => $GLOBALS['TYPO3_CONF_VARS']['BE']['maxFileSize'],
				'uploadfolder' => 'uploads/hype/store/product/file/',
				'size' => 5,
				'autoSizeMax' => 10,
				'minitems' => 0,
				'maxitems' => 999999,
			),
		),
		'minimum_order_quantity' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product.minimum_order_quantity',
			'config' => array(
				'type' => 'input',
				'size' => 5,
				'eval' => 'int',
				'default' => 1,
				'range' => array('lower' => 0),
			),
		),
		'flat_price' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product.flat_price',
			'config' => array(
				'type' => 'input',
				'size' => 5,
				'eval' => 'double2',
				'range' => array('lower' => 0),
			),
		),
		'list_price' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product.list_price',
			'config' => array(
				'type' => 'input',
				'size' => 5,
				'eval' => 'double2',
				'range' => array('lower' => 0),
			),
		),
		'tax_scale' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product.tax_scale',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_hypestore_domain_model_tax_scale',
				'size' => 1,
				'minitems' => 1,
				'maxitems' => 1,
				'items' => array(
					array('', NULL),
				),
				'suppress_icons' => 1,
			),
		),
		'related_products' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product.related_products',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'db',
				'prepend_tname' => FALSE,
				'allowed' => 'tx_hypestore_domain_model_product',
				'foreign_table' => 'tx_hypestore_domain_model_product',
				'MM' => 'tx_hypestore_relation_product_product',
				'size' => 5,
				'autoSizeMax' => 25,
				'minitems' => 0,
				'maxitems' => 999999,
				'wizards' => array(
					'suggest' => array(
						'type' => 'suggest',
						'default' => array(
							'searchWholePhrase' => 1,
							'searchCondition' => 'product=\'\'',
						),
					),
				),
			),
			'displayCond' => 'PARENT',
		),
		'stock_threshold' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product.stock_threshold',
			'config' => array(
				'type' => 'input',
				'size' => 5,
				'eval' => 'int',
				'range' => array('lower' => 0),
			),
		),
		'stock_unit' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product.stock_unit',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('Menge: Stück', 0),
					array('Menge: Laufmeter', 1),
					array('Masse: Kilogramm', 2),
					array('Volumen: Liter', 3),
				),
				'size' => 1,
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
		'stocks' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product.stocks',
			'config' => array(
				'type'						=> 'inline',
				'foreign_table'				=> 'tx_hypestore_domain_model_product_stock',
				'foreign_field'				=> 'product',
				'foreign_label'				=> 'depot',
				'foreign_default_sortby'	=> 'depot',
				'foreign_unique'			=> 'depot',
				'appearance'				=> array(
					'collapseAll'				=> TRUE,
					'expandSingle'				=> TRUE,
				),
				'minitems'					=> 0,
				'maxitems'					=> 999999,
			),
			'displayCond' => 'FIELD:articles:REQ:false',
		),
		'related_page' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product.related_page',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'db',
				'prepend_tname' => FALSE,
				'allowed' => 'pages',
				'foreign_table' => 'pages',
				'size' => 1,
				'maxitems' => 1,
				'wizards' => array(
					'suggest' => array(
						'type' => 'suggest',
						'default' => array(
							'searchWholePhrase' => 1,
						),
					),
				),
			),
			'displayCond' => 'PARENT',
		),
		'related_address' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product.related_address',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim',
				'wizards' => array(
					'link' => array(
						'type' => 'popup',
						'title' => 'Related address',
						'icon' => 'link_popup.gif',
						'script' => 'browse_links.php?mode=wizard&act=url',
						'JSopenParams' => 'height=320,width=800,status=0,menubar=0,scrollbars=1'
					),
				),
			),
			'displayCond' => 'PARENT',
		),

		# General
		'manufacturer' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product.manufacturer',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'db',
				'prepend_tname' => FALSE,
				'allowed' => 'tx_hypedirectory_domain_model_contact',
				'foreign_table' => 'tx_hypedirectory_domain_model_contact',
				'MM' => 'tx_hypestore_relation_product_contact',
				'MM_match_fields' => array('dedication' => 'manufacturer'),
				'size' => 1,
				'minitems' => 0,
				'maxitems' => 1,
				'wizards' => array(
					'suggest' => array(
						'type' => 'suggest',
						'default' => array(
							'searchWholePhrase' => 1,
						),
					),
				),
			),
			'displayCond' => 'EXT:hype_directory:LOADED:true',
		),

		# Book
		'isbn10_number' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product.isbn10_number',
			'config' => array(
				'type' => 'input',
				'size' => 8,
				'max' => 10,
				'eval' => 'num,nospace,unique,trim',
			),
		),
		'isbn13_number' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product.isbn13_number',
			'config' => array(
				'type' => 'input',
				'size' => 8,
				'max' => 13,
				'eval' => 'num,nospace,unique,trim',
			),
		),
		'authors' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product.authors',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'db',
				'prepend_tname' => FALSE,
				'allowed' => 'tx_hypedirectory_domain_model_contact',
				'foreign_table' => 'tx_hypedirectory_domain_model_contact',
				'MM' => 'tx_hypestore_relation_product_contact',
				'MM_match_fields' => array('dedication' => 'author'),
				'size' => 3,
				'autoSizeMax' => 5,
				'minitems' => 0,
				'maxitems' => 999999,
				'wizards' => array(
					'suggest' => array(
						'type' => 'suggest',
						'default' => array(
							'searchWholePhrase' => 1,
						),
					),
				),
			),
			'displayCond' => 'EXT:hype_directory:LOADED:true',
		),
		'publisher' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product.publisher',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'db',
				'prepend_tname' => FALSE,
				'allowed' => 'tx_hypedirectory_domain_model_contact',
				'foreign_table' => 'tx_hypedirectory_domain_model_contact',
				'MM' => 'tx_hypestore_relation_product_contact',
				'MM_match_fields' => array('dedication' => 'publisher'),
				'size' => 1,
				'minitems' => 0,
				'maxitems' => 1,
				'wizards' => array(
					'suggest' => array(
						'type' => 'suggest',
						'default' => array(
							'searchWholePhrase' => 1,
						),
					),
				),
			),
			'displayCond' => 'EXT:hype_directory:LOADED:true',
		),
		'publication_year' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product.publication_year',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'max' => 4,
				'eval' => 'num,nospace,trim',
			),
		),
		'editor' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product.editor',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'db',
				'prepend_tname' => FALSE,
				'allowed' => 'tx_hypedirectory_domain_model_contact',
				'foreign_table' => 'tx_hypedirectory_domain_model_contact',
				'MM' => 'tx_hypestore_relation_product_contact',
				'MM_match_fields' => array('dedication' => 'editor'),
				'size' => 1,
				'minitems' => 0,
				'maxitems' => 1,
				'wizards' => array(
					'suggest' => array(
						'type' => 'suggest',
						'default' => array(
							'searchWholePhrase' => 1,
						),
					),
				),
			),
			'displayCond' => 'EXT:hype_directory:LOADED:true',
		),
		'edition' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product.edition',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'num,nospace,trim',
			),
		),

		# Audio Disc
		'artist' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product.artist',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'db',
				'prepend_tname' => FALSE,
				'allowed' => 'tx_hypedirectory_domain_model_contact',
				'foreign_table' => 'tx_hypedirectory_domain_model_contact',
				'MM' => 'tx_hypestore_relation_product_contact',
				'MM_match_fields' => array('dedication' => 'artist'),
				'size' => 1,
				'minitems' => 0,
				'maxitems' => 1,
				'wizards' => array(
					'suggest' => array(
						'type' => 'suggest',
						'default' => array(
							'searchWholePhrase' => 1,
						),
					),
				),
			),
			'displayCond' => 'EXT:hype_directory:LOADED:true',
		),
		'tracks' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product.tracks',
			'config' => array(
				'type'						=> 'inline',
				'foreign_table'				=> 'tx_hypestore_domain_model_product_track',
				'foreign_field'				=> 'product',
				'appearance'				=> array(
					'collapseAll'				=> TRUE,
					'expandSingle'				=> TRUE,
				),
				'minitems'					=> 0,
				'maxitems'					=> 999999,
			),
		),
		'editlock' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_tca.xml:editlock',
			'config' => array(
				'type' => 'check'
			),
		),
	),
	'types' => array(
		'basic' => array('showitem' => '
				--palette--;;general,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.title;title,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.identification;identification,
				introduction,
				description;;;richtext:rte_transform[mode=ts_css|imgpath=uploads/hype/store/product/rte/],
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tab.relations,
				categories,
				related_products,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.pages;pages,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tab.media,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.images;images,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.files;files,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tab.prices,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.prices;prices,
				--palette--;;price_addition,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tab.stocks,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.stocks;stocks,
				stocks,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tab.access,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.access;access,
		'),
		'apparel' => array('showitem' => '
				--palette--;;general,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.title;title,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.identification;identification,
				introduction,
				description;;;richtext:rte_transform[mode=ts_css|imgpath=uploads/hype/store/product/rte/],
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tab.details,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.manufacturer;manufacturer,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tab.relations,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.categories;categories,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.products;products,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.pages;pages,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tab.media,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.images;images,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.files;files,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tab.prices,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.prices;prices,
				--palette--;;price_addition,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tab.stocks,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.stocks;stocks,
				stocks,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tab.access,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.access;access,
		'),
		'furniture' => array('showitem' => '
				--palette--;;general,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.title;title,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.identification;identification,
				introduction,
				description;;;richtext:rte_transform[mode=ts_css|imgpath=uploads/hype/store/product/rte/],
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tab.details,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.manufacturer;manufacturer,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tab.relations,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.categories;categories,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.products;products,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.pages;pages,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tab.media,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.images;images,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.files;files,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tab.prices,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.prices;prices,
				--palette--;;price_addition,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tab.stocks,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.stocks;stocks,
				stocks,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tab.access,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.access;access,
		'),
		'book' => array('showitem' => '
				--palette--;;general,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.title;title,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.identification;identification,
				introduction,
				description;;;richtext:rte_transform[mode=ts_css|imgpath=uploads/hype/store/product/rte/],
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tab.details,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.isbn;isbn,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.authors;authors,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.publication;publication,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.edition;edition,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tab.relations,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.categories;categories,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.products;products,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.pages;pages,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tab.media,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.images;images,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.files;files,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tab.prices,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.prices;prices,
				--palette--;;price_addition,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tab.stocks,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.stocks;stocks,
				stocks,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tab.access,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.access;access,
		'),
		'audio_disc' => array('showitem' => '
				--palette--;;general,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.title;title,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.identification;identification,
				introduction,
				description;;;richtext:rte_transform[mode=ts_css|imgpath=uploads/hype/store/product/rte/],
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tab.details,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.artist;artist,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.publication;publication,
				tracks,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tab.relations,
				categories,
				related_products,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.pages;pages,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tab.media,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.images;images,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.files;files,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tab.prices,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.prices;prices,
				--palette--;;price_addition,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tab.stocks,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.stocks;stocks,
				stocks,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tab.access,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.access;access,
		'),
	),
	'palettes' => array(
		'general' => array(
			'showitem' => 'sys_language_uid',
			'canNotCollapse' => TRUE,
		),
		'title' => array(
			'showitem' => 'title, --linebreak--, subtitle',
			'canNotCollapse' => TRUE,
		),
		'identification' => array(
			'showitem' => 'identifier, gtin',
			'canNotCollapse' => TRUE,
		),
		'pages' => array(
			'showitem' => 'related_page, --linebreak--, related_address',
			'canNotCollapse' => TRUE,
		),
		'images' => array(
			'showitem' => 'images',
			'canNotCollapse' => TRUE,
		),
		'files' => array(
			'showitem' => 'files',
			'canNotCollapse' => TRUE,
		),
		'prices' => array(
			'showitem' => 'flat_price, tax_scale',
			'canNotCollapse' => TRUE,
		),
		'price_addition' => array(
			'showitem' => 'list_price, minimum_order_quantity',
		),
		'stocks' => array(
			'showitem' => 'stock_threshold, stock_unit',
			'canNotCollapse' => TRUE,
		),
		'manufacturer' => array(
			'showitem' => 'manufacturer',
			'canNotCollapse' => TRUE,
		),
		'artist' => array(
			'showitem' => 'artist',
			'canNotCollapse' => TRUE,
		),
		'publication' => array(
			'showitem' => 'publisher, --linebreak--, publication_year',
			'canNotCollapse' => TRUE,
		),
		'edition' => array(
			'showitem' => 'editor, --linebreak--, edition',
			'canNotCollapse' => TRUE,
		),
		'authors' => array(
			'showitem' => 'authors',
			'canNotCollapse' => TRUE,
		),
		'isbn' => array(
			'showitem' => 'isbn13_number, isbn10_number',
			'canNotCollapse' => TRUE,
		),
		'access' => array(
			'showitem' => 'starttime, endtime, hidden, --linebreak--, fe_group, --linebreak--, editlock',
			'canNotCollapse' => TRUE,
		),
	),
);

?>