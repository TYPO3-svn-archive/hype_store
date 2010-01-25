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
 * A customer
 *
 * @package HypeStore
 * @subpackage Domain\Model
 * @version $Id: Customer.php$
 * @scope prototype
 * @entity
 */
class Tx_HypeStore_Domain_Model_Customer extends Tx_Extbase_Domain_Model_FrontendUser {
	
	/**
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_HypeStore_Domain_Model_CartItem>
	 */
	protected $cartItems;
	
	/**
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_HypeStore_Domain_Model_CustomerAddress>
	 */
	protected $addresses;
	
	/**
	 * Constructs a new customer
	 *
	 * @api
	 */
	public function __construct() {
		parent::__construct();
		
		$this->cartItems = new Tx_Extbase_Persistence_ObjectStorage();
		$this->addresses = new Tx_Extbase_Persistence_ObjectStorage();
	}
	
	/**
	 * Setter for cart items
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage $items
	 * @return void
	 */
	public function setCartItems(Tx_Extbase_Persistence_ObjectStorage $items) {
		$this->cartItems = clone $items;
	}
	
	/**
	 * Adds a cart item
	 *
	 * @param Tx_HypeStore_Domain_Model_CartItem $item
	 * @return void
	 */
	public function addCartItem(Tx_HypeStore_Domain_Model_CartItem $item) {
		$this->cartItems->attach($item);
	}
	
	/**
	 * Removes a cart item
	 *
	 * @param Tx_HypeStore_Domain_Model_CartItem $item
	 * @return void
	 */
	public function removeCartItem(Tx_HypeStore_Domain_Model_CartItem $item) {
		$this->cartItems->detach($item);
	}
	
	/**
	 * Remove all cart items
	 *
	 * @return void
	 */
	public function removeCartItems() {
		$this->cartItems = new Tx_Extbase_Persistence_ObjectStorage();
	}
	
	/**
	 * Getter for cart items
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage
	 */
	public function getCartItems() {
		return clone $this->cartItems;
	}
	
	/**
	 * Setter for addresses
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage $addresses
	 * @return void
	 */
	public function setAddresses(Tx_Extbase_Persistence_ObjectStorage $addresses) {
		$this->addresses = clone $addresses;
	}
	
	/**
	 * Adds an address
	 *
	 * @param Tx_HypeStore_Domain_Model_CustomerAddress $address
	 * @return void
	 */
	public function addAddress(Tx_HypeStore_Domain_Model_CustomerAddress $address) {
		$this->addresses->attach($address);
	}
	
	/**
	 * Removes an address
	 *
	 * @param Tx_HypeStore_Domain_Model_CustomerAddress $address
	 * @return void
	 */
	public function removeAddress(Tx_HypeStore_Domain_Model_CustomerAddress $address) {
		$this->addresses->detach($address);
	}
	
	/**
	 * Remove all addresses
	 *
	 * @return void
	 */
	public function removeAddresses() {
		$this->addresses = new Tx_Extbase_Persistence_ObjectStorage();
	}
	
	/**
	 * Getter for addresses
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage
	 */
	public function getAddresses() {
		return clone $this->addresses;
	}
}
?>