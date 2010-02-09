<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2010 Thomas "Thasmo" Deinhamer <thasmo@gmail.com>
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
 * Watchlist item
 *
 * @package HypeStore
 * @subpackage Domain
 * @version $Id:$
 * @copyright Copyright belongs to the respective authors
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 * @scope prototype
 * @entity
 */
class Tx_HypeStore_Domain_Model_WatchlistItem extends Tx_Extbase_DomainObject_AbstractEntity {
	
	/**
	 * @var Tx_HypeStore_Domain_Model_Customer
	 * @lazy
	 */
	protected $customer;
	
	/**
	 * @var Tx_HypeStore_Domain_Model_Product
	 * @lazy
	 */
	protected $product;
	
	/**
	 * @var int
	 * @validate Integer
	 */
	protected $quantity;
	
	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();
	}
	
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
		if($this->customer instanceof Tx_Extbase_Persistence_LazyLoadingProxy) {
			$this->customer->_loadRealInstance();
		}
		
		return $this->customer;
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
		if($this->product instanceof Tx_Extbase_Persistence_LazyLoadingProxy) {
			$this->product->_loadRealInstance();
		}
		
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
	
	
	
	/* Service methods */
	
	/**
	 * Returns the price for a single cart item product
	 *
	 * @return float
	 */
	public function getPrice() {
		return $this->productService->getPrice($this->getProduct(), $this->getQuantity());
	}
	
	/**
	 * Returns the total price for the cart item
	 *
	 * @return float
	 */
	public function getPriceSum() {
		return $this->getPrice() * $this->getQuantity();
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