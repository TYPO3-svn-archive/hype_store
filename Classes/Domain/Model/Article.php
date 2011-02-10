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
 * Article
 *
 * @package HypeStore
 * @subpackage Domain/Model
 * @version $Id:$
 * @copyright Copyright belongs to the respective authors
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 * @scope prototype
 * @entity
 */
class Tx_HypeStore_Domain_Model_Article extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * @var Tx_HypeStore_Domain_Model_Product
	 */
	protected $product;

	/**
	 * @var string
	 * @validate StringLength(minimum = 1, maximum = 255)
	 */
	protected $identifier;

	/**
	 * @var string
	 * @validate StringLength(minimum = 0, maximum = 255)
	 */
	protected $gtin;

	/**
	 * @var string
	 * @validate String
	 */
	protected $images;

	/**
	 * @var string
	 * @validate String
	 */
	protected $files;

	/**
	 * @var integer
	 * validate Integer
	 */
	protected $minimumOrderQuantity;

	/**
	 * @var float
	 */
	protected $flatPrice;

	/**
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_HypeStore_Domain_Model_ProductPrice>
	 * @lazy
	 * @cascade remove
	 */
	protected $scaledPrices;

	/**
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_HypeStore_Domain_Model_ProductAttribute>
	 * @lazy
	 * @cascade remove
	 */
	protected $attributes;

	/**
	 * @var integer
	 * validate Integer
	 */
	protected $stockThreshold;

	/**
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_HypeStore_Domain_Model_ProductStock>
	 * @lazy
	 * @cascade remove
	 */
	protected $stocks;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();

		$this->scaledPrices		= new Tx_Extbase_Persistence_ObjectStorage();
		$this->attributes		= new Tx_Extbase_Persistence_ObjectStorage();
		$this->stocks			= new Tx_Extbase_Persistence_ObjectStorage();
	}

	/**
	 * Initialization
	 *
	 * return void
	 */
	public function initializeObject() {

		# initialize the product service
		$this->productService = t3lib_div::makeInstance('Tx_HypeStore_Domain_Service_ProductService');
	}

	/**
	 * Setter for identifier
	 *
	 * @param string $identifier
	 * @return void
	 */
	public function setIdentifier($identifier) {
		$this->identifier = $identifier;
	}

	/**
	 * Getter for identifier
	 *
	 * @return string
	 */
	public function getIdentifier() {
		return $this->identifier;
	}

	/**
	 * Setter for gtin
	 *
	 * @param string $gtin
	 * @return void
	 */
	public function setGtin($gtin) {
		$this->gtin = $gtin;
	}

	/**
	 * Getter for gtin
	 *
	 * @return string
	 */
	public function getGtin() {
		return $this->gtin;
	}

	/**
	 * Setter for images
	 *
	 * @param array $images
	 * @return void
	 */
	public function setImages(array $images) {
		$this->images = implode(',', $images);
	}

	/**
	 * Adds an image
	 *
	 * @param string $image
	 * @return void
	 */
	public function addImage($image) {
		$this->images = implode(',', array_push(explode(',', $this->images), $image));
	}

	/**
	 * Removes an image
	 *
	 * @param string $image
	 * @return void
	 */
	public function removeImage($image) {
		//$this->images = explode(',', $this->images);
	}

	/**
	 * Removes all images
	 *
	 * @return void
	 */
	public function removeImages() {
		$this->images = '';
	}

	/**
	 * Getter for images
	 *
	 * @return array
	 */
	public function getImages() {
		if(!$this->images) {
			return NULL;
		}

		return explode(',', $this->images);
	}

	/**
	 * Setter for files
	 *
	 * @param array $images
	 * @return void
	 */
	public function setFiles(array $files) {
		$this->files = implode(',', $files);
	}

	/**
	 * Adds a file
	 *
	 * @param string $file
	 * @return void
	 */
	public function addFile($file) {
		$this->files = implode(',', array_push(explode(',', $this->files), $file));
	}

	/**
	 * Removes a file
	 *
	 * @param string $file
	 * @return void
	 */
	public function removeFile($file) {
		//$this->images = explode(',', $this->images);
	}

	/**
	 * Removes all files
	 *
	 * @return void
	 */
	public function removeFiles() {
		$this->files = '';
	}

	/**
	 * Getter for images
	 *
	 * @return array
	 */
	public function getFiles() {
		if(!$this->files) {
			return NULL;
		}

		return explode(',', $this->files);
	}

	/**
	 * Setter for minimum order quantity
	 *
	 * @param float $quantity
	 * @return void
	 */
	public function setMinimumOrderQuantity($quantity) {
		$this->minimumOrderQuantity = $quantity;
	}

	/**
	 * Getter for minimum order quantity
	 *
	 * @return string
	 */
	public function getMinimumOrderQuantity() {
		return $this->minimumOrderQuantity;
	}

	/**
	 * Setter for flat price
	 *
	 * @param float $price
	 * @return void
	 */
	public function setFlatPrice($price) {
		$this->flatPrice = $price;
	}

	/**
	 * Getter for flat price
	 *
	 * @return string
	 */
	public function getFlatPrice() {
		return $this->flatPrice;
	}

	/**
	 * Setter for scaled prices
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage $prices
	 * @return void
	 */
	public function setScaledPrices(Tx_Extbase_Persistence_ObjectStorage $prices) {
		$this->scaledPrices = clone $prices;
	}

	/**
	 * Adds a scaled price
	 *
	 * @param Tx_HypeStore_Domain_Model_ProductPrice $price
	 * @return void
	 */
	public function addScaledPrice(Tx_HypeStore_Domain_Model_ProductPrice $price) {
		$this->scaledPrices->attach($price);
	}

	/**
	 * Removes a scaled price
	 *
	 * @param Tx_HypeStore_Domain_Model_ProductPrice $price
	 * @return void
	 */
	public function removeScaledPrice(Tx_HypeStore_Domain_Model_ProductPrice $price) {
		$this->scaledPrices->detach($price);
	}

	/**
	 * Remove all scaled prices
	 *
	 * @return void
	 */
	public function removeScaledPrices() {
		$this->scaledPrices = new Tx_Extbase_Persistence_ObjectStorage();
	}

	/**
	 * Getter for scaled prices
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage
	 */
	public function getScaledPrices() {
		if($this->scaledPrices instanceof Tx_Extbase_Persistence_LazyLoadingProxy) {
			$this->scaledPrices->_loadRealInstance();
		}

		return clone $this->scaledPrices;
	}

	/**
	 * Setter for attributes
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage $attributes
	 * @return void
	 */
	public function setAttributes(Tx_Extbase_Persistence_ObjectStorage $attributes) {
		$this->attributes = clone $attributes;
	}

	/**
	 * Adds an attribute
	 *
	 * @param Tx_HypeStore_Domain_Model_ProductAttribute $price
	 * @return void
	 */
	public function addAttribute(Tx_HypeStore_Domain_Model_ProductAttribute $attribute) {
		$this->attributes->attach($attribute);
	}

	/**
	 * Removes an attribute
	 *
	 * @param Tx_HypeStore_Domain_Model_ProductAttribute $attribute
	 * @return void
	 */
	public function removeAttribute(Tx_HypeStore_Domain_Model_ProductAttribute $attribute) {
		$this->attributes->detach($attribute);
	}

	/**
	 * Remove all attributes
	 *
	 * @return void
	 */
	public function removeAttributes() {
		$this->attributes = new Tx_Extbase_Persistence_ObjectStorage();
	}

	/**
	 * Getter for attributes
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage
	 */
	public function getAttributes() {
		if($this->attributes instanceof Tx_Extbase_Persistence_LazyLoadingProxy) {
			$this->attributes->_loadRealInstance();
		}

		return clone $this->attributes;
	}

	/**
	 * Setter for stock threshold
	 *
	 * @param integer $threshold
	 * @return void
	 */
	public function setStockThreshold($threshold) {
		$this->stockThreshold = $threshold;
	}

	/**
	 * Getter for stock threshold
	 *
	 * @return integer
	 */
	public function getStockThreshold() {
		return $this->stockThreshold;
	}

	/**
	 * Setter for stocks
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage $stocks
	 * @return void
	 */
	public function setStocks(Tx_Extbase_Persistence_ObjectStorage $stocks) {
		$this->stocks = clone $stocks;
	}

	/**
	 * Adds a stock
	 *
	 * @param Tx_HypeStore_Domain_Model_DepotStock $stock
	 * @return void
	 */
	public function addStock(Tx_HypeStore_Domain_Model_DepotStock $stock) {
		$this->stocks->attach($stock);
	}

	/**
	 * Removes a stock
	 *
	 * @param Tx_HypeStore_Domain_Model_DepotStock $stock
	 * @return void
	 */
	public function removeStock(Tx_HypeStore_Domain_Model_DepotStock $stock) {
		$this->stocks->detach($stock);
	}

	/**
	 * Remove all stocks
	 *
	 * @return void
	 */
	public function removeStocks() {
		$this->stocks = new Tx_Extbase_Persistence_ObjectStorage();
	}

	/**
	 * Getter for stocks
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage
	 */
	public function getStocks() {
		if($this->stocks instanceof Tx_Extbase_Persistence_LazyLoadingProxy) {
			$this->stocks->_loadRealInstance();
		}

		return clone $this->stocks;
	}



	/* Service methods */

	/**
	 * Gets the calculated gross price
	 *
	 * @return double
	 */
	public function getGrossPrice() {
		return $this->articleService->getPrice($this);
	}

	/**
	 * Gets the calculated stock quantity
	 *
	 * @return int
	 */
	public function getStock() {
		return $this->articleService->getStock($this);
	}



	/* Service methods */

	/**
	 * Returns all rootlines for this product
	 *
	 * @return array
	 */
	public function getRootlines() {
		return $this->articleService->getRootlines($this);
	}

	/**
	 * Returns the first rootline of this product
	 *
	 * @return array
	 */
	public function getRootline() {
		return array_shift($this->getRootlines())->__toString();
	}



	/* Magic methods */

	/**
	 * Returns as a formatted string
	 *
	 * @return string
	 */
	public function __toString() {
		return $this->getIdentifier();
	}
}
?>