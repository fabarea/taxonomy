<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

	// Register a hook for the extension manager
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['typo3/mod/tools/em/index.php']['checkDBupdates'][] = 'EXT:taxonomy/Classes/Service/Hook/SqlTableExtension.php:Tx_Taxonomy_Service_Hook_SqlTableExtension';

	// Register a hook for the install tool
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install/mod/class.tx_install.php']['checkTheDatabase'][] = 'EXT:taxonomy/Classes/Service/Hook/SqlTableExtension.php:Tx_Taxonomy_Service_Hook_SqlTableExtension';

	// Register a hook for TCA post-processing
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['GLOBAL']['extTablesInclusion-PostProcessing'][] = 'EXT:taxonomy/Classes/Service/Hook/TcaTableExtension.php:Tx_Taxonomy_Service_Hook_TcaTableExtension';

?>