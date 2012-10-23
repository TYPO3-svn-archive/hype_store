<?php

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

?>