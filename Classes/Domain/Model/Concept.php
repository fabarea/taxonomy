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
 * An idea or notion; a unit of thought.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */

 class Tx_Taxonomy_Domain_Model_Concept extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * Preferred Label. The property skosxl:prefLabel is used to associate an skosxl:Label with a skos:Concept. The property is analogous to skos:prefLabel.
	 *
	 * @var Tx_Taxonomy_Domain_Model_PrefLabel $prefLabel
	 */
	protected $prefLabel;

	/**
	 * Alternative Label. The property skosxl:altLabel is used to associate an skosxl:Label with a skos:Concept. The property is analogous to skos:altLabel.
	 *
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Taxonomy_Domain_Model_AltLabel> $altLabels
	 */
	protected $altLabels;

	/**
	 * Hidden Label. The property skosxl:hiddenLabel is used to associate an skosxl:Label with a skos:Concept. The property is analogous to skos:hiddenLabel.
	 *
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Taxonomy_Domain_Model_HiddenLabel> $hiddenLabels
	 */
	protected $hiddenLabels;

	/**
	 * notes
	 *
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Taxonomy_Domain_Model_Note> $notes
	 */
	protected $notes;

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
		$this->altLabels = new Tx_Extbase_Persistence_ObjectStorage();
		$this->hiddenLabels = new Tx_Extbase_Persistence_ObjectStorage();
		$this->notes = new Tx_Extbase_Persistence_ObjectStorage();
	}

	/**
	 * Setter for prefLabel
	 *
	 * @param Tx_Taxonomy_Domain_Model_PrefLabel $prefLabel Preferred Label. The property skosxl:prefLabel is used to associate an skosxl:Label with a skos:Concept. The property is analogous to skos:prefLabel.
	 * @return void
	 */
	public function setPrefLabel(Tx_Taxonomy_Domain_Model_PrefLabel $prefLabel) {
		$this->prefLabel = $prefLabel;
	}

	/**
	 * Getter for prefLabel
	 *
	 * @return Tx_Taxonomy_Domain_Model_PrefLabel Preferred Label. The property skosxl:prefLabel is used to associate an skosxl:Label with a skos:Concept. The property is analogous to skos:prefLabel.
	 */
	public function getPrefLabel() {
		return $this->prefLabel;
	}

	/**
	 * Setter for altLabels
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Taxonomy_Domain_Model_AltLabel> $altLabels Alternative Label. The property skosxl:altLabel is used to associate an skosxl:Label with a skos:Concept. The property is analogous to skos:altLabel.
	 * @return void
	 */
	public function setAltLabels(Tx_Extbase_Persistence_ObjectStorage $altLabels) {
		$this->altLabels = $altLabels;
	}

	/**
	 * Getter for altLabels
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Taxonomy_Domain_Model_AltLabel> Alternative Label. The property skosxl:altLabel is used to associate an skosxl:Label with a skos:Concept. The property is analogous to skos:altLabel.
	 */
	public function getAltLabels() {
		return $this->altLabels;
	}

	/**
	 * Adds a AltLabel
	 *
	 * @param Tx_Taxonomy_Domain_Model_AltLabel the AltLabel to be added
	 * @return void
	 */
	public function addAltLabel(Tx_Taxonomy_Domain_Model_AltLabel $altLabel) {
		$this->altLabels->attach($altLabel);
	}

	/**
	 * Removes a AltLabel
	 *
	 * @param Tx_Taxonomy_Domain_Model_AltLabel the AltLabel to be removed
	 * @return void
	 */
	public function removeAltLabel(Tx_Taxonomy_Domain_Model_AltLabel $altLabelToRemove) {
		$this->altLabels->detach($altLabelToRemove);
	}

	/**
	 * Setter for hiddenLabels
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Taxonomy_Domain_Model_HiddenLabel> $hiddenLabels Hidden Label. The property skosxl:hiddenLabel is used to associate an skosxl:Label with a skos:Concept. The property is analogous to skos:hiddenLabel.
	 * @return void
	 */
	public function setHiddenLabels(Tx_Extbase_Persistence_ObjectStorage $hiddenLabels) {
		$this->hiddenLabels = $hiddenLabels;
	}

	/**
	 * Getter for hiddenLabels
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Taxonomy_Domain_Model_HiddenLabel> Hidden Label. The property skosxl:hiddenLabel is used to associate an skosxl:Label with a skos:Concept. The property is analogous to skos:hiddenLabel.
	 */
	public function getHiddenLabels() {
		return $this->hiddenLabels;
	}

	/**
	 * Adds a HiddenLabel
	 *
	 * @param Tx_Taxonomy_Domain_Model_HiddenLabel the HiddenLabel to be added
	 * @return void
	 */
	public function addHiddenLabel(Tx_Taxonomy_Domain_Model_HiddenLabel $hiddenLabel) {
		$this->hiddenLabels->attach($hiddenLabel);
	}

	/**
	 * Removes a HiddenLabel
	 *
	 * @param Tx_Taxonomy_Domain_Model_HiddenLabel the HiddenLabel to be removed
	 * @return void
	 */
	public function removeHiddenLabel(Tx_Taxonomy_Domain_Model_HiddenLabel $hiddenLabelToRemove) {
		$this->hiddenLabels->detach($hiddenLabelToRemove);
	}

	/**
	 * Adds a Note
	 *
	 * @param Tx_Taxonomy_Domain_Model_Note $note
	 * @return void
	 */
	public function addNote(Tx_Taxonomy_Domain_Model_Note $note) {
		$this->notes->attach($note);
	}

	/**
	 * Removes a Note
	 *
	 * @param Tx_Taxonomy_Domain_Model_Note $noteToRemove The Note to be removed
	 * @return void
	 */
	public function removeNote(Tx_Taxonomy_Domain_Model_Note $noteToRemove) {
		$this->notes->detach($noteToRemove);
	}

	/**
	 * Returns the notes
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Taxonomy_Domain_Model_Note> $notes
	 */
	public function getNotes() {
		return $this->notes;
	}

	/**
	 * Sets the notes
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Taxonomy_Domain_Model_Note> $notes
	 * @return void
	 */
	public function setNotes($notes) {
		$this->notes = $notes;
	}

}
?>