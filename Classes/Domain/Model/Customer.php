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
 * Customer
 *
 * @package HypeStore
 * @subpackage Domain\Model
 * @version $Id: Customer.php$
 * @scope prototype
 * @entity
 */
class Tx_HypeStore_Domain_Model_Customer extends Tx_Hype_Domain_Model_Typo3_FrontendUser {
	
	/**
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_HypeStore_Domain_Model_CustomerAddress>
	 * @lazy
	 * @cascade remove
	 */
	protected $addresses;
	
	/**
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_HypeStore_Domain_Model_Order>
	 * @lazy
	 * @cascade remove
	 */
	protected $orders;
	
	/**
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_HypeStore_Domain_Model_CartItem>
	 * @lazy
	 * @cascade remove
	 */
	protected $cartItems;
	
	/**
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_HypeStore_Domain_Model_WatchlistItem>
	 * @lazy
	 * @cascade remove
	 */
	protected $watchlistItems;
	
	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();
		
		$this->addresses = new Tx_Extbase_Persistence_ObjectStorage();
		$this->orders = new Tx_Extbase_Persistence_ObjectStorage();
		$this->cartItems = new Tx_Extbase_Persistence_ObjectStorage();
		$this->watchlistItems = new Tx_Extbase_Persistence_ObjectStorage();
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
		if($this->addresses instanceof Tx_Extbase_Persistence_LazyLoadingProxy) {
			$this->addresses->_loadRealInstance();
		}
		
		return clone $this->addresses;
	}
	
	/**
	 * Setter for orders
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage $orders
	 * @return void
	 */
	public function setOrders(Tx_Extbase_Persistence_ObjectStorage $orders) {
		$this->orders = clone $orders;
	}
	
	/**
	 * Adds an order
	 *
	 * @param Tx_HypeStore_Domain_Model_Order $order
	 * @return void
	 */
	public function addOrder(Tx_HypeStore_Domain_Model_Order $order) {
		$this->orders->attach($order);
	}
	
	/**
	 * Removes an order
	 *
	 * @param Tx_HypeStore_Domain_Model_Order $order
	 * @return void
	 */
	public function removeOrder(Tx_HypeStore_Domain_Model_Order $order) {
		$this->orders->detach($order);
	}
	
	/**
	 * Remove all orders
	 *
	 * @return void
	 */
	public function removeOrders() {
		$this->orders = new Tx_Extbase_Persistence_ObjectStorage();
	}
	
	/**
	 * Getter for orders
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage
	 */
	public function getOrders() {
		if($this->orders instanceof Tx_Extbase_Persistence_LazyLoadingProxy) {
			$this->orders->_loadRealInstance();
		}
		
		return clone $this->orders;
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
		if($this->cartItems instanceof Tx_Extbase_Persistence_LazyLoadingProxy) {
			$this->cartItems->_loadRealInstance();
		}
		
		return clone $this->cartItems;
	}
	
	/**
	 * Setter for watchlist items
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage $items
	 * @return void
	 */
	public function setWatchlistItems(Tx_Extbase_Persistence_ObjectStorage $items) {
		$this->watchlistItems = clone $items;
	}
	
	/**
	 * Adds a watchlist item
	 *
	 * @param Tx_HypeStore_Domain_Model_WatchlistItem $item
	 * @return void
	 */
	public function addWatchlistItem(Tx_HypeStore_Domain_Model_WatchlistItem $item) {
		$this->watchlistItems->attach($item);
	}
	
	/**
	 * Removes a watchlist item
	 *
	 * @param Tx_HypeStore_Domain_Model_WatchlistItem $item
	 * @return void
	 */
	public function removeWatchlistItem(Tx_HypeStore_Domain_Model_WatchlistItem $item) {
		$this->watchlistItems->detach($item);
	}
	
	/**
	 * Remove all watchlist items
	 *
	 * @return void
	 */
	public function removeWatchlistItems() {
		$this->watchlistItems = new Tx_Extbase_Persistence_ObjectStorage();
	}
	
	/**
	 * Getter for watchlist items
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage
	 */
	public function getWatchlistItems() {
		if($this->watchlistItems instanceof Tx_Extbase_Persistence_LazyLoadingProxy) {
			$this->watchlistItems->_loadRealInstance();
		}
		
		return clone $this->watchlistItems;
	}
}
?>