<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

//Tx_Extbase_Utility_Extension::configurePlugin(
//	$_EXTKEY,
//	'Admin',
//	array(
//		'ConceptScheme' => 'list, show, new, create, edit, update, delete',
//		'Concept' => 'list, show, new, create, edit, update, delete',
//		'LexicalLabel' => 'list, show, new, create, edit, update, delete',
//		'Collection' => 'list, show, new, create, edit, update, delete',
//		'LabelRelationType' => 'list, show, new, create, edit, update, delete',
//		'SemanticRelationType' => 'list, show, new, create, edit, update, delete',
//	),
//	array(
//		'ConceptScheme' => 'create, update, delete',
//		'Concept' => 'create, update, delete',
//		'LexicalLabel' => 'create, update, delete',
//		'Collection' => 'create, update, delete',
//		'LabelRelationType' => 'create, update, delete',
//		'SemanticRelationType' => 'create, update, delete',
//	)
//);


// Hook only available for ExtJS 4 compatibility
// @todo: remove this hook when TYPO3 v4 will be compatible with ExtJS 4
if ($GLOBALS['_GET']['M'] == 'user_TaxonomyTxTaxonomyM1') {
	$GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['t3lib/class.t3lib_pagerenderer.php'] = t3lib_extMgm::extPath($_EXTKEY) . 'Classes/Xclass/class.ux_t3lib_pagerenderer.php';
}

// Register ExtDirect Endpoint 
t3lib_extMgm::registerExtDirectComponent(
    'TYPO3.Taxonomy.Service.ExtDirect.Controller.RecordController',
    'EXT:taxonomy/Classes/Service/ExtDirect/Controller/ConceptController.php:Tx_Taxonomy_Service_ExtDirect_Controller_ConceptController'
);

// @todo: registration should be Object Oriented via t3lib_extMgm, for instance
// Register JavaScript Dynamic File Loading through RequireJS
// Note: key "Taxonomy" is the name of the extension in a camel case syntax
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['RequireJS']['Taxonomy'] = Array(
	
	// Files to be loaded
	// Note: files must be prefixed by their Camel Upper Case Extension Key
	//       the path will be resolved by RequireJS
	'Files' => Array (
		'Taxonomy/Core/Application', 
		'Taxonomy/Module/UserInterfaceModule',
		'Taxonomy/Module/ConceptModule',
		'Taxonomy/Utils',
	),

	// Default Path relative to the extension
	'Path' => 'Resources/Public/JavaScript/',
	
	// Code to launch the Application
	'JavaScriptCode' => Array(
		'Application.run();'
	)
);

?>