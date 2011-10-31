<?php

class Tx_Taxonomy_Domain_Model_Category
			extends 	Tx_Extbase_DomainObject_AbstractEntity
			implements	t3lib_tree_RecordBasedNode, t3lib_tree_LabelEditable, t3lib_collection_Collection,
						t3lib_collection_Editable, t3lib_collection_Nameable {

	/**
	 * @var string
	 */
	protected $label;

	/**
	 * @var string
	 */
	protected $description;

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Return the current element
	 * @link http://php.net/manual/en/iterator.current.php
	 * @return mixed Can return any type.
	 */
	public function current() {
		// TODO: Implement current() method.
	}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Move forward to next element
	 * @link http://php.net/manual/en/iterator.next.php
	 * @return void Any returned value is ignored.
	 */
	public function next() {
		// TODO: Implement next() method.
	}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Return the key of the current element
	 * @link http://php.net/manual/en/iterator.key.php
	 * @return scalar scalar on success, integer
	 * 0 on failure.
	 */
	public function key() {
		// TODO: Implement key() method.
	}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Checks if current position is valid
	 * @link http://php.net/manual/en/iterator.valid.php
	 * @return boolean The return value will be casted to boolean and then evaluated.
	 * Returns true on success or false on failure.
	 */
	public function valid() {
		// TODO: Implement valid() method.
	}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Rewind the Iterator to the first element
	 * @link http://php.net/manual/en/iterator.rewind.php
	 * @return void Any returned value is ignored.
	 */
	public function rewind() {
		// TODO: Implement rewind() method.
	}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * String representation of object
	 * @link http://php.net/manual/en/serializable.serialize.php
	 * @return string the string representation of the object or &null;
	 */
	public function serialize() {
		// TODO: Implement serialize() method.
	}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Constructs the object
	 * @link http://php.net/manual/en/serializable.unserialize.php
	 * @param string $serialized <p>
	 * The string representation of the object.
	 * </p>
	 * @return mixed the original value unserialized.
	 */
	public function unserialize($serialized) {
		// TODO: Implement unserialize() method.
	}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Count elements of an object
	 * @link http://php.net/manual/en/countable.count.php
	 * @return int The custom count as an integer.
	 * </p>
	 * <p>
	 * The return value is cast to an integer.
	 */
	public function count() {
		// TODO: Implement count() method.
	}

	public function add($data) {
		// TODO: Implement add() method.
	}

	public function addAll(t3lib_collection_Collection $other) {
		// TODO: Implement addAll() method.
	}

	public function remove($data) {
		// TODO: Implement remove() method.
	}

	public function removeAll() {
		// TODO: Implement removeAll() method.
	}

	public function setTitle($title) {
		$this->setLabel($title);
	}

	public function setDescription($description) {
		$this->description = $description;
	}

	public function getTitle() {
		return $this->label;
	}

	public function getDescription() {
		return $this->description;
	}

	/**
	 * Sets the new label
	 *
	 * @param string $label
	 * @return void
	 */
	public function setLabel($label) {
		$this->label = $label;
	}

	/**
	 * Returns the source field of the label
	 *
	 * @return string
	 */
	public function getTextSourceField() {
		return 'label';
	}

	/**
	 * set the source field of the label
	 *
	 * @param string $field
	 * @return void
	 */
	public function setTextSourceField($field) {
		throw new BadMethodCallException('This method is not useful in this context', 1320063903);
	}

	/**
	 * Sets the database record array
	 *
	 * @param array $record
	 * @return void
	 */
	public function setRecord($record) {
		throw new BadMethodCallException('This method is not useful in this context', 1320063933);
	}

	/**
	 * Returns the database record array
	 *
	 * @return array
	 */
	public function getRecord() {
		return $this->toArray();
	}

	/**
	 * Returns the table of the record data
	 *
	 * @return string
	 */
	public function getSourceTable() {
		return 'sys_category';
	}

	/**
	 * sets the Table of record source data
	 *
	 * @param string $table
	 * @return void
	 */
	public function setSourceTable($table) {
		throw new BadMethodCallException('This method is not useful in this context', 1320063871);
	}


}
