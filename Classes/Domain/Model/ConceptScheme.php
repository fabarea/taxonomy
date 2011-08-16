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
 * A set of concepts, optionally including statements about semantic relationships between those concepts. Thesauri, classification schemes, subject heading lists, taxonomies, 'folksonomies', and other types of controlled vocabulary are all examples of concept schemes. Concept schemes are also embedded in glossaries and terminologies.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */

 class Tx_Taxonomy_Domain_Model_ConceptScheme extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * A collection of concepts.
	 *
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Taxonomy_Domain_Model_Concept> $concepts
	 */
	protected $concepts;

	/**
	 * The constructor.
	 *
	 * @return void
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	 * Initializes all Tx_Extbase_Persistence_ObjectStorage properties.
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		/**
		* Do not modify this method!
		* It will be rewritten on each save in the kickstarter
		* You may modify the constructor of this class instead
		*/
		$this->concepts = new Tx_Extbase_Persistence_ObjectStorage();
	}

	/**
	 * Setter for concepts
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Taxonomy_Domain_Model_Concept> $concepts A collection of concepts.
	 * @return void
	 */
	public function setConcepts(Tx_Extbase_Persistence_ObjectStorage $concepts) {
		$this->concepts = $concepts;
	}

	/**
	 * Getter for concepts
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Taxonomy_Domain_Model_Concept> A collection of concepts.
	 */
	public function getConcepts() {
		return $this->concepts;
	}

	/**
	 * Adds a Concept
	 *
	 * @param Tx_Taxonomy_Domain_Model_Concept the Concept to be added
	 * @return void
	 */
	public function addConcept(Tx_Taxonomy_Domain_Model_Concept $concept) {
		$this->concepts->attach($concept);
	}

	/**
	 * Removes a Concept
	 *
	 * @param Tx_Taxonomy_Domain_Model_Concept the Concept to be removed
	 * @return void
	 */
	public function removeConcept(Tx_Taxonomy_Domain_Model_Concept $conceptToRemove) {
		$this->concepts->detach($conceptToRemove);
	}

}
?>