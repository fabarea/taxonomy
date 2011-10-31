<?php
if (!defined ('TYPO3_MODE')){
	die ('Access denied.');
}
t3lib_extMgm::allowTableOnStandardPages('sys_category');
$TCA['tx_taxonomy_domain_model_concept'] = array(
	'ctrl' => array(
		'title'				=> 'LLL:EXT:taxonomy/Resources/Private/Language/locallang_db.xml:sys_category',
		'label' 			=> 'label',
		'tstamp' 			=> 'tstamp',
		'crdate' 			=> 'crdate',
		'dividers2tabs' => true,
		'versioningWS' 		=> 2,
		'versioning_followPages'	=> TRUE,
		'origUid' 			=> 't3_origuid',
		'languageField' 	=> 'sys_language_uid',
		'transOrigPointerField' 	=> 'l10n_parent',
		'transOrigDiffSourceField' 	=> 'l10n_diffsource',
		'delete' 			=> 'deleted',
		'enablecolumns' 	=> array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
			),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Category.php',
		'iconfile' 			=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/concept.png'
	),
);




?>