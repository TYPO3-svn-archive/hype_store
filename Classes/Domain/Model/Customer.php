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
 * Customer
 *
 * @package HypeStore
 * @subpackage Domain/Model
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
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_HypeStore_Domain_Model_Purchase>
	 * @lazy
	 * @cascade remove
	 */
	protected $purchases;

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
		$this->addresses = t3lib_div::makeInstance('Tx_Extbase_Persistence_ObjectStorage');
		$this->purchases = t3lib_div::makeInstance('Tx_Extbase_Persistence_ObjectStorage');
		$this->cartItems = t3lib_div::makeInstance('Tx_Extbase_Persistence_ObjectStorage');
		$this->watchlistItems = t3lib_div::makeInstance('Tx_Extbase_Persistence_ObjectStorage');
	}

	/**
	 * Setter for addresses
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage $addresses
	 * @return void
	 */
	public function setAddresses(Tx_Extbase_Persistence_ObjectStorage $addresses) {
		$this->addresses = $addresses;
	}

	/**
	 * Getter for addresses
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage
	 */
	public function getAddresses() {
		return $this->addresses;
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
	 * Setter for purchases
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage $purchases
	 * @return void
	 */
	public function setPurchases(Tx_Extbase_Persistence_ObjectStorage $purchases) {
		$this->purchases = $purchases;
	}

	/**
	 * Getter for purchases
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage
	 */
	public function getPurchases() {
		return $this->purchases;
	}

	/**
	 * Adds a purchase
	 *
	 * @param Tx_HypeStore_Domain_Model_Purchase $purchase
	 * @return void
	 */
	public function addPurchase(Tx_HypeStore_Domain_Model_Purchase $purchase) {
		$this->purchases->attach($purchase);
	}

	/**
	 * Removes a purchase
	 *
	 * @param Tx_HypeStore_Domain_Model_Purchase $purchase
	 * @return void
	 */
	public function removePurchase(Tx_HypeStore_Domain_Model_Purchase $purchase) {
		$this->purchases->detach($purchase);
	}

	/**
	 * Remove all purchases
	 *
	 * @return void
	 */
	public function removePurchases() {
		$this->purchases = new Tx_Extbase_Persistence_ObjectStorage();
	}

	/**
	 * Setter for cart items
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage $cartItems
	 * @return void
	 */
	public function setCartItems(Tx_Extbase_Persistence_ObjectStorage $cartItems) {
		$this->cartItems = $cartItems;
	}

	/**
	 * Getter for cart items
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage
	 */
	public function getCartItems() {
		return $this->cartItems;
	}

	/**
	 * Adds a cart item
	 *
	 * @param Tx_HypeStore_Domain_Model_CartItem $cartItem
	 * @return void
	 */
	public function addCartItem(Tx_HypeStore_Domain_Model_CartItem $cartItem) {
		$this->cartItems->attach($cartItem);
	}

	/**
	 * Removes a cart item
	 *
	 * @param Tx_HypeStore_Domain_Model_CartItem $cartItem
	 * @return void
	 */
	public function removeCartItem(Tx_HypeStore_Domain_Model_CartItem $cartItem) {
		$this->cartItems->detach($cartItem);
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
	 * Setter for watchlist items
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage $watchlistItems
	 * @return void
	 */
	public function setWatchlistItems(Tx_Extbase_Persistence_ObjectStorage $watchlistItems) {
		$this->watchlistItems = $watchlistItems;
	}

	/**
	 * Getter for watchlist items
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage
	 */
	public function getWatchlistItems() {
		return $this->watchlistItems;
	}

	/**
	 * Adds a watchlist item
	 *
	 * @param Tx_HypeStore_Domain_Model_WatchlistItem $watchlistItem
	 * @return void
	 */
	public function addWatchlistItem(Tx_HypeStore_Domain_Model_WatchlistItem $watchlistItem) {
		$this->watchlistItems->attach($watchlistItem);
	}

	/**
	 * Removes a watchlist item
	 *
	 * @param Tx_HypeStore_Domain_Model_WatchlistItem $watchlistItem
	 * @return void
	 */
	public function removeWatchlistItem(Tx_HypeStore_Domain_Model_WatchlistItem $watchlistItem) {
		$this->watchlistItems->detach($watchlistItem);
	}

	/**
	 * Remove all watchlist items
	 *
	 * @return void
	 */
	public function removeWatchlistItems() {
		$this->watchlistItems = t3lib_div::makeInstance('Tx_Extbase_Persistence_ObjectStorage');
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