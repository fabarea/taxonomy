<?php
/*
 * Register necessary class names with autoloader
 *
 * $Id: $
 */
return array(
	'tx_taxonomy_extdirect_abstracthandler' => t3lib_extMgm::extPath('taxonomy', 'Classes/ExtDirect/AbstractHandler.php'),
	'tx_taxonomy_domain_repository_conceptrepository' => t3lib_extMgm::extPath('taxonomy', 'Classes/Domain/Repository/ConceptRepository.php'),
	'tx_taxonomy_domain_model_concept' => t3lib_extMgm::extPath('taxonomy', 'Classes/Domain/Model/Concept.php'),
	'tx_taxonomy_extdirect_abstractdataprovider' => t3lib_extMgm::extPath('taxonomy', 'Classes/ExtDirect/AbstractDataProvider.php'),
	'tx_taxonomy_extdirect_dataprovider' => t3lib_extMgm::extPath('taxonomy', 'Classes/ExtDirect/DataProvider.php'),
	'tx_taxonomy_extdirect_abstracttree' => t3lib_extMgm::extPath('taxonomy', 'Classes/ExtDirect/AbstractTree.php'),
	'tx_taxonomy_extdirect_tree' => t3lib_extMgm::extPath('taxonomy', 'Classes/ExtDirect/Tree.php'),
);
?>
