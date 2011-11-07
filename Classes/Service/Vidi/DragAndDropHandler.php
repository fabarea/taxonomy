<?php


class Tx_Taxonomy_Service_Vidi_DragAndDropHandler implements Tx_Vidi_Service_DragAndDrop {

	public function dropGridRecordOnTree($gridTable, $gridRecord, $treeTable, $treeRecord, $copy = false) {
		if ($treeTable == 'sys_category') {
			$count = $GLOBALS['TYPO3_DB']->exec_SELECTcountRows(
				'*',
				'sys_category_record_mm',
				'tablenames = \'' . $gridTable . '\' AND uid_foreign = ' . intval($gridRecord->id) . ' AND uid_local = ' . intval($treeRecord->id)
			);
			if ($count == 0) {
				$GLOBALS['TYPO3_DB']->exec_INSERTquery('sys_category_record_mm',
					array(
						'tablenames' => $gridTable,
						'uid_foreign' => intval($gridRecord->id),
						'uid_local' => intval($treeRecord->id)
					)
				);
			}
		}
	}

}
