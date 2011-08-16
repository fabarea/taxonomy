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
 * Controller for the LabelRelationType object
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */

 class Tx_Taxonomy_Controller_LabelRelationTypeController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * labelRelationTypeRepository
	 *
	 * @var Tx_Taxonomy_Domain_Repository_LabelRelationTypeRepository
	 */
	protected $labelRelationTypeRepository;

	/**
	 * Initializes the current action
	 *
	 * @return void
	 */
	protected function initializeAction() {
		$this->labelRelationTypeRepository = t3lib_div::makeInstance('Tx_Taxonomy_Domain_Repository_LabelRelationTypeRepository');
	}

	/**
	 * Displays all LabelRelationTypes
	 *
	 * @return string The rendered list view
	 */
	public function listAction() {
		$labelRelationTypes = $this->labelRelationTypeRepository->findAll();
		
		if(count($labelRelationTypes) < 1){
			$settings = $this->configurationManager->getConfiguration(Tx_Extbase_Configuration_ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
			if(empty($settings['persistence']['storagePid'])){
				$this->flashMessageContainer->add('No storagePid configured!');
			}
		}
		
		$this->view->assign('labelRelationTypes', $labelRelationTypes);
	}

	/**
	 * Displays a single LabelRelationType
	 *
	 * @param Tx_Taxonomy_Domain_Model_LabelRelationType $labelRelationType the LabelRelationType to display
	 * @return string The rendered view
	 */
	public function showAction(Tx_Taxonomy_Domain_Model_LabelRelationType $labelRelationType) {
		$this->view->assign('labelRelationType', $labelRelationType);
	}

	/**
	 * Creates a new LabelRelationType and forwards to the list action.
	 *
	 * @param Tx_Taxonomy_Domain_Model_LabelRelationType $newLabelRelationType a fresh LabelRelationType object which has not yet been added to the repository
	 * @return string An HTML form for creating a new LabelRelationType
	 * @dontvalidate $newLabelRelationType
	 */
	public function newAction(Tx_Taxonomy_Domain_Model_LabelRelationType $newLabelRelationType = null) {
		$this->view->assign('newLabelRelationType', $newLabelRelationType);
	}

	/**
	 * Creates a new LabelRelationType and forwards to the list action.
	 *
	 * @param Tx_Taxonomy_Domain_Model_LabelRelationType $newLabelRelationType a fresh LabelRelationType object which has not yet been added to the repository
	 * @return void
	 */
	public function createAction(Tx_Taxonomy_Domain_Model_LabelRelationType $newLabelRelationType) {
		$this->labelRelationTypeRepository->add($newLabelRelationType);
		$this->flashMessageContainer->add('Your new LabelRelationType was created.');
		
			
		
		$this->redirect('list');
	}

	/**
	 * Updates an existing LabelRelationType and forwards to the index action afterwards.
	 *
	 * @param Tx_Taxonomy_Domain_Model_LabelRelationType $labelRelationType the LabelRelationType to display
	 * @return string A form to edit a LabelRelationType
	 */
	public function editAction(Tx_Taxonomy_Domain_Model_LabelRelationType $labelRelationType) {
		$this->view->assign('labelRelationType', $labelRelationType);
	}

	/**
	 * Updates an existing LabelRelationType and forwards to the list action afterwards.
	 *
	 * @param Tx_Taxonomy_Domain_Model_LabelRelationType $labelRelationType the LabelRelationType to display
	 */
	public function updateAction(Tx_Taxonomy_Domain_Model_LabelRelationType $labelRelationType) {
		$this->labelRelationTypeRepository->update($labelRelationType);
		$this->flashMessageContainer->add('Your LabelRelationType was updated.');
		$this->redirect('list');
	}

	/**
	 * Deletes an existing LabelRelationType
	 *
	 * @param Tx_Taxonomy_Domain_Model_LabelRelationType $labelRelationType the LabelRelationType to be deleted
	 * @return void
	 */
	public function deleteAction(Tx_Taxonomy_Domain_Model_LabelRelationType $labelRelationType) {
		$this->labelRelationTypeRepository->remove($labelRelationType);
		$this->flashMessageContainer->add('Your LabelRelationType was removed.');
		$this->redirect('list');
	}

}
?>