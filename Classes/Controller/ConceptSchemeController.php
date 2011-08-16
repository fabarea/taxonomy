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
 * Controller for the ConceptScheme object
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */

 class Tx_Taxonomy_Controller_ConceptSchemeController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * conceptSchemeRepository
	 *
	 * @var Tx_Taxonomy_Domain_Repository_ConceptSchemeRepository
	 */
	protected $conceptSchemeRepository;

	/**
	 * Initializes the current action
	 *
	 * @return void
	 */
	protected function initializeAction() {
		$this->conceptSchemeRepository = t3lib_div::makeInstance('Tx_Taxonomy_Domain_Repository_ConceptSchemeRepository');
	}

	/**
	 * Displays all ConceptSchemes
	 *
	 * @return string The rendered list view
	 */
	public function listAction() {
		$conceptSchemes = $this->conceptSchemeRepository->findAll();
		
		if(count($conceptSchemes) < 1){
			$settings = $this->configurationManager->getConfiguration(Tx_Extbase_Configuration_ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
			if(empty($settings['persistence']['storagePid'])){
				$this->flashMessageContainer->add('No storagePid configured!');
			}
		}
		
		$this->view->assign('conceptSchemes', $conceptSchemes);
	}

	/**
	 * Displays a single ConceptScheme
	 *
	 * @param Tx_Taxonomy_Domain_Model_ConceptScheme $conceptScheme the ConceptScheme to display
	 * @return string The rendered view
	 */
	public function showAction(Tx_Taxonomy_Domain_Model_ConceptScheme $conceptScheme) {
		$this->view->assign('conceptScheme', $conceptScheme);
	}

	/**
	 * Creates a new ConceptScheme and forwards to the list action.
	 *
	 * @param Tx_Taxonomy_Domain_Model_ConceptScheme $newConceptScheme a fresh ConceptScheme object which has not yet been added to the repository
	 * @return string An HTML form for creating a new ConceptScheme
	 * @dontvalidate $newConceptScheme
	 */
	public function newAction(Tx_Taxonomy_Domain_Model_ConceptScheme $newConceptScheme = null) {
		$this->view->assign('newConceptScheme', $newConceptScheme);
	}

	/**
	 * Creates a new ConceptScheme and forwards to the list action.
	 *
	 * @param Tx_Taxonomy_Domain_Model_ConceptScheme $newConceptScheme a fresh ConceptScheme object which has not yet been added to the repository
	 * @return void
	 */
	public function createAction(Tx_Taxonomy_Domain_Model_ConceptScheme $newConceptScheme) {
		$this->conceptSchemeRepository->add($newConceptScheme);
		$this->flashMessageContainer->add('Your new ConceptScheme was created.');
		
			
		
		$this->redirect('list');
	}

	/**
	 * Updates an existing ConceptScheme and forwards to the index action afterwards.
	 *
	 * @param Tx_Taxonomy_Domain_Model_ConceptScheme $conceptScheme the ConceptScheme to display
	 * @return string A form to edit a ConceptScheme
	 */
	public function editAction(Tx_Taxonomy_Domain_Model_ConceptScheme $conceptScheme) {
		$this->view->assign('conceptScheme', $conceptScheme);
	}

	/**
	 * Updates an existing ConceptScheme and forwards to the list action afterwards.
	 *
	 * @param Tx_Taxonomy_Domain_Model_ConceptScheme $conceptScheme the ConceptScheme to display
	 */
	public function updateAction(Tx_Taxonomy_Domain_Model_ConceptScheme $conceptScheme) {
		$this->conceptSchemeRepository->update($conceptScheme);
		$this->flashMessageContainer->add('Your ConceptScheme was updated.');
		$this->redirect('list');
	}

	/**
	 * Deletes an existing ConceptScheme
	 *
	 * @param Tx_Taxonomy_Domain_Model_ConceptScheme $conceptScheme the ConceptScheme to be deleted
	 * @return void
	 */
	public function deleteAction(Tx_Taxonomy_Domain_Model_ConceptScheme $conceptScheme) {
		$this->conceptSchemeRepository->remove($conceptScheme);
		$this->flashMessageContainer->add('Your ConceptScheme was removed.');
		$this->redirect('list');
	}

}
?>