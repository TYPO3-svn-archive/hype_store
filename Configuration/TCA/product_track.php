<?php

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

?>