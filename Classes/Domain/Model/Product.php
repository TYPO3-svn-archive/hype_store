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
 * Product
 *
 * @package HypeStore
 * @subpackage Domain
 * @version $Id:$
 * @copyright Copyright belongs to the respective authors
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 * @scope prototype
 * @entity
 */
class Tx_HypeStore_Domain_Model_Product extends Tx_Extbase_DomainObject_AbstractEntity {
	
	/**
	 * @var string
	 * @validate StringLength(minimum = 1, maximum = 255)
	 */
	protected $title;
	
	/**
	 * @var string
	 * @validate StringLength(minimum = 1, maximum = 255)
	 */
	protected $subtitle;
	
	/**
	 * @var string
	 * @validate StringLength(minimum = 1, maximum = 255)
	 */
	protected $identifier;
	
	/**
	 * @var string
	 * @validate String
	 */
	protected $introduction;
	
	/**
	 * @var string
	 * @validate String
	 */
	protected $description;
	
	/**
	 * @var DateTime
	 */
	protected $versionDate;
	
	/**
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_HypeStore_Domain_Model_Category>
	 * @lazy
	 */
	protected $categories;
	
	/**
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_HypeStore_Domain_Model_Product>
	 * @lazy
	 */
	protected $relatedProducts;
	
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
	 * @var float
	 */
	protected $flatPrice;
	
	/**
	 * @var integer
	 */
	protected $minimumOrderQuantity;
	
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
	 */
	protected $stockThreshold;
	
	/**
	 * @var integer
	 */
	protected $stockUnit;
	
	/**
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_HypeStore_Domain_Model_DepotStock>
	 * @lazy
	 * @cascade remove
	 */
	protected $stocks;
	
	/**
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_HypeStore_Domain_Model_ProductState>
	 * @lazy
	 * @cascade remove
	 */
	protected $states;
	
	/**
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_HypeStore_Domain_Model_ProductEvent>
	 * @lazy
	 * @cascade remove
	 */
	protected $events;
	
	/**
	 * Constructor
	 */
	public function __construct() {
		
		$this->categories		= new Tx_Extbase_Persistence_ObjectStorage();
		$this->relatedProducts	= new Tx_Extbase_Persistence_ObjectStorage();
		$this->scaledPrices		= new Tx_Extbase_Persistence_ObjectStorage();
		$this->attributes		= new Tx_Extbase_Persistence_ObjectStorage();
		$this->stocks			= new Tx_Extbase_Persistence_ObjectStorage();
		$this->states			= new Tx_Extbase_Persistence_ObjectStorage();
		$this->events			= new Tx_Extbase_Persistence_ObjectStorage();
		
		$this->date				= new DateTime();
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
	 * Setter for title
	 *
	 * @param string $title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}
	
	/**
	 * Getter for title
	 *
	 * @return string
	 */
	public function getTitle() {
		return $this->title;
	}
	
	/**
	 * Setter for subtitle
	 *
	 * @param string $subtitle
	 * @return void
	 */
	public function setSubtitle($subtitle) {
		$this->subtitle = $subtitle;
	}
	
	/**
	 * Getter for subtitle
	 *
	 * @return string
	 */
	public function getSubtitle() {
		return $this->subtitle;
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
	 * Setter for introduction
	 *
	 * @param string $introduction
	 * @return void
	 */
	public function setIntroduction($introduction) {
		$this->introduction = $introduction;
	}
	
	/**
	 * Getter for introduction
	 *
	 * @return string
	 */
	public function getIntroduction() {
		return $this->introduction;
	}
	
	/**
	 * Setter for description
	 *
	 * @param string $description
	 * @return void
	 */
	public function setDescription($description) {
		$this->description = $description;
	}
	
	/**
	 * Getter for description
	 *
	 * @return string
	 */
	public function getDescription() {
		return $this->description;
	}
	
	/**
	 * Setter for versionDate
	 *
	 * @param DateTime $date
	 * @return void
	 */
	public function setVersionDate(DateTime $date) {
		$this->versionDate = $date;
	}
	
	/**
	 * Getter for date
	 *
	 * @return DateTime
	 */
	public function getVersionDate() {
		return $this->versionDate;
	}
	
	/**
	 * Setter for categories
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage $categories
	 * @return void
	 */
	public function setCategories(Tx_Extbase_Persistence_ObjectStorage $categories) {
		$this->categories = clone $categories;
	}
	
	/**
	 * Adds a category
	 *
	 * @param Tx_HypeStore_Domain_Model_Category $category
	 * @return void
	 */
	public function addCategory(Tx_HypeStore_Domain_Model_Category $category) {
		$this->categories->attach($category);
	}
	
	/**
	 * Removes a category
	 *
	 * @param Tx_HypeStore_Domain_Model_Category $category
	 * @return void
	 */
	public function removeCategory(Tx_HypeStore_Domain_Model_Category $category) {
		$this->categories->detach($category);
	}
	
	/**
	 * Remove all categories
	 *
	 * @return void
	 */
	public function removeCategories() {
		$this->categories = new Tx_Extbase_Persistence_ObjectStorage();
	}
	
	/**
	 * Getter for categories
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage
	 */
	public function getCategories() {
		return clone $this->categories;
	}
	
	/**
	 * Setter for related products
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage $products
	 * @return void
	 */
	public function setRelatedProducts(Tx_Extbase_Persistence_ObjectStorage $products) {
		$this->relatedProducts = clone $products;
	}
	
	/**
	 * Adds a related product
	 *
	 * @param Tx_HypeStore_Domain_Model_Product $product
	 * @return void
	 */
	public function addRelatedProduct(Tx_HypeStore_Domain_Model_Product $product) {
		$this->relatedProducts->attach($product);
	}
	
	/**
	 * Removes a related product
	 *
	 * @param Tx_HypeStore_Domain_Model_Product $product
	 * @return void
	 */
	public function removeRelatedProduct(Tx_HypeStore_Domain_Model_Product $product) {
		$this->relatedProducts->detach($product);
	}
	
	/**
	 * Remove all related products
	 *
	 * @return void
	 */
	public function removeRelatedProducts() {
		$this->relatedProducts = new Tx_Extbase_Persistence_ObjectStorage();
	}
	
	/**
	 * Getter for related products
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage
	 */
	public function getRelatedProducts() {
		return clone $this->relatedProducts;
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
	 * Setter for stock unit
	 *
	 * @param integer $unit
	 * @return void
	 */
	public function setStockUnit($unit) {
		$this->stockUnit = $unit;
	}
	
	/**
	 * Getter for stock unit
	 *
	 * @return integer
	 */
	public function getStockUnit() {
		return $this->stockUnit;
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
		return clone $this->stocks;
	}
	
	/**
	 * Setter for states
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage $states
	 * @return void
	 */
	public function setStates(Tx_Extbase_Persistence_ObjectStorage $states) {
		$this->states = clone $states;
	}
	
	/**
	 * Adds a state
	 *
	 * @param Tx_HypeStore_Domain_Model_ProductState $state
	 * @return void
	 */
	public function addState(Tx_HypeStore_Domain_Model_ProductState $state) {
		$this->states->attach($state);
	}
	
	/**
	 * Removes a state
	 *
	 * @param Tx_HypeStore_Domain_Model_ProductState $state
	 * @return void
	 */
	public function removeState(Tx_HypeStore_Domain_Model_ProductState $state) {
		$this->states->detach($state);
	}
	
	/**
	 * Removes all states
	 *
	 * @return void
	 */
	public function removeStates() {
		$this->states = new Tx_Extbase_Persistence_ObjectStorage();
	}
	
	/**
	 * Getter for states
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage
	 */
	public function getStates() {
		return clone $this->states;
	}
	
	/**
	 * Setter for events
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage $events
	 * @return void
	 */
	public function setEvents(Tx_Extbase_Persistence_ObjectStorage $events) {
		$this->events = clone $events;
	}
	
	/**
	 * Adds an event
	 *
	 * @param Tx_HypeStore_Domain_Model_ProductEvent $event
	 * @return void
	 */
	public function addEvent(Tx_HypeStore_Domain_Model_ProductEvent $event) {
		$this->events->attach($event);
	}
	
	/**
	 * Removes an event
	 *
	 * @param Tx_HypeStore_Domain_Model_ProductEvent $event
	 * @return void
	 */
	public function removeEvent(Tx_HypeStore_Domain_Model_ProductEvent $event) {
		$this->events->detach($event);
	}
	
	/**
	 * Removes all events
	 *
	 * @return void
	 */
	public function removeEvents() {
		$this->events = new Tx_Extbase_Persistence_ObjectStorage();
	}
	
	/**
	 * Getter for events
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage
	 */
	public function getEvents() {
		return clone $this->events;
	}
	
	
	
	/* Service methods */
	
	/**
	 * Gets the calculated stock quantity
	 *
	 * @return int
	 */
	public function getStock() {
		return $this->productService->getStock($this);
	}
	
	/**
	 * Returns all rootlines for this product
	 *
	 * @return array
	 */
	public function getRootlines() {
		return $this->productService->getRootlines($this);
	}
	
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
		return $this->getTitle();
	}
}
?>