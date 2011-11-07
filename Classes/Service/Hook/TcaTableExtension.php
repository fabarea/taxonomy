<?php
/**
 * Created by JetBrains PhpStorm.
 * User: SteffenR
 * Date: 06.11.11
 * Time: 15:20
 * To change this template use File | Settings | File Templates.
 */
 
class Tx_Taxonomy_Service_Hook_TcaTableExtension implements t3lib_extTables_PostProcessingHook {

	/**
	 * Function which may process data created / registered by extTables
	 * scripts (f.e. modifying TCA data off all Extensions)
	 *
	 * @return void
	 */
	public function processData() {
		$tcaTables = array_diff(array_keys($GLOBALS['TCA']), array('pages', 'sys_category'));
		foreach ($tcaTables AS $tableName) {
			t3lib_div::loadTCA($tableName);
			$columnConfiguration = array(
				'sys_category' => array(
					'exclude'	=> 1,
					'label'		=> 'LLL:EXT:taxonomy/Resources/Private/Language/locallang_db.xml:sys_category',
					'config'	=> array(
						'maxitems' => 9999,
						'type'				=> 'select',
						'foreign_table'		=> 'sys_category',
						'MM'				=> 'sys_category_record_mm',
						'MM_hasUidField'	=> true,
						'MM_opposite_field' => 'items',
						'MM_match_fields'	=> array('tablenames' => $tableName),
						'renderMode' => 'tree',
						'treeConfig' => array(
							'parentField' => 'parent'
						)
					)
				)
			);
			t3lib_extMgm::addTCAcolumns($tableName, $columnConfiguration, 1);
		}
	}
}
