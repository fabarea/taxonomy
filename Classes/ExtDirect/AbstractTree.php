<?php

/* * *************************************************************
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
 * ************************************************************* */

/**
 * 
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
abstract class Tx_Taxonomy_ExtDirect_AbstractTree {

	/**
	 * Data Provider
	 *
	 * @var Tx_Taxonomy_ExtDirect_AbstractDataProvider
	 */
	protected $dataProvider = NULL;

	/**
	 * Tree Node Decorator
	 *
	 * @var Tx_Taxonomy_ExtDirect_renderer_Abstract
	 */
	protected $nodeRenderer = NULL;
	
	/**
	 * State Provider
	 *
	 * @var Tx_Taxonomy_ExtDirect_AbstractStateProvider
	 */
	protected $stateProvider = NULL;

	/**
	 * @param Tx_Taxonomy_ExtDirect_AbstractDataProvider $dataProvider
	 * @return void
	 */
	public function setDataProvider(Tx_Taxonomy_ExtDirect_AbstractDataProvider $dataProvider) {
		$this->dataProvider = $dataProvider;
	}

	/**
	 * @return Tx_Taxonomy_ExtDirect_AbstractDataProvider
	 */
	public function getDataProvider() {
		return $this->dataProvider;
	}

	/**
	 * @param Tx_Taxonomy_ExtDirect_renderer_Abstract $dataProvider
	 * @return void
	 */
	public function setNodeRenderer(Tx_Taxonomy_ExtDirect_renderer_Abstract $nodeRenderer) {
		$this->nodeRenderer = $nodeRenderer;
	}

	/**
	 * @return Tx_Taxonomy_ExtDirect_renderer_Abstract
	 */
	public function getNodeRenderer() {
		return $this->nodeRenderer;
	}

	/**
	 * @param Tx_Taxonomy_ExtDirect_AbstractStateProvider $stateProvider
	 * @return void
	 */
	public function setStateProvider(Tx_Taxonomy_ExtDirect_AbstractStateProvider $stateProvider) {
		$this->stateProvider = $stateProvider;
	}

	/**
	 * @return Tx_Taxonomy_ExtDirect_AbstractStateProvider
	 */
	public function getStateProvider() {
		return $this->stateProvider;
	}
	
	/**
	 * Returns the root node
	 *
	 * @return Tx_Taxonomy_ExtDirect_Node
	 */
	abstract public function getRoot();
	
	/**
	 * Fetches the next tree level
	 *
	 * @abstract
	 * @param int $nodeId
	 * @param stdClass $nodeData
	 * @return array
	 */
	abstract public function getNextTreeLevel($nodeId, $nodeData);
}

?>