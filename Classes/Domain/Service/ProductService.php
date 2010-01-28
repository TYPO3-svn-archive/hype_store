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
 * Product service
 */
class Tx_HypeStore_Domain_Service_ProductService implements t3lib_singleton {
	
	/**
	 * Constructor
	 */
	public function __construct() {
		$this->categoryService = t3lib_div::makeInstance('Tx_HypeStore_Domain_Service_CategoryService');
	}
	
	/**
	 * Calculates the price for a single product based on a given quantity
	 *
	 * @param Tx_HypeStore_Domain_Model_Product $product
	 * @param int $quantity
	 * @return float
	 */
	public function getPrice(Tx_HypeStore_Domain_Model_Product $product, $quantity = 1) {
		
		$price = $product->getFlatPrice();
		
		foreach($product->getScaledPrices() as $scaledPrice) {
			if($quantity >= $scaledPrice->getQuantity()) {
				$price = min($price, $scaledPrice->getValue());
			}
		}
		
		return $price;
	}
	
	/**
	 * Calculates the available stock for a given product
	 *
	 * @param Tx_HypeStore_Domain_Model_Product $product
	 * @return int
	 */
	public function getStock(Tx_HypeStore_Domain_Model_Product $product) {
		
		$quantity = 0;
		foreach($product->getStocks() as $stock) {
			$quantity += $stock->getQuantity();
		}
		
		foreach($product->getStates() as $state) {
			
			switch(TRUE) {
				case ($state->getDisposalDate()->format('U') <= 0 && $state->getReturnDate()->format('U') <= 0):
				case ($state->getDisposalDate()->format('U') <= 0 && $state->getReturnDate()->format('U') >= time()):
				case ($state->getDisposalDate()->format('U') <= time() && $state->getReturnDate()->format('U') <= 0):
				case ($state->getDisposalDate()->format('U') <= time() && $state->getReturnDate()->format('U') >= time()):
					
					$quantity -= $state->getQuantity();
					
					break;
			}
		}
		
		return max(0, $quantity);
	}
	
	/**
	 * Determines the existing rootlines for a given product
	 *
	 * @param Tx_HypeStore_Domain_Model_Product $product
	 * @return array
	 */
	public function getRootlines(Tx_HypeStore_Domain_Model_Product $product) {
		
		$rootlines = array();
		
		foreach($product->getCategories() as $category) {
			array_push($rootlines, $this->categoryService->getRootlines($category));
		}
		
		return $rootlines;
	}
}
?>