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
 * Price calculation service
 */
class Tx_HypeStore_Domain_Service_PriceCalculationService implements t3lib_singleton {
	
	public function getPrice(Tx_HypeStore_Domain_Model_CartItem $cartItem) {
		
		$price = $cartItem->getProduct()->getFlatPrice();
		$quantity = $cartItem->getQuantity();
		
		foreach($cartItem->getProduct()->getScaledPrices() as $scaledPrice) {
			if($quantity >= $scaledPrice->getQuantity()) {
				$price = min($price, $scaledPrice->getValue());
			}
		}
		
		return $price;
	}
	
	public function getPriceSum(Tx_HypeStore_Domain_Model_CartItem $cartItem) {
		return $this->getPrice($cartItem) * $cartItem->getQuantity();
	}
	
	public function getPriceTotal(Tx_Extbase_Persistence_ObjectStorage $cartItems) {
		
		$price = 0;
		
		foreach($cartItems as $cartItem) {
			$price += $this->getPriceSum($cartItem);
		}
		
		return $price;
	}
}
?>