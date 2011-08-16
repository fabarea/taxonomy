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
 * Notes are used to provide information relating to SKOS concepts. There is no restriction on the nature of this information, e.g., it could be plain text, hypertext, or an image; it could be a definition, information about the scope of a concept, editorial information, or any other type of information.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */

 class Tx_Taxonomy_Domain_Model_Note extends Tx_Extbase_DomainObject_AbstractEntity {

	 const NOTE = 'note';
	 const CHANGE_NOTE = 'changeNote';
	 const DEFINITION = 'definition';
	 const EDITORIAL_NOTE= 'editorialNote';
	 const EXAMPLE = 'example';
	 const HISTORY_NOTE = 'historyNote';
	 const SCOPE_NOTE = 'scopeNote';

	/**
	 * One of note, changeNote, definition, editorialNote, example, historyNote, or scopeNote
	 *
	 * @var string $type
	 */
	protected $type = self::NOTE;

	/**
	 * value
	 *
	 * @var string $value
	 */
	protected $value = '';

	/**
	 * Setter for type
	 *
	 * @param string $type One of note, changeNote, definition, editorialNote, example, historyNote, or scopeNote
	 * @return void
	 */
	public function setType($type) {
		$allowedTypes = array(
			self::NOTE,
			self::CHANGE_NOTE,
			self::DEFINITION,
			self::EDITORIAL_NOTE,
			self::EXAMPLE,
			self::HISTORY_NOTE,
			self::SCOPE_NOTE
		);
		if (in_array($type, $allowedTypes)) {
			$this->type = $type;
		}
	}

	/**
	 * Getter for type
	 *
	 * @return string One of note, changeNote, definition, editorialNote, example, historyNote, or scopeNote
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * Setter for value
	 *
	 * @param string $value value
	 * @return void
	 */
	public function setValue($value) {
		$this->value = (string) $value;
	}

	/**
	 * Getter for value
	 *
	 * @return string value
	 */
	public function getValue() {
		return $this->value;
	}

}
?>