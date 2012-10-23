<?php

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

?>