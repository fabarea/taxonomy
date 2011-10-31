<?php

########################################################################
# Extension Manager/Repository config file for ext "taxonomy".
#
# Auto generated 31-10-2011 13:34
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Taxonomy',
	'description' => 'This extension enables you to build a complex taxonomy based on the SKOS meta model. SKOS is a w3c recommendation and thus a reliable industry standard for describing concepts.',
	'category' => 'plugin',
	'author' => 'Jochen Rau',
	'author_email' => 'jochen.rau@typoplanet.de',
	'author_company' => 'typoplanet',
	'shy' => '',
	'dependencies' => 'cms,extbase,fluid',
	'conflicts' => '',
	'priority' => '',
	'module' => '',
	'state' => 'alpha',
	'internal' => '',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 0,
	'lockType' => '',
	'version' => '1.0.0',
	'constraints' => array(
		'depends' => array(
			'cms' => '',
			'extbase' => '',
			'fluid' => '',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'suggests' => array(
	),
	'_md5_values_when_last_written' => 'a:15:{s:16:"ext_autoload.php";s:4:"d0e7";s:12:"ext_icon.gif";s:4:"e922";s:17:"ext_localconf.php";s:4:"8116";s:14:"ext_tables.php";s:4:"74c6";s:14:"ext_tables.sql";s:4:"3880";s:28:"ext_typoscript_constants.txt";s:4:"d41d";s:24:"ext_typoscript_setup.txt";s:4:"e96e";s:33:"Classes/Domain/Model/Category.php";s:4:"3b8b";s:48:"Classes/Domain/Repository/CategoryRepository.php";s:4:"13a1";s:30:"Configuration/TCA/Category.php";s:4:"d0c9";s:43:"Resources/Private/Language/locallang_db.xml";s:4:"0d14";s:34:"Resources/Public/Icons/concept.gif";s:4:"d8b2";s:34:"Resources/Public/Icons/concept.png";s:4:"8205";s:35:"Resources/Public/Icons/relation.gif";s:4:"e615";s:34:"Tests/Domain/Model/ConceptTest.php";s:4:"d404";}',
);

?>