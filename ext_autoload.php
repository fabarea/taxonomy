<?php
/*
 * Register necessary class names with autoloader
 *
 * $Id: $
 */
return array(
	'tx_taxonomy_service_extdirect_controller_abstracthandler' => t3lib_extMgm::extPath('taxonomy', 'Classes/Service/ExtDirect/Controller/AbstractHandler.php'),
	'tx_taxonomy_domain_repository_conceptrepository' => t3lib_extMgm::extPath('taxonomy', 'Classes/Domain/Repository/ConceptRepository.php'),
	'tx_taxonomy_domain_model_concept' => t3lib_extMgm::extPath('taxonomy', 'Classes/Domain/Model/Concept.php'),
	'tx_taxonomy_service_extdirect_controller_abstractdataprovider' => t3lib_extMgm::extPath('taxonomy', 'Classes/Service/ExtDirect/Controller/AbstractDataProvider.php'),
	'tx_taxonomy_service_extdirect_controller_dataprovider' => t3lib_extMgm::extPath('taxonomy', 'Classes/Service/ExtDirect/Controller/DataProvider.php'),
	'tx_taxonomy_service_extdirect_controller_abstracttree' => t3lib_extMgm::extPath('taxonomy', 'Classes/Service/ExtDirect/Controller/AbstractTree.php'),
	'tx_taxonomy_service_extdirect_controller_tree' => t3lib_extMgm::extPath('taxonomy', 'Classes/Service/ExtDirect/Controller/Tree.php'),
);
?>
