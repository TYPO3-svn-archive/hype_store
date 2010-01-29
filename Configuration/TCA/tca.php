<?php

if(!defined('TYPO3_MODE'))
	die('Access denied.');



require_once(t3lib_extMgm::extPath('hype_store') . 'Classes/Hook/class.tx_hypestore_tca_field.php');



$TCA['tx_hypestore_domain_model_category'] = array(
    'ctrl' => $TCA['tx_hypestore_domain_model_category']['ctrl'],
    'interface' => array(
        'showRecordFieldList' => 'sys_language_uid,l10n_parent,l10n_diffsource,hidden,starttime,endtime,fe_group,title,subtitle,introduction,description,images,parent_categories,categories,products'
    ),
    'feInterface' => $TCA['tx_hypestore_domain_model_category']['feInterface'],
    'columns' => array(
        'sys_language_uid' => array(
            'exclude' => 1,
            'label'  => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
            'config' => array(
                'type'                => 'select',
                'foreign_table'       => 'sys_language',
                'foreign_table_where' => 'ORDER BY sys_language.title',
                'items' => array(
                    array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
                    array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0),
                ),
            ),
        ),
        'l10n_parent' => array(
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude'     => 1,
            'label'       => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
            'config'      => array(
                'type'  => 'select',
                'items' => array(
                    array('', 0),
                ),
                'foreign_table'       => 'tx_hypestore_domain_model_category',
                'foreign_table_where' => 'AND tx_hypestore_domain_model_category.pid=###CURRENT_PID### AND tx_hypestore_domain_model_category.sys_language_uid IN (-1,0)',
            ),
        ),
        'l10n_diffsource' => array(
            'config' => array(
                'type' => 'passthrough'
            ),
        ),
        'hidden' => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
            'config'  => array(
                'type'    => 'check',
                'default' => '0'
            ),
        ),
        'starttime' => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
            'config'  => array(
                'type'     => 'input',
                'size'     => '8',
                'max'      => '20',
                'eval'     => 'date',
                'default'  => '0',
                'checkbox' => '0'
            ),
        ),
        'endtime' => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
            'config'  => array(
                'type'     => 'input',
                'size'     => '8',
                'max'      => '20',
                'eval'     => 'date',
                'checkbox' => '0',
                'default'  => '0',
                'range'    => array(
                    'upper' => mktime(3, 14, 7, 1, 19, 2038),
                    'lower' => mktime(0, 0, 0, date('m')-1, date('d'), date('Y')),
                ),
            ),
        ),
        'fe_group' => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.fe_group',
            'config'  => array(
                'type'  => 'select',
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
                        'RTEonly'       => 1,
                        'type'          => 'script',
                        'title'         => 'Full screen Rich Text Editing|Formatteret redigering i hele vinduet',
                        'icon'          => 'wizard_rte2.gif',
                        'script'        => 'wizard_rte.php',
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
                'max_size' => 10240,
                'uploadfolder' => 'uploads/hype/store/category/images',
                'size' => 5,
				'autoSizeMax' => 15,
                'minitems' => 0,
                'maxitems' => 999999,
            ),
        ),
		'parent_categories' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_category.parent_categories',
            'config' => array(
                'type' => 'select',
                'foreign_table' => 'tx_hypestore_domain_model_category',
                //'foreign_table_where' => 'AND tx_hypestore_domain_model_category.uid != ###THIS_UID###',
                'size' => 15,
				'autoSizeMax' => 30,
                'minitems' => 0,
                'maxitems' => 999999,
				'MM' => 'tx_hypestore_relation_category_category',
				'MM_opposite_field' => 'categories',
				
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
		'categories' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_category.categories',
            'config' => array(
                'type' => 'select',
                'foreign_table' => 'tx_hypestore_domain_model_category',
                //'foreign_table_where' => 'AND tx_hypestore_domain_model_category.uid != ###THIS_UID###',
                'size' => 15,
				'autoSizeMax' => 30,
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
				'autoSizeMax' => 30,
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
			sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title;;;;2-2-2, subtitle, introduction;;;;1-1-1, description;;;richtext[]:rte_transform[mode=ts_css|imgpath=uploads/tx_hypestore/rte/];3-3-3,
			
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tabs.media, images,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tabs.relations, parent_categories, categories, products;;;;1-1-1
		'),
    ),
    'palettes' => array(
        '1' => array('showitem' => 'starttime, endtime, fe_group'),
    ),
);

$TCA['tx_hypestore_domain_model_product'] = array(
    'ctrl' => $TCA['tx_hypestore_domain_model_product']['ctrl'],
    'interface' => array(
        'showRecordFieldList' => 'sys_language_uid,l10n_parent,l10n_diffsource,hidden,starttime,endtime,fe_group,title,subtitle,identifier,categories,introduction,description,images,files,manufacturer,minimum_order_quantity,flat_price,scaled_prices,attributes,related_products,stock_threshold,stock_unit,stocks,states,events'
    ),
    'feInterface' => $TCA['tx_hypestore_domain_model_product']['feInterface'],
    'columns' => array(
        'sys_language_uid' => array(
            'exclude' => 1,
            'label'  => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
            'config' => array(
                'type'                => 'select',
                'foreign_table'       => 'sys_language',
                'foreign_table_where' => 'ORDER BY sys_language.title',
                'items' => array(
                    array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
                    array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0),
                ),
            ),
        ),
        'l10n_parent' => array(
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude'     => 1,
            'label'       => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
            'config'      => array(
                'type'  => 'select',
                'items' => array(
                    array('', 0),
                ),
                'foreign_table'       => 'tx_hypestore_domain_model_product',
                'foreign_table_where' => 'AND tx_hypestore_domain_model_product.pid=###CURRENT_PID### AND tx_hypestore_domain_model_product.sys_language_uid IN (-1,0)',
            ),
        ),
        'l10n_diffsource' => array(
            'config' => array(
                'type' => 'passthrough'
            ),
        ),
        'hidden' => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
            'config'  => array(
                'type'    => 'check',
                'default' => '0'
            ),
        ),
        'starttime' => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
            'config'  => array(
                'type'     => 'input',
                'size'     => '8',
                'max'      => '20',
                'eval'     => 'date',
                'default'  => '0',
                'checkbox' => '0'
            ),
        ),
        'endtime' => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
            'config'  => array(
                'type'     => 'input',
                'size'     => '8',
                'max'      => '20',
                'eval'     => 'date',
                'checkbox' => '0',
                'default'  => '0',
                'range'    => array(
                    'upper' => mktime(3, 14, 7, 1, 19, 2038),
                    'lower' => mktime(0, 0, 0, date('m')-1, date('d'), date('Y')),
                ),
            ),
        ),
        'fe_group' => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.fe_group',
            'config'  => array(
                'type'  => 'select',
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
                'size' => '30',
                'eval' => 'required,trim',
            ),
        ),
		'categories' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product.categories',
            'config' => array(
                'type' => 'select',
                'foreign_table' => 'tx_hypestore_domain_model_category',
                //'foreign_table_where' => 'ORDER BY tx_hypestore_domain_model_category.categories DESC, tx_hypestore_domain_model_category.title ASC',
                'size' => 15,
				'autoSizeMax' => 30,
                'minitems' => 0,
                'maxitems' => 999999,
				'MM' => 'tx_hypestore_relation_category_product',
				
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
                        'RTEonly'       => 1,
                        'type'          => 'script',
                        'title'         => 'Full screen Rich Text Editing',
                        'icon'          => 'wizard_rte2.gif',
                        'script'        => 'wizard_rte.php',
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
                'max_size' => 10240,
                'uploadfolder' => 'uploads/hype/store/product/images',
                'size' => 5,
				'autoSizeMax' => 15,
                'minitems' => 0,
                'maxitems' => 999999,
            ),
        ),
        'files' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product.files',
            'config' => array(
                'type' => 'group',
                'internal_type' => 'file',
                'allowed' => '',
                'disallowed' => 'php,php3',
                'max_size' => 10240,
                'uploadfolder' => 'uploads/hype/store/product/files',
                'size' => 5,
				'autoSizeMax' => 15,
                'minitems' => 0,
                'maxitems' => 100,
            ),
        ),
		'manufacturer' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product.manufacturer',
            'config' => array(
                'type' => 'select',
                'foreign_table' => 'tx_hypestore_domain_model_manufacturer',
                //'foreign_table_where' => 'ORDER BY tx_hypestore_domain_model_category.categories DESC, tx_hypestore_domain_model_category.title ASC',
                'size' => 1,
                'minitems' => 0,
                'maxitems' => 1,
				'items' => array(
					array('', NULL),
				),
            ),
        ),
		'minimum_order_quantity' => array(
			'exclude' => 1,
            'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product.minimum_order_quantity',
            'config' => array(
                'type' => 'input',
                'size' => '30',
                'eval' => 'int',
            ),
		),
        'flat_price' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product.flat_price',
            'config' => array(
                'type' => 'input',
                'size' => '30',
                'eval' => 'double2',
            ),
        ),
		'scaled_prices' => array(
			'exclude' => 1,
            'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product.scaled_prices',
            'config' => array(
				'type'				=> 'inline',
				'foreign_table'		=> 'tx_hypestore_domain_model_product_price',
				'foreign_field'		=> 'product',
				//'foreign_label'		=> 'quantity',
				//'foreign_unique'	=> 'quantity',
				'appearance'		=> array(
					'collapseAll'		=> TRUE,
					'expandSingle'		=> TRUE,
				),
				'minitems'			=> 0,
				'maxitems'			=> 999999,
            ),
		),
        'attributes' => array(
			'exclude' => 1,
            'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product.attributes',
            'config' => array(
				'type'				=> 'inline',
				'foreign_table'		=> 'tx_hypestore_domain_model_product_attribute',
				'foreign_field'		=> 'product',
				//'foreign_label'		=> 'attribute',
				//'foreign_unique'	=> 'attribute',
				'appearance'		=> array(
					'collapseAll'		=> TRUE,
					'expandSingle'		=> TRUE,
				),
				'minitems'			=> 0,
				'maxitems'			=> 999999,
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
				'autoSizeMax' => 30,
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
                'type'				=> 'inline',
				'foreign_table'		=> 'tx_hypestore_domain_model_product_stock',
				'foreign_field'		=> 'product',
				//'foreign_label'		=> 'depot',
				//'foreign_unique'	=> 'depot',
				'appearance'		=> array(
					'collapseAll'		=> TRUE,
					'expandSingle'		=> TRUE,
				),
				'minitems'			=> 0,
				'maxitems'			=> 999999,
            ),
        ),
		'states' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product.states',
            'config' => array(
                'type'				=> 'inline',
				'foreign_table'		=> 'tx_hypestore_domain_model_product_state',
				'foreign_field'		=> 'product',
				//'foreign_label'		=> 'reason',
				'appearance'		=> array(
					'collapseAll'		=> TRUE,
					'expandSingle'		=> TRUE,
				),
				'minitems'			=> 0,
				'maxitems'			=> 999999,
            ),
        ),
        'events' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product.events',
            'config' => array(
				'type'				=> 'inline',
				'foreign_table'		=> 'tx_hypestore_domain_model_product_event',
				'foreign_field'		=> 'product',
				'appearance'		=> array(
					'collapseAll'		=> TRUE,
					'expandSingle'		=> TRUE,
				),
				'minitems'			=> 0,
				'maxitems'			=> 999999,
            ),
        ),
    ),
    'types' => array(
        '0' => array('showitem' => '
			sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title;;;;2-2-2, subtitle, identifier, introduction;;;;1-1-1, description;;;richtext[]:rte_transform[mode=ts_css|imgpath=uploads/tx_hypestore/rte/];3-3-3, manufacturer;;;;1-1-1,
			
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tabs.relations,		categories, related_products;;;;1-1-1,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tabs.media,			images, files;;;;1-1-1,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tabs.prices,		flat_price, minimum_order_quantity, scaled_prices;;;;1-1-1,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tabs.attributes,	attributes,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tabs.stocks,		stock_threshold, stock_unit, stocks;;;;1-1-1,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tabs.states,		states,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tabs.events,		events
		'),
    ),
    'palettes' => array(
        '1' => array('showitem' => 'starttime, endtime, fe_group'),
    ),
);

$TCA['tx_hypestore_domain_model_product_state'] = array(
    'ctrl' => $TCA['tx_hypestore_domain_model_product_state']['ctrl'],
    'interface' => array(
        'showRecordFieldList' => 'sys_language_uid,l10n_parent,l10n_diffsource,hidden,starttime,endtime,fe_group,product,depot,quantity,disposal_date,return_date,type'
    ),
    'feInterface' => $TCA['tx_hypestore_domain_model_product_state']['feInterface'],
    'columns' => array(
        'sys_language_uid' => array(
            'exclude' => 1,
            'label'  => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
            'config' => array(
                'type'                => 'select',
                'foreign_table'       => 'sys_language',
                'foreign_table_where' => 'ORDER BY sys_language.title',
                'items' => array(
                    array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
                    array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0),
                ),
            ),
        ),
        'l10n_parent' => array(
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude'     => 1,
            'label'       => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
            'config'      => array(
                'type'  => 'select',
                'items' => array(
                    array('', 0),
                ),
                'foreign_table'       => 'tx_hypestore_state',
                'foreign_table_where' => 'AND tx_hypestore_domain_model_product_state.pid=###CURRENT_PID### AND tx_hypestore_domain_model_product_state.sys_language_uid IN (-1,0)',
            ),
        ),
        'l10n_diffsource' => array(
            'config' => array(
                'type' => 'passthrough'
            ),
        ),
        'hidden' => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
            'config'  => array(
                'type'    => 'check',
                'default' => '0'
            ),
        ),
        'starttime' => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
            'config'  => array(
                'type'     => 'input',
                'size'     => '8',
                'max'      => '20',
                'eval'     => 'date',
                'default'  => '0',
                'checkbox' => '0'
            ),
        ),
        'endtime' => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
            'config'  => array(
                'type'     => 'input',
                'size'     => '8',
                'max'      => '20',
                'eval'     => 'date',
                'checkbox' => '0',
                'default'  => '0',
                'range'    => array(
                    'upper' => mktime(3, 14, 7, 1, 19, 2038),
                    'lower' => mktime(0, 0, 0, date('m')-1, date('d'), date('Y')),
                ),
            ),
        ),
        'fe_group' => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.fe_group',
            'config'  => array(
                'type'  => 'select',
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
            'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product_state.product',
            'config' => array(
                'type' => 'select',
                'foreign_table' => 'tx_hypestore_domain_model_product',
                'foreign_table_where' => 'ORDER BY tx_hypestore_domain_model_product.uid',
                'size' => 1,
                'minitems' => 0,
                'maxitems' => 1,
            ),
        ),
        'depot' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product_state.depot',
            'config' => array(
                'type' => 'select',
                'foreign_table' => 'tx_hypestore_domain_model_depot',
                'foreign_table_where' => 'ORDER BY tx_hypestore_domain_model_depot.uid',
                'size' => 1,
                'minitems' => 0,
                'maxitems' => 1,
            ),
        ),
		'type' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product_state.type',
            'config' => array(
                'type'  => 'select',
                'items' => array(
                    array('', 0),
                    array('LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product_state.type.I.0', 0),
                    array('LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product_state.type.I.1', 1),
                    array('LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product_state.type.I.2', 2),
                ),
            ),
        ),
        'quantity' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product_state.quantity',
            'config' => array(
                'type' => 'input',
                'size' => '5',
                'eval' => 'int,required',
            ),
        ),
        'disposal_date' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product_state.disposal_date',
            'config' => array(
                'type'     => 'input',
                'size'     => '8',
                'max'      => '20',
                'eval'     => 'date',
                'checkbox' => '0',
                'default'  => '0'
            ),
        ),
        'return_date' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product_state.return_date',
            'config' => array(
                'type'     => 'input',
                'size'     => '8',
                'max'      => '20',
                'eval'     => 'date',
                'checkbox' => '0',
                'default'  => '0'
            ),
        ),
    ),
    'types' => array(
		//'0' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, product;;;;1-1-1, depot;;;;1-1-1, amount, date_from;;;;1-1-1, date_end, reason;;;;1-1-1'),
        '0' => array('showitem' => 'l10n_parent, l10n_diffsource, hidden;;1, product;;;;1-1-1, depot;;;;1-1-1, type;;;;1-1-1, quantity, disposal_date;;;;1-1-1, return_date'),
    ),
    'palettes' => array(
        '1' => array('showitem' => 'starttime, endtime, fe_group'),
    ),
);

$TCA['tx_hypestore_domain_model_product_event'] = array(
    'ctrl' => $TCA['tx_hypestore_domain_model_product_event']['ctrl'],
    'interface' => array(
        'showRecordFieldList' => 'sys_language_uid,l10n_parent,l10n_diffsource,hidden,starttime,endtime,fe_group,product,date,quantity,type'
    ),
    'feInterface' => $TCA['tx_hypestore_domain_model_product_event']['feInterface'],
    'columns' => array(
        'sys_language_uid' => array(
            'exclude' => 1,
            'label'  => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
            'config' => array(
                'type'                => 'select',
                'foreign_table'       => 'sys_language',
                'foreign_table_where' => 'ORDER BY sys_language.title',
                'items' => array(
                    array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
                    array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0),
                ),
            ),
        ),
        'l10n_parent' => array(
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude'     => 1,
            'label'       => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
            'config'      => array(
                'type'  => 'select',
                'items' => array(
                    array('', 0),
                ),
                'foreign_table'       => 'tx_hypestore_event',
                'foreign_table_where' => 'AND tx_hypestore_domain_model_product_event.pid=###CURRENT_PID### AND tx_hypestore_domain_model_product_event.sys_language_uid IN (-1,0)',
            ),
        ),
        'l10n_diffsource' => array(
            'config' => array(
                'type' => 'passthrough'
            ),
        ),
        'hidden' => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
            'config'  => array(
                'type'    => 'check',
                'default' => '0'
            ),
        ),
        'starttime' => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
            'config'  => array(
                'type'     => 'input',
                'size'     => '8',
                'max'      => '20',
                'eval'     => 'date',
                'default'  => '0',
                'checkbox' => '0'
            ),
        ),
        'endtime' => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
            'config'  => array(
                'type'     => 'input',
                'size'     => '8',
                'max'      => '20',
                'eval'     => 'date',
                'checkbox' => '0',
                'default'  => '0',
                'range'    => array(
                    'upper' => mktime(3, 14, 7, 1, 19, 2038),
                    'lower' => mktime(0, 0, 0, date('m')-1, date('d'), date('Y')),
                ),
            ),
        ),
        'fe_group' => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.fe_group',
            'config'  => array(
                'type'  => 'select',
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
            'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product_event.product',
            'config' => array(
                'type' => 'select',
                'foreign_table' => 'tx_hypestore_domain_model_product',
                'foreign_table_where' => 'ORDER BY tx_hypestore_domain_model_product.uid',
                'size' => 1,
                'minitems' => 0,
                'maxitems' => 1,
            ),
        ),
		'date' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product_event.date',
            'config' => array(
                'type'     => 'input',
                'size'     => '8',
                'max'      => '20',
                'eval'     => 'date',
                'checkbox' => '0',
                'default'  => time(),
            ),
        ),
        'quantity' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product_event.quantity',
            'config' => array(
                'type' => 'input',
                'size' => '5',
                'eval' => 'required,int',
            ),
        ),
        'type' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product_event.type',
            'config' => array(
                'type' => 'select',
                'items' => array(
                    array('LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product_event.type.I.0', '0'),
                    array('LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product_event.type.I.1', '1'),
                    array('LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product_event.type.I.2', '2'),
                ),
                'size' => 1,
                'maxitems' => 1,
            ),
        ),
    ),
    'types' => array(
        '0' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, product, date, quantity, type'),
    ),
    'palettes' => array(
        '1' => array('showitem' => 'starttime, endtime, fe_group'),
    ),
);

$TCA['tx_hypestore_domain_model_depot'] = array(
    'ctrl' => $TCA['tx_hypestore_domain_model_depot']['ctrl'],
    'interface' => array(
        'showRecordFieldList' => 'sys_language_uid,l10n_parent,l10n_diffsource,hidden,starttime,endtime,fe_group,title,street,postcode,city,country,stocks,states'
    ),
    'feInterface' => $TCA['tx_hypestore_domain_model_depot']['feInterface'],
    'columns' => array(
        'sys_language_uid' => array(
            'exclude' => 1,
            'label'  => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
            'config' => array(
                'type'                => 'select',
                'foreign_table'       => 'sys_language',
                'foreign_table_where' => 'ORDER BY sys_language.title',
                'items' => array(
                    array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
                    array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0),
                ),
            ),
        ),
        'l10n_parent' => array(
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude'     => 1,
            'label'       => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
            'config'      => array(
                'type'  => 'select',
                'items' => array(
                    array('', 0),
                ),
                'foreign_table'       => 'tx_hypestore_domain_model_depot',
                'foreign_table_where' => 'AND tx_hypestore_domain_model_depot.pid=###CURRENT_PID### AND tx_hypestore_domain_model_depot.sys_language_uid IN (-1,0)',
            ),
        ),
        'l10n_diffsource' => array(
            'config' => array(
                'type' => 'passthrough'
            ),
        ),
        'hidden' => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
            'config'  => array(
                'type'    => 'check',
                'default' => '0'
            ),
        ),
        'starttime' => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
            'config'  => array(
                'type'     => 'input',
                'size'     => '8',
                'max'      => '20',
                'eval'     => 'date',
                'default'  => '0',
                'checkbox' => '0'
            ),
        ),
        'endtime' => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
            'config'  => array(
                'type'     => 'input',
                'size'     => '8',
                'max'      => '20',
                'eval'     => 'date',
                'checkbox' => '0',
                'default'  => '0',
                'range'    => array(
                    'upper' => mktime(3, 14, 7, 1, 19, 2038),
                    'lower' => mktime(0, 0, 0, date('m')-1, date('d'), date('Y')),
                ),
            ),
        ),
        'fe_group' => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.fe_group',
            'config'  => array(
                'type'  => 'select',
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
        'stocks' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_depot.stocks',
            'config' => array(
				'type'				=> 'inline',
				'foreign_table'		=> 'tx_hypestore_domain_model_product_stock',
				'foreign_field'		=> 'depot',
				//'foreign_unique'	=> 'product',
				'appearance'		=> array(
					'collapseAll'		=> TRUE,
					'expandSingle'		=> TRUE,
				),
				'minitems'			=> 0,
				'maxitems'			=> 999999,
            ),
        ),
        'states' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_depot.states',
            'config' => array(
				'type'				=> 'inline',
				'foreign_table'		=> 'tx_hypestore_domain_model_product_state',
				'foreign_field'		=> 'depot',
				'appearance'		=> array(
					'collapseAll'		=> TRUE,
					'expandSingle'		=> TRUE,
				),
				'minitems'			=> 0,
				'maxitems'			=> 999999,
            ),
        ),
    ),
    'types' => array(
        '0' => array('showitem' => '
			sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title;;;;2-2-2, street;;;;3-3-3, postcode, city, country,
			
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tabs.stocks, stocks,
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tabs.states, states
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
            'label'  => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
            'config' => array(
                'type'                => 'select',
                'foreign_table'       => 'sys_language',
                'foreign_table_where' => 'ORDER BY sys_language.title',
                'items' => array(
                    array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
                    array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0),
                ),
            ),
        ),
        'l10n_parent' => array(
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude'     => 1,
            'label'       => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
            'config'      => array(
                'type'  => 'select',
                'items' => array(
                    array('', 0),
                ),
                'foreign_table'       => 'tx_hypestore_domain_model_product_stock',
                'foreign_table_where' => 'AND tx_hypestore_domain_model_product_stock.pid=###CURRENT_PID### AND tx_hypestore_domain_model_product_stock.sys_language_uid IN (-1,0)',
            ),
        ),
        'l10n_diffsource' => array(
            'config' => array(
                'type' => 'passthrough'
            ),
        ),
        'hidden' => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
            'config'  => array(
                'type'    => 'check',
                'default' => '0'
            ),
        ),
        'starttime' => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
            'config'  => array(
                'type'     => 'input',
                'size'     => '8',
                'max'      => '20',
                'eval'     => 'date',
                'default'  => '0',
                'checkbox' => '0'
            ),
        ),
        'endtime' => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
            'config'  => array(
                'type'     => 'input',
                'size'     => '8',
                'max'      => '20',
                'eval'     => 'date',
                'checkbox' => '0',
                'default'  => '0',
                'range'    => array(
                    'upper' => mktime(3, 14, 7, 1, 19, 2038),
                    'lower' => mktime(0, 0, 0, date('m')-1, date('d'), date('Y')),
                ),
            ),
        ),
        'fe_group' => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.fe_group',
            'config'  => array(
                'type'  => 'select',
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
                'eval' => 'int',
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

$TCA['tx_hypestore_domain_model_attribute'] = array (
    'ctrl' => $TCA['tx_hypestore_domain_model_attribute']['ctrl'],
    'interface' => array (
        'showRecordFieldList' => 'sys_language_uid,l10n_parent,l10n_diffsource,hidden,starttime,endtime,fe_group,title,unit,type'
    ),
    'feInterface' => $TCA['tx_hypestore_domain_model_attribute']['feInterface'],
    'columns' => array (
        'sys_language_uid' => array (        
            'exclude' => 1,
            'label'  => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
            'config' => array (
                'type'                => 'select',
                'foreign_table'       => 'sys_language',
                'foreign_table_where' => 'ORDER BY sys_language.title',
                'items' => array(
                    array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
                    array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0),
                ),
            ),
        ),
        'l10n_parent' => array (        
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude'     => 1,
            'label'       => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
            'config'      => array (
                'type'  => 'select',
                'items' => array (
                    array('', 0),
                ),
                'foreign_table'       => 'tx_hypestore_domain_model_attribute',
                'foreign_table_where' => 'AND tx_hypestore_domain_model_attribute.pid=###CURRENT_PID### AND tx_hypestore_domain_model_attribute.sys_language_uid IN (-1,0)',
            ),
        ),
        'l10n_diffsource' => array (        
            'config' => array (
                'type' => 'passthrough'
            ),
        ),
        'hidden' => array (        
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
            'config'  => array (
                'type'    => 'check',
                'default' => '0'
            ),
        ),
        'starttime' => array (        
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
            'config'  => array (
                'type'     => 'input',
                'size'     => '8',
                'max'      => '20',
                'eval'     => 'date',
                'default'  => '0',
                'checkbox' => '0'
            ),
        ),
        'endtime' => array (        
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
            'config'  => array (
                'type'     => 'input',
                'size'     => '8',
                'max'      => '20',
                'eval'     => 'date',
                'checkbox' => '0',
                'default'  => '0',
                'range'    => array (
                    'upper' => mktime(3, 14, 7, 1, 19, 2038),
                    'lower' => mktime(0, 0, 0, date('m')-1, date('d'), date('Y')),
                ),
            ),
        ),
        'fe_group' => array (        
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.fe_group',
            'config'  => array (
                'type'  => 'select',
                'items' => array (
                    array('', 0),
                    array('LLL:EXT:lang/locallang_general.xml:LGL.hide_at_login', -1),
                    array('LLL:EXT:lang/locallang_general.xml:LGL.any_login', -2),
                    array('LLL:EXT:lang/locallang_general.xml:LGL.usergroups', '--div--'),
                ),
                'foreign_table' => 'fe_groups'
            ),
        ),
        'title' => array (        
            'exclude' => 0,
            'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_attribute.title',
            'config' => array (
                'type' => 'input',
                'size' => '30',
                'eval' => 'required,trim',
            ),
        ),
        'unit' => array (        
            'exclude' => 0,
            'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_attribute.unit',
            'config' => array (
                'type' => 'input',
                'size' => '30',
                'eval' => 'trim',
            ),
        ),
        'type' => array (        
            'exclude' => 0,
            'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_attribute.type',
            'config' => array (
                'type' => 'select',
                'items' => array (
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
    'types' => array (
        '0' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title;;;;2-2-2, unit;;;;3-3-3, type'),
    ),
    'palettes' => array (
        '1' => array('showitem' => 'starttime, endtime, fe_group'),
    ),
);

$TCA['tx_hypestore_domain_model_product_attribute'] = array (
    'ctrl' => $TCA['tx_hypestore_domain_model_product_attribute']['ctrl'],
    'interface' => array (
        'showRecordFieldList' => 'sys_language_uid,l10n_parent,l10n_diffsource,hidden,starttime,endtime,fe_group,product,attribute,value'
    ),
    'feInterface' => $TCA['tx_hypestore_domain_model_product_attribute']['feInterface'],
    'columns' => array (
        'sys_language_uid' => array (        
            'exclude' => 1,
            'label'  => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
            'config' => array (
                'type'                => 'select',
                'foreign_table'       => 'sys_language',
                'foreign_table_where' => 'ORDER BY sys_language.title',
                'items' => array(
                    array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
                    array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0),
                ),
            ),
        ),
        'l10n_parent' => array (        
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude'     => 1,
            'label'       => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
            'config'      => array (
                'type'  => 'select',
                'items' => array (
                    array('', 0),
                ),
                'foreign_table'       => 'tx_hypestore_domain_model_product_attribute',
                'foreign_table_where' => 'AND tx_hypestore_domain_model_product_attribute.pid=###CURRENT_PID### AND tx_hypestore_domain_model_product_attribute.sys_language_uid IN (-1,0)',
            ),
        ),
        'l10n_diffsource' => array (        
            'config' => array (
                'type' => 'passthrough'
            ),
        ),
        'hidden' => array (        
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
            'config'  => array (
                'type'    => 'check',
                'default' => '0'
            ),
        ),
        'starttime' => array (        
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
            'config'  => array (
                'type'     => 'input',
                'size'     => '8',
                'max'      => '20',
                'eval'     => 'date',
                'default'  => '0',
                'checkbox' => '0'
            ),
        ),
        'endtime' => array (        
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
            'config'  => array (
                'type'     => 'input',
                'size'     => '8',
                'max'      => '20',
                'eval'     => 'date',
                'checkbox' => '0',
                'default'  => '0',
                'range'    => array (
                    'upper' => mktime(3, 14, 7, 1, 19, 2038),
                    'lower' => mktime(0, 0, 0, date('m')-1, date('d'), date('Y')),
                ),
            ),
        ),
        'fe_group' => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.fe_group',
            'config'  => array(
                'type'  => 'select',
                'items' => array (
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
            'config' => array (
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
            'config' => array (
                'type' => 'select',
                'foreign_table' => 'tx_hypestore_domain_model_attribute',
                'foreign_table_where' => 'ORDER BY tx_hypestore_domain_model_attribute.uid',
                'size' => 1,
                'minitems' => 0,
                'maxitems' => 1,
            ),
        ),
        'value' => array (        
            'exclude' => 0,
            'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product_attribute.value',
            'config' => array(
                'type' => 'input',
                'size' => '30',
                'eval' => 'required,trim',
            ),
        ),
    ),
    'types' => array (
        //'0' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, attribute, product, value'),
		'0' => array('showitem' => 'l10n_parent, l10n_diffsource, hidden;;1, attribute, product, value'),
    ),
    'palettes' => array (
        '1' => array('showitem' => 'starttime, endtime, fe_group'),
    ),
);

$TCA['tx_hypestore_domain_model_product_price'] = array (
    'ctrl' => $TCA['tx_hypestore_domain_model_product_price']['ctrl'],
    'interface' => array (
        'showRecordFieldList' => 'sys_language_uid,l10n_parent,l10n_diffsource,hidden,starttime,endtime,fe_group,product,quantity,value'
    ),
    'feInterface' => $TCA['tx_hypestore_domain_model_product_price']['feInterface'],
    'columns' => array (
        'sys_language_uid' => array (        
            'exclude' => 1,
            'label'  => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
            'config' => array (
                'type'                => 'select',
                'foreign_table'       => 'sys_language',
                'foreign_table_where' => 'ORDER BY sys_language.title',
                'items' => array(
                    array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
                    array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0),
                ),
            ),
        ),
        'l10n_parent' => array (        
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude'     => 1,
            'label'       => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
            'config'      => array (
                'type'  => 'select',
                'items' => array (
                    array('', 0),
                ),
                'foreign_table'       => 'tx_hypestore_domain_model_product_price',
                'foreign_table_where' => 'AND tx_hypestore_domain_model_product_price.pid=###CURRENT_PID### AND tx_hypestore_domain_model_product_price.sys_language_uid IN (-1,0)',
            ),
        ),
        'l10n_diffsource' => array (        
            'config' => array (
                'type' => 'passthrough'
            ),
        ),
        'hidden' => array (        
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
            'config'  => array (
                'type'    => 'check',
                'default' => '0'
            ),
        ),
        'starttime' => array (        
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
            'config'  => array (
                'type'     => 'input',
                'size'     => '8',
                'max'      => '20',
                'eval'     => 'date',
                'default'  => '0',
                'checkbox' => '0'
            ),
        ),
        'endtime' => array (        
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
            'config'  => array (
                'type'     => 'input',
                'size'     => '8',
                'max'      => '20',
                'eval'     => 'date',
                'checkbox' => '0',
                'default'  => '0',
                'range'    => array (
                    'upper' => mktime(3, 14, 7, 1, 19, 2038),
                    'lower' => mktime(0, 0, 0, date('m')-1, date('d'), date('Y')),
                ),
            ),
        ),
        'fe_group' => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.fe_group',
            'config'  => array(
                'type'  => 'select',
                'items' => array (
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
            'config' => array (
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
            'config' => array (
                'type' => 'input',
				'size' => '30',
				'eval' => 'required,int',
            ),
        ),
        'value' => array (        
            'exclude' => 0,
            'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_product_price.value',
            'config' => array(
				'type' => 'input',
				'size' => '30',
				'eval' => 'required,double2',
            ),
        ),
    ),
    'types' => array (
        //'0' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, product, quantity, value'),
		'0' => array('showitem' => 'l10n_parent, l10n_diffsource, hidden;;1, product, quantity, value'),
    ),
    'palettes' => array (
        '1' => array('showitem' => 'starttime, endtime, fe_group'),
    ),
);

$TCA['tx_hypestore_domain_model_cart_item'] = array (
    'ctrl' => $TCA['tx_hypestore_domain_model_cart_item']['ctrl'],
    'interface' => array (
        'showRecordFieldList' => 'sys_language_uid,l10n_parent,l10n_diffsource,hidden,starttime,endtime,fe_group,customer,product,quantity'
    ),
    'feInterface' => $TCA['tx_hypestore_domain_model_cart_item']['feInterface'],
    'columns' => array (
        'sys_language_uid' => array (        
            'exclude' => 1,
            'label'  => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
            'config' => array (
                'type'                => 'select',
                'foreign_table'       => 'sys_language',
                'foreign_table_where' => 'ORDER BY sys_language.title',
                'items' => array(
                    array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
                    array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0),
                ),
            ),
        ),
        'l10n_parent' => array (        
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude'     => 1,
            'label'       => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
            'config'      => array (
                'type'  => 'select',
                'items' => array (
                    array('', 0),
                ),
                'foreign_table'       => 'tx_hypestore_domain_model_product_price',
                'foreign_table_where' => 'AND tx_hypestore_domain_model_product_price.pid=###CURRENT_PID### AND tx_hypestore_domain_model_product_price.sys_language_uid IN (-1,0)',
            ),
        ),
        'l10n_diffsource' => array (        
            'config' => array (
                'type' => 'passthrough'
            ),
        ),
        'hidden' => array (        
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
            'config'  => array (
                'type'    => 'check',
                'default' => '0'
            ),
        ),
        'starttime' => array (        
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
            'config'  => array (
                'type'     => 'input',
                'size'     => '8',
                'max'      => '20',
                'eval'     => 'date',
                'default'  => '0',
                'checkbox' => '0'
            ),
        ),
        'endtime' => array (        
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
            'config'  => array (
                'type'     => 'input',
                'size'     => '8',
                'max'      => '20',
                'eval'     => 'date',
                'checkbox' => '0',
                'default'  => '0',
                'range'    => array (
                    'upper' => mktime(3, 14, 7, 1, 19, 2038),
                    'lower' => mktime(0, 0, 0, date('m')-1, date('d'), date('Y')),
                ),
            ),
        ),
        'fe_group' => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.fe_group',
            'config'  => array(
                'type'  => 'select',
                'items' => array (
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
            'config' => array (
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
            'config' => array (
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
            'config' => array (
                'type' => 'input',
				'size' => '30',
				'eval' => 'required,int',
            ),
        ),
    ),
    'types' => array (
        //'0' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, product, quantity, value'),
		'0' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, customer, product, quantity'),
    ),
    'palettes' => array (
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
            'label'  => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
            'config' => array(
                'type'                => 'select',
                'foreign_table'       => 'sys_language',
                'foreign_table_where' => 'ORDER BY sys_language.title',
                'items' => array(
                    array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
                    array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0),
                ),
            ),
        ),
        'l10n_parent' => array(
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude'     => 1,
            'label'       => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
            'config'      => array(
                'type'  => 'select',
                'items' => array(
                    array('', 0),
                ),
                'foreign_table'       => 'tx_hypestore_domain_model_category',
                'foreign_table_where' => 'AND tx_hypestore_domain_model_category.pid=###CURRENT_PID### AND tx_hypestore_domain_model_category.sys_language_uid IN (-1,0)',
            ),
        ),
        'l10n_diffsource' => array(
            'config' => array(
                'type' => 'passthrough'
            ),
        ),
        'hidden' => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
            'config'  => array(
                'type'    => 'check',
                'default' => '0'
            ),
        ),
        'starttime' => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
            'config'  => array(
                'type'     => 'input',
                'size'     => '8',
                'max'      => '20',
                'eval'     => 'date',
                'default'  => '0',
                'checkbox' => '0'
            ),
        ),
        'endtime' => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
            'config'  => array(
                'type'     => 'input',
                'size'     => '8',
                'max'      => '20',
                'eval'     => 'date',
                'checkbox' => '0',
                'default'  => '0',
                'range'    => array(
                    'upper' => mktime(3, 14, 7, 1, 19, 2038),
                    'lower' => mktime(0, 0, 0, date('m')-1, date('d'), date('Y')),
                ),
            ),
        ),
        'fe_group' => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.fe_group',
            'config'  => array(
                'type'  => 'select',
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
            'config' => array (
                'type' => 'select',
                'foreign_table' => 'fe_users',
                'size' => 1,
                'minitems' => 1,
                'maxitems' => 1,
            ),
		),
		'title' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_customer_address.title',
            'config' => array(
                'type' => 'input',
                'size' => '30',
                'eval' => 'trim',
            ),
        ),
        'name' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_customer_address.name',
            'config' => array(
                'type' => 'input',
                'size' => '30',
                'eval' => 'trim',
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
                'eval' => 'trim',
            ),
        ),
		'stair' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_customer_address.stair',
            'config' => array(
                'type' => 'input',
                'size' => '30',
                'eval' => 'trim',
            ),
        ),
		'floor' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_customer_address.floor',
            'config' => array(
                'type' => 'input',
                'size' => '30',
                'eval' => 'trim',
            ),
        ),
		'door' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_customer_address.door',
            'config' => array(
                'type' => 'input',
                'size' => '30',
                'eval' => 'trim',
            ),
        ),
		'postcode' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_customer_address.postcode',
            'config' => array(
                'type' => 'input',
                'size' => '30',
                'eval' => 'trim',
            ),
        ),
		'city' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_customer_address.city',
            'config' => array(
                'type' => 'input',
                'size' => '30',
                'eval' => 'trim',
            ),
        ),
		'country' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_customer_address.country',
            'config' => array(
                'type' => 'input',
                'size' => '30',
                'eval' => 'trim',
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
			sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1,customer,title,name,company,street,stair,floor,door,postcode,city,country,telephone_number
		'),
    ),
    'palettes' => array(
        '1' => array('showitem' => 'starttime, endtime, fe_group'),
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
            'label'  => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
            'config' => array(
                'type'                => 'select',
                'foreign_table'       => 'sys_language',
                'foreign_table_where' => 'ORDER BY sys_language.title',
                'items' => array(
                    array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
                    array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0),
                ),
            ),
        ),
        'l10n_parent' => array(
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude'     => 1,
            'label'       => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
            'config'      => array(
                'type'  => 'select',
                'items' => array(
                    array('', 0),
                ),
                'foreign_table'       => 'tx_hypestore_domain_model_depot',
                'foreign_table_where' => 'AND tx_hypestore_domain_model_depot.pid=###CURRENT_PID### AND tx_hypestore_domain_model_depot.sys_language_uid IN (-1,0)',
            ),
        ),
        'l10n_diffsource' => array(
            'config' => array(
                'type' => 'passthrough'
            ),
        ),
        'hidden' => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
            'config'  => array(
                'type'    => 'check',
                'default' => '0'
            ),
        ),
        'starttime' => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
            'config'  => array(
                'type'     => 'input',
                'size'     => '8',
                'max'      => '20',
                'eval'     => 'date',
                'default'  => '0',
                'checkbox' => '0'
            ),
        ),
        'endtime' => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
            'config'  => array(
                'type'     => 'input',
                'size'     => '8',
                'max'      => '20',
                'eval'     => 'date',
                'checkbox' => '0',
                'default'  => '0',
                'range'    => array(
                    'upper' => mktime(3, 14, 7, 1, 19, 2038),
                    'lower' => mktime(0, 0, 0, date('m')-1, date('d'), date('Y')),
                ),
            ),
        ),
        'fe_group' => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.fe_group',
            'config'  => array(
                'type'  => 'select',
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
            'config' => array (
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

$TCA['tx_hypestore_domain_model_manufacturer'] = array(
    'ctrl' => $TCA['tx_hypestore_domain_model_manufacturer']['ctrl'],
    'interface' => array(
        'showRecordFieldList' => 'sys_language_uid,l10n_parent,l10n_diffsource,hidden,starttime,endtime,fe_group,title,street,postcode,city,country,telephone,telefax,email,website,products'
    ),
    'feInterface' => $TCA['tx_hypestore_domain_model_manufacturer']['feInterface'],
    'columns' => array(
        'sys_language_uid' => array(
            'exclude' => 1,
            'label'  => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
            'config' => array(
                'type'                => 'select',
                'foreign_table'       => 'sys_language',
                'foreign_table_where' => 'ORDER BY sys_language.title',
                'items' => array(
                    array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
                    array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0),
                ),
            ),
        ),
        'l10n_parent' => array(
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude'     => 1,
            'label'       => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
            'config'      => array(
                'type'  => 'select',
                'items' => array(
                    array('', 0),
                ),
                'foreign_table'       => 'tx_hypestore_domain_model_depot',
                'foreign_table_where' => 'AND tx_hypestore_domain_model_depot.pid=###CURRENT_PID### AND tx_hypestore_domain_model_depot.sys_language_uid IN (-1,0)',
            ),
        ),
        'l10n_diffsource' => array(
            'config' => array(
                'type' => 'passthrough'
            ),
        ),
        'hidden' => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
            'config'  => array(
                'type'    => 'check',
                'default' => '0'
            ),
        ),
        'starttime' => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
            'config'  => array(
                'type'     => 'input',
                'size'     => '8',
                'max'      => '20',
                'eval'     => 'date',
                'default'  => '0',
                'checkbox' => '0'
            ),
        ),
        'endtime' => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
            'config'  => array(
                'type'     => 'input',
                'size'     => '8',
                'max'      => '20',
                'eval'     => 'date',
                'checkbox' => '0',
                'default'  => '0',
                'range'    => array(
                    'upper' => mktime(3, 14, 7, 1, 19, 2038),
                    'lower' => mktime(0, 0, 0, date('m')-1, date('d'), date('Y')),
                ),
            ),
        ),
        'fe_group' => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.fe_group',
            'config'  => array(
                'type'  => 'select',
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
            'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_manufacturer.title',
            'config' => array(
                'type' => 'input',
                'size' => '30',
                'eval' => 'required,trim',
            ),
        ),
        'street' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_manufacturer.street',
            'config' => array(
                'type' => 'input',
                'size' => '30',
                'eval' => 'trim',
            ),
        ),
        'postcode' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_manufacturer.postcode',
            'config' => array(
                'type' => 'input',
                'size' => '30',
                'eval' => 'int',
            ),
        ),
        'city' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_manufacturer.city',
            'config' => array(
                'type' => 'input',
                'size' => '30',
                'eval' => 'trim',
            ),
        ),
        'country' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_manufacturer.country',
            'config' => array(
                'type' => 'input',
                'size' => '30',
                'eval' => 'trim',
            ),
        ),
		'telephone' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_manufacturer.telephone',
            'config' => array(
                'type' => 'input',
                'size' => '30',
                'eval' => 'trim',
            ),
        ),
		'telefax' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_manufacturer.telefax',
            'config' => array(
                'type' => 'input',
                'size' => '30',
                'eval' => 'trim',
            ),
        ),
		'email' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_manufacturer.email',
            'config' => array(
                'type' => 'input',
                'size' => '30',
                'eval' => 'trim',
            ),
        ),
		'website' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_manufacturer.website',
            'config' => array(
                'type' => 'input',
                'size' => '30',
                'eval' => 'trim',
            ),
        ),
        'products' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore_domain_model_manufacturer.products',
            'config' => array(
				'type'				=> 'inline',
				'foreign_table'		=> 'tx_hypestore_domain_model_product',
				'foreign_field'		=> 'manufacturer',
				'appearance'		=> array(
					'collapseAll'		=> TRUE,
					'expandSingle'		=> TRUE,
				),
				'minitems'			=> 0,
				'maxitems'			=> 999999,
            ),
        ),
    ),
    'types' => array(
        '0' => array('showitem' => '
			sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title;;;;1-1-1, street;;;;1-1-1, postcode, city, country, telephone;;;;1-1-1, telefax, email, website,
			
			--div--;LLL:EXT:hype_store/Resources/Private/Language/locallang_db.xml:tx_hypestore.tabs.products, products
		'),
    ),
    'palettes' => array(
        '1' => array('showitem' => 'starttime, endtime, fe_group'),
    ),
);

?>