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
 * Product service
 */
class Tx_HypeStore_Domain_Service_ProductService
	implements t3lib_singleton, Tx_HypeStore_Domain_Service_ProductServiceInterface {

	/**
	 * @var Tx_HypeStore_Domain_Service_CategoryService
	 */
	protected $categoryService;

	/**
	 * @var Tx_HypeStore_Domain_Repository_DiscountRepository
	 */
	protected $discountRepository;

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->categoryService = t3lib_div::makeInstance('Tx_HypeStore_Domain_Service_CategoryService');
		$this->discountRepository = t3lib_div::makeInstance('Tx_HypeStore_Domain_Repository_DiscountRepository');
	}

	/**
	 * Returns all preceding categories for a given product
	 *
	 * @param Tx_HypeStore_Domain_Model_Product $product
	 * @return array
	 */
	public function getPrecedingCategories($product) {

		# get direct categories
		$categories = $product->getCategories()->toArray();

		if(count($categories) > 0) {
			foreach($categories as $category) {
				$categories = array_merge($this->categoryService->getPrecedingCategories($category), $categories);
			}
		}

		return $categories;
	}

	/**
	 * Calculates the final price for a single product based on a given quantity
	 *
	 * @param Tx_HypeStore_Domain_Model_Product $product
	 * @param integer $quantity
	 * @return float
	 */
	public function getPrice(Tx_HypeStore_Domain_Model_Product $product, $quantity = 1) {

		# get flat price
		$price = $product->getFlatPrice();

		# get the "best price" if a scaled price matches the given quantity
		foreach($product->getScaledPrices() as $scaledPrice) {
			if($quantity >= $scaledPrice->getQuantity()) {
				$price = min(($price) ? $price : $scaledPrice->getValue(), $scaledPrice->getValue());
			}
		}

		# get the applyable discount
		$discount = $this->getDiscount($product);

		if($discount) {
			# substract the discount rate
			$price *= ($discount->getRate() / 100);
		}

		# add tax
		if($product->getTaxScale()) {
			$price += ($price * ($product->getTaxScale()->getRate() / 100));
		}

		# return a rounded price for correct quantity calculation
		return round($price, 2);
	}

	/**
	 * Calculates the undiscounted price for a single product based on a given quantity
	 *
	 * @param Tx_HypeStore_Domain_Model_Product $product
	 * @param integer $quantity
	 * @return float
	 */
	public function getUndiscountedPrice(Tx_HypeStore_Domain_Model_Product $product, $quantity = 1) {

		# get flat price
		$price = $product->getFlatPrice();

		# get the "best price" if a scaled price matches the given quantity
		foreach($product->getScaledPrices() as $scaledPrice) {
			if($quantity >= $scaledPrice->getQuantity()) {
				$price = min($price, $scaledPrice->getValue());
			}
		}

		# add tax
		if($product->getTaxScale()) {
			$price = $price + ($price * ($product->getTaxScale()->getRate() / 100));
		}

		# return a rounded price for correct quantity calculation
		return round($price, 2);
	}

	/**
	 * Gets the final relevant discount for a given product
	 *
	 * @param Tx_HypeStore_Domain_Model_Product $product
	 * @return Tx_HypeStore_Domain_Model_Discount
	 */
	public function getDiscount(Tx_HypeStore_Domain_Model_Product $product) {
		$discount = array_shift($this->discountRepository->findByProduct($product));
		return $discount;
	}

	/**
	 * Calculates the available stock for a given product
	 *
	 * @param Tx_HypeStore_Domain_Model_Product $product
	 * @return integer
	 */
	public function getStock(Tx_HypeStore_Domain_Model_Product $product) {

		$quantity = 0;

		foreach($product->getStocks() as $stock) {
			$quantity += $stock->getQuantity();
		}

		return $quantity;
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
			array_push($rootlines, $this->categoryService->getRootline($category));
		}

		return $rootlines;
	}
}
?>