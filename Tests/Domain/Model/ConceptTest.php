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
*  the Free Software Foundation; either version 2 of the License, or
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
 * Testcase for class Tx_Taxonomy_Domain_Model_Concept.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @package TYPO3
 * @subpackage Taxonomy
 * 
 * @author Jochen Rau <jochen.rau@typoplanet.de>
 */
class Tx_Taxonomy_Domain_Model_ConceptTest extends Tx_Extbase_Tests_Unit_BaseTestCase {
	/**
	 * @var Tx_Taxonomy_Domain_Model_Concept
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new Tx_Taxonomy_Domain_Model_Concept();
	}

	public function tearDown() {
		unset($this->fixture);
	}
	
	
	/**
	 * @test
	 */
	public function getPrefLabelReturnsInitialValueForTx_Taxonomy_Domain_Model_PrefLabel() { 
		$this->assertEquals(
			NULL,
			$this->fixture->getPrefLabel()
		);
	}

	/**
	 * @test
	 */
	public function setPrefLabelForTx_Taxonomy_Domain_Model_PrefLabelSetsPrefLabel() { 
		$dummyObject = new Tx_Taxonomy_Domain_Model_PrefLabel();
		$this->fixture->setPrefLabel($dummyObject);

		$this->assertSame(
			$dummyObject,
			$this->fixture->getPrefLabel()
		);
	}
	
	/**
	 * @test
	 */
	public function getAltLabelsReturnsInitialValueForObjectStorageContainingTx_Taxonomy_Domain_Model_AltLabel() { 
		$newObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->fixture->getAltLabels()
		);
	}

	/**
	 * @test
	 */
	public function setAltLabelsForObjectStorageContainingTx_Taxonomy_Domain_Model_AltLabelSetsAltLabels() { 
		$altLabel = new Tx_Taxonomy_Domain_Model_AltLabel();
		$objectStorageHoldingExactlyOneAltLabels = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOneAltLabels->attach($altLabel);
		$this->fixture->setAltLabels($objectStorageHoldingExactlyOneAltLabels);

		$this->assertSame(
			$objectStorageHoldingExactlyOneAltLabels,
			$this->fixture->getAltLabels()
		);
	}
	
	/**
	 * @test
	 */
	public function addAltLabelToObjectStorageHoldingAltLabels() {
		$altLabel = new Tx_Taxonomy_Domain_Model_AltLabel();
		$objectStorageHoldingExactlyOneAltLabel = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOneAltLabel->attach($altLabel);
		$this->fixture->addAltLabel($altLabel);

		$this->assertEquals(
			$objectStorageHoldingExactlyOneAltLabel,
			$this->fixture->getAltLabels()
		);
	}

	/**
	 * @test
	 */
	public function removeAltLabelFromObjectStorageHoldingAltLabels() {
		$altLabel = new Tx_Taxonomy_Domain_Model_AltLabel();
		$localObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$localObjectStorage->attach($altLabel);
		$localObjectStorage->detach($altLabel);
		$this->fixture->addAltLabel($altLabel);
		$this->fixture->removeAltLabel($altLabel);

		$this->assertEquals(
			$localObjectStorage,
			$this->fixture->getAltLabels()
		);
	}
	
	/**
	 * @test
	 */
	public function getHiddenLabelsReturnsInitialValueForObjectStorageContainingTx_Taxonomy_Domain_Model_HiddenLabel() { 
		$newObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->fixture->getHiddenLabels()
		);
	}

	/**
	 * @test
	 */
	public function setHiddenLabelsForObjectStorageContainingTx_Taxonomy_Domain_Model_HiddenLabelSetsHiddenLabels() { 
		$hiddenLabel = new Tx_Taxonomy_Domain_Model_HiddenLabel();
		$objectStorageHoldingExactlyOneHiddenLabels = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOneHiddenLabels->attach($hiddenLabel);
		$this->fixture->setHiddenLabels($objectStorageHoldingExactlyOneHiddenLabels);

		$this->assertSame(
			$objectStorageHoldingExactlyOneHiddenLabels,
			$this->fixture->getHiddenLabels()
		);
	}
	
	/**
	 * @test
	 */
	public function addHiddenLabelToObjectStorageHoldingHiddenLabels() {
		$hiddenLabel = new Tx_Taxonomy_Domain_Model_HiddenLabel();
		$objectStorageHoldingExactlyOneHiddenLabel = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOneHiddenLabel->attach($hiddenLabel);
		$this->fixture->addHiddenLabel($hiddenLabel);

		$this->assertEquals(
			$objectStorageHoldingExactlyOneHiddenLabel,
			$this->fixture->getHiddenLabels()
		);
	}

	/**
	 * @test
	 */
	public function removeHiddenLabelFromObjectStorageHoldingHiddenLabels() {
		$hiddenLabel = new Tx_Taxonomy_Domain_Model_HiddenLabel();
		$localObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$localObjectStorage->attach($hiddenLabel);
		$localObjectStorage->detach($hiddenLabel);
		$this->fixture->addHiddenLabel($hiddenLabel);
		$this->fixture->removeHiddenLabel($hiddenLabel);

		$this->assertEquals(
			$localObjectStorage,
			$this->fixture->getHiddenLabels()
		);
	}
	
	/**
	 * @test
	 */
	public function getNotesReturnsInitialValueForObjectStorageContainingTx_Taxonomy_Domain_Model_Note() { 
		$newObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->fixture->getNotes()
		);
	}

	/**
	 * @test
	 */
	public function setNotesForObjectStorageContainingTx_Taxonomy_Domain_Model_NoteSetsNotes() { 
		$note = new Tx_Taxonomy_Domain_Model_Note();
		$objectStorageHoldingExactlyOneNotes = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOneNotes->attach($note);
		$this->fixture->setNotes($objectStorageHoldingExactlyOneNotes);

		$this->assertSame(
			$objectStorageHoldingExactlyOneNotes,
			$this->fixture->getNotes()
		);
	}
	
	/**
	 * @test
	 */
	public function addNoteToObjectStorageHoldingNotes() {
		$note = new Tx_Taxonomy_Domain_Model_Note();
		$objectStorageHoldingExactlyOneNote = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOneNote->attach($note);
		$this->fixture->addNote($note);

		$this->assertEquals(
			$objectStorageHoldingExactlyOneNote,
			$this->fixture->getNotes()
		);
	}

	/**
	 * @test
	 */
	public function removeNoteFromObjectStorageHoldingNotes() {
		$note = new Tx_Taxonomy_Domain_Model_Note();
		$localObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$localObjectStorage->attach($note);
		$localObjectStorage->detach($note);
		$this->fixture->addNote($note);
		$this->fixture->removeNote($note);

		$this->assertEquals(
			$localObjectStorage,
			$this->fixture->getNotes()
		);
	}
	
}
?>