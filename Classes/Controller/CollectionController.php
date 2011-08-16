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
 * Controller for the Collection object
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */

 class Tx_Taxonomy_Controller_CollectionController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * collectionRepository
	 *
	 * @var Tx_Taxonomy_Domain_Repository_CollectionRepository
	 */
	protected $collectionRepository;

	/**
	 * Initializes the current action
	 *
	 * @return void
	 */
	protected function initializeAction() {
		$this->collectionRepository = t3lib_div::makeInstance('Tx_Taxonomy_Domain_Repository_CollectionRepository');
	}

	/**
	 * Displays all Collections
	 *
	 * @return string The rendered list view
	 */
	public function listAction() {
		$collections = $this->collectionRepository->findAll();
		
		if(count($collections) < 1){
			$settings = $this->configurationManager->getConfiguration(Tx_Extbase_Configuration_ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
			if(empty($settings['persistence']['storagePid'])){
				$this->flashMessageContainer->add('No storagePid configured!');
			}
		}
		
		$this->view->assign('collections', $collections);
	}

	/**
	 * Displays a single Collection
	 *
	 * @param Tx_Taxonomy_Domain_Model_Collection $collection the Collection to display
	 * @return string The rendered view
	 */
	public function showAction(Tx_Taxonomy_Domain_Model_Collection $collection) {
		$this->view->assign('collection', $collection);
	}

	/**
	 * Creates a new Collection and forwards to the list action.
	 *
	 * @param Tx_Taxonomy_Domain_Model_Collection $newCollection a fresh Collection object which has not yet been added to the repository
	 * @return string An HTML form for creating a new Collection
	 * @dontvalidate $newCollection
	 */
	public function newAction(Tx_Taxonomy_Domain_Model_Collection $newCollection = null) {
		$this->view->assign('newCollection', $newCollection);
	}

	/**
	 * Creates a new Collection and forwards to the list action.
	 *
	 * @param Tx_Taxonomy_Domain_Model_Collection $newCollection a fresh Collection object which has not yet been added to the repository
	 * @return void
	 */
	public function createAction(Tx_Taxonomy_Domain_Model_Collection $newCollection) {
		$this->collectionRepository->add($newCollection);
		$this->flashMessageContainer->add('Your new Collection was created.');
		
			
		
		$this->redirect('list');
	}

	/**
	 * Updates an existing Collection and forwards to the index action afterwards.
	 *
	 * @param Tx_Taxonomy_Domain_Model_Collection $collection the Collection to display
	 * @return string A form to edit a Collection
	 */
	public function editAction(Tx_Taxonomy_Domain_Model_Collection $collection) {
		$this->view->assign('collection', $collection);
	}

	/**
	 * Updates an existing Collection and forwards to the list action afterwards.
	 *
	 * @param Tx_Taxonomy_Domain_Model_Collection $collection the Collection to display
	 */
	public function updateAction(Tx_Taxonomy_Domain_Model_Collection $collection) {
		$this->collectionRepository->update($collection);
		$this->flashMessageContainer->add('Your Collection was updated.');
		$this->redirect('list');
	}

	/**
	 * Deletes an existing Collection
	 *
	 * @param Tx_Taxonomy_Domain_Model_Collection $collection the Collection to be deleted
	 * @return void
	 */
	public function deleteAction(Tx_Taxonomy_Domain_Model_Collection $collection) {
		$this->collectionRepository->remove($collection);
		$this->flashMessageContainer->add('Your Collection was removed.');
		$this->redirect('list');
	}

}
?>