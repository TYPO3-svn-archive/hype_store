<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2011 Thomas "Thasmo" Deinhamer <thasmo@gmail.com>
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
 * Product attribute
 *
 * @package HypeStore
 * @subpackage Domain/Model
 * @version $Id:$
 * @copyright Copyright belongs to the respective authors
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 * @scope prototype
 * @entity
 */
class Tx_HypeStore_Domain_Model_ProductAttribute extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * @var Tx_HypeStore_Domain_Model_Attribute
	 */
	protected $attribute;

	/**
	 * @var string
	 * @validate StringLength(minimum = 1, maximum = 255)
	 */
	protected $value;

	/**
	 * @var string
	 */
	protected $items;

	/**
	 * @var Tx_HypeStore_Domain_Model_Product
	 */
	protected $product;

	/**
	 * Setter for attribute
	 *
	 * @param Tx_HypeStore_Domain_Model_Attribute $attribute
	 * @return void
	 */
	public function setAttribute(Tx_HypeStore_Domain_Model_Attribute $attribute) {
		$this->attribute = $attribute;
	}

	/**
	 * Getter for attribute
	 *
	 * @return Tx_HypeStore_Domain_Model_Attribute
	 */
	public function getAttribute() {
		return $this->attribute;
	}

	/**
	 * Setter for value
	 *
	 * @param string $value
	 * @return void
	 */
	public function setValue($value) {
		$this->value = $value;
	}

	/**
	 * Getter for value
	 *
	 * @return string
	 */
	public function getValue() {
		return $this->value;
	}

	/**
	 * Setter for items
	 *
	 * @param array $items
	 * @return void
	 */
	public function setItems(array $items) {
		$this->items = implode(',', $items);
	}

	/**
	 * Getter for items
	 *
	 * @return array
	 */
	public function getItems() {
		return explode(',', $this->items);
	}

	/**
	 * Adds an item
	 *
	 * @param string $item
	 * @return void
	 */
	public function addItem($item) {
		$this->setItems(array_merge($this->getItems(), array($item)));
	}

	/**
	 * Removes an item
	 *
	 * @param string $item
	 * @return void
	 */
	public function removeItem($item) {
		$this->setItems(array_diff($this->getItems(), array($item)));
	}

	/**
	 * Removes all items
	 *
	 * @return void
	 */
	public function removeItems() {
		$this->items = '';
	}

	/**
	 * Setter for product
	 *
	 * @param Tx_HypeStore_Domain_Model_Product $product
	 * @return void
	 */
	public function setProduct(Tx_HypeStore_Domain_Model_Product $product) {
		$this->product = $product;
	}

	/**
	 * Getter for product
	 *
	 * @return Tx_HypeStore_Domain_Model_Product
	 */
	public function getProduct() {
		return $this->product;
	}



	/* Magic methods */

	/**
	 * Returns as a formatted string
	 *
	 * @return string
	 */
	public function __toString() {
		return $this->getAttribute()->getTitle();
	}
}
?>