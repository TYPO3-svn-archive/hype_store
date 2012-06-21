<?php

if(!defined('TYPO3_MODE'))
	die('Access denied.');



require_once(t3lib_extMgm::extPath('hype_store') . 'Classes/Hook/class.tx_hypestore_tca_field.php');

# Category
$TCA['tx_hypestore_domain_model_category'] = array(
	'ctrl' => $TCA['tx_hypestore_domain_model_category']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid,l10n_parent,l10n_diffsource,hidden,starttime,endtime,fe_group,title,subtitle,introduction,description,images,parent_category,categories,products,discounts'
	),
	'feInterface' => $TCA['tx_hypestore_domain_model_category']['feInterface'],
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
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude'	=> 1,
			'label'		=> 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
			'config'	=> array(
				'type'	=> 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table'		=> 'tx_hypestore_domain_model_category',
				'foreign_table_where' => 'AND tx_hypestore_domain_model_category.pid=###CURRENT_PID### AND tx_hypestore_domain_model_category.sys_language_uid IN (-1,0)',
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
				'checkbox' => 0
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'label'	=> 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
			'config'	=> array(
				'type'	=> 'input',
				'size'	=> 8,
				'max'	=> 20,
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
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_category.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'required,trim',
			),
		),
		'subtitle' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_category.subtitle',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim',
			),
		),
		'introduction' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_category.introduction',
			'config' => array(
				'type' => 'text',
			),
		),
		'description' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_category.description',
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
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_category.images',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'file',
				'allowed' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
				'max_size' => $GLOBALS['TYPO3_CONF_VARS']['BE']['maxFileSize'],
				'uploadfolder' => 'uploads/hype/store/category/image/',
				'size' => 5,
				'autoSizeMax' => 10,
				'minitems' => 0,
				'maxitems' => 999999,
			),
		),
		'parent_category' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_category.parent_category',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'db',
				'prepend_tname' => FALSE,
				'allowed' => 'tx_hypestore_domain_model_category',
				'foreign_table' => 'tx_hypestore_domain_model_category',
				'MM' => 'tx_hypestore_relation_category_category',
				'MM_opposite_field' => 'categories',
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
		),
		'categories' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_category.categories',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'db',
				'prepend_tname' => FALSE,
				'allowed' => 'tx_hypestore_domain_model_category',
				'foreign_table' => 'tx_hypestore_domain_model_category',
				'MM' => 'tx_hypestore_relation_category_category',
				'size' => 5,
				'autoSizeMax' => 25,
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
		),
		'products' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_category.products',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'db',
				'prepend_tname' => FALSE,
				'allowed' => 'tx_hypestore_domain_model_product',
				'foreign_table' => 'tx_hypestore_domain_model_product',
				'MM' => 'tx_hypestore_relation_category_product',
				'MM_opposite_field' => 'categories',
				'size' => 5,
				'autoSizeMax' => 25,
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
		),
		'discounts' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_category.discounts',
			'config' => array(
				'type'						=> 'inline',
				'foreign_table'				=> 'tx_hypestore_domain_model_discount',
				'MM'						=> 'tx_hypestore_relation_discount_category',
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
		0 => array('showitem' => '
				--palette--;;general,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.title;title,
				--palette--;;title_addition,
				introduction,
				description;;;richtext:rte_transform[mode=ts_css|imgpath=uploads/hype/store/category/rte/],
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tab.media,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.images;images,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tab.relations,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.categories;categories,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.products;products,
			--div--;Discounts,
				discounts,
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
			'showitem' => 'title',
			'canNotCollapse' => TRUE,
		),
		'title_addition' => array(
			'showitem' => 'subtitle',
		),
		'images' => array(
			'showitem' => 'images',
			'canNotCollapse' => TRUE,
		),
		'categories' => array(
			'showitem' => 'parent_category, --linebreak--, categories',
			'canNotCollapse' => TRUE,
		),
		'products' => array(
			'showitem' => 'products',
			'canNotCollapse' => TRUE,
		),
		'access' => array(
			'showitem' => 'starttime, endtime, hidden, --linebreak--, fe_group, --linebreak--, editlock',
			'canNotCollapse' => TRUE,
		),
	),
);

# Product Type
$TCA['tx_hypestore_domain_model_product_type'] = array(
	'ctrl' => $TCA['tx_hypestore_domain_model_product_type']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid,l10n_parent,l10n_diffsource,hidden,starttime,endtime,fe_group,title,keyword,icon'
	),
	'feInterface' => $TCA['tx_hypestore_domain_model_product_type']['feInterface'],
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
				'max'		=> 20,
				'eval'	=> 'date',
				'default'	=> 0,
				'checkbox' => 0
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
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product_type.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'required,trim',
			),
		),
		'keyword' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product_type.keyword',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'required,trim',
			),
		),
		'icon' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product_type.icon',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'file',
				'allowed' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
				'max_size' => $GLOBALS['TYPO3_CONF_VARS']['BE']['maxFileSize'],
				'uploadfolder' => 'uploads/hype/store/product_type/image/',
				'size' => 1,
				'minitems' => 0,
				'maxitems' => 1,
				'show_thumbs' => TRUE,
			),
		),
		'attributes' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product_type.attributes',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_hypestore_domain_model_attribute',
				//'foreign_table_where' => 'AND tx_hypestore_domain_model_category.uid != ###THIS_UID###',
				'minitems' => 0,
				'maxitems' => 999999,
				'renderMode' => 'checkbox'
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
		0 => array('showitem' => '
			sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title;;;;1-1-1, keyword;;;;1-1-1, icon;;;;1-1-1,

			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tab.attributes,attributes;;;;1-1-1,
		'),
	),
	'palettes' => array(
		1 => array('showitem' => 'starttime, endtime, fe_group, editlock'),
	),
);

# Product
$TCA['tx_hypestore_domain_model_product'] = array(
	'ctrl' => $TCA['tx_hypestore_domain_model_product']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid,l10n_parent,l10n_diffsource,hidden,starttime,endtime,fe_group,title,subtitle,identifier,gtin,categories,introduction,description,images,files,list_price,flat_price,tax_scale,minimum_order_quantity,scaled_prices,discounts,attributes,related_products,stock_threshold,stock_unit,stocks,related_page,related_address,manufacturer,authors,publisher,editor,edition,tracks'
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
		'type' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product.type',
			'config' => array(
				'type' => 'select',
				'default' => 'basic',
				//'foreign_table' => 'tx_hypestore_domain_model_product_type',
				//'foreign_table_loadIcons' => TRUE,

				'items' => array(
					array('LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product.type.basic', 'basic',),
					array('LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product.type.apparel', 'apparel', 'EXT:hype_store/Configuration/TCA/Icons/Product/apparel.png'),
					array('LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product.type.furniture', 'furniture', 'EXT:hype_store/Configuration/TCA/Icons/Product/furniture.png'),
					array('LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product.type.book', 'book', 'EXT:hype_store/Configuration/TCA/Icons/Product/book.png'),
					array('LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product.type.audio_disc', 'audio_disc', 'EXT:hype_store/Configuration/TCA/Icons/Product/audio_disc.png'),
				),
			),
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

		/*
		'articles' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product.articles',
			'config' => array(
				'type'						=> 'inline',
				'foreign_table'				=> 'tx_hypestore_domain_model_product',
				'foreign_field'				=> 'product',
				'foreign_label'				=> 'identifier',
				'foreign_default_sortby'	=> 'identifier',
				'foreign_unique'			=> 'quantity',
				'appearance'				=> array(
					'collapseAll'				=> TRUE,
					'expandSingle'				=> TRUE,
				),
				'minitems'					=> 0,
				'maxitems'					=> 999999,
			),
		),
		*/

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
		'scaled_prices' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product.scaled_prices',
			'config' => array(
				'type'						=> 'inline',
				'foreign_table'				=> 'tx_hypestore_domain_model_product_price',
				'foreign_field'				=> 'product',
				'foreign_label'				=> 'value',
				'foreign_default_sortby'	=> 'value',
				'foreign_unique'			=> 'quantity',
				'appearance'				=> array(
					'collapseAll'				=> TRUE,
					'expandSingle'				=> TRUE,
				),
				'minitems'					=> 0,
				'maxitems'					=> 999999,
			),
			'displayCond' => 'FIELD:minimum_order_quantity:>=:1',
		),
		'attributes' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product.attributes',
			'config' => array(
				'type'						=> 'inline',
				'foreign_table'				=> 'tx_hypestore_domain_model_product_attribute',
				'foreign_field'				=> 'product',
				'foreign_label'				=> 'attribute',
				'foreign_default_sortby'	=> 'attribute',
				'foreign_unique'			=> 'attribute',
				'appearance'				=> array(
					'collapseAll'				=> TRUE,
					'expandSingle'				=> TRUE,
				),
				'minitems'					=> 0,
				'maxitems'					=> 999999,
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
						),
					),
				),
			),
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
		),
		'discounts' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product.discounts',
			'config' => array(
				'type'						=> 'inline',
				'foreign_table'				=> 'tx_hypestore_domain_model_discount',
				'MM'						=> 'tx_hypestore_relation_discount_product',
				'appearance'				=> array(
					'collapseAll'				=> TRUE,
					'expandSingle'				=> TRUE,
				),
				'minitems'					=> 0,
				'maxitems'					=> 999999,
			),
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
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.categories;categories,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.products;products,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.pages;pages,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tab.media,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.images;images,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.files;files,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tab.articles,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tab.prices,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.prices;prices,
				--palette--;;price_addition,
				scaled_prices,
				discounts,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tab.attributes,
				attributes,
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
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tab.articles,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tab.prices,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.prices;prices,
				--palette--;;price_addition,
				scaled_prices,
				discounts,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tab.attributes,
				attributes,
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
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tab.articles,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tab.prices,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.prices;prices,
				--palette--;;price_addition,
				scaled_prices,
				discounts,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tab.attributes,
				attributes,
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
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tab.articles,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tab.prices,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.prices;prices,
				--palette--;;price_addition,
				scaled_prices,
				discounts,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tab.attributes,
				attributes,
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
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.categories;categories,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.products;products,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.pages;pages,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tab.media,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.images;images,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.files;files,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tab.articles,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tab.prices,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.prices;prices,
				--palette--;;price_addition,
				scaled_prices,
				discounts,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tab.attributes,
				attributes,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tab.stocks,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.stocks;stocks,
				stocks,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tab.access,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.access;access,
		'),
	),
	'palettes' => array(
		'general' => array(
			'showitem' => 'type, sys_language_uid',
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
		'categories' => array(
			'showitem' => 'categories',
			'canNotCollapse' => TRUE,
		),
		'products' => array(
			'showitem' => 'related_products',
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

# Discount
$TCA['tx_hypestore_domain_model_discount'] = array(
	'ctrl' => $TCA['tx_hypestore_domain_model_discount']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid,l10n_parent,l10n_diffsource,hidden,starttime,endtime,fe_group,title,rate,included_categories,excluded_categories,included_products,excluded_products'
	),
	'feInterface' => $TCA['tx_hypestore_domain_model_discount']['feInterface'],
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
				'foreign_table'		=> 'tx_hypestore_domain_model_discount',
				'foreign_table_where' => 'AND tx_hypestore_domain_model_discount.pid=###CURRENT_PID### AND tx_hypestore_domain_model_discount.sys_language_uid IN (-1,0)',
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
				'max'		=> 20,
				'eval'	=> 'date',
				'default'	=> 0,
				'checkbox' => 0
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
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_discount.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'required,trim',
			),
		),
		'rate' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_discount.rate',
			'config' => array(
				'type' => 'input',
				'size' => 5,
				'max' => 3,
				'eval' => 'required,int',
				'range' => array('lower' => 1, 'upper' => 100),
			),
		),
		'included_categories' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_discount.included_categories',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'db',
				'prepend_tname' => FALSE,
				'allowed' => 'tx_hypestore_domain_model_category',
				'foreign_table' => 'tx_hypestore_domain_model_category',
				'MM' => 'tx_hypestore_relation_discount_category',
				'MM_opposite_field' => 'discounts',
				'MM_match_fields' => array(
					'exclude' => 0
				),
				'size' => 5,
				'autoSizeMax' => 25,
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

				/*
				'type' => 'select',
				'foreign_table' => 'tx_hypestore_domain_model_category',
				'MM' => 'tx_hypestore_relation_discount_category',
				'MM_opposite_field' => 'discounts',
				'MM_match_fields' => array(
					'exclude' => 0
				),
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
				*/
			),
		),
		'excluded_categories' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_discount.excluded_categories',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'db',
				'prepend_tname' => FALSE,
				'allowed' => 'tx_hypestore_domain_model_category',
				'foreign_table' => 'tx_hypestore_domain_model_category',
				'MM' => 'tx_hypestore_relation_discount_category',
				'MM_opposite_field' => 'discounts',
				'MM_match_fields' => array(
					'exclude' => 1
				),
				'size' => 5,
				'autoSizeMax' => 25,
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

				/*
				'type' => 'select',
				'foreign_table' => 'tx_hypestore_domain_model_category',
				'MM' => 'tx_hypestore_relation_discount_category',
				'MM_match_fields' => array(
					'exclude' => 1
				),
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
				*/
			),
		),
		'included_products' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_discount.included_products',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'db',
				'prepend_tname' => FALSE,
				'allowed' => 'tx_hypestore_domain_model_product',
				'foreign_table' => 'tx_hypestore_domain_model_product',
				'MM' => 'tx_hypestore_relation_discount_product',
				'MM_opposite_field' => 'discounts',
				'MM_match_fields' => array(
					'exclude' => 0
				),
				'size' => 5,
				'autoSizeMax' => 25,
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
		),
		'excluded_products' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_discount.excluded_products',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'db',
				'prepend_tname' => FALSE,
				'allowed' => 'tx_hypestore_domain_model_product',
				'foreign_table' => 'tx_hypestore_domain_model_product',
				'MM' => 'tx_hypestore_relation_discount_product',
				'MM_opposite_field' => 'discounts',
				'MM_match_fields' => array(
					'exclude' => 1
				),
				'size' => 5,
				'autoSizeMax' => 25,
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
		0 => array('showitem' => '
				title,
				rate,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tab.categories,
				included_categories,
				excluded_categories,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tab.products,
				included_products,
				excluded_products,
		'),
	),
	'palettes' => array(
		'general' => array(
			'showitem' => 'sys_language_uid',
			'canNotCollapse' => TRUE,
		),
	),
);

# Product Stock
$TCA['tx_hypestore_domain_model_product_stock'] = array(
	'ctrl' => $TCA['tx_hypestore_domain_model_product_stock']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'l10n_parent,l10n_diffsource,hidden,starttime,endtime,fe_group,depot,product,quantity'
	),
	'feInterface' => $TCA['tx_hypestore_domain_model_product_stock']['feInterface'],
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
				'foreign_table'		=> 'tx_hypestore_domain_model_product_stock',
				'foreign_table_where' => 'AND tx_hypestore_domain_model_product_stock.pid=###CURRENT_PID### AND tx_hypestore_domain_model_product_stock.sys_language_uid IN (-1,0)',
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
				'max'		=> 20,
				'eval'	=> 'date',
				'default'	=> 0,
				'checkbox' => 0
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
		'depot' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product_stock.depot',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'db',
				'prepend_tname' => FALSE,
				'allowed' => 'tx_hypedirectory_domain_model_contact',
				'foreign_table' => 'tx_hypedirectory_domain_model_contact',
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
		'product' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product_stock.product',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'db',
				'prepend_tname' => FALSE,
				'allowed' => 'tx_hypestore_domain_model_product',
				'foreign_table' => 'tx_hypestore_domain_model_product',
				'size' => 1,
				'minitems' => 1,
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
		),
		'quantity' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product_stock.quantity',
			'config' => array(
				'type' => 'input',
				'size' => 5,
				'eval' => 'required,int',
				'range' => array('lower' => 0),
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
		0 => array('showitem' => 'product, depot, quantity'),
	),
	'palettes' => array(
		1 => array('showitem' => 'starttime, endtime, fe_group, editlock'),
	),
);

# Attribute
$TCA['tx_hypestore_domain_model_attribute'] = array(
	'ctrl' => $TCA['tx_hypestore_domain_model_attribute']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid,l10n_parent,l10n_diffsource,hidden,starttime,endtime,fe_group,title,unit,type'
	),
	'feInterface' => $TCA['tx_hypestore_domain_model_attribute']['feInterface'],
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
				'foreign_table'		=> 'tx_hypestore_domain_model_attribute',
				'foreign_table_where' => 'AND tx_hypestore_domain_model_attribute.pid=###CURRENT_PID### AND tx_hypestore_domain_model_attribute.sys_language_uid IN (-1,0)',
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
				'max'		=> 20,
				'eval'	=> 'date',
				'default'	=> 0,
				'checkbox' => 0
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

		'type' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_attribute.type',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_attribute.type.basic', 'basic'),
					array('LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_attribute.type.set', 'set'),
					array('LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_attribute.type.custom', 'custom'),
				),
				'size' => 1,
				'maxitems' => 1,
			),
		),

		'title' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_attribute.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'required,trim',
			),
		),
		'unit' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_attribute.unit',
			'config' => array(
				'type' => 'input',
				'size' => 5,
				'eval' => 'trim',
			),
		),
		'items' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_attribute.items',
			'config' => array(
				'type' => 'text',
			),
		),
		'multiple' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_attribute.multiple',
			'config' => array(
				'type' => 'check',
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
		'0' => array('showitem' => '
				--palette--;;general,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.title;title,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.unit;unit,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tab.access,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.access;access,
		'),
		'basic' => array('showitem' => '
				--palette--;;general,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.title;title,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.unit;unit,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tab.access,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.access;access,
		'),
		'set' => array('showitem' => '
				--palette--;;general,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.title;title,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.unit;unit,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.items;items,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tab.access,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.access;access,
		'),
		'custom' => array('showitem' => '
				--palette--;;general,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.title;title,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.unit;unit,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tab.access,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.access;access,
		'),
	),
	'palettes' => array(
		'general' => array(
			'showitem' => 'type, sys_language_uid',
			'canNotCollapse' => TRUE,
		),
		'title' => array(
			'showitem' => 'title',
			'canNotCollapse' => TRUE,
		),
		'unit' => array(
			'showitem' => 'unit',
			'canNotCollapse' => TRUE,
		),
		'items' => array(
			'showitem' => 'items, multiple',
			'canNotCollapse' => TRUE,
		),
		'access' => array(
			'showitem' => 'starttime, endtime, hidden, --linebreak--, fe_group, --linebreak--, editlock',
			'canNotCollapse' => TRUE,
		),
	),
);

# Product Attribute
$TCA['tx_hypestore_domain_model_product_attribute'] = array(
	'ctrl' => $TCA['tx_hypestore_domain_model_product_attribute']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid,l10n_parent,l10n_diffsource,hidden,starttime,endtime,fe_group,product,attribute,value,items'
	),
	'feInterface' => $TCA['tx_hypestore_domain_model_product_attribute']['feInterface'],
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
				'foreign_table'		=> 'tx_hypestore_domain_model_product_attribute',
				'foreign_table_where' => 'AND tx_hypestore_domain_model_product_attribute.pid=###CURRENT_PID### AND tx_hypestore_domain_model_product_attribute.sys_language_uid IN (-1,0)',
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
				'max'		=> 20,
				'eval'	=> 'date',
				'default'	=> 0,
				'checkbox' => 0
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
		'product' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product_attribute.product',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_hypestore_domain_model_product',
				'foreign_table_where' => 'ORDER BY tx_hypestore_domain_model_product.title',
				'size' => 1,
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
		'attribute' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product_attribute.attribute',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_hypestore_domain_model_attribute',
				'foreign_table_where' => 'ORDER BY tx_hypestore_domain_model_attribute.uid',
				'size' => 1,
				'minitems' => 0,
				'maxitems' => 1,
				'suppress_icons' => 1,
			),
		),
		'value' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product_attribute.value',
			'config' => array(
				'type' => 'input',
				'size' => 5,
				'eval' => 'required,trim',
			),
			'displayCond' => 'RELATION:attribute.type:=:custom',
		),
		'items' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product_attribute.items',
			'config' => array(
				'type' => 'select',
				'renderMode' => 'checkbox',
				'maxitems' => 999,
				//'items' => array(),
				'itemsProcFunc' => 'tx_hypestore_tca_field->getSelectItems',
				'custom' => array(
					'table' => 'tx_hypestore_domain_model_attribute',
					'field' => 'attribute'
				),
			),
			'displayCond' => 'RELATION:attribute.type:=:set',
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
		0 => array('showitem' => '
			--palette--;;general
		'),
	),
	'palettes' => array(
		'general' => array(
			'showitem' => 'attribute, value, items',
			'canNotCollapse' => TRUE,
		),
	),
);

# Product Price
$TCA['tx_hypestore_domain_model_product_price'] = array(
	'ctrl' => $TCA['tx_hypestore_domain_model_product_price']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid,l10n_parent,l10n_diffsource,hidden,starttime,endtime,fe_group,product,quantity,value'
	),
	'feInterface' => $TCA['tx_hypestore_domain_model_product_price']['feInterface'],
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
				'foreign_table'		=> 'tx_hypestore_domain_model_product_price',
				'foreign_table_where' => 'AND tx_hypestore_domain_model_product_price.pid=###CURRENT_PID### AND tx_hypestore_domain_model_product_price.sys_language_uid IN (-1,0)',
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
				'max'		=> 20,
				'eval'	=> 'date',
				'default'	=> 0,
				'checkbox' => 0
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
		'product' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product_price.product',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_hypestore_domain_model_product',
				'foreign_table_where' => 'ORDER BY tx_hypestore_domain_model_product.title',
				'size' => 1,
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
		'quantity' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product_price.quantity',
			'config' => array(
				'type' => 'input',
				'size' => 5,
				'eval' => 'required,int',
				'range' => array('lower' => 2),
			),
		),
		'value' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product_price.value',
			'config' => array(
				'type' => 'input',
				'size' => 5,
				'eval' => 'required,double2',
				'range' => array('lower' => 0),
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
		0 => array('showitem' => '
			product,
			--palette--;;general,
		'),
	),
	'palettes' => array(
		'general' => array(
			'showitem' => 'quantity, value',
			'canNotCollapse' => TRUE,
		),
	),
);

# Product Track
$TCA['tx_hypestore_domain_model_product_track'] = array(
	'ctrl' => $TCA['tx_hypestore_domain_model_product_track']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'l10n_parent,l10n_diffsource,hidden,starttime,endtime,fe_group,product,number,title,length,sample'
	),
	'feInterface' => $TCA['tx_hypestore_domain_model_product_track']['feInterface'],
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
				'foreign_table'		=> 'tx_hypestore_domain_model_product_track',
				'foreign_table_where' => 'AND tx_hypestore_domain_model_product_track.pid=###CURRENT_PID### AND tx_hypestore_domain_model_product_track.sys_language_uid IN (-1,0)',
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
				'max'		=> 20,
				'eval'	=> 'date',
				'default'	=> 0,
				'checkbox' => 0
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
		'product' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product_track.product',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_hypestore_domain_model_product',
				'foreign_table_where' => 'ORDER BY tx_hypestore_domain_model_product.title',
				'size' => 1,
				'minitems' => 1,
				'maxitems' => 1,
			),
		),
		'number' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product_track.number',
			'config' => array(
				'type' => 'input',
				'size' => 5,
				'eval' => 'required,int',
				'range' => array('lower' => 1),
			),
		),
		'title' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product_track.title',
			'config' => array(
				'type' => 'input',
				'size' => 20,
				'eval' => 'required,trim',
			),
		),
		'length' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product_track.length',
			'config' => array(
				'type' => 'input',
				'size' => 5,
				'eval' => 'timesec',
				'range' => array('lower' => 1),
			),
		),
		'sample' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product_track.sample',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'file',
				'allowed' => 'mp3,ogg,wav,flac,wma,aac,m4p',
				'max_size' => $GLOBALS['TYPO3_CONF_VARS']['BE']['maxFileSize'],
				'uploadfolder' => 'uploads/hype/store/product/track/',
				'size' => 1,
				'autoSizeMax' => 25,
				'minitems' => 0,
				'maxitems' => 999999,
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
		0 => array('showitem' => '
				product,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.track;track,
				sample
		'),
	),
	'palettes' => array(
		'track' => array(
			'showitem' => 'number, title, length',
			'canNotCollapse' => TRUE,
		),
	),
);

# Tax Scale
$TCA['tx_hypestore_domain_model_tax_scale'] = array(
	'ctrl' => $TCA['tx_hypestore_domain_model_tax_scale']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid,l10n_parent,l10n_diffsource,hidden,starttime,endtime,fe_group,rate'
	),
	'feInterface' => $TCA['tx_hypestore_domain_model_tax_scale']['feInterface'],
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
				'foreign_table'		=> 'tx_hypestore_domain_model_tax_scale',
				'foreign_table_where' => 'AND tx_hypestore_domain_model_tax_scale.pid=###CURRENT_PID### AND tx_hypestore_domain_model_tax_scale.sys_language_uid IN (-1,0)',
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
				'max'		=> 20,
				'eval'	=> 'date',
				'default'	=> 0,
				'checkbox' => 0
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
		'rate' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_tax_scale.rate',
			'config' => array(
				'type' => 'input',
				'size' => 5,
				'eval' => 'required,double2',
				'range' => array('lower' => 0, 'upper' => 100),
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
		0 => array('showitem' => '
				--palette--;;general,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.rate;rate,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tab.access,
				--palette--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.palette.access;access,
		'),
	),
	'palettes' => array(
		'general' => array(
			'showitem' => 'sys_language_uid',
			'canNotCollapse' => TRUE,
		),
		'rate' => array(
			'showitem' => 'rate',
			'canNotCollapse' => TRUE,
		),
		'access' => array(
			'showitem' => 'starttime, endtime, hidden, --linebreak--, fe_group, --linebreak--, editlock',
			'canNotCollapse' => TRUE,
		),
	),
);

# Cart Item
$TCA['tx_hypestore_domain_model_cart_item'] = array(
	'ctrl' => $TCA['tx_hypestore_domain_model_cart_item']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid,l10n_parent,l10n_diffsource,hidden,starttime,endtime,fe_group,customer,product,quantity'
	),
	'feInterface' => $TCA['tx_hypestore_domain_model_cart_item']['feInterface'],
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
				'foreign_table'		=> 'tx_hypestore_domain_model_product_price',
				'foreign_table_where' => 'AND tx_hypestore_domain_model_product_price.pid=###CURRENT_PID### AND tx_hypestore_domain_model_product_price.sys_language_uid IN (-1,0)',
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
				'max'		=> 20,
				'eval'	=> 'date',
				'default'	=> 0,
				'checkbox' => 0
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
		'customer' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_cart_item.customer',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'db',
				'prepend_tname' => FALSE,
				'allowed' => 'fe_users',
				'foreign_table' => 'fe_users',
				'size' => 1,
				'maxitems' => 1,
				'minitems' => 1,
				'wizards' => array(
					'suggest' => array(
						'type' => 'suggest',
						'default' => array(
							'searchWholePhrase' => 1,
						),
					),
				),
			),
		),
		'product' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_cart_item.product',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'db',
				'prepend_tname' => FALSE,
				'allowed' => 'tx_hypestore_domain_model_product',
				'foreign_table' => 'tx_hypestore_domain_model_product',
				'size' => 1,
				'maxitems' => 1,
				'minitems' => 1,
				'wizards' => array(
					'suggest' => array(
						'type' => 'suggest',
						'default' => array(
							'searchWholePhrase' => 1,
						),
					),
				),
			),
		),
		'quantity' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_cart_item.quantity',
			'config' => array(
				'type' => 'input',
				'size' => 5,
				'eval' => 'required,int',
				'range' => array('lower' => 0),
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
		0 => array('showitem' => '
			--palette--;;general,
		'),
	),
	'palettes' => array(
		'general' => array(
			'showitem' => 'product, --linebreak--, quantity',
			'canNotCollapse' => TRUE,
		),
	),
);

# Watchlist Item
$TCA['tx_hypestore_domain_model_watchlist_item'] = array(
	'ctrl' => $TCA['tx_hypestore_domain_model_watchlist_item']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid,l10n_parent,l10n_diffsource,hidden,starttime,endtime,fe_group,customer,product'
	),
	'feInterface' => $TCA['tx_hypestore_domain_model_watchlist_item']['feInterface'],
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
				'foreign_table'		=> 'tx_hypestore_domain_model_product_price',
				'foreign_table_where' => 'AND tx_hypestore_domain_model_product_price.pid=###CURRENT_PID### AND tx_hypestore_domain_model_product_price.sys_language_uid IN (-1,0)',
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
				'max'		=> 20,
				'eval'	=> 'date',
				'default'	=> 0,
				'checkbox' => 0
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
		'customer' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_watchlist_item.customer',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'db',
				'prepend_tname' => FALSE,
				'allowed' => 'fe_users',
				'foreign_table' => 'fe_users',
				'size' => 1,
				'maxitems' => 1,
				'minitems' => 1,
				'wizards' => array(
					'suggest' => array(
						'type' => 'suggest',
						'default' => array(
							'searchWholePhrase' => 1,
						),
					),
				),
			),
		),
		'product' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_watchlist_item.product',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'db',
				'prepend_tname' => FALSE,
				'allowed' => 'tx_hypestore_domain_model_product',
				'foreign_table' => 'tx_hypestore_domain_model_product',
				'size' => 1,
				'maxitems' => 1,
				'minitems' => 1,
				'wizards' => array(
					'suggest' => array(
						'type' => 'suggest',
						'default' => array(
							'searchWholePhrase' => 1,
						),
					),
				),
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
		0 => array('showitem' => '
			--palette--;;general,
		'),
	),
	'palettes' => array(
		'general' => array(
			'showitem' => 'product',
			'canNotCollapse' => TRUE,
		),
	),
);

# Purchase
$TCA['tx_hypestore_domain_model_purchase'] = array(
	'ctrl' => $TCA['tx_hypestore_domain_model_purchase']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid,l10n_parent,l10n_diffsource,hidden,starttime,endtime,fe_group,customer,items'
	),
	'feInterface' => $TCA['tx_hypestore_domain_model_purchase']['feInterface'],
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
				'foreign_table'		=> 'tx_hypestore_domain_model_purchase',
				'foreign_table_where' => 'AND tx_hypestore_domain_model_purchase.pid=###CURRENT_PID### AND tx_hypestore_domain_model_purchase.sys_language_uid IN (-1,0)',
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
				'max'		=> 20,
				'eval'	=> 'date',
				'default'	=> 0,
				'checkbox' => 0
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
		'customer' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_purchase.customer',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'db',
				'prepend_tname' => FALSE,
				'allowed' => 'fe_users',
				'foreign_table' => 'fe_users',
				'size' => 1,
				'maxitems' => 1,
				'minitems' => 1,
				'wizards' => array(
					'suggest' => array(
						'type' => 'suggest',
						'default' => array(
							'searchWholePhrase' => 1,
						),
					),
				),
			),
		),
		'items' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_purchase.items',
			'config' => array(
				'type'						=> 'inline',
				'foreign_table'				=> 'tx_hypestore_domain_model_purchase_item',
				'foreign_field'				=> 'purchase',
				'foreign_unique'			=> 'product',
				'appearance'				=> array(
					'collapseAll'				=> TRUE,
					'expandSingle'				=> TRUE,
				),
				'minitems'					=> 1,
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
		0 => array('showitem' => '
			customer,
			items
		'),
	),
);

# Purchase Item
$TCA['tx_hypestore_domain_model_purchase_item'] = array(
	'ctrl' => $TCA['tx_hypestore_domain_model_purchase_item']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid,l10n_parent,l10n_diffsource,hidden,starttime,endtime,fe_group,purchase,product,quantity'
	),
	'feInterface' => $TCA['tx_hypestore_domain_model_purchase_item']['feInterface'],
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
				'foreign_table'		=> 'tx_hypestore_domain_model_purchase_item',
				'foreign_table_where' => 'AND tx_hypestore_domain_model_purchase_item.pid=###CURRENT_PID### AND tx_hypestore_domain_model_purchase_item.sys_language_uid IN (-1,0)',
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
				'max'		=> 20,
				'eval'	=> 'date',
				'default'	=> 0,
				'checkbox' => 0
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
		'purchase' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_purchase_item.purchase',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'db',
				'prepend_tname' => FALSE,
				'allowed' => 'tx_hypestore_domain_model_purchase',
				'foreign_table' => 'tx_hypestore_domain_model_purchase',
				'size' => 1,
				'maxitems' => 1,
				'minitems' => 1,
				'wizards' => array(
					'suggest' => array(
						'type' => 'suggest',
						'default' => array(
							'searchWholePhrase' => 1,
						),
					),
				),
			),
		),
		'product' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_purchase_item.product',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'db',
				'prepend_tname' => FALSE,
				'allowed' => 'tx_hypestore_domain_model_product',
				'foreign_table' => 'tx_hypestore_domain_model_product',
				'size' => 1,
				'maxitems' => 1,
				'minitems' => 1,
				'wizards' => array(
					'suggest' => array(
						'type' => 'suggest',
						'default' => array(
							'searchWholePhrase' => 1,
						),
					),
				),
			),
		),
		'quantity' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_purchase_item.quantity',
			'config' => array(
				'type' => 'input',
				'size' => 5,
				'eval' => 'required,int',
				'range' => array('lower' => 1),
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
		0 => array('showitem' => '
			--palette--;;general,
		'),
	),
	'palettes' => array(
		'general' => array(
			'showitem' => 'product, --linebreak--, quantity',
			'canNotCollapse' => TRUE,
		),
	),
);
?>