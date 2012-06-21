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
 * Attribute Set
 *
 * @package HypeStore
 * @subpackage Domain/Model/Attribute
 * @version $Id:$
 * @copyright Copyright belongs to the respective authors
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 * @scope prototype
 * @entity
 */
class Tx_HypeStore_Domain_Model_Attribute_Set extends Tx_HypeStore_Domain_Model_Attribute {

	/**
	 * @var string
	 * @validate String
	 */
	protected $items;

	/**
	 * Setter for items
	 *
	 * @param array $items
	 * @return void
	 */
	public function setItems(array $items) {
		$this->items = implode(chr(10), $items);
	}

	/**
	 * Getter for items
	 *
	 * @return array
	 */
	public function getItems() {
		return t3lib_div::trimExplode(chr(10), $this->items);
	}

	/**
	 * Adds an item
	 *
	 * @param string $item
	 * @return void
	 */
	public function addItem($item) {
		$this->items = array_merge($this->items, array($item));
	}

	/**
	 * Removes an item
	 *
	 * @param string $item
	 * @return void
	 */
	public function removeItem($item) {
		$this->items = array_diff($this->items, array($item));
	}

	/**
	 * Removes all items
	 *
	 * @return void
	 */
	public function removeItems() {
		$this->items = array();
	}
}
?>