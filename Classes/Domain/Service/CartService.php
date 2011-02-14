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
 * Cart service
 */
class Tx_HypeStore_Domain_Service_CartService implements t3lib_singleton {

	/**
	 * @var Tx_HypeStore_Domain_Service_ProductService
	 */
	protected $productService;

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->productService = t3lib_div::makeInstance('Tx_HypeStore_Domain_Service_ProductService');
	}

	/**
	 * Calculates the total price for the given cart items
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage $cartItems
	 * @return float
	 */
	public function getTotalPrice(Tx_Extbase_Persistence_ObjectStorage $cartItems) {

		$price = 0;

		foreach($cartItems as $cartItem) {
			$price += $this->productService->getPrice($cartItem->getProduct(), $cartItem->getQuantity()) * $cartItem->getQuantity();
		}

		return $price;
	}
}
?>