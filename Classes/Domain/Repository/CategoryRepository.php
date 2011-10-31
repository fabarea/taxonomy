<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2011 Steffen Ritter, <typo3@steffen-ritter.net>
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
 * Repository for Tx_Taxonomy_Domain_Model_Concept
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */

 class Tx_Taxonomy_Domain_Repository_CategoryRepository implements Tx_Extbase_Persistence_RepositoryInterface {

	 /**
	  * Adds an object to this repository.
	  *
	  * @param object $object The object to add
	  * @return void
	  * @api
	  */
	 public function add($object) {
		 // TODO: Implement add() method.
	 }

	 /**
	  * Removes an object from this repository.
	  *
	  * @param object $object The object to remove
	  * @return void
	  * @api
	  */
	 public function remove($object) {
		 // TODO: Implement remove() method.
	 }

	 /**
	  * Replaces an object by another.
	  *
	  * @param object $existingObject The existing object
	  * @param object $newObject The new object
	  * @return void
	  * @api
	  */
	 public function replace($existingObject, $newObject) {
		 // TODO: Implement replace() method.
	 }

	 /**
	  * Replaces an existing object with the same identifier by the given object
	  *
	  * @param object $modifiedObject The modified object
	  * @api
	  */
	 public function update($modifiedObject) {
		 // TODO: Implement update() method.
	 }

	 /**
	  * Returns all objects of this repository add()ed but not yet persisted to
	  * the storage layer.
	  *
	  * @return array An array of objects
	  */
	 public function getAddedObjects() {
		 // TODO: Implement getAddedObjects() method.
	 }

	 /**
	  * Returns an array with objects remove()d from the repository that
	  * had been persisted to the storage layer before.
	  *
	  * @return array
	  */
	 public function getRemovedObjects() {
		 // TODO: Implement getRemovedObjects() method.
	 }

	 /**
	  * Returns all objects of this repository.
	  *
	  * @return array An array of objects, empty if no objects found
	  * @api
	  */
	 public function findAll() {
		 // TODO: Implement findAll() method.
	 }

	 /**
	  * Returns the total number objects of this repository.
	  *
	  * @return integer The object count
	  * @api
	  */
	 public function countAll() {
		 // TODO: Implement countAll() method.
	 }

	 /**
	  * Removes all objects of this repository as if remove() was called for
	  * all of them.
	  *
	  * @return void
	  * @api
	  */
	 public function removeAll() {
		 // TODO: Implement removeAll() method.
	 }

	 /**
	  * Finds an object matching the given identifier.
	  *
	  * @param int $uid The identifier of the object to find
	  * @return object The matching object if found, otherwise NULL
	  * @api
	  */
	 public function findByUid($uid) {
		 // TODO: Implement findByUid() method.
	 }

	 /**
	  * Sets the property names to order the result by per default.
	  * Expected like this:
	  * array(
	  *  'foo' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING,
	  *  'bar' => Tx_Extbase_Persistence_QueryInterface::ORDER_DESCENDING
	  * )
	  *
	  * @param array $defaultOrderings The property names to order by
	  * @return void
	  * @api
	  */
	 public function setDefaultOrderings(array $defaultOrderings) {
		 // TODO: Implement setDefaultOrderings() method.
	 }

	 /**
	  * Sets the default query settings to be used in this repository
	  *
	  * @param Tx_Extbase_Persistence_QuerySettingsInterface $defaultQuerySettings The query settings to be used by default
	  * @return void
	  * @api
	  */
	 public function setDefaultQuerySettings(Tx_Extbase_Persistence_QuerySettingsInterface $defaultQuerySettings) {
		 // TODO: Implement setDefaultQuerySettings() method.
	 }

	 /**
	  * Returns a query for objects of this repository
	  *
	  * @return Tx_Extbase_Persistence_QueryInterface
	  * @api
	  */
	 public function createQuery() {
		 // TODO: Implement createQuery() method.
	 }
 }
?>