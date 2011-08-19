<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2011 Fabien Udriot <fabien.udriot@ecodev.ch>
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
 * 
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Taxonomy_Service_ExtDirect_Controller_Tree extends Tx_Taxonomy_Service_ExtDirect_Controller_AbstractTree {
	
	/**
	 * Data Provider
	 *
	 * @var Tx_Taxonomy_Service_ExtDirect_Controller_DataProvider
	 */
	protected $dataProvider = NULL;

	/**
	 * Sets the data provider
	 *
	 * @return void
	 */
	protected function initDataProvider() {
		/** @var $dataProvider Tx_Taxonomy_Service_ExtDirect_Controller_DataProvider */
		$dataProvider = t3lib_div::makeInstance('Tx_Taxonomy_Service_ExtDirect_Controller_DataProvider');
		$this->setDataProvider($dataProvider);
	}

	/**
	 * Returns the root node of the tree
	 *
	 * @return array
	 */
	public function getRoot() {
		$this->initDataProvider();
		$node = $this->dataProvider->getRoot();

		return $node->toArray();
	}

	/**
	 * Fetches the next tree level
	 *
	 * @param int $nodeId
	 * @param stdClass $nodeData
	 * @return array
	 */
	public function getNextTreeLevel($nodeId, $nodeData = array()) {
		
		$this->initDataProvider();

		/** @var $node t3lib_tree_pagetree_Node */
		$node = t3lib_div::makeInstance('t3lib_tree_pagetree_Node', (array) $nodeData);

		if ($nodeId->node === 'root') {
			$nodeCollection = $this->dataProvider->getTreeMounts();
		} else {
			$nodeCollection = $this->dataProvider->getNodes($node);
		}

		// @temp code
		$nodeCollection = json_decode($nodeCollection);
		return $nodeCollection;
		return $nodeCollection->toArray();
	}

	/**
	 * Returns a tree that only contains elements that match the given search string
	 *
	 * @param int $nodeId
	 * @param stdClass $nodeData
	 * @param string $searchFilter
	 * @return array
	 */
	public function getFilteredTree($nodeId, $nodeData, $searchFilter) {
		if (strval($searchFilter) === '') {
			return array();
		}

		/** @var $node Tx_Taxonomy_Service_ExtDirect_Controller_Node */
		$node = t3lib_div::makeInstance('Tx_Taxonomy_Service_ExtDirect_Controller_Node', (array) $nodeData);

		$this->initDataProvider();
		if ($nodeId === 'root') {
			$nodeCollection = $this->dataProvider->getTreeMounts($searchFilter);
		} else {
			$nodeCollection = $this->dataProvider->getFilteredNodes($node, $searchFilter, $node->getMountPoint());
		}

		return $nodeCollection->toArray();
	}

	/**
	 * Returns the localized list of doktypes to display
	 *
	 * Note: The list can be filtered by the user typoscript
	 * option "options.pageTree.doktypesToShowInNewPageDragArea".
	 *
	 * @return array
	 */
	public function getNodeTypes() {
		$map = array(
			1 => 'LLL:EXT:lang/locallang_tca.php:doktype.I.0',
			3 => 'LLL:EXT:cms/locallang_tca.php:pages.doktype.I.8',
			4 => 'LLL:EXT:cms/locallang_tca.php:pages.doktype.I.2',
			6 => 'LLL:EXT:cms/locallang_tca.php:pages.doktype.I.4',
			7 => 'LLL:EXT:cms/locallang_tca.php:pages.doktype.I.5',
			199 => 'LLL:EXT:cms/locallang_tca.php:pages.doktype.I.7',
			254 => 'LLL:EXT:lang/locallang_tca.php:doktype.I.folder',
			255 => 'LLL:EXT:lang/locallang_tca.php:doktype.I.2'
		);

		$doktypes = t3lib_div::trimExplode(
			',', $GLOBALS['BE_USER']->getTSConfigVal('options.pageTree.doktypesToShowInNewPageDragArea')
		);

		$output = array();
		$allowedDoktypes = t3lib_div::trimExplode(',', $GLOBALS['BE_USER']->groupData['pagetypes_select']);
		$isAdmin = $GLOBALS['BE_USER']->isAdmin();
		foreach ($doktypes as $doktype) {
			if (!$isAdmin && !in_array($doktype, $allowedDoktypes)) {
				continue;
			}

			$label = $GLOBALS['LANG']->sL($map[$doktype], TRUE);
			$spriteIcon = t3lib_iconWorks::getSpriteIconClasses(
				$GLOBALS['TCA']['pages']['ctrl']['typeicon_classes'][$doktype]
			);

			$output[] = array(
				'nodeType' => $doktype,
				'cls' => 'typo3-pagetree-topPanel-button',
				'iconCls' => $spriteIcon,
				'title' => $label,
				'tooltip' => $label,
			);
		}

		return $output;
	}

	/**
	 * Returns
	 *
	 * @return array
	 */
	public function getIndicators() {
		/** @var $indicatorProvider Tx_Taxonomy_Service_ExtDirect_Controller_Indicator */
		$indicatorProvider = t3lib_div::makeInstance('Tx_Taxonomy_Service_ExtDirect_Controller_Indicator');
		$indicatorHtmlArr = $indicatorProvider->getAllIndicators();
		$indicator = array(
				'html' => implode(' ', $indicatorHtmlArr),
				'_COUNT' => count($indicatorHtmlArr)
		);

		return $indicator;
	}

	/**
	 * Returns the language labels, sprites and configuration options for the pagetree
	 *
	 * @return void
	 */
	public function loadResources() {
		$file = 'LLL:EXT:lang/locallang_core.xml:';
		$indicators = $this->getIndicators();
		$configuration = array(
			'LLL' => array(
				'copyHint' => $GLOBALS['LANG']->sL($file . 'tree.copyHint', TRUE),
				'fakeNodeHint' => $GLOBALS['LANG']->sL($file . 'mess.please_wait', TRUE),
				'activeFilterMode' => $GLOBALS['LANG']->sL($file . 'tree.activeFilterMode', TRUE),
				'dropToRemove' => $GLOBALS['LANG']->sL($file . 'tree.dropToRemove', TRUE),
				'buttonRefresh' => $GLOBALS['LANG']->sL($file . 'labels.refresh', TRUE),
				'buttonNewNode' => $GLOBALS['LANG']->sL($file . 'tree.buttonNewNode', TRUE),
				'buttonFilter' => $GLOBALS['LANG']->sL($file . 'tree.buttonFilter', TRUE),
				'dropZoneElementRemoved' => $GLOBALS['LANG']->sL($file . 'tree.dropZoneElementRemoved', TRUE),
				'dropZoneElementRestored' => $GLOBALS['LANG']->sL($file . 'tree.dropZoneElementRestored', TRUE),
				'searchTermInfo' => $GLOBALS['LANG']->sL($file . 'tree.searchTermInfo', TRUE),
				'temporaryMountPointIndicatorInfo' => $GLOBALS['LANG']->sl($file . 'labels.temporaryDBmount', TRUE),
				'deleteDialogTitle' => $GLOBALS['LANG']->sL('LLL:EXT:cms/layout/locallang.xml:deleteItem', TRUE),
				'deleteDialogMessage' => $GLOBALS['LANG']->sL('LLL:EXT:cms/layout/locallang.xml:deleteWarning', TRUE),
				'recursiveDeleteDialogMessage' => $GLOBALS['LANG']->sL('LLL:EXT:cms/layout/locallang.xml:recursiveDeleteWarning', TRUE),
			),

			'Configuration' => array(
				'hideFilter' => $GLOBALS['BE_USER']->getTSConfigVal('options.pageTree.hideFilter'),
				'displayDeleteConfirmation' => $GLOBALS['BE_USER']->jsConfirmation(4),
				'canDeleteRecursivly' => $GLOBALS['BE_USER']->uc['recursiveDelete'] == TRUE,
				'disableIconLinkToContextmenu' => $GLOBALS['BE_USER']->getTSConfigVal(
					'options.pageTree.disableIconLinkToContextmenu'
				),
				'indicator' => $indicators['html'],
				'temporaryMountPoint' => Tx_Taxonomy_Service_ExtDirect_Controller_Commands::getMountPointPath(),
			),

			'Sprites' => array(
				'Filter' => t3lib_iconWorks::getSpriteIconClasses('actions-system-tree-search-open'),
				'NewNode' => t3lib_iconWorks::getSpriteIconClasses('actions-page-new'),
				'Refresh' => t3lib_iconWorks::getSpriteIconClasses('actions-system-refresh'),
				'InputClear' => t3lib_iconWorks::getSpriteIconClasses('actions-input-clear'),
				'TrashCan' => t3lib_iconWorks::getSpriteIconClasses('actions-edit-delete'),
				'TrashCanRestore' => t3lib_iconWorks::getSpriteIconClasses('actions-edit-restore'),
				'Info' => t3lib_iconWorks::getSpriteIconClasses('actions-document-info'),
			)
		);

		return $configuration;
	}

}

?>