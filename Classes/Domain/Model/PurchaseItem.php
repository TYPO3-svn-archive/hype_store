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
 * Purchase Item
 *
 * @package HypeStore
 * @subpackage Domain/Model
 * @version $Id:$
 * @copyright Copyright belongs to the respective authors
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 * @scope prototype
 * @entity
 */
class Tx_HypeStore_Domain_Model_PurchaseItem extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * @var Tx_HypeStore_Domain_Model_Purchase
	 */
	protected $purchase;

	/**
	 * @var Tx_HypeStore_Domain_Model_Product
	 */
	protected $product;

	/**
	 * @var int
	 * @validate Integer
	 */
	protected $quantity;

	/**
	 * Setter for purchase
	 *
	 * @param Tx_HypeStore_Domain_Model_Purchase
	 * @return void
	 */
	public function setCustomer(Tx_HypeStore_Domain_Model_Purchase $purchase) {
		$this->purchase = $purchase;
	}

	/**
	 * Getter for purchase
	 *
	 * @return Tx_HypeStore_Domain_Model_Purchase
	 */
	public function getPurchase() {
		return $this->purchase;
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

	/**
	 * Setter for quantity
	 *
	 * @param int $quantity
	 * @return void
	 */
	public function setQuantity($quantity) {
		$this->quantity = $quantity;
	}

	/**
	 * Getter for quantity
	 *
	 * @return int
	 */
	public function getQuantity() {
		return $this->quantity;
	}



	/* Magic methods */

	/**
	 * Returns as a formatted string
	 *
	 * @return string
	 */
	public function __toString() {
		return $this->getProduct()->getTitle();
	}
}
?>