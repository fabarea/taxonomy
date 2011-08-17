<?php
if (!defined ('TYPO3_MODE')){
	die ('Access denied.');
}

// Override ExtJS Theme for ExtJS 4 compatibility
// @todo: remove this hook when TYPO3 v4 will be compatible with ExtJS 4
if ($GLOBALS['_GET']['M'] == 'user_TaxonomyTxTaxonomyM1') {
	$GLOBALS['TBE_STYLES']['extJS']['theme'] = t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Libraries/ExtJS/resources/css/ext-all-gray.css';
}

if (TYPO3_MODE === 'BE') {

	/**
	 * Registers a Backend Module
	 */
	Tx_Extbase_Utility_Extension::registerModule(
		$_EXTKEY,
		'user',	 // Make module a submodule of 'web'
		'tx_taxonomy_m1',	// Submodule key
		'',						// Position
		array(
			# list, show, new, create, edit, update, delete
			'Concept' => 'list', 
		),
		array(
			'access' => 'user,group',
			'icon'   => 'EXT:' . $_EXTKEY . '/ext_icon.gif',
			'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_admin.xml',
		)
	);
}

t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Taxonomy');


t3lib_extMgm::addLLrefForTCAdescr('tx_taxonomy_domain_model_conceptscheme', 'EXT:taxonomy/Resources/Private/Language/locallang_csh_tx_taxonomy_domain_model_conceptscheme.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_taxonomy_domain_model_conceptscheme');
$TCA['tx_taxonomy_domain_model_conceptscheme'] = array(
	'ctrl' => array(
		'title'				=> 'LLL:EXT:taxonomy/Resources/Private/Language/locallang_db.xml:tx_taxonomy_domain_model_conceptscheme',
		'label' 			=> 'concepts',
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
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/ConceptScheme.php',
		'iconfile' 			=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_taxonomy_domain_model_conceptscheme.gif'
	),
);

t3lib_extMgm::addLLrefForTCAdescr('tx_taxonomy_domain_model_concept', 'EXT:taxonomy/Resources/Private/Language/locallang_csh_tx_taxonomy_domain_model_concept.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_taxonomy_domain_model_concept');
$TCA['tx_taxonomy_domain_model_concept'] = array(
	'ctrl' => array(
		'title'				=> 'LLL:EXT:taxonomy/Resources/Private/Language/locallang_db.xml:tx_taxonomy_domain_model_concept',
		'label' 			=> 'pref_label',
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
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Concept.php',
		'iconfile' 			=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Media/Icons/concept.png'
	),
);

t3lib_extMgm::addLLrefForTCAdescr('tx_taxonomy_domain_model_lexicallabel', 'EXT:taxonomy/Resources/Private/Language/locallang_csh_tx_taxonomy_domain_model_lexicallabel.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_taxonomy_domain_model_lexicallabel');
$TCA['tx_taxonomy_domain_model_lexicallabel'] = array(
	'ctrl' => array(
		'title'				=> 'LLL:EXT:taxonomy/Resources/Private/Language/locallang_db.xml:tx_taxonomy_domain_model_lexicallabel',
		'label' 			=> 'tx_taxonomy_value',
		'tstamp' 			=> 'tstamp',
		'crdate' 			=> 'crdate',
		'dividers2tabs' => true,
		'versioningWS' 		=> 2,
		'versioning_followPages'	=> TRUE,
		'origUid' 			=> 't3_origuid',
		'languageField' 	=> 'sys_language_uid',
		'transOrigPointerField' 	=> 'l10n_parent',
		'transOrigDiffSourceField' 	=> 'l10n_diffsource',
		'type'				=> 'tx_extbase_type',
		'delete' 			=> 'deleted',
		'enablecolumns' 	=> array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
			),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/LexicalLabel.php',
		'iconfile' 			=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_taxonomy_domain_model_lexicallabel.gif'
	),
);

t3lib_extMgm::addLLrefForTCAdescr('tx_taxonomy_domain_model_collection', 'EXT:taxonomy/Resources/Private/Language/locallang_csh_tx_taxonomy_domain_model_collection.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_taxonomy_domain_model_collection');
$TCA['tx_taxonomy_domain_model_collection'] = array(
	'ctrl' => array(
		'title'				=> 'LLL:EXT:taxonomy/Resources/Private/Language/locallang_db.xml:tx_taxonomy_domain_model_collection',
		'label' 			=> 'ordered',
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
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Collection.php',
		'iconfile' 			=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_taxonomy_domain_model_collection.gif'
	),
);

t3lib_extMgm::addLLrefForTCAdescr('tx_taxonomy_domain_model_relationtype', 'EXT:taxonomy/Resources/Private/Language/locallang_csh_tx_taxonomy_domain_model_relationtype.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_taxonomy_domain_model_relationtype');
$TCA['tx_taxonomy_domain_model_relationtype'] = array(
	'ctrl' => array(
		'title'				=> 'LLL:EXT:taxonomy/Resources/Private/Language/locallang_db.xml:tx_taxonomy_domain_model_relationtype',
		'label' 			=> 'name',
		'tstamp' 			=> 'tstamp',
		'crdate' 			=> 'crdate',
		'dividers2tabs' => true,
		'versioningWS' 		=> 2,
		'versioning_followPages'	=> TRUE,
		'origUid' 			=> 't3_origuid',
		'languageField' 	=> 'sys_language_uid',
		'transOrigPointerField' 	=> 'l10n_parent',
		'transOrigDiffSourceField' 	=> 'l10n_diffsource',
		'type'				=> 'tx_extbase_type',
		'delete' 			=> 'deleted',
		'enablecolumns' 	=> array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
			),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/RelationType.php',
		'iconfile' 			=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_taxonomy_domain_model_relationtype.gif'
	),
);

t3lib_extMgm::addLLrefForTCAdescr('tx_taxonomy_domain_model_note', 'EXT:taxonomy/Resources/Private/Language/locallang_csh_tx_taxonomy_domain_model_note.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_taxonomy_domain_model_note');
$TCA['tx_taxonomy_domain_model_note'] = array(
	'ctrl' => array(
		'title'				=> 'LLL:EXT:taxonomy/Resources/Private/Language/locallang_db.xml:tx_taxonomy_domain_model_note',
		'label' 			=> 'type',
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
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Note.php',
		'iconfile' 			=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_taxonomy_domain_model_note.gif'
	),
);

?>