<?php

require_once(t3lib_extMgm::extPath('hype_store') . 'Classes/Hook/class.tx_hypestore_tca_field.php');

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

?>