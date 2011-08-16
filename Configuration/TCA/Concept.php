<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_taxonomy_domain_model_concept'] = array(
	'ctrl' => $TCA['tx_taxonomy_domain_model_concept']['ctrl'],
	'interface' => array(
		'showRecordFieldList'	=> 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, pref_label, alt_labels, hidden_labels, notes, parent',
	),
	'types' => array(
		'1' => array('showitem'	=> 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden, pref_label;;1, notes, parent,--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem'	=> 'alt_labels, hidden_labels'),
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
		'pref_label' => array(
			'exclude'	=> 0,
			'label'		=> 'LLL:EXT:taxonomy/Resources/Private/Language/locallang_db.xml:tx_taxonomy_domain_model_concept.pref_label',
			'config'	=> array(
				'type' => 'inline',
				'foreign_table' => 'tx_taxonomy_domain_model_lexicallabel',
				'minitems' => 0,
				'maxitems' => 1,
				'appearance' => array(
					'collapse' => 0,
					'newRecordLinkPosition' => 'bottom',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),
		),
		'alt_labels' => array(
			'exclude'	=> 0,
			'label'		=> 'LLL:EXT:taxonomy/Resources/Private/Language/locallang_db.xml:tx_taxonomy_domain_model_concept.alt_labels',
			'config'	=> array(
				'type' => 'inline',
				'foreign_table' => 'tx_taxonomy_domain_model_lexicallabel',
				'foreign_field' => 'concept',
				'maxitems'      => 9999,
				'appearance' => array(
					'collapse' => 0,
					'newRecordLinkPosition' => 'bottom',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),
		),
//		'hidden_labels' => array(
//			'exclude'	=> 0,
//			'label'		=> 'LLL:EXT:taxonomy/Resources/Private/Language/locallang_db.xml:tx_taxonomy_domain_model_concept.hidden_labels',
//			'config'	=> array(
//				'type' => 'inline',
//				'foreign_table' => 'tx_taxonomy_domain_model_lexicallabel',
//				'foreign_field' => 'concept',
//				'maxitems'      => 9999,
//				'appearance' => array(
//					'collapse' => 0,
//					'newRecordLinkPosition' => 'bottom',
//					'showSynchronizationLink' => 1,
//					'showPossibleLocalizationRecords' => 1,
//					'showAllLocalizationLink' => 1
//				),
//			),
//		),
		
		'parent' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:taxonomy/Resources/Private/Language/locallang_db.xml:tx_taxonomy_domain_model_concept.parent',
			'config' => array(
				'minitems' => 0,
				'maxitems' => 1,
				
				
				'type' => 'group',
				'internal_type' => 'db',
				'allowed' => 'tx_taxonomy_domain_model_concept',
				
				'wizards' => array(
					'_PADDING' => 1,
					'_VERTICAL' => 0,
					'edit' => array(
						'type' => 'popup',
						'title' => 'Edit',
						'script' => 'wizard_edit.php',
						'icon' => 'edit2.gif',
						'popup_onlyOpenIfSelected' => 1,
						'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
						),
					'add' => Array(
						'type' => 'script',
						'title' => 'Create new',
						'icon' => 'add.gif',
						'params' => array(
							'table'=> 'tx_taxonomy_domain_model_concept',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
							),
						'script' => 'wizard_add.php',
					),
					'suggest' => array(    
						'type' => 'suggest',
					),
				),
			),
		),
		'notes' => array(
			'exclude'	=> 0,
			'label'		=> 'LLL:EXT:taxonomy/Resources/Private/Language/locallang_db.xml:tx_taxonomy_domain_model_concept.notes',
			'config'	=> array(
				'type' => 'inline',
				'foreign_table' => 'tx_taxonomy_domain_model_note',
				'foreign_field' => 'concept',
				'maxitems'      => 9999,
				'appearance' => array(
					'collapse' => 0,
					'newRecordLinkPosition' => 'bottom',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),
		),
	),
);
## KICKSTARTER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the kickstarter









?>