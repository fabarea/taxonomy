<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2011 Jochen Rau <jochen.rau@typoplanet.de>, typoplanet
*  	
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 3 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/


/**
 * Controller for the SemanticRelationType object
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */

 class Tx_Taxonomy_Controller_SemanticRelationTypeController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * semanticRelationTypeRepository
	 *
	 * @var Tx_Taxonomy_Domain_Repository_SemanticRelationTypeRepository
	 */
	protected $semanticRelationTypeRepository;

	/**
	 * Initializes the current action
	 *
	 * @return void
	 */
	protected function initializeAction() {
		$this->semanticRelationTypeRepository = t3lib_div::makeInstance('Tx_Taxonomy_Domain_Repository_SemanticRelationTypeRepository');
	}

	/**
	 * Displays all SemanticRelationTypes
	 *
	 * @return string The rendered list view
	 */
	public function listAction() {
		$semanticRelationTypes = $this->semanticRelationTypeRepository->findAll();
		
		if(count($semanticRelationTypes) < 1){
			$settings = $this->configurationManager->getConfiguration(Tx_Extbase_Configuration_ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
			if(empty($settings['persistence']['storagePid'])){
				$this->flashMessageContainer->add('No storagePid configured!');
			}
		}
		
		$this->view->assign('semanticRelationTypes', $semanticRelationTypes);
	}

	/**
	 * Displays a single SemanticRelationType
	 *
	 * @param Tx_Taxonomy_Domain_Model_SemanticRelationType $semanticRelationType the SemanticRelationType to display
	 * @return string The rendered view
	 */
	public function showAction(Tx_Taxonomy_Domain_Model_SemanticRelationType $semanticRelationType) {
		$this->view->assign('semanticRelationType', $semanticRelationType);
	}

	/**
	 * Creates a new SemanticRelationType and forwards to the list action.
	 *
	 * @param Tx_Taxonomy_Domain_Model_SemanticRelationType $newSemanticRelationType a fresh SemanticRelationType object which has not yet been added to the repository
	 * @return string An HTML form for creating a new SemanticRelationType
	 * @dontvalidate $newSemanticRelationType
	 */
	public function newAction(Tx_Taxonomy_Domain_Model_SemanticRelationType $newSemanticRelationType = null) {
		$this->view->assign('newSemanticRelationType', $newSemanticRelationType);
	}

	/**
	 * Creates a new SemanticRelationType and forwards to the list action.
	 *
	 * @param Tx_Taxonomy_Domain_Model_SemanticRelationType $newSemanticRelationType a fresh SemanticRelationType object which has not yet been added to the repository
	 * @return void
	 */
	public function createAction(Tx_Taxonomy_Domain_Model_SemanticRelationType $newSemanticRelationType) {
		$this->semanticRelationTypeRepository->add($newSemanticRelationType);
		$this->flashMessageContainer->add('Your new SemanticRelationType was created.');
		
			
		
		$this->redirect('list');
	}

	/**
	 * Updates an existing SemanticRelationType and forwards to the index action afterwards.
	 *
	 * @param Tx_Taxonomy_Domain_Model_SemanticRelationType $semanticRelationType the SemanticRelationType to display
	 * @return string A form to edit a SemanticRelationType
	 */
	public function editAction(Tx_Taxonomy_Domain_Model_SemanticRelationType $semanticRelationType) {
		$this->view->assign('semanticRelationType', $semanticRelationType);
	}

	/**
	 * Updates an existing SemanticRelationType and forwards to the list action afterwards.
	 *
	 * @param Tx_Taxonomy_Domain_Model_SemanticRelationType $semanticRelationType the SemanticRelationType to display
	 */
	public function updateAction(Tx_Taxonomy_Domain_Model_SemanticRelationType $semanticRelationType) {
		$this->semanticRelationTypeRepository->update($semanticRelationType);
		$this->flashMessageContainer->add('Your SemanticRelationType was updated.');
		$this->redirect('list');
	}

	/**
	 * Deletes an existing SemanticRelationType
	 *
	 * @param Tx_Taxonomy_Domain_Model_SemanticRelationType $semanticRelationType the SemanticRelationType to be deleted
	 * @return void
	 */
	public function deleteAction(Tx_Taxonomy_Domain_Model_SemanticRelationType $semanticRelationType) {
		$this->semanticRelationTypeRepository->remove($semanticRelationType);
		$this->flashMessageContainer->add('Your SemanticRelationType was removed.');
		$this->redirect('list');
	}

}
?>