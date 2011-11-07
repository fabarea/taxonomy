<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['sys_category'] = array(
	'ctrl' => $TCA['sys_category']['ctrl'],
	'interface' => array(
		'showRecordFieldList'	=> 'label,description',
	),
	'types' => array(
		'1' => array('showitem'	=> 'label;;1, parent,description,items,--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem'	=> 'sys_language_uid, l10n_parent, hidden'),
	),
	'columns' => array(
		'sys_language_uid' => array(
			'exclude'			=> 1,
			'label'				=> 'LLL:EXT:lang/locallang_general.php:LGL.language',
			'config'			=> array(
				'type'					=> 'select',
				'foreign_table'			=> 'sys_language',
				'foreign_table_where'	=> 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.php:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.php:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond'	=> 'FIELD:sys_language_uid:>:0',
			'exclude'		=> 1,
			'label'			=> 'LLL:EXT:lang/locallang_general.php:LGL.l18n_parent',
			'config'		=> array(
				'type'			=> 'select',
				'items'			=> array(
					array('', 0),
				),
				'foreign_table' => 'tx_taxonomy_domain_model_concept',
				'foreign_table_where' => 'AND tx_taxonomy_domain_model_concept.uid=###REC_FIELD_l10n_parent### AND tx_taxonomy_domain_model_concept.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config'		=>array(
				'type'		=>'passthrough',
			),
		),
		't3ver_label' => array(
			'displayCond'	=> 'FIELD:t3ver_label:REQ:true',
			'label'			=> 'LLL:EXT:lang/locallang_general.php:LGL.versionLabel',
			'config'		=> array(
				'type'		=>'none',
				'cols'		=> 27,
			),
		),
		'hidden' => array(
			'exclude'	=> 1,
			'label'		=> 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'	=> array(
				'type'	=> 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => '10',
				'max' => '20',
				'eval' => 'datetime',
				'checkbox' => '0',
				'default' => '0',
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => '8',
				'max' => '20',
				'eval' => 'datetime',
				'checkbox' => '0',
				'default' => '0',
				'range' => array(
					'upper' => mktime(0,0,0,12,31,date('Y')+10),
					'lower' => mktime(0,0,0,date('m')-1,date('d'),date('Y'))
				),
			),
		),
		'label' => array(
			'exclude'	=> 0,
			'label'		=> 'LLL:EXT:taxonomy/Resources/Private/Language/locallang_db.xml:sys_category.label',
			'config'	=> array(
				'type' => 'input',
				'width'=> '200',
				'eval' => 'trim,required'
			),
		),
		'parent' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:taxonomy/Resources/Private/Language/locallang_db.xml:sys_category.parent',
			'config' => array(
				'minitems' => 0,
				'maxitems' => 1,
				
				
				'type' => 'select',
				'renderMode' => 'tree',
				'foreign_table' => 'sys_category',
				'treeConfig' => array(
					'parentField' => 'parent'
				),
			),
		),
		'description' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:taxonomy/Resources/Private/Language/locallang_db.xml:sys_category.description',
			'config' => array(
				'type' => 'text',
			),
		),
		'items' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:taxonomy/Resources/Private/Language/locallang_db.xml:sys_category.items',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'db',
				'allowed' => '*',
				'MM' => 'sys_category_record_mm',
				'MM_hasUidField' => true,
				'show_thumbs' => false,
				//'disable_controls' => 'browser,list,upload'
			)
		)
	),
);
?>