<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_taxonomy_domain_model_relationtype'] = array(
	'ctrl' => $TCA['tx_taxonomy_domain_model_relationtype']['ctrl'],
	'interface' => array(
		'showRecordFieldList'	=> 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, tx_extbase_type, name, description',
	),
	'types' => array(
		'1' => array('showitem'	=> 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, tx_extbase_type, name, description,--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem'	=> ''),
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
				'foreign_table' => 'tx_taxonomy_domain_model_relationtype',
				'foreign_table_where' => 'AND tx_taxonomy_domain_model_relationtype.uid=###REC_FIELD_l10n_parent### AND tx_taxonomy_domain_model_relationtype.sys_language_uid IN (-1,0)',
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
		'tx_extbase_type' => array(
			'exclude' => 1,
			'label'   => 'LLL:EXT:taxonomy/Resources/Private/Language/locallang_db.xml:tx_taxonomy_domain_model_relationtype.tx_extbase_type',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('LLL:EXT:taxonomy/Resources/Private/Language/locallang_db.xml:tx_taxonomy_domain_model_relationtype.tx_extbase_type.Tx_Taxonomy_Domain_Model_SemanticRelationType', 'Tx_Taxonomy_Domain_Model_SemanticRelationType'),
					array('LLL:EXT:taxonomy/Resources/Private/Language/locallang_db.xml:tx_taxonomy_domain_model_relationtype.tx_extbase_type.Tx_Taxonomy_Domain_Model_LabelRelationType', 'Tx_Taxonomy_Domain_Model_LabelRelationType')
				),
				'size' => 1,
				'maxitems' => 1,
				'default' => 'Tx_Taxonomy_Domain_Model_SemanticRelationType'
			)
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
		'name' => array(
			'exclude'	=> 0,
			'label'		=> 'LLL:EXT:taxonomy/Resources/Private/Language/locallang_db.xml:tx_taxonomy_domain_model_relationtype.name',
			'config'	=> array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'description' => array(
			'exclude'	=> 0,
			'label'		=> 'LLL:EXT:taxonomy/Resources/Private/Language/locallang_db.xml:tx_taxonomy_domain_model_relationtype.description',
			'config'	=> array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
	),
);
## KICKSTARTER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the kickstarter
?>