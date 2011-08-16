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
 * An abstract relation type denoting the relation between two things.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */

 class Tx_Taxonomy_Domain_Model_RelationType extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * The label of a relation.
	 *
	 * @var string $name
	 * @validate NotEmpty
	 */
	protected $name;

	/**
	 * A short descriptive text.
	 *
	 * @var string $description
	 */
	protected $description;

	/**
	 * Setter for name
	 *
	 * @param string $name The label of a relation.
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * Getter for name
	 *
	 * @return string The label of a relation.
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Setter for description
	 *
	 * @param string $description A short descriptive text.
	 * @return void
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * Getter for description
	 *
	 * @return string A short descriptive text.
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * The constructor of this AbstractRelationType
	 *
	 * @return void
	 */
	public function __construct() {

	}

}
?>