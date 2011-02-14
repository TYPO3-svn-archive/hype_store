<?php

if(!defined('TYPO3_MODE'))
	die('Access denied.');



require_once(t3lib_extMgm::extPath('hype_store') . 'Classes/Hook/class.tx_hypestore_tca_field.php');

# Category
$TCA['tx_hypestore_domain_model_category'] = array(
	'ctrl' => $TCA['tx_hypestore_domain_model_category']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid,l10n_parent,l10n_diffsource,hidden,starttime,endtime,fe_group,title,subtitle,introduction,description,images,parent_category,categories,products'
	),
	'feInterface' => $TCA['tx_hypestore_domain_model_category']['feInterface'],
	'columns' => array(
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
				'default' => '0'
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'label'	=> 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
			'config'	=> array(
				'type'	=> 'input',
				'size'	=> '8',
				'max'	=> '20',
				'eval'	=> 'date',
				'default'	=> '0',
				'checkbox' => '0'
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'label'	=> 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
			'config'	=> array(
				'type'	=> 'input',
				'size'	=> '8',
				'max'	=> '20',
				'eval'	=> 'date',
				'checkbox' => '0',
				'default'	=> '0',
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
				'items' => array(
					array('', 0),
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
				'size' => '30',
				'eval' => 'required,trim',
			),
		),
		'subtitle' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_category.subtitle',
			'config' => array(
				'type' => 'input',
				'size' => '30',
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
				'cols' => '30',
				'rows' => '5',
				'wizards' => array(
					'_PADDING' => 2,
					'RTE' => array(
						'notNewRecords' => 1,
						'RTEonly'		=> 1,
						'type'			=> 'script',
						'title'		=> 'Full screen Rich Text Editing|Formatteret redigering i hele vinduet',
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
				'uploadfolder' => 'uploads/hype/store/category/images',
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
				'type' => 'select',
				'foreign_table' => 'tx_hypestore_domain_model_category',
				//'foreign_table_where' => 'AND tx_hypestore_domain_model_category.uid != ###THIS_UID###',
				'size' => 1,
				'minitems' => 0,
				'maxitems' => 1,
				'MM' => 'tx_hypestore_relation_category_category',
				'MM_opposite_field' => 'categories',

				//'form_type' => 'user',
				//'userFunc' => 'tx_hypestore_tca_field->categories',
				//'user_type' => 'tree',
				//'indent_sign' => ' ',

				'allowed' => 'tx_hypestore_domain_model_category',

				'items' => array(
					array('', 0),
				),
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
				'type' => 'select',
				'foreign_table' => 'tx_hypestore_domain_model_category',
				//'foreign_table_where' => 'AND tx_hypestore_domain_model_category.uid != ###THIS_UID###',
				'size' => 15,
				'autoSizeMax' => 25,
				'minitems' => 0,
				'maxitems' => 999999,
				'MM' => 'tx_hypestore_relation_category_category',

				'form_type' => 'user',
				'userFunc' => 'tx_hypestore_tca_field->categories',
				'user_type' => 'tree',
				'indent_sign' => ' ',

				'allowed' => 'tx_hypestore_domain_model_category',
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
				'type' => 'select',
				'foreign_table' => 'tx_hypestore_domain_model_product',
				'foreign_table_where' => 'ORDER BY tx_hypestore_domain_model_product.title',
				'size' => 15,
				'autoSizeMax' => 25,
				'minitems' => 0,
				'maxitems' => 999999,
				'MM' => 'tx_hypestore_relation_category_product',
				'MM_opposite_field' => 'categories',

				'allowed' => 'tx_hypestore_domain_model_product',
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
	),
	'types' => array(
		'0' => array('showitem' => '
			sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title;;2;;1-1-1, introduction;;;;1-1-1, description;;;richtext[]:rte_transform[mode=ts_css|imgpath=uploads/tx_hypestore/rte/];3-3-3,

			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tabs.media,			images,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tabs.relations,		parent_category, categories, products;;;;1-1-1
		'),
	),
	'palettes' => array(
		'1' => array('showitem' => 'starttime, endtime, fe_group'),
		'2' => array('showitem' => 'subtitle'),
	),
);

# Product type
$TCA['tx_hypestore_domain_model_product_type'] = array(
	'ctrl' => $TCA['tx_hypestore_domain_model_product_type']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid,l10n_parent,l10n_diffsource,hidden,starttime,endtime,fe_group,title,keyword,icon'
	),
	'feInterface' => $TCA['tx_hypestore_domain_model_product_type']['feInterface'],
	'columns' => array(
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
				'default' => '0'
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'label'	=> 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
			'config'	=> array(
				'type'	=> 'input',
				'size'	=> '8',
				'max'		=> '20',
				'eval'	=> 'date',
				'default'	=> '0',
				'checkbox' => '0'
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'label'	=> 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
			'config'	=> array(
				'type'	=> 'input',
				'size'	=> '8',
				'max'		=> '20',
				'eval'	=> 'date',
				'checkbox' => '0',
				'default'	=> '0',
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
				'items' => array(
					array('', 0),
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
				'size' => '30',
				'eval' => 'required,trim',
			),
		),
		'keyword' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product_type.keyword',
			'config' => array(
				'type' => 'input',
				'size' => '30',
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
				'uploadfolder' => 'uploads/hype/store/product_type/images',
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
	),
	'types' => array(
		'0' => array('showitem' => '
			sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title;;;;1-1-1, keyword;;;;1-1-1, icon;;;;1-1-1,

			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tabs.attributes,attributes;;;;1-1-1,
		'),
	),
	'palettes' => array(
		'1' => array('showitem' => 'starttime, endtime, fe_group'),
	),
);

# Product
$TCA['tx_hypestore_domain_model_product'] = array(
	'ctrl' => $TCA['tx_hypestore_domain_model_product']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid,l10n_parent,l10n_diffsource,hidden,starttime,endtime,fe_group,title,subtitle,identifier,gtin,categories,introduction,description,images,files,list_price,flat_price,tax_scale,minimum_order_quantity,scaled_prices,attributes,related_products,stock_threshold,stock_unit,stocks,related_page,related_address,manufacturer,authors,publisher,editor,edition'
	),
	'feInterface' => $TCA['tx_hypestore_domain_model_product']['feInterface'],
	'columns' => array(
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
				'default' => '0'
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'label'	=> 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
			'config'	=> array(
				'type'	=> 'input',
				'size'	=> '8',
				'max'		=> '20',
				'eval'	=> 'date',
				'default'	=> '0',
				'checkbox' => '0'
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'label'	=> 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
			'config'	=> array(
				'type'	=> 'input',
				'size'	=> '8',
				'max'		=> '20',
				'eval'	=> 'date',
				'checkbox' => '0',
				'default'	=> '0',
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
				'items' => array(
					array('', 0),
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
				'size' => '30',
				'eval' => 'required,trim',
			),
		),
		'subtitle' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product.subtitle',
			'config' => array(
				'type' => 'input',
				'size' => '30',
				'eval' => 'trim',
			),
		),
		'identifier' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product.identifier',
			'config' => array(
				'type' => 'input',
				'size' => '10',
				'eval' => 'required,trim',
			),
			'displayCond' => 'FIELD:articles:REQ:false',
		),
		'gtin' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product.gtin',
			'config' => array(
				'type' => 'input',
				'size' => '10',
				'max' => '14',
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
				),
			),
		),
		'categories' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product.categories',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_hypestore_domain_model_category',
				//'foreign_table_where' => 'ORDER BY tx_hypestore_domain_model_category.categories DESC, tx_hypestore_domain_model_category.title ASC',
				'MM' => 'tx_hypestore_relation_category_product',
				'size' => 10,
				//'autoSizeMax' => 25,
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

				'form_type' => 'user',
				'userFunc' => 'tx_hypestore_tca_field->categories',
				'user_type' => 'tree',
				'indent_sign' => ' ',

				//'allowed' => 'tx_hypestore_domain_model_category',
				//'wizards' => array(
				//	'suggest' => array(
				//		'type' => 'suggest',
				//		'default' => array(
				//			'searchWholePhrase' => 1,
				//		),
				//	),
				//),
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
				'cols' => '30',
				'rows' => '5',
				'wizards' => array(
					'_PADDING' => 2,
					'RTE' => array(
						'notNewRecords' => 1,
						'RTEonly'		=> 1,
						'type'			=> 'script',
						'title'		=> 'Full screen Rich Text Editing',
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
				'uploadfolder' => 'uploads/hype/store/product/images',
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
				'uploadfolder' => 'uploads/hype/store/product/files',
				'size' => 5,
				'autoSizeMax' => 10,
				'minitems' => 0,
				'maxitems' => 999999,
			),
		),
		'articles' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product.articles',
			'config' => array(
				'type'						=> 'inline',
				'foreign_table'				=> 'tx_hypestore_domain_model_article',
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
		'minimum_order_quantity' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product.minimum_order_quantity',
			'config' => array(
				'type' => 'input',
				'size' => '5',
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
				'size' => '5',
				'eval' => 'double2',
				'range' => array('lower' => 0),
			),
		),
		'list_price' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product.list_price',
			'config' => array(
				'type' => 'input',
				'size' => '5',
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
				'type' => 'select',
				'foreign_table' => 'tx_hypestore_domain_model_product',
				'foreign_table_where' => 'AND tx_hypestore_domain_model_product.uid != ###THIS_UID### ORDER BY tx_hypestore_domain_model_product.title',
				'size' => 15,
				'autoSizeMax' => 25,
				'minitems' => 0,
				'maxitems' => 999999,
				'MM' => 'tx_hypestore_relation_product_product',

				'allowed' => 'tx_hypestore_domain_model_product',
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
				'size' => '5',
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
				'allowed' => 'pages',
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
				'size' => 20,
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

		# General
		'manufacturer' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product.manufacturer',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'db',
				'allowed' => 'tx_hypedirectory_domain_model_contact',
				'foreign_table' => 'tx_hypedirectory_domain_model_contact',
				'prepend_tname' => FALSE,
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
				'size' => '8',
				'max' => '10',
				'eval' => 'num,nospace,unique,trim',
			),
		),
		'isbn13_number' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product.isbn13_number',
			'config' => array(
				'type' => 'input',
				'size' => '8',
				'max' => '13',
				'eval' => 'num,nospace,unique,trim',
			),
		),
		'authors' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product.authors',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'db',
				'allowed' => 'tx_hypedirectory_domain_model_contact',
				'prepend_tname' => FALSE,
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
				'allowed' => 'tx_hypedirectory_domain_model_contact',
				'prepend_tname' => FALSE,
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
				'size' => '4',
				'max' => '4',
				'eval' => 'num,nospace,trim',
			),
		),
		'editor' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product.editor',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'db',
				'allowed' => 'tx_hypedirectory_domain_model_contact',
				'prepend_tname' => FALSE,
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
				'size' => '4',
				//'max' => '4',
				'eval' => 'num,nospace,trim',
			),
		),
	),
	'types' => array(
		'basic' => array('showitem' => '
			sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title;;2;;1-1-1, identifier, gtin, type;;;;1-1-1, introduction;;;;1-1-1, description;;;richtext[]:rte_transform[mode=ts_css|imgpath=uploads/tx_hypestore/rte/];3-3-3,

			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tabs.relations,		categories, related_products;;;;1-1-1, related_page;;;;1-1-1, related_address;;;;1-1-1,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tabs.media,			images, files;;;;1-1-1,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tabs.articles,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tabs.prices,		flat_price, list_price, tax_scale, minimum_order_quantity, scaled_prices;;;;1-1-1,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tabs.attributes,	attributes,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tabs.stocks,		stock_threshold, stock_unit, stocks;;;;1-1-1,
		'),
		'apparel' => array('showitem' => '
			sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title;;2;;1-1-1, identifier, gtin, type;;;;1-1-1, introduction;;;;1-1-1, description;;;richtext[]:rte_transform[mode=ts_css|imgpath=uploads/tx_hypestore/rte/];3-3-3,

			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tabs.details,		manufacturer,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tabs.relations,		categories, related_products;;;;1-1-1, related_page;;;;1-1-1, related_address;;;;1-1-1,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tabs.media,			images, files;;;;1-1-1,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tabs.articles,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tabs.prices,		flat_price, list_price, tax_scale, minimum_order_quantity, scaled_prices;;;;1-1-1,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tabs.attributes,	attributes,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tabs.stocks,		stock_threshold, stock_unit, stocks;;;;1-1-1,
		'),
		'furniture' => array('showitem' => '
			sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title;;2;;1-1-1, identifier, gtin, type;;;;1-1-1, introduction;;;;1-1-1, description;;;richtext[]:rte_transform[mode=ts_css|imgpath=uploads/tx_hypestore/rte/];3-3-3,

			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tabs.details,		manufacturer,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tabs.relations,		categories, related_products;;;;1-1-1, related_page;;;;1-1-1, related_address;;;;1-1-1,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tabs.media,			images, files;;;;1-1-1,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tabs.articles,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tabs.prices,		flat_price, list_price, tax_scale, minimum_order_quantity, scaled_prices;;;;1-1-1,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tabs.attributes,	attributes,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tabs.stocks,		stock_threshold, stock_unit, stocks;;;;1-1-1,
		'),
		'book' => array('showitem' => '
			sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title;;2;;1-1-1, identifier, gtin, type;;;;1-1-1, introduction;;;;1-1-1, description;;;richtext[]:rte_transform[mode=ts_css|imgpath=uploads/tx_hypestore/rte/];3-3-3,

			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tabs.details,		isbn13_number, isbn10_number, authors;;;;1-1-1, publisher;;;;1-1-1, publication_year, editor;;;;1-1-1, edition,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tabs.relations,		categories, related_products;;;;1-1-1, related_page;;;;1-1-1, related_address;;;;1-1-1,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tabs.media,			images, files;;;;1-1-1,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tabs.articles,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tabs.prices,		flat_price, list_price, tax_scale, minimum_order_quantity, scaled_prices;;;;1-1-1,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tabs.attributes,	attributes,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tabs.stocks,		stock_threshold, stock_unit, stocks;;;;1-1-1,
		'),
	),
	'palettes' => array(
		'1' => array('showitem' => 'starttime, endtime, fe_group'),
		'2' => array('showitem' => 'subtitle'),
	),
);
$TCA['tx_hypestore_domain_model_product']['types']['default'] = $TCA['tx_hypestore_domain_model_product']['types']['basic'];
$TCA['tx_hypestore_domain_model_product']['types']['0'] = $TCA['tx_hypestore_domain_model_product']['types']['basic'];
$TCA['tx_hypestore_domain_model_product']['types']['1'] = $TCA['tx_hypestore_domain_model_product']['types']['book'];
$TCA['tx_hypestore_domain_model_product']['types']['2'] = $TCA['tx_hypestore_domain_model_product']['types']['furniture'];
$TCA['tx_hypestore_domain_model_product']['types']['3'] = $TCA['tx_hypestore_domain_model_product']['types']['apparel'];

$TCA['tx_hypestore_domain_model_article'] = array(
	'ctrl' => $TCA['tx_hypestore_domain_model_article']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid,l10n_parent,l10n_diffsource,hidden,starttime,endtime,fe_group,product,identifier,gtin,type,images,files,minimum_order_quantity,flat_price,scaled_prices,attributes,stock_threshold,stocks'
	),
	'feInterface' => $TCA['tx_hypestore_domain_model_article']['feInterface'],
	'columns' => array(
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
				'default' => '0'
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'label'	=> 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
			'config'	=> array(
				'type'	=> 'input',
				'size'	=> '8',
				'max'		=> '20',
				'eval'	=> 'date',
				'default'	=> '0',
				'checkbox' => '0'
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'label'	=> 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
			'config'	=> array(
				'type'	=> 'input',
				'size'	=> '8',
				'max'		=> '20',
				'eval'	=> 'date',
				'checkbox' => '0',
				'default'	=> '0',
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
				'items' => array(
					array('', 0),
					array('LLL:EXT:lang/locallang_general.xml:LGL.hide_at_login', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.any_login', -2),
					array('LLL:EXT:lang/locallang_general.xml:LGL.usergroups', '--div--'),
				),
				'foreign_table' => 'fe_groups'
			),
		),
		'product' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_article.product',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_hypestore_domain_model_product',
				'foreign_table_where' => 'ORDER BY tx_hypestore_domain_model_product.title',
				'size' => 1,
				'minitems' => 1,
				'maxitems' => 1,
			),
		),
		'identifier' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_article.identifier',
			'config' => array(
				'type' => 'input',
				'size' => '10',
				'eval' => 'required,trim',
			),
		),
		'gtin' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_article.gtin',
			'config' => array(
				'type' => 'input',
				'size' => '10',
				'max' => '14',
				'eval' => 'num,nospace,unique,trim',
			),
		),
		'type' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_article.type',
			'config' => array(
				'type' => 'select',
				'default' => 'basic',
				'items' => array(
					array('LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_article.type.basic', 'basic',),
					array('LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_article.type.apparel', 'apparel', 'EXT:hype_store/Configuration/TCA/Icons/Product/apparel.png'),
					array('LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_article.type.furniture', 'furniture', 'EXT:hype_store/Configuration/TCA/Icons/Product/furniture.png'),
					array('LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_article.type.book', 'book', 'EXT:hype_store/Configuration/TCA/Icons/Product/book.png'),
				),
				'itemsProcFunc' => 'tx_HypeStore_Utility_Tca->getArticleType',
				'disableNoMatchingValueElement' => TRUE,
			),
		),
		'images' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_article.images',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'file',
				'allowed' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
				'max_size' => $GLOBALS['TYPO3_CONF_VARS']['BE']['maxFileSize'],
				'uploadfolder' => 'uploads/hype/store/article/images',
				'size' => 5,
				'autoSizeMax' => 10,
				'minitems' => 0,
				'maxitems' => 999999,
				'show_thumbs' => TRUE,
			),
		),
		'files' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_article.files',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'file',
				'allowed' => '*',
				'disallowed' => 'php,php3',
				'max_size' => $GLOBALS['TYPO3_CONF_VARS']['BE']['maxFileSize'],
				'uploadfolder' => 'uploads/hype/store/article/files',
				'size' => 5,
				'autoSizeMax' => 10,
				'minitems' => 0,
				'maxitems' => 999999,
			),
		),
		'minimum_order_quantity' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_article.minimum_order_quantity',
			'config' => array(
				'type' => 'input',
				'size' => '5',
				'eval' => 'int',
				'default' => 1,
				'range' => array('lower' => 0),
			),
		),
		'flat_price' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_article.flat_price',
			'config' => array(
				'type' => 'input',
				'size' => '5',
				'eval' => 'double2',
				'range' => array('lower' => 0),
			),
		),
		'scaled_prices' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_article.scaled_prices',
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
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_article.attributes',
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
		'stock_threshold' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_article.stock_threshold',
			'config' => array(
				'type' => 'input',
				'size' => '5',
				'eval' => 'int',
				'range' => array('lower' => 0),
			),
		),
		'stocks' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_article.stocks',
			'config' => array(
				'type'						=> 'inline',
				'foreign_table'				=> 'tx_hypestore_domain_model_article_stock',
				'foreign_field'				=> 'article',
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
		),
	),
	'types' => array(
		'basic' => array('showitem' => '
			sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, product, identifier, gtin, type,

			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tabs.media,			images, files;;;;1-1-1,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tabs.prices,		flat_price, minimum_order_quantity, scaled_prices;;;;1-1-1,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tabs.attributes,	attributes,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tabs.stocks,		stock_threshold, stocks;;;;1-1-1,
		'),
		'apparel' => array('showitem' => '
			sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, product, identifier, gtin, type,

			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tabs.media,			images, files;;;;1-1-1,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tabs.prices,		flat_price, minimum_order_quantity, scaled_prices;;;;1-1-1,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tabs.attributes,	attributes,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tabs.stocks,		stock_threshold, stocks;;;;1-1-1,
		'),
		'book' => array('showitem' => '
			sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, product, identifier, gtin, type,

			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tabs.media,			images, files;;;;1-1-1,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tabs.prices,		flat_price, minimum_order_quantity, scaled_prices;;;;1-1-1,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tabs.attributes,	attributes,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tabs.stocks,		stock_threshold, stocks;;;;1-1-1,
		'),
		'furniture' => array('showitem' => '
			sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, product, identifier, gtin, type,

			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tabs.media,			images, files;;;;1-1-1,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tabs.prices,		flat_price, minimum_order_quantity, scaled_prices;;;;1-1-1,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tabs.attributes,	attributes,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tabs.stocks,		stock_threshold, stocks;;;;1-1-1,
		'),
	),
	'palettes' => array(
		'1' => array('showitem' => 'starttime, endtime, fe_group'),
		'2' => array('showitem' => 'subtitle'),
	),
);

$TCA['tx_hypestore_domain_model_discount'] = array(
	'ctrl' => $TCA['tx_hypestore_domain_model_discount']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid,l10n_parent,l10n_diffsource,hidden,starttime,endtime,fe_group,title,rate,included_categories,excluded_categories,included_products,excluded_products'
	),
	'feInterface' => $TCA['tx_hypestore_domain_model_discount']['feInterface'],
	'columns' => array(
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
				'default' => '0'
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'label'	=> 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
			'config'	=> array(
				'type'	=> 'input',
				'size'	=> '8',
				'max'		=> '20',
				'eval'	=> 'date',
				'default'	=> '0',
				'checkbox' => '0'
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'label'	=> 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
			'config'	=> array(
				'type'	=> 'input',
				'size'	=> '8',
				'max'		=> '20',
				'eval'	=> 'date',
				'checkbox' => '0',
				'default'	=> '0',
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
				'items' => array(
					array('', 0),
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
				'size' => '30',
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
				'type' => 'select',
				'foreign_table' => 'tx_hypestore_domain_model_category',
				//'foreign_table_where' => 'ORDER BY tx_hypestore_domain_model_product.title',
				'size' => 15,
				'autoSizeMax' => 25,
				'minitems' => 0,
				'maxitems' => 999999,
				'MM' => 'tx_hypestore_relation_discount_category',
				'MM_match_fields' => array(
					'exclude' => 0
				),

				'form_type' => 'user',
				'userFunc' => 'tx_hypestore_tca_field->categories',
				'user_type' => 'tree',
				'indent_sign' => ' ',

				'allowed' => 'tx_hypestore_domain_model_category',
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
		'excluded_categories' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_discount.excluded_categories',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_hypestore_domain_model_category',
				//'foreign_table_where' => 'ORDER BY tx_hypestore_domain_model_product.title',
				'size' => 15,
				'autoSizeMax' => 25,
				'minitems' => 0,
				'maxitems' => 999999,
				'MM' => 'tx_hypestore_relation_discount_category',
				'MM_match_fields' => array(
					'exclude' => 1
				),

				'form_type' => 'user',
				'userFunc' => 'tx_hypestore_tca_field->categories',
				'user_type' => 'tree',
				'indent_sign' => ' ',

				'allowed' => 'tx_hypestore_domain_model_category',
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
		'included_products' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_discount.included_products',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_hypestore_domain_model_product',
				//'foreign_table_where' => 'ORDER BY tx_hypestore_domain_model_product.title',
				'size' => 15,
				'autoSizeMax' => 25,
				'minitems' => 0,
				'maxitems' => 999999,
				'MM' => 'tx_hypestore_relation_discount_product',
				'MM_match_fields' => array(
					'exclude' => 0
				),
				'allowed' => 'tx_hypestore_domain_model_product',
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
				'type' => 'select',
				'foreign_table' => 'tx_hypestore_domain_model_product',
				//'foreign_table_where' => 'ORDER BY tx_hypestore_domain_model_product.title',
				'size' => 15,
				'autoSizeMax' => 25,
				'minitems' => 0,
				'maxitems' => 999999,
				'MM' => 'tx_hypestore_relation_discount_product',
				'MM_match_fields' => array(
					'exclude' => 1
				),
				'allowed' => 'tx_hypestore_domain_model_product',
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
	),
	'types' => array(
		'0' => array('showitem' => '
			sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title;;;;1-1-1, rate;;;;1-1-1,

			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tabs.categories,	included_categories, excluded_categories,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tabs.products,		included_products, excluded_products
		'),
	),
	'palettes' => array(
		'1' => array('showitem' => 'starttime, endtime, fe_group'),
	),
);

$TCA['tx_hypestore_domain_model_depot'] = array(
	'ctrl' => $TCA['tx_hypestore_domain_model_depot']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid,l10n_parent,l10n_diffsource,hidden,starttime,endtime,fe_group,title,street,postcode,city,country,product_stocks,article_stocks'
	),
	'feInterface' => $TCA['tx_hypestore_domain_model_depot']['feInterface'],
	'columns' => array(
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
				'foreign_table'		=> 'tx_hypestore_domain_model_depot',
				'foreign_table_where' => 'AND tx_hypestore_domain_model_depot.pid=###CURRENT_PID### AND tx_hypestore_domain_model_depot.sys_language_uid IN (-1,0)',
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
				'default' => '0'
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'label'	=> 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
			'config'	=> array(
				'type'	=> 'input',
				'size'	=> '8',
				'max'		=> '20',
				'eval'	=> 'date',
				'default'	=> '0',
				'checkbox' => '0'
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'label'	=> 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
			'config'	=> array(
				'type'	=> 'input',
				'size'	=> '8',
				'max'		=> '20',
				'eval'	=> 'date',
				'checkbox' => '0',
				'default'	=> '0',
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
				'items' => array(
					array('', 0),
					array('LLL:EXT:lang/locallang_general.xml:LGL.hide_at_login', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.any_login', -2),
					array('LLL:EXT:lang/locallang_general.xml:LGL.usergroups', '--div--'),
				),
				'foreign_table' => 'fe_groups'
			),
		),
		'title' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_depot.title',
			'config' => array(
				'type' => 'input',
				'size' => '30',
				'eval' => 'required,trim',
			),
		),
		'street' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_depot.street',
			'config' => array(
				'type' => 'input',
				'size' => '30',
				'eval' => 'trim',
			),
		),
		'postcode' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_depot.postcode',
			'config' => array(
				'type' => 'input',
				'size' => '30',
				'eval' => 'int',
			),
		),
		'city' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_depot.city',
			'config' => array(
				'type' => 'input',
				'size' => '30',
				'eval' => 'trim',
			),
		),
		'country' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_depot.country',
			'config' => array(
				'type' => 'input',
				'size' => '30',
				'eval' => 'trim',
			),
		),
		'product_stocks' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_depot.product_stocks',
			'config' => array(
				'type'						=> 'inline',
				'foreign_table'				=> 'tx_hypestore_domain_model_product_stock',
				'foreign_field'				=> 'depot',
				'foreign_label'				=> 'product',
				'foreign_default_sortby'	=> 'product',
				'foreign_unique'			=> 'product',
				'appearance'				=> array(
					'collapseAll'				=> TRUE,
					'expandSingle'				=> TRUE,
				),
				'minitems'					=> 0,
				'maxitems'					=> 999999,
			),
		),
		'article_stocks' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_depot.article_stocks',
			'config' => array(
				'type'						=> 'inline',
				'foreign_table'				=> 'tx_hypestore_domain_model_article_stock',
				'foreign_field'				=> 'depot',
				'foreign_label'				=> 'article',
				'foreign_default_sortby'	=> 'article',
				'foreign_unique'			=> 'product',
				'appearance'				=> array(
					'collapseAll'				=> TRUE,
					'expandSingle'				=> TRUE,
				),
				'minitems'					=> 0,
				'maxitems'					=> 999999,
			),
		),
	),
	'types' => array(
		'0' => array('showitem' => '
			sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title;;;;2-2-2, street;;;;3-3-3, postcode, city, country,

			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tabs.product_stocks,	product_stocks,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tabs.article_stocks,	article_stocks,
		'),
	),
	'palettes' => array(
		'1' => array('showitem' => 'starttime, endtime, fe_group'),
	),
);

$TCA['tx_hypestore_domain_model_product_stock'] = array(
	'ctrl' => $TCA['tx_hypestore_domain_model_product_stock']['ctrl'],
	'interface' => array(
		//'showRecordFieldList' => 'sys_language_uid,l10n_parent,l10n_diffsource,hidden,starttime,endtime,fe_group,depot,product,amount'
		'showRecordFieldList' => 'l10n_parent,l10n_diffsource,hidden,starttime,endtime,fe_group,depot,product,quantity'
	),
	'feInterface' => $TCA['tx_hypestore_domain_model_product_stock']['feInterface'],
	'columns' => array(
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
				'default' => '0'
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'label'	=> 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
			'config'	=> array(
				'type'	=> 'input',
				'size'	=> '8',
				'max'		=> '20',
				'eval'	=> 'date',
				'default'	=> '0',
				'checkbox' => '0'
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'label'	=> 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
			'config'	=> array(
				'type'	=> 'input',
				'size'	=> '8',
				'max'		=> '20',
				'eval'	=> 'date',
				'checkbox' => '0',
				'default'	=> '0',
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
				'items' => array(
					array('', 0),
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
				'type' => 'select',
				'foreign_table' => 'tx_hypestore_domain_model_depot',
				'foreign_table_where' => 'ORDER BY tx_hypestore_domain_model_depot.uid',
				'size' => 1,
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
		'product' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product_stock.product',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_hypestore_domain_model_product',
				'foreign_table_where' => 'ORDER BY tx_hypestore_domain_model_product.uid',
				'size' => 1,
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
		'quantity' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product_stock.quantity',
			'config' => array(
				'type' => 'input',
				'size' => '5',
				'eval' => 'required,int',
				'range' => array('lower' => 0),
			),
		),
	),
	'types' => array(
		//'0' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, depot, product, amount'),
		'0' => array('showitem' => 'l10n_parent, l10n_diffsource, hidden;;1, depot, product, quantity'),
	),
	'palettes' => array(
		'1' => array('showitem' => 'starttime, endtime, fe_group'),
	),
);

$TCA['tx_hypestore_domain_model_article_stock'] = array(
	'ctrl' => $TCA['tx_hypestore_domain_model_article_stock']['ctrl'],
	'interface' => array(
		//'showRecordFieldList' => 'sys_language_uid,l10n_parent,l10n_diffsource,hidden,starttime,endtime,fe_group,depot,product,amount'
		'showRecordFieldList' => 'l10n_parent,l10n_diffsource,hidden,starttime,endtime,fe_group,depot,article,quantity'
	),
	'feInterface' => $TCA['tx_hypestore_domain_model_article_stock']['feInterface'],
	'columns' => array(
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
				'foreign_table'		=> 'tx_hypestore_domain_model_article_stock',
				'foreign_table_where' => 'AND tx_hypestore_domain_model_article_stock.pid=###CURRENT_PID### AND tx_hypestore_domain_model_article_stock.sys_language_uid IN (-1,0)',
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
				'default' => '0'
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'label'	=> 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
			'config'	=> array(
				'type'	=> 'input',
				'size'	=> '8',
				'max'		=> '20',
				'eval'	=> 'date',
				'default'	=> '0',
				'checkbox' => '0'
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'label'	=> 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
			'config'	=> array(
				'type'	=> 'input',
				'size'	=> '8',
				'max'		=> '20',
				'eval'	=> 'date',
				'checkbox' => '0',
				'default'	=> '0',
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
				'items' => array(
					array('', 0),
					array('LLL:EXT:lang/locallang_general.xml:LGL.hide_at_login', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.any_login', -2),
					array('LLL:EXT:lang/locallang_general.xml:LGL.usergroups', '--div--'),
				),
				'foreign_table' => 'fe_groups'
			),
		),
		'depot' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_article_stock.depot',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_hypestore_domain_model_depot',
				'foreign_table_where' => 'ORDER BY tx_hypestore_domain_model_depot.uid',
				'size' => 1,
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
		'article' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_article_stock.article',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_hypestore_domain_model_article',
				'foreign_table_where' => 'ORDER BY tx_hypestore_domain_model_article.uid',
				'size' => 1,
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
		'quantity' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_article_stock.quantity',
			'config' => array(
				'type' => 'input',
				'size' => '5',
				'eval' => 'required,int',
				'range' => array('lower' => 0),
			),
		),
	),
	'types' => array(
		//'0' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, depot, product, amount'),
		'0' => array('showitem' => 'l10n_parent, l10n_diffsource, hidden;;1, depot, article, quantity'),
	),
	'palettes' => array(
		'1' => array('showitem' => 'starttime, endtime, fe_group'),
	),
);

$TCA['tx_hypestore_domain_model_attribute'] = array(
	'ctrl' => $TCA['tx_hypestore_domain_model_attribute']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid,l10n_parent,l10n_diffsource,hidden,starttime,endtime,fe_group,title,unit,type'
	),
	'feInterface' => $TCA['tx_hypestore_domain_model_attribute']['feInterface'],
	'columns' => array(
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
				'default' => '0'
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'label'	=> 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
			'config'	=> array(
				'type'	=> 'input',
				'size'	=> '8',
				'max'		=> '20',
				'eval'	=> 'date',
				'default'	=> '0',
				'checkbox' => '0'
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'label'	=> 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
			'config'	=> array(
				'type'	=> 'input',
				'size'	=> '8',
				'max'		=> '20',
				'eval'	=> 'date',
				'checkbox' => '0',
				'default'	=> '0',
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
				'items' => array(
					array('', 0),
					array('LLL:EXT:lang/locallang_general.xml:LGL.hide_at_login', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.any_login', -2),
					array('LLL:EXT:lang/locallang_general.xml:LGL.usergroups', '--div--'),
				),
				'foreign_table' => 'fe_groups'
			),
		),
		'title' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_attribute.title',
			'config' => array(
				'type' => 'input',
				'size' => '30',
				'eval' => 'required,trim',
			),
		),
		'unit' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_attribute.unit',
			'config' => array(
				'type' => 'input',
				'size' => '5',
				'eval' => 'trim',
			),
		),
		'type' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_attribute.type',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_attribute.type.I.0', '0'),
					array('LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_attribute.type.I.1', '1'),
					array('LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_attribute.type.I.2', '2'),
					array('LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_attribute.type.I.3', '3'),
				),
				'size' => 1,
				'maxitems' => 1,
			),
		),
	),
	'types' => array(
		'0' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title;;;;2-2-2, unit;;;;3-3-3, type'),
	),
	'palettes' => array(
		'1' => array('showitem' => 'starttime, endtime, fe_group'),
	),
);

$TCA['tx_hypestore_domain_model_product_attribute'] = array(
	'ctrl' => $TCA['tx_hypestore_domain_model_product_attribute']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid,l10n_parent,l10n_diffsource,hidden,starttime,endtime,fe_group,product,attribute,value'
	),
	'feInterface' => $TCA['tx_hypestore_domain_model_product_attribute']['feInterface'],
	'columns' => array(
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
				'default' => '0'
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'label'	=> 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
			'config'	=> array(
				'type'	=> 'input',
				'size'	=> '8',
				'max'		=> '20',
				'eval'	=> 'date',
				'default'	=> '0',
				'checkbox' => '0'
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'label'	=> 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
			'config'	=> array(
				'type'	=> 'input',
				'size'	=> '8',
				'max'		=> '20',
				'eval'	=> 'date',
				'checkbox' => '0',
				'default'	=> '0',
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
				'items' => array(
					array('', 0),
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
			),
		),
		'value' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product_attribute.value',
			'config' => array(
				'type' => 'input',
				'size' => '30',
				'eval' => 'required,trim',
			),
		),
	),
	'types' => array(
		//'0' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, attribute, product, value'),
		'0' => array('showitem' => 'l10n_parent, l10n_diffsource, hidden;;1, attribute, product, value'),
	),
	'palettes' => array(
		'1' => array('showitem' => 'starttime, endtime, fe_group'),
	),
);

$TCA['tx_hypestore_domain_model_product_price'] = array(
	'ctrl' => $TCA['tx_hypestore_domain_model_product_price']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid,l10n_parent,l10n_diffsource,hidden,starttime,endtime,fe_group,product,quantity,value'
	),
	'feInterface' => $TCA['tx_hypestore_domain_model_product_price']['feInterface'],
	'columns' => array(
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
				'default' => '0'
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'label'	=> 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
			'config'	=> array(
				'type'	=> 'input',
				'size'	=> '8',
				'max'		=> '20',
				'eval'	=> 'date',
				'default'	=> '0',
				'checkbox' => '0'
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'label'	=> 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
			'config'	=> array(
				'type'	=> 'input',
				'size'	=> '8',
				'max'		=> '20',
				'eval'	=> 'date',
				'checkbox' => '0',
				'default'	=> '0',
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
				'items' => array(
					array('', 0),
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
				'size' => '5',
				'eval' => 'required,int',
				'range' => array('lower' => 2),
			),
		),
		'value' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product_price.value',
			'config' => array(
				'type' => 'input',
				'size' => '5',
				'eval' => 'required,double2',
				'range' => array('lower' => 0),
			),
		),
	),
	'types' => array(
		//'0' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, product, quantity, value'),
		'0' => array('showitem' => 'l10n_parent, l10n_diffsource, hidden;;1, product, quantity, value'),
	),
	'palettes' => array(
		'1' => array('showitem' => 'starttime, endtime, fe_group'),
	),
);

$TCA['tx_hypestore_domain_model_tax_scale'] = array(
	'ctrl' => $TCA['tx_hypestore_domain_model_tax_scale']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid,l10n_parent,l10n_diffsource,hidden,starttime,endtime,fe_group,rate'
	),
	'feInterface' => $TCA['tx_hypestore_domain_model_tax_scale']['feInterface'],
	'columns' => array(
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
				'default' => '0'
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'label'	=> 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
			'config'	=> array(
				'type'	=> 'input',
				'size'	=> '8',
				'max'		=> '20',
				'eval'	=> 'date',
				'default'	=> '0',
				'checkbox' => '0'
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'label'	=> 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
			'config'	=> array(
				'type'	=> 'input',
				'size'	=> '8',
				'max'		=> '20',
				'eval'	=> 'date',
				'checkbox' => '0',
				'default'	=> '0',
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
				'items' => array(
					array('', 0),
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
				'size' => '5',
				'eval' => 'required,double2',
				'range' => array('lower' => 0, 'upper' => 100),
			),
		),
	),
	'types' => array(
		'0' => array('showitem' => 'l10n_parent, l10n_diffsource, hidden;;1, rate'),
	),
	'palettes' => array(
		'1' => array('showitem' => 'starttime, endtime, fe_group'),
	),
);

$TCA['tx_hypestore_domain_model_cart_item'] = array(
	'ctrl' => $TCA['tx_hypestore_domain_model_cart_item']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid,l10n_parent,l10n_diffsource,hidden,starttime,endtime,fe_group,customer,product,quantity'
	),
	'feInterface' => $TCA['tx_hypestore_domain_model_cart_item']['feInterface'],
	'columns' => array(
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
				'default' => '0'
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'label'	=> 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
			'config'	=> array(
				'type'	=> 'input',
				'size'	=> '8',
				'max'		=> '20',
				'eval'	=> 'date',
				'default'	=> '0',
				'checkbox' => '0'
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'label'	=> 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
			'config'	=> array(
				'type'	=> 'input',
				'size'	=> '8',
				'max'		=> '20',
				'eval'	=> 'date',
				'checkbox' => '0',
				'default'	=> '0',
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
				'items' => array(
					array('', 0),
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
				'type' => 'select',
				'foreign_table' => 'fe_users',
				//'foreign_table_where' => 'ORDER BY fe_users.title',
				'size' => 1,
				'minitems' => 1,
				'maxitems' => 1,
			),
		),
		'product' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_cart_item.product',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_hypestore_domain_model_product',
				'foreign_table_where' => 'ORDER BY tx_hypestore_domain_model_product.title',
				'size' => 1,
				'minitems' => 1,
				'maxitems' => 1,
			),
		),
		'quantity' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_cart_item.quantity',
			'config' => array(
				'type' => 'input',
				'size' => '5',
				'eval' => 'required,int',
				'range' => array('lower' => 0),
			),
		),
	),
	'types' => array(
		//'0' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, product, quantity, value'),
		'0' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, customer, product, quantity'),
	),
	'palettes' => array(
		'1' => array('showitem' => 'starttime, endtime, fe_group'),
	),
);

$TCA['tx_hypestore_domain_model_watchlist_item'] = array(
	'ctrl' => $TCA['tx_hypestore_domain_model_watchlist_item']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid,l10n_parent,l10n_diffsource,hidden,starttime,endtime,fe_group,customer,product'
	),
	'feInterface' => $TCA['tx_hypestore_domain_model_watchlist_item']['feInterface'],
	'columns' => array(
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
				'default' => '0'
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'label'	=> 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
			'config'	=> array(
				'type'	=> 'input',
				'size'	=> '8',
				'max'		=> '20',
				'eval'	=> 'date',
				'default'	=> '0',
				'checkbox' => '0'
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'label'	=> 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
			'config'	=> array(
				'type'	=> 'input',
				'size'	=> '8',
				'max'		=> '20',
				'eval'	=> 'date',
				'checkbox' => '0',
				'default'	=> '0',
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
				'items' => array(
					array('', 0),
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
				'type' => 'select',
				'foreign_table' => 'fe_users',
				//'foreign_table_where' => 'ORDER BY fe_users.title',
				'size' => 1,
				'minitems' => 1,
				'maxitems' => 1,
			),
		),
		'product' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_watchlist_item.product',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_hypestore_domain_model_product',
				'foreign_table_where' => 'ORDER BY tx_hypestore_domain_model_product.title',
				'size' => 1,
				'minitems' => 1,
				'maxitems' => 1,
			),
		),
	),
	'types' => array(
		//'0' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, product, quantity, value'),
		'0' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, customer, product, quantity'),
	),
	'palettes' => array(
		'1' => array('showitem' => 'starttime, endtime, fe_group'),
	),
);

$TCA['tx_hypestore_domain_model_customer_address'] = array(
	'ctrl' => $TCA['tx_hypestore_domain_model_customer_address']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid,l10n_parent,l10n_diffsource,hidden,starttime,endtime,fe_group,customer,title,name,company,street,stair,floor,door,postcode,city,country,telephone_number'
	),
	'feInterface' => $TCA['tx_hypestore_domain_model_customer_address']['feInterface'],
	'columns' => array(
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
				'default' => '0'
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'label'	=> 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
			'config'	=> array(
				'type'	=> 'input',
				'size'	=> '8',
				'max'		=> '20',
				'eval'	=> 'date',
				'default'	=> '0',
				'checkbox' => '0'
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'label'	=> 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
			'config'	=> array(
				'type'	=> 'input',
				'size'	=> '8',
				'max'		=> '20',
				'eval'	=> 'date',
				'checkbox' => '0',
				'default'	=> '0',
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
				'items' => array(
					array('', 0),
					array('LLL:EXT:lang/locallang_general.xml:LGL.hide_at_login', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.any_login', -2),
					array('LLL:EXT:lang/locallang_general.xml:LGL.usergroups', '--div--'),
				),
				'foreign_table' => 'fe_groups'
			),
		),
		'customer' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_customer_address.customer',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'fe_users',
				'size' => 1,
				'minitems' => 1,
				'maxitems' => 1,
				'eval' => 'required',
			),
		),
		'title' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_customer_address.title',
			'config' => array(
				'type' => 'input',
				'size' => '30',
				'eval' => 'required,trim',
			),
		),
		'name' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_customer_address.name',
			'config' => array(
				'type' => 'input',
				'size' => '30',
				'eval' => 'required,trim',
			),
		),
		'company' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_customer_address.company',
			'config' => array(
				'type' => 'input',
				'size' => '30',
				'eval' => 'trim',
			),
		),
		'street' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_customer_address.street',
			'config' => array(
				'type' => 'input',
				'size' => '30',
				'eval' => 'required,trim',
			),
		),
		'stair' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_customer_address.stair',
			'config' => array(
				'type' => 'input',
				'size' => '3',
				'eval' => 'trim',
			),
		),
		'floor' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_customer_address.floor',
			'config' => array(
				'type' => 'input',
				'size' => '3',
				'eval' => 'trim',
			),
		),
		'door' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_customer_address.door',
			'config' => array(
				'type' => 'input',
				'size' => '3',
				'eval' => 'trim',
			),
		),
		'postcode' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_customer_address.postcode',
			'config' => array(
				'type' => 'input',
				'size' => '5',
				'eval' => 'trim',
			),
		),
		'city' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_customer_address.city',
			'config' => array(
				'type' => 'input',
				'size' => '30',
				'eval' => 'required,trim',
			),
		),
		'country' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_customer_address.country',
			'config' => array(
				'type' => 'input',
				'size' => '30',
				'eval' => 'required,trim',
			),
		),
		'telephone_number' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_customer_address.telephone_number',
			'config' => array(
				'type' => 'input',
				'size' => '30',
				'eval' => 'trim',
			),
		),
	),
	'types' => array(
		'0' => array('showitem' => '
			sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1,customer,title,name;;;;1-1-1,company,street;;2;;,city;;3;;,country,telephone_number;;;;1-1-1
		'),
	),
	'palettes' => array(
		'1' => array('showitem' => 'starttime, endtime, fe_group'),
		'2' => array('showitem' => 'stair, floor, door'),
		'3' => array('showitem' => 'postcode'),
	),
);

$TCA['tx_hypestore_domain_model_order'] = array(
	'ctrl' => $TCA['tx_hypestore_domain_model_order']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid,l10n_parent,l10n_diffsource,hidden,starttime,endtime,fe_group,customer,items'
	),
	'feInterface' => $TCA['tx_hypestore_domain_model_order']['feInterface'],
	'columns' => array(
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
				'foreign_table'		=> 'tx_hypestore_domain_model_depot',
				'foreign_table_where' => 'AND tx_hypestore_domain_model_depot.pid=###CURRENT_PID### AND tx_hypestore_domain_model_depot.sys_language_uid IN (-1,0)',
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
				'default' => '0'
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'label'	=> 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
			'config'	=> array(
				'type'	=> 'input',
				'size'	=> '8',
				'max'		=> '20',
				'eval'	=> 'date',
				'default'	=> '0',
				'checkbox' => '0'
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'label'	=> 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
			'config'	=> array(
				'type'	=> 'input',
				'size'	=> '8',
				'max'		=> '20',
				'eval'	=> 'date',
				'checkbox' => '0',
				'default'	=> '0',
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
				'items' => array(
					array('', 0),
					array('LLL:EXT:lang/locallang_general.xml:LGL.hide_at_login', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.any_login', -2),
					array('LLL:EXT:lang/locallang_general.xml:LGL.usergroups', '--div--'),
				),
				'foreign_table' => 'fe_groups'
			),
		),
		'customer' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_order.customer',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'fe_users',
				//'foreign_table_where' => 'ORDER BY fe_users.title',
				'size' => 1,
				'minitems' => 1,
				'maxitems' => 1,
			),
		),
	),
	'types' => array(
		'0' => array('showitem' => '
			sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, customer, items
		'),
	),
	'palettes' => array(
		'1' => array('showitem' => 'starttime, endtime, fe_group'),
	),
);
?>