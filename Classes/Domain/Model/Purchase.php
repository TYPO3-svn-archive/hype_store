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
 * Purchase
 *
 * @package HypeStore
 * @subpackage Domain/Model
 * @version $Id:$
 * @copyright Copyright belongs to the respective authors
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 * @scope prototype
 * @entity
 */
class Tx_HypeStore_Domain_Model_Purchase extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * @var Tx_HypeStore_Domain_Model_Customer
	 */
	protected $customer;

	/**
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_HypeStore_Domain_Model_PurchaseItem>
	 * @lazy
	 * @cascade remove
	 */
	protected $items;

	/**
	 * Setter for customer
	 *
	 * @param Tx_HypeStore_Domain_Model_Customer
	 * @return void
	 */
	public function setCustomer(Tx_HypeStore_Domain_Model_Customer $customer) {
		$this->customer = $customer;
	}

	/**
	 * Getter for customer
	 *
	 * @return Tx_HypeStore_Domain_Model_Customer
	 */
	public function getCustomer() {
		return $this->customer;
	}

	/**
	 * Setter for items
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage $items
	 * @return void
	 */
	public function setItems(Tx_Extbase_Persistence_ObjectStorage $items) {
		$this->items = $items;
	}

	/**
	 * Getter for items
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage
	 */
	public function getItems() {
		return $this->items;
	}

	/**
	 * Adds an item
	 *
	 * @param Tx_HypeStore_Domain_Model_PurchaseItem $item
	 * @return void
	 */
	public function addItem(Tx_HypeStore_Domain_Model_CartItem $item) {
		$this->items->attach($item);
	}

	/**
	 * Removes an item
	 *
	 * @param Tx_HypeStore_Domain_Model_PurchaseItem $item
	 * @return void
	 */
	public function removeItem(Tx_HypeStore_Domain_Model_PurchaseItem $item) {
		$this->items->detach($item);
	}

	/**
	 * Remove all items
	 *
	 * @return void
	 */
	public function removeItems() {
		$this->items = new Tx_Extbase_Persistence_ObjectStorage();
	}



	/* Magic methods */

	/**
	 * Returns as a formatted string
	 *
	 * @return string
	 */
	public function __toString() {
		return $this->getUid();
	}
}
?>