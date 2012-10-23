<?php

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
							'searchCondition' => 'product=\'\'',
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

?>