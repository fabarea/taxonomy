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
 * Controller for the Concept object
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */

 class Tx_Taxonomy_Controller_ConceptController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * conceptRepository
	 *
	 * @var Tx_Taxonomy_Domain_Repository_ConceptRepository
	 */
	protected $conceptRepository;

	/**
	 * injectConceptRepository
	 *
	 * @param Tx_Taxonomy_Domain_Repository_ConceptRepository $conceptRepository
	 * @return void
	 */
	public function injectConceptRepository(Tx_Taxonomy_Domain_Repository_ConceptRepository $conceptRepository) {
		$this->conceptRepository = $conceptRepository;
	}

	/**
	 * Displays all Concepts
	 *
	 * @return string The rendered list view
	 */
	public function listAction() {
		$configuration = $this->configurationManager->getConfiguration(Tx_Extbase_Configuration_ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
		if(empty($configuration['persistence']['storagePid'])){
			$this->flashMessageContainer->add('No storagePid! You have to include the static template of this extension and set the constant plugin.tx_' . t3lib_div::lcfirst($this->extensionName) . '.persistence.storagePid in the constant editor');
		}
		
		# @todo: not necessary to fetch records here as it is done by ExtDirect later on. Find an more appropriate action for that
		#$concepts = $this->conceptRepository->findAll();
		#$this->view->assign('concepts', $concepts);
	}

	/**
	 * Displays a single Concept
	 *
	 * @param Tx_Taxonomy_Domain_Model_Concept $concept the Concept to display
	 * @return string The rendered view
	 */
	public function showAction(Tx_Taxonomy_Domain_Model_Concept $concept) {
		$this->view->assign('concept', $concept);
	}

	/**
	 * Creates a new Concept and forwards to the list action.
	 *
	 * @param Tx_Taxonomy_Domain_Model_Concept $newConcept a fresh Concept object which has not yet been added to the repository
	 * @return string An HTML form for creating a new Concept
	 * @dontvalidate $newConcept
	 */
	public function newAction(Tx_Taxonomy_Domain_Model_Concept $newConcept = null) {
		$this->view->assign('newConcept', $newConcept);
	}

	/**
	 * Creates a new Concept and forwards to the list action.
	 *
	 * @param Tx_Taxonomy_Domain_Model_Concept $newConcept a fresh Concept object which has not yet been added to the repository
	 * @return void
	 */
	public function createAction(Tx_Taxonomy_Domain_Model_Concept $newConcept) {
		$this->conceptRepository->add($newConcept);
		$this->flashMessageContainer->add('Your new Concept was created.');
		
			
		
		$this->redirect('list');
	}

	/**
	 * Updates an existing Concept and forwards to the index action afterwards.
	 *
	 * @param Tx_Taxonomy_Domain_Model_Concept $concept the Concept to display
	 * @return string A form to edit a Concept
	 */
	public function editAction(Tx_Taxonomy_Domain_Model_Concept $concept) {
		$this->view->assign('concept', $concept);
	}

	/**
	 * Updates an existing Concept and forwards to the list action afterwards.
	 *
	 * @param Tx_Taxonomy_Domain_Model_Concept $concept the Concept to display
	 */
	public function updateAction(Tx_Taxonomy_Domain_Model_Concept $concept) {
		$this->conceptRepository->update($concept);
		$this->flashMessageContainer->add('Your Concept was updated.');
		$this->redirect('list');
	}

	/**
	 * Deletes an existing Concept
	 *
	 * @param Tx_Taxonomy_Domain_Model_Concept $concept the Concept to be deleted
	 * @return void
	 */
	public function deleteAction(Tx_Taxonomy_Domain_Model_Concept $concept) {
		$this->conceptRepository->remove($concept);
		$this->flashMessageContainer->add('Your Concept was removed.');
		$this->redirect('list');
	}

}
?>