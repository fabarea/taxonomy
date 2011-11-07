<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2011 Thomas Maroschik <tmaroschik@dfau.de>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *  A copy is found in the textfile GPL.txt and important notices to the license
 *  from the author is found in LICENSE.txt distributed with these scripts.
 *
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Hooks for TYPO3 Extension Manager.
 *
 * @author Thomas Maroschik <tmaroschik@dfau.de>
 * @author Steffen Ritter <steffen.ritter@typo3.org>
 *
 * @package TYPO3
 * @subpackage taxonomy
 */
class Tx_Taxonomy_Service_Hook_SqlTableExtension implements tx_em_Index_CheckDatabaseUpdatesHook, Tx_Install_Interfaces_CheckTheDatabaseHook {

	/**
	 * array of all table-names, which have TCA definition
	 *
	 * @var string[]
	 */
	protected $tcaTables = array();

	/**
	 * SQL String Template
	 */
	protected $sqlTemplate = <<<EOF

CREATE TABLE ###TABLE_NAME### (
	sys_category int(11) DEFAULT '0' NOT NULL
);

EOF;


	public function __construct() {
	}

	/**
	 * Hook that allows pre-processing of database structure modifications.
	 * The hook implementation may return a user form that will temporarily
	 * replace the standard database update form. This allows additional
	 * operations to be performed before the database structure gets updated.
	 *
	 * @param string $extKey: Extension key
	 * @param array $extInfo: Extension information array
	 * @param array $diff: Database differences
	 * @param t3lib_install $instObj: Instance of the installer
	 * @param tx_em_Install $parent: The calling parent object
	 * @return string Either empty string or a pre-processing user form
	 */
	public function preProcessDatabaseUpdates($extKey, array $extInfo, array $diff, t3lib_install $instObj, tx_em_Install $parent) {
		// Do nothing here as we don't need to
		return;
	}

	/**
	 * Hook that allows to dynamically extend the table definitions for e.g. custom caches.
	 * The hook implementation may return table create strings that will be respected by
	 * the extension manager during installation of an extension.
	 *
	 * @param string $extKey
	 * @param array $extInfo
	 * @param string $fileContent
	 * @param t3lib_install $instObj
	 * @param t3lib_install_Sql $instSqlObj
	 * @param tx_em_Install $parent
	 * @return string
	 */
	public function appendTableDefinitions($extKey, array $extInfo, $fileContent, t3lib_install $instObj, t3lib_install_Sql $instSqlObj, tx_em_Install $parent) {
		$this->tcaTables = array_diff(array_keys($GLOBALS['TCA']), array('sys_category'));
		$data = array();
		preg_match_all('/CREATE\WTABLE\W([a-zA-Z0-9_-]*)\W\(/i', $fileContent, $data);
		$data = $data[1];
		$tables = array_intersect($this->tcaTables, $data);
		return $this->createSqlStringForCategoryField($tables);
	}

	/**
	 *
	 * @param string $extKey
	 * @param array $loadedExtConf
	 * @param string $extensionSqlContent
	 * @param t3lib_install_Sql $instSqlObj
	 * @param tx_install $parent
	 * @return string
	 */
	public function appendExtensionTableDefinitions($extKey, array $loadedExtConf, $extensionSqlContent, t3lib_install_Sql $instSqlObj, tx_install $parent) {
		$parent->includeTCA();
		$this->tcaTables = array_diff(array_keys($GLOBALS['TCA']), array('sys_category'));
		$data = array();
		preg_match_all('/CREATE\WTABLE\W([a-zA-Z0-9_-]*)\W\(/i', $extensionSqlContent, $data);
		$data = $data[1];
		$tables = array_intersect($this->tcaTables, $data);
		return $this->createSqlStringForCategoryField($tables);
	}

	/**
	 * hook called by the install Tool
	 *
	 * @param string $allSqlContent			The content of all relevant sql files
	 * @param t3lib_install_Sql $instSqlObj	Instance of the installer sql object
	 * @param tx_install $parent			The calling parent object
	 * @return string
	 */
	public function appendGlobalTableDefinitions($allSqlContent, t3lib_install_Sql $instSqlObj, tx_install $parent) {
		// Do nothing here as we don't need to
		return '';
	}

	/**
	 * generated the SQL for the passed records
	 *
	 * @param string[] $tables
	 * @return string
	 */
	protected function createSqlStringForCategoryField(array $tables) {
		$sql = '';
		foreach ($tables AS $tableName) {
			$sql .= str_replace('###TABLE_NAME###', $tableName, $this->sqlTemplate);
		}
		return $sql;
	}
}

?>
}
