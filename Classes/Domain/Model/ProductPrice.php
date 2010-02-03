<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2009 Thomas "Thasmo" Deinhamer <thasmo@gmail.com>
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
 * @subpackage Domain
 * @version $Id:$
 * @copyright Copyright belongs to the respective authors
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 * @scope prototype
 * @entity
 */
class Tx_HypeStore_Domain_Model_ProductPrice extends Tx_Extbase_DomainObject_AbstractEntity {
	
	/**
	 * @var int
	 * @validate Integer
	 */
	protected $quantity;
	
	/**
	 * @var float
	 * @validate Float
	 */
	protected $value;
	
	/**
	 * @var Tx_HypeStore_Domain_Model_Product
	 */
	protected $product;
	
	/**
	 * Constructor
	 */
	//public function __construct() {
	//
	//}

	/**
	 * Initialization
	 *
	 * return void
	 */
	public function initializeObject() {

		# initialize the price calculation service
		$this->productService = t3lib_div::makeInstance('Tx_HypeStore_Domain_Service_ProductService');
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
	
	
	
	/* Service methods */
	
	/**
	 * Gets the calculated gross price
	 *
	 * @return double
	 */
	public function getGrossValue() {
		return $this->productService->getPrice($this->getProduct(), $this->getQuantity());
	}
	
	
	
	/**
	 * Returns as a formatted string
	 *
	 * @return string
	 */
	public function __toString() {
		//return (string)$this->getValue();
	}
}
?>