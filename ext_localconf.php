<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'Admin',
	array(
		'ConceptScheme' => 'list, show, new, create, edit, update, delete',
		'Concept' => 'list, show, new, create, edit, update, delete',
		'LexicalLabel' => 'list, show, new, create, edit, update, delete',
		'Collection' => 'list, show, new, create, edit, update, delete',
		'LabelRelationType' => 'list, show, new, create, edit, update, delete',
		'SemanticRelationType' => 'list, show, new, create, edit, update, delete',
	),
	array(
		'ConceptScheme' => 'create, update, delete',
		'Concept' => 'create, update, delete',
		'LexicalLabel' => 'create, update, delete',
		'Collection' => 'create, update, delete',
		'LabelRelationType' => 'create, update, delete',
		'SemanticRelationType' => 'create, update, delete',
	)
);

t3lib_extMgm::registerExtDirectComponent(
    'TYPO3.Taxonomy.ExtDirect',
    'EXT:taxonomy/Classes/ExtDirect/Server.php:Tx_Taxonomy_ExtDirect_Server'
);
?>